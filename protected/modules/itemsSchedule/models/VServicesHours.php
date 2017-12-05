<?php

/**
 * This is the model class for table "v_services_hours".
 *
 * The followings are the available columns in table 'v_services_hours':
 * @property integer $id_dentist
 * @property string $dentist_name
 * @property integer $id_service
 * @property string $service_name
 * @property integer $dow
 * @property string $start
 * @property string $end
 * @property integer $id_chair
 * @property integer $chair_type
 * @property integer $id_branch
 */
class VServicesHours extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_services_hours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dentist_name, service_name', 'required'),
			array('id_dentist, id_service, dow, id_chair, chair_type, id_branch', 'numerical', 'integerOnly'=>true),
			array('dentist_name', 'length', 'max'=>128),
			array('service_name', 'length', 'max'=>255),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_dentist, dentist_name, id_service, service_name, dow, start, end, id_chair, chair_type, id_branch', 'safe', 'on'=>'search'),
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
			'id_dentist' => 'Id Dentist',
			'dentist_name' => 'Dentist Name',
			'id_service' => 'Id Service',
			'service_name' => 'Service Name',
			'dow' => 'Dow',
			'start' => 'Start',
			'end' => 'End',
			'id_chair' => 'Id Chair',
			'chair_type' => 'Chair Type',
			'id_branch' => 'Id Branch',
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

		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('dentist_name',$this->dentist_name,true);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('dow',$this->dow);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('id_chair',$this->id_chair);
		$criteria->compare('chair_type',$this->chair_type);
		$criteria->compare('id_branch',$this->id_branch);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VServicesHours the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getDentistWork($id_branch = 1, $id_service = 1) {
		
		$dentistWork = Yii::app()->db->createCommand("
			SELECT DISTINCT `id_dentist` AS id, `dentist_name` AS name, dentist_image AS image, dentist_exp AS exp, dentist_diploma AS diploma, dentist_certificate AS cer, dentist_subdomain AS sub
			FROM `v_services_hours` 
			WHERE `id_service` = $id_service AND `id_branch` = $id_branch"
		)->queryAll();

		$dentist = array();
		foreach ($dentistWork as $key => $v) {
			
			$baseUrl = "https://demo.bookoke.com";
			$urlimg  = '';
			if($v['image'])
				$urlimg = $baseUrl. '/upload/users/sm/'. $v['image'];

			$dentist[] = array(
				'id'       => $v['id'],
				'name'     => $v['name'],
				'subdomain'=> $v['sub'],
				'image'    => $v['image'],
				'urlImage' => $urlimg,
				'exp'      => $v['exp'],
				'diploma'  => $v['diploma'],
				'cer'      => $v['cer'],
			);
		}

		return $dentist;
	}

	public function getDentistWorkOnl($id_branch = 1, $id_service = 1, $searchDentist = '') {
		
		$dentistWork = Yii::app()->db->createCommand("
			SELECT DISTINCT `id_dentist` AS id, `dentist_name` AS name, dentist_image AS image, dentist_exp AS exp, dentist_diploma AS diploma, dentist_certificate AS cer
			FROM `v_services_hours` 
			WHERE `id_service` = $id_service AND `id_branch` = $id_branch AND `dentist_book_onl` = 1"
		)->queryAll();

		return $dentistWork;
	}

	public function getDentistOnl($curpage = 1, $lpp = 10, $id_branch = 1, $id_service = 1, $searchDentist = '') {
		
		$start_point = $lpp*($curpage-1);
		$vs          = new VServicesHours;

		$v = new CDbCriteria();
		$v->addCondition("dentist_book_onl = 1");
		$v->addCondition("id_branch = $id_branch");
		$v->addCondition("id_service = $id_service");

		if($searchDentist) 
		{
			$v->addSearchCondition('dentist_name', $searchService, true);
		}

		$v->group =	'id_dentist';
		$numRow   = count($vs->findAll($v));
		$numPage  = ceil($numRow/$lpp);

		$v->limit  = $lpp;
		$v->offset = $start_point;
	     
	    return array('numRow' => $numRow, 'numPage' => $numPage, 'data' => $vs->findAll($v));
	}

	public function getServiceList() {

		$serviceList = Yii::app()->db->createCommand(
			"SELECT DISTINCT `id_service` AS id, `service_name` AS name, `service_length` as length, `service_code` as code, `service_price` as price, service_description AS description
			FROM `v_services_hours` 
			WHERE status_hiden = 1 AND status_hiden = 1
			ORDER BY id_service"
		)->queryAll();

		return $serviceList;
	}

	public function getServiceOnl($curpage, $lpp, $id_service_type, $searchService) {

		$start_point = $lpp*($curpage-1);
		$vs          = new VServicesHours;

		$v = new CDbCriteria();
		$v->select = "id_service, service_name, service_length, service_code, service_price, service_description";
		$v->addCondition("status_hiden = 1");

		if($id_service_type==0) 
		{
			$v->addSearchCondition('service_code', $searchService, true);
			$v->addSearchCondition('service_name', $searchService, true, 'OR');
		}
		else
		{
			$v->addCondition('id_service_type = ' . $id_service_type);
			$v->addSearchCondition('service_code', $searchService, true);
			$v->addSearchCondition('service_name', $searchService, true, 'OR');
		}

		$v->group =	'id_service';
		$v->order = 'id_service';
		$numRow   = count($vs->findAll($v));
		$numPage  = ceil($numRow/$lpp);

		$v->limit  = $lpp;
		$v->offset = $start_point;
	     
	    return array('numRow' => $numRow, 'numPage' => $numPage, 'data' => $vs->findAll($v));
	}

	public function getResourcesDentist($id_dentist = 0, $id_branch = 1) {
		//$start_point = 10*($curpage-1);
		$cs = new VServicesHours;

		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));

		$v = new CDbCriteria();
		$v->addCondition("dentist_branch = $id_branch");
		
		if($id_dentist) 
		{
			$v->addCondition("id_dentist = $id_dentist");
		}
		$v->group 	=	'id_dentist, start, dow';
	    $v->order 	=	'id_dentist, start, dow';
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
		if($id_branch)
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
