<?php

class FbController extends HController
{
	public $layout = '//layouts/layout_bookoke';

	public function actionIndex()
	{
		$session = Yii::app()->session;
		unset($session['cus']);
		$book    = array(
			'branch_id'     =>	'', 		'branch_address' => '',
			'branch_name'   => 	'',			'service_id'     =>	'',
			'service_name'  =>	'',			'service_len'    =>	'',
			'service_price' =>	'',
			'provider_id'   =>	'',			'provider_name'  =>	'',
			'date'          =>	'',			'time_start'     =>	'',
			'time_end'      =>	'',
			'id_customer'   =>	'',			'code_cf'        =>	'',
			'code_sch'      => 	'',
			'send'          => 	0,			'veriType'       => '',
			'opp'           =>	0,			'idOpp'			 =>	0,
			'id_fb'         =>  '',			'id_gg'			 =>	''
			);
		$session['book']    = 	$book;

		$this->render('index');
	}

	public function actionControlUrl()
	{
		$br =	isset($_POST['br'])	?	$_POST['br']	: '';
		$sv   =	isset($_POST['sv'])	?	$_POST['sv']	: '';

		$session = Yii::app()->session;
		$book = $session['book'];
		$step = 0;

		if($br) {
			$branch = Branch::model()->findByPk($br);
			$book['branch_id'] = $br;
			$book['branch_address'] = $branch->address;
			$book['branch_name'] = $branch->name;
			$step = 1;
		}
		if($sv) {
			$service = CsService::model()->findByPk($sv);
			$book['service_id'] = $sv;
			$book['service_name'] = $service->name;
			$book['service_len'] = $service->length;	
			$book['service_price'] = $service->price;	
			$step = 2;
		}

		$session['book']    = 	$book;

		echo $step;
	}

	public function actionBook_branch() 
	{	
		$session = Yii::app()->session;
		unset($session['cus']);
		$book    = array(
			'branch_id'     =>	'', 		'branch_address' => '',
			'branch_name'   => 	'',			'service_id'     =>	'',
			'service_name'  =>	'',			'service_len'    =>	'',
			'service_price' =>	'',
			'provider_id'   =>	'',			'provider_name'  =>	'',
			'date'          =>	'',			'time_start'     =>	'',
			'time_end'      =>	'',
			'id_customer'   =>	'',			'code_cf'        =>	'',
			'code_sch'      => 	'',
			'send'          => 	0,			'veriType'       => '',
			'opp'           =>	0,			'idOpp'			 =>	0,
			'id_fb'         =>  '',			'id_gg'			 =>	''
			);
		$session['book']    = 	$book;

		$branch = Branch::model()->findAllByAttributes(array('flag_online'=>1));
		$this->renderPartial('book_branch',array('br'=>$branch));
	}

	public function actionBook_services()
	{
		$id_branch =	isset($_POST['id_branch'])	?	$_POST['id_branch']	: '';
		$address   =	isset($_POST['address'])	?	$_POST['address']	: '';
		$name      =	isset($_POST['name'])	?	$_POST['name']	: '';

		$session   =	Yii::app()->session;
		$book      = 	$session['book'];


		// di tiep
		if($id_branch && $name) {
			$book['branch_id']      = $id_branch;
			$book['branch_address'] = $address;
			$book['branch_name']	= $name;
			$session['book']        = $book;
		}

		$services = VServicesHours::model()->getServiceList();

		$this->renderPartial('book_services',array('services'=>$services));
	}

	public function actionBook_provider()
	{
		$service_id    =	isset($_POST['service_id'])			?	$_POST['service_id'] 		: '';
		$service_name  =	isset($_POST['service_name'])		?	$_POST['service_name'] 		: '';
		$service_len   =	isset($_POST['service_len'])		?	$_POST['service_len'] 		: '';
		$service_price =	isset($_POST['service_price'])		?	$_POST['service_price'] 	: '';

		$session   =	Yii::app()->session;
		$book      = $session['book'];
		
		$id_branch = $book['branch_id'];

		// quay ve
		if(!$service_id || !$service_name || !$service_len || !$service_price) {
			if(isset($session['book'])){
				$service_id = $book['service_id'];
			}
		}
		// di tiep
		else {
				$book['service_id']    =	$service_id;
				$book['service_name']  =	$service_name;
				$book['service_len']   =	$service_len;
				$book['service_price'] =	$service_price;
				$session['book']       = 	$book;
		}

		$provider 	=	VServicesHours::model()->getDentistWorkOnl($id_branch, $service_id);
		$this->renderPartial('book_provider',array('provider'=>$provider));
	}

	public function actionBook_date()
	{
		$provider_id   =	isset($_POST['provider_id'])		?	$_POST['provider_id'] 		: '';
		$provider_name =	isset($_POST['provider_name'])		?	$_POST['provider_name'] 	: '';
		
		$session =	Yii::app()->session;
		$book    =	$session['book'];

		// quay ve
		if(!$provider_id || !$provider_name) {
			if(isset($book['provider_id'])) {
				$provider_id = $book['provider_id'];
			}
		}
		// di tiep
		else {
			$book['provider_id']   =	$provider_id;
			$book['provider_name'] =	$provider_name;
			$session['book']       =	$book;
		}
		$this->renderPartial('book_date');
	}

	public function actionGetTime()
	{
		$date    =	isset($_POST['date'])		?	$_POST['date'] 		: date('Y-m-d');
		
		$session =	Yii::app()->session;
		$book    =	$session['book'];
		
		$time    = CsSchedule::model()->getBlankTime($book['branch_id'],$book['service_id'],$book['provider_id'],$date,$date,$book['service_len']);
		echo json_encode($time);
	}

	public function actionBook_info()
	{	
		$date       =	isset($_POST['date'])			?	$_POST['date'] 			: '';
		$time_start =	isset($_POST['time_start'])		?	$_POST['time_start'] 	: '';
		$time_end   =	isset($_POST['time_end'])		?	$_POST['time_end'] 		: '';
		
		$session            =	Yii::app()->session;
		$book               =	$session['book'];
		
		$book['date']       =	$date;
		$book['time_start'] =	$time_start;
		$book['time_end']   =	$time_end;
		
		$session['book']    =	$book;

		$customer = '';
		if(isset($session['cus'])){
			$customer = $session['cus'];
		}

		$cus 			=	new Customer();	

		$this->renderPartial('book_info',array('cus'=>$cus, 'customer' => $customer));
	}

	public function actionGetCountryList()
	{
		$curpage = isset($_POST['page'])	?	$_POST['page']	:	1;
		$search  = isset($_POST['q'])		?	$_POST['q']		:	'';
		$limit   = isset($_POST['limit'])	?	$_POST['limit']	:	30;

	    $countryL 	= CsCountry::model()->searchCountry($curpage, $search, $limit);

	    $country = array();

		foreach ($countryL['data'] as $key => $value) {
			$country[] 		= 		array(
				'id' 		=> 		$value['code'],
				'text'		=> 		$value['country'],
			);
		}
		echo json_encode($country);
	}

	public function actionGetCityList()
	{
		$curpage 	= isset($_POST['page'])			?	$_POST['page']			:	1;
		$search 	= isset($_POST['q'])			?	$_POST['q']				:	'';
		$id_country	= isset($_POST['id_country'])	?	$_POST['id_country']	:	'1752';

	    $cityL 	= CsCity::model()->searchCity($curpage, $search, $id_country);

	    $city = array();

		foreach ($cityL['data'] as $key => $value) {
			$city[] 		= 		array(
				'id' 		=> 		$value['id'],
				'text'		=> 		$value['name_long'],
			);
		}
		echo json_encode($city);
	}

	// dang nhap khach hang bookoke
	public function actionLogUser()
	{
		$session =	Yii::app()->session;
		$book    =	$session['book'];	

		if(isset($_POST['Customer'])) {

			$log = Customer::model()->findByAttributes(array('username'=>$_POST['Customer']['email'], 'password' => md5($_POST['Customer']['password'])));

			if($log) {
				$session['cus'] = $log->attributes;
				echo 1;
			}
			else {
				unset($session['cus']);
				echo 0;
			}
		}
	}

	// tao tai khoan khach hang - dang ky bookoke
	public function actionCus_info()
	{
		$session =	Yii::app()->session;
		$book    =	$session['book'];	

		if(isset($_POST['Customer'])) {

			$cus = $this->addCustomerFB($_POST['Customer']);

			if(isset($cus['status']) && $cus['status'] == 1) {
				$book['id_customer'] =	$cus['id_customer'];
				$session['book']     =	$book;
				$session['cus']      = 	$cus['data'];
			}
			
			echo json_encode($cus);
		}
	}

	// cap nhat thong tin khach hang facebook
	public function actionAddCusFb()
	{
		$session =	Yii::app()->session;
		$book    =	$session['book'];	

		if(isset($_POST['Customer'])) {

			$cus = $this->addCustomerFB($_POST['Customer']);

			if(isset($cus['status']) && $cus['status'] == 1) {
				$book['id_customer'] =	$cus['id_customer'];
				$session['book']     =	$book;
				$session['cus']      = $cus['data'];
			}
			
			echo json_encode($cus);
		}
	}

	// Khach hang dang nhap bang facebook / google
	public function actionLogFb()
	{
		$userId  = isset($_POST['uId'])	?	$_POST['uId'] : '';
		$userNa  = isset($_POST['uNa'])	?	$_POST['uNa'] : '';
		$userEm  = isset($_POST['uEm'])	?	$_POST['uEm'] : '';
		$typeLog = isset($_POST['typeLog'])	?	$_POST['typeLog'] : '';

		if(!$userId || !$typeLog) {
			echo -1;		// ko co user Id facebook;
			exit;
		}

		$session =	Yii::app()->session;
		$book    =	$session['book'];

		if($typeLog == 1) {					// facebook
			$cus = Customer::model()->findByAttributes(array('id_fb'=>$userId));
		}
		elseif ($typeLog == 2) {			// google
			$cus = Customer::model()->findByAttributes(array('id_gg'=>$userId));
		}

		if($cus) {
			$book['id_customer'] =	$cus->id;
			$cus                 = 	$cus->attributes;
			$session['cus']      = 	$cus;
			$session['book']     =	$book;
			if($typeLog == 1)
				$book['id_fb'] = $userId;
			if($typeLog == 2)
				$book['id_gg'] = $userId;

			$logFB = 1;
		}
		else 
			$logFB = 0;

		echo $logFB;
	}

	// dang ky lich hen
	public function actionBook_verity()
	{
		$session 		=	Yii::app()->session;

		if(!isset($session['book']) || empty($session['book'])) {
			echo -1;
			exit;
		}

		$book =	$session['book'];
		$cus  = $session['cus'];

		// start_time = date + time_start
		$start_time		=	DateTime::createFromFormat('d/m/Y H:i:s', $book['date'] . ' ' . $book['time_start'])->format('Y-m-d H:i:s');
		$end_time		=	DateTime::createFromFormat('d/m/Y H:i:s', $book['date'] . ' ' . $book['time_end'])->format('Y-m-d H:i:s');

		if (isset($book['id_sch'])) {
			$sch 	= 	CsSchedule::model()->updateScheduleCheck(array(
				'id'         => $book['id_sch'],
				'id_dentist' => $book['provider_id'],
				'id_branch'  => $book['branch_id'],
				'id_chair'   => 0,
				'id_service' => $book['service_id'],
				'lenght'     => $book['service_len'],
				'start_time' => $start_time,
				'end_time'   => $end_time,
				'status'     => 0,
				'active'     => 0,
			));
		}
		else {
			$sch 		= 	CsSchedule::model()->addNewScheduleCheck(array(
				'id_branch'    =>	$book['branch_id'],
				'code'         =>	CsSchedule::model()->createCodeSchedule(),
				'code_confirm' =>	CsSchedule::model()->codeConfirm(), 
				'id_customer'  =>	$cus['id'], 
				'id_dentist'   =>	$book['provider_id'], 
				'id_author'    =>	0,
				'id_service'   =>	$book['service_id'], 
				'lenght'       => 	$book['service_len'], 
				'start_time'   =>	$start_time, 	// date + time_start
				'end_time'     =>	$end_time, 
				'source'       =>	2,
				'status'       =>	0, 
				'active'       =>	0,
			));
		}

		if($sch['status'] == 1){
			$book['id_sch']   =	$sch['success']['id'];
			$book['code_cf']  =	$sch['success']['code_confirm'];
			$book['code_sch'] =	$sch['success']['code'];
			$session['book']  =	$book;

			// la khach hang => book ko thanh cong dua vao co hoi
			if($cus['status'] == 1 && $book['opp'] == 0) {
				$opp   = CsOpportunity::model()->addNewDealOpportunity(array(
					'contact_person_name' => $cus['fullname'],
					'deal_value'          => $book['service_price'],
					'currency'            => 'VND',
					'finish_date'         => $start_time,
					'title'               => $book['service_name'],
					'email'               => $cus['email'],
					'phone'               => $cus['phone'],
				));

				if($opp){
					$book['idOpp'] = $opp;
					$book['opp']   = 1;
				}
			}
			else if($cus['status'] == 1 && $book['opp'] === 1){
				$upOpp = CsOpportunity::model()->updateDealOpportunity(array(
					'id'                  => $book['idOpp'],
					'title'               => $book['service_name'], 
					'deal_value'          => $book['service_price'], 
					'currency'            => 'VND',
					'contact_person_name' => $cus['fullname'],
				));
			}
			$session['book']  =	$book;
		}
		$this->renderPartial('book_verity', array('book'=>$session['book'],'cus'=>$session['cus'],'data'=>$sch));
	}

	// gui ma xac thuc
	public function actionBook_verity_sms()
	{
		$veriType = isset($_POST['veriType'])	?	$_POST['veriType']	:	1;
		
		$session  =	Yii::app()->session;
		$book     = $session['book'];
		$cus      = $session['cus'];

		$send             = 1;
		$book['send']     = $send;
		$book['veriType'] = $veriType;
		$session['book']  = $book;
		$save             = 1;

		if($book['send'] < 4){
			// gui sms
			if($veriType == 1){
				$text = "Ma xac thuc lich hen cua ban la : " . $book['code_cf'];
				$save = $this->sendSMS($cus['phone'], $text, 0 ,'', $cus['id'], $cus['fullname'], $book['code_sch']);
			}
			// gui email
			else if($veriType == 2) {
				$save = $this->SendEmail($cus['email'], $cus['fullname'], $book['code_cf'],1);
			}
		}
		if($save)
			$this->renderPartial('book_verity_sms');
	}

	// gui lai tin nhan
	public function actionReSend()
	{	
		$session  =	Yii::app()->session;
		$book     = $session['book'];
		$cus      = $session['cus'];

		$send            = (int)$book['send'];
		$save            = 0;

	
		if($book['send'] < 4){
			// cap nhat ma xac nhan
			$up = CsSchedule::model()->updateCodeConfirm($book['id_sch']);

			if($up){
				$text = "Ma xac thuc lich hen cua ban la : " . $up;

				$book['code_cf'] = $up;
				// gui tin nhan
				if($book['veriType'] == 1) {
					$save = $this->sendSMS($cus['phone'], $text, 0 ,'', $cus['id'], $cus['fullname'], $book['code_sch']);
				}
				// gui email
				else if($book['veriType'] == 2) {
					$save = $this->SendEmail($cus['email'], $cus['fullname'], $book['code_cf'],1);
				}

				if($save) {
					$book['send']    = $send + 1;
					$session['book'] = $book;
					echo json_encode(array('status'=>1,'ms'=>'Đã gửi mã xác nhận!'));
				}
				else {
					echo json_encode(array('status'=>-1,'ms'=>'Gửi thất bại!'));	
				}
			}
			else {
				echo json_encode(array('status'=>-2,'ms'=>'Có lỗi xảy ra!'));
			}
		}
		else {
			echo json_encode(array('status'=>0,'ms'=>'Đã gửi tin nhắn quá 3 lần!'));
		}
	}

