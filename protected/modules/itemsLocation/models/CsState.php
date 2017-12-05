<?php

/**
 * This is the model class for table "cs_state".
 *
 * The followings are the available columns in table 'cs_state':
 * @property integer $id
 * @property string $id_country
 * @property string $name_long
 * @property string $name_short
 * @property integer $prefix_num
 */
class CsState extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prefix_num', 'numerical', 'integerOnly'=>true),
			array('id_country', 'length', 'max'=>6),
			array('name_long', 'length', 'max'=>300),
			array('name_short', 'length', 'max'=>33),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_country, name_long, name_short, prefix_num', 'safe', 'on'=>'search'),
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
			'id_country' => 'Id Country',
			'name_long' => 'Name Long',
			'name_short' => 'Name Short',
			'prefix_num' => 'Prefix Num',
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
		$criteria->compare('id_country',$this->id_country,true);
		$criteria->compare('name_long',$this->name_long,true);
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('prefix_num',$this->prefix_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
