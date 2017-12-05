<?php

/**
 * This is the model class for table "v_relation_family".
 *
 * The followings are the available columns in table 'v_relation_family':
 * @property integer $id
 * @property integer $customer_1
 * @property integer $id_relationship
 * @property integer $customer_2
 * @property string $name_2
 */
class VRelationFamily extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_relation_family';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, customer_1, id_relationship, customer_2', 'numerical', 'integerOnly'=>true),
			array('name_2', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_1, id_relationship, customer_2, name_2', 'safe', 'on'=>'search'),
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
			'customer_1' => 'Customer 1',
			'id_relationship' => 'Id Relationship',
			'customer_2' => 'Customer 2',
			'name_2' => 'Name 2',
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
		$criteria->compare('customer_1',$this->customer_1);
		$criteria->compare('id_relationship',$this->id_relationship);
		$criteria->compare('customer_2',$this->customer_2);
		$criteria->compare('name_2',$this->name_2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VRelationFamily the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
