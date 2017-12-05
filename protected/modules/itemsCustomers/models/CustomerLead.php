<?php

/**
 * This is the model class for table "customer_lead".
 *
 * The followings are the available columns in table 'customer_lead':
 * @property integer $id
 * @property integer $id_lead
 * @property integer $id_customer
 * @property string $createdate
 */
class CustomerLead extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_lead';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lead, id_customer', 'required'),
			array('id_lead, id_customer', 'numerical', 'integerOnly'=>true),
			array('createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lead, id_customer, createdate', 'safe', 'on'=>'search'),
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
			'id_lead' => 'Id Lead',
			'id_customer' => 'Id Customer',
			'createdate' => 'Createdate',
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
		$criteria->compare('id_lead',$this->id_lead);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerLead the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
		public function searchOpportunity($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*), b.schedule_date FROM customer a inner join customer_lead b WHERE a.id = b.id_customer and a.status = 0";

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

		$sql = "SELECT a.*, b.schedule_date, b.id_customer,c.fullname, c.image FROM cs_lead a inner join customer_lead b inner join customer c WHERE a.id = b.id_lead and b.id_customer = c.id and c.status = 0   ";
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
	public function addlead($dataCustomer = array('username'=>null,'password'=>'','repeatpassword'=>'','fullname'=>'', 'address'=>'', 'phone'=>'', 'phone_sms'=>'', 'email'=>null, 'image'=>'', 'id_country'=>'','id_city'=>'','id_state'=>'' , 'gender'=>'', 'birthdate'=>'', 'status'=>'0', 'identity_card_number'=>'', 'id_fb'=>null, 'name_fb'=>'', 'id_gg'=> null, 'name_gg'=> '', 'code_number'=>null, 'code_number_old'=>null)){

		$customer = new Customer;
		//$lead = new CsLead;
		$lead 			= new CsLead;
		$lead ->phone 	= $lead->getVnPhone($dataCustomer['phone']);
	
		if($lead->validate() && $lead->save() ){

			return $this->addCustomerLead($dataCustomer,$lead->id);
		}

		return array('status'=>0, 'error'=> $lead->getErrors());
    }
    
    public function addCustomerLead($dataCustomer,$id_lead){

    	$model 						= new Customer();
		$model->attributes 	   		= $dataCustomer;

		$phone = CsLead::model()->getVnPhone($model->phone);

		$model->phone          = $phone;
		$model->phone_sms      = $phone;
		$model->repeatpassword = md5($model->password);
		$model->password       = md5($model->password);
		$model->status         = 0;
		
		if($model->validate() && $model->save() ){

			CustomerLead::model()->getRelationshipLeadCustomer($id_lead,$model->id);
			
			return array('status'=>1 , 'id_customer'=>$model->id, 'data'=>$model->attributes);

		}
		
		return array('status'=>0, 'error'=> $model->getErrors());
    }

	public function getRelationshipLeadCustomer($id_lead,$id_customer){

    	$cuslead = new CustomerLead();
		$cuslead->id_lead 	= $id_lead;
		$cuslead->id_customer = $id_customer;
		$cuslead->insert();

    	return array('status'=>1, 'error'=> "true");
    	
    }
    
	public function updateCustomer($id,$fullname,$email,$phone,$gender,$birthdate,$identity_card_number,$id_country,$id_city,$organization,$address,$id_source,$id_state){
		Customer::model()->updateByPk($id, array('fullname'=>$fullname,'email'=>$email,'phone'=>$phone,'gender'=>$gender,'birthdate'=>$birthdate,'identity_card_number'=>$identity_card_number,'id_country'=>$id_country,'id_city'=>$id_city,'organization'=>$organization,'address'=>$address,'id_source'=>$id_source,'id_state'=>$id_state));
		return $id;	
	}
	public function insertLeadCustomer($id_lead,$id_customer)
	{
		$itemLeadCustomer = new CustomerLead;
		$itemLeadCustomer->id_lead = $id_lead;
		$itemLeadCustomer->id_customer = $id_customer;
		if ($itemLeadCustomer->save(false)) {
			return $itemLeadCustomer->id;
		}
	}
	/*public function detaillead($id)
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "SELECT a.*, b.id_lead FROM customer AS a INNER JOIN customer_lead AS b WHERE a.id = b.id_customer AND a.id =" .$id;
	}*/
}
