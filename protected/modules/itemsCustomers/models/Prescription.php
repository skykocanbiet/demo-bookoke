<?php

/**
 * This is the model class for table "prescription".
 *
 * The followings are the available columns in table 'prescription':
 * @property integer $id
 * @property integer $id_group_history
 * @property integer $id_medical_history
 * @property string $diagnose
 * @property string $advise
 * @property integer $examination_after
 * @property string $createdate
 */
class Prescription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prescription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_group_history, id_medical_history, diagnose', 'required'),
			array('id_group_history, id_medical_history, examination_after', 'numerical', 'integerOnly'=>true),
			array('diagnose', 'length', 'max'=>255),
			array('advise, createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_group_history, id_medical_history, diagnose, advise, examination_after, createdate', 'safe', 'on'=>'search'),
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
			'id_group_history' => 'Id Group History',
			'id_medical_history' => 'Id Medical History',
			'diagnose' => 'Diagnose',
			'advise' => 'Advise',
			'examination_after' => 'Examination After',
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
		$criteria->compare('id_group_history',$this->id_group_history);
		$criteria->compare('id_medical_history',$this->id_medical_history);
		$criteria->compare('diagnose',$this->diagnose,true);
		$criteria->compare('advise',$this->advise,true);
		$criteria->compare('examination_after',$this->examination_after);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
