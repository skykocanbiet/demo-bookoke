<?php

class CalendarController extends Controller
{
	public $layout = '//layouts/layouts_menu';
	public $status_arr = array(
		'1'  => 'Lịch mới',
		'2'  => 'Đã đến',
		'5'  => 'Bỏ về',
		'3'  => 'Vào khám',
		'4'  => 'Hoàn tất',
		'0'	 => 'Không làm việc',
		'-1' => 'Hủy hẹn',
		'-2' => 'Không đến',
	);
	public $stNew = array(
		'2'  => 'Đã đến',
		'1'  => 'Lịch mới',
	);
	public $st1 = array(
		'1'  => 'Lịch mới',
		'2'  => 'Đã đến',
		'-1' => 'Hủy hẹn',
		'-2' => 'Không đến',
	);
	public $st2 = array(
		'2'  => 'Đã đến',
		'3'  => 'Vào khám',
		'5'  => 'Bỏ về',
	);
	public $st3 = array(
		'5'  => 'Bỏ về',
		'3'  => 'Vào khám',
		'4'  => 'Hoàn tất',
	);
	public $st0 = array(
		'1'  => 'Lịch mới',
		'2'  => 'Đã đến',
		'-2' => 'Không đến',
	);
	public $st5 = array(
		'5'  => 'Bỏ về',
		'3' => 'Vào khám',
		'2'  => 'Đã đến',
	);
	
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

	public function actionIndex($id_dentist='')
	{	
		$group_id =  Yii::app()->user->getState('group_id');
		$role = 1;			// xem tất cả

		if($group_id == Yii::app()->params['id_group_admin'] || $group_id == Yii::app()->params['id_group_subadmin']) {
			$role = 1;
		}elseif ($group_id == Yii::app()->params['id_group_dentist']) {
			$role = 0;
		}elseif ($group_id == Yii::app()->params['id_group_receptionist']) {
			$role = 1;	
		}else {
			$role = 1;
		}

		$BranchList = CsSchedule::model()->getBranchList();
		$branch[0] = "Xem tất cả";
		foreach ($BranchList as $key => $value) {
			$branch[$value['id']] = $value['name'];
		}

		$sch = new CsSchedule();
		$cus = new Customer();

		$cusSeg = Segment::model()->findAllByAttributes(array('status'=>1));

		$this->render('index',array(
			"status_sch" =>	$this->status_arr,
			'role'       =>	$role,
			'id_user'    =>	Yii::app()->user->getState('user_id'),
			'name_user'  =>	Yii::app()->user->getState('user_name'),
			'branch'     =>	$branch,
			'sch'        => $sch,
			'cus'        =>	$cus,
			'group_id'   => $group_id,
			'cusSeg'     => CHtml::listData($cusSeg,'id','name'),
		));
}

	public function actionGetDentistList() 
	{
		$page        = isset($_POST['page'])		?	$_POST['page']			:1;
		$search      = isset($_POST['q'])			?	$_POST['q']				:'';
		$id_branch   = isset($_POST['id_branch'])	?	$_POST['id_branch']		:'';
		$id_resource = isset($_POST['id_resource'])	?	$_POST['id_resource']	:'';

	    $item = 50;
		$dentistList = VServicesHours::model()->searchDentistCalendar($page, $item, $id_branch, $id_resource, $search);

	    $dentist = array();
	    
		if($dentistList['numRow'] > 0)
		{
			$dentist[] = array(
				'id'    => 0,
				'text'  => 'Xem tất cả',
			);
			foreach ($dentistList['data'] as $key => $value) {
				$dentist[] = array(
					'id'    => $value['id_dentist'],
					'text'  => $value['dentist_name'],
					'title' => $value['dentist_name'],
				);
			}
			
		}
		echo json_encode($dentist);
	}

	public function actionGetDentistServiceChair()
	{
		$id_branch 	= 	isset($_POST['id_branch'])	?	$_POST['id_branch']	:'';
		$time 		= 	isset($_POST['time'])		?	$_POST['time']		:'';
		$dow 		= 	isset($_POST['dow'])		?	$_POST['dow']		:'';

		// dentist
		$dentist = VWorkHours::model()->find(array(
			'select'	=>	'*',
			'condition'	=>	"id_branch = $id_branch AND `start` <= '$time' AND '$time' <= `end` AND dow = $dow",
		));

		$service = array();

		if(!$dentist) {
			echo 0;
			exit;
		}
		
		echo json_encode(array('dentist'=>$dentist->attributes));
	}

