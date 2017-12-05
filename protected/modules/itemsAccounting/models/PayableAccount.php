<?php

/** 
 * This is the model class for table "payable_account". 
 * 
 * The followings are the available columns in table 'payable_account': 
 * @property integer $id
 * @property string $number
 * @property integer $type
 * @property string $note
 * @property double $amount
 * @property double $currExchange
 * @property string $currency
 * @property integer $order_number
 * @property integer $id_receiver
 * @property integer $id_user
 * @property string $requester_date
 * @property string $approval_date
 * @property integer $payment_status
 * @property integer $status
 */ 

class PayableAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payable_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( 
            array('type, order_number, id_receiver, id_user, payment_status, status', 'numerical', 'integerOnly'=>true),
            array('amount, currExchange', 'numerical'),
            array('number, currency', 'length', 'max'=>20),
            array('note, requester_date, approval_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, number, type, note, amount, currExchange, currency, order_number, id_receiver, id_user, requester_date, approval_date, payment_status, status', 'safe', 'on'=>'search'),
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
            'number' => 'Number',
            'type' => 'Type',
            'note' => 'Note',
            'amount' => 'Amount',
            'currExchange' => 'Curr Exchange',
            'currency' => 'Currency',
            'order_number' => 'Order Number',
            'id_receiver' => 'Id Receiver',
            'id_user' => 'Id User',
            'requester_date' => 'Requester Date',
            'approval_date' => 'Approval Date',
            'payment_status' => 'Payment Status',
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
        $criteria->compare('number',$this->number,true);
        $criteria->compare('type',$this->type);
        $criteria->compare('note',$this->note,true);
        $criteria->compare('amount',$this->amount);
        $criteria->compare('currExchange',$this->currExchange);
        $criteria->compare('currency',$this->currency,true);
        $criteria->compare('order_number',$this->order_number);
        $criteria->compare('id_receiver',$this->id_receiver);
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('requester_date',$this->requester_date,true);
        $criteria->compare('approval_date',$this->approval_date,true);
        $criteria->compare('payment_status',$this->payment_status);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayableAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
