<?php

/**
 * This is the model class for table "v_work_hours".
 *
 * The followings are the available columns in table 'v_work_hours':
 * @property integer $id
 * @property integer $id_dentist
 * @property integer $dow
 * @property string $start
 * @property string $end
 * @property integer $id_service
 * @property integer $id_chair
 * @property integer $id_branch
 * @property string $note
 */
class VWorkHours extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_work_hours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_dentist, dow, id_service, id_chair, id_branch', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>45),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_dentist, dow, start, end, id_service, id_chair, id_branch, note', 'safe', 'on'=>'search'),
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
			'dow' => 'Dow',
			'start' => 'Start',
			'end' => 'End',
			'id_service' => 'Id Service',
			'id_chair' => 'Id Chair',
			'id_branch' => 'Id Branch',
			'note' => 'Note',
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
		$criteria->compare('dow',$this->dow);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('id_chair',$this->id_chair);
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VWorkHours the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