	public function actionGetCustomersList()
	{
		$page 				= isset($_POST['page'])?$_POST['page']:1;
		$search 			= isset($_POST['q'])?$_POST['q']:'';

	    $item 			  = 50;
	    $search_params    = 'AND ( `customer`.`status` = 1 OR  `customer`.`status` = 0 ) ';

	    $search_params	 .= 'AND ( (`fullname` LIKE "%'.$search.'%" ) OR (`code_number` LIKE "%'.$search.'%" ) OR (`phone` LIKE "%'.$search.'%" ) OR (identity_card_number LIKE "%'.$search.'%") )';

	  /*  if(date_create_from_format('d/m/Y',$search)){
	    	$search_params .= "OR (birthdate = '". date_format(date_create_from_format('d/m/Y',$search),'Y-m-d') . "')";
	    }*/
	    
	    $customerList = Customer::model()->searchCustomers('','',' '.$search_params,$item,$page);
	  
	    $customer = array();

	   
	    if($customerList['paging']['num_row'] > 0  )
	    {
	    	foreach ($customerList['data'] as $key => $value) {
				$customer[] = array(
					'id'                   => $value['id'],
					'text'                 => $value['fullname'],
					'code_number'          => $value['code_number'],	
					'phone'                => $value['phone'],
					'img'                  => $value['image'],
					'email'                => $value['email'],
					'gender'               => $value['gender'],
					'birthdate'            => $value['birthdate'],
					'identity_card_number' => $value['identity_card_number'],
					'id_country'           => $value['id_country'],
					'adr'                  => $value['address'],
				);
			}
	    }
		echo json_encode($customer);
	}

	public function actionGetServiceList() 
	{
		$page 		= isset($_POST['page'])			?	$_POST['page']		:1;
		$search 	= isset($_POST['q'])			?	$_POST['q']			:'';
		$id_dentist = isset($_POST['id_dentist'])	?	$_POST['id_dentist']:'';
		$up         = isset($_POST['up'])			?	$_POST['up']		:0;
	    
	    $servicesList = CsSchedule::model()->getDentistServices($page,$id_dentist,$search);
	    $services[] = array();

	    if($up == 0) {
	    	$services[] = array(
				'id' 	=> '0',
				'text' 	=> 'Không làm việc',
				'len'	=> 30,
			);
	    }

		foreach ($servicesList as $key => $value) {
			$services[] = array(
				'id' 	=> $value['id_service'],
				'text' 	=> $value['service_name'],
				'len'	=> $value['service_length'],
			);
		}
		
		echo json_encode($services);
	}

	public function actionGetChairList() 
	{
		$page = isset($_POST['page'])?$_POST['page']:1;
		$search = isset($_POST['q'])?$_POST['q']:'';
		$id_branch = isset($_POST['id_branch'])?$_POST['id_branch']:'';

	    $item = 30;

	    $chairList = Chair::model()->findAllByAttributes(array('id_branch'=>$id_branch));
	    if(!$chairList)
	    {
	    	echo -1;exit();
	    }
		foreach ($chairList as $key => $value) {
			$chair[] = array(
				'id' => $value['id'],
				'text' => $value['name'],
			);
		}
		echo json_encode($chair);
	}

	public function actionGetBranchList()
	{
		$BranchList = CsSchedule::model()->getBranchList();

		foreach ($BranchList as $key => $value) {
			$branch[] = array(
				'id' => $value['id'],
				'text' => $value['name'],
			);
		}
		echo json_encode($branch);
	}

	public function actionGetResourcesDentistList() 
	{
		$id_resource 	= isset($_POST['id_resource'])	?	$_POST['id_resource']	:	false;
		$id_branch 		= isset($_POST['id_branch'])	?	$_POST['id_branch']		:	1;

		$businessHours = array();
		$t = 0;

		$dentistL = VServicesHours::model()->getResourcesDentist($id_resource,$id_branch);

		if(!$dentistL) {
			echo "-1";
			exit;
		}

		foreach ($dentistL as $key => $value) {
			$id = $value['id_dentist'];
			$nextId = next($dentistL);

			if($id != $nextId['id_dentist'] && $businessHours) {
				$dentist[] = array(
					'id' 			=> 	$value['id_dentist'],
					'title' 		=> 	$value['dentist_name'],
					//'businessHours'	=> 	$businessHours
				);
				$t=0;
				$businessHours = array();
			}
			else {
				$businessHours[$t++] = array(
					'dow'		=>	$value['dow'],
					'start'		=> 	$value['start'],
					'end'		=>	$value['end']
				);
			}
		}
		
		echo json_encode(array('businessHours'=>'','data'=>$dentist));
	}

