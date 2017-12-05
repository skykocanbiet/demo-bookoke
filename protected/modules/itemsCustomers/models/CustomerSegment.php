<?php

/**
 * This is the model class for table "customer_segment".
 *
 * The followings are the available columns in table 'customer_segment':
 * @property integer $id
 * @property integer $id_customer
 * @property integer $id_segment
 * @property integer $code_number
 * @property string $fullname
 * @property integer $gender
 * @property string $birthdate
 * @property string $phone
 * @property string $email
 */
class CustomerSegment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_segment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer, id_segment, code_number', 'required'),
			array('id_customer, id_segment, code_number, gender', 'numerical', 'integerOnly'=>true),
			array('fullname, email', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20),
			array('birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, id_segment, code_number, fullname, gender, birthdate, phone, email', 'safe', 'on'=>'search'),
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
			'id_segment' => 'Id Segment',
			'code_number' => 'Code Number',
			'fullname' => 'Fullname',
			'gender' => 'Gender',
			'birthdate' => 'Birthdate',
			'phone' => 'Phone',
			'email' => 'Email',
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
		$criteria->compare('id_segment',$this->id_segment);
		$criteria->compare('code_number',$this->code_number);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerSegment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
