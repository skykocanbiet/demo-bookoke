<?php

class AccountsController extends Controller
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

public function actionTab()
{	

	if(isset($_POST['id'])){
		$id=$_POST['id'];
	}
	$this->renderPartial('tab',array(
	'model'=>$this->loadModel($id),
	),false,true);

}

public function actionAdd()
{
	
	if( $_POST['customerNewName'] && $_POST['customerNewPhone'] )
	{		

		$result = Customer::model()->addNewCustomer($_POST['customerNewName'],$_POST['customerNewPhone'],yii::app()->user->getState('user_branch'));

		echo $result;
		
	}

}

public function actionAddNewMedicalHistory()
{
	
	if( isset($_POST['id_customer']) && isset($_POST['id_mhg']) )
	{

		$model = Customer::model()->findByPk($_POST['id_customer']);

		$chk_medical_history=isset($_POST['chk'])?$_POST['chk']:"";

		$ipt_medical_history=isset($_POST['ipt'])?$_POST['ipt']:"";
		
		$checkMedicalHistory = $model->checkMedicalHistory($_POST['id_customer']);

		if ($checkMedicalHistory==0) {		
			$data=$model->addNewMedicalHistoryAlert($_POST['id_customer'],$chk_medical_history,$ipt_medical_history,yii::app()->user->getState('user_id'));		
			$treatment= $model->checkTreatment($_POST['id_customer']);
		}else{
			$data=$model->updateMedicalHistoryAlert($_POST['id_customer'],$chk_medical_history,$ipt_medical_history);
			$treatment= CsMedicalHistoryGroup::model()->findByPk($_POST['id_mhg']);	
		}		
		
		$this->renderPartial('medical_record',array(
			'model'=>$model,'treatment'=>$treatment
		),false,true);
		
	}
}

public function actionEditMedicalHistory()
{	
	if( isset($_POST['id_customer']) && isset($_POST['id_mhg']) )
	{	
		$model = Customer::model()->findByPk($_POST['id_customer']);
		$id_mhg = $_POST['id_mhg'];
		$treatment= $model->checkTreatment($_POST['id_customer']);
		$this->renderPartial('frm_edit_mha',array('model'=>$model,'id_mhg'=>$id_mhg,'treatment'=>$treatment));	
	}
}

public function actionAddDentalStatus()
{		
	
	if( isset($_POST['id_customer']) && isset($_POST['id_mhg']) )
	{	

		$result = ToothData::model()->saveTooth($_POST['id_customer'], $_POST['id_mhg'], json_decode($_POST['tooth_data']), json_decode($_POST['tooth_image']), json_decode($_POST['tooth_conclude']), json_decode($_POST['tooth_note']));
	
		$model = Customer::model()->findByPk($_POST['id_customer']);	

		$treatment= CsMedicalHistoryGroup::model()->findByPk($_POST['id_mhg']);	
		
		$this->renderPartial('medical_record',array(
		'model'=>$model,'treatment'=>$treatment
		),false,true);
					
	}
}

public function actionAddNewTreatment()
{

	if( isset($_POST['id_customer']) )
	{		
		$model = Customer::model()->findByPk($_POST['id_customer']);
		$data=$model->addTreatment($_POST['id_customer']);
		$treatment= $model->checkTreatment($_POST['id_customer']);
		$this->renderPartial('medical_record',array(
		'model'=>$model,'treatment'=>$treatment
		),false,true);
	}
}

public function actionDetailTreatment()
{
	if(isset($_POST['id']) && isset($_POST['id_customer']))
	{	
		$model = Customer::model()->findByPk($_POST['id_customer']);	
		$treatment= CsMedicalHistoryGroup::model()->findByPk($_POST['id']);	
		$this->renderPartial('medical_record',array(
		'model'=>$model,'treatment'=>$treatment
		),false,true);
	}
}

public function actionUpdateTreatment()
{
	if( isset($_POST['id']) && isset($_POST['id_customer']) )
	{	
		$model = Customer::model()->findByPk($_POST['id_customer']);
		$treatment= CsMedicalHistoryGroup::model()->findByPk($_POST['id']);	
		$data=Customer::model()->updateTreatment($_POST['id']);
		if ($data==1) {			
			$this->renderPartial('medical_record',array(
			'model'=>$model,'treatment'=>$treatment
			),false,true);
		}		
	}
}

