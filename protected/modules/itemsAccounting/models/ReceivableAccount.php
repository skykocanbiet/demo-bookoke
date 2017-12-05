<?php

/**
 * This is the model class for table "receivable_account".
 *
 * The followings are the available columns in table 'receivable_account':
 * @property integer $id
 * @property string $number
 * @property integer $type
 * @property string $note
 * @property double $amount
 * @property integer $order_number
 * @property integer $id_payer
 * @property integer $id_user
 * @property string $received_date
 * @property string $confirmed_date
 * @property string $payment_status
 * @property integer $status
 */
class ReceivableAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'receivable_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, id_payer, id_user, payment_status, status', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('note, received_date, confirmed_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, type, note, amount, id_payer, id_user, received_date, confirmed_date, payment_status, status', 'safe', 'on'=>'search'),
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
            'order_number' => 'Order Number',
			'id_payer' => 'Id Cashier',
			'id_user' => 'Id User',
			'received_date'  => 'Received Date',
			'confirmed_date' => 'Confirmed Date',
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
		$criteria->compare('number',$this->number);
		$criteria->compare('type',$this->type);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('amount',$this->amount);
        $criteria->compare('order_number',$this->order_number);
		$criteria->compare('id_payer',$this->id_payer);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('received_date',$this->received_date,true);
		$criteria->compare('confirmed_date',$this->confirmed_date,true);
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
	 * @return ReceivableAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
