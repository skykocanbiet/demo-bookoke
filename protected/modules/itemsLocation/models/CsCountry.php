<?php

/**
 * This is the model class for table "cs_country".
 *
 * The followings are the available columns in table 'cs_country':
 * @property string $code
 * @property string $code_long
 * @property string $country
 */
class CsCountry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code', 'required'),
			array('flag', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>6),
			array('code_long', 'length', 'max'=>9),
			array('country', 'length', 'max'=>384),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, code_long, country', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'code_long' => 'Code Long',
			'country' => 'Country',
			'flag' => 'Flag',
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('code_long',$this->code_long,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsCountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchCountry($curpage, $search, $limit = '')
	{
		if(!$limit)
			$limit = 30;

		$start_point	=	$limit*($curpage-1);
      
		$p = new CsCountry;           
		$q = new CDbCriteria(array(
        	'condition'=>'published="true"'
        ));

        $v = new CDbCriteria(); 
      
       	$v->addSearchCondition('code',$search);
       	$v->addSearchCondition('code_long',$search,true);
       	$v->addSearchCondition('country',$search,true);

		$count     =	count($p->findAll($v));
		
		$v->order  = 	'code DESC';
		$v->limit  = 	$limit;
		$v->offset = 	$start_point;

        $q->mergeWith($v);

        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
	}
}
