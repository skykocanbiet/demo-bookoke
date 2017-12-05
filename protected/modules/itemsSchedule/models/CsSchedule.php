<?php

/** 
 * This is the model class for table "cs_schedule". 
 * 
 * The followings are the available columns in table 'cs_schedule': 
 * @property integer $id
 * @property string $code
 * @property string $code_confirm
 * @property integer $id_customer
 * @property integer $id_dentist
 * @property integer $id_author
 * @property integer $id_branch
 * @property integer $id_chair
 * @property integer $id_service
 * @property integer $lenght
 * @property string $start_time
 * @property string $end_time
 * @property string $create_date
 * @property string $change_date
 * @property integer $id_group_history
 * @property integer $id_quotation
 * @property integer $id_invoice
 * @property integer $source
 * @property integer $status
 * @property integer $active
 * @property integer $id_note
 * @property string $note
 * @property integer $remain
 */ 
class CsSchedule extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */
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
		'5' => 'Bỏ về',
		'3' => 'Vào khám',
		'2' => 'Đã đến',
	);
	
    public function tableName() 
    { 
        return 'cs_schedule'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('id_customer, id_dentist, id_author, id_branch, id_chair, id_service, lenght, id_group_history, id_quotation, id_invoice, source, status, active, id_note, remain', 'numerical', 'integerOnly'=>true),
            array('code, code_confirm', 'length', 'max'=>45),
            array('start_time, end_time, change_date, note', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, code_confirm, id_customer, id_dentist, id_author, id_branch, id_chair, id_service, lenght, start_time, end_time, create_date, change_date, id_group_history, id_quotation, id_invoice, source, status, active, id_note, note, remain', 'safe', 'on'=>'search'),
        ); 
    } 

    /** 
     * @return array relational rules. 
     */ 
    public function relations() 
    { 
        // NOTE: you may need to adjust the relation name and the related 
        // class name for the relations automatically generated below. 
        return array( 
        ); 
    } 

    /** 
     * @return array customized attribute labels (name=>label) 
     */ 
    public function attributeLabels() 
    { 
        return array( 
            'id' => 'ID',
            'code' => 'Code',
            'code_confirm' => 'Code Confirm',
            'id_customer' => 'Id Customer',
            'id_dentist' => 'Id Dentist',
            'id_author' => 'Id Author',
            'id_branch' => 'Id Branch',
            'id_chair' => 'Id Chair',
            'id_service' => 'Id Service',
            'lenght' => 'Lenght',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'create_date' => 'Create Date',
            'change_date' => 'Change Date',
            'id_group_history' => 'Id Group History',
            'id_quotation' => 'Id Quotation',
            'id_invoice' => 'Id Invoice',
            'source' => 'Source',
            'status' => 'Status',
            'active' => 'Active',
            'id_note' => 'Id Note',
            'note' => 'Note',
            'remain' => 'Remain',
        ); 
    } 

    /** 
     * Retrieves a list of models based on the current search/filter conditions. 
     * 
     * Typical usecase: 
     * - Initialize the model fields with values from filter form. 
     * - Execute this method to get CActiveDataProvider instance which will filter 
     * models according to data in model fields. 
     * - Pass data provider to CGridView, CListView or any similar widget. 
     * 
     * @return CActiveDataProvider the data provider that can return the models 
     * based on the search/filter conditions. 
     */ 
    public function search() 
    { 
        // @todo Please modify the following code to remove attributes that should not be searched. 

        $criteria=new CDbCriteria; 

        $criteria->compare('id',$this->id);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('code_confirm',$this->code_confirm,true);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('id_dentist',$this->id_dentist);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('id_chair',$this->id_chair);
        $criteria->compare('id_service',$this->id_service);
        $criteria->compare('lenght',$this->lenght);
        $criteria->compare('start_time',$this->start_time,true);
        $criteria->compare('end_time',$this->end_time,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('change_date',$this->change_date,true);
        $criteria->compare('id_group_history',$this->id_group_history);
        $criteria->compare('id_quotation',$this->id_quotation);
        $criteria->compare('id_invoice',$this->id_invoice);
        $criteria->compare('source',$this->source);
        $criteria->compare('status',$this->status);
        $criteria->compare('active',$this->active);
        $criteria->compare('id_note',$this->id_note);
        $criteria->compare('note',$this->note,true);
        $criteria->compare('remain',$this->remain);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return CsSchedule the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    }


    public function getColorSch($status)
    {
    	$col = '';
    	switch ($status) {
			case '1':		// lịch mới
				$col = '#59b35a';
				break;
			case '2':		// đã đến
				$col = '#3bb3a8';
				break;
			case '3':		// vào khám
				$col = '#0864aa';
				break;
			case '4':		// hoàn tất
				$col = '#66869d';
				break;
			case '5':		// bỏ về
				$col = '#a08264';
				break;
			case '-1':		// Hủy hẹn
				$col = '#dbbd5a';
				break;
			case '-2':		//Không đến
				$col = '#965050';
				break;
			case '0':		//Không làm việc
				$col = '#b4b4b4';
				break;
			default:
				$col = '#b4b4b4';
				break;
		}
		return $col;
    }

	public function getBranchList()
	{
		return Branch::model()->findAllByAttributes(array('status'=>1));
	}
	
	// danh sach lich hen
	public function getListSchedule($id_dentist='',$id_author='',$id_branch='', $order = '', $id_customer ='')
	{
		$status_active = 1;
		$status        = 0;
		$cs = new VSchedule;		
		$q  = new CDbCriteria();
		$v  = new CDbCriteria();	

		if(!$id_dentist && !$id_customer)
			$q->addCondition("id_branch IS NULL");
		
		$v->addCondition('t.status_active = :status_active');
		$v->params = array(':status_active' => $status_active);
		if($id_dentist)
			$v->addCondition('id_dentist = ' . $id_dentist);
		if($id_author)
			$v->addCondition('id_author = '. $id_author);
		if($id_branch)
			$v->addCondition("id_branch = $id_branch");
		if($id_customer)
			$v->addCondition("id_customer = $id_customer");
		
		if($order)
			$v->order = $order;
		else
			$v->order = 'start_time ASC';
		
	     $v->mergeWith($q, 'OR');   
	     
	    return $cs->findAll($v);
	}

	// danh sach lich hen + phan trang
	public function getListSchedulePag($page = 1, $limit = 50, $id_dentist='',$id_author='',$id_branch='', $order = '', $id_customer ='')
	{
		$start_point = $limit * ($page-1);
		$status_active = 1;

		$cs            = new VSchedule;		
		
		$v = new CDbCriteria();	
		
		$v->addCondition('t.status_active = :status_active');
		$v->params = array(':status_active' => $status_active);
		if($id_dentist)
			$v->addCondition('id_dentist = ' . $id_dentist);
		if($id_author)
			$v->addCondition('id_author = '. $id_author);
		if($id_branch)
			$v->addCondition("id_branch = $id_branch");
		if($id_customer)
			$v->addCondition("id_customer = $id_customer");
		
		$numRow = count($cs->findAll($v));
		$numPage = ceil($numRow/$limit);
		
		if($order)
			$v->order = $order;
		else
			$v->order = 'start_time';
		$v->offset = $start_point;
		$v->limit = $limit; 
	     
	    return array('numRow' => $numRow, 'numPage' => $numPage, 'data' => $cs->findAll($v));
	}

	// lấy danh sách bác sỹ có mã dịch vụ là $id_service
	public function getServiceDentists($id_service)
	{
		$dentistList = CsServiceUsers::model()->findAllByAttributes(array('id_service'=>$id_service, 'st'=>1));
		if($dentistList)
			return $dentistList;
		else
			return -1; // dịch vụ không có bác sỹ
	}

	// get all list services with id_dentist
	public function getDentistServices($curpage,$id_dentist,$searchService)
	{
		//$start_point=10*($curpage-1);
		$cs = new VServicesHours;		
		$q = new CDbCriteria(array(
    		'condition'=>'1=1'
		));
		$v = new CDbCriteria();

		$q->addCondition('id_dentist = '. $id_dentist);
		$v->addSearchCondition('service_code', $searchService, true, 'AND');
		$v->addSearchCondition('service_name', $searchService, true, 'OR');

	    $v->order= 'id_service DESC';
		$v->group = 'id_service';
	   /* $v->limit = 20;
	    $v->offset = $start_point;*/
	    $q->mergeWith($v);	    
	     
	    return $cs->findAll($q);
	}

	// lay bac sy co id_chair
	public function getDentistChair($id_chair, $start)
	{
		if(!$id_chair)
			return -1;

		$time = DateTime::createFromFormat('Y-m-d H:i:s', $start)->format('H:i:s');
		$dow = DateTime::createFromFormat('Y-m-d H:i:s', $start)->format('w');

		$dentist = VServicesHours::model()->find(array(
			'select'		=> 	'id_dentist, dentist_name, chair_type',
			'condition'		=>	"`id_chair` = $id_chair AND `start` <= '$time' AND '$time' <= `end` AND dow = $dow",
		));

		return $dentist;
	}

	public function checkServiceDentist($id_dentist,$id_service)
	{
		$check = CsServiceUsers::model()->findByAttributes(array('id_dentist'=>$id_dentist,'id_service'=>$id_service));
		if($check)
			return 1;  // bác sỹ có dịch vụ
		return 0; // bác sỹ không có dịch vụ
	}

	/**** kiểm tra thời gian làm việc của bác sỹ ****/
	public function checkWorkingTime($id_dentist,$start_time,$end_time,$id_branch = '')
	{
		$start = date('H:i:s',strtotime($start_time));
		$end   = date('H:i:s',strtotime($end_time));
		$dow   = date('w', strtotime($start_time));

		if($end < $start)
			return 0;

		$con = '';
		if($id_branch){
			$con = " AND id_branch = $id_branch";
		}
		
		$timework = CsScheduleChair::model()->find(array(
			'select' 	=> '*',
			'condition' => 'id_dentist = '.$id_dentist. ' ' .$con. ' '.' AND dow = '.$dow.' AND start <= "'.$start.'" AND end >= "'. $end. '"',
		));
		if(!$timework){
			return 0;  // bác sỹ không có ca làm việc
		}
		$timeRelax = CsScheduleRelax::model()->find(array(
			'select' 	=> '*',
			'condition' => "id_dentist = $id_dentist AND dow = $dow AND ((START < '$start' AND '$start' < END ) OR (START < '$end' AND '$end' < END ))",
		));
		if($timeRelax) {
			return -1;		// bac sỹ nghỉ trưa
		}
		return array(
			'id_branch'	=>$timework->id_branch,
			'id_chair'	=>$timework->id_chair
		);
	}

	public function checkTimeRelax($id_dentist,$start_time,$end_time)
	{
		$start 	= date_format(date_create($start_time),'H:i:s');
		$end 	= date_format(date_create($end_time),'H:i:s');
		$dow 	= date_format(date_create($start_time),'w');

		$timeR = CsScheduleRelax::model()->find(array(
			'select'    => '*',
			'condition' => "id_dentist = $id_dentist AND dow = $dow AND (start <= '$start' AND '$end' <= end)",
		));
		if(!$timeR) 
			return 1;
		else
			return 0;
	}

	/**** kiểm tra lịch hẹn trùng ****/
	public function checkScheduleEvent($time_start,$time_end,$id_dentist,$id_schedule = 0)
	{
		$start_time = date('Y-m-d H:i:s',strtotime($time_start) + 1);
		$end_time 	= date('Y-m-d H:i:s',strtotime($time_end) - 1);

		if($start_time == $end_time)
			return -1;			// thời gian bắt đầu trùng với kết thúc

		$schedule = CsSchedule::model()->find(array(
			'select'    => 'id_dentist, id',
			'condition' => 'id_dentist = '.$id_dentist.' AND id != '.$id_schedule.' AND active > 0 AND status >= 0 AND (((start_time <="' .$start_time. '" AND end_time >= "' .$start_time. '") OR (start_time <= "' .$end_time. '" AND end_time >= "'.$end_time.'")) OR "' . $start_time .'" = DATE_ADD(start_time, INTERVAL 1 SECOND) OR ("'.$start_time.'" <= start_time AND end_time <= "'.$end_time.'"))',
		));

		if(!$schedule || ($schedule->id == $id_schedule && $id_schedule != 0))
			return 1;		// thỏa
		return 0;			// đã có lịch hẹn
	}

	// Ngoai web font end / facebook dat lich
	public function addNewScheduleCheck($newSchedule = array('code'=>'', 'code_confirm'=>'','phone'=>'', 'id_customer'=>'', 'id_dentist'=>'', 'id_author'=>'', 'id_branch'=>'', 'id_chair'=>'0', 'id_service'=>'', 'lenght' => '', 'start_time'=>'', 'end_time'=>'', 'status'=>'', 'source'=>0 ,'active'=>'', 'note'=>''))
	{
		$sch 					= new CsSchedule();
		$sch->attributes		= $newSchedule;

		if($sch->code == '')
			$sch->code	=	$this->createCodeSchedule(date('Y-m-d'));

		if($sch->validate()){
			$checkTime = $this->checkWorkingTime($sch->id_dentist,$sch->start_time,$sch->end_time, $sch->id_branch);
			if(!$checkTime)
				return array('status' => '-1', 'error-message' => 'Nha sỹ không làm việc!');		// bác sỹ không làm việc

			$checkSchedule = $this->checkScheduleEvent($sch->start_time,$sch->end_time,$sch->id_dentist,0);
			if(!$checkSchedule)
				return array('status' => '-2', 'error-message' => 'Có lịch hẹn trùng!');			// có lịch trùng

			if(!$sch->save())
				return array('status' => '0', 'error-message' => 'luu that bai');		// có lỗi xảy ra

			return array('status' => '1', 'success' => $sch->attributes);
		}
		return array('status' => '-5', 'error-message' => $sch->getErrors());			// có lỗi xảy ra
	}

// Admin Dat lich
	public function addNewSchedule($newSchedule = array('code'=>'', 'code_confirm'=>'', 'id_customer'=>'', 'id_dentist'=>'', 'id_author'=>'', 'id_branch'=>'', 'id_chair'=>'', 'id_service'=>'', 'lenght' => '', 'start_time'=>'', 'end_time'=>'', 'status'=>'', 'active'=>'', 'note'=>''))
	{
		
		$sch 					= new CsSchedule();
		$sch->attributes		= $newSchedule;

		if($sch->code == '')
			$sch->code	=	$this->createCodeSchedule(date('Y-m-d'));

		if($sch->validate() && $sch->save()){
			return array('id'=>$sch->id,'data'=>$sch->attributes);
		}

		return 0;
	}

	// lich hen ke tiep
	public function addNextScheduleCheck($id_customer, $id_dentist, $id_branch, $start_time, $len, $id_group_history, $id_author, $note = '', $id_quote = '')
	{
		if(!$id_customer || !$id_dentist || !$id_branch || !$start_time || !$len || !$id_group_history) {
			return array('status' => '0', 'error-message' => 'Không đủ dữ liệu!');
		}
		$date_format = "Y-m-d H:i:s";
		$date = date_create($start_time);

		$start_time = date_format($date,$date_format);

		if(isset($start_time['status']) && $start_time['status'] == 0) {
			return array('status' => '0', 'error-message' => 'Thời gian không đúng định dạng!');	
		}

		$end_time = date_add($date, date_interval_create_from_date_string($len . " minutes"));
		$end_time = date_format($end_time,$date_format);
		
		$checkTime = $this->checkWorkingTime($id_dentist,$start_time,$end_time,$id_branch);
		if(!$checkTime)
			return array('status' => '-1', 'error-message' => 'Nha sỹ không làm việc!');		// bác sỹ không làm việc

		$checkRelax = $this->checkTimeRelax($id_dentist,$start_time,$end_time);
		if(!$checkRelax)
			return array('status' => '-1', 'error-message' => 'Nha sỹ không làm việc');			// thoi gian nghi trua

		$checkSchedule = $this->checkScheduleEvent($start_time,$end_time,$id_dentist,0);
		if(!$checkSchedule)
			return array('status' => '-2', 'error-message' => 'Có lịch hẹn trùng!');			// có lịch trùng

		$sch = new CsSchedule();

		$sch->id_customer      = $id_customer;
		$sch->id_dentist       = $id_dentist;
		$sch->id_author        = $id_author;
		$sch->id_branch        = $id_branch;
		$sch->start_time       = $start_time;
		$sch->end_time         = $end_time;
		$sch->lenght           = $len;
		$sch->id_group_history = $id_group_history;
		$sch->id_quotation     = $id_quote;
		$sch->note             = $note;

		$sch->id_service = '139';
		$sch->code       = $this->createCodeSchedule();
		$sch->status     = 1;
		$sch->active     = 1;

		if($sch->validate() && $sch->save()) {
			$soap = new SoapService();
			$soap->webservice_server_ws("getAddNewNotiSchedule",array('1','317db7dbff3c4e6ec4bdd092f3b220a8',$sch->id_author,$id_dentist,$sch->id,'add'));

			return array('status' => '1', 'id_schedule' => $sch->id);
		}
		return array('status' => '-3', 'error-message' => $sch->getErrors());
	}

	public function updateNextScheduleCheck($id_schedule, $id_dentist, $len, $start_time, $id_author, $note = '')
	{
		if(!$id_schedule || !$id_dentist || !$start_time || !$len) {
			return array('status' => '0', 'error-message' => 'Không đủ dữ liệu!');
		}
		$date_format = "Y-m-d H:i:s";
		$date = date_create($start_time);

		$start_time = date_format($date,$date_format);

		if(isset($start_time['status']) && $start_time['status'] == 0) {
			return array('status' => '0', 'error-message' => 'Thời gian không đúng định dạng!');	
		}

		$end_time = date_add($date, date_interval_create_from_date_string($len . " minutes"));
		$end_time = date_format($end_time,$date_format);
		
		$up = $this->updateScheduleCheck(array(
				'id'         => $id_schedule,
				'id_dentist' => $id_dentist,
				'lenght'     => $len,
				'start_time' => $start_time,
				'end_time'   => $end_time,
				'note'       => $note,
				'id_author'  => $id_author,
		));

		if($up['status'] == 1){
			$soap = new SoapService();
			$soap->webservice_server_ws("getAddNewNotiSchedule",array('1','317db7dbff3c4e6ec4bdd092f3b220a8',$id_author,$id_dentist,$id_schedule,'update'));
		}

		return $up;
	}

	public function updateScheduleCheck($updateSchedule = array('id'=>'', 'id_dentist'=>'', 'id_branch'=>'', 'id_chair'=>'', 'id_service'=>'', 'lenght' => '', 'start_time'=>'', 'end_time'=>'', 'id_author' => '', 'status'=>'', 'active'=>'', 'note'=>''))
	{
		if(!$updateSchedule['id'])
			return -1; 			// ko co id

		$sch 					= CsSchedule::model()->findByPk($updateSchedule['id']);

		if(strtotime($sch->start_time) != strtotime($updateSchedule['start_time']) || 
			strtotime($sch->end_time) != strtotime($updateSchedule['end_time'])	|| $sch->id_dentist != $updateSchedule['id_dentist']) 
		{
			$checkTime = $this->checkWorkingTime($updateSchedule['id_dentist'],$updateSchedule['start_time'],$updateSchedule['end_time']);

			if($checkTime == 0)
				return array('status' => '-1', 'error-message' => 'Nha sỹ không làm việc!');		// bác sỹ không làm việc

			$checkSchedule = $this->checkScheduleEvent($updateSchedule['start_time'],$updateSchedule['end_time'],$updateSchedule['id_dentist'],$updateSchedule['id']);
			if($checkSchedule == 0)
				return array('status' => '-2', 'error-message' => 'Có lịch hẹn trùng!');			// có lịch trùng
		}

		$sch->attributes		= $updateSchedule;

		if($sch->validate() && $sch->save()){
			return array('status' => '1', 'success' => $sch->attributes);
		}
		else
			return array('status' => '-3', 'error-message' => $sch->getErrors());		// có lỗi xảy ra
	}

	public function updateSchedule($updateSchedule = array('id'=>'', 'phone'=>'', 'code_confirm'=>'', 'id_dentist'=>'', 'id_branch'=>'', 'id_chair'=>'', 'id_service'=>'', 'lenght' => '', 'start_time'=>'', 'end_time'=>'', 'status'=>'', 'active'=>'', 'note'=>'', 'id_quotation'=>'', 'remain'=>''))
	{
		if(!$updateSchedule['id'])
			return -1; 			// ko co id`

		$sch 					= CsSchedule::model()->findByPk($updateSchedule['id']);
		if(!$sch) {
			return -2;			// lich hen khong ton tai
		}
		// co ma note -> update
		if($sch->id_customer){
			if($sch->id_note && isset($updateSchedule['note'])) {
				$note = CustomerNote::model()->updatenote($sch->id_note, $updateSchedule['note']);
			}
			elseif(isset($updateSchedule['note']) && $updateSchedule['note'] != '')  {
				$note = CustomerNote::model()->addnote(array(
							'note'        => $updateSchedule['note'],
							'id_user'     => Yii::app()->user->getState('user_id'),
							'id_customer' => $sch->id_customer,
							'flag'        => 1,			// 1: lich hen
							'important'   => 0,
							'status'      => 1,
					));

				if(isset($note['id']))
					$updateSchedule['id_note'] = $note['id'];
			}
		}
		
		$sch->attributes		= $updateSchedule;

		if($sch->validate() && $sch->save()){
			return array('id'=>$sch->id,'data'=>$sch->attributes);
		}
		else
			return $sch->getErrors();		// có lỗi xảy ra
	}

	// cap nhat ma xac nhan
	public function updateCodeConfirm($id_schedule)
	{
		if(!$id_schedule)
			return -1;

		$codeCF = $this->codeConfirm();

		$up = CsSchedule::model()->updateByPk($id_schedule, array('code_confirm'=>$codeCF));

		if($up) {
			return $codeCF;
		}
		return 0;
	}

	// cap nhat ma code xac thuc
	public function updateScheduleCode($updateSchedule = array('status'=>'', 'active'=>'','id'=>'','code'=>''))
	{
		if(!$updateSchedule['id'] || !$updateSchedule['code'])
			return -1; 			// ko co id

		$sch 					= CsSchedule::model()->findByPk($updateSchedule['id']);
		if($sch->active == -1) {
			return array('status'=>-1,'error'=>'Có lỗi xảy ra. Xin vui lòng thử lại sau!');
		}
		if($sch->code_confirm != $updateSchedule['code'])
			return array('status'=>0,'error'=>'Mã xác thực không trùng khớp!');

		$sch->status = $updateSchedule['status'];
		$sch->active = $updateSchedule['active'];

		if($sch->validate() && $sch->save()){
			//danglam
			
			return array('status'=>1,'data'=>$sch->attributes);
		}
		else
			return array('status'=>-1,'error'=>'Có lỗi xảy ra. Xin vui lòng thử lại sau!');		// có lỗi xảy ra
	}

	public function cancelSchedule($id_schedule)
	{
		if(!$id_schedule) {
			return -1;		// ko có mã lich hen
		}

		$cancel = CsSchedule::model()->updateByPk($id_schedule, array('status'=>-1));

		if($cancel)
			return 1;
		return 0;
	}

	public function codeConfirm($len = 4) {
		$str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = '';
		$strlen = strlen($str);
		for ($i=0; $i < $len ; $i++) { 
			$code .= $str[rand(0,$strlen-1)];
		}
		return $code;
	}

	public function createCodeSchedule($date='')
	{
		if($date == '')
			$date = date('Y-m-d');

		$date = date('Y-m-d', strtotime($date));
		$str = '01234567789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$strlen = strlen($str);
		$codelen = 4;
		$code = '';
		for ($i=0; $i < $codelen ; $i++) { 
			$code .= $str[rand(0,$strlen-1)];
		}
		$schenum = CsSchedule::model()->count(array('condition' => 'date(create_date)="'.$date.'"')) + 1;
		$codenum = str_pad($schenum, '4' ,'0', STR_PAD_LEFT);
		$code .= $codenum;
		return $code;
	}

	public function getSchedule($id_schedule)
	{
		return CsSchedule::model()->findByPk($id_schedule);
	}

	// update all schedule where start < now
	public function updateSchSatus($id,$st)
	{	
		$upst = -2;
		switch ($st) {
			case 1:
				$upst = -2;
				break;
			case 2:
				$upst = 5;
				break;
			case 3:
				$upst = 4;
				break;
		}

		$up = CsSchedule::model()->updateByPk($id, array('status'=>$upst));

		if($up) {
			return $id;
		}
		return $up;
	}

	public function updateSchActive()
	{
		$schAct = Yii::app()->db->createCommand("
			UPDATE 	cs_schedule
			SET 	active = - 1  
			WHERE 	ADDTIME(create_date, '00:06:00') < NOW() AND active = 0")->execute();

		return $schAct;
	}

	public function getBlankTime($id_branch, $id_service, $id_dentist='', $start_date, $end_date, $len = '') {
		$format 	= 'Y-m-d';
		$max_num 	= 3;

		if(!$start_date || !$end_date || !$id_service || !$id_dentist)
			return -1;	// ko du du lieu

		$start_date = DateTime::createFromFormat($format, $start_date);
		$end_date   = DateTime::createFromFormat($format, $end_date);

		if(!$start_date || !$end_date) {
			return -2;		// thời gian bắt đầu và kết thúc không đúng định dạng
		}

		$start = $start_date->format($format);
		$end   = $end_date->format($format);

		$con 		= '1=1 ';
		$conS 		= '"'.$start.'" <= DATE(start_time) AND DATE(start_time) <= "'.$end.'"';

		if($id_branch){
			$con  .= ' AND id_branch = '.$id_branch;
			$conS .= ' AND id_branch = '.$id_branch ;
		}
		if($id_dentist){		// khám có chọn bác sỹ
			$con .= " AND id_dentist = $id_dentist";
			$conS .= ' AND id_dentist = '.$id_dentist .' ';
		}
		else {		// kham khong chon bac sy
		}

		// thời gian làm việc
		$worktime = Yii::app()->db->createCommand("
			SELECT 	id_dentist, dow, start, end, id_branch
			FROM 	cs_schedule_chair 
			WHERE 	".$con." AND `status` = 1 ORDER BY dow, start, id_dentist
		")->queryAll();

		// thời gian có lịch hẹn
		$schtime = Yii::app()->db->createCommand("
			SELECT 	id_dentist, id_service, start_time, end_time, DAYOFWEEK(start_time)-1 as dow, DATE(start_time) AS day
			FROM 	v_schedule 
			WHERE 	".$conS." AND status >= 0 AND status_active = 1 GROUP BY start_time ORDER BY start_time, id_dentist")->queryAll();

		// thoi gian nghỉ trua cua bac sy
		$timeRelax = Yii::app()->db->createCommand("
			SELECT 	id_dentist, dow, start, end 
			FROM 	cs_schedule_relax 
			WHERE 	id_dentist = $id_dentist ORDER BY start, id_dentist")->queryAll();

		$day  = new DateTime($start);
		$end  = new DateTime($end);
		$lenD = 0;
		$free = array();
		$f    = 0;

		while ($day <= $end) {
			$dow = $day->format('w');

			if($id_dentist) {
				// thời gian làm việc của bác sỹ theo ngày
				$timeW = array_filter($worktime,function($v) use ($dow,$id_dentist){
					if($v['dow'] == $dow && $v['id_dentist'] == $id_dentist)
							return true;
				});
				// thời gian lịch hẹn có bác sỹ theo ngày
				$timeS = array_filter($schtime,function($v) use ($dow,$id_dentist){
					if($v['dow'] == $dow && $v['id_dentist'] == $id_dentist)
							return true;
				});

				// thoi gian nghi trua theo ngay
				$timeR = array_filter($timeRelax,function($v) use ($dow,$id_dentist){
					if($v['dow'] == $dow && $v['id_dentist'] == $id_dentist)
							return true;
				});
			}

			else {
				$timeW = array_filter($worktime,function($v) use (&$dow,$id_service){
					if($v['dow'] == $dow)
							return true;
				});

				// thời gian lịch hẹn có dịch vụ là khám tư vấn
				$timeS = array_filter($schtime,function($v) use (&$dow,$id_service){
					if($v['dow'] == $dow){
							return true;
						}
				});
			}

			if($len == '')
				$len = CsService::model()->findByPk($id_service)->length;

			$timeAF =  	$this->getTimeAfterRelax($timeW,$timeR);

			$free1  = 	$this->getTime($timeAF,$timeS,$len,'');
			$time   = 	$this->rangeTime($free1,$len,-1,0);

			$free[] = array(
				'dow'  => $dow,
				'day'  => $day->format('Y-m-d'),
				'len'  => $len + $lenD,
				'time' => $time,
			);
			
			date_add($day,new DateInterval('P1D'));
			
		}
		return $free;
	}

	// thoi gian trong = thoi gian lam viec - thoi gian nghi trua
	function getTimeAfterRelax($timeWork, $timeRelax)
	{
		$time = array();

		foreach ($timeWork as $key => $val) {
			$st = date('H:i:s',strtotime($val['start']));
			$en = date('H:i:s',strtotime($val['end']));
			$id_branch = $val['id_branch'];

			foreach ($timeRelax as $key => $value) {
				$str = date('H:i:s',strtotime($value['start']));
				$enr = date('H:i:s',strtotime($value['end']));

				$ck = $this->checkTime($st, $en, $str, $enr);
				
				switch ($ck) 	{
					case '1':			// nam giua
						$time[] = array(
							'id_dentist' =>	$val['id_dentist'],
							'dow'        =>	$val['dow'],
							'start'      =>	$st,
							'end'        => $str,
							'id_branch'	 => $id_branch,
						);

						$time[] = array(
							'id_dentist' =>	$val['id_dentist'],
							'dow'        =>	$val['dow'],
							'start'      =>	$enr,
							'end'        => $en,
							'id_branch'	 => $id_branch,
						);
						break;
					case '2':			// trung bat dau
						$time[] = array(
							'id_dentist' =>	$val['id_dentist'],
							'dow'        =>	$val['dow'],
							'start'      =>	$enr,
							'end'        => $en,
							'id_branch'	 => $id_branch,
						);
						break;
					case '3':			// trung ket thuc
						$time[] = array(
							'id_dentist' =>	$val['id_dentist'],
							'dow'        =>	$val['dow'],
							'start'      =>	$st,
							'end'        => $str,
							'id_branch'	 => $id_branch,
						);
						break;
					default:
						$time[] = array(
							'id_dentist' =>	$val['id_dentist'],
							'dow'        =>	$val['dow'],
							'start'      =>	$st,
							'end'        => $en,
							'id_branch'	 => $id_branch,
						);
						break;
				}
			}
		}

		return $time;
	}

	// lấy lịch hẹn và thời gian trống
	function getTime($timeW,$timeS,$len,$id_branch){
		if($timeW == '' || empty($timeW))
			return 0;			// lịch ko có bác sỹ làm việc theo dịch vụ

		foreach ($timeW as $key => $val) {
			$wst[]     = date('H:i:s',strtotime($val['start']));
			$wen[]     = date('H:i:s',strtotime($val['end']));
			$dentist[] = $val['id_dentist'];
			$branch[]  = $val['id_branch'];
		}

		$start_free = $wst[0];			// thời gian trống bắt đầu = thời gian bắt đầu làm việc
		$end_free   = $wen[0];			// thời gian trống kết thúc = thời gian kết thúc làm việc
		$id_dentist = $dentist[0];
		$id_branch  = $branch[0];
		$free       = array();
		$s          = 0;				// biến chạy thời gian làm việc
		$f          = 0;

		foreach ($timeS as $key => $val) 
		{   
			$st = date('H:i:s',strtotime($val['start_time']));
			$en = date('H:i:s',strtotime($val['end_time']));

			$check = $this->checkTime($start_free,$end_free,$st,$en);

			switch ($check) {
				case 1: 		// lịch hẹn nằm giữa thời gian trống
					$free[]     = $start_free.'-'.$st.'-'.$id_dentist.'-'.$id_branch;
					$start_free = $en;
					break;
				case 2: 		// lịch hẹn trùng thời gian bắt đầu
					$start_free = $en;
					break;
				case 3: case -2:		// lịch hẹn trùng thời gian kết thúc
					$free[]           = $start_free.'-'.$st.'-'.$id_dentist.'-'.$id_branch;

					if($s < count($wst) - 1) {
						$s          = $s+1;
						$start_free = $wst[$s];
						$end_free   = $wen[$s];
						$id_dentist = $dentist[$s];
						$id_branch 	= $branch[$s];
					}
					else {
						$s          = 	$s+1;
						$start_free =  	'';
						$end_free   = 	'';
						$id_dentist =  	'';
						$id_branch  = 	'';
					}
					break;
				case 4: 		// lịch hẹn trùng cả hai
					if($s < count($wst) - 1) {
						$s          = $s+1;
						$start_free = $wst[$s];
						$end_free   = $wen[$s];
						$id_dentist = $dentist[$s];
						$id_branch 	= $branch[$s];
					}
					else {
						$s          = 	$s+1;
						$start_free =  	'';
						$end_free   = 	'';
						$id_dentist =  	'';
						$id_branch  = 	'';
					}
					break;
				case -4:		// thời gian trống nằm trước thời gian lịch hẹn
					$free[]           = $start_free.'-'.$end_free.'-'.$id_dentist.'-'.$id_branch;
					if($s < count($wst) - 1) {
						$s          = $s+1;
						$start_free = $wst[$s];
						$end_free   = $wen[$s];
						$id_dentist = $dentist[$s];
						$id_branch 	= $branch[$s];
					}
					else {
						$s          = 	$s+1;
						$start_free =  	'';
						$end_free   = 	'';
						$id_dentist =  	'';
						$id_branch  = 	'';
					}

					if($start_free < $st) {
						$free[]           = $start_free.'-'.$st.'-'.$id_dentist.'-'.$id_branch;
					}
					$start_free       = $en;

					break;
				default:				// lịch hẹn ko nằm trong thời gian trống
					$free[]           = $start_free.'-'.$end_free.'-'.$id_dentist.'-'.$id_branch;
					if($s < count($wst) - 1) {
						$s          = $s+1;
						$start_free = $wst[$s];
						$end_free   = $wen[$s];
						$id_dentist = $dentist[$s];
						$id_branch 	= $branch[$s];
					}
					else {
						$s          = 	$s+1;
						$start_free =  	'';
						$end_free   = 	'';
						$id_dentist =  	'';
						$id_branch  = 	'';
					}
					break;
			}
		}
		// kiểm tra thời gian còn lại
		if($start_free < $end_free)
		{
			$free[] = $start_free.'-'.$end_free.'-'.$id_dentist.'-'.$id_branch;
		}
		// thời gian trống ko có lịch hẹn
		if($s < count($wst)-1)
		{
			while ($s<count($wst)-1) {
				$s = $s +1;
				$free[] = $wst[$s].'-'.$wen[$s].'-'.$dentist[$s].'-'.$branch[$s];
			}
		}

		return $free;		
	}

	// kiểm tra lịch hẹn với thời gian trống
	function checkTime($start_free, $end_free, $start_sch, $end_sch) {
		if(!$start_free || !$end_free || !$start_sch || !$end_sch)
			return 0;
		if($start_free <= $start_sch && $end_sch <= $end_free) {
			if($start_free == $start_sch && $end_sch == $end_free)
				return 4;		// lịch hẹn trùng cả hai
			if($start_free == $start_sch)
				return 2;		// lịch hẹn trùng thời gian bắt đầu
			if($end_sch == $end_free)
				return 3;		// lịch hẹn trùng thời gian kết thúc
			return 1;			// lịch hẹn không trùng với mốc thời gian bắt đầu hay kết thúc
		}
		else {
			if($start_free <= $start_sch && $start_sch <= $end_free)
				return -2;		// thời gian bắt đầu của lịch hẹn nằm trong thời gian trống
			if($start_free <= $end_sch && $end_sch <= $end_free)
				return -3;		// thời gian kết thúc của lịch hẹn nằm trong thời gian trống
			if($end_free < $start_sch)
				return -4;		// thời gian trống nằm trước thời gian lịch hẹn
			if($start_free > $end_sch)
				return -5;		// thời gian trống nằm sau lịch hẹn
			return -1;		// lịch hẹn ko nằm trong thời gian trống
		}
	}

	// sắp xếp lịch trống
	function rangeTime($free1,$len,$free2,$lenD){
		$time = array();
		$ti = 0;
		$r = 0;

		if($free1 == 0 || empty($free1))
			return 0;		// ko có dữ liệu

		if($free2 == -1) { // ko tồn tại bác sỹ thứ 2
			foreach ($free1 as $key => $val) {
				if($r == 1) 
					continue;

				$t 			= explode('-', $val);
				$start 		= date('H:i:s',strtotime($t[0]));
				$end 		= date('H:i:s',strtotime($t[1]));
				$id_dentist = $t[2];
				$id_branch	= $t[3];
				$next 		= next($free1);

				if($next){
					$test = explode('-', $next);

					$chk_rs = $this->checkTime($start,$end,$test[0],$test[1]);
					
					if($chk_rs == -2 || $chk_rs == -3)
						continue;
					if($chk_rs == 1 || $chk_rs == 4){
						$r = 1;
					}
					else {
						$r = 0;
					}
				}

				while (strtotime($start)+$len*60 <= strtotime($end)) {
					$time[$ti++] = $start.' - '.date('H:i:s',strtotime($start)+$len*60) . ' - '.$id_branch;
					$start = date('H:i:s',strtotime($start)+$len*60);
				}

			}
		}
		else {
			if($free2 == 0 || empty($free2))
				return 0;		// ko có dữ liệu
			// free1: thời gian khám
			foreach ($free1 as $key => $val) {
				$t = explode('-', $val);
				$start1[] = date('H:i:s',strtotime($t[0]));
				$end1[] = date('H:i:s',strtotime($t[1]));
				$subdentist[]  = $t[2];
				$subchair[] = $t[3];
			}

			$st1 = $start1[0];
			$en1 = $end1[0];
			$id_subchair = $subchair[0];
			$id_subdentist = $subdentist[0];
			$s = 0;
			// free2: thời gian tư vấn với bác sỹ chọn
			foreach ($free2 as $key => $val) {
				$t = explode('-', $val);
				$start2 = date('H:i:s',strtotime($t[0]));
				$end2 = date('H:i:s',strtotime($t[1]));
				$id_dentist = $t[2];
				$id_chair = $t[3];


				$chk = $this->checkTime($st1, $en1, $start2, $end2);				

				if($chk == -1){
					($s<count($start1)-1)?($s = $s+1):'';
					$st1 = $start1[$s];
					$en1 = $end1[$s];
					$id_subchair = $subchair[$s];
					$id_subdentist = $subdentist[$s];
					continue;
				}
				else
				{
					while (strtotime($st1)+$len*60 <= strtotime($en1)) {
						$st_temp = date('H:i:s',strtotime($st1)+$len*60);

						$st_ex = $st1;
						$en_ex = $st_temp;
						$st_tr = $st_temp;
						$en_tr = date('H:i:s',strtotime($st_temp)+$lenD*60);

						$check = $this->checkTime($start2, $end2, $st_tr, $en_tr);
						if($check > 0) {
							$time[$ti++] = $st_ex.'.'.$en_tr.'.'.$id_dentist.'-'.$id_chair.'-'.$lenD.'.'.$id_subdentist.'-'.$id_subchair.'-'.$len;
						}
						if($check == -4)
							break;
						$st1 = date('H:i:s',strtotime($st1)+$len*60);
					}
					($s<count($start1)-1)?($s = $s+1):'';
					$st1 = $start1[$s];
					$en1 = $end1[$s];
					$id_subchair = $subchair[$s];
					$id_subdentist = $subdentist[$s];
				}
			}
		}
		if(empty($time))
			$time = 0;
		return $time;
	}

	public function getCodeActive($code_schedule) {
		return CsSchedule::model()->find(array('code'=>$code_schedule))->code_confirm;
	}

	public function saveNotificationSchedule($id_author,$id_dentist,$id_schedule,$action){
		if($id_schedule){
			SoapService::soap_server_ws("getAddNewNotiSchedule",array(1,"317db7dbff3c4e6ec4bdd092f3b220a8",
				$id_author,$id_dentist,$id_schedule,$action));
		}
	}

	function TimeJson()
	{
		$cs = new CsScheduleChair;		
		$v  = new CDbCriteria();	
		
		// thoi gian lam viec
		$v->addCondition("status = 1");
		$v->group  = 'id_branch, id_dentist, dow, start, end';
		$time      = $cs->findAll($v);
		
		$dentist   = GpUsers::model()->findAllByAttributes(array('group_id' => 3));
		
		// danh sach ghe kham
		$branch    = Branch::model()->findAll();
		
		// thoi gian nghi trua cua bac sy
		$timeBreak = CsScheduleRelax::model()->findAll();	

		$timeW  = array();
		$t = 0;

		// loc du lieu theo chi nhanh 
		foreach ($branch as $k => $br) {
			$id_br      = $br['id'];
			// loc du lieu theo chi nhanh
			$timeBranch = array_filter($time, function ($v) use ($id_br){
				return $v['id_branch'] == $id_br;
			});

			if($timeBranch) {
				foreach ($dentist as $key => $value) {
					$id_dentist  = $value['id'];
					// loc du lieu theo nha sy
					$timeDentist = array_filter($timeBranch, function($v) use ($id_dentist){
						if($v['id_dentist'] == $id_dentist)
							return true;
					});
					
					if(!$timeDentist) {
						continue;
					}

					$timeBr = array_filter($timeBreak, function($v) use ($id_dentist){
						if($v['id_dentist'] == $id_dentist)
							return true;
					});

					// loc du lieu theo ngay trong tuan
					$timeW[] = array(
						'id_den'    => $id_dentist,
						'den'		=> $value['name'],
						'id_branch' => $id_br,
						'time'      => $this->timeBreakJson($br,$timeDentist,$timeBr),
					);
				}
			}
		}

		$dentistAllTimeBreak = array();
		// loc du lieu theo nha sy
		foreach ($dentist as $k => $dt) {
			$id_dt      = $dt['id'];
			// loc du lieu theo chi nhanh
			$timeBrDentist = array_filter($time, function ($v) use ($id_dt){
				return $v['id_dentist'] == $id_dt;
			});

			if($timeBrDentist) {

				// thoi gian nghi tru
				$timeBr = array_filter($timeBreak, function($v) use ($id_dt){
						if($v['id_dentist'] == $id_dt)
							return true;
					});

				// loc du lieu theo ngay trong tuan
				$dentistAllTimeBreak[] = array(
					'id_den'    => $id_dt,
					'den'		=> $dt['name'],
					'id_branch' => $id_br,
					'time'      => $this->timeBreakJson($br,$timeBrDentist,$timeBr),
				);
			}
		}

		$f = file_put_contents(Yii::getPathOfAlias('webroot').DS.'time.json',json_encode(array('branch'=>$timeW,'time'=>$dentistAllTimeBreak)));
		return $dentistAllTimeBreak;
	}

	function timeBreakJson($branch, $time, $timeBr)
	{
		// thoi gian lam viec cua chi nhanh
		$brWS = $branch['start_work'];
		$brWE = $branch['end_work'];

		$maxW      = 6;
		$dow       = 0;
		$timeBreak = array();

		while ($dow <= $maxW) {
			// thoi gian lam viec
			$timeW = array_filter($time, function ($k) use ($dow) {
			 	return $k['dow'] == $dow;
			});

			// thoi gian nghi
			$timeB = array_filter($timeBr, function($k) use ($dow) {
				return $k['dow'] == $dow;
			});

			$start = $brWS;
			$end   = $brWE;

			$stW = $brWS;
			$enW = $brWE;

			if(!$timeW) {
				$timeBreak[] = $dow . "-".$start."-".$end;
			}
			else if(count($timeW) == 1) {
				foreach ($timeW as $key => $value) {
					$status = $value['status'];
					if($status == 0) {
						$timeBreak[] = $dow . "-".$start."-".$end;
						break;
					}
					$enW = $value['end'];
					$stW = $value['start'];
				}

				if($start < $stW) {
					$timeBreak[] = $dow . "-".$start."-".$stW;
				}

				if($timeB) {
					foreach ($timeB as $key => $v) {
						if($v['start'] && $v['end'])
							$timeBreak[] = $v['dow'] . "-".$v['start']."-".$v['end'];
					}
				}

				if($enW < $end)
					$timeBreak[] = $dow . "-".$enW."-".$end;

			}
			else {
				$timeTemp = array();
				$st       = $brWS;
				foreach ($timeW as $key => $v) {
					$en = $v['start'];
					if($st < $en) {
						$timeBreak[] = $v['dow'] . "-".$st."-".$en;
					}
					$st = $v['end'];
				}
			}
			$dow ++;
		}
		return $timeBreak;
	}

	// tong thoi gian lich hen
	public function getSumSchedule($id_branch,$id_dentist,$from_date,$to_date)
	{
		if(!$from_date || !$to_date){
			return -1;		// khong du du lieu
		}


		$start_date = new DateTime($from_date);
		$start_date = date_format($start_date, 'Y-m-d');

		$end_date 	= new DateTime($to_date);
		$end_date 	= date_format($end_date, 'Y-m-d');

		if(!$start_date || !$end_date)
			return -2;		// dinh dang thoi gian khong dung

		$con = "'$start_date' <= DATE(start_time) AND DATE(end_time) <= '$end_date' AND status > 0";

		if($id_dentist)
			$con .= " AND id_dentist = $id_dentist";
		if($id_branch)
			$con .= " AND id_branch = $id_branch";
		$sch = CsSchedule::model()->findAll(array(
				'select'  => '*',
				'condition' => $con,
			));

		$maxTime = 0;
		foreach ($sch as $key => $value) {
			$st = date_create($value['start_time']);
			$en = date_create($value['end_time']);

			$timeSch = date_diff($st,$en);

			$minutes = $timeSch->days * 24 * 60;
			$minutes += $timeSch->h * 60;
			$minutes += $timeSch->i;
			$maxTime += $minutes;

		}
		return $maxTime;
	}

	// tong thoi gian lam viec - tra ve so phut
	public function getSumWork($id_branch,$id_dentist,$from_date,$to_date)
	{
		if(!$id_branch || !$from_date || !$to_date)
			return -1;		// khong du du lieu
		$start = DateTime::createFromFormat('Y-m-d', $from_date);
		$end   = DateTime::createFromFormat('Y-m-d', $to_date);

		if(!$start || !$end)
			return -2;		// dinh dang thoi gian khong dung

		$start_date = $start->format('Y-m-d');
		$end_date   = $end->format('Y-m-d');

		$start_week = $start->format('w'); 	// 3
		$end_week   = $end->format('w');	// 4
		$num_date = date_diff($end, $start)->d;

		$con = "id_branch = $id_branch AND status = 1";
		if($id_dentist)
		{
			$con .= " AND id_dentist = $id_dentist";
		}

		$work = CsScheduleChair::model()->findAll(array(
			'select'    => '*',
			'condition' => $con,
			));

		$maxTime = 0;

		$t = 0;
		while ($t < $num_date) {
			$dow = date_format($start, 'w');

			$tw = array_filter($work, function ($k) use ($dow){
				return $k['dow'] == $dow;
			});

			if($tw) {
				foreach ($tw as $key => $value) {
					$st = date_create($value['start']);
					$en = date_create($value['end']);
					
					$timeSch = date_diff($st,$en);

					$minutes = $timeSch->days * 24 * 60;	// ngay
					$minutes += $timeSch->h * 60;
					$minutes += $timeSch->i;
					$maxTime += $minutes;
				}
			}
			$start = date_add($start, date_interval_create_from_date_string("1 days"));
			$t++;
		}

		$unTime = 0;

		$con1 = "'$start_date' <= DATE(start_time) AND DATE(end_time) <= '$end_date' AND status = 0 AND active = 1 AND id_branch = $id_branch";
		if($id_dentist)
		{
			$con1 .= " AND id_dentist = $id_dentist";
		}

		$sch = CsSchedule::model()->findAll(array(
				'select' => '*',
				'condition' => $con1,	
			));

		foreach ($sch as $key => $value) {
			$st = date_create($value['start_time']);
			$en = date_create($value['end_time']);

			$timeSch = date_diff($st,$en);

			$minutes = $timeSch->days * 24 * 60;
			$minutes += $timeSch->h * 60;
			$minutes += $timeSch->i;
			$unTime  += $minutes;
		}

		return $maxTime - $unTime;
	}
	function SendEmail($from, $cus_name, $code_active, $id_cus = '', $type = 1)
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
			$title         = 'BookOke Support';
			$mailTo        = $from;
			//$email_content = 'test mail';
			$email_content =  Yii::app()->controller->renderPartial('application.themes.vsc.views.fb.sendMailCode',array('fullname' => $cus_name, 'code' => $code_active), true);
		}
		// gui mail xac nhan tai khoan
		elseif ($type == 2) {
			$title         = 'BookOke Support';
			$mailTo        = $from;
			$pass = $this->randomPass();

			$activation = md5($from.time());
			$command    = Yii::app()->db->createCommand();	
			$data       = $command->update('customer', array(
					'code_confirm' =>$activation,
					'username'     =>$from,
					'password'     =>md5($pass),
			),'id=:id',array(':id'=>$id_cus));

			$mailifo = array('fullname' => $cus_name, 'email' => $from, 'pass' => $pass);

			$email_content  = $this->renderPartial('application.modules.itemsCustomers.views.accounts.view_sendmailconfim',array('mail_info'=>$mailifo,'activation'=>$activation),true);
		}

		$rs=  CsNotifications::model()->sendMail($mailHost,$mailPort,$username,$password,$mailFrom,$mailTo,$title,$email_content);

		return $rs;
	}
//////////////////////////////ReportingBusiness////////////////////////////
	public function getTotalSchedule($branch,$month,$year) //Tổng số lịch hẹn
	{
		$con = Yii::app()->db;
		$sql = "select count(code) as totalSchedule from cs_schedule where 1 = 1";
		// if ($lstUser) {
		// 	$sql.=" and id_dentist=$lstUser";
		// }
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		// if ($type_time) {
		// 	if ($type_time == 1) {
		// 		$time = date('Y-m-d');
		// 		$sql.= " and DATE(create_date)='$time'";
		// 	}
		// 	else if ($type_time == 2)
		// 	{
		// 		$time_fisrt = date('Y-m-d',strtotime('monday this week'));
		// 		$time_last = date('Y-m-d',strtotime('sunday this week'));
		// 		$sql.= " and (DATE(cs_schedule.`create_date`)>='$time_fisrt' and DATE(cs_schedule.`create_date`)<='$time_last')";
		// 	}
		// 	else if ($type_time==3)
		// 	{
		// 		$time = date('m',strtotime($to_date));
		// 		$sql.= " and MONTH(create_date) = '$time'";
		// 	}
		// 	else if ($type_time==4)
		// 	{
		// 		$time = date('m',strtotime($to_date. ' - 1 month')); //tháng trước
	 //            $sql.=" and MONTH(create_date) = '$time'";
		// 	}
			
		// }
		if($month && $year){
			$sql.= " and (month(cs_schedule.`create_date`)='$month' and year(cs_schedule.`create_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return $data[0]['totalSchedule'];
		}
		else
			return 0;
		
	}
	public function getTotalTimeCure($branch,$month,$year)//tổng số giờ điều trị
	{
		$con = Yii::app()->db;
		$sql = "select SUM(lenght) as totalTime from cs_schedule where 1 = 1 and (status=3 or status=4)";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}

		if($month && $year){
			$sql.= " and (month(cs_schedule.`create_date`)='$month' and year(cs_schedule.`create_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return (int)$data[0]['totalTime'];
		}
		else
			return 0;
	}
	public function getTotalTimesCure($branch,$status,$month,$year)//tổng số điều trị hoặc tổng số điều trị hoàn tất
	{
		$con = Yii::app()->db;
		$sql = "select count(code) as totalTimesCure from cs_schedule where 1 = 1";
		if ($status) {
			$sql.=" and status =$status";
		}
		else 
			$sql.=" and (status =3 or status = 4)";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($month && $year){
			$sql.= " and (month(cs_schedule.`create_date`)='$month' and year(cs_schedule.`create_date`)='$year')";
		}
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return $data[0]['totalTimesCure'];
		}
		else
			return 0;
	}
	public function getListCustomerSpend($lstUser,$branch,$type_time,$fromdate,$todate)
	{
		$con = Yii::app()->db;
		$sql="select customer.`id`,customer.`fullname`,v_quotations.`sum_amount`,v_quotations.`currency_use`,cs_schedule.`id_dentist`,COUNT( DISTINCT v_quotation_detail.`id_service`) AS totalService, COUNT( DISTINCT cs_schedule.`code`) AS totalSchedule, v_invoice.`sum_amount` AS sumInvoice,  v_invoice.`balance` AS balanceInvoice FROM (((customer JOIN v_quotations ON customer.`id`=v_quotations.`id_customer`)LEFT JOIN v_quotation_detail ON v_quotations.`id`=v_quotation_detail.`id_quotation`) LEFT JOIN cs_schedule ON customer.`id`=cs_schedule.`id_customer`) LEFT JOIN v_invoice ON customer.`id`=v_invoice.`id_customer` WHERE 1=1";
		if ($lstUser) {
			$sql.=" and cs_schedule.`id_dentist`=$lstUser";
		}
		if ($branch) {
			$sql.=" and v_quotations.`id_branch`=$branch";
		}
		if ($type_time) {
			if ($type_time == 1) {
				$time = date('Y-m-d');
				$sql.= " and DATE(v_quotations.`create_date`)='$time'";
			}
			else if ($type_time == 2)
			{
				$time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));
				$sql.= " and (DATE(v_quotations.`create_date`)>='$time_fisrt' and DATE(v_quotations.`create_date`)<='$time_last')";
			}
			else if ($type_time==3)
			{
				$time = date('m',strtotime(date('Y-m-d')));
				$sql.= " and MONTH(v_quotations.`create_date`) = '$time'";
			}
			else if ($type_time==4)
			{
				$time = date('m',strtotime(date('Y-m-d'). ' - 1 month')); //tháng trước
	            $sql.=" and MONTH(v_quotations.`create_date`) = '$time'";
			}
			else if($type_time==5)
			{
				$sql.= " and (DATE(v_quotations.`create_date`)>='$fromdate' and DATE(v_quotations.`create_date`)<='$todate')";
			}
		}
		$sql.=" GROUP BY customer.`id`";
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return $data;
		}
	}
	
	public function checkCustomerSchedule($id_customer)
	{
		if(!$id_customer)
			return null;
		$cs = new CsSchedule;		
		$v = new CDbCriteria();	
		$now = date('Y-m-d');
		$v->addCondition("id_customer = $id_customer");
		$v->addCondition("DATE(start_time) >= '$now'");
		$v->addCondition("active = 1");
		$v->addCondition("status IN (1,2,3,6)");
		//$v->limit = 1;

	    return $cs->find($v);
	}

	public function getCustomerDiscount($id_customer){
		$con = Yii::app()->db;
		$sql = "select abs(SUM(amount)) as total from v_invoice_detail where id_discount >0 ";
		if ($id_customer) {
			$sql.=" and id_customer = $id_customer";
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data[0]['total'];
	}

}