	public function actionGetResourcesChairList() 
	{
		$id_resource 	= isset($_POST['id_resource'])	?	$_POST['id_resource']	:	false;
		$id_branch 		= isset($_POST['id_branch'])	?	$_POST['id_branch']		:	1;

		$businessHours= '';
		$branch 	=	Branch::model()->findByPk($id_branch);

		$businessHours = array(
			array(
				'dow'	=>	'1,2,3,4,5,6',
				'start'	=>	$branch['start_work'],
				'end'	=>	$branch['start_break'],
			),
			array(
				'dow'	=>	'1,2,3,4,5,6',
				'start'	=>	$branch['end_break'],
				'end'	=>	$branch['end_work'],
			)
		);

		if($id_resource){
			$chairList = Chair::model()->findByPk($id_resource);
			$chair[] = array(
				'id' => $chairList['id'],
				'title' => $chairList['name'],
				);
		}
		else {
			$chairList = Chair::model()->findAllByAttributes(array('id_branch'=>$id_branch));

			foreach ($chairList as $key => $value) {
				$chair[] = array(
					'id' => $value['id'],
					'title' => $value['name'],
				);
			}
		}
		echo json_encode(array('businessHours'=>$businessHours,'data'=>$chair));
	}

	public function actionCheckTime()
	{
		$id_dentist  = isset($_POST['id_dentist']) 	? $_POST['id_dentist'] 	: false;
		$start       = isset($_POST['start']) 		? $_POST['start'] 		: false;
		$end         = isset($_POST['end']) 		? $_POST['end'] 		: false;
		$id_schedule = isset($_POST['id_schedule']) ? $_POST['id_schedule'] : 0;
		$id_branch   = isset($_POST['id_branch']) ? $_POST['id_branch'] : 0;

		$stat =	DateTime::createFromFormat('Y-m-d H:i:s', $start)->format('Y-m-d H:i:s');
		$end  = DateTime::createFromFormat('Y-m-d H:i:s', $end)->format('Y-m-d H:i:s');

		if(!$start || !$end){
			echo json_encode(array('status'=>-1,'ms'=>'thoi gian khong dung'));		// thoi gian khong dung
			exit;
		}

		$checkTime 		= 	CsSchedule::model()->checkWorkingTime($id_dentist,$start,$end,$id_branch);

		if($checkTime <= 0) {
			echo json_encode(array('status'=>-2,'ms'=>'bac sy khong lam viec'));		// bac sy khong lam viec
			exit;
		}

		$check = CsSchedule::model()->checkScheduleEvent($start,$end,$id_dentist,$id_schedule);
		if(!$check) {
			echo json_encode(array('status'=>-3, 'ms'=>'lich hen trung'));	// lich hen trung
			exit;
		}

		echo json_encode(array('status'=>1,'data'=>$checkTime));
	}

	public function actionCheckScheduleEvent()
	{
		$id_dentist  = isset($_POST['id_dentist']) ? $_POST['id_dentist'] : false;
		$start       = isset($_POST['start']) ? $_POST['start'] : false;
		$end         = isset($_POST['end']) ? $_POST['end'] : false;
		$id_schedule = isset($_POST['id_schedule']) ? $_POST['id_schedule'] : 0;

		if($id_dentist && $start && $end){
			echo $check = CsSchedule::model()->checkScheduleEvent($start,$end,$id_dentist,$id_schedule);
		}
		else {
			echo -1;		// không có đủ dữ liệu
		}
	}

