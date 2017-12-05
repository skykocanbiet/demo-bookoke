<?php

/**
 * This is the model class for table "call_history_customer".
 *
 * The followings are the available columns in table 'call_history_customer':
 * @property integer $id
 * @property integer $id_user
 * @property string $id_call
 * @property string $date_call
 * @property integer $duration_call
 * @property integer $extention
 * @property integer $phone
 * @property string $file_record
 * @property string $status
 * @property string $clove_call
 * @property integer $status_error
 */
class CallHistoryCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'call_history_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user', 'required'),
			array('id_user, duration_call, extention, phone, status_error', 'numerical', 'integerOnly'=>true),
			array('id_call, date_call, file_record, status, clove_call', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_call, date_call, duration_call, extention, phone, file_record, status, clove_call, status_error', 'safe', 'on'=>'search'),
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
			'id_call' => 'Id Call',
			'date_call' => 'Date Call',
			'duration_call' => 'Duration Call',
			'extention' => 'Extention',
			'phone' => 'Phone',
			'file_record' => 'File Record',
			'status' => 'Status',
			'clove_call' => 'Clove Call',
			'status_error' => 'Status Error',
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
		$criteria->compare('id_call',$this->id_call,true);
		$criteria->compare('date_call',$this->date_call,true);
		$criteria->compare('duration_call',$this->duration_call);
		$criteria->compare('extention',$this->extention);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('file_record',$this->file_record,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('clove_call',$this->clove_call,true);
		$criteria->compare('status_error',$this->status_error);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CallHistoryCustomer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function insert_new_callhistory($id_user,$id,$date_call,$duration_call,$extention,$phone,$file_record,$status,$clove_call)
	{
		$command = Yii::app()->db->createCommand();
		$data = $command->insert('call_history_customer', array(
			'id_user' => $id_user,
			'id_call' => $id,
			'date_call' => $date_call,
			'duration_call' => $duration_call,
			'extention' => $extention,
			'phone' => $phone,
			'file_record' => $file_record,
			'status' => $status,
			'clove_call' => $clove_call,
		));
		if ($data) {
			return $data;
		}
	}
	public function insertCallError($id_user,$extention,$phone,$date_call)
	{
		$command = Yii::app()->db->createCommand();
		$data = $command->insert('call_history_customer', array(
			'id_user' => $id_user,
			'date_call' => $date_call,
			'extention' => $extention,
			'phone' => $phone,
			'status_error' => 1,
		));
		if ($data) {
			return $data;
		}
	}
}
