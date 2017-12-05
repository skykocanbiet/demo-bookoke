<?php

/**
 * This is the model class for table "cs_service_users".
 *
 * The followings are the available columns in table 'cs_service_users':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_service
 * @property string $note
 * @property integer $st
 */
class CsServiceUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_service_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_service, st', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_service, note, st', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'id_service' => 'Id Service',
			'note' => 'Note',
			'st' => 'St',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('st',$this->st);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsServiceUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function dentistServices($curpage,$id_user,$searchService)
	{
		$start_point=10*($curpage-1);
		$cs = new CsService;		
		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));
		$v = new CDbCriteria();	
		$v->addCondition('t.status = 1');
		if($id_service_type==0) 
		{
			$v->addSearchCondition('code', $searchService, true);
			$v->addSearchCondition('name', $searchService, true, 'OR');
		}
		else
		{
			$v->addCondition('t.id_service_type = :id_service_type');
			$v->params = array(':id_service_type' => $id_service_type);
			$v->addSearchCondition('code', $searchService, true);
			$v->addSearchCondition('name', $searchService, true, 'OR');
		} 
	    $v->order= 'id DESC';
	    $v->limit = 20;
	    $v->offset = $start_point;
	    $q->mergeWith($v);	    
	     
	    return $cs->findAll($v);
	}
}