	public function eventArr($events)
	{
		$status             = $events['status'];
		$color 				= status_sch::getStatusColor($status);

		if($status == 0) {
			$start_text = "Không làm việc";
		}
		else {
			$start_text = $this->status_arr[$events['status']];
		}

		$resourceId = $events['id_dentist'];

		return array(
		 	// schedule
				'id'    => $events['id'],
				'title' => $events['fullname'],
				'start' => $events['start_time'],
				'end'   => $events['end_time'],
				'id_dentist' => $events['id_dentist'],
				'dentist'    => $events['name_dentist'],
				'id_service' => $events['id_service'],
				'services'  => $events['name_service'],
				'time'      => $events['lenght'],
				'id_author' => $events['id_author'],
				'setBy'     => ($events['author']) ? $events['author'] : "Khách hàng",
				'status'    => $events['status'],
				'status_text'     => $start_text,
				'backgroundColor' => $color,
				'borderColor'     => $color,
				'className'       => 'schTime',
				'codeSch'         => $events['code_schedule'],
				'branch_name'	=> $events['name_branch'],
				
				// customer
				'id_patient' => $events['id_customer'],
				'code_pt'    => $events['code_number'],
				'patient'    => $events['fullname'],
				'phone'      => $events['phone'],
				'img'        => $events['image_customer'],
				
				// quotation
				'id_quotation' => $events['id_quotation'],
				'id_invoice'   => $events['id_invoice'],
				
				// resource
				'resourceId' => $resourceId,
				//'overlap'    => false,
			
			/*'overlap' 			=> $overlap,*/
			/*'startEditable' 	=> $startEditable,
			'resourceEditable' 	=> $resourceEditable,*/
	 	);
	}

	// show all event
	public function actionShowEvents()
	{
		$dentist 	= isset($_POST['dentist']) 	? $_POST['dentist'] : false;
		$patient 	= isset($_POST['patient']) 	? $_POST['patient'] : false;
		$branch 	= isset($_POST['branch']) 	? $_POST['branch'] 	: 1;

		$schedule = CsSchedule::model()->getListSchedule($dentist,$patient,$branch);

		if(!$schedule) { echo 0; exit; }

		foreach ($schedule as $key => $value) {
			$events[] = $this->eventArr($value);
		}

		Yii::app()->session['sch'] = $events;

		$jstr = json_encode($events);
		echo $jstr;
	}

	public function actionAddEvent()
	{
		// type = 1 : bac sy, type = 2: ghe
		$type 				= isset($_POST['type']) 		? $_POST['type'] 		: 1;
		
		$id_customer 		=	0;
		// if(isset($_POST['Customer']['cus_seg']) && $_POST['Customer']['cus_seg'] && isset($_POST['CsSchedule']['id_service']) && $_POST['CsSchedule']['id_service']){
		// 	$checkSerSeg = VPricebookServices::model()->checkServicesInPriceBookWithSegment($_POST['Customer']['cus_seg'], $_POST['CsSchedule']['id_service']);

		// 	if(!$checkSerSeg){
		// 		echo -1;
		// 		exit;
		// 	}
		// }
		if(isset($_POST['Customer'])){
			if(!$_POST['Customer']['id']) {
				$customer    = Customer::model()->addCustomer(array(
					'fullname'   =>	$_POST['Customer']['fullname'],
					//'address'  =>	$_POST['Customer']['address'],
					'phone'      =>	$_POST['Customer']['phone'],
					'email'      =>	$_POST['Customer']['email'],
					//'image'    =>	$_POST['Customer']['image'],
					'id_country' =>	$_POST['Customer']['id_country'],
					'gender'     =>	$_POST['Customer']['gender'],
					'birthdate'  =>	$_POST['Customer']['birthdate'],
					'status'     =>	'1',
					'id_branch'  => Yii::app()->user->getState('user_branch'),
					'id_segment' =>$_POST['Customer']['cus_seg'],
					'identity_card_number' =>	$_POST['Customer']['identity_card_number'],
				));

				if(isset($customer['data']) && $customer['status'] == 1) {
					$data = $customer['data'];
					$id_customer 		=	$data->id;
				}
				else {
					echo json_encode($customer);
					exit;
				}
			}
			else {
				$id_customer		=	$_POST['Customer']['id'];
			}
		}
		if(isset($_POST['CsSchedule']) && $id_customer) {

			$id_note = '';
			if($_POST['CsSchedule']['note']) {
				$note = CustomerNote::model()->addnote(array(
						'note'        => $_POST['CsSchedule']['note'],
						'id_user'     => $_POST['CsSchedule']['id_author'],
						'id_customer' => $id_customer,
						'flag'        => 1,			// 1: lich hen
						'important'   => 0,
						'status'      => 1,
				));
				if(isset($note['id']))
					$id_note = $note['id'];
			}

			$add 		= CsSchedule::model()->addNewSchedule(array(
				'id_customer' =>	$id_customer,
				'id_dentist'  =>	$_POST['CsSchedule']['id_dentist'], 
				'id_author'   =>	$_POST['CsSchedule']['id_author'], 
				'id_branch'   =>	$_POST['CsSchedule']['id_branch'], 
				'id_chair'    =>	$_POST['CsSchedule']['id_chair'], 
				'id_service'  =>	$_POST['CsSchedule']['id_service'], 
				'lenght'      =>	$_POST['CsSchedule']['lenght'], 
				'start_time'  =>	$_POST['CsSchedule']['start_time'], 
				'end_time'    =>	$_POST['CsSchedule']['end_time'], 
				'status'      =>	$_POST['CsSchedule']['status'], 
				'active'      =>	1, 
				'id_note'     =>	$id_note
			));

			if($add) {
				$cus_st	=	Customer::model()->updateStatusScheduleOfCustomer($id_customer,$_POST['CsSchedule']['status']);
			}

			$event = VSchedule::model()->findByAttributes(array('id'=>$add['id']));

			$events = $this->eventArr($event);
		}
		if(isset($_POST['CsMedicalHistoryAlert']) && $id_customer) {
			
			$med     =	$_POST['CsMedicalHistoryAlert']['id_medicine_alert'];
			$meNote  = 	$_POST['CsMedicalHistoryAlert']['note'];
			$md_his  =	array();
			$md_note = array();

			foreach ($med as $key => $value) {
				if($value != 0){
					$md_his[]  = $key;
					$md_note[] = $meNote[$key];
				}
			}

			$upMed 	=	Customer::model()->updateMedicalHistoryAlert($id_customer,$md_his,$md_note);
		}
		echo json_encode(array('status'=>1,'ev'=>$events,'dt'=> $event->attributes));
		exit;
	}

