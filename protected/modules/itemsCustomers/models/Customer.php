<?php

/** 
 * This is the model class for table "customer". 
 * 
 * The followings are the available columns in table 'customer': 
 * @property integer $id
 * @property integer $code_number
 * @property string $username
 * @property string $password
 * @property string $id_fb
 * @property string $name_fb
 * @property string $id_gg
 * @property string $name_gg
 * @property string $fullname
 * @property string $address
 * @property string $phone
 * @property string $phone_sms
 * @property string $email
 * @property string $image
 * @property string $device_id
 * @property integer $dentist_type
 * @property string $id_country
 * @property string $id_company
 * @property integer $id_city
 * @property integer $id_state
 * @property integer $id_source
 * @property string $zipcode
 * @property integer $gender
 * @property string $birthdate
 * @property string $createdate
 * @property string $activedate
 * @property integer $status
 * @property integer $status_schedule
 * @property integer $id_job
 * @property integer $position
 * @property string $organization
 * @property string $note
 * @property string $identity_card_number
 * @property string $home_phone
  * @property string $status_confirm
 * @property string $code_confirm
 */ 
class Customer extends CActiveRecord
{
	public $repeatpassword;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('phone, phone_sms, fullname', 'required', 'message'=>"{attribute} không được để trống!"),
			//array('username', 'match' ,'pattern'=>'/^[a-zA-Z][a-zA-Z0-9._]+$/i', 'message'=>'Tên tài khoản bao gồm chữ, số'),
			array('username', 'unique', 'message'=>"Tài khoản đã tồn tại!"),
			array('email', 'unique', 'message'=>"Email đã tồn tại!"),
			array('phone', 'numerical', 'message'=>"Số điện thoại phải là số!"),
			array('email', 'email', 'message'=>"Email không đúng định dạng!"),
			//array('phone, phone_sms', 'unique', 'message'=>"Số điện thoại đã tồn tại!"),
			array('code_number, id_company, id_city, id_state, id_source, gender, status, status_schedule,flag, id_job, position,status_confirm', 'numerical', 'integerOnly'=>true),
			array('password, fullname, address, email, id_country, organization, note, id_fb, name_fb, id_gg, name_gg,', 'length', 'max'=>255),
			array('phone, phone_sms, identity_card_number, home_phone', 'length', 'max'=>20),
			array('zipcode', 'length', 'max'=>16),
			array('birthdate, createdate,code_confirm', 'safe'),
			array('repeatpassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Mật khẩu không trùng khớp!"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code_number, password, fullname, id_fb, name_fb, id_gg, name_gg, address, phone, phone_sms, email, image, id_country, id_company, id_city, id_state, id_source, zipcode, gender, birthdate, createdate, device_id, status, status_schedule,flag, id_job, position, organization, note, identity_card_number, home_phone', 'safe', 'on'=>'search'),
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
			'code_number' => 'Code Number',
			'password' => 'Password',
			'repeatpassword' => 'Confirm Password',
			'id_fb' => 'Id Fb',
            'name_fb' => 'Name Fb',
            'id_gg' => 'Id Gg',
            'name_gg' => 'Name Gg',
			'fullname' => 'Họ tên',
			'address' => 'Address',
			'phone' => 'Số điện thoại',
			'phone_sms' => 'Phone Sms',
			'email' => 'Email',
			'image' => 'Image',
			'id_country' => 'Id Country',
			'id_company' => 'Id Company',
			'id_city' => 'Id City',
			'id_state' => 'Id State',
			'id_source' => 'Id Source',
			'zipcode' => 'Zipcode',
			'gender' => 'Gender',
			'birthdate' => 'Birthdate',
			'createdate' => 'Createdate',
			'device_id'=> 'Device Id',
			'status' => 'Status',
			'status_schedule' => 'Status Schedule',
			'flag' => 'Flag',
			'id_job' => 'Id Job',
			'position' => 'Position',
			'organization' => 'Organization',
			'note' => 'Note',
			'identity_card_number' => 'Identity Card Number',
			'home_phone' => 'Home Phone',
			'code_confirm' => 'Code Confim',
			'status_confirm' => 'Status Confim',
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
		$criteria->compare('code_number',$this->code_number);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('repeatpassword',$this->repeatpassword,true);
		$criteria->compare('id_fb',$this->id_fb,true);
        $criteria->compare('name_fb',$this->name_fb,true);
        $criteria->compare('id_gg',$this->id_gg,true);
        $criteria->compare('name_gg',$this->name_gg,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone_sms',$this->phone_sms,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('id_country',$this->id_country,true);
		$criteria->compare('id_company',$this->id_company,true);
		$criteria->compare('id_city',$this->id_city);
		$criteria->compare('id_state',$this->id_state);
		$criteria->compare('id_source',$this->id_source);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('device_id',$this->device_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_schedule',$this->status_schedule);
		$criteria->compare('flag',$this->flag);	
		$criteria->compare('id_job',$this->id_job);
		$criteria->compare('position',$this->position);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('identity_card_number',$this->identity_card_number,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('code_confirm',$this->code_confirm);
		$criteria->compare('status_confirm',$this->status_confirm);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getListCustomers($curpage,$lpp,$srchCustomer)
	{
		
		//return $srchCustomer;

		$start_point=$lpp*($curpage-1);

		$cs 		= new Customer;		
		$q 			= new CDbCriteria(array(
    	'condition'=>'published="true"'
		));

		$v = new CDbCriteria();	
		//$v->addCondition('t.status >= 0');		

		//$v->order = 'createdate DESC';

		$v->addSearchCondition('code_number', $srchCustomer, true);
		$v->addSearchCondition('fullname', $srchCustomer, true, 'OR');

		$num_row = count($cs->findAll($v));
	
		if($num_row == 0){
            return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$curpage,'lpp'=>$lpp,'start_num'=>1), 'data'=>'');
        } 

		$paging = $this->getPageSearch($curpage,$lpp,$num_row);
		

	    //$v->order= 'id_product DESC';
	    $v->limit  = $lpp;
	    $v->offset = $start_point;
	    $q->mergeWith($v);

	    $data =	$cs->findAll($v);
	    return array('paging' => $paging, 'data' => $data);
	}


	    /** Pagging **/
    function getPageSearch($cur_page,$lpp,$num_row){

        $lpp_org = $lpp;

        if($lpp == 'all'){
            $lpp = $num_row;
        }
        if($num_row < $lpp){
            $cur_page = 1;
            $num_page = 1;
            $lpp      = $num_row;
            $start    = 0;
        }else{
            $num_page     = ceil($num_row/$lpp); 
            if($cur_page >= $num_page){
                $cur_page = $num_page;
                $lpp      = $num_row - ($num_page - 1) * $lpp_org;
            } 
            $start        = ($cur_page - 1) * $lpp_org;
        }
        return array(   'num_row'   =>$num_row,
                        'num_page'  =>$num_page,
                        'cur_page'  =>$cur_page,
                        'lpp'       =>$lpp_org,
                        'start_num' =>$start+1
                );

    }

    
	public function getListSumCustomers(){

		$num_row= Yii::app()->db->createCommand()
        ->select('Count(*)')
        ->from('customer')
        ->where('status=:status', array(':status' => '1'))
        ->queryScalar();
        return $num_row;
		
	}

	public function getListSumCustomersByAppointment($id_dentist){
		
		$num_row= Yii::app()->db->createCommand()
                    ->select('Count(*)')
                    ->from('v_schedule')
                    ->where('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentis))
                    ->group('v_schedule.id_customer')       
                    ->queryScalar();
        return $num_row;
	}

	public function getlistServices(){
		return CsService::model()->findAllByAttributes(array('status'=>1));
	}
	public function getListDentists(){
		return GpUsers::model()->findAllByAttributes(array('group_id'=>Yii::app()->params['id_group_dentist']));	
	}
	public function getListBranch(){
		return Branch::model()->findAll();	
	}
	public function getListLaboElite(){
		return LaboElite::model()->findAll();	
	}
	public function getNameByIdBranch($id_branch){

		if(!$id_branch){
			return -1; 
 		}

 		$data = Branch::model()->findByPk($id_branch);

		return $data->name;	
	}
	
	public function getBranchById($id_branch){

		if(!$id_branch){
			return -1; 
 		}

 		return $data = Branch::model()->findByPk($id_branch);
		
	}

	public function getNameByIdDentist($id_dentist){

		if(!$id_dentist){
			return -1; 
 		}

 		$data = GpUsers::model()->findByPk($id_dentist);

		return $data->name;	
	}
	
	public function getNameByIdLaboElite($id_labo_elite){

		if(!$id_labo_elite){
			return -1; 
 		}

 		$data = LaboElite::model()->findByPk($id_labo_elite);

		return $data->name;	
	}
	
	public function getListCountry(){
		$criteria = new CDbCriteria(); 
		$criteria->addCondition('flag = 1');
		$criteria->order= 'code DESC';
		return CsCountry::model()->findAll($criteria);
	}
	public function getListCompany(){
		$criteria = new CDbCriteria(); 
		$criteria->addCondition('Status = 1');
		$criteria->order= 'Name DESC';
		return Company::model()->findAll($criteria);
	}
	public function getListSource(){
		return Source::model()->findAll();
	}
	public function getListSegment(){
		return Segment::model()->findAll();
	}
	public function getSelectedSegment($id_customer){

		if(!$id_customer){
			return -1; 
 		}

		$data = CustomerSegment::model()->findByAttributes(array('id_customer'=>$id_customer));

		if ($data) {
			return $data->id_segment;
		}

		return 0;
		
	}
	public function getJob(){
		return Job::model()->findAll();
	}
	public function getInsurranceType(){
		return InsurranceType::model()->findAll();
	}
	public function getListMedicineAlert(){
		return MedicineAlert::model()->findAll();
	}
	public function getListDisease(){
		return Disease::model()->findAll();
	}
	public function getListCustomer(){
		return Customer::model()->findAll();
	}
	
	public function getListMedicalHistory($id_history_group,$id_order_detail){
		return $data = Yii::app()->db->createCommand()
                ->select('cs_medical_history.*,gp_users.name gp_users_name')
                ->from('cs_medical_history')
                ->where('id_history_group=:id_history_group', array(':id_history_group' => $id_history_group))
                ->andWhere('id_order_detail=:id_order_detail', array(':id_order_detail' => $id_order_detail))
                ->leftJoin('gp_users', 'gp_users.id = cs_medical_history.id_dentist')
                ->order('cs_medical_history.createdate DESC')
                ->queryAll();
	}
	public function getListOrderDetail($id_customer){		
		return VOrderDetail::model()->findAllByAttributes(array("id_customer"=>$id_customer));	
	}
	public function existQuotation($id_customer,$id_mhg){		
		return VQuotations::model()->findByAttributes(array("id_customer"=>$id_customer,"id_group_history"=>$id_mhg));	
	}
	public function getOrder($id){		
		return VOrder::model()->findByAttributes(array("id"=>$id));	
	}
	public function getListMedicalHistoryAlertOfCustomer($id_customer){

		return $data   = Yii::app()->db->createCommand()
                ->select('cs_medical_history_alert.id as id, cs_medical_history_alert.id_medicine_alert as id_medicine_alert, cs_medical_history_alert.note, medicine_alert.name as name_medicine_alert')
                ->from('cs_medical_history_alert')
                ->where('cs_medical_history_alert.id_customer=:id_customer', array(':id_customer' => $id_customer))               
                ->leftJoin('medicine_alert', 'medicine_alert.id = cs_medical_history_alert.id_medicine_alert')
                ->queryAll();

	}
	public function getListMedicalHistoryAlert($id_customer){

		$result = array();
		$data = CsMedicalHistoryAlert::model()->findAllByAttributes(array("id_customer"=>$id_customer));
		if($data && count($data) > 0){
			foreach ($data as $key => $value) {
				$result[$value['id_medicine_alert']] = $value['note'];
			}
		}
		return $result;

	}
	public function getCustomerInsurrance($id_customer){
		
		$model = new CsCustomerInsurrance();

		$data  = $model->findByAttributes(array('id_customer'=>$id_customer,'status'=>1));
		
		if($data){
			return $data;
		}
		return $model;
	}
	
	public function getVnPhone($phone){
		 $phone =preg_replace("/[^0-9]/", "", $phone);//remove none numberic
		 if(strlen($phone)==0)
			 return "";
		if(strlen($phone)>16)
			$phone = substr($phone,0,16);
		if(substr( $phone, 0, 1 ) === "0"){
			$phone ="84". substr($phone,1,strlen($phone));
		} else if(substr( $phone, 0, 3 ) == "840"){
			$phone ="84".substr( $phone, 3, strlen($phone) );
		}
		else if(substr( $phone, 0, 2 ) != "84"){
			$phone ="84".$phone;
		}
		return $phone;
	}
	
	public function getCodeNumberCustomer(){
		
         $date 	= date('Y-m-d');   
        $month 	= date('Y-m');     

        $con 	= Yii::app()->db;
  
        $sql 	= "SELECT COUNT(*) FROM `customer` WHERE ( `status` =1 OR  (  `status` = -1 AND (`code_number` != '' OR `code_number` != NULL ) ) ) AND MONTH(`createdate`) = MONTH('$date')  ";

        $dem 	= $con->createCommand($sql)->queryScalar();
      
        if($dem ==0){
            $dem = '0001';
        }else{
        	$dem ++;

        	if($dem < 1000){
        		$dem = '0'.$dem;

	            if($dem < 100){
	                $dem = '0'.$dem;
	                if($dem < 10){
	                    $dem = '0'.$dem;
	                }
	            }
	        }
        }
        
        $create_date = str_replace(array('-',' ',':'),'',substr( $month, 2 ));    

        if($dem > 0){
            $order_code = $create_date.$dem;
        }else{
            $order_code = $create_date.$dem;
        }

        return $order_code;
        
    }
    public function getRelationshipLeadCustomer($id_lead,$id_customer,$source_status){


    	$model = new CustomerLead();
    
    	if($model->findByAttributes(array('id_lead'=>$id_lead,'id_customer'=>$id_customer))){

    		$model->id_lead 	= $id_lead;
    		$model->id_customer = $id_customer;
    		$model->save(false);
    	}
    	return $model;
    	
    }

    /* 	Dang ky khach hang => status = 0
		Dat lich thanh cong thi update => status = 1/ code_number  

    */

    public function registerCustomer($dataCustomer = array('phone'=>'', 'password'=>'','repeatpassword'=>'', 'fullname' =>'', 'address'=>'', 'email'=>'', 'id_country'=>'','gender'=>'', 'birthdate'=>'','source'=>1,'status'=>'0')){

		$model 						= new Customer();
		$model->attributes 	   		= $dataCustomer;
		$model->phone 				= CsLead::model()->getVnPhone($model->phone);
		$model->repeatpassword 		= md5($dataCustomer['repeatpassword']);
		$model->password  	   		= md5($model->password);

		
		if($model->validate() && $model->save() ){

			$id_lead = CsLead::model()->getIdLead($dataCustomer['phone']);

			$this->getRelationshipLeadCustomer($id_lead,$model->id,$dataCustomer['source']);

		}

		return $model;
    }


    public function searchCustomers($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

	/*	$sql = "select cs_schedule_edition.status status_schedule
				from customer 
				left join ( select id_customer,status from cs_schedule where active = 1 and ( status = 2 OR status = 3 ) order by status desc ) cs_schedule_edition
				on customer.id = cs_schedule_edition.id_customer
				where customer.status = 1 ";*/

		$sql = 'select count(*) from customer where 1 = 1';

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = $con->createCommand($sql)->queryScalar();
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		/*$sql = "select id,fullname,image,code_number,phone,email,gender,birthdate,identity_card_number,id_city,id_country,cs_schedule_edition.status status_schedule,address 
				from customer 
				left join ( select id_customer,status from cs_schedule where active = 1 and ( status = 2 OR status = 3 ) order by status desc ) cs_schedule_edition
				on customer.id = cs_schedule_edition.id_customer
				where customer.status = 1 ";*/

		$sql = 'select * from customer where 1 = 1';

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}

	public function searchVSchedules($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select status status_schedule from v_schedule where status_active = 1 and status >= 1 ";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = count($con->createCommand($sql)->queryAll());
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		$sql = "select id_customer id,fullname,image_customer image,code_number,phone,status status_schedule from v_schedule where status_active = 1 and status >= 1 ";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}	

	public function searchOpportunity($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from customer where status = 0 ";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = $con->createCommand($sql)->queryScalar();
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		$sql = "select id,fullname,image,code_number,phone from customer where status = 0  ";
		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}
	
	public function update_customer($fullname,$address,$phone,$email,$id_country,$gender,$birthdate,$image,$id_job,$position,$organization,$note,$identity_card_number,$id)
	{
		$con = Yii::app()->db;
		$sql="UPDATE customer SET fullname='$fullname',address='$address',phone='$phone',email='$email',id_country='$id_country',gender='$gender',birthdate='$birthdate',image='$image',id_job='$id_job',position='$position',organization='$organization',note='$note',identity_card_number='$identity_card_number' WHERE id='$id'";
		$data=$con->createCommand($sql)->execute();
		return $data;
	}

	public function update_code_customer($id_customer) 
	{
		$code_number = Customer::model()->findByPk($id_customer)->code_number;
		if($code_number==0) {
			$code_number = $this->getCodeNumberCustomer();
			$con = Yii::app()->db;
			$sql="UPDATE customer SET code_number = '$code_number', activedate = NOW(), status = 1 WHERE id='$id_customer'";
			$data=$con->createCommand($sql)->execute();
			if($data)
				return 1;		// cập nhật thành công
			else
				return 0;		// cập nhật thất bại
		}
		else
			return 1;		// đã có dữ liệu
	}

	public function getListSchedule($id_dentist='',$id_patient='',$id_branch='',$id_chair='')
	{	
		$status = 0;	
		$condition ='';
		if($id_dentist)
		{
			$condition = $condition ? $condition.' AND ' : $condition;
			$condition .= "id_dentist = " . $id_dentist;
		}
		if($id_branch)
		{
			$condition = $condition ? $condition.' AND ' : $condition;
			$condition .= "id_branch = " . $id_branch;
		}
		if($id_chair)
		{
			$condition = $condition ? $condition.' AND ' : $condition;
			$condition .= "id_chair = " . $id_chair;
		}
		if($id_patient)
		{
			$condition = $condition ? $condition.' AND ' : $condition;
			$condition .= "id_customer = " . $id_patient;
		}	
			
		$condition = $condition ? $condition.' AND ' : $condition;
		$condition .= "status > " . $status;		
		
		$list = VSchedule::model()->findAll(array(
			'select' => '*',
			'order'=>'DATE(start_time)=DATE(NOW()) DESC, IF(DATE(start_time)=DATE(NOW()),start_time,DATE(NULL)) DESC, start_time DESC',
			'condition' => $condition,
		));

		if($list)
			return $list;
		else
			return 0;
	}
	
	public function countMissAppointment($id_customer)
	{	
		if(!$id_customer){
			return; 
 		} 		

		$data = VSchedule::model()->findAllByAttributes(array('id_customer'=>$id_customer,'status'=>-2));	

		if($data)
			return "<span style='color:gray;'>Bỏ hẹn: </span>".count($data);
		else
			return "";
	}

	public function getSumBalance($id_customer)
	{			
		if(!$id_customer){
			return; 
 		} 	
		
		$data = Invoice::model()->findAllByAttributes(array('id_customer'=>$id_customer));	

		if($data){
			
			$sum = 0;

			foreach ($data as $key => $value) {
				$sum += $value['balance'];
			}

			if($sum){
				return "<span style='color:gray;'>Công nợ: </span>".number_format($sum,0,",",".")." VND";
			}else
				return "";	

		}else
			return "";
	}
	
	
	public function addNewCustomer($fullname,$phone,$id_branch) 
	{		

		if(!$fullname){
			return -1; 
 		}

 		if(!$phone){
			return -2; 
 		}

 		if(!$id_branch){
			return -3; 
 		}

 		$customer = new Customer;  		 		

 		$phone    = $this->getVnPhone($phone); 	

 		$customer->code_number = $this->getCodeNumberCustomer();
 		$customer->id_branch   = $id_branch;
		$customer->fullname    = $fullname;
		$customer->phone       = $phone;
		$customer->phone_sms   = $phone;

		if( $customer->validate() && $customer->save() ) {	
			//hoivien
			$customer_member              = new CustomerMember;				
			$customer_member->id_customer = $customer->id;
			$code_member = CustomerMember::model()->codeCustomerMember(12);
			$customer_member->code_member = $code_member;
			$customer_member->save();
			//end hoivien
			$customer_segment              = new CustomerSegment;				
			$customer_segment->id_customer = $customer->id;
			$customer_segment->id_segment  = 1;
			$customer_segment->code_number = $customer->code_number;
			$customer_segment->fullname    = $customer->fullname;			
			$customer_segment->phone       = $customer->phone;				

			if( $customer_segment->validate() &&  $customer_segment->save()) {	

				$lead = new CsLead;
				$lead->phone = $customer->phone;
				$lead->save();
				
				$customerlead = new CustomerLead;
				$customerlead->id_customer = $customer->id;
				$customerlead->id_lead = $lead->id;
				$customerlead->save();
				
				return $customer->code_number;

			}
			


			return 0;			

		}

		return 0;		

	}

	// service	

	public function getListMedicalHistoryGroupByCustomer($id_customer){	

		if(!$id_customer){
			return -1; 
 		} 

		return CsMedicalHistoryGroup::model()->getMedicalHistoryGroup($id_customer);
	}

	public function checkTreatment($id_customer) 
	{
		if(!$id_customer){
			return -1; 
 		}   

 		$model = new CsMedicalHistoryGroup;

 		$data = $model->findByAttributes(array('id_customer'=>$id_customer,'status'=>1));

 		if(!$data) {		
			return 0;	
		}

		return $data ;

	}

	public function checkAddNewTreatment($id_customer) 
	{

		if(!$id_customer){
			return -1; 
 		}

 		$data = $this->checkTreatment($id_customer);  		

 		$result = $this->checkChangeStatusProcess($id_customer);		

		$checkStatusProcess = CsMedicalHistoryGroup::model()->findByAttributes(array('id'=>$data->id,'status_process'=>1));

 		if($result==0 || !$checkStatusProcess) {		
			return 0;	
		}

		return 1;

	}

	public function checkChangeStatusProcess($id_customer) 
	{

		if(!$id_customer){
			return -1; 
 		} 	

 		$data = $this->checkTreatment($id_customer); 	

		$listToothData = ToothData::model()->findByAttributes(array('id_group_history'=>$data->id));

		$listMedicalHistory = CsMedicalHistory::model()->findByAttributes(array('id_history_group'=>$data->id,'status'=>1));

 	// 	if(!$listToothData || !$listMedicalHistory) {		
		// 	return 0;	
		// }

		if(!$listToothData) {		
			return 0;	
		}

		return 1;

	}

	public function addTreatment($id_customer) 
	{
		if(!$id_customer){
	   		return -1; 
	   	} 

	   	$model = new CsMedicalHistoryGroup;

	   	$treatment = $this->checkTreatment($id_customer);
	   
	  	$id_mhg = $treatment?$treatment->id:$treatment;
	   
		if($id_mhg){
		    $data = $model->findByPk($id_mhg);
		    $data->status=0;
		    $data->update();
		}

		$model->id_customer=$id_customer; 
		$model->name=count($model->findAllByAttributes(array('id_customer'=>$id_customer))) + 1;
		$model->status=1;
		$model->status_process=0;

		if($model->save())
		   return $model->id;  
		else
		   return 0;

 	} 	

	public function addNewMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history,$id_dentist) 
	{		

		if(!$id_customer || !$id_dentist){
			return -1; 
 		} 


 		if($chk_medical_history){

 			for ($i=0;$i<count($chk_medical_history);$i++) 
			{		
				$model=new CsMedicalHistoryAlert;	
				$model->id_customer=$id_customer;	
				$model->id_medicine_alert=$chk_medical_history[$i];	
				if($ipt_medical_history){
					$model->note=$ipt_medical_history[$i];
				}
				$model->id_dentist=$id_dentist;	
				$model->save();		
			}	

 		}

 		return 1;	

	}

	public function checkMedicalHistory($id_customer) 
	{		

		if(!$id_customer){
			return -1; 
 		} 

		$data = CsMedicalHistoryAlert::model()->findByAttributes(array('id_customer'=>$id_customer));

 		if(!$data) {		
			return 0;	
		}

		return 1;

	}

	public function updateMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history) 
	{		

		if(!$id_customer){
			return -1; 
 		} 

 		CsMedicalHistoryAlert::model()->deleteAllByAttributes(array('id_customer'=>$id_customer)); 	

 		if ($chk_medical_history) {

			for ($i=0;$i<count($chk_medical_history);$i++) 
			{	
				$model=new CsMedicalHistoryAlert;	
				$model->id_customer=$id_customer;	
				$model->id_medicine_alert=$chk_medical_history[$i];
				if($ipt_medical_history){
					$model->note=$ipt_medical_history[$i];
				}
				$model->save();		
			}	

		}

 		return 1;	

	}