public function actionUpdateCustomerImage()
{
	if(isset($_POST['id']))
	{
		$id      = $_POST['id'];
		$model   = Customer::model()->findBypk($id);		
		$ext     = pathinfo($_FILES['image123']['name'], PATHINFO_EXTENSION);
		$rnd     = date("dmYHis").uniqid();
		$newName = $rnd.'.'.$ext;
		$image   = $_FILES["image123"]["error"]==0?$newName:$model['image'];
		$kq      = Customer::model()->updateByPk($id, array('image'=>$image));	

		if($kq)
		{
			if($_FILES["image123"]["error"]==0)
			{
				if($model['image'] != "" && $model['image'] != "no_image.png" && $model['image'] != "no_avatar.png")
				{
					unlink(Yii::app()->basePath.'/../upload/customer/avatar/'.$model['image']);
				}
				move_uploaded_file($_FILES["image123"]["tmp_name"],"./upload/customer/avatar/$image");
			}

		}	

		$this->renderPartial('customer_image',array('model'=>$model),false,true);	
	}
}

public function actionUpdateCustomerImageDefault()
{
	if(isset($_POST['id']))
	{
		$id      = $_POST['id'];
		$model   = Customer::model()->findBypk($id);	
		$kq      = Customer::model()->updateByPk($id, array('image'=>null));	

		if($kq)
		{
			
			if($model['image'] != "" && $model['image'] != "no_image.png" && $model['image'] != "no_avatar.png")
			{
				unlink(Yii::app()->basePath.'/../upload/customer/avatar/'.$model['image']);
			}	

		}	

		$this->renderPartial('customer_image',array('model'=>$model),false,true);	
	}
}

public function actionUpdateWebcamImage()
{
	if(isset($_GET['id']))
	{
		$id      = $_GET['id'];
		$model   = Customer::model()->findBypk($id);		
		$ext     = pathinfo($_FILES['webcam']['name'], PATHINFO_EXTENSION);
		$rnd     = date("dmYHis").uniqid();
		$newName = $rnd.'.'.$ext;
		$image   = $_FILES["webcam"]["error"]==0?$newName:$model['image'];
		$kq      = Customer::model()->updateByPk($id, array('image'=>$image));	

		if($kq)
		{
			if($_FILES["webcam"]["error"]==0)
			{
				if($model['image'] != "" && $model['image'] != "no_image.png" && $model['image'] != "no_avatar.png")
				{
					unlink(Yii::app()->basePath.'/../upload/customer/avatar/'.$model['image']);
				}
				move_uploaded_file($_FILES["webcam"]["tmp_name"],"./upload/customer/avatar/$image");
			}

		}	

		$this->renderPartial('customer_image',array('model'=>$model),false,true);	
	}
}

public function actionUpdateCustomer()
{
	if(isset($_POST['id']))
	{
		$model = new Customer;
		
		$phone=$model->getVnPhone($_POST['phone']);

		$phone_sms=$model->getVnPhone($_POST['phone_sms']);

		if ($_POST['birthdate'] ) {			
			$birthdate = date( "Y-m-d", strtotime( str_replace('/', '-', $_POST['birthdate']) ) );
		}else {
			$birthdate = null;
		}
		
		$model->updateCustomer($_POST['id'],$_POST['fullname'],$_POST['email'],$phone,$phone_sms,$_POST['gender'],$birthdate,$_POST['identity_card_number'],$_POST['id_country'],$_POST['id_source'],$_POST['id_job'],$_POST['position'],$_POST['address'],$_POST['id_company']);

		echo '<div class = "alert alert-success" id="success-alert"><a href = "#" class = "close" data-dismiss = "alert">&times;</a><strong>Thành Công!</strong> Đã cập nhật...</div>';
		
	}

}

public function actionDeleteCustomer()
{
	$customer=Customer::model()->findByPk($_POST['id']);		
	$customer->status=-1;					
	$customer->update();	
	echo 1;
	exit;
}

public function actionUpdateCustomerName()
{
	$customer=Customer::model()->findByPk($_POST['id_customer']);	
	$customer->fullname=$_POST['customerName'];					
	$customer->update();	
	echo 1;
	exit;
		
}