	public function actionAddBreak()
	{
		if(isset($_POST['CsSchedule'])){

			$sch = CsSchedule::model()->addNewSchedule(array(
					'id_dentist'   =>	$_POST['CsSchedule']['id_dentist'],
					'id_author'    =>	$_POST['CsSchedule']['id_author'],
					'id_branch'    =>	$_POST['CsSchedule']['id_branch'],
					'id_service'   =>	0,
					'lenght'       =>	$_POST['CsSchedule']['lenght'],
					'start_time'   =>	$_POST['CsSchedule']['start_time'],
					'end_time'     =>	$_POST['CsSchedule']['end_time'],
					'status'       =>	0,
					'active'       =>	1,
					'note'         =>	$_POST['CsSchedule']['note'],
			));

			$event  = VSchedule::model()->findByAttributes(array('id'=>$sch['id']));
			$events = $this->eventArr($event);
			echo json_encode($events);
		}
	}

	public function actionMedicalAlert()
	{
		$id_customer 	= isset($_POST['id_customer']) 	? $_POST['id_customer'] 	: false;
		
		$al 		= 	CsMedicalHistoryAlert::model()->findAllByAttributes(array('id_customer'=>$id_customer));

		$als = array();

		foreach ($al as $key => $value) {
			$als[$value['id_medicine_alert']] = $value['note'];
		}

		echo json_encode($als);

		exit;
		$id_customer 	= isset($_POST['id_customer']) 	? $_POST['id_customer'] 	: false;

		if($id_customer) {
			$al 		= 	CsMedicalHistoryAlert::model()->findAllByAttributes(array('id_customer'=>$id_customer), array('order'=>'id_medicine_alert ASC'));
			$cus_al 	= 	new CsMedicalHistoryAlert();
			$als = array();
			if($al) {
				foreach ($al as $key => $value) {
					$als[$value['id_medicine_alert']] = $value['note'];
				}
			}
		}

		else {
			if(isset($_POST['CsMedicalHistoryAlert'])){

				$CsMedicalHistoryAlert = $_POST['CsMedicalHistoryAlert'];
				$id_customer 		= $CsMedicalHistoryAlert['id_customer'];
				$med 			=	$CsMedicalHistoryAlert['id_medicine_alert'];
				$md_his 	=	array();

				foreach ($med as $key => $value) {
					if($value != 0)
						$md_his[] = $key;
				}

				$upMed 	=	Customer::model()->updateMedicalHistoryAlert($id_customer,$md_his,'');
				
				if($upMed) {
					echo "1";
					exit;
				}
			}	
		}

		$this->renderPartial('medicalAlert',array(
			'cus_al'			=>	$cus_al,
			'id_customer'		=>	$id_customer,
			'als'				=>	$als,
		));
	}

	public function actionUpdateEvent()
	{
		$id_schedule = isset($_POST['id_schedule']) ? $_POST['id_schedule'] : false;
		
		if($id_schedule) {
			$sch = VSchedule::model()->findByAttributes(array('id'=>$id_schedule));
			
			$cus = array();
			$als = array();

			if($sch->id_customer) {
				$cus = Customer::model()->findByPk($sch->id_customer);
				$cus = $cus->attributes;
				
				$al  = 	CsMedicalHistoryAlert::model()->findAllByAttributes(array('id_customer'=>$sch->id_customer), array('order'=>'id_medicine_alert ASC'));
				
				if($al) {
					foreach ($al as $key => $value) {
						$als[$value['id_medicine_alert']] = $value['note'];
					}
				}
			}

			echo json_encode(array(
				'sch'	=>	$sch->attributes,
				'cus' =>	$cus,
				'als' =>	$als,
			));
			exit;
		}
		else {
			$up   = 0;
			$cus  = 0;
			$type = 2;

			if(isset($_POST['CsSchedule'])){

				$status = 0;
				if(isset($_POST['CsSchedule']['status']) && $_POST['CsSchedule']['id_service'] != 0){
					$status = $_POST['CsSchedule']['status'];
				}

				$up = CsSchedule::model()->updateSchedule(array(
					'id'			=>		$_POST['CsSchedule']['id'], 
					'id_dentist'	=>		$_POST['CsSchedule']['id_dentist'], 
					'id_branch'		=>		$_POST['CsSchedule']['id_branch'],
					'id_chair'		=>		$_POST['CsSchedule']['id_chair'],
					'id_service'	=>		$_POST['CsSchedule']['id_service'], 
					'lenght' 		=>		$_POST['CsSchedule']['lenght'],
					'start_time'	=>		$_POST['CsSchedule']['start_time'],
					'end_time'		=>		$_POST['CsSchedule']['end_time'],
					'status'		=>		$status,
					'note'			=>		$_POST['CsSchedule']['note']
				));

				if($up) {
					$up = VSchedule::model()->findByAttributes(array('id'=>$_POST['CsSchedule']['id']));
					$ups = $this->eventArr($up);
				}
			}

			echo json_encode(array('ev'=>$ups,'dt'=>$up->attributes));
			exit;
		}
	}

	public function actionSchCus()
	{
		$id_customer = isset($_POST['id_customer']) ? $_POST['id_customer'] : false;

		if(!$id_customer) {
			$cus = new Customer();
		}
		else {
			$cus = Customer::model()->findByPk($id_customer);
		}

		if(isset($_POST['Customer'])) {
			$cus->attributes 		=	$_POST['customer'];

			if($cus->validate()) {
				return $cus->save();
			}
			else {

			}
		}
	}

	public function actionUpdateTimeEvent()
	{
		$id_schedule = isset($_POST['id_schedule']) ? $_POST['id_schedule'] : false;
		$id_resource = isset($_POST['id_resource']) ? $_POST['id_resource'] : false;
		$start = isset($_POST['start']) ? $_POST['start'] : false;
		$end = isset($_POST['end']) ? $_POST['end'] : false;

		$update = CsSchedule::model()->updateSchedule(array(
				'id'=>$id_schedule,
				'id_dentist'=>$id_resource,
				'start_time'=>$start,
				'end_time'=>$end
			));

		echo json_encode($update);
	}

	// change time event
	public function actionEventResize()
	{
		$end 		= isset($_POST['end']) 	? $_POST['end'] : false;
		$id 		= isset($_POST['id']) 	? $_POST['id'] 	: false;	// id_schedule
		$len 		= isset($_POST['len']) 	? $_POST['len'] : false;

		$len = str_replace('-','',$len);

		if($end && $id && $len) {
			$update = CsSchedule::model()->updateSchedule(array(
				'id'			=>	$id,
				'end_time'		=>	$end,
				'lenght'		=>	$len,
			));

			if($update) {
				$up = VSchedule::model()->findByAttributes(array('id'=>$id));
				echo json_encode(array('ev'=>$this->eventArr($up),'dt'=>$up->attributes));
				exit;
			}
			echo 0;
		}
		echo "-1";
	}	

