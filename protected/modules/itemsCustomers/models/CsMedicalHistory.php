<?php

/**
 * This is the model class for table "cs_medical_history".
 *
 * The followings are the available columns in table 'cs_medical_history':
 * @property integer $id
 * @property string $name
 * @property integer $id_history_group
 * @property integer $id_service
 * @property integer $id_user
 * @property integer $id_order_detail
 * @property string $amount
 * @property integer $length_time
 * @property string $description
 * @property string $createdate
 * @property string $reviewdate
 * @property integer $result
 * @property integer $status
 * @property integer $id_dentist
 * @property string $medicine_during_treatment
 * @property string $medicine_after_treatment
 * @property integer $tooth_number
 */
class CsMedicalHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_medical_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_history_group, id_dentist', 'required'),
			array('id_history_group, id_service, id_user, id_order_detail, length_time, result, status, id_dentist, tooth_number', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('amount', 'length', 'max'=>12),
			array('description, createdate, reviewdate, medicine_during_treatment, medicine_after_treatment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, id_history_group, id_service, id_user, id_order_detail, amount, length_time, description, createdate, reviewdate, result, status, id_dentist, medicine_during_treatment, medicine_after_treatment, tooth_number', 'safe', 'on'=>'search'),
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
			'id_history_group' => 'Id History Group',
			'id_service' => 'Id Service',
			'id_user' => 'Id User',
			'id_order_detail' => 'Id Order Detail',
			'amount' => 'Amount',
			'length_time' => 'Length Time',
			'description' => 'Description',
			'createdate' => 'Createdate',
			'reviewdate' => 'Reviewdate',
			'result' => 'Result',
			'status' => 'Status',
			'id_dentist' => 'Id Dentist',
			'medicine_during_treatment' => 'Medicine During Treatment',
			'medicine_after_treatment' => 'Medicine After Treatment',
			'tooth_number' => 'Tooth Number',
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
		$criteria->compare('id_history_group',$this->id_history_group);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_order_detail',$this->id_order_detail);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('length_time',$this->length_time);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('reviewdate',$this->reviewdate,true);
		$criteria->compare('result',$this->result);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('medicine_during_treatment',$this->medicine_during_treatment,true);
		$criteria->compare('medicine_after_treatment',$this->medicine_after_treatment,true);
		$criteria->compare('tooth_number',$this->tooth_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsMedicalHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
