<?php

/**
 * This is the model class for table "cs_customer_insurrance".
 *
 * The followings are the available columns in table 'cs_customer_insurrance':
 * @property integer $id
 * @property integer $id_customer
 * @property string $code_insurrance
 * @property integer $type_insurrance
 * @property string $creatdate
 * @property string $startdate
 * @property string $enddate
 * @property integer $status
 */
class CsCustomerInsurrance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_customer_insurrance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer, code_insurrance, type_insurrance, startdate, enddate', 'required'),
			array('id_customer, type_insurrance, status', 'numerical', 'integerOnly'=>true),
			array('code_insurrance', 'length', 'max'=>20),
			array('creatdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, code_insurrance, type_insurrance, creatdate, startdate, enddate, status', 'safe', 'on'=>'search'),
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
			'id_customer' => 'Id Customer',
			'code_insurrance' => 'Code Insurrance',
			'type_insurrance' => 'Type Insurrance',
			'creatdate' => 'Creatdate',
			'startdate' => 'Startdate',
			'enddate' => 'Enddate',
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
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('code_insurrance',$this->code_insurrance,true);
		$criteria->compare('type_insurrance',$this->type_insurrance);
		$criteria->compare('creatdate',$this->creatdate,true);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('enddate',$this->enddate,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsCustomerInsurrance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function insertInsurrance($id_customer,$code_insurrance,$type_insurrance,$startdate,$enddate){
    	$cscustomerinsurrance=new CsCustomerInsurrance;
		$cscustomerinsurrance->id_customer=$id_customer;
		$cscustomerinsurrance->code_insurrance=$code_insurrance;	
		$cscustomerinsurrance->type_insurrance=$type_insurrance;
		$cscustomerinsurrance->startdate=$startdate;
		$cscustomerinsurrance->enddate=$enddate;
		$cscustomerinsurrance->save();
    }
    public function updateInsurrance($id_customer,$code_insurrance,$type_insurrance,$startdate,$enddate){
    	$command = Yii::app()->db->createCommand();
		$command->update('cs_customer_insurrance', array(
		    'code_insurrance'=>$code_insurrance,
		    'type_insurrance'=>$type_insurrance,
		    'startdate'=>$startdate,
		    'enddate'=>$enddate
		), 'id_customer=:id_customer', array(':id_customer'=>$id_customer));
    }
    public function updateStatusInsurrance($id_customer,$status_insurrance){
    	$status_insurrance  = $status_insurrance==0?1:0;
    	$command = Yii::app()->db->createCommand();
		$command->update('cs_customer_insurrance', array(
		    'status'=>$status_insurrance
		), 'id_customer=:id_customer', array(':id_customer'=>$id_customer));
    }
}
