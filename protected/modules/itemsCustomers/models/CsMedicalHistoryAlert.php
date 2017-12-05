<?php

/**
 * This is the model class for table "cs_medical_history_alert".
 *
 * The followings are the available columns in table 'cs_medical_history_alert':
 * @property integer $id
 * @property integer $id_medicine_alert
 * @property string $note
 * @property integer $id_customer
 * @property integer $id_group_history
 * @property integer $id_dentist
 * @property string $createdate
 */
class CsMedicalHistoryAlert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_medical_history_alert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer', 'required'),
			array('id_medicine_alert, id_customer, id_group_history, id_dentist', 'numerical', 'integerOnly'=>true),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_medicine_alert, note, id_customer, id_group_history, id_dentist, createdate', 'safe', 'on'=>'search'),
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
			'id_medicine_alert' => 'Id Medicine Alert',
			'note' => 'Note',
			'id_customer' => 'Id Customer',
			'id_group_history' => 'Id Group History',
			'id_dentist' => 'Id Dentist',
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
		$criteria->compare('id_medicine_alert',$this->id_medicine_alert);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('id_group_history',$this->id_group_history);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsMedicalHistoryAlert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
