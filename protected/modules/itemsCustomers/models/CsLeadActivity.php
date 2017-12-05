<?php

/**
 * This is the model class for table "lead_activity".
 *
 * The followings are the available columns in table 'lead_activity':
 * @property integer $id
 * @property string $date
 * @property string $note
 * @property integer $id_user
 * @property integer $id_lead
 * @property integer $id_customer
 * @property integer $status
 * @property string $activity_date
 * @property integer $potential
 * @property integer $conversation
 */
class CsLeadActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_lead_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_lead, id_customer, status, potential, conversation', 'numerical', 'integerOnly'=>true),
			array('date, note, activity_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date, note, id_user, id_lead, id_customer, status, activity_date, potential, conversation', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'note' => 'Note',
			'id_user' => 'Id User',
			'id_lead' => 'Id Lead',
			'id_customer' => 'Id Customer',
			'status' => 'Status',
			'activity_date' => 'Activity Date',
			'potential' => 'Potential',
			'conversation' => 'Conversation',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_lead',$this->id_lead);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('status',$this->status);
		$criteria->compare('activity_date',$this->activity_date,true);
		$criteria->compare('potential',$this->potential);
		$criteria->compare('conversation',$this->conversation);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LeadActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getname($id){
		$data = GpUsers::model()->findBypk($id);
		return $data;
	}
}
