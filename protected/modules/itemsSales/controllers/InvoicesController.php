<?php

class InvoicesController extends Controller
{
	public $invoice_type = array(
		'0' =>		'',
		'1' =>		'Tiền mặt',
		'2' =>		'Thẻ tín dụng',
		'3' =>		'Chuyển khoản'
	);
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='/layouts/view';

	/**
	* @return array action filters
	*/
	public function filters()
	{
	return array(
	'accessControl', // perform access control for CRUD operations
	);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return parent::accessRules();
	}

	public function actionView($id = '') {
		$branch = Branch::model()->findAll();
		$branchList = CHtml::listData($branch, 'id', 'name');

		$this->render('view',array('id'=>$id,'branch'=>$branchList));
	}

	public function actionLoadInvoice()
	{
		$group_id =  Yii::app()->user->getState('group_id');
		$role    = 1; 	// xem tat ca bao gia
		$rolePay = 0;	// thanh toan
		$rolePr  = 0;	// in phieu thu + hoa don
		$roleDel = 0;	// xoa hoa don

		switch ($group_id) {
			case Yii::app()->params['id_group_receptionist']:
				$rolePay = 1;
				$rolePr = 1;
				break;
			case Yii::app()->params['id_group_admin']:
			case Yii::app()->params['id_group_subadmin']:
				$roleDel = 1;
				$rolePr = 1;
				$rolePay  = 1;
				break;
		}

		$page             = isset($_POST['page'])?$_POST['page']:1;
		$limit            = isset($_POST['limit'])?$_POST['limit']:15;
		$invoice_time     = isset($_POST['invoice_time'])?$_POST['invoice_time']:'';
		$invoice_branch   = isset($_POST['invoice_branch'])?$_POST['invoice_branch']:1;
		$invoice_customer = isset($_POST['invoice_customer'])?$_POST['invoice_customer']:'';
		$invoice_code     = isset($_POST['invoice_code'])?$_POST['invoice_code']:'';
		$id               = isset($_POST['id'])?$_POST['id']:'';

		$Invoice = VInvoice::model()->searchInvoice($page,$limit,$invoice_time,$invoice_branch,$invoice_customer,$invoice_code,$id);

		$InvoiceList = $Invoice['data'];
		$count       = $Invoice['count'];
		
		$InvoiceDetail = -1;
		$paymentDetail = -1;
		$page_list = 0;
		$invoice_id = 0;

		if(!$InvoiceList) {
			$InvoiceList = -1;
		}
		else{
			$action    = 'loadInvoice';
			$param     = "'$id','$invoice_time','$invoice_branch','$invoice_customer','$invoice_code'";
			$page_list = VQuotations::model()->paging($page,$count,$limit,$action,$param);

			$first_id  = end($InvoiceList)->id;
			$last_id   = reset($InvoiceList)->id;
			
			$condition = '';
			$conPay    = '';

			if($id) {

				$invoice_id = VInvoice::model()->findAllByAttributes(array('id'=>$id));

				$condition = " id_invoice = $id OR ";
				$conPay    = " id_invoice = $id OR ";
			}

			$condition .= " $first_id <= id_invoice AND id_invoice <= $last_id ORDER BY id ";
			$InvoiceDetail = VInvoiceDetail::model()->searchInvoiceDetail($condition);

			$conPay .= " $first_id <= id_invoice AND id_invoice <= $last_id ORDER BY id_invoice, pay_date";
			$paymentDetail = Receipt::model()->searchReceipt($conPay);
		}

		$this->renderPartial('invoicesList',
			array(
				'InvoiceList'     =>$InvoiceList,
				'InvoiceDetail'   =>$InvoiceDetail,
				'paymentDetail' =>$paymentDetail,
				'page_list'       => $page_list,
				'invoice_id'      => $invoice_id,
				'invoice_type'    => $this->invoice_type,
				'count'           => $count,
				'role'=>$role, 'rolePr' => $rolePr, 'rolePay'=>$rolePay,'roleDel'=>$roleDel
				
		));
	}

