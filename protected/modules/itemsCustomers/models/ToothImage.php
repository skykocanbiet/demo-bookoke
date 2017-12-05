<?php

/**
 * This is the model class for table "tooth_image".
 *
 * The followings are the available columns in table 'tooth_image':
 * @property integer $id
 * @property integer $id_customer
 * @property integer $id_group_history
 * @property integer $tooth_number
 * @property string $id_image
 * @property string $src_image
 * @property string $type_image
 * @property string $style_image
 */
class ToothImage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tooth_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer, id_group_history, tooth_number, id_image, src_image, type_image, style_image', 'required'),
			array('id_customer, id_group_history, tooth_number', 'numerical', 'integerOnly'=>true),
			array('id_image, src_image, style_image', 'length', 'max'=>255),
			array('type_image', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, id_group_history, tooth_number, id_image, src_image, type_image, style_image', 'safe', 'on'=>'search'),
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
			'id_group_history' => 'Id Group History',
			'tooth_number' => 'Tooth Number',
			'id_image' => 'Id Image',
			'src_image' => 'Src Image',
			'type_image' => 'Type Image',
			'style_image' => 'Style Image',
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
		$criteria->compare('id_group_history',$this->id_group_history);
		$criteria->compare('tooth_number',$this->tooth_number);
		$criteria->compare('id_image',$this->id_image,true);
		$criteria->compare('src_image',$this->src_image,true);
		$criteria->compare('type_image',$this->type_image,true);
		$criteria->compare('style_image',$this->style_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToothImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
