<?php

class ReportingAppointmentController extends Controller
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
		//search appointment
		$page = isset($_POST['page'])?$_POST['page']:1;
		$limit = isset($_POST['limit'])?$_POST['limit']:100;
		$search_time = isset($_POST['search_time'])?$_POST['search_time']:'';
		$search_branch = isset($_POST['branch'])?$_POST['branch']:'';
		$search_user = isset($_POST['lstUser'])?$_POST['lstUser']:'';
		$search_type = isset($_POST['type'])?$_POST['type']:'';
		$fromtime = isset($_POST['fromtime'])?$_POST['fromtime']:'';
		$totime = isset($_POST['totime'])?$_POST['totime']:'';
		$appointment = VSchedule::model()->searchAppointment($page,$limit,$search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
		$appointmentList = $appointment['data'];
		$count = $appointment['count'];
		$page_list = "";
		if(!$appointmentList) {
			$appointmentList = -2;
		}
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);
		//xuất excel
		$export_appointment = VSchedule::model()->searchExport_Appointment($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
		$exportList = $export_appointment['data'];
		
		if ($_POST['type']==0) 
		{	
			$this->renderPartial("schedule",array('appointmentList'=>$appointmentList,'count'=>$count,'page_list'=>$page_list,'exportList'=>$exportList,'title_report'=>$title_report));
		}
		else if($_POST['type']==1)
		{
			$this->renderPartial("cancelled",array('appointmentList'=>$appointmentList,'count'=>$count,'page_list'=>$page_list,'exportList'=>$exportList,'title_report'=>$title_report));
		}
		else if ($_POST['type']==2) {
			$this->renderPartial("no_show",array('appointmentList'=>$appointmentList,'count'=>$count,'page_list'=>$page_list,'exportList'=>$exportList,'title_report'=>$title_report));
		}
		
	}
	
	public function actionExportAppointment()
	{ 
		$search_time = isset($_GET['search_time'])?$_GET['search_time']:false;
		$search_branch = isset($_GET['branch'])?$_GET['branch']:false;
		$search_user = isset($_GET['lstUser'])?$_GET['lstUser']:false;
		$search_type = isset($_GET['type'])?$_GET['type']:false;
		$fromtime = isset($_GET['fromtime'])?$_GET['fromtime']:false;
		$totime = isset($_GET['totime'])?$_GET['totime']:false;
		$export_appointment = VSchedule::model()->searchExport_Appointment($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
		$export_appointmentList = $export_appointment['data'];
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);
		if ($search_type==0) 
		{	
			$filename = 'TotalAppointment.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_appointment', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    elseif($search_type==1)
	    {	
	    	$filename = 'AppointmentCanceled.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_cancel', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    elseif($search_type==2)
	    {	
	    	$filename = 'AppointmentNotComing.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_noshow', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    $html2pdf->Output($filename, 'I');
	}

	public function actionExportPDF_Appointment()
	{ 
		
		$search_time = isset($_GET['search_time'])?$_GET['search_time']:false;
		$search_branch = isset($_GET['branch'])?$_GET['branch']:false;
		$search_user = isset($_GET['lstUser'])?$_GET['lstUser']:false;
		$search_type = isset($_GET['type'])?$_GET['type']:false;
		$fromtime = isset($_GET['fromtime'])?$_GET['fromtime']:false;
		$totime = isset($_GET['totime'])?$_GET['totime']:false;
		$export_appointment = VSchedule::model()->searchExport_Appointment($search_type,$search_branch,$search_time,$search_user,$fromtime,$totime);
		$export_appointmentList = $export_appointment['data'];
		$title_report = VReceipt::model()->titleReport($search_time,$search_branch,$search_user,$fromtime,$totime);
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
		if ($search_type==0) 
		{	
			$filename = 'TotalAppointment.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_appointment', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    elseif($search_type==1)
	    {	
	    	$filename = 'AppointmentCanceled.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_cancel', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    elseif($search_type==2)
	    {	
	    	$filename = 'AppointmentNotComing.pdf';
	    	$html2pdf->WriteHTML($this->renderPartial('exports_noshow', array('export_appointmentList'=>$export_appointmentList,'title_report'=>$title_report), true));
	    }
	    $html2pdf->Output($filename, 'D');
	}
}