public function actionUpdateFlag()
{
	if(isset($_POST['id']))
	{
		$model = new Customer;
		
		$model->updateFlag($_POST['id'],$_POST['flag']);
		
	}

}
public function smtpsendmail($mailTo,$title,$AltBody,$email_content)
{
	$phpMailerlPath = Yii::getPathOfAlias('webroot');
	require_once($phpMailerlPath.'/protected/extensions/smtpmail/PHPMailer.php');
	require_once($phpMailerlPath.'/protected/extensions/smtpmail/class.smtp.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.bookoke.com";
	$mail->Port = 25; // or 587
	$mail->SMTPDebug  = 1;
	$mail->SMTPAuth = true; // authentication enabled
	// $mail->SMTPSecure = "ssl"; // secure transfer enabled REQUIRED for Gmail
	
	$mail->Username = "support@bookoke.com";
	$mail->Password = "callneX@2017";
	$mail->IsHTML(true); // if you are going to send HTML formatted emails
	$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
	$mail->SetFrom("info@bookoke.com","BookOke Support");
	$mail->AltBody = $AltBody;
	$mail->Subject = $title;
	$mail->Body = $email_content;
	$mail->AddAddress($mailTo);
	$mail->CharSet = "utf-8";
	 if(!$mail->Send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	 } else {
	    echo "Chúng tôi vừa thông tin kích hoạt tài khoản vào địa chỉ ".$mailTo." ! Vui lòng vào mail kiểm tra và xác nhận";
	 }
}
public function actionSendMailCreateUser(){
	if (isset($_POST['email']) && $_POST['email']) {
		$email =$_POST['email'];
		$password = $_POST['pass'];
		$testemail = Customer::model()->findAllByAttributes(array('email'=>$email));
		if ($testemail && $testemail[0]['id']!=$_POST['id']) {
			echo "Email này đã được sử dụng! Vui lòng chọn email khác";
			exit();
		}
		else
		{
			$activation=md5($email.time());
			$command = Yii::app()->db->createCommand();	
			$data = $command->update('customer', array(
					'code_confirm'=>$activation,
					'username'=>$email,
					'password'=>md5($password),
			),'id=:id',array(':id'=>$_POST['id']));
			if ($data) {
				//Title
				$title    = 'XÁC NHẬN ĐĂNG KÍ TÀI KHOẢN';
				//AltBody
				$AltBody ="Xác nhận đăng kí tài khoản khách hàng BookOke !";
				//Noi dung gui mail
				$content  = $this->renderPartial('/accounts/view_sendmailconfim',array('mail_info'=>$_REQUEST,'activation'=>$activation),true);
				$result = $this->smtpsendmail($_REQUEST['email'],$title,$AltBody,$content);
			}
		}
	}
}
public function actionUpdateMember()
{
	if (isset($_POST['id'])) {
		$model = new CustomerMember;
		$model->updateCusMember($_POST['id'],$_POST['code_member'],$_POST['status_member']);
	}
}
public function actionUpdateCustomerSegment()
{
	if(isset($_POST['id']))
	{
		$model = new Customer;			
		
		$model->updateCustomerSegment($_POST['id'],$_POST['id_segment']);
		
	}

}

public function actionUpdateStatusSchedule()
{

	if(isset($_POST['id']) && isset($_POST['id_customer']) && isset($_POST['status_schedule']))
	{
		$id_quotation 	= (isset($_POST['id_quotation'])) ? $_POST['id_quotation'] : '';
		$result 		= CsSchedule::model()->updateSchedule(array('id'=>$_POST['id'],'status'=>$_POST['status_schedule'], 'id_quotation'=>$id_quotation));	
		$data   		= Customer::model()->updateStatusScheduleOfCustomer($_POST['id_customer'],$_POST['status_schedule']);

		if($result == -1){
			echo "-1";exit;
		}elseif($result == -2){
			echo "-2";exit;
		}else{
			echo json_encode($result);
		}
		
	}
}

public function actionUpdateEvaluateStateOfTartar()
{
	if( isset($_POST['id']) && isset($_POST['evaluate_state_of_tartar']) )
	{
		$id     = $_POST['id'];	
		$result = Customer::model()->updateEvaluateStateOfTartar($id,$_POST['evaluate_state_of_tartar']);	
	}

}

public function actionInsertUpdateCustomerInsurrance()
{
	if(isset($_POST['id']))
	{
		$id=$_POST['id'];
		$id_customer=$_POST['id_customer'];
		$code_insurrance=$_POST['code_insurrance'];
		$type_insurrance=$_POST['type_insurrance'];
		$startdate=$_POST['startdate'];
		$enddate=$_POST['enddate'];	
		if ($id==0)
		{
			$cscustomerinsurrance=new CsCustomerInsurrance;
			$cscustomerinsurrance->id_customer=$id_customer;
			$cscustomerinsurrance->code_insurrance=$code_insurrance;	
			$cscustomerinsurrance->type_insurrance=$type_insurrance;
			$cscustomerinsurrance->startdate=$startdate;
			$cscustomerinsurrance->enddate=$enddate;
			$cscustomerinsurrance->save();					
		}
		else
		{			
			CsCustomerInsurrance::model()->updateByPk($id, array('id_customer'=>$id_customer,'code_insurrance'=>$code_insurrance,'type_insurrance'=>$type_insurrance,'startdate'=>$startdate,'enddate'=>$enddate));	
		}
	}

}

public function actionAddPlan()
{
	$csmedicalhistoryplan=new CsMedicalHistoryPlan;
	if(isset($_POST['planNewName']) && isset($_POST['id_history_group']) && isset($_POST['id_dentist']))
	{
		$csmedicalhistoryplan->name=$_POST['planNewName'];
		$csmedicalhistoryplan->id_history_gourp=$_POST['id_history_group'];	
		$csmedicalhistoryplan->id_dentist=	$_POST['id_dentist'];
		$csmedicalhistoryplan->id_user=	yii::app()->user->getState('user_id');
		$csmedicalhistoryplan->createdate=	date('Y-m-d H:i:s');
		$csmedicalhistoryplan->save();		
		$this->renderPartial('treatment_plan',array('id_history_group'=>$_POST['id_history_group']),false,true);

	}
}

public function actionSaveMedicalHistory()
{	
	if(isset($_POST['medicalhistoryNewName']))
	{	
		$model = Customer::model()->findByPk($_POST['id_customer']);

		$status_success = 0;

		$id_branch      = $model->getIdBranchByIdUser($_POST['id_dentist']);

		if($_POST['id_medical_history']){			
            $data  = $model->updateMedicalHistory($_POST['id_medical_history'],$_POST['id_customer'],$_POST['id_history_group'],yii::app()->user->getState('user_id'),$_POST['id_dentist'],$id_branch,$_POST['medicalhistoryNewName'],$_POST['description'],$_POST['reviewdate'],$_POST['length_time']);
        	
        }
        else{
        	$session_add_prescription = isset(Yii::app()->session['add_prescription'])?Yii::app()->session['add_prescription']:"";
        	$session_add_lab          = isset(Yii::app()->session['add_lab'])?Yii::app()->session['add_lab']:"";
			$data                     = $model->addMedicalHistory($_POST['id_customer'],$_POST['id_history_group'],yii::app()->user->getState('user_id'),$_POST['id_dentist'],$id_branch,$_POST['medicalhistoryNewName'],$_POST['description'],$_POST['reviewdate'],$_POST['length_time'],$session_add_prescription,$session_add_lab);
				
			if (isset($_POST['status_success'])) {					

				$id_shedule = $model->getIdScheduleByIdCustomer($model->id);
				
				if($id_shedule){

					$id_schedule    = $model->getIdScheduleByIdCustomer($_POST['id_customer']);		
					$id_quotation   = $model->checkNewestTreatmentExistQuotation($_POST['id_customer']);
					$result         = CsSchedule::model()->updateSchedule(array('id'=>$id_schedule,'status'=>4, 'id_quotation'=>$id_quotation));	
					$return         = $model->updateStatusScheduleOfCustomer($_POST['id_customer'],4);				
					$status_success = 1;

				}

			}
				
		}

		if ($data == 1) {
			$this->renderPartial('medical_history',array('model'=>$model,'id_mhg'=>$_POST['id_history_group'],'status_success'=>$status_success));	
		}else{
			echo $data['status'];   		
		}							
	}
}

public function actionDeleteMedicalHistory()
{	
	if( isset($_POST['id']) && isset($_POST['id_history_group']) )
	{
		$model = new Customer;
		$data  = $model->deleteMedicalHistory($_POST['id']);		

		if ($data==1){	

			$this->renderPartial('medical_history',array('model'=>$model,'id_mhg'=>$_POST['id_history_group']));	
		} 							
	}
}

public function actionExportPrescription()
{		

	if($_GET['id_medical_history']){		

		$model = Customer::model()->findByPk($_GET['id_customer']);

		$data  = Customer::model()->getMedicalHistoryById($_GET['id_medical_history']);

		$filename = 'test.pdf';

        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
        
        $html2pdf->WriteHTML($this->renderPartial('export_prescription', array('model'=>$model,'data'=>$data), true));

        $html2pdf->Output($filename, 'I');   
        
	}
}

public function actionExportLab()
{		

	if($_GET['id_medical_history']){		

		$model = Customer::model()->findByPk($_GET['id_customer']);

		$data  = Customer::model()->getMedicalHistoryById($_GET['id_medical_history']);

		$filename = 'test.pdf';

        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
        
        $html2pdf->WriteHTML($this->renderPartial('export_lab', array('model'=>$model,'data'=>$data), true));

        $html2pdf->Output($filename, 'I');   
        
	}
}

public function actionView_frm_treatment(){
    if($_POST['id']){       	
        echo json_encode(Customer::model()->getMedicalHistoryById($_POST['id']));   
    }
}

public function actionSetSessionAddPrescription(){

	if( $_POST['diagnose'] && $_POST['drug_name'] && $_POST['morning'] && $_POST['noon'] && $_POST['afternoon'] && $_POST['night'] )
	{			

		if($_POST['id_cs_medical_history']){			
            $data  = Customer::model()->savePrescription(array('id_group_history' => $_POST['id_history_group'], 'id_medical_history' => $_POST['id_cs_medical_history'], 'diagnose' => $_POST['diagnose'], 'drug_name' => $_POST['drug_name'], 'morning' => $_POST['morning'], 'noon' => $_POST['noon'], 'afternoon' => $_POST['afternoon'], 'night' => $_POST['night'], 'advise' => $_POST['advise'], 'examination_after' => $_POST['examination_after']));      
        }
        else{
        	Yii::app()->session['add_prescription'] = array('diagnose' => $_POST['diagnose'], 'drug_name' => $_POST['drug_name'], 'morning' => $_POST['morning'], 'noon' => $_POST['noon'], 'afternoon' => $_POST['afternoon'], 'night' => $_POST['night'], 'advise' => $_POST['advise'], 'examination_after' => $_POST['examination_after']);
		}

	}

}

public function actionSetSessionAddLab(){

	if( $_POST['id_br4nch'] && $_POST['id_labo_elite'] && $_POST['sent_date'] && $_POST['received_date'] && $_POST['assign'] )
	{			

		if($_POST['id_cs_m3dical_history']){			
            $data  = Customer::model()->saveLab(array('id_group_history' => $_POST['id_history_group'], 'id_medical_history' => $_POST['id_cs_m3dical_history'], 'id_branch' => $_POST['id_br4nch'], 'id_labo_elite' => $_POST['id_labo_elite'], 'sent_date' => $_POST['sent_date'], 'received_date' => $_POST['received_date'], 'assign' => $_POST['assign'], 'note' => $_POST['note']));      
        }
        else{
        	Yii::app()->session['add_lab'] = array('id_branch' => $_POST['id_br4nch'], 'id_labo_elite' => $_POST['id_labo_elite'], 'sent_date' => $_POST['sent_date'], 'received_date' => $_POST['received_date'], 'assign' => $_POST['assign'], 'note' => $_POST['note']);
		}

	}

}

public function actionUnsetSessionAddPrescription(){

	unset(Yii::app()->session['add_prescription']);

}

public function actionUnsetSessionAddLab(){

	unset(Yii::app()->session['add_lab']);

}

public function actionView_medical_image(){	
    if($_POST['id_customer'] && $_POST['id_mhg']){  
        echo json_encode(Customer::model()->getListName($_POST['id_customer'],$_POST['id_mhg']));   
    }
}

public function actionUpload()
{
	/**
	 * upload.php
	 *
	 * Copyright 2013, Moxiecode Systems AB
	 * Released under GPL License.
	 *
	 * License: http://www.plupload.com/license
	 * Contributing: http://www.plupload.com/contributing
	 */

	#!! IMPORTANT: 
	#!! this file is just an example, it doesn't incorporate any security checks and 
	#!! is not recommended to be used in production environment as it is. Be sure to 
	#!! revise it and customize to your needs.


	// Make sure file is not cached (as it happens for example on iOS devices)
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	/* 
	// Support CORS
	header("Access-Control-Allow-Origin: *");
	// other CORS headers if any...
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		exit; // finish preflight CORS requests here
	}
	*/

	// 5 minutes execution time
	@set_time_limit(5 * 60);

	// Uncomment this one to fake upload time
	// usleep(5000);

	// Settings
	$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";	
	$targetDir = Yii::app()->basePath.'/../upload/customer/dental_status/'.$_REQUEST['code_number'];
	$cleanupTargetDir = true; // Remove old files
	$maxFileAge = 5 * 3600; // Temp file age in seconds

	// Create target dir
	if (!file_exists($targetDir)) {
		@mkdir($targetDir);
	}

	// Get a file name
	if (isset($_REQUEST["name"])) {
		$fileName = $_REQUEST["name"];
	} elseif (!empty($_FILES)) {
		$fileName = $_FILES["file"]["name"];
	} else {
		$fileName = uniqid("file_");
	}

	$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

	// Chunking might be enabled
	$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
	$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


	// Remove old temp files	
	if ($cleanupTargetDir) {
		if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
		}

		while (($file = readdir($dir)) !== false) {
			$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

			// If temp file is current file proceed to the next
			if ($tmpfilePath == "{$filePath}.part") {
				continue;
			}

			// Remove temp file if it is older than the max age and is not the current file
			if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
				@unlink($tmpfilePath);
			}
		}
		closedir($dir);
	}

	// Open temp file
	if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	}

	if (!empty($_FILES)) {
		if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		}

		// Read binary input stream and append it to temp file
		if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		}
	} else {	
		if (!$in = @fopen("php://input", "rb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		}
	}

	while ($buff = fread($in, 4096)) {
		fwrite($out, $buff);
	}

	@fclose($out);
	@fclose($in);

	// Check if file has been uploaded
	if (!$chunks || $chunk == $chunks - 1) {
		// Strip the temp .part suffix off 
		rename("{$filePath}.part", $filePath);
	}

	$model = new Customer;	

	$data  = $model->addCsMedicalImage($fileName,yii::app()->user->getState('user_id'),$_REQUEST['id_customer'],$_FILES["file"]["name"],$_REQUEST['id_mhg']);

	// Return Success JSON-RPC response
	if($data==1){
		
		echo $_REQUEST['id_customer'];
		
	}	
}

public function actionAdmin()
{
	$model = new Customer;
	$code_number='';
	if(isset($_GET['code_number'])){
		$code_number = $_GET['code_number'];
	}
	$this->render('admin',array(
		'model'=>$model,'code_number'=>$code_number
	));
}
public function actionSearchCustomers()
{

	$model 		   = new Customer;
	$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
	$lpp           = 20;
	$status 	   = 1; //trang thai = 1 khach hang	
	
	$search_params   = 'AND `customer`.`status` = '.$status.'';	

	if( yii::app()->user->getState('group_id') == 3 ){
		$orderBy 	   = 'FIELD(status_schedule,3,2,1,5,4,0,-1,-2) ';
	}
	else {
		$orderBy 	   = '`status_schedule` DESC ';
	}

	//sap xep
	if($_POST['type'] == 1){
		$orderBy 	   = '`fullname` ASC ';
	}elseif($_POST['type'] == 4){
		$orderBy = '`code_number` DESC ';
	}else{
		$orderBy 	   = '`fullname` ASC ,`code_number` DESC ';
	}

	//input search chinh
	if ($_POST['value']) 
	{
		$search_params .= ' AND (   (`fullname` LIKE "%'.$_POST['value'].'%" ) OR (`code_number` LIKE "%'.$_POST['value'].'%" )   ) ';
	}

	if ($_POST['email']) 
	{
		$search_params .= ' AND (`email` LIKE "%'.$_POST['email'].'%" ) ';
	}

	if ($_POST['phone']) 
	{	
		$search_params .= ' AND (`phone` LIKE "%'.$model->getVnPhone($_POST['phone']).'%" ) ';
	}

	if ($_POST['birthdate']) 
	{
		$search_params .= ' AND (`birthdate` LIKE "%'.$_POST['birthdate'].'%" ) ';
	}

	if ($_POST['identity_card_number']) 
	{
		$search_params .= ' AND (`identity_card_number` LIKE "%'.$_POST['identity_card_number'].'%" ) ';
	}


	if( yii::app()->user->getState('group_id') == 3 ){

		if(is_numeric($_POST['value'])){
			$data  = $model->searchCustomers('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);
		}	
		else{
			$and_conditions['id_dentist'] = yii::app()->user->getState('user_id');
			$data  = $model->searchVSchedules($and_conditions,'',' '.$search_params.' group by id_customer order by '.$orderBy,$lpp,$cur_page);
		}
		
	}else{
		$data  = $model->searchCustomers('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);
	}

	if($cur_page > $data['paging']['cur_page']){	
		echo '<script>stopped = true; </script>';	
		exit;
	}

	$this->renderPartial('search_sort',array('list_data'=>$data,'page'=>$data['paging']['cur_page']));

}

public function actionDetailCustomer()
{
	$model = new Customer();

	if(isset($_POST['id']))
	{		
		$model 		= $model->findByPk($_POST['id']);
		$treatment 	= $model->checkTreatment($_POST['id']);		
	}else{
		$treatment= 0;
	}

	$this->renderPartial('customer_info',array(
			'model'=>$model,'treatment'=>$treatment
	),false,false);
}

public function actionGetCall()
{
	if (isset($_POST['phone'])) {
		// echo ($_POST['phone']);
		$soap = new SoapService();
		$rs   = $soap->webservice_server_ws('ClickToCall',array("4","b471b02f1ac491391b9bd92c6f3a0b54",$_POST['phone']));
		
		if ($rs != "Success") {
			$id_user = $_POST['id_user'];
			$extention = "108";
			$phone = $_POST['phone'];
			$date_call= date('Y-m-d H:i:s',time());
			$data = CallHistoryCustomer::model()->insertCallError($id_user,$extention,$phone,$date_call);
			if ($data) {
				print_r($rs);
			}
		}
		else{
			print_r($rs);
		}
	}else
	{
		echo "0";
	}
	
}
public function actionaddNewCallHistory()
{
	if (isset($_POST['id_user']) && $_POST['id_user']) {
		// $user = GpUsers::model()->findByPk($_POST['id_user']);
		$id_user = $_POST['id_user'];
		$id = $_POST['id'];
		$date_call = $_POST['date_call'];
		$duration_call = $_POST['duration_call'];
		$extention = $_POST['extention'];
		$phone = $_POST['phone'];
		$file_record = $_POST['file_record'];
		$status = $_POST['status'];
		$clove_call = $_POST['clove_call'];
		
		$data = CallHistoryCustomer::model()->insert_new_callhistory($id_user,$id,$date_call,$duration_call,$extention,$phone,$file_record,$status,$clove_call);
		if ($data) {
			print_r($data);
		}
		
	}
}
public function actionsearchCustomersCall()
{
	if (isset($_POST['phone']) && $_POST['phone']) {
		$data = Customer::model()->findAllByAttributes(array('phone'=>$_POST['phone']));
		if ($data) {
			print_r($data[0]['id']);
		}
		else
		{
			echo "0";
		}
	}
}
/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Customer::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
/*LMV*/
public function actiongetActiveTabNote(){
		$id = $_POST['id'];
		$this->renderPartial('tab_activity_history',array('data'=>$id),false,true);
	}
public function actionaddnote(){
		$user = Yii::app()->user->getState('user_id');
		if (isset($_POST['chk_important'])) {
			$important = '1';
		}
		else{
			$important = '0';
		}
		if(isset($_POST['note']))
		{
			
				
		
			$note_customer = CustomerNote::model()->addnote(array(
					'note'=>$_POST['note'],
					'id_user'=> '',
					'id_customer'=>$_POST['id_cus'],
					'flag'=>$_POST['phanloai'],
					'important'=>$important,
					'status'=>$_POST['status'],
				));
			$data = CustomerNote::model()->findAllByAttributes(array('id_customer'=>$_POST['id_cus']));
			$this->renderPartial('search_note',array('data'=>$data),false,true);
			exit();
		}
		echo "-1";
		exit();
		
	}
	public function actionsearchnote(){
		$data = CustomerNote::model()->searchnote($_POST['status_search'],$_POST['phanloai_search'],$_POST['id'],$_POST['date']
				);
		$this->renderPartial('search_note',array('data'=>$data),false,true);
	}
	public function actioneditnote(){
		$model = new CustomerNote;
		$id = $_POST['id'];
		
		$data = $model->findAllByAttributes(array('id'=>$_POST['id']));

		$this->renderPartial('tab_update_note',array('data'=>$data[0]),false,true);
	}
	public function actionupdatenote(){
		$id = $_POST['id'];
		$id_user = Yii::app()->user->getState('user_id');
		$data =  CustomerNote::model()->findAllByAttributes(array('id'=>$_POST['id']));
		$id_customer = $data[0]->id_customer;
		if (isset($_POST['chk_important_edit'])) {
			$important_edit = '1';
		}
		else{
			$important_edit = '0';
		}
		CustomerNote::model()->updateByPk($id, array('note'=>$_POST['note_edit'], 'id_user'=>$id_user, 'important'=>$important_edit));
		$data = CustomerNote::model()->findAllByAttributes(array('id_customer'=>$id_customer));
			$this->renderPartial('search_note',array('data'=>$data),false,true);
			exit();
		
	}
/*end*/
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

	//listcustomer
	public function actionGetCustomerList()
	{
		$page = isset($_POST['page'])?$_POST['page']:1;
		$search = isset($_POST['q'])?$_POST['q']:'';

	    $item = 30;

	    $search_params= 'AND (`fullname` LIKE "%'.$search.'%" ) OR (`phone` LIKE "%'.$search.'%" ) OR (`code_number` LIKE "%'.$search.'%" )';
	    
	    $customerList = Customer::model()->searchCustomers('','',' '.$search_params,$item,$page);
	    if(!$customerList)
	    {
	    	echo -1;exit();
	    }
		foreach ($customerList['data'] as $key => $value) {
			$customer[] = array(
				'id' => $value['id'],
				'text' => $value['fullname'].'-'.$value['code_number'],
			);
		}
		echo json_encode($customer);
	}
	//add  relation family
	public function actionAddRelationFamily()
	{ 

		if( $_POST['relation_family'] && $_POST['customer_relation'] && $_POST['id_customer'])
		{		

			$result = CustomerRelationship::model()->addRelationFamily($_POST['id_customer'],$_POST['customer_relation'],$_POST['relation_family']);

			echo $result;
		}
	}

	public function actionSearchTreatmentOld()
	{
		$curpage     = isset($_POST['curpage']) ? $_POST['curpage'] : 1;
		$lpp         = isset($_POST['lpp']) ? $_POST['lpp'] : 30;
		$code_number = isset($_POST['code_number']) ? $_POST['code_number'] : '';
		$tm_dentist = isset($_POST['tm_dentist']) ? $_POST['tm_dentist'] : '';
		$tm_service = isset($_POST['tm_service']) ? $_POST['tm_service'] : '';
		$tm_date    = isset($_POST['tm_date']) ? $_POST['tm_date'] : '';

		$tmOld = TreatmentOld::model()->searchTreatmentOld($curpage, $lpp, $code_number, $tm_dentist, $tm_service, $tm_date);

		$page_list = '';

		if($tmOld['numRow'] > 0){
			$action = 'searchTreatmentOld';
			$param  = "'$code_number','$tm_dentist','$tm_service','$tm_date'";
			
			$page_list = VQuotations::model()->paging($curpage,$tmOld['numRow'],$lpp,$action,$param);
		}

		$this->renderPartial('treatmentOldList', array('tm' => $tmOld, 'page'=>$page_list));
	}

	public function actionGetListSchCus()
	{
		$id_customer = isset($_POST['id_customer']) ? $_POST['id_customer'] : false;
		$page        = isset($_POST['page']) ? $_POST['page'] : 1;
		$limit       = 7;

		$sch = array();
		$page_list = '';
		if($id_customer)
			$sch = CsSchedule::model()->getListSchedulePag($page,$limit,'','','','start_time DESC', $id_customer);

		if($sch){
			$action = 'loadSchCus';
			$param  = "'$id_customer'";
			
			$page_list = VQuotations::model()->paging($page,$sch['numRow'],$limit,$action,$param);
		}

		$this->renderPartial('ListScheduleCustomer', 
			array('listSch'=>$sch, 'page' => $page_list));
	}

	public function actionLoadMedicalReport()
	{

		$model = new Customer();

		if(isset($_POST['id_customer']) && $_POST['id_customer'])
		{		
			$model 	= $model->findByPk($_POST['id_customer']);	
			$treatment= $model->checkTreatment($_POST['id_customer']);		
		}
		else{
			$treatment= 0;
		}	

		$this->renderPartial('medical_record',array(
				'model'=>$model,'treatment'=>$treatment
		),false,false);			

	}

	public function actionGetListInvoice()
	{

		$id_customer = isset($_POST['id_customer']) ? $_POST['id_customer'] : false;
		$page        = isset($_POST['page']) ? $_POST['page'] : 1;
		$limit       = 2;

		$rpt = '';
		$page_list = '';

		if($id_customer) {
			$iv = VInvoice::model()->searchInvoiceForCus($page,$limit,$id_customer);

			if($iv['tolItem'] > 0){
				$ivL = $iv['data'];
				$f   = end($ivL)->id;
				$l   = reset($ivL)->id; 
				$rpt = Receipt::model()->searchReceipt(" $f <= id_invoice AND id_invoice <= $l ORDER BY id DESC");

				$action = 'loadInvoice';
				$param  = "'$id_customer'";

				$page_list = VQuotations::model()->paging($page,$iv['tolItem'],$limit,$action,$param);
			}
		}
	
		$this->renderPartial('tab_treatment_history', 
			array('inv'=>$iv, 'rpt'=>$rpt,'id_customer'=>$_POST['id_customer'], 'page' => $page_list));
	}

	public function actionGetStatistical()
	{

		$id_customer = isset($_POST['id_customer']) ? $_POST['id_customer'] : false;
		$this->renderPartial('tab_statistical', array('id_customer'=>$_POST['id_customer']));
	}
	public function actionGetMember()
	{
		$id_customer = isset($_POST['id_customer']) ? $_POST['id_customer'] : false;
		$this->renderPartial('tab_member', array('id_customer'=>$_POST['id_customer']));
	}
}
