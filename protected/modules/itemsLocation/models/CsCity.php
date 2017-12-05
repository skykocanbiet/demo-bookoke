<?php

/**
 * This is the model class for table "cs_city".
 *
 * The followings are the available columns in table 'cs_city':
 * @property double $id
 * @property string $id_country
 * @property string $name_short
 * @property string $name_long
 */
class CsCity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_country', 'length', 'max'=>6),
			array('name_short', 'length', 'max'=>12),
			array('name_long', 'length', 'max'=>384),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_country, name_short, name_long', 'safe', 'on'=>'search'),
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
			'name_short' => 'Name Short',
			'name_long' => 'Name Long',
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
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name_long',$this->name_long,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsCity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchCity($curpage, $search, $id_country, $limit = '')
	{
		if(!$id_country)
			return -1;
		if(!$limit)
			$limit = 30;

		$start_point	=	$limit*($curpage-1);
      
		$p = new CsCity;           
		$q = new CDbCriteria(array(
        	'condition'=>'published="true"'
        ));

        $v = new CDbCriteria(); 
      	
      	$v->addCondition("id_country = '$id_country'");
       	$v->addSearchCondition('name_short',$search);
       	$v->addSearchCondition('name_long',$search,true);

		$count     =	count($p->findAll($v));
		
		$v->order  = 	'id DESC';
		$v->limit  = 	$limit;
		$v->offset = 	$start_point;

        $q->mergeWith($v);

        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
	}
}
