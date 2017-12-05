<?php

class QuotationsController extends Controller
{
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

	public function loadModel($id) 
    { 
        $model=VQuotations::model()->findByAttributes(array('id'=>$id)); 
        if($model===null) 
            throw new CHttpException(404,'The requested page does not exist.'); 
        return $model; 
    } 

	public function actionView() {
		$group_id =  Yii::app()->user->getState('group_id');
		$role    = 1; 	// xem tat ca bao gia
		$roleNew = 0;	// tao moi
		$roleUp  = 0;	// cap nhat lich hen
		$roleDel = 0;	// xoa lich

		switch ($group_id) {
			case Yii::app()->params['id_group_dentist']:
				$roleNew = 1;
				$roleUp = 1;
				break;			
			case Yii::app()->params['id_group_admin']:
			case Yii::app()->params['id_group_subadmin']:
				$roleDel = 1;
				$roleNew = 1;
				$roleUp  = 1;
				break;
		}

		$branch = Branch::model()->findAll();
		$branchList = CHtml::listData($branch, 'id', 'name');

		$this->render('view',array('branch'=>$branchList, 'role'=>$role, 'roleNew'=>$roleNew, 'roleUp'=> $roleUp,'roleDel'=>$roleDel));
	}
/*****Tao bao gia******/
	public function actionCreate()
	{	
		$group_id =  Yii::app()->user->getState('group_id');
		$roleNew = 0;	// tao moi

		switch ($group_id) {
			case Yii::app()->params['id_group_dentist']:
				$roleNew = 1;
				break;
			case Yii::app()->params['id_group_admin']:
			case Yii::app()->params['id_group_subadmin']:
				$roleNew = 1;
				break;
		}

		$id_customer      = isset($_POST['id_customer'])	?	$_POST['id_customer']:'';
		$id_group_history =	isset($_POST['id_mhg'])	?	$_POST['id_mhg']:'';
		$id_schedule      = isset($_POST['id_schedule'])	?	$_POST['id_schedule']:'';
		$teeth      = isset($_POST['teeth'])		?	$_POST['teeth']:'';
		$id_user_dt = isset($_POST['id_user'])		?	$_POST['id_user']:'';
		$id_service = isset($_POST['id_service'])  ?	$_POST['id_service']:'';
		$user_dt    = array();
		$cus_Seg    = array();

		if($id_user_dt) {
			$user_dt = array($id_user_dt=>GpUsers::model()->findByPk($id_user_dt)->name);
		}
		
		$service = '';

		if($id_service) {
			$service = 	CsService::model()->findByPk($id_service)->attributes;
		}
		else if($id_schedule){
			$sch     = VSchedule::model()->findByAttributes(array('id'=>$id_schedule));
			$service = 	CsService::model()->findByPk($sch->id_service)->attributes;

			if(!$id_user_dt){
				$user_dt = array($sch->id_dentist=>$sch->name_dentist);
			}
		}

		if($id_customer){
			$cus_Seg = Quotation::model()->getCusSeg($id_customer);
		}

		$quote          = 	new Quotation();
		$quote_services = 	new QuotationService();

		// tao moi bao gia
			if(isset($_POST['Quotation']) && isset($_POST['QuotationService'])) {
				$trans = Yii::app()->db->beginTransaction();
				$acpt       = 1;
				$id_quote   = '';
				$id_order   = '';
				$id_invoice = '';
				try 
				{
					$id_schedule = isset($_POST['Quotation']['id_schedule']) ? $_POST['Quotation']['id_schedule']: '';
					// tao bao gia
					$quote = Quotation::model()->addQuote($_POST['Quotation'], $_POST['QuotationService']);

					if($quote['status'] == 1) {
						$id_quote = $quote['quote']['id'];
						// kiem tra co thong tin don hang khong
						if($quote['checkOrder'] == 1)	
						{
							$order                   = $quote['quote'];
							$order['id_quotation']   = $order['id'];
							$order['code_quotation'] = $order['code'];
							$orderDetails = $quote['orderDetails'];
							$orders       = Order::model()->addOrder($order, $orderDetails);

							if($orders['status'] == 1) {
								$id_order = $orders['order']['id'];
								// kiem tra thong tin hoa don
								if($orders['checkInvoice'] == 1) {
									$invoice                = $orders['order'];
									$invoice['id_schedule'] = $id_schedule;
									$invoice['id_order']    = $invoice['id'];
									$invoice['code_order']  = $invoice['code'];
									$invoiceDetails = $orders['invoiceDetails'];
									$inv = Invoice::model()->addInvoice($invoice, $invoiceDetails);

									if($inv['status'] == 0)
										$acpt = 0;
									else 
										$id_invoice = $inv['invoice']['id'];
								}
							} else $acpt = 0;
						}
					}  else $acpt = 0;

					if($acpt == 0) {
						throw new Exception('Error');
					}
					elseif ($id_quote && $id_schedule) {
						$upSchquo = CsSchedule::model()->updateSchedule(array(
								'id'			=>	$id_schedule,
								'id_quotation'	=>	$id_quote,
								'id_invoice'	=> 	$id_invoice,
							));
					}

					$trans->commit();
				}
				catch (Exception $e) {
	                echo "0";
	                $trans->rollback();
	            }
	            echo $acpt;
	            Yii::app()->end();
			}
		$this->renderPartial('create',
			array(
				'quote'            => $quote,
				'quote_services'   => $quote_services,
				'i'                => 1,
				'id_customer'      => $id_customer,
				'service'          => $service,
				'id_group_history' => $id_group_history,
				'id_schedule'      => $id_schedule,
				'teeth'            => $teeth,
				'user_dt'          => $user_dt,
				'roleNew'          => $roleNew,
				'cus_Seg'          => $cus_Seg,
			));
	}
/*****Lay danh sach khach hang******/
	public function actionGetCustomerList()
	{
		$page = isset($_POST['page'])?$_POST['page']:1;
		$search = isset($_POST['q'])?$_POST['q']:'';

	    $item = 30;

	    $search_params= 'AND (`fullname` LIKE "%'.$search.'%" ) OR (`code_number` LIKE "%'.$search.'%" ) OR (`phone` LIKE "%'.$search.'%" )';
	    
	    $customerList = Customer::model()->searchCustomers('','',' '.$search_params,$item,$page);
	    if(!$customerList)
	    {
	    	echo -1;exit();
	    }
		foreach ($customerList['data'] as $key => $value) {
			$customer[] = array(
				'id' => $value['id'],
				'text' => $value['fullname'],
			);
		}
		echo json_encode($customer);
	}
/*****Lay danh sach dich vu ******/
	public function actionGetServicesList() 
	{
		$page   = isset($_POST['page'])	?	$_POST['page']:1;
		$search = isset($_POST['q'])	?	$_POST['q']:'';
		$id_prB = isset($_POST['id_prB'])	?	$_POST['id_prB']:'';
	
		if($id_prB) {
			$servicesList = PricebookService::model()->searchPriceBookServices($page,40,$id_prB,$search);
		}
		else {
	    	$servicesList = CsService::model()->service_list_pagination($page,40,0,$search);
		}

		$services = array();
	   	  
	   	if($servicesList['numRow'] > 0){
			foreach ($servicesList['data'] as $key => $value) {
				$services[] = array(
					'id'    => isset($value['id_service']) ? $value['id_service'] : $value['id'],
					'text'  => $value['name'],
					'price' => $value['price'],
					'tax'   => $value['tax'],
				);
			}
	   	}
		
		echo json_encode($services);
	}
/*****Lay danh sach nha sy******/
	public function actionGetDentistList2() 
	{
		$page   = isset($_POST['page'])?$_POST['page']:1;
		$search = isset($_POST['q'])?$_POST['q']:'';
		$group  =  isset($_POST['group'])?$_POST['group']:0;
		
		$item   = 30;

		$search_params = 'AND (`name` LIKE "%'.$search.'%" ) ';

		if($group)
			$search_params .= ' AND group_id = '. $group;
		
		$dentistList   = GpUsers::model()->searchStaffs('','',' '.$search_params,$item,$page);
		
	    $dentist = array();

		foreach ($dentistList['data'] as $key => $value) {
			$dentist[] = array(
				'id' => $value['id'],
				'text' => $value['name'],
			);
		}
		echo json_encode($dentist);
	}

/*****Lay danh sach san pham******/
	public function actionGetProductList() 
	{
		$page = isset($_POST['page'])?$_POST['page']:1;
		$search = isset($_POST['q'])?$_POST['q']:'';
	    
	    $productList = Product::model()->searchProduct($page,0,$search);

	    if(!$productList)
	    {
	    	echo -1;exit();
	    }
		foreach ($productList as $key => $value) {
			$product[] = array(
				'id' => $value['id'],
				'text' => $value['name'],
				'price'=> $value['price'],
				'tax'	=>$value['tax'],
			);
		}
		
		echo json_encode($product);
	}
/*****Xem thong tin bao gia******/
	public function actionLoadQuotation()
	{
		$group_id =  Yii::app()->user->getState('group_id');
		$roleDel = 0;	// xoa lich

		switch ($group_id) {
			case Yii::app()->params['id_group_admin']:
			case Yii::app()->params['id_group_subadmin']:
				$roleDel = 1;
				break;
		}

		$page           = isset($_POST['page'])?$_POST['page']:1;
		$limit          = isset($_POST['limit'])?$_POST['limit']:15;
		$quote_time     = isset($_POST['quote_time'])?$_POST['quote_time']:'';
		$quote_branch   = isset($_POST['quote_branch'])?$_POST['quote_branch']:1;
		$quote_customer = isset($_POST['quote_customer'])?$_POST['quote_customer']:'';
		$quote_code     = isset($_POST['quote_code'])?$_POST['quote_code']:'';
		$id             = isset($_POST['id'])?$_POST['id']:'';

		$quotation = VQuotations::model()->searchQuotation($page,$limit,$quote_time,$quote_branch,$quote_customer,$quote_code);

		$quotationList = $quotation['data'];
		$count = $quotation['count'];
		
		$quotationDetail = -1;
		$page_list = 0;

		if(!$quotationList) {
			$quotationList = -1;
		}
		else{
			$action = 'loadQuotation';
			$param = "'$id','$quote_time','$quote_branch','$quote_customer','$quote_code'";

			$page_list = VQuotations::model()->paging($page,$count,$limit,$action,$param);

			$first_id = end($quotationList)->id;
			$last_id = reset($quotationList)->id;

			$condition = " $first_id <= id_quotation AND id_quotation <= $last_id AND status >= 0";

			$quotationDetail = VQuotationDetail::model()->searchQuotationDetail($condition);
		}

		$this->renderPartial('quotationList',
			array(
				'quotationList'=>$quotationList,
				'quotationDetail'=>$quotationDetail,
				'page_list' => $page_list,
				'roleDel' => $roleDel,
		));
	}
/*****Cap nhat bao gia******/
	public function actionUpdateQuotation()
	{
		$group_id =  Yii::app()->user->getState('group_id');
		$roleUp  = 0;	// cap nhat lich hen

		switch ($group_id) {
			case Yii::app()->params['id_group_dentist']:
				$roleUp = 1;
				break;
			case Yii::app()->params['id_group_admin']:
			case Yii::app()->params['id_group_subadmin']:
				$roleUp  = 1;
				break;
		}

		$id_quotation = isset($_POST['id_quotation']) ? $_POST['id_quotation'] : false;
		$teeth        = isset($_POST['teeth']) ? $_POST['teeth'] : '';
		$id_schedule  = isset($_POST['id_schedule']) ? $_POST['id_schedule'] : '';

	// hien thi form bao gia
		if($id_quotation) {
			$NowCusSeg = "";
			$quote    = VQuotations::model()->findByAttributes(array('id'=>$id_quotation));

			if($quote->id_customer){
				$NowCusSeg = Quotation::model()->getCusSeg($quote->id_customer);
			}
			
			$criteria = new CDbCriteria;
			$criteria->condition = "id_quotation = $id_quotation AND status >= 0";
			$criteria->order= 'status';

			$quote_services = VQuotationDetail::model()->findAll($criteria);
			$quote_up       = new QuotationService();

			$count      = count($quote_services);
			$branch     = Branch::model()->findAll();
			$branchList = CHtml::listData($branch, 'id', 'name');

			$this->renderPartial('update',
				array(
					'quote'          => $quote,
					'quote_services' => $quote_services,
					'quote_up'       => $quote_up,
					'branchList'     => $branchList,
					'i'              => $count,
					'teeth'          => $teeth,
					'id_schedule'    => $id_schedule,
					'roleUp'         => $roleUp,
					'NowCusSeg'   => $NowCusSeg,
				));
		}
	// cap nhat thong tin bao gia
		elseif (isset($_POST['VQuotations'])) {
			$infoQuote = isset($_POST['VQuotations']) ? $_POST['VQuotations']: array();
			$newDetail = isset($_POST['QuotationService']) ? $_POST['QuotationService']: array();
			$oldDetail = isset($_POST['VQuotationDetail']) ? $_POST['VQuotationDetail']: array();

			if($infoQuote['id_note']){
				$note = CustomerNote::model()->updatenote($infoQuote['id_note'],$infoQuote['note']);
			}
			else if(!$infoQuote['id_note'] && $infoQuote['note']) {
				$note = CustomerNote::model()->addnote(array(
                        'note'        => $infoQuote['note'],
                        'id_user'     => $infoQuote['id_author'],
                        'id_customer' => $infoQuote['id_customer'],
                        'flag'        => 2,         // 2: báo giá
                        'important'   => 0,
                        'status'      => 1,
                ));

                $infoQuote['id_note'] = $note['id'];
			}

			$quote = Quotation::model()->updateQuote($infoQuote,$oldDetail,$newDetail);

			if($quote['status'] != 1){
				echo json_encode(array('status'=>0, 'error'=>'quotation'));
				exit;
			}

			$infoOrder = $infoQuote;
			$infoOrder['id_quotation'] = $infoQuote['id'];
			unset($infoOrder['id']);

			$order = array();

			if($quote['checkOrderOld'] == 1){
				$order = Order::model()->updateOrder($infoOrder, $quote['orderDetails']);
			}
			elseif($quote['checkOrderNew'] == 1){
				$order = Order::model()->addOrder($infoOrder, $quote['orderDetails']);
			}

			if(!empty($order['invoiceDetails'])){
				$invoice                 = $order['order'];
				$invoice['id_schedule']  = $id_schedule;
				$invoice['id_order']     = $invoice['id'];
				//$invoice['id_quotation'] = $infoQuote['id'];
				$invoice['code_order']   = $invoice['code'];

				$inv = Invoice::model()->addInvoice($invoice, $order['invoiceDetails']);
			}

			if ($id_schedule && $inv['status'] == 1) {
				$id_quote = $infoQuote['id'];
				$id_invoice = $inv['invoice']['id'];
				$id_schedule = $infoQuote['id_schedule'];	

				$upSchquo = CsSchedule::model()->updateSchedule(array(
						'id'			=>	$id_schedule,
						'id_quotation'	=>	$id_quote,
						'id_invoice'	=> 	$id_invoice,
					));
			}

			echo 1;
		}
	}
/*****Xoa bao gia******/
	// báo giá có đơn hàng ko dc xóa
	public function actionDeleteQuotation() {
		$id_quotation = isset($_POST['id_quotation'])?$_POST['id_quotation']:false;

		if(!$id_quotation) {
			echo 0;			// ko có mã báo giá
			exit;
		}

		$trans = Yii::app()->db->beginTransaction();
		try {
			$delQuote = Quotation::model()->updateByPk($id_quotation,array('status'=>-1));
			$delQuoteDetail = QuotationService::model()->updateAll(array('status'=>-1),"id_quotation = $id_quotation");

			if($delQuote && $delQuoteDetail)
				echo 1;			// xóa thành công

			$trans->commit();
		}
		catch (Exception $e) {
			$trans->rollback();
           	echo $e;			// error process
        }
	}
/*****In bao gia******/
	public function actionExportQuatation(){

		$id_quotation = isset($_GET['id_quote'])	?	$_GET['id_quote']	:	false;

		if($id_quotation){

		   	$quotation 		= VQuotations::model()->findByAttributes(array('id'=>$id_quotation));
		   	$quoteDetail 	= VQuotationDetail::model()->findAllByAttributes(array('id_quotation'=>$id_quotation));
		   	$branch 		= Branch::model()->findByPk($quotation->id_branch);
		   	$cus 			= Customer::model()->findByPk($quotation->id_customer);

		   	$filename = 'Baogia.pdf';

		    $html2pdf 		= Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
		    $html2pdf->pdf->SetTitle('Bao gia');
		    $html2pdf->WriteHTML($this->renderPartial('export_quote', array('quotation'=>$quotation,'quoteDetail'=>$quoteDetail,'branch'=>$branch,'cus'=>$cus), true));

		    $html2pdf->Output($filename, 'I');
		}
	}
/*****Lay danh sach Khuyen mai ******/
	public function actionGetPromotionList()
	{
		$pro = Promotion::model()->getActivePromotion();

		$proList = array();

		if($pro) {
			foreach ($pro as $key => $value) {
				$proList[] = $value->attributes;
			}
		}

		echo json_encode($proList);
	}
/*****Lay thong tin nhom khach hang******/
	public function actionGetCustomerSegment()
	{
		$id_customer = isset($_POST['id_customer'])	?	$_POST['id_customer']	:	false;
		
		$cusSegList = array();
		$cusSeg      = Quotation::model()->getCusSeg($id_customer);

		echo json_encode($cusSeg);
	}
/*****kiem tra dich vu theo nhom khach hang******/
	public function actionCheckSVPD()
	{
		$data   = isset($_POST['data'])	?	$_POST['data']	:	false;
		$id_seg = isset($_POST['id_seg'])	?	$_POST['id_seg']	:	false;

		if(!$id_seg) {
			echo "-1";
			exit;
		}
		$priceBook = PriceBook::model()->findByAttributes(array('id_segment'=>$id_seg));

		if($priceBook) {
			$text = 'id_service';
			$con = "id_pricebook = ". $priceBook->id . " AND (";
		}
		else{
			$text = 'id';
			$con = '(';
		}

		$f = true;
		foreach ($data as $key => $value) {
			if($f == true){
				$con .= " $text = '$value' ";
				$f = false;
			}
			else
				$con .= " OR $text = '$value' ";
		}
		$con .= ')';

		if($priceBook) {
			$rs = PricebookService::model()->findAll(array(
				'select' => '*',
				'condition' => $con,
			));
		}
		else {
			$rs = CsService::model()->findAll(array(
				'select' => '*',
				'condition' => $con,
			));
		}


		$segSVPD = array();

		if($rs) {
			foreach ($rs as $key => $value) {
				$segSVPD[] = array(
					'id'    => isset($value['id_service']) ? $value['id_service'] : $value['id'],
					'name'  => $value['name'],
					'price' => $value['price'],
					'tax'   => $value['tax'],
				);
			}
		}

		echo json_encode($segSVPD);
	}
/*****Lay thong tin bang gia******/
	public function actionGetPriceBook()
	{
		$id_seg   = isset($_POST['id_seg'])	?	$_POST['id_seg']	:	false;

		if(!$id_seg){
			echo "0";
			exit;
		}

		$now = date('Y-m-d H:i:s');

		$priceBook = PriceBook::model()->find(array(
			'select'	=> '*',
			'condition'	=> "id_segment = $id_seg AND effect = 1 AND ((start_time <= '$now' AND '$now' <= end_time) OR (start_time = '0000-00-00 00:00:00'))"
		));

		if($priceBook)
			echo json_encode($priceBook->attributes);
		else 
			echo "0";
	}
}