	// drop events dời lịch
	public function actionEventDrop()
	{	
		$start = isset($_POST['start']) 	  ? $_POST['start'] 	: false;
		$end   = isset($_POST['end']) 		  ? $_POST['end'] 		: false;
		$id    = isset($_POST['id']) 		  ? $_POST['id'] 		: false;
		$id_dentist = isset($_POST['id_dentist']) ? $_POST['id_dentist']: false;		
		
		if($end && $id && $start && $id_dentist) {
			$update = CsSchedule::model()->updateSchedule(array(
				'id'         =>	$id,
				'end_time'   =>	$end,
				'start_time' => $start,
				'id_dentist' => $id_dentist
			));

			if($update) {
				$up = VSchedule::model()->findByAttributes(array('id'=>$id));
				echo json_encode(array('ev'=>$this->eventArr($up),'dt'=>$up->attributes));
				exit;
			}
			echo 0;
		}
		echo "-1";
	}

	public function actionGetServiceForCus()
	{
		$id_quotation = isset($_POST['id_quotation']) ? $_POST['id_quotation'] : false;
		$sv = array();

		if(!$id_quotation) {
			$service = CsService::model()->findAllByAttributes(array('flag'=>1));

			foreach ($service as $key => $value) {
				$sv[] = array(
					'id'	=>	$value['id'],
					'name'	=>	$value['name'],
					'len'	=>	$value['length'],
				);
			}
		}
		else {
 			$criteria 			= 	new CDbCriteria;
            $criteria->select 	= 	't.id, t.name , t.length ';
            $criteria->join 	= 	'JOIN quotation_service AS quo';
            $criteria->addCondition("quo.id_quotation = $id_quotation AND quo.id_service = t.id ");
            $resultSet    		=    CsService::model()->findAll($criteria);

			foreach ($resultSet as $key => $value) {
				$sv[] = array(
					'id'	=>	$value['id'],
					'name'	=>	$value['name'],
					'len'	=>	$value['length'],
				);
			}
		}

		echo json_encode($sv);
	}

	public function actionGetTimeForDent()
	{
		$id_branch 		= isset($_POST['id_branch']) 	? $_POST['id_branch']	: Yii::app()->user->getState('user_branch');
		$id_service 	= isset($_POST['id_ser'])		? $_POST['id_ser']		: false;
		$id_dentist 	= isset($_POST['id_den'])		? $_POST['id_den']		: false;
		// Y-m-d
		$time 			= isset($_POST['time'])			? $_POST['time']		: false;
		$len 			= isset($_POST['len'])			? $_POST['len']			: '';

		if($id_branch && $id_service && $time){
			$time 	= CsSchedule::model()->getBlankTime($id_branch, $id_service, $id_dentist, $time, $time, $len);
		}
		else
			$time 	= 0;		// ko đủ dữ liệu đầu vào

		echo json_encode($time);
	}

	public function actionAddNextSch()
	{
		if(isset($_POST['CsSchedule'])) {
			$add 		= CsSchedule::model()->addNewScheduleCheck(array(
				'id_customer'		=>	$_POST['CsSchedule']['id_customer'],
				'id_dentist'		=>	$_POST['CsSchedule']['id_dentist'], 
				'id_author'			=>	$_POST['CsSchedule']['id_author'], 
				'id_branch'			=>	$_POST['CsSchedule']['id_branch'], 
				'id_chair'			=>	$_POST['CsSchedule']['id_chair'], 
				'id_service'		=>	$_POST['CsSchedule']['id_service'], 
				'lenght' 			=>	$_POST['CsSchedule']['lenght'], 
				'start_time'		=>	$_POST['CsSchedule']['start_time'], 
				'end_time'			=>	$_POST['CsSchedule']['end_time'], 
				'status'			=>	$_POST['CsSchedule']['status'], 
				'active'			=>	1, 
				'note'				=>	$_POST['CsSchedule']['note']
			));

			echo json_encode($add);
		}
	}

	public function actionGetInfoCus()
	{
		$id_cus 	= isset($_POST['id_cus'])		? $_POST['id_cus']		: false;

		if(!$id_cus) {
			echo -1;
			exit;
		}

		$cus = Customer::model()->findByPk($id_cus);

		if(!$cus) {
			echo 0;
			exit;
		}

		echo json_encode($cus->attributes);
	}

	public function actionDelSch()
	{
		$id_sch = isset($_POST['id_sch'])?$_POST['id_sch']:'';

		if(!$id_sch) {
			echo "-1";		// ko co ma lich hen
			exit;
		}

		$del = CsSchedule::model()->updateSchedule(array(
			'id'     => $id_sch,
			'active' => -2,
		));

		if($del) 
			echo 1;
		else
			echo 0;
	}

