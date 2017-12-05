<?php

class ReportingFinanceController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='/layouts/main_sup';

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

	public function actionView()
	{
		$model = new Branch();
		$this->render('view',array("model"=>$model));
	}
	public function actionChangeBranch()
    {
        if (isset($_POST['dataBranch']) && $_POST['dataBranch']) {
            $listdata     = array();
            $listdata[""] = "Tất cả";
            $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3,'id_branch'=>$_POST['dataBranch']));
            foreach($User as $temp){
                $listdata[$temp['id']] =  $temp['name'];
            }
            echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control'));
        }
        else{
            $listdata     = array();
            $listdata[""] = "Tất cả";
            $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
            foreach($User as $temp){
                $listdata[$temp['id']] =  $temp['name'];
            }
            echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control'));
        }
        
    }
	
	public function actionTypeReport()
	{ 

		$page = isset($_POST['page'])?$_POST['page']:1;
		$limit = isset($_POST['limit'])?$_POST['limit']:100;
		$search_time = isset($_POST['search_time'])?$_POST['search_time']:'';
		$search_branch = isset($_POST['branch'])?$_POST['branch']:'';
		$search_user = isset($_POST['lstUser'])?$_POST['lstUser']:'';
		$search_type = isset($_POST['type'])?$_POST['type']:'';
		$fromtime = isset($_POST['fromtime'])?$_POST['fromtime']:'';
		$totime = isset($_POST['totime'])?$_POST['totime']:'';
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);

		if ($_POST['type']==0) 
		{
			$this->renderPartial("sales_reports",array('branch'=>$search_branch,'user'=>$search_user,'search_time'=>$search_time,'fromtime'=>$fromtime,'totime'=>$totime));
		}
		else if($_POST['type']==1)
		{	//search receipt

			$receipt = VReceipt::model()->search_receipt($page,$limit,$search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$receiptList = $receipt['data'];
			
			$count = $receipt['count'];
			$page_list = 0;
			if(!$receiptList) {
				$receiptList = -2;
			}
			//export
			$receipt_export = VReceipt::model()->search_exportReceipt($search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$exportList = $receipt_export['data'];
			if(!$exportList) {
				$exportList = -2;
			}
			$this->renderPartial("transaction_summary",array( 'receiptList'=>$receiptList,'count'=>$count,'exportList'=>$exportList,'title_report'=>$title_report));
		}
		else if ($_POST['type']==2) {
		//search invoice
			$invoice = VInvoice::model()->search_invoicedetail($page,$limit,$search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$invoiceList = $invoice['data'];
			$count = $invoice['count'];
			if(!$invoiceList) {
				$invoiceList = -2;
			}
			//export
			$invoice_export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$exportList = $invoice_export['data'];

			$this->renderPartial("invoice_detail",array('invoiceList'=>$invoiceList,'count'=>$count, 'exportList'=>$exportList,'title_report'=>$title_report));
		}

		else if ($_POST['type']==3) {
		//search invoice
			$invoice = VInvoice::model()->search_invoicedetail($page,$limit,$search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$invoiceList = $invoice['data'];
			$count = $invoice['count'];
			if(!$invoiceList) {
				$invoiceList = -2;
			}
			//export
			$invoice_export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,'',$fromtime,$totime);
			$exportList = $invoice_export['data'];
			$this->renderPartial("unpaid_invoice",array('invoiceList'=>$invoiceList,'count'=>$count,'exportList'=>$exportList,'title_report'=>$title_report));
		}
		
	}

	public function actionExportPrint()
	{ 
		
		$search_time = isset($_GET['search_time'])?$_GET['search_time']:false;
		$search_branch = isset($_GET['branch'])?$_GET['branch']:false;
		$search_user = isset($_GET['lstUser'])?$_GET['lstUser']:false;
		$search_type = isset($_GET['type'])?$_GET['type']:false;
		$fromtime = isset($_GET['fromtime'])?$_GET['fromtime']:false;
		$totime = isset($_GET['totime'])?$_GET['totime']:false;
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);
		if ($search_type==0) 
		{
	    	
	    }
	    elseif($search_type==1)
	    {	
	    	$export = VReceipt::model()->search_exportReceipt($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);

			$exportList = $export['data'];
			$filename = 'TransactionSummary.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
	    	$html2pdf->WriteHTML($this->renderPartial('export_summary', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	$html2pdf->Output($filename, 'I');
	    }

	    elseif($search_type==2)
	    {
	    	$export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);

			$exportList = $export['data'];

			$filename = 'InvoiceDetails.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
	    	$html2pdf->WriteHTML($this->renderPartial('export_invoicedetail', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	 $html2pdf->Output($filename, 'I');
	    }

	    elseif($search_type==3)
	    {	$export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
			$exportList = $export['data'];
			$filename = 'UnpaidInvoice.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);

	    	$html2pdf->WriteHTML($this->renderPartial('export_unpaid', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	 $html2pdf->Output($filename, 'I');
	    }
	   
	}

	public function actionExportPDF()
	{ 
		$search_time = isset($_GET['search_time'])?$_GET['search_time']:false;
		$search_branch = isset($_GET['branch'])?$_GET['branch']:false;
		$search_user = isset($_GET['lstUser'])?$_GET['lstUser']:false;
		$search_type = isset($_GET['type'])?$_GET['type']:false;
		$fromtime = isset($_GET['fromtime'])?$_GET['fromtime']:false;
		$totime = isset($_GET['totime'])?$_GET['totime']:false;
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);
		if ($search_type==0) 
		{
	    	
	    }
	    elseif($search_type==1)
	    {	
	    	$export = VReceipt::model()->search_exportReceipt($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);

			$exportList = $export['data'];
			$filename = 'TransactionSummary.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
	    	$html2pdf->WriteHTML($this->renderPartial('export_summary', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	$html2pdf->Output($filename, 'D');
	    }

	    elseif($search_type==2)
	    {
	    	$export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);

			$exportList = $export['data'];

			$filename = 'InvoiceDetails.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
	    	$html2pdf->WriteHTML($this->renderPartial('export_invoicedetail', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	 $html2pdf->Output($filename, 'D');
	    }

	    elseif($search_type==3)
	    {	$export = VInvoice::model()->search_exportinvoice($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
			$exportList = $export['data'];
			$filename = 'UnpaidInvoice.pdf';
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);

	    	$html2pdf->WriteHTML($this->renderPartial('export_unpaid', array('exportList'=>$exportList,'title_report'=>$title_report), true));
	    	 $html2pdf->Output($filename, 'D');
	    }
	   
	}
	   

}