	public function addDetailTreatment($id_customer,$id_mhg,$status_healthy,$chk_medical_history,$id_dentist) 
	{		

		if(!$id_customer || !$id_mhg || !$id_dentist){
			return -1; 
 		} 

		$data = CsMedicalHistoryGroup::model()->findByPk($id_mhg);
 		$data->status_healthy=$status_healthy;
 		if( $data->update() && $chk_medical_history ){

 			for ($i=0;$i<count($chk_medical_history);$i++) 
			{		
				$model=new CsMedicalHistoryAlert;	
				$model->id_customer=$id_customer;	
				$model->id_medicine_alert=$chk_medical_history[$i];		
				$model->id_group_history=$id_mhg;
				$model->id_dentist=$id_dentist;	
				$model->save();		
			}	

 		}

 		return 1;	

	}	

	public function updateTreatment($id_mhg) 
	{		

		if(!$id_mhg){
			return -1; 
 		} 

		$data = CsMedicalHistoryGroup::model()->findByPk($id_mhg);
 		$data->status_process=1;

 		if($data->update()){

			return 1;

 		}

	}	

	public function getListTreatmentProcess($id_customer,$id_mhg) 
	{
		if(!$id_customer || !$id_mhg){
			return -1; 
 		}  	

		$listOrderDetail = Yii::app()->db->createCommand()
		    ->select('v_order_detail.id,v_order_detail.user_name,v_order_detail.services_name,v_order_detail.product_name,v_order_detail.create_date,v_order_detail.branch_name,v_order_detail.code')   
		    ->from('v_order_detail')
		    ->where('v_order_detail.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		    ->andwhere('v_order_detail.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 
		    ->andwhere('v_order_detail.services_name!=""')
		    ->queryAll();

		if($listOrderDetail){
            $data = array();
            foreach($listOrderDetail as $key => $value){
               $listMedicalHistory = Yii::app()->db->createCommand()
	            ->select('v_medical_history.id,v_medical_history.gp_users_name,v_medical_history.name,v_medical_history.createdate')
	            ->from('v_medical_history')
	            ->where('v_medical_history.id_history_group=:id_history_group', array(':id_history_group' => $id_mhg))
	            ->andWhere('v_medical_history.id_order_detail=:id_order_detail', array(':id_order_detail' => $value['id'])) 
	            ->andWhere('v_medical_history.status=1') 	            
	            ->order('v_medical_history.createdate DESC')
	            ->queryAll();   
	       
                $data[$key] = array('id'=>$value['id'],'user_name'=>$value['user_name'],'services_name'=>$value['services_name'],'product_name'=>$value['product_name'],'create_date'=>$value['create_date'],'branch_name'=>$value['branch_name'],'code'=>$value['code'],'listMedicalHistory'=>$listMedicalHistory);
             
            }
            return $data;
        }  

	}

	public function getListTreatmentProcessOfCustomer($id_mhg) 
	{
		if(!$id_mhg){
			return -1; 
 		} 
		
       	return Yii::app()->db->createCommand()
        ->select('v_medical_history.id,v_medical_history.gp_users_name,v_medical_history.tooth_number,v_medical_history.name,v_medical_history.description,v_medical_history.medicine_during_treatment,v_medical_history.createdate,v_medical_history.reviewdate,v_medical_history.id_dentist,v_medical_history.length_time,prescription.id id_prescription,labo.id id_labo')
        ->from('v_medical_history')
        ->where('v_medical_history.id_history_group=:id_history_group', array(':id_history_group' => $id_mhg))	    
        ->andWhere('v_medical_history.status=1') 
        ->leftJoin('prescription', 'prescription.id_medical_history = v_medical_history.id')	
        ->leftJoin('labo', 'labo.id_medical_history = v_medical_history.id')            
        ->order('v_medical_history.createdate DESC')
        ->queryAll(); 
	}

	public function addMedicalHistory($id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time,$session_add_prescription,$session_add_lab) 
	{
		
		if(!$id_history_group || !$id_user || !$id_dentist || !$name){
			return -1; 
 		} 

 		$id_schedule = '';
 		$id_note     = '';

 		if ($reviewdate && $length_time) {

			$cs_schedule = CsSchedule::model()->addNextScheduleCheck($id_customer, $id_dentist, $id_branch, $reviewdate, $length_time, $id_history_group, $id_user, $description, $id_quote = '');
			
			if ($cs_schedule['status'] == 1) {
				$id_schedule = $cs_schedule['id_schedule'];
			}else{
				return $cs_schedule;
			}
			

		}

		if ($description) {
			$result  = CustomerNote::model()->addnote($note=array('note'=>$description,'id_user'=>'','id_customer'=>$id_customer,'flag'=>3,'important'=>0,'status'=>1));
			$id_note = $result['id'];
		}

 		$model = new CsMedicalHistory; 
 		$model->name                      = $name;
		$model->id_history_group          = $id_history_group;
		$model->id_user                   = $id_user;
		$model->description               = $description;
		$model->id_dentist                = $id_dentist;
		$model->reviewdate 				  = $reviewdate;	
		$model->length_time 			  = $length_time;			
		$model->id_schedule 			  = $id_schedule;
		$model->id_note 			      = $id_note;

		if ($model->save()) {

			if ($session_add_prescription) {

				$data = new Prescription;
				$data->id_group_history   = $id_history_group;
				$data->id_medical_history = $model->id;	
				$data->diagnose 		  = $session_add_prescription['diagnose'];		
				$data->advise 		      = $session_add_prescription['advise'];	
				$data->examination_after  = $session_add_prescription['examination_after'];	

				if ($data->save()) {				

					for ($i=0;$i<count($session_add_prescription['drug_name']);$i++) 
					{
						if($session_add_prescription['drug_name'][$i] != ""){

							$result = new DrugAndUsage;
							$result->id_prescription   = $data->id;
							$result->drug_name   	   = $session_add_prescription['drug_name'][$i];
							$result->morning   		   = $session_add_prescription['morning'][$i];
							$result->noon   		   = $session_add_prescription['noon'][$i];
							$result->afternoon   	   = $session_add_prescription['afternoon'][$i];
							$result->night   		   = $session_add_prescription['night'][$i];
							$result->save();

						}
						
					}	

					unset(Yii::app()->session['add_prescription']);

				}

			}

			if ($session_add_lab) {

				$labo = new Labo;
				$labo->id_group_history   = $id_history_group;
				$labo->id_medical_history = $model->id;	
				$labo->attributes		  = $session_add_lab;			

				if ($labo->validate() && $labo->save()) {	

					unset(Yii::app()->session['add_lab']);

				}

			}

			return 1;
		}

	}	

	public function updateMedicalHistory($id_medical_history,$id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time) 
	{
		
		if(!$id_medical_history || !$id_user || !$id_dentist || !$name){
			return -1; 
 		} 

 		$model = CsMedicalHistory::model()->findByPk($id_medical_history);

 		if ($model['id_schedule'] && $model['id_schedule'] > 0) { 

			$id_schedule = $model['id_schedule'];
			
			CsSchedule::model()->updateNextScheduleCheck($model['id_schedule'], $id_dentist, $length_time, $reviewdate, $id_user, $description);
		
		}else{
	
			$id_schedule = '';

	 		if ($reviewdate && $length_time) {

				$cs_schedule = CsSchedule::model()->addNextScheduleCheck($id_customer, $id_dentist, $id_branch, $reviewdate, $length_time, $id_history_group, $id_user, $description, $id_quote = '');

				if ($cs_schedule['status'] == 1) {
					$id_schedule = $cs_schedule['id_schedule'];
				}else{
					return $cs_schedule;
				}

			}

		}

		if ($model['id_note'] && $model['id_note'] > 0) { 

			$id_note = $model['id_note'];

			CustomerNote::model()->updatenote($model['id_note'],$description);

		}else{
	
			$id_note = '';

	 		if ($description) {
				$result  = CustomerNote::model()->addnote($note=array('note'=>$description,'id_user'=>'','id_customer'=>$id_customer,'flag'=>3,'important'=>0,'status'=>1));
				$id_note = $result['id'];
			}

		}

 		$model->name                      = $name;	
 		$model->id_user                   = $id_user;
		$model->description               = $description;
		$model->id_dentist                = $id_dentist;		
		$model->reviewdate 				  = $reviewdate;
		$model->length_time 			  = $length_time;
		$model->id_schedule 			  = $id_schedule;
		$model->id_note 			      = $id_note;

		if ($model->update()) {
			return 1;
		}

	}	

	public function deleteMedicalHistory($id_medical_history) 
	{
		
		if(!$id_medical_history){
			return -1; 
 		} 

 		$model = CsMedicalHistory::model()->findByPk($id_medical_history);;
 		$model->status             = 0;	

		if ($model->update()) {
			return 1;
		}

	}	

	public function getMedicalHistoryById($id) 
	{
		$getMedicalHistoryById = Yii::app()->db->createCommand()
                ->select('cs_medical_history.id, cs_medical_history.id_dentist, cs_medical_history.tooth_number, cs_medical_history.name, cs_medical_history.description, cs_medical_history.length_time, cs_medical_history.medicine_during_treatment, cs_medical_history.reviewdate, cs_medical_history.id_note, prescription.id id_prescription, prescription.diagnose, prescription.advise, prescription.examination_after, prescription.createdate, gp_users.name dentist, labo.id_branch, labo.id_labo_elite, labo.sent_date, labo.received_date, labo.assign, labo.note')
                ->from('cs_medical_history')          
                ->where('cs_medical_history.id =:id', array(':id' => $id))
                ->leftJoin('prescription', 'prescription.id_medical_history = cs_medical_history.id')
                ->leftJoin('labo', 'labo.id_medical_history = cs_medical_history.id')
                ->leftJoin('gp_users', 'gp_users.id = cs_medical_history.id_dentist')         
                ->queryRow();                	

    	$listDrugAndUsage = Yii::app()->db->createCommand()
            ->select('drug_and_usage.drug_name, drug_and_usage.morning, drug_and_usage.noon, drug_and_usage.afternoon, drug_and_usage.night')
            ->from('drug_and_usage')          
            ->where('drug_and_usage.id_prescription =:id_prescription', array(':id_prescription' => $getMedicalHistoryById['id_prescription'])) 
            ->queryAll(); 

        if ($getMedicalHistoryById['id_note'] && $getMedicalHistoryById['id_note'] > 0) {
        	$data = CustomerNote::model()->findByPk($getMedicalHistoryById['id_note']);  
        	if ($data['status'] == -1) {
        		$getMedicalHistoryById['description'] = '';
        	}else{
				$getMedicalHistoryById['description'] = $data['note'];
			}
        }      

        $getMedicalHistoryById['listDrugAndUsage'] = $listDrugAndUsage;

        return $getMedicalHistoryById;          
       
	}

	public function getListName($id_customer,$id_mhg) 
	{		
		return  $data   = Yii::app()->db->createCommand()
                ->select('cs_medical_image.name')
                ->from('cs_medical_image')          
                ->where('cs_medical_image.id_customer =:id_customer', array(':id_customer' => $id_customer))         
                ->andWhere('cs_medical_image.id_group_history =:id_group_history', array(':id_group_history' => $id_mhg))
                ->queryAll();
	}

	public function getIdScheduleByIdCustomer($id_customer) 
	{		
		$data   = Yii::app()->db->createCommand()
                ->select('cs_schedule.id')
                ->from('cs_schedule')          
                ->where('cs_schedule.id_customer =:id_customer', array(':id_customer' => $id_customer))
                ->andWhere('cs_schedule.status =:status', array(':status' => 3))
                ->queryRow();
                
        return $data['id'];
	}

	public function checkWaitingSchedule($id_customer) 
	{		
		$data   = Yii::app()->db->createCommand()
                ->select('cs_schedule.id')
                ->from('cs_schedule')          
                ->where('cs_schedule.id_customer =:id_customer', array(':id_customer' => $id_customer))
                ->andWhere('cs_schedule.active = 1 AND cs_schedule.status = 2')   
                ->queryRow();
				
		if(!$data) {		
			return 0;	
		}

		return $data; 		
	}

	// dang ki khach hang admin
    public function addCustomer($dataCustomer = array('username'=>'','password'=>'','repeatpassword'=>'','fullname'=>'', 'address'=>'', 'phone'=>'', 'phone_sms'=>'', 'email'=>'', 'image'=>'', 'id_country'=>'', 'gender'=>'', 'birthdate'=>'', 'status'=>'1', 'identity_card_number'=>'', 'id_branch'=>'', 'organization'=>'', 'note'=>'', 'id_segment'=>'')){

	   	$model       = new Customer();
	   	if(!isset($dataCustomer['phone_sms']) || !$dataCustomer['phone_sms']) {
	   		$dataCustomer['phone_sms'] = $dataCustomer['phone'];
	   	}
	   	if(isset($dataCustomer['email']) && !$dataCustomer['email'])
	   		unset($dataCustomer['email']);
	   	$model->attributes       = $dataCustomer;

	   	if($model->validate()){
	   		$model->phone       = CsLead::model()->getVnPhone($model->phone);
	   		$model->phone_sms   = CsLead::model()->getVnPhone($model->phone_sms);
			$model->code_number = $this->getCodeNumberCustomer();
			if($model->save()){

				if (isset($dataCustomer['id_segment']) && $dataCustomer['id_segment'])  {

					$customer_segment 			   = new CustomerSegment();
					$customer_segment->id_customer = $model->id;
					$customer_segment->attributes  = $dataCustomer;

					if($customer_segment->validate() && $customer_segment->save()) {	

		      			return array('status'=>1, 'data'=>$model);
		      		}

				}
				
	      		return array('status'=>1, 'data'=>$model);
			}
	   	}
	   	else{
		   $error = $model->getErrors();
		   if($error !== '[]')
		        return $error;
		}
	}

    public function addCsMedicalImage($name,$id_user,$id_customer,$name_upload,$id_mhg){

	  	if(!$name || !$id_user || !$id_customer || !$name_upload || !$id_mhg){
			return -1; 
 		}  		

 		$model = new CsMedicalImage;

 		$data = $model->findByAttributes(array('id_customer'=>$id_customer,'id_group_history'=>$id_mhg,'name'=>$name));

 		if($data) {		
			return 1;	
		}
	
 		$model->name                      = $name;
		$model->id_user                   = $id_user;
		$model->id_customer               = $id_customer;
		$model->id_group_history          = $id_mhg;
		$model->name_upload               = $name_upload;

		if ($model->save()) {
			return 1;
		}	
	  
    }

    public function checkToothData($id_mhg){

	  	if(!$id_mhg){
			return -1; 
 		}   

 		$model = new ToothData;

 		$data = $model->findByAttributes(array('id_group_history'=>$id_mhg));

 		if(!$data) {		
			return 0;	
		}

		return 1;
	  
    }   

    public function getIdBranchByIdUser($id_user){

	  	if(!$id_user){
			return -1; 
 		}   

 		$model = new GpUsers;

 		$data = $model->findByPk($id_user);

 		if(!$data) {		
			return 0;	
		}

		return $data->id_branch;
	  
    }  

    public function updateCustomer($id_customer,$fullname,$email,$phone,$phone_sms,$gender,$birthdate,$identity_card_number,$id_country,$id_source,$id_job,$position,$address,$id_company){

	  	if(!$id_customer){
			return -1; 
 		}   
 		$model = new Customer;
 		if ($email) {
 			$search_email = $model->findAllByAttributes(array('email'=>$email));
 			if ($search_email && $search_email[0]['id']!=$id_customer) {
 				return -2;
 			}
 		}else {
 			$email = null;
 		}
 		return $result = $model->updateByPk($id_customer, array('fullname'=>$fullname,'email'=>$email,'phone'=>$phone,'phone_sms'=>$phone_sms,'gender'=>$gender,'birthdate'=>$birthdate,'identity_card_number'=>$identity_card_number,'id_country'=>$id_country,'id_source'=>$id_source,'id_job'=>$id_job,'position'=>$position,'address'=>$address,'id_company'=>$id_company));	
	  
    }
    public function updateFlag($id_customer,$flag){

	  	if(!$id_customer){
			return -1; 
 		}
 		$flag = $flag==0?1:0;   
 		$model = new Customer;

 		return $result = $model->updateByPk($id_customer, array('flag'=>$flag));	
	  
    }    

	public function updateCustomerSegment($id_customer,$id_segment){

	  	if(!$id_customer){
			return -1; 
 		}   

 		$model = new CustomerSegment;

 		if(!$id_segment){
			return $result = $model->deleteAllByAttributes(array('id_customer'=>$id_customer));
 		} 

 		$data = $model->findByAttributes(array('id_customer'=>$id_customer));

 		if(!$data) {	 			

 			$customer = Yii::app()->db->createCommand()
            ->select('customer.*')
            ->from('customer')
            ->where('id=:id', array(':id' => $id_customer))			               
            ->queryAll();	

 			$model->id_customer = $id_customer;
 			$model->id_segment  = $id_segment;
 			$model->attributes 	= $customer[0];

 			if($model->validate() && $model->save() ){

				return 1;

			}
			
		}

 		return $result = $model->updateByPk($data->id, array('id_segment'=>$id_segment));	
	  
    } 

    public function updateStatusScheduleOfCustomer($id_customer,$status_schedule){

	  	if(!$id_customer || !$status_schedule){
			return -1; 
 		}

 		return $result = Customer::model()->updateByPk($id_customer, array('status_schedule'=>$status_schedule));
	  
    }        

    public function checkNewestTreatmentExistQuotation($id_customer){

    	if(!$id_customer){
	   		return -1; 
	   	} 

	  	$treatment = $this->checkTreatment($id_customer);

	  	$id_mhg = $treatment?$treatment->id:$treatment;
	   
		if($id_mhg){

		    $data = $this->existQuotation($id_customer,$id_mhg);
		    
		    if (count($data)>0){
		    	return $data->id;
		    }else{
		    	return '';
		    }

		}
		
		return '';	  
    } 

    public function checkExistPrescription($id_medical_history){

    	if(!$id_medical_history){
	   		return -1; 
	   	} 

	   	$data = Prescription::model()->findByAttributes(array('id_medical_history'=>$id_medical_history));	 	

 		if(!$data) {		
			return 0;	
		}

		return $data->id;
	  	
    } 

    public function checkExistLabo($id_medical_history){

    	if(!$id_medical_history){
	   		return -1; 
	   	} 

	   	$data = Labo::model()->findByAttributes(array('id_medical_history'=>$id_medical_history));	 	

 		if(!$data) {		
			return 0;	
		}

		return $data->id;
	  	
    } 

    public function savePrescription($savePrescription = array('id_group_history' => '','id_medical_history' => '', 'diagnose' => '', 'drug_name' => '', 'morning' => '', 'noon' => '', 'afternoon' => '', 'night' => '', 'advise' => '', 'examination_after' => '')) 
	{
		
		if(!$savePrescription['id_medical_history']){
			return -1; 
 		} 

 		$mP    = new Prescription; 

 		$cEP   = $this->checkExistPrescription($savePrescription['id_medical_history']);

 		if($cEP == 0){

 			$mP->attributes = $savePrescription;

 			if($mP->validate() && $mP->save()){
				
 				for ($i=0;$i<count($savePrescription['drug_name']);$i++) 
				{				
					$mDAU                    = new DrugAndUsage;				
					$mDAU->id_prescription   = $mP->id;
					$mDAU->drug_name   	     = $savePrescription['drug_name'][$i];
					$mDAU->morning   		 = $savePrescription['morning'][$i];
					$mDAU->noon   		     = $savePrescription['noon'][$i];
					$mDAU->afternoon   		 = $savePrescription['afternoon'][$i];
					$mDAU->night   		     = $savePrescription['night'][$i];
					$mDAU->save();
				}

				return 1;	

			}
			else{
				return 0;
			}

 		}
 		else{

 			$uP              = Prescription::model()->findByPk($cEP);
 			$uP->attributes	 = $savePrescription;

 			if($uP->validate() && $uP->save()){

				DrugAndUsage::model()->deleteAllByAttributes(array('id_prescription'=>$uP->id));

				for ($i=0;$i<count($savePrescription['drug_name']);$i++) 
				{				
					$mDAU                    = new DrugAndUsage;				
					$mDAU->id_prescription   = $uP->id;
					$mDAU->drug_name   	     = $savePrescription['drug_name'][$i];
					$mDAU->morning   		 = $savePrescription['morning'][$i];
					$mDAU->noon   		     = $savePrescription['noon'][$i];
					$mDAU->afternoon   		 = $savePrescription['afternoon'][$i];
					$mDAU->night   		     = $savePrescription['night'][$i];
					$mDAU->save();
				}

				return 1;

			}
			else{
				return 0;
			}

 		} 		

	}	

	public function saveLab($saveLab = array('id_group_history' => '','id_medical_history' => '', 'id_branch' => '', 'id_dentist' => '', 'sent_date' => '', 'received_date' => '', 'assign' => '', 'note' => '')) 
	{
		
		if(!$saveLab['id_medical_history']){
			return -1; 
 		} 

 		$mP    = new Labo; 

 		$cEP   = $this->checkExistLabo($saveLab['id_medical_history']);

 		if($cEP == 0){

 			$mP->attributes = $saveLab;

 			if($mP->validate() && $mP->save()){			
 				

				return 1;	

			}
			else{
				return 0;
			}

 		}
 		else{

 			$uP              = Labo::model()->findByPk($cEP);
 			$uP->attributes	 = $saveLab;

 			if($uP->validate() && $uP->save()){				

				return 1;

			}
			else{
				return 0;
			}

 		} 		

	}
	/*LMV baocao customer*/
		/*LMV baocao customer*/
	public function getselect($time, $id_user, $location,$date){
		$con = Yii::app()->db;
			if ($location == '') {
				$sql = "SELECT DISTINCT a.code_number, a.* FROM customer a  WHERE a.status = 1 ";
			if($time == 3  ){
				$fromdate = date("Y-m-01", strtotime("first day of this month"));
			    $todate= date("Y-m-t", strtotime("last day of this month"));
				
				$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
				
			}
			elseif($time == 1 ){
				$fromdate = date("Y-m-d");
				$sql.= " and   DATE(  a.`createdate` ) = '".$fromdate."'";
				
			}
			
			elseif($time == 5 ){
				$fromdate = date("Y-m-d", strtotime('first day of last month'));
	    		$todate= date("Y-m-d", strtotime('last day of last month'));
				
				$sql.= "  and   DATE(  `createdate` ) > '".$fromdate."' and  DATE(  `createdate` ) <  '".$todate."' ";
				
			}
			
			elseif($time == 2 ){
				$fromdate = date("Y-m-d",strtotime('monday this week'));
				$todate= date("Y-m-d",strtotime('sunday this week'));
				$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			}
			elseif($time == 0 ){
				$date = explode('+', $date);
				$fromdate=date("Y-m-d", strtotime($date[0]));
				$todate=date("Y-m-d", strtotime($date[1]));
				$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			}
			
			
			if($id_user != "" ){
				
				$sql.= " and  a.id = b.id_customer";

				
				$sql.=" and b.id_dentist = '".$id_user."'";
				
				
				
			}
			
				/*$sql .= " limit 0, 150";*/
			
			$data = $con->createCommand($sql)->queryAll();
			return $data;
		}
		$sql = "SELECT DISTINCT a.code_number, a.* FROM customer a INNER JOIN cs_schedule b WHERE a.status = 1 ";
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  a.`createdate` ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE(  `createdate` ) > '".$fromdate."' and  DATE(  `createdate` ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
		}
		/*
		elseif($time == 5 && $id_user == "" && $location != ''){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			

			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			
			$sql.= " and a.id_branch = '".$location."'";
			
			
		}*/
		
		if($id_user != "" ){
			
			$sql.= " and  a.id = b.id_customer";

			
			$sql.=" and b.id_dentist = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}	/*print*/
	public function getsumamout($id){
		$con = Yii::app()->db;
		$sql = "SELECT SUM(a.balance) AS balance, (SUM(a.sum_amount) - SUM(a.balance) ) AS amount, COUNT(b.id_service)  , a.id_customer FROM invoice a INNER JOIN invoice_detail b WHERE  a.`id` = b.`id_invoice` AND  id_customer = ".$id." ";
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	public function getselectprint($time, $id_user, $location,$date_start, $date_end){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number, a.*, b.id_branch, a.introducer FROM customer a INNER JOIN cs_schedule b WHERE a.status = 1 ";
		if($time == 0 ){
			

			//$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date_end));
			$fromdate = date("Y-m-d", strtotime($date_start));
		    //$todate= date("Y-m-d", strtotime($date[0]));
			
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
		}
		elseif($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  a.`createdate` ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE(  `createdate` ) > '".$fromdate."' and  DATE(  `createdate` ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
		}
		
		/*
		elseif($time == 5 && $id_user == "" && $location != ''){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			

			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			
			$sql.= " and a.id_branch = '".$location."'";
			
			
		}*/
		
		if($id_user != "" ){
			
			$sql.= " and  a.id = b.id_customer";

			
			$sql.=" and b.id_dentist = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and b.id_branch = '".$location."'";
		}
			$sql .= " limit 0, 150";
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}	
	/*birthdate*/
	public function getselectbirthdate($time, $id_user, $location, $date){
		$con = Yii::app()->db;
		if($location == ""){
		$sql = "SELECT DISTINCT a.code_number, a.* FROM customer a  WHERE a.status = 1";
		}else {
			$sql = "SELECT DISTINCT a.code_number, a.* FROM customer a INNER JOIN cs_schedule b WHERE a.status = 1 ";
		}
		if($time == 3  ){
			$fromdate = date("m", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   MONTH(  a.`birthdate` ) = '".$fromdate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("m-d");
			$sql.= " and  DATE_FORMAT(a.`birthdate`, '%m-%d') = '".$fromdate."'";
			
		}
		elseif($time == 4 ){
			$fromdate = date("m-d", strtotime('first day of next month'));
    		$todate= date("m-d", strtotime('last day of next month'));
			
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
			
		}

		elseif($time == 5 ){
			$fromdate = date("m-d", strtotime('first day of last month'));
    		$todate= date("m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("m-d",strtotime('monday this week'));
			$todate= date("m-d",strtotime('sunday this week'));
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("m-d", strtotime($date[0]));
			$todate=date("m-d", strtotime($date[1]));
			$sql.= " and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and   DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
		}
		/*elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE(  a.`createdate` ) >= '".$fromdate."' and  DATE(  a.`createdate` ) =<  '".$todate."' ";
		}*/
		
		
		if($id_user != "" ){
			
			$sql.= " and  a.id = b.id_customer";

			
			$sql.=" and b.id_dentist = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			//$sql .= " limit 0, 50";
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
/*printbirthdate*/
public function getselectbirthdateprint($time, $id_user, $location, $date_start, $date_end){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number, a.*, a.id_branch FROM customer a INNER JOIN cs_schedule b WHERE a.status = 1  ";
		if($time == 0 ){
			

			//$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("m-d", strtotime($date_end));
			$fromdate = date("m-d", strtotime($date_start));
		    //$todate= date("Y-m-d", strtotime($date[0]));
			
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
		}
		elseif($time == 3  ){
			$fromdate = date("m", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   MONTH(  a.`birthdate` ) = '".$fromdate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("m-d");
			$sql.= " and  DATE_FORMAT(a.`birthdate`, '%m-%d') = '".$fromdate."'";
			
		}
		elseif($time == 4 ){
			$fromdate = date("m-d", strtotime('first day of next month'));
    		$todate= date("m-d", strtotime('last day of next month'));
			
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
			
		}

		elseif($time == 5 ){
			$fromdate = date("m-d", strtotime('first day of last month'));
    		$todate= date("m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("m-d",strtotime('monday this week'));
			$todate= date("m-d",strtotime('sunday this week'));
			$sql.= "  and   DATE_FORMAT(a.`birthdate`, '%m-%d') > '".$fromdate."' and  DATE_FORMAT(a.`birthdate`, '%m-%d') <  '".$todate."' ";
		}
		/*elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE(  a.`createdate` ) >= '".$fromdate."' and  DATE(  a.`createdate` ) =<  '".$todate."' ";
		}*/
		
		
		if($id_user != "" ){
			
			$sql.= " and  a.id = b.id_customer";

			
			$sql.=" and b.id_dentist = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	/*select finiss service..*/
		public function getselectfinishservice($time, $id_user, $location,$date){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number, a.*, b.date_medical_status FROM customer a INNER JOIN cs_medical_history_group b WHERE a.id = b.id_customer AND a.status = 1 AND b.`status` = 1 ";
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  b.date_medical_status ) > '".$fromdate."' and  DATE(  b.date_medical_status ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  b.date_medical_status ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE( b.date_medical_status ) > '".$fromdate."' and  DATE( b.date_medical_status ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  b.date_medical_status ) > '".$fromdate."' and  DATE(  b.date_medical_status ) <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE( b.date_medical_status ) > '".$fromdate."' and  DATE( b.date_medical_status ) <  '".$todate."' ";
		}
		/*
		elseif($time == 5 && $id_user == "" && $location != ''){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			

			$sql.= " and   DATE(  a.`createdate` ) > '".$fromdate."' and  DATE(  a.`createdate` ) <  '".$todate."' ";
			
			$sql.= " and a.id_branch = '".$location."'";
			
			
		}*/
		
		if($id_user != "" ){
			
			$sql.= " and  a.id = b.id_customer";

			
			$sql.=" and b.id_dentist = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and b.id_branch = '".$location."'";
		}
			//$sql .= " limit 0, 50";
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}	
	/*select service */
	public function getselectservice($time, $id_user, $location,$date,$service,$group){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number,a.introducer, a.gender,  a.`fullname`, a.`id`, a.`address`, a.`phone`, a.`birthdate`,a.`email` , b.`amount`, d.name AS name_branch, c.name AS name_service, e.name AS name_source, b.`user_name` FROM customer a INNER JOIN v_order_detail b INNER JOIN cs_service c INNER JOIN branch AS d INNER JOIN source AS e  WHERE a.status = 1 AND b.id_branch = d.id AND a.id = b.id_customer AND b.`id_service` = c.`id` AND a.`id_source` = e.`id` and c.`id_service_type` = ".$group." ";
		if ($service != '') {
			$sql.= " and b.id_service = ".$service;
		}
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  b.create_date ) > '".$fromdate."' and  DATE(  b.create_date ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  b.create_date ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE( b.create_date ) > '".$fromdate."' and  DATE( b.create_date ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  b.create_date ) > '".$fromdate."' and  DATE(  b.create_date ) <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE( b.create_date ) > '".$fromdate."' and  DATE( b.create_date ) <  '".$todate."' ";
		}
		if($id_user != "" ){
			$sql.=" and b.id_user = '".$id_user."'";
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			//$sql .= " limit 0, 50";
		
		$data = $con->createCommand($sql)->queryAll();

		return $data;
	}	
	/**/
	/*end*/
	/*printr_service*/
	public function getprintservice($time, $id_user, $location,$service,$group,$date_start, $date_end){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number,a.introducer, a.gender,  a.`fullname`, a.`id`, a.`address`, a.`phone`, a.`birthdate`,a.`email` , b.`amount`, d.name AS name_branch, c.name AS name_service, e.name AS name_source, b.`user_name` FROM customer a INNER JOIN v_order_detail b INNER JOIN cs_service c INNER JOIN branch AS d INNER JOIN source AS e  WHERE a.status = 1 AND b.id_branch = d.id AND a.id = b.id_customer AND b.`id_service` = c.`id` AND a.`id_source` = e.`id` and c.`id_service_type` = ".$group." ";
		if ($service != '') {
			$sql.= " and b.id_service = ".$service;
		}
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  b.create_date ) > '".$fromdate."' and  DATE(  b.create_date ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  b.create_date ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE( b.create_date ) > '".$fromdate."' and  DATE( b.create_date ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  b.create_date ) > '".$fromdate."' and  DATE(  b.create_date ) <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$todate=date("Y-m-d", strtotime($date_end));
			$fromdate = date("Y-m-d", strtotime($date_start));
			$sql.= " and   DATE( b.create_date ) > '".$fromdate."' and  DATE( b.create_date ) <  '".$todate."' ";
		}
		if($id_user != "" ){
			$sql.=" and b.id_user = '".$id_user."'";
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			//$sql .= " limit 0, 50";
		
		$data = $con->createCommand($sql)->queryAll();

		return $data;
	}	
	/**/
	/*select spend */
	public function getselectspent($time, $id_user, $location,$date){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number, a.introducer, COUNT(g.`id_service`) AS count_service, SUM(f.`balance`) AS sum_balance , SUM(h.`sum_amount`) AS amount_quotation,SUM(f.`sum_amount`) AS amount_invoice, a.gender, a.`fullname`, a.`id`, a.`address`, a.`phone`, a.`birthdate`,a.`email` , b.`amount`, d.name AS name_branch, e.name AS name_source, b.user_name
				FROM customer a 
				INNER JOIN v_order_detail b 
				INNER JOIN branch AS d 
				INNER JOIN source AS e 
				INNER JOIN invoice AS f
				INNER JOIN invoice_detail AS g
				INNER JOIN quotation AS h
				WHERE a.status = 1 
				AND b.id_branch = d.id 
				AND a.id = b.id_customer 
				AND a.`id_source` = e.`id`
				AND a.`id` = f.id_customer
				AND f.id = g.id_invoice
				AND a.`id` = h.`id_customer`";
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  f.create_date ) > '".$fromdate."' and  DATE(  f.create_date ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  f.create_date ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE( f.create_date ) > '".$fromdate."' and  DATE( f.create_date ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  f.create_date ) > '".$fromdate."' and  DATE(  f.create_date ) <  '".$todate."' ";
		}
		elseif($time == 0 ){
			$date = explode('+', $date);
			$fromdate=date("Y-m-d", strtotime($date[0]));
			$todate=date("Y-m-d", strtotime($date[1]));
			$sql.= " and   DATE( f.create_date ) > '".$fromdate."' and  DATE( f.create_date ) <  '".$todate."' ";
		}
		
		
		if($id_user != "" ){
			
			

			
			$sql.=" and b.id_user = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			$sql .= "GROUP BY a.`id` ";
		
		$data = $con->createCommand($sql)->queryAll();

		return $data;
	}	
	/**/
	/*note*/
	public function getSelectNote($time, $id_user, $location,$date){
		$con = Yii::app()->db;
				$sql = "SELECT DISTINCT a.code_number, a.*,b.note, b.`status` AS note_status, b.`flag`, c.`name` AS user_name FROM customer a INNER JOIN customer_note b INNER JOIN gp_users c  
						 WHERE a.status = 1 
						 AND a.`id` = b.`id_customer`
						 AND b.`id_user` = c.`id`";
			if($time == 3  ){
				$fromdate = date("Y-m-01", strtotime("first day of this month"));
			    $todate= date("Y-m-t", strtotime("last day of this month"));
				
				$sql.= " and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
				
			}
			elseif($time == 1 ){
				$fromdate = date("Y-m-d");
				$sql.= " and   DATE(  b.`create_date` ) = '".$fromdate."'";
				
			}
			
			elseif($time == 5 ){
				$fromdate = date("Y-m-d", strtotime('first day of last month'));
	    		$todate= date("Y-m-d", strtotime('last day of last month'));
				
				$sql.= "  and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
				
			}
			
			elseif($time == 2 ){
				$fromdate = date("Y-m-d",strtotime('monday this week'));
				$todate= date("Y-m-d",strtotime('sunday this week'));
				$sql.= " and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
			}
			elseif($time == 0 ){
				$date = explode('+', $date);
				$fromdate=date("Y-m-d", strtotime($date[0]));
				$todate=date("Y-m-d", strtotime($date[1]));
				$sql.= " and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
			}
			
			
			if($id_user != "" ){
				
			

				
				$sql.=" and b.id_user = '".$id_user."'";
				
				
				
			}
			
			if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
			}	
			
			$data = $con->createCommand($sql)->queryAll();
			return $data;
				
	}
	/**/
	/*print note*/
	public function getPrintNote($time, $id_user, $location,$date_start, $date_end){
		$con = Yii::app()->db;
				$sql = "SELECT DISTINCT a.code_number, a.*,b.note, b.`status` AS note_status, b.`flag`, c.`name` AS user_name FROM customer a INNER JOIN customer_note b INNER JOIN gp_users c  
						 WHERE a.status = 1 
						 AND a.`id` = b.`id_customer`
						 AND b.`id_user` = c.`id`";
			if($time == 3  ){
				$fromdate = date("Y-m-01", strtotime("first day of this month"));
			    $todate= date("Y-m-t", strtotime("last day of this month"));
				
				$sql.= " and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
				
			}
			elseif($time == 1 ){
				$fromdate = date("Y-m-d");
				$sql.= " and   DATE(  b.`create_date` ) = '".$fromdate."'";
				
			}
			
			elseif($time == 5 ){
				$fromdate = date("Y-m-d", strtotime('first day of last month'));
	    		$todate= date("Y-m-d", strtotime('last day of last month'));
				
				$sql.= "  and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
				
			}
			
			elseif($time == 2 ){
				$fromdate = date("Y-m-d",strtotime('monday this week'));
				$todate= date("Y-m-d",strtotime('sunday this week'));
				$sql.= " and   DATE(  b.`create_date` ) > '".$fromdate."' and  DATE(  b.`create_date` ) <  '".$todate."' ";
			}
			elseif($time == 0 ){
			$todate=date("Y-m-d", strtotime($date_end));
			$fromdate = date("Y-m-d", strtotime($date_start));
			$sql.= " and   DATE( b.create_date ) > '".$fromdate."' and  DATE( b.create_date ) <  '".$todate."' ";
		}
			
			
			if($id_user != "" ){
				
			

				
				$sql.=" and b.id_user = '".$id_user."'";
				
				
				
			}
			if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			
				$sql .= " limit 0, 150";
			
			$data = $con->createCommand($sql)->queryAll();
			return $data;
				
	}
	/*end*/
	/*printspend*/
	public function getselectprintspend($time, $id_user, $location,$date_start, $date_end){
		$con = Yii::app()->db;
		$sql = "SELECT DISTINCT a.code_number, COUNT(g.`id_service`) AS count_service, SUM(f.`balance`) AS sum_balance , SUM(h.`sum_amount`) AS amount_quotation,SUM(f.`sum_amount`) AS amount_invoice, a.gender, a.`fullname`, a.`id`, a.`address`, a.`phone`, a.`birthdate`,a.`email` , b.`amount`, d.name AS name_branch, e.name AS name_source 
				FROM customer a 
				INNER JOIN v_order_detail b 
				INNER JOIN branch AS d 
				INNER JOIN source AS e 
				INNER JOIN invoice AS f
				INNER JOIN invoice_detail AS g
				INNER JOIN quotation AS h
				WHERE a.status = 1 
				AND b.id_branch = d.id 
				AND a.id = b.id_customer 
				AND a.`id_source` = e.`id`
				AND a.`id` = f.id_customer
				AND f.id = g.id_invoice
				AND a.`id` = h.`id_customer`";
		if($time == 0 ){
			$todate=date("Y-m-d", strtotime($date_end));
			$fromdate = date("Y-m-d", strtotime($date_start));
			$sql.= " and   DATE( f.create_date ) > '".$fromdate."' and  DATE( f.create_date ) <  '".$todate."' ";
		}
		if($time == 3  ){
			$fromdate = date("Y-m-01", strtotime("first day of this month"));
		    $todate= date("Y-m-t", strtotime("last day of this month"));
			
			$sql.= " and   DATE(  f.create_date ) > '".$fromdate."' and  DATE(  f.create_date ) <  '".$todate."' ";
			
		}
		elseif($time == 1 ){
			$fromdate = date("Y-m-d");
			$sql.= " and   DATE(  f.create_date ) = '".$fromdate."'";
			
		}
		
		elseif($time == 5 ){
			$fromdate = date("Y-m-d", strtotime('first day of last month'));
    		$todate= date("Y-m-d", strtotime('last day of last month'));
			
			$sql.= "  and   DATE( f.create_date ) > '".$fromdate."' and  DATE( f.create_date ) <  '".$todate."' ";
			
		}
		
		elseif($time == 2 ){
			$fromdate = date("Y-m-d",strtotime('monday this week'));
			$todate= date("Y-m-d",strtotime('sunday this week'));
			$sql.= " and   DATE(  f.create_date ) > '".$fromdate."' and  DATE(  f.create_date ) <  '".$todate."' ";
		}

		if($id_user != "" ){
			
			

			
			$sql.=" and b.id_user = '".$id_user."'";
			
			
			
		}
		if ($location != '') {
			$sql.= " and a.id_branch = '".$location."'";
		}
			
			$sql .= "GROUP BY a.`id` ";
		
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}	
	/*end*/
	

	public function getcountlichhen($id){
		$con = Yii::app()->db;
		$sql = "SELECT * FROM `v_quotations` WHERE id_customer = '".$id."'";
		$data = $con->createCommand($sql)->queryAll();
		return count($data);
	}
	public function getcountservice($id){
		$con = Yii::app()->db;
		$sql = " SELECT DISTINCT id_service FROM `v_invoice_detail` WHERE id_customer = '".$id."'";
		$data = $con->createCommand($sql)->queryAll();
		return count($data);
	}
	public function getsuminvoice($id){
		$con = Yii::app()->db;

		$sql = "SELECT SUM(sum_amount) AS sumnount FROM `v_invoice` WHERE id_customer = '".$id."'";
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	public function getStatusMember($id){
		$status = CustomerMember::model()->findByAttributes(array('id_customer'=>$id));
		return $status[0]['status'];
	}

	//thong ke
	public function getCustomerMember($id_customer)
	{			
		if(!$id_customer){
			return; 
 		} 	
		
		$data = CustomerMember::model()->findByAttributes(array('id_customer'=>$id_customer));

		if($data){
			$id_member 		 = $data['id_member']; 	
			$member 		 =  Member::model()->findByAttributes(array('id'=>$id_member));
			if($member)
			{
			return array('member'=>$member, 'data'=>$data);
			}
			else
				return 0;
		}else
			return 0;
	}
	public function getCustomerSchedule($id_customer)
	{			
		if(!$id_customer){
			return; 
 		} 	
		
		$data = VSchedule::model()->findByAttributes(array('id_customer'=>$id_customer),array('order'=>'create_date DESC'));
		$count = count(VSchedule::model()->findAllByAttributes(array('id_customer'=>$id_customer)));
		$schedule_cancel = count(VSchedule::model()->findAllByAttributes(array('id_customer'=>$id_customer,'status'=>'-1'))) ;
		$schedule_noshow = count(VSchedule::model()->findAllByAttributes(array('id_customer'=>$id_customer,'status'=>'-2')));

		if($data){
			
			 return array('count'=>$count,'data'=>$data, 'schedule_cancel'=>$schedule_cancel,'schedule_noshow'=>$schedule_noshow);	

		}else
			return 0;
	}
	public function getCustomerInvoice($id_customer)
	{			
		if(!$id_customer){
			return; 
 		} 	
		$data = (VInvoice::model()->findAllByAttributes(array('id_customer'=>$id_customer)));	
		if($data){
			
			$sum_amount = 0;

			foreach ($data as $key => $value) {
				$sum_amount += (int)($value['sum_amount']);
			}

			if($sum_amount){
				return $sum_amount;
			}else
				return 0;	

		}else
			return 0;
	}
	public function getCustomerReceipt($id_customer)
	{			
		if(!$id_customer){
			return; 
 		} 	
		$data = VReceipt::model()->findAllByAttributes(array('id_customer'=>$id_customer));	
		if($data){
			
			$sum = 0;

			foreach ($data as $key => $value) {
				$sum += (int)($value['pay_amount']);
			}

			$count = count(VReceipt::model()->findAllByAttributes(array('id_customer'=>$id_customer)));
				if($count == 0)
				{
					return  0;
				}else
				{
				  	$avg_detail= $sum/$count;
				  	return $avg_detail;
				}	

		}else
			return 0;
	}

	public function getEvaluateStateOfTartar($id_mhg) 
	{
		if(!$id_mhg){
			return -1; 
 		}  	
 		
		return $data = CsMedicalHistoryGroup::model()->findByPk($id_mhg);	
	}

	public function updateEvaluateStateOfTartar($id_mhg,$evaluate_state_of_tartar) 
	{
		if(!$id_mhg || !$evaluate_state_of_tartar){
			return -1; 
 		}  	

		return $result = CsMedicalHistoryGroup::model()->updateByPk($id_mhg, array('evaluate_state_of_tartar'=>$evaluate_state_of_tartar));	
	}
	/*Lee*/
	public function selectcustomer($id)
	{
		$con = Yii::app()->db;
		$sql = "SELECT *, DAY(birthdate) AS datebirth, MONTH(birthdate) AS monthbirth, YEAR(birthdate) AS yearbirth FROM customer WHERE id = '".$id."'";
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	public function updateProfileCustomer($id,$fullname,$address,$phone,$email,$id_country,$gender,$birthdate,$id_job,$position,$organization,$note,$identity_card_number,$image)
	{
		$con = Yii::app()->db;
		$sql="UPDATE customer SET fullname='$fullname',address='$address',phone='$phone',email='$email',id_country='$id_country',gender='$gender',birthdate='$birthdate',id_job='$id_job',position='$position',organization='$organization',note='$note',identity_card_number='$identity_card_number',image='$image' WHERE id='$id'";
		$data=$con->createCommand($sql)->execute();
		if($data)
		{
			return $data;
		} 
		return array('status'=>'fail', 'error'=>'update fail');
	}
	/*end*/

	public function getListMedicalHistoryAlertByIdCustomer($id_customer)
	{

		$listMedicineAlert = MedicineAlert::model()->findAll();	

		$data = array();

		foreach ($listMedicineAlert as $key => $value) {

			$listMedicalHistoryAlertOfCustomer = Yii::app()->db->createCommand()
	            ->select('*')
	            ->from('cs_medical_history_alert')
	            ->where('cs_medical_history_alert.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
	            ->andWhere('cs_medical_history_alert.id_medicine_alert=:id_medicine_alert', array(':id_medicine_alert' => $value['id']))	
	            ->queryRow(); 

	        if ($listMedicalHistoryAlertOfCustomer) {

	        	$data[$key] = array('id'=>$value['id'],'name'=>$value['name'],'note'=>$listMedicalHistoryAlertOfCustomer['note'],'id_customer'=>$id_customer,'id_dentist'=>$listMedicalHistoryAlertOfCustomer['id_dentist'],'createdate'=>$listMedicalHistoryAlertOfCustomer['createdate'],'status'=>1);
	            	
	        } else {

	        	$data[$key] = array('id'=>$value['id'],'name'=>$value['name'],'note'=>'','id_customer'=>$id_customer,'id_dentist'=>'','createdate'=>'','status'=>0);

	        }           
                
			
		}

		return $data;	
        

	}
	

}
