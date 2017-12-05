<?php

/**
 * This is the model class for table "v_user_hour".
 *
 * The followings are the available columns in table 'v_user_hour':
 * @property integer $id_company
 * @property string $company_name
 * @property integer $id_user
 * @property string $user_name
 * @property string $user_code
 * @property string $user_email
 * @property string $user_image
 * @property integer $id_service
 * @property string $service_code
 * @property string $service_name
 * @property string $service_price
 * @property string $service_length
 * @property integer $dow
 * @property string $start
 * @property string $end
 * @property integer $id_chair
 * @property integer $id_branch
 * @property integer $status_hiden
 */
class VUserHour extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_user_hour';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name, user_name, user_email, service_code, service_name', 'required'),
			array('id_company, id_user, id_service, dow, id_chair, id_branch, status_hiden', 'numerical', 'integerOnly'=>true),
			array('company_name', 'length', 'max'=>500),
			array('user_name, user_email', 'length', 'max'=>128),
			array('user_code', 'length', 'max'=>50),
			array('user_image, service_name', 'length', 'max'=>255),
			array('service_code', 'length', 'max'=>25),
			array('service_price', 'length', 'max'=>12),
			array('service_length', 'length', 'max'=>10),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_company, company_name, id_user, user_name, user_code, user_email, user_image, id_service, service_code, service_name, service_price, service_length, dow, start, end, id_chair, id_branch, status_hiden', 'safe', 'on'=>'search'),
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
			'id_company' => 'Id Company',
			'company_name' => 'Company Name',
			'id_user' => 'Id User',
			'user_name' => 'User Name',
			'user_code' => 'User Code',
			'user_email' => 'User Email',
			'user_image' => 'User Image',
			'id_service' => 'Id Service',
			'service_code' => 'Service Code',
			'service_name' => 'Service Name',
			'service_price' => 'Service Price',
			'service_length' => 'Service Length',
			'dow' => 'Dow',
			'start' => 'Start',
			'end' => 'End',
			'id_chair' => 'Id Chair',
			'id_branch' => 'Id Branch',
			'status_hiden' => 'Status Hiden',
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

		$criteria->compare('id_company',$this->id_company);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_code',$this->user_code,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_image',$this->user_image,true);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('service_code',$this->service_code,true);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('service_price',$this->service_price,true);
		$criteria->compare('service_length',$this->service_length,true);
		$criteria->compare('dow',$this->dow);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('id_chair',$this->id_chair);
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('status_hiden',$this->status_hiden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VUserHour the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getServiceList($id_company) {

		$serviceList = Yii::app()->db->createCommand(
			"SELECT DISTINCT `id_service` AS id, `service_name` AS name, `service_length` as length, `service_code` as code, `service_price` as price
			FROM `v_user_hour` 
			WHERE `id_company` = ". $id_company ." AND status_hiden = 1
			ORDER BY id_service"
		)->queryAll();

		return $serviceList;
	}

	public function getDentistWork($id_company, $id_service) {
		
		$dentistWork = Yii::app()->db->createCommand("
			SELECT DISTINCT `id_user` AS id, `user_name` AS name 
			FROM `v_user_hour` 
			WHERE `id_service` = $id_service AND id_company = $id_company"
		)->queryAll();

		return $dentistWork;
	}

	public function getResourcesDentist($id_user = 0, $id_branch = 1) {
		$cs = new VUserHour;

		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));

		$v = new CDbCriteria();
		$v->addCondition("id_branch = $id_branch");
		
		if($id_user) 
		{
			$v->addCondition("id_user = $id_user");
		}
		$v->group 	=	'id_user, start, dow';
	    $v->order 	=	'id_user, start, dow';
	    //$v->limit = 20;
	    //$v->offset = $start_point;
	    $q->mergeWith($v);
	     
	    return $cs->findAll($v);
	}

	public function searchDentistCalendar($curpage, $lpp, $id_branch, $id_dentist, $search)
	{
		$start_point = $lpp * ($curpage-1);
		$cs = new VServicesHours;

		$v = new CDbCriteria();
		$v->addCondition("id_branch = $id_branch");
		
		if($id_dentist){
			$v->addCondition("id_dentist = $id_dentist");	
		}
		else if($search)
		{
			$v->addSearchCondition('dentist_name', $search, true);
		}

		$v->group 	=	'id_dentist';
		$numRow = count($cs->findAll());
		$numPage = ceil($numRow/$lpp);

	    $v->limit = $lpp;
	    $v->offset = $start_point;
	     
	    return array('numRow'=>$numRow, 'numPage'=>$numPage, 'data'=>$cs->findAll($v));
	}

}