	public function actionGetNewSch()
	{
		$data = isset($_POST['sch']) ? $_POST['sch']: false;

		if($data) {
			$data = json_decode($data,true);

			$ev = $this->eventArr($data);

			echo json_encode($ev);
			exit;
		}
		echo 0;
	}

	public function actionChangeStatus()
	{
		$ev = isset($_POST['idEv']) ? $_POST['idEv'] : '';

		$rs = CsSchedule::model()->updateSchActive();

		if(!$ev){
			exit;
		}

		$evts = array();

		foreach ($ev as $k => $v) {
			$up =  CsSchedule::model()->updateSchSatus($v['id'],$v['status']);
			if($up) {
				$ev = VSchedule::model()->findByAttributes(array('id'=>$up));
				$evts[] = array(
					'ev' => $this->eventArr($ev),
					'dt' => $ev->attributes,
				);
			}
		}
		echo json_encode($evts);
	}

	public function actionGetNoti()
	{
		$id_author = isset($_POST['id_author']) ? $_POST['id_author'] : 2;
		$action    = isset($_POST['action']) ? $_POST['action'] : '';
		$dataSch   = isset($_POST['dataSch']) ? $_POST['dataSch'] : '';

		$rs = CsNotifications::model()->saveNotificationSchedule(Yii::app()->user->getState('user_id'),$dataSch['id_dentist'],$dataSch['id'],$action, $dataSch);
		print_r($rs);
	}

	public function actionUpdateEventAllLayout()
	{
		$id_schedule = isset($_POST['id_schedule']) ?	$_POST['id_schedule'] : false;
		$group_id =  Yii::app()->user->getState('group_id');

		// ton tai ma lich hen - get layout view update schedule all layout
		if($id_schedule)
		{
			$sch = VSchedule::model()->findByAttributes(array('id'=>$id_schedule));
			if(!$sch)
			{
				echo json_encode(array('status' => -1, 'error' => 'Lịch hẹn không tồn tại!'));
				exit;
			}
			$cus = Customer::model()->findByPk($sch->id_customer);
			if(!$cus)
			{
				echo json_encode(array('status' => -2, 'error' => 'Khách hàng không tồn tại!'));
				exit;
			}
			$al = CsMedicalHistoryAlert::model()->findAllByAttributes(array('id_customer'=>$sch->id_customer));

			$statusArr = '';
			if($sch->status == 1)		//lich moi
				$statusArr = $this->st1;
			elseif($sch->status == 2)	// đã đến
				$statusArr = $this->st2;
			elseif ($sch->status == 3) 	//vào khám
				$statusArr = $this->st3;
			elseif ($sch->status == 5) 	//bỏ về
				$statusArr = $this->st5;
			else
				$statusArr = array($sch->status => $this->status_arr[$sch->status]);

			$this->renderPartial('update_event_all', array('sch'=>$sch,'cus'=>$cus,'al'=>$al,'stArr'=>$statusArr,'group_id'=>$group_id));
		}
	}

	public function actionGetCustomerSeg()
	{
		$id_customer = isset($_POST['id_customer']) ?	$_POST['id_customer'] : false;

		$cusSeg = Quotation::model()->getCusSeg($id_customer);

		echo json_encode($cusSeg);
	}

	public function actionCheckCustomerSchedule()
	{
		$id_customer = isset($_POST['id_customer']) ?	$_POST['id_customer'] : false;

		$sch = CsSchedule::model()->checkCustomerSchedule($id_customer);

		if($sch)
			echo 1;
		else
			echo 0;
	}

	public function actionGetCountryList() 
	{
		$page        = isset($_POST['page'])		?	$_POST['page']			:1;
		$search      = isset($_POST['q'])			?	$_POST['q']				:'';

		$countryList = CsCountry::model()->searchCountry($page, $search);

	    $country = array();
	    
		if($countryList['count'] > 0)
		{
			foreach ($countryList['data'] as $key => $value) {
				$country[] = array(
					'id'    => $value['code'],
					'text'  => $value['country'],
				);
			}
		}
		echo json_encode($country);
	}

	public function actionGetCountryName()
	{
		$id_country = isset($_POST['id_country']) ? $_POST['id_country']:1;

		if(!$id_country)
			exit;

		$country = CsCountry::model()->findByPk($id_country);

		if($country){
			echo $country->country;
		}
	}
}