	public function actionCheckCode()
	{
		$code = isset($_POST['code'])	?	$_POST['code']	:	1;

		$session  =	Yii::app()->session;
		$book     = $session['book'];
		$cus      = $session['cus'];

		// ma xac nhan trung khop
		if($code == $book['code_cf']) {
			// cap nhat lich hen: status = 1, active = 1
			$upSch = CsSchedule::model()->updateScheduleCode(array(
					'status' =>1, 
					'active' =>1,
					'id'     =>$book['id_sch'],
					'code'   =>$book['code_cf'],
				));
			if($upSch['status'] == 1 && isset($upSch['status'])) {
				// cap nhat khach hang: code_number + status = 1
				$start_time		=	DateTime::createFromFormat('d/m/Y H:i:s', $book['date'] . ' ' . $book['time_start'])->format('Y-m-d H:i:s');

				$upCus = Customer::model()->update_code_customer($cus['id']);
				if($book['opp'] == 0){
					$opp   = CsOpportunity::model()->addNewDealOpportunity(array(
						'contact_person_name' => $cus['fullname'],
						'deal_value'          => $book['service_price'],
						'currency'            => 'VND',
						'finish_date'         => $start_time,
						'title'               => $book['service_name'],
						'email'               => $cus['email'],
						'phone'               => $cus['phone'],
					));

					if($opp){
						$book['idOpp'] = $opp;
						$book['opp']   = 1;
					}
				}
				if($book['opp'] == 1 && $book['idOpp'] > 0)
				{
					$oppPlan = CsOpportunity::model()->addNewScheduleActivity(array(
						'id_opportunity'    => $book['idOpp'],
						//'type_schedule'     => '2',
						'datetime_schedule' => DateTime::createFromFormat('d/m/Y', $book['date'])->format('Y-m-d'),
						'time_schedule'     => $book['time_start'],
						'duration'          => DateTime::createFromFormat('i', $book['service_len'])->format('H:i:s'),
					 ));
				}

				echo 1;
			}
			else {
				echo json_encode($upSch);
			}
		}
		else {
			echo json_encode(array('status'=>0,'error'=>'Mã xác thực không trùng khớp!'));
		}
	}

	public function actionBook_complete()
	{
		$book = Yii::app()->session['book'];
	
		$this->renderPartial('book_complete');
	}

	public function actionGetNoti()
	{
		// 0: lich hen, 1: tiem nang
		$type = isset($_POST['type'])	?	$_POST['type']	:	0;

		$session  =	Yii::app()->session;
		$book     = $session['book'];
		$cus      = $session['cus'];

		if($type == 0) {
			$rs = CsNotifications::model()->saveNotificationSchedule(0,$book['provider_id'],$book['id_sch'],'add');
		}
		elseif ($type == 1) {
			$rs = CsNotifications::model()->saveNotificationCustomer(2,$cus['id'],'add');
		}

		echo json_encode($rs);

	}

	public function actionSchRemail()
	{
		$remain = isset($_POST['remain'])	?	$_POST['remain']	:	0;

		$session  =	Yii::app()->session;
		$book     = $session['book'];
		$cus      = $session['cus'];

		$sch 	= 	CsSchedule::model()->updateSchedule(array(
				'id'     => $book['id_sch'],
				'remain' => $remain,
			));

		echo $sch;
	}

	public function actionActiveAcc()
	{
		$id    = isset($_POST['id'])	?	$_POST['id']	:	0;
		$email = isset($_POST['email'])	?	$_POST['email']	:	0;
		$name  = isset($_POST['name'])	?	$_POST['name']	:	0;

		$session  =	Yii::app()->session;
		$book     = $session['book'];

		echo $this->SendEmail($email, $name, '',2, $id, $book['id_fb'], $book['id_gg']);
	}

	public function actionTest()
	{
		/* $soap = new SoapService();
        $test = $soap->webservice_server_ws('sendSMS',array('1','317db7dbff3c4e6ec4bdd092f3b220a8','84991645633911', 'cdsvs', 1, 'testsend', '', '', '', 1, 1 ));

		 echo "<pre>";
		 print_r($test);
		 echo "</pre>";
		 exit;*/
	}

	function randomPass()
	{
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$code = '';
		$len = 6;
		$strlen = strlen($str);
		for ($i=0; $i < $len ; $i++) { 
			$code .= $str[rand(0,$strlen-1)];
		}
		return $code;
	}

	function sendSMS($phone, $text, $id_author, $author, $id_customer, $customer, $id_schedule = '')
	{
		//return 1;
		return Sms::model()->sendSms($phone, $text, $id_author, $author, $id_customer, $customer, $id_schedule, 3, 3);
	}

