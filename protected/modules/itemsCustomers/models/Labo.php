<?php

/**
 * This is the model class for table "labo".
 *
 * The followings are the available columns in table 'labo':
 * @property integer $id
 * @property integer $id_group_history
 * @property integer $id_medical_history
 * @property integer $id_branch
 * @property integer $id_labo_elite
 * @property string $sent_date
 * @property string $received_date
 * @property string $assign
 * @property string $note
 * @property string $createdate
 */
class Labo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_group_history, id_medical_history, id_branch, id_labo_elite, sent_date, received_date, assign', 'required'),
			array('id_group_history, id_medical_history, id_branch, id_labo_elite', 'numerical', 'integerOnly'=>true),
			array('note, createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_group_history, id_medical_history, id_branch, id_labo_elite, sent_date, received_date, assign, note, createdate', 'safe', 'on'=>'search'),
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
			'id_branch' => 'Id Branch',
			'id_labo_elite' => 'Id Labo Elite',
			'sent_date' => 'Sent Date',
			'received_date' => 'Received Date',
			'assign' => 'Assign',
			'note' => 'Note',
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
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('id_labo_elite',$this->id_labo_elite);
		$criteria->compare('sent_date',$this->sent_date,true);
		$criteria->compare('received_date',$this->received_date,true);
		$criteria->compare('assign',$this->assign,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Labo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
