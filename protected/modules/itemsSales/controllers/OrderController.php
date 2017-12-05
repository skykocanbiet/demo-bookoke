<?php

class OrderController extends Controller
{
	public $pay_type = array(
		'0' =>	'',
		'1' =>	'Tiền mặt',
		'2' =>	'Thẻ tín dụng',
		'3' =>	'Chuyển khoản'
	);
	public $txtSt = array(
		'0' =>'Báo giá',
		'1' =>'Đơn hàng',
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

	public function actionView() {
		$branch = Branch::model()->findAll();
		$branchList = CHtml::listData($branch, 'id', 'name');

		$this->render('view',array('branch'=>$branchList));
	}

	public function actionLoadOrder()
	{
		$page           = isset($_POST['page'])			?$_POST['page']	:1;
		$limit          = isset($_POST['limit'])		?$_POST['limit']	:15;
		$order_time     = isset($_POST['order_time'])	?$_POST['order_time']	:'';
		$order_branch   = isset($_POST['order_branch'])	?$_POST['order_branch']	:215;
		$order_customer = isset($_POST['order_customer'])?$_POST['order_customer']	:'';
		$order_code     = isset($_POST['order_code'])	?$_POST['order_code']	:'';
		$id             = isset($_POST['id'])			?$_POST['id']	:'';

		$Order       = VQuotations::model()->searchTreatment($page,$limit,$order_time,$order_branch,$order_customer,$order_code);
		
		$OrderList   = $Order['data'];
		$count       = $Order['count'];

		$OrderDetail = -1;
		$page_list   = 0;

		if(!$OrderList) {
			$OrderList = -1;
		}
		else{
			$action      = 'loadOrder';
			$param       = "'$id','$order_time','$order_branch','$order_customer','$order_code'";
			$page_list   = VQuotations::model()->paging($page,$count,$limit,$action,$param);
			
			$first_id    = end($OrderList)->id;
			$last_id     = reset($OrderList)->id;
			
			$condition   = " $first_id <= id_quotation AND id_quotation <= $last_id AND status = 1";
			
			$OrderDetail = VQuotationDetail::model()->searchQuotationDetail($condition);
		}

		$this->renderPartial('orderList',
			array(
				'orderList'   =>$OrderList,
				'orderDetail' =>$OrderDetail,
				'page_list'   =>$page_list,
		));
	}

	public function actionViewOrder()
	{
		$id_order = isset($_POST['id_order'])?$_POST['id_order']:false;
		$id_invoice = isset($_POST['id_invoice'])?$_POST['id_invoice']:false;

		if(!$id_order) {
			echo "-1";		// ko có mã đơn hàng
			exit;
		}

		$order = VOrder::model()->findByAttributes(array('id'=>$id_order));
		$orderDetail = VOrderDetail::model()->findAllByAttributes(array('id_order'=>$id_order));
		if($id_invoice)
			$paymentDetail = InvoicePayment::model()->findAllByAttributes(array('id_invoice'=>$id_invoice),array('order'=>'id DESC'));
		else
			$paymentDetail = 0;

		$this->renderPartial('view_order',array(
			'order'	=> $order,
			'orderDetail'=>$orderDetail,
			'paymentDetail'=>$paymentDetail,
			'pay_type'	=> $this->pay_type,
		));
	}

	// đơn hàng chưa thanh toán
	public function actionDeleteOrder() {
		$id_order = isset($_POST['id_order'])?$_POST['id_order']:false;
		$id_quotation = isset($_POST['id_quotation'])?$_POST['id_quotation']:false;

		$trans = Yii::app()->db->beginTransaction();
		try {
			$delOrder = Order::model()->updateByPk($id_order,array('status'=>-1));
			$delOrderDetail = OrderDetail::model()->updateAll(array('status'=>-1),"id_order = $id_order");

			$updateQuote = QuotationService::model()->updateAll(array('status'=>0),"id_quotation = $id_quotation AND status = 1");

			if($delOrder && $delOrderDetail && $updateQuote)
				echo 1;			// xóa thành công

			$trans->commit();
		}
		catch (Exception $e) {
			$trans->rollback();
           	echo $e;			// error process
        }
	}
	public function actionExportOrder(){

		$id_order = isset($_GET['order'])	?	$_GET['order']	:	false;

		if($id_order){

		   	$order 			= VOrder::model()->findByAttributes(array('id'=>$id_order));
		   	$orderDetail 	= VOrderDetail::model()->findAllByAttributes(array('id_order'=>$id_order));
		   	$branch 		= Branch::model()->findByPk($order->id_branch);
		   	$cus 			= Customer::model()->findByPk($order->id_customer);

		   	$filename = 'DonHang.pdf';

		    $html2pdf 		= Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
		    $html2pdf->pdf->SetTitle('Don hang');
		    $html2pdf->WriteHTML($this->renderPartial('export_order', array('order'=>$order,'orderDetail'=>$orderDetail,'branch'=>$branch,'cus'=>$cus), true));

		    $html2pdf->Output($filename, 'I');
		}
	}

	public function actionPrintTreatment()
	{
		$id_customer      = isset($_GET['id_customer']) ? $_GET['id_customer'] : '';
		$id_group_history = isset($_GET['id_group_history']) ? $_GET['id_group_history'] : '';

		if(!$id_customer || !$id_group_history){
			exit;
		}

		$quotation = VQuotations::model()->findByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_group_history));
		$treatment = VQuotations::model()->getListTreatmentOfQuotation(1, 20, $id_customer, $id_group_history);
		$customer  = Customer::model()->findByPk($id_customer);
		$branch    = Branch::model()->findByPk(Yii::app()->user->getState('user_branch'));

