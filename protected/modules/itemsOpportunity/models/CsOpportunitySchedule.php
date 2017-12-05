<?php

/**
 * This is the model class for table "cs_opportunity_schedule".
 *
 * The followings are the available columns in table 'cs_opportunity_schedule':
 * @property integer $id
 * @property integer $id_opportunity
 * @property string $datetime_schedule
  * @property string $time_shedule
 * @property string $name_schedule
 * @property integer $type_schedule
 * @property string $duration
 * @property string $note
 * @property integer $st
 */
class CsOpportunitySchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_opportunity_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_opportunity, type_schedule, st', 'numerical', 'integerOnly'=>true),
			array('name_schedule', 'length', 'max'=>255),
			array('datetime_schedule, time_schedule, duration, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_opportunity, datetime_schedule, time_schedule, name_schedule, type_schedule, duration, note, st', 'safe', 'on'=>'search'),
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
			'id_opportunity' => 'Id Opportunity',
			'datetime_schedule' => 'Datetime Schedule',
			'time_schedule' => 'Time Schedule',
			'name_schedule' => 'Name Schedule',
			'type_schedule' => 'Type Schedule',
			'duration' => 'Duration',
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
		$criteria->compare('id_opportunity',$this->id_opportunity);
		$criteria->compare('datetime_schedule',$this->datetime_schedule,true);
		$criteria->compare('time_schedule',$this->time_schedule,true);
		$criteria->compare('name_schedule',$this->name_schedule,true);
		$criteria->compare('type_schedule',$this->type_schedule);
		$criteria->compare('duration',$this->duration,true);
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
	 * @return CsOpportunitySchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
