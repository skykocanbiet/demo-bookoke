<?php

class StaffController extends Controller
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

		$this->render('view');
	}

	public function actionAdd()
	{
		$model = new GpUsers;
		if(isset($_POST['usernameCustomer']) && isset($_POST['passwordConfirmCustomer']))
		{	
			
			if ($_POST['passwordConfirmCustomer'] != $_POST['passwordCustomer']) {
				echo "0";
				exit;
			}
			$transaction = Yii::app()->db->beginTransaction();
			try {
			    $model->id_branch 	= 	Yii::app()->params['id_branch'];
				$model->name 		=	$_POST['usernameCustomer'];

				$model->username 	= $_POST['usernameCustomer'];
				$model->password 	= md5($_POST['passwordConfirmCustomer']);
				$password 			= $model->password;
				$username 			= $model->username;
				$model->group_id 	= "2";
				if($model->save(false))
				{
					$id_company =	Yii::app()->params['id_company'];
					$subdomain 	=	Yii::app()->params['subdomain'];
					$name 		= 	$_POST['usernameCustomer'];
					$group_id 	=	"2";
					$block 		=	"0";
					$soap 	 	=  	new SoapService;
					//$id_company,$subdomain,$username,$name,$password,$group_id,$block
					$rs 		= 	$soap->webservice_server_ws('addNewUser',array("4","b471b02f1ac491391b9bd92c6f3a0b54",$id_company,$subdomain,$username,$name,$password,$group_id,$block));
					if($rs['status'] == 'successful'){
						$model->code = $rs['data'];
						$model->update();
						$transaction ->commit();
						echo $rs['data'];
					}
				}
			    
			} catch (Exception $error) {
			     $transaction ->rollback();
			     throw $error;
			}
			echo '-1';
		}
	}
	public function actionDeleteStaff()
	{
		if (isset($_POST['id'])) {
			$data = GpUsers::model()->deleteStaff($_POST['id']);
			if ($data) {
				echo "1";
			}
		}
	}
	public function actionSearchListStaffs()
	{

		$model 		   = new GpUsers;
		$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
		$lpp           = 200;
		$search_params = '';
		$orderBy 	   = '`name` ASC ';

		if ($_POST['type'] == 1) 
		{
			$search_params= 'AND (`name` LIKE "%'.$_POST['value'].'%" )';
			$orderBy = '`name` ASC ';
		}
		elseif ($_POST['type']== 4) 
		{
			$search_params= 'AND (`code` LIKE "%'.$_POST['value'].'%" )';
			$orderBy = '`code` DESC ';
		}
		// if ($_POST['value']) {
		// 	$search_params= 'AND (`name` LIKE "%'.$_POST['value'].'%" ) OR (`code` LIKE "%'.$_POST['value'].'%" )';
		// }
		if ($_POST['group_id']==3) {
			$search_params.= 'AND (`id`='.$_POST["id_user"].')';
		}
		$data  = $model->searchStaffs('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);

		$this->renderPartial('search_list',array('list_data'=>$data));

	}

	public function actionDetailStaff()
	{
		if(isset($_POST['id']))
		{
			$model = GpUsers::model()->findByPk($_POST['id']);
			$group_user = GpGroup::model()->findAll();
			$branch_user = Branch::model()->findAll();
			$data = CsScheduleChair::model()->findAllByAttributes(array('id_dentist'=>$_POST['id']));
			if(!$data)
			{
				$id_dentist = $_POST['id'];
				$start = "08:00:00";
				$end = "20:00:00";
				$id_branch = "1";
				$command = Yii::app()->db->createCommand();
				for($i=1;$i<=6;$i++){
					$command->insert('cs_schedule_chair',array(
						'id_dentist'=>$id_dentist,
						'dow'=>$i,
						'start'=>$start,
						'end'=>$end,
						'id_branch'=>$id_branch,
						)
					);
				}
			}

			$data_time_break = CsScheduleRelax::model()->findAllByAttributes(array('id_dentist'=>$_POST['id']));
			if(!$data_time_break)
			{
				$id_dentist = $_POST['id'];
				$start = "12:00:00";
				$end = "13:30:00";
				$id_branch = "1";
				$command = Yii::app()->db->createCommand();
				for($i=1;$i<=6;$i++){
					$command->insert('cs_schedule_relax',array(
						'id_dentist'=>$id_dentist,
						'dow'=>$i,
						'start' => $start,
						'end' => $end,
						'id_branch'=>$id_branch,
						)
					);
				}
			}
			$data_time_off = CsScheduleTimeOff::model()->findAllByAttributes(array('id_dentist'=>$_POST['id']));
			$working_list = CsScheduleChair::model()->findAllByAttributes(array('id_dentist'=>$_POST['id']),array('group'=>'dow'));

			$this->renderPartial('staff_information',array('group_user'=>$group_user,'branch_user'=>$branch_user,'time_off_list'=>$data_time_off,'model'=>$model,'working_list'=>$working_list,'id_dentist'=>$_POST['id']),false,false);
		}
	}
	public function actionGetListChair()
	{
		
		if(isset($_POST['chair']) && $_POST['chair'])
		{
			$id = $_POST['id'];
			$start = strtotime($_POST['start']);
			$end = strtotime($_POST['end']);

			$dow = $_POST['dow'];
			$branch = $_POST['branch'];
			$chair = $_POST['chair'];
			$dentist=$_POST['dentist'];
			$resulf = 0;
			//0 : ĐƯƠC phép đặt
			// 1 : KHÔNG cho phép đặt

			// lấy danh sách bác sĩ có cùng ghế trong 1 ngày cùng 1 cơ sở
			$list_chair = CsScheduleChair::model()->get_chair($chair,$branch,$start,$end,$dow);
			// lấy số ghế của bác sĩ trong 1 ngày
			$list_chair_dentist = CsScheduleChair::model()->get_dentist($dentist,$dow);
			if($list_chair)
			{
				foreach ($list_chair as $data) 
				{
					if ($data['id'] != $id) 
					{

						$time_start_db = strtotime($data['start']);
						$time_end_db = strtotime($data['end']);

						if( ($time_start_db <= $start && $start <= $time_end_db) || ($time_start_db <= $end && $end <= $time_end_db) || $time_end_db >=$start )
						{
							if ($id != Null) {
								$resulf = 1; //ghế này đã được đặt
							}
							else
							{
								$resulf = 0; // ghế này chưa có người đặt
							}
						}
					}
				}
				if($resulf==0)
				{
					$command = Yii::app()->db->createCommand();
					$command->update('cs_schedule_chair',array('id_chair' => $_POST['chair']),'id=:id',array(':id'=>$id));
					print_r($resulf);
				}
				else {
					echo ($resulf);
				}
			}
			else 
			{
				
				$command = Yii::app()->db->createCommand();
				$command->update('cs_schedule_chair',array('id_chair' => $_POST['chair']),'id=:id',array(':id'=>$id));
				print_r($resulf);
			}

		}
		
		
	}
	public function actionUpdateBranch()
	{
		// echo ($_POST['id']);
		if(isset($_POST['value']) && $_POST['value'])
		{
			$id = $_POST['id'];
			$command = Yii::app()->db->createCommand();
			$command->update('cs_schedule_chair',array('id_branch'=> $_POST['value'],'id_chair'=>null),'id=:id',array(':id'=>$id));
			CsSchedule::model()->TimeJson();
			$list_chair=Chair::model()->findAllByAttributes(array('id_branch'=>$_POST['value']));
			$list_option ="";
			$list_option.='<option value="">Chọn</option>';
			foreach ($list_chair as $value) {
				$list_option.='<option value='.$value['id'].'>'.$value['name'].'</option>';
			}
			echo $list_option;
		}
	}
	public function actionAddNewTime()
	{
		if(isset($_POST['id_dentist']) && $_POST['id_dentist'])
		{   
			$count_record = count(CsScheduleChair::model()->findAllByAttributes(array('id_dentist'=>$_POST['id_dentist'],'dow'=>$_POST['dow'])));
			
			$count_record+=1;

			$id_dentist = $_POST['id_dentist'];
			$dow = $_POST['dow'];
			$time_start = $_POST['time_start'];
			$time_end = $_POST['time_end'];
			$branch = $_POST['branch'];

			$record_new = new CsScheduleChair();
			$record_new->id_dentist= $id_dentist;
			$record_new->dow=$dow;
			$record_new->start=$time_start;
			$record_new->end=$time_end;
			$record_new->id_branch=$branch;
			$record_new->save(false);
			CsSchedule::model()->TimeJson();
			$id_record_new = $record_new->id;

			$this->renderPartial('view_add_new',array('record'=>$record_new,'count_record'=>$count_record));
		}	
	}
	public function actionDeleteTime()
	{
		if(isset($_POST['id']) && $_POST['id'])
		{
			$command = Yii::app()->db->createCommand();
			$command->delete('cs_schedule_chair', 'id=:id', array(':id'=>$_POST['id']));
			CsSchedule::model()->TimeJson();
		}
	}
	public function actionChangeStatus()
	{
		if(isset($_POST['id_dentist']) && $_POST['id_dentist'])
		{
			// echo ($_POST['status']);
			$command = Yii::app()->db->createCommand();
			$command->update('cs_schedule_chair',array('status'=>$_POST['status']),'id_dentist=:x AND dow=:y',array(':x'=>$_POST['id_dentist'],':y'=>$_POST['dow']));
			$command->update('cs_schedule_relax',array('status'=>$_POST['status']),'id_dentist=:x AND dow=:y',array(':x'=>$_POST['id_dentist'],':y'=>$_POST['dow']));
			CsSchedule::model()->TimeJson();
		}
	}
	public function actionChangeTimeStart()
	{
		if(isset($_POST['time_start']) && $_POST['time_start'])
		{
			$id = $_POST['id_start'];

			$start = strtotime($_POST['time_start']);
			$end = strtotime($_POST['time_end']);
			$dow = $_POST['dow'];
			$branch = $_POST['branch'];
			// $chair = $_POST['chair'];
			$dentist=$_POST['dentist'];
			$resulf = 0;
			$command = Yii::app()->db->createCommand();
			$command->update('cs_schedule_chair',array('start' => $_POST['time_start']),'id=:id',array(':id'=>$id));
			CsSchedule::model()->TimeJson();
			echo 'Cập nhật thời gian thành công !';

			
		}
	}
	public function actionChangeTimeEnd()
	{
		if(isset($_POST['time_end_end']) && $_POST['time_end_end'])
		{
			$id = $_POST['id_end'];
			$start = strtotime($_POST['time_start_end']);
			$end = strtotime($_POST['time_end_end']);
			$dow = $_POST['dow'];
			$branch = $_POST['branch'];
			// $chair = $_POST['chair'];
			$dentist=$_POST['dentist'];

			$resulf = 0;
			$command = Yii::app()->db->createCommand();
			$command->update('cs_schedule_chair',array('end' => $_POST['time_end_end']),'id=:id',array(':id'=>$id));
			CsSchedule::model()->TimeJson();
			echo 'Cập nhật thời gian thành công !';

		}
	}
	public function actionAddNewBreak()
	{
		if(isset($_POST['id_dentist']) && $_POST['id_dentist'])
		{
			$id_dentist = $_POST['id_dentist'];
			$dow = $_POST['dow'];
			$status = $_POST['status'];
			// echo $status;
			// exit();
			$command = Yii::app()->db->createCommand();
			$data = $command->update('cs_schedule_relax',array('status'=>$status),'id_dentist=:id_dentist and dow=:dow',array(':id_dentist'=>$id_dentist,':dow'=>$dow));
			CsSchedule::model()->TimeJson();
			if ($data) {
				return 0;
			}else{
				return 1;
			}

		}
	}
	public function actionRemoveTimeRelax()
	{
		if(isset($_POST['id']) && $_POST['id'])
		{
			$command = Yii::app()->db->createCommand();
			$command->update('cs_schedule_relax',array('start'=>Null,'end'=>Null),'id=:id',array(':id'=>$_POST['id']));
			CsSchedule::model()->TimeJson();
			print_r("Success !");
		}
	}

	public function actionAddTimeOff()
	{
		if(isset($_POST['id_dentist']) && $_POST['id_dentist'])
		{
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$note_time_off = $_POST['note_time_off'];
		    $id_dentist = $_POST['id_dentist'];
		    $id_user = $_POST['id_user'];

		    $record_time_off = new CsScheduleTimeOff();
		    $record_time_off->id_dentist= $id_dentist;
		    $record_time_off->id_user= $id_user;
		    $record_time_off->start = $start_date;
		    $record_time_off->end = $end_date;
		    $record_time_off->note = $note_time_off;

		    $record_time_off->save(false);
		    if($record_time_off->id)
		    {
		    	$this->renderPartial('view_add_time_off',array('record_time_off'=>$record_time_off));
		    }
		}
	}
	public function actionShowUpdate()
	{
		if(isset($_POST['id']) && $_POST['id'])
		{
			$data_time_off_record = CsScheduleTimeOff::model()->findAllByAttributes(array('id_dentist'=>$_POST['id']));
			$this->renderPartial('staff_information',array('data_time_off_record'=>$data_time_off_record));
		}
	}
	public function actionDeleteTimeOff()
	{
		if(isset($_POST['id']) && $_POST['id'])
		{
			$command = Yii::app()->db->createCommand();
			$command->delete('cs_schedule_time_off', 'id=:id', array(':id'=>$_POST['id']));
			print_r("Thành công!");
		}
	}
	public function actionUpdateServiceUsers()
	{
		
		if(isset($_POST))
		{

			$co=true;
			$id_dentist 	= $_POST['id_dentist'];
			$codeNumber 	= $_POST['codeNumber_user'];	
			$name_user 		= $_POST['name_user'];
			$username 		= $_POST['username'];
			$password 		= $_POST['confirm_pass'];
			$email 			= $_POST['email'];
			$branch 		= $_POST['branch_user'];
			$phone  		= $_POST['phone'];
			if (isset($_POST['group_user'])) {
				$group_user = $_POST['group_user'];
			}
			else{
				$group_user=3;
			}
			$block = $_POST['block_user'];
			
			if (isset($_POST['list_service'])) {
				$list_service_user = $_POST['list_service'];
			}
			else
			{
				$list_service_user="";
			}
			
			$exp = $_POST['staff_exp'];
			$diploma = $_POST['staff_diploma'];
			$certificate = $_POST['staff_certificate'];

			$hinh=$_FILES["staffimageinput"]["error"]==0?$_FILES["staffimageinput"]["name"]:"";

			$data = GpUsers::model()->findByPk($id_dentist);
			$username_old = $data->username;

			if($hinh == "")
			{
				$co = false;
			}
			
			if($co)
			{
				$imageUploadSource     	= Yii::getPathOfAlias('webroot').'/upload/users/'; // duong dan den thu muc upload

				$fileImageUpload 		= $_FILES["staffimageinput"]["tmp_name"]; // file image upload moi

				$fileTypeUpload  		= explode('/',$_FILES['staffimageinput']["type"]);

				$imageNameUpload       	= date("dmYHis").'.'.$fileTypeUpload[1]; // name file image upload
				

				$resultImage 	=  GpUsers::model()->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);//luu anh len host

				$command 		= Yii::app()->db->createCommand();
				$resulf 		= $command->update('gp_users',array('image' => $imageNameUpload,),'id=:id',array(':id'=>$id_dentist));// update cap nhat database

				if($data['image'] && $resulf){ // cap nhat thanh cong anh moi xoa avatar cuu

					GpUsers::model()->deleteImageScaleAndCrop($data['image']);
				}
				echo $resulf;exit;

			}
			if($list_service_user)
			{
				$command = Yii::app()->db->createCommand();
				$command->delete('cs_service_users', 'id_user=:id_dentist', array(':id_dentist'=>$_POST['id_dentist']));
				for ($i=0; $i < count($list_service_user) ; $i++) 
				{ 
					$command->insert('cs_service_users',array(
							'id_user'=>$_POST['id_dentist'],
							'id_service'=>$list_service_user[$i],
							)
						);
				}
			}
			else
			{
				$command = Yii::app()->db->createCommand();
				$command->delete('cs_service_users', 'id_user=:id_dentist', array(':id_dentist'=>$_POST['id_dentist']));
			}
			if($password)
			{
				$command = Yii::app()->db->createCommand();
				$resulf = $command->update('gp_users',array(
					'name' => $name_user,
					'username' =>$username,
					'password' => md5($password),
					'email' =>$email,
					'id_branch' => $branch,
					'group_id' => $group_user,
					'block' => $block,
					'exp' =>$exp,
					'diploma' => $diploma,
					'certificate'=> $certificate,
					'phone' =>$phone,
				),'id=:id',array(':id'=>$id_dentist));

			}
			if($password =="")
			{
				$command = Yii::app()->db->createCommand();
				$resulf = $command->update('gp_users',array(
					'name' => $name_user,
					'username' =>$username,
					'email' =>$email,
					'id_branch' => $branch,
					'group_id' => $group_user,
					'block' => $block,
					'exp' => $exp,
					'diploma' => $diploma,
					'certificate'=> $certificate,
					'phone' =>$phone,
				),'id=:id',array(':id'=>$id_dentist));
			}
			
			if ($resulf) {

				$soap 	=  new SoapService();
				//$codeNumber_user,$name,$image,$username,$password,$email,$group_id,$block,$book
				$rs = $soap->webservice_server_ws('updateUser',array("4","b471b02f1ac491391b9bd92c6f3a0b54",$codeNumber,$name_user,$hinh,$username,$password,$email,$group_user,$block,0));
	
			/*	if ($password && $username) { //Dong bo user chat XMPP
					$model = new Chat;
					$searchUserChat = $model->getUserChat($username);
					if ($searchUserChat) {
						//update user chat
						$model->updateUserChat($username_old,$username,$password,$name_user,$email);
					}
					else
					{
						//insert user chat
						$rs = $model->addUserChat($username,$password,$name,$email);
					}
					
				}*/
				echo '<div class = "alert alert-success" id="success-alert"><a href = "#" class = "close" data-dismiss = "alert">&times;</a><strong>Thành Công!</strong> Đã cập nhật...</div>';
			}
			
		}
		else {
			echo "Error !";
		}
	}

	public function actionUpdateImageUser(){

		if($_FILES["staffimageinput"]["error"]==0){

			$id_dentist 	= $_POST['id_dentist'];

			$data = GpUsers::model()->findByPk($id_dentist);

			$imageUploadSource     	= Yii::getPathOfAlias('webroot').'/upload/users/'; // duong dan den thu muc upload

			$fileImageUpload 		= $_FILES["staffimageinput"]["tmp_name"]; // file image upload moi

			$fileTypeUpload  		= explode('/',$_FILES['staffimageinput']["type"]);

			$imageNameUpload       	= date("dmYHis").'.'.$fileTypeUpload[1]; // name file image upload
			
			$resultImage 	=  GpUsers::model()->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);//luu anh len host

			$command 		= Yii::app()->db->createCommand();
			$resulf 		= $command->update('gp_users',array('image' => $imageNameUpload,),'id=:id',array(':id'=>$id_dentist));// update cap nhat database

			if($data['image'] && $resulf){ // cap nhat thanh cong anh moi xoa avatar cuu

				GpUsers::model()->deleteImageScaleAndCrop($data['image']);
			}
			echo $imageNameUpload;exit;

		}


	}
	public function actionTestPassOld()
	{
		if(isset($_POST['pass_old']) && $_POST['pass_old'])
		{
			$data = GpUsers::model()->findByPk($_POST['id_dentist']);
			$pass_old = md5($_POST['pass_old']);
			// print_r($data['password']);
			// exit();
			if($data['password'] == $pass_old || $data['password'] =="" || $data['password']==NULL )
			{
				$result = 1;	
			}
			else
			{
				$result = 0;
				
			}
			print_r($result);
		}
	}

	function sanitizeTitle($string) {
	    if(!$string) return false;
	    $utf8 = array(
	            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	            'd'=>'đ|Đ',
	            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
	            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	            );
	    foreach($utf8 as $ascii=>$uni) $string = preg_replace("/($uni)/i",$ascii,$string);
	    $string = $this->utf8Url($string);
	    return $string;
	}

	function utf8Url($string){        
	    $string = strtolower($string);
	    $string = str_replace( "ß", "ss", $string);
	    $string = str_replace( "%", "", $string);
	    $string = preg_replace("/[^_a-zA-Z0-9 -]/", "",$string);
	    $string = str_replace(array('%20', ' '), '-', $string);
	    $string = str_replace("----","-",$string);
	    $string = str_replace("---","-",$string);
	    $string = str_replace("--","-",$string);
	    return $string;
	}

	//add user goal
	public function actionAddGoal()
	{ 	
		
		if($_POST['year'] && $_POST['month'] && $_POST['user_id'] && $_POST['revenue_target']&& $_POST['new_account_target'] && $_POST['appointment_target']&& $_POST['worktime_target']&&$_POST['check_td'])
		{		
			$result = CsTarget::model()->addGoal($_POST['year'],$_POST['month'],$_POST['user_id'],$_POST['revenue_target'], $_POST['new_account_target'],$_POST['appointment_target'],$_POST['worktime_target'],$_POST['check_td']);
			echo $result;
			
		} 

	}
	public function actionEditGoal(){
		
		$model = new CsTarget;
		$id = $_POST['id'];	
		$data = $model->findByAttributes(array('id'=>$_POST['id']));
		$this->renderPartial('update_goal',array('data'=>$data));
	}

	public function actionUpdateGoal()
	{ 	
		if(isset($_POST['id_goal']))
		{	
			$result = new CsTarget;	
			$result = CsTarget::model()->updateGoal($_POST['id_goal'],$_POST['month'],$_POST['revenue_target'], $_POST['new_account_target'],$_POST['appointment_target'],$_POST['worktime_target']);
			print_r( $result);
			
		} 

	}

}