	function SendEmail($from, $cus_name, $code_active, $type = 1, $id_cus = '', $id_fb = '', $id_gg='')
	{
		$mailHost      = 'mail.bookoke.com';
		$mailPort      = '25';
		$username      = 'support@bookoke.com';
		$password      = 'callneX@2017';
		$mailFrom      = "support@bookoke.com";
		// gui mail ma xac nhan lich hen
		if($type == 1)
		{
			if(!$code_active)
				return -1;
			$title         = 'Mã xác nhận lịch hẹn: ' . $code_active;
			$mailTo        = $from;
			$email_content = $this->renderPartial('sendMailCode',array('fullname' => $cus_name, 'code' => $code_active), true);
		}
		// gui mail xac nhan tai khoan
		elseif ($type == 2) {
			if(!$id_cus)
				return -1;
			$title  = 'BookOke Support';
			$mailTo = $from;
			$pass   = $this->randomPass();
			$activation = md5($from.time());

			$dataCus['code_confirm'] = $activation;
			$dataCus['username'] = $from;
			$dataCus['password'] = md5($pass);
			if($id_gg)
				$dataCus['id_gg'] = $id_gg;
			if($id_fb)
				$dataCus['id_fb'] = $id_fb;

			$data = Customer::model()->updateByPk($id_cus,$dataCus);

			$mailifo = array('fullname' => $cus_name, 'email' => $from, 'pass' => $pass);

			$email_content  = $this->renderPartial('application.modules.itemsCustomers.views.accounts.view_sendmailconfim',array('mail_info'=>$mailifo,'activation'=>$activation),true);
		}

		$rs=  CsNotifications::model()->sendMail($mailHost,$mailPort,$username,$password,$mailFrom,$mailTo,$title,$email_content);

		return $rs;
	}
	function addCustomerFB($dataCustomer)
	{
		$cus             = new Customer();
		$cus->attributes = $dataCustomer;
		$cus->phone_sms  = $cus->phone;
		$cus->id_source  = 10;
		$dataCustomer['id_source'] = 10;

		$valid = $cus->validate();
		if(!$valid) {
			$error = $cus->getErrors();
			if(isset($error['email'])){
				$cusDb = $cus->findByAttributes(array('email'=>$dataCustomer['email']));

				// co thong tin dang nhap bang facebook va google - chua co thong tin tai khoan bookOke
				if($cusDb->username == '')
				{
					if ($cusDb->id_fb == '' || $cusDb->id_gg == '') {
						return array('status' => -1, 'email' => $dataCustomer['email'], 'id'=>$cusDb->id, 'name' => $cusDb->fullname);
					}
				}
				// co thong tin tai khoan bookoke - dang nhap bang facebook va google
				else 
				{
					if((isset($dataCustomer['id_fb']) && $dataCustomer['id_fb']) || (isset($dataCustomer['id_gg']) && $dataCustomer['id_gg']))
					{
						$session  =	Yii::app()->session;
						$book     = $session['book'];
						if($dataCustomer['id_fb'])
							$book['id_fb'] = $dataCustomer['id_fb'];
						if($dataCustomer['id_gg'])
							$book['id_gg'] = $dataCustomer['id_gg'];
						$session['book'] = $book;
						return array('status' => -1, 'email' => $dataCustomer['email'], 'id'=>$cusDb->id, 'name' => $cusDb->fullname);
					}
				}
			}
			return array('status'=>0, 'error'=> $cus->getErrors());
		}

		if(!isset($dataCustomer['id_fb']) || !$dataCustomer['id_fb']){
			unset($cus->id_fb);
			unset($dataCustomer['id_fb']);
		}
		elseif (!isset($dataCustomer['id_gg']) || !$dataCustomer['id_gg']) {
			unset($cus->id_gg);
			unset($dataCustomer['id_gg']);
		}

		$phone = CsLead::model()->getVnPhone($cus->phone);
		
		$idLead          = CsLead::model()->findByAttributes(array('phone'=>$phone));

		// ton tai so phone trong CsLead
		if($idLead) {
			$cusNew = CustomerLead::model()->addCustomerLead($dataCustomer,$idLead->id);
		}
		// khong ton tai so phone trong CsLead
		else {
			$cusNew = CustomerLead::model()->addlead($cus->attributes);
		}

		return $cusNew;
	}
}