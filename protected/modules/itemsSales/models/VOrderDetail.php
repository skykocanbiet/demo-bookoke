<?php

/** 
 * This is the model class for table "v_order_detail". 
 * 
 * The followings are the available columns in table 'v_order_detail': 
 * @property integer $id
 * @property integer $id_order
 * @property integer $id_customer
 * @property integer $id_branch
 * @property integer $id_group_history
 * @property string $code
 * @property integer $id_quotation
 * @property integer $id_service
 * @property integer $id_product
 * @property integer $id_voucher
 * @property integer $id_discount
 * @property string $description
 * @property integer $id_user
 * @property string $user_name
 * @property string $create_date
 * @property string $confirm_date
 * @property double $unit_price
 * @property double $amount
 * @property integer $teeth
 * @property integer $qty
 * @property double $tax
 * @property integer $status
 */ 
class VOrderDetail extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'v_order_detail'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('id, id_order, id_customer, id_branch, id_group_history, id_quotation, id_service, id_product, id_voucher, id_discount, id_user, teeth, qty, status', 'numerical', 'integerOnly'=>true),
            array('unit_price, amount, tax', 'numerical'),
            array('code', 'length', 'max'=>45),
            array('description', 'length', 'max'=>255),
            array('user_name', 'length', 'max'=>128),
            array('create_date, confirm_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, id_order, id_customer, id_branch, id_group_history, code, id_quotation, id_service, id_product, id_voucher, id_discount, description, id_user, user_name, create_date, confirm_date, unit_price, amount, teeth, qty, tax, status', 'safe', 'on'=>'search'),
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
            'id_order' => 'Id Order',
            'id_customer' => 'Id Customer',
            'id_branch' => 'Id Branch',
            'id_group_history' => 'Id Group History',
            'code' => 'Code',
            'id_quotation' => 'Id Quotation',
            'id_service' => 'Id Service',
            'id_product' => 'Id Product',
            'id_voucher' => 'Id Voucher',
            'id_discount' => 'Id Discount',
            'description' => 'Description',
            'id_user' => 'Id User',
            'user_name' => 'User Name',
            'create_date' => 'Create Date',
            'confirm_date' => 'Confirm Date',
            'unit_price' => 'Unit Price',
            'amount' => 'Amount',
            'teeth' => 'Teeth',
            'qty' => 'Qty',
            'tax' => 'Tax',
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
        $criteria->compare('id_order',$this->id_order);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('id_group_history',$this->id_group_history);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('id_quotation',$this->id_quotation);
        $criteria->compare('id_service',$this->id_service);
        $criteria->compare('id_product',$this->id_product);
        $criteria->compare('id_voucher',$this->id_voucher);
        $criteria->compare('id_discount',$this->id_discount);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('user_name',$this->user_name,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('confirm_date',$this->confirm_date,true);
        $criteria->compare('unit_price',$this->unit_price);
        $criteria->compare('amount',$this->amount);
        $criteria->compare('teeth',$this->teeth);
        $criteria->compare('qty',$this->qty);
        $criteria->compare('tax',$this->tax);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return VOrderDetail the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    } 
    
	public function searchOrderDetail($conditional='')
	{
		$orderDetail = VOrderDetail::model()->findAll(array(
			'select' => '*',
			'condition' => $conditional,
		));

		return $orderDetail;
	}
    public function searchListOrderDetail($first_id,$last_id){

        $data  = Yii::app()->db->createCommand()
        ->select('*')
        ->from('v_order_detail')
        ->where('v_order_detail.id_order>=:first_id', array(':first_id' => $first_id))
        ->andWhere('v_order_detail.id_order<=:last_id', array(':last_id' => $last_id))
        ->queryAll();

        return $data;     
    }
}
