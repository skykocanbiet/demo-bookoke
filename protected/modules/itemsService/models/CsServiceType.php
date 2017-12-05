<?php

/**
 * This is the model class for table "cs_service_type".
 *
 * The followings are the available columns in table 'cs_service_type':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $createdate
 * @property integer $status_hiden
 * @property integer $status
 */
class CsServiceType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_service_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('status_hiden, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, createdate, status_hiden, status', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'createdate' => 'Createdate',
			'status_hiden' => 'Status Hiden',
			'status' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('status_hiden',$this->status_hiden);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchGroupServices($curpage,$numPerPage,$searchGroupSv)
	{
		$start_point = $numPerPage*($curpage-1);
		$cs          = new CsServiceType;		
		$q           = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));

		$v = new CDbCriteria();	
		$v->addCondition('t.status = 1');
		
		$v->addSearchCondition('name', $searchGroupSv, true);

		$num_item = count($cs->findAll($v));

		$v->order  = 'id DESC';
		$v->limit  = $numPerPage;
		$v->offset = $start_point;
	    $q->mergeWith($v);

	    $tolPage = ceil($num_item/$numPerPage);
	     
	    return array('numRow'=>$num_item,'numPage'=>$tolPage,'data'=>$cs->findAll($v));
	}
}
