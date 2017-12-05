<?php

/** 
 * This is the model class for table "treatment_old". 
 * 
 * The followings are the available columns in table 'treatment_old': 
 * @property integer $id
 * @property string $create_date
 * @property string $complete_date
 * @property string $code_customer
 * @property string $name_customer
 * @property string $name_dentist
 * @property string $sevices
 * @property double $amount
 * @property double $pay
 * @property double $owe
 */ 
class TreatmentOld extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'treatment_old'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('amount, pay, owe', 'numerical'),
            array('code_customer', 'length', 'max'=>20),
            array('name_customer, name_dentist, sevices', 'length', 'max'=>255),
            array('create_date, complete_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, create_date, complete_date, code_customer, name_customer, name_dentist, sevices, amount, pay, owe', 'safe', 'on'=>'search'),
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
            'create_date' => 'Create Date',
            'complete_date' => 'Complete Date',
            'code_customer' => 'Code Customer',
            'name_customer' => 'Name Customer',
            'name_dentist' => 'Name Dentist',
            'sevices' => 'Sevices',
            'amount' => 'Amount',
            'pay' => 'Pay',
            'owe' => 'Owe',
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
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('complete_date',$this->complete_date,true);
        $criteria->compare('code_customer',$this->code_customer,true);
        $criteria->compare('name_customer',$this->name_customer,true);
        $criteria->compare('name_dentist',$this->name_dentist,true);
        $criteria->compare('sevices',$this->sevices,true);
        $criteria->compare('amount',$this->amount);
        $criteria->compare('pay',$this->pay);
        $criteria->compare('owe',$this->owe);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return TreatmentOld the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    }

    public function searchTreatmentOld($curpage, $lpp, $code_number, $tm_dentist, $tm_service, $tm_date)
    {
        if(!$code_number)
             return array('numRow'=>0, 'numPage'=> 0,'data'=>'');
        $start_point = $lpp*($curpage-1);
        
        $q = new TreatmentOld;
        $v  = new CDbCriteria();

        if($code_number)
            $v->addCondition('code_customer = ' . $code_number);
        if($tm_dentist)
            $v->addSearchCondition('name_dentist', $tm_dentist, TRUE);
        if($tm_service)
            $v->addSearchCondition('sevices', $tm_service, TRUE);
        if($tm_date)
            $v->addCondition("DATE(create_date) = '$tm_date'");

        $numRow=count($q->findAll($v));
        $numPage = ceil($numRow/$lpp);
      
        $v->order  = 'create_date';
        $v->limit  = $lpp;
        $v->offset = $start_point;

        $data = $q->findAll($v);        

        return array('numRow'=>$numRow, 'numPage'=> $numPage,'data'=>$data);
    }
}