	public function actionInvoicesPay()
	{
		if(isset($_POST['id_invoice']))
			$id_invoice =  $_POST['id_invoice'];
		else if(isset($_POST['Invoice']['id']))
			$id_invoice = $_POST['Invoice']['id'];
		else {
			echo "-1";
			exit;
		}

		$invoice = Invoice::model()->findByPk($id_invoice);
		$receipt = new Receipt();

		$cusMem = 0;
		$mem = CustomerMember::model()->findByAttributes(array('id_customer'=>$invoice->id_customer));
		if($mem)
			$cusMem = 1;

			
		if(isset($_POST['Receipt']) && isset($_POST['Invoice'])) {

			$trans = Yii::app()->db->beginTransaction();

			try {
				$invoice->attributes = $_POST['Invoice'];
				if(isset($_POST['Invoice']['vat']) && $_POST['Invoice']['vat']) {
					$invoice->attributes = $_POST['Invoice'];
					$invoice->vat        = $_POST['Invoice']['vat'];
				}
	
				$invoice->balance    = str_replace('.','',$_POST['Invoice']['balance']);
				$invoice->sum_amount = str_replace('.','',$_POST['Invoice']['sum_amount']);
				
				$receipt->attributes    = $_POST['Receipt'];

				$receipt->id_customer = $invoice->id_customer;
				$receipt->curr_inv = $invoice->currency_use;

				if($receipt->pay_type != 2){
					$receipt->card_val     = '';
					$receipt->card_percent = '';
					$receipt->card_type    = '';
				}
					
				if($cusMem == 1) {
					$point = CustomerMember::model()->updateMember($invoice->id_customer,'',$receipt->point);

					if($point > 0)
						$receipt->point = $point;
				}

				if($receipt->validate()) {
					$receipt->id_invoice = $invoice->id;
					
					if($invoice->save() && $receipt->save())
					{
						//$cusAmount = ;	// tien nhan tu khach (ngoai/ noi) te
						$payAcc = VPayable::model()->AddnewPayableAccount(array(
							'id_customer'  => $invoice->id_customer,      
							'description'  => 'THANH TOÁN HÓA ĐƠN SỐ '. $invoice->code,
							'amount'       => $receipt->pay_sum,	
							'currExchange' => $receipt->curr_sum,	
							'currency'     => $invoice->currency_use,	
							'order_number' => $invoice->code,	
							'id_user'      => Yii::app()->user->getState('user_id'),	
							'payment_status' => $receipt->pay_type,	
							'type'           => 0,
						));

						if($payAcc['status'] == 0){
							throw new Exception("error payable account!");
						}
						else {
							$trans->commit();
							echo $invoice->id;	
						}
					}
					else{
						throw new Exception("error receipt");
					}
				}
			}
			catch (Exception $e) {
                $trans->rollback();
                echo $e;
            }
            Yii::app()->end();
		}
		
		$this->renderPartial('invoicePay',array(
			'inv' =>	$invoice,
			'rpt' =>	$receipt,
			'cusMem'	=> $cusMem,
		));
	}

	public function actionERpt(){

		$id    = isset($_GET['id'])	?	$_GET['id']			:	false;
		$idRpt = isset($_GET['idRpt'])	?	$_GET['idRpt']	:	0;
		$lang  = isset($_GET['lang'])?	$_GET['lang']		:	'vi';

		if($id){
			$invoice  = VInvoice::model()->findByAttributes(array('id'=>$id));
			$ivDetail = VInvoiceDetail::model()->findAllByAttributes(array('id_invoice'=>$id));
			if($idRpt == 0) {
				$rpt      = Receipt::model()->findAllByAttributes(array('id_invoice'=>$id));
			}
			else
				$rpt      = Receipt::model()->findByPk($idRpt);

			$branch   = Branch::model()->findByPk($invoice->id_branch);
			$cus      = Customer::model()->findByPk($invoice->id_customer);

		   	$filename = 'PhieuThu.pdf';

		    $html2pdf 		= Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
			$html2pdf->pdf->SetTitle('Phieu thu');
		    $view = ($lang == 'vi') ? 'export_invoices' : 'export_invoices_en';

		    $html2pdf->WriteHTML($this->renderPartial($view, array('invoice'=>$invoice,'ivDetail'=>$ivDetail,'rpt'=>$rpt,'branch'=>$branch,'cus'=>$cus), true));

		    $html2pdf->Output($filename, 'I');
		}
	}
}
