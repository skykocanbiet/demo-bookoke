<?php

/**
 * This is the model class for table "cs_medical_history_plan".
 *
 * The followings are the available columns in table 'cs_medical_history_plan':
 * @property integer $id
 * @property string $name
 * @property integer $id_history_gourp
 * @property integer $id_dentist
 * @property integer $id_user
 * @property string $createdate
 * @property string $applydate
 * @property integer $status
 */
class CsMedicalHistoryPlan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_medical_history_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_dentist, id_user, createdate', 'required'),
			array('id_history_gourp, id_dentist, id_user, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('applydate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, id_history_gourp, id_dentist, id_user, createdate, applydate, status', 'safe', 'on'=>'search'),
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
			'id_history_gourp' => 'Id History Gourp',
			'id_dentist' => 'Id Dentist',
			'id_user' => 'Id User',
			'createdate' => 'Createdate',
			'applydate' => 'Applydate',
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
		$criteria->compare('id_history_gourp',$this->id_history_gourp);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('applydate',$this->applydate,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsMedicalHistoryPlan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
