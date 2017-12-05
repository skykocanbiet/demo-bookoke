<?php

class BookController extends HController
{
	public $layout = '//layouts/layout_bookoke';

	public function actionIndex()
	{
		unset(Yii::App()->session['book']);

		$services = VUserHour::model()->getServiceList(1);

		$this->render('index',array('services'=>$services,'id_company'=>1));
	}

	public function actionBook_provider()
	{
		$id_company			=	isset($_POST['id_company'])			?	$_POST['id_company'] 		: '';
		$service_id			=	isset($_POST['service_id'])			?	$_POST['service_id'] 		: '';
		$service_name		=	isset($_POST['service_name'])		?	$_POST['service_name'] 		: '';
		$service_len		=	isset($_POST['service_len'])		?	$_POST['service_len'] 		: '';
		$service_price		=	isset($_POST['service_price'])		?	$_POST['service_price'] 	: '';

		$session 		=	Yii::app()->session;

		$book = array(
			'id_company'	=>	$id_company,
			'service_id'	=>	$service_id,
			'service_name'	=>	$service_name,
			'service_len'	=>	$service_len,
			'service_price'	=>	$service_price,
			'provider_id'	=>	'',
			'provider_name'	=>	'',
			'date'			=>	'',
			'time_start'	=>	'',
			'time_end'		=>	'',
			'id_customer'	=>	'',
			'code_cf'		=>	'',
		);

		$session['book']	= 	$book;

		$provider 	=	VUserHour::model()->getDentistWork($id_company, $service_id);

		$this->renderPartial('book_provider',array('provider'=>$provider));
	}

	public function actionBook_date()
	{
		$provider_id			=	isset($_POST['provider_id'])		?	$_POST['provider_id'] 		: '';
		$provider_name		=	isset($_POST['provider_name'])		?	$_POST['provider_name'] 	: '';
		
		$session 		=	Yii::app()->session;

		$book 				=	$session['book'];

		$book['provider_id']		=	$provider_id;
		$book['provider_name']		=	$provider_name;

		$session['book']		=	$book;

		$this->renderPartial('book_date');
	}

	public function actionGetTime()
	{
		$date	=	isset($_POST['date'])		?	$_POST['date'] 		: '';

		$session 	=	Yii::app()->session;

		$book 			=	$session['book'];

		$time 		= CsSchedule::model()->getBlankTime($book['id_company'],$book['service_id'],$book['provider_id'],$date,$date,$book['service_len']);
		
		echo json_encode($time);
	}

	public function actionBook_info()
	{	
		$date			=	isset($_POST['date'])			?	$_POST['date'] 			: '';
		$time_start		=	isset($_POST['time_start'])		?	$_POST['time_start'] 	: '';
		$time_end		=	isset($_POST['time_end'])		?	$_POST['time_end'] 		: '';
		
		$session 		=	Yii::app()->session;

		$book 				=	$session['book'];

		$book['date']			=	$date;
		$book['time_start']		=	$time_start;
		$book['time_end']		=	$time_end;

		$session['book']	=	$book;

		print_r($session['book']);

		$cus 			=	new CsScheduleCustomer();	

		$this->renderPartial('book_info',array('cus'=>$cus));
	}

	public function actionGetCountryList()
	{
		$curpage 	= isset($_POST['page'])		?	$_POST['page']	:	1;
		$search 	= isset($_POST['q'])		?	$_POST['q']		:	'';

	    $countryL 	= CsCountry::model()->searchCountry($curpage, $search);

	    if(!$countryL){
	    	echo -1;
	    	exit();
	    }

		foreach ($countryL as $key => $value) {
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
		$id_country	= isset($_POST['id_country'])	?	$_POST['id_country']	:	'';

	    $cityL 	= CsCity::model()->searchCity($curpage, $search, $id_country);

	    if(!$cityL){
	    	echo -2;
	    	exit();
	    }

		foreach ($cityL as $key => $value) {
			$city[] 		= 		array(
				'id' 		=> 		$value['id'],
				'text'		=> 		$value['name_long'],
			);
		}
		echo json_encode($city);
	}

	// tao tai khoan khach hang
	public function actionCus_info()
	{
		$model 		= 	new CsScheduleCustomer();

		$session 		=	Yii::app()->session;
		$book 				=	$session['book'];	

		if(isset($_POST['CsScheduleCustomer'])) {
			$model->attributes 		= 	$_POST['CsScheduleCustomer'];
			$model->id_company		=	$book['id_company'];

			if($model->validate()){
				if($model->save()){

					
					$book['id_customer']		=	$model->id;
					$session['book']		=	$book;

					echo json_encode(array('status'=>1,'data'=>$model->id));
				}
				Yii::app()->end();
			}
			else{
				$error = CActiveForm::validate($model);
                if($error!='[]')
                	Yii::app()->end($error);
			}
			
		}
	}

	// dang ky lich hen
	public function actionBook_verity()
	{
		$session 		=	Yii::app()->session;

		if(!isset($session['book']) || empty($session['book'])) {
			echo -1;
			exit;
		}

		$book 			=	$session['book'];
		// start_time = date + time_start
		$start_time		=	DateTime::createFromFormat('d/m/Y H:i', $book['date'] . ' ' . $book['time_start'])->format('Y-m-d H:i:s');
		$end_time		=	DateTime::createFromFormat('d/m/Y H:i', $book['date'] . ' ' . $book['time_end'])->format('Y-m-d H:i:s');

		$sch 		= 	CsSchedule::model()->addNewScheduleCheck(array(
			'id_company'		=>	$book['id_company'],
			'code'				=>	CsSchedule::model()->createCodeSchedule(),
			'code_confirm'		=>	CsSchedule::model()->CreateCodeConfirm(), 
			'id_customer'		=>	$book['id_customer'], 
			'id_user'			=>	$book['provider_id'], 
			'id_author'			=>	0,
			'id_service'		=>	$book['service_id'], 
			'lenght' 			=> 	$book['service_len'], 
			'start_time'		=>	$start_time, 	// date + time_start
			'end_time'			=>	$end_time, 
			'source'			=>	1,
			'status'			=>	0, 
			'active'			=>	0,
		));

		if($sch){
			$book['code_cf']		=	$sch->code_confirm;
			$session['book']		=	$book;
			$this->renderPartial('book_verity');
		}
		else {
			echo $sch;
			exit;
		}
	}

	public function actionBook_verity_sms()
	{
		$this->renderPartial('book_verity_sms');
	}

	public function actionBook_complete()
	{
		$this->renderPartial('book_complete');
	}

	


	protected function performAjaxValidation($model)
	{
        
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}