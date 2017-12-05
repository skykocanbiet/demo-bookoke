<?php

/**
 * This is the model class for table "cs_schedule_time_off".
 *
 * The followings are the available columns in table 'cs_schedule_time_off':
 * @property integer $id
 * @property integer $id_dentist
 * @property integer $id_user
 * @property string $start
 * @property string $end
 * @property string $note
 * @property integer $status
 */
class CsScheduleTimeOff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_schedule_time_off';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_dentist, id_user', 'required'),
			array('id_dentist, id_user, status', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>200),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_dentist, id_user, start, end, note, status', 'safe', 'on'=>'search'),
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
			'id_dentist' => 'Id Dentist',
			'id_user' => 'Id User',
			'start' => 'Start',
			'end' => 'End',
			'note' => 'Note',
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
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsScheduleTimeOff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
