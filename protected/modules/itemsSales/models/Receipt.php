<?php

/** 
 * This is the model class for table "receipt". 
 * 
 * The followings are the available columns in table 'receipt': 
 * @property integer $id
 * @property integer $id_invoice
 * @property string $id_customer
 * @property double $pay_amount
 * @property double $pay_sum
 * @property double $pay_insurance
 * @property double $pay_promotion
 * @property string $pay_date
 * @property integer $pay_type
 * @property integer $card_type
 * @property double $card_percent
 * @property double $card_val
 * @property string $curr_unit
 * @property double $curr_amount
 * @property double $curr_change
 * @property double $curr_sum
 * @property string $curr_inv
 * @property integer $point
 */ 
class Receipt extends CActiveRecord
{
	public $payType = array(
		'0' =>		'',
		'1' =>		'Tiền mặt',
		'2' =>		'Thẻ tín dụng',
		'3' =>		'Chuyển khoản'
	);
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'receipt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
       return array( 
            array('id_invoice, pay_type, card_type, point', 'numerical', 'integerOnly'=>true),
            array('pay_amount, pay_sum, pay_insurance, pay_promotion, card_percent, card_val, curr_amount, curr_change, curr_sum', 'numerical'),
            array('id_customer', 'length', 'max'=>20),
            array('curr_unit, curr_inv', 'length', 'max'=>5),
            array('pay_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, id_invoice, id_customer, pay_amount, pay_sum, pay_insurance, pay_promotion, pay_date, pay_type, card_type, card_percent, card_val, curr_unit, curr_amount, curr_change, curr_sum, curr_inv, point', 'safe', 'on'=>'search'),
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
            'id_invoice' => 'Id Invoice',
            'id_customer' => 'Id Customer',
            'pay_amount' => 'Pay Amount',
            'pay_sum' => 'Pay Sum',
            'pay_insurance' => 'Pay Insurance',
            'pay_promotion' => 'Pay Promotion',
            'pay_date' => 'Pay Date',
            'pay_type' => 'Pay Type',
            'card_type' => 'Card Type',
            'card_percent' => 'Card Percent',
            'card_val' => 'Card Val',
            'curr_unit' => 'Curr Unit',
            'curr_amount' => 'Curr Amount',
            'curr_change' => 'Curr Change',
            'curr_sum' => 'Curr Sum',
            'curr_inv' => 'Curr Inv',
            'point' => 'Point',
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
        $criteria->compare('id_invoice',$this->id_invoice);
        $criteria->compare('id_customer',$this->id_customer,true);
        $criteria->compare('pay_amount',$this->pay_amount);
        $criteria->compare('pay_sum',$this->pay_sum);
        $criteria->compare('pay_insurance',$this->pay_insurance);
        $criteria->compare('pay_promotion',$this->pay_promotion);
        $criteria->compare('pay_date',$this->pay_date,true);
        $criteria->compare('pay_type',$this->pay_type);
        $criteria->compare('card_type',$this->card_type);
        $criteria->compare('card_percent',$this->card_percent);
        $criteria->compare('card_val',$this->card_val);
        $criteria->compare('curr_unit',$this->curr_unit,true);
        $criteria->compare('curr_amount',$this->curr_amount);
        $criteria->compare('curr_change',$this->curr_change);
        $criteria->compare('curr_sum',$this->curr_sum);
        $criteria->compare('curr_inv',$this->curr_inv,true);
        $criteria->compare('point',$this->point);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Receipt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchReceipt($conditional)
    {
        $receipt = Receipt::model()->findAll(array(
            'select'    => '*',
            'condition' => $conditional,
        ));

        return $receipt;
    }    
}