		if(!$quotation || $treatment['numRow'] == 0 || !$customer)
		{
			exit;
		}
		else
		{
			$filename = 'Dieutri.pdf';

		    $html2pdf 		= Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
		    $html2pdf->pdf->SetTitle('Dieu Tri');
		    $html2pdf->WriteHTML($this->renderPartial('printTreatment', array('treatment'=>$treatment['data'],'branch'=>$branch,'cus'=>$customer, 'id_group_history' => $id_group_history,'quote'=>$quotation), true));

		    $html2pdf->Output($filename, 'I');
		}
	}

	public function actionUpdateOrder()
	{
		$id_order = isset($_POST['id_order']) ? $_POST['id_order'] : false;

		if($id_order) {
			$order = VOrder::model()->findByAttributes(array('id'=>$id_order));

			$criteria            =new CDbCriteria;
			$criteria->condition = "id_order = $id_order AND status >= 0";
			$orderDetailOld      = VOrderDetail::model()->findAll($criteria);

			$orderNew = new OrderDetail();
			
			$count    = count($orderDetailOld);

			$branch     = Branch::model()->findAll();
			$branchList = CHtml::listData($branch, 'id', 'name');

			$this->renderPartial('update',
				array(
					'order'          =>$order,
					'orderDetailOld' =>$orderDetailOld,
					'orderNew'       =>$orderNew,
					'branchList'     =>$branchList,
					'i'              =>$count,
				));
		}
		elseif (isset($_POST['VOrder'])) {
			
			$orderDetails       = array();		// chi tiết don hang mới
			$check              = true;
			$id_order           = $_POST['VOrder']['id'];
			
			$invoice_details    = array();		// mang chi tiet hoa don
			$check_invoice_new  = false;		// kiem tra don hang
			$order_new_validate = true;
			$sum                = 0;
			$tax                = 0;

			// thong tin bao gia cu
			$order = Order::model()->findByPk($id_order);
			$order->attributes 	=	$_POST['VOrder'];

			$order->create_date = date('Y-m-d',strtotime(str_replace('/', '-',$_POST['VOrder']['create_date'])));
			$order->complete_date = date('Y-m-d',strtotime(str_replace('/', '-',$_POST['VOrder']['complete_date'])));

			// chi tiet don hang cu cu
			if(isset($_POST['VOrderDetail'])){
				
				foreach ($_POST['VOrderDetail'] as $key => $order_detail_old) {
					if ($order_detail_old['order_old'] != 1) {
						// cap nhat du lieu don hang cu
						$id = $order_detail_old['id'];
						$order_detail = OrderDetail::model()->findByPk($id);

						$order_detail->attributes = $order_detail_old;

						// thay doi status cho don hang cu (xoa)
						if($order_detail_old['del']==1) {
							$order_detail->status = -1;	
						}

						// xac thuc don hang cu va luu mang
						if(!$order_detail->validate())
							$order_new_validate = false;
						else 
							$orderDetails[] = $order_detail;

						// ton tai trang thai chi tiet don hang = 1 (ap dung)
						if($order_detail['status'] == 1) {
							$check_invoice_new = true;		// co hoa don

							// luu chi tiet thanh mang hoa don
							$invoice = new InvoiceDetail();
							$invoice->attributes = $order_detail->attributes;

							$invoice_details[] = $invoice;

							$sum += (int)$invoice->amount;
							$tax += (int)$invoice->tax;
						}
					}		
				}
			}

			// chi tiet don hang moi
			if(isset($_POST['OrderDetail'])) {
				foreach ($_POST['OrderDetail'] as $key => $order_detail) {
					// luu chi tiet don hang moi
					$order_detail_new             = new OrderDetail();
					$order_detail_new->attributes = $order_detail;
					$order_detail_new->id_order   = $id_order;

					// xac thuc don hang moi va luu vao mang
					if(!$order_detail_new->validate())
						$order_new_validate = false;
					else 
						$orderDetails[] = $order_detail_new;

					// trang thai chi tiet don hang = 1 (ap dung)
					if($order_detail_new['status'] == 1) {
						$check_invoice_new = true;		// co hoa don

						// luu chi tiet mang hoa don
						$invoice = new InvoiceDetail();
						$invoice->attributes = $order_detail_new->attributes;

						$invoice_details[] = $invoice;

						$sum += (int)$invoice->amount;
						$tax += (int)$invoice->tax;
					}
				}
			}


			// xac thuc bao gia va chi tiet bao gia
			if($order_new_validate && $order->validate()) {
				$trans = Yii::app()->db->beginTransaction();

				try {
					$order->save();		// luu bao gia

					foreach ($orderDetails as $key => $value) {
						$value->save();		// luu chi tiet bao gia
					}

					// kiem tra co hoa don?
					if($check_invoice_new) {

						// luu hoa don
						$invoice_new             = new Invoice();
						$invoice_new->attributes = $order->attributes;
						$invoice_new->id_order   = $id_order;
						$invoice_new->code_order = $order->code;
						$invoice_new->sum_amount = $sum;
						$invoice_new->sum_tax    = $tax;
						$invoice_new->sum_no_vat = $invoice_new->sum_amount;
						$invoice_new->balance    = $invoice_new->sum_amount;
						$invoice_new->code       = Invoice::model()->createCodeInvoice();

						$invoice_new->code = Invoice::model()->createCodeInvoice();
						
						// xac thuc va luu hoa don
						if($invoice_new->validate())
							$invoice_new->save();

						// luu chi tiet hoa don
						foreach ($invoice_details as $key => $value) {
							$value->id_invoice = $invoice_new->id;
							$value->save();
						}
					}
				
					$trans->commit();
				}
				catch (Exception $e) {
                    $trans->rollback();
                    $check = false;
                   	echo "-1";		// thất bại

                   	Yii::app()->end();
                }

                if($check) {
                	echo 1;			// thành công

                	Yii::app()->end();
                }
			}
		}
	}

	public function actionCreateOrder()
	{
		$id_customer      = isset($_POST['id_customer'])?$_POST['id_customer']:'';
		$id_group_history =	isset($_POST['id_mhg'])?$_POST['id_mhg']:'';
		$id_schedule      =	isset($_POST['id_schedule'])?$_POST['id_schedule']:'';
		
		$id_service = isset($_POST['id_service'])?$_POST['id_service']:'';
		$service    = '';

		if($id_service) {
			$service = 	CsService::model()->findByPk($id_service)->attributes;
		}

		$id_user   = 	Yii::app()->user->getState('user_id');
		$user_name = 	Yii::app()->user->getState('user_name');

		$order       = 	new Order();
		$orderDetail = 	new OrderDetail();

		if(isset($_POST['Order'])) {
			$order_items         = array();
			$invoice_items       = array();
			$order_item_validate = true;
			$check_invoice       = false;
			$save_all            = true;
			$sum_order           = 0;
			$tax_order           = 0;
			
			$order->attributes    = $_POST['Order'];
			$order->create_date   = date('Y-m-d',strtotime(str_replace('/', '-',$_POST['Order']['create_date'])));
			$order->complete_date = date('Y-m-d',strtotime(str_replace('/', '-',$_POST['Order']['complete_date'])));


			if(!isset($_POST['Order']['id_quotation'])) {
				$group_his = Customer::model()->checkTreatment($_POST['Order']['id_customer']);

				if(!$group_his) {
					$id_group_his = Customer::model()->addTreatment($_POST['Order']['id_customer']);
				}
				else
					$id_group_his = $group_his->id;

				$order->id_group_history = $id_group_his;
			}

			if(isset($_POST['OrderDetail'])) {
				foreach ($_POST['OrderDetail'] as $key => $quote_item) {
					$orderDetail             = new OrderDetail();
					$orderDetail->attributes = $quote_item;

					if(!$orderDetail->validate()) {
						$order_item_validate = false;
					}
					else {
						$order_items[] = $orderDetail;

						// kiem tra co check ap dung ko?
						if($orderDetail->status == 1) {
							$check_invoice 				= true;
							
							$invoiceDetail             = new InvoiceDetail();
							$invoiceDetail->attributes = $orderDetail->attributes;
							$invoiceDetail->status     = 0;

							$sum_order 	+= (int)$orderDetail->amount;
							$tax_order 	+= (int)$orderDetail->tax;

							$invoice_items[] 	= $invoiceDetail;
						}
					}
				}	
			}
			
			if($order_item_validate && $order->validate()) {
				$trans = Yii::app()->db->beginTransaction();

				try {
					// luu bao gia
					$codeOrder 		= Order::model()->createCodeOrder();
					$order->code 	= $codeOrder;

					// luu id bao gia vao lich hen
					if($_POST['Order']['id_schedule']) {
						$upSchquo = CsSchedule::model()->updateSchedule(array(
							'id'			=>	$_POST['Order']['id_schedule'],
							'id_quotation'	=>	$order->id,
						));
					}

					$order->save();		// luu bao gia
					
					// luu chi tiet don hang
					foreach ($order_items as $order_item) {
						$order_item->id_order  = $order->id;
						$order_item->id_author = $order->id_author;
						$order_item->save();

					}


					// kiem tra hoa don
					if($check_invoice) {
						// luu hoa don
						$iv             = new Invoice();
						$iv->attributes = $order->attributes;
						$iv->id_order   = $order->id;
						$iv->code_order = $order->code;
						$iv->sum_amount = $sum_order;
						$iv->sum_tax    = $tax_order;
						$iv->sum_no_vat = $iv->sum_amount;
						$iv->balance    = $iv->sum_amount;
						$codeIv         = Invoice::model()->createCodeInvoice();
						$iv->code       = $codeIv;

						$iv->save();		// luu don hang

						// luu chi tiet hoa don
						foreach ($invoice_items as $ivIt) {
							$ivIt->id_invoice = $iv->id;
							$ivIt->save();
						}
					}

					$trans->commit();
				}
				catch (Exception $e) {
                    $trans->rollback();
                    $save_all 	= false;
                    echo "-1";		// thất bại

                   	Yii::app()->end();
                }

                if ($save_all) {
                    echo "1";
                   	Yii::app()->end();
                }
			}
		}

		$this->renderPartial('create',
			array(
				'order'            =>	$order,
				'orderDetail'      =>	$orderDetail,
				'id_customer'      =>	$id_customer,
				'service'          =>	$service,
				'user'             =>	array($id_user=>$user_name),
				'id_group_history' =>	$id_group_history,
				'id_schedule'      =>	$id_schedule
			));
	}
}
