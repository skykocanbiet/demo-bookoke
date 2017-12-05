<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property integer $id_package_line
 * @property string $name
 * @property string $description
 * @property double $price
 * @property double $stock
 * @property double $discount
 * @property string $unit
 * @property string $createdate
 * @property string $postdate
 * @property integer $status_package
 * @property integer $status_hiden
 * @property string $instruction
 * @property string $code
 * @property double $cost_price
 * @property string $lenght
 * @property integer $duration_unit
 * @property integer $lenght_exchange
 * @property string $redemption_start_date
 * @property string $redemption_end_date
 * @property string $tax
 */
class Package extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_package_line, name, price, code, cost_price', 'required'),
			array('id_package_line, status_package, status_hiden, duration_unit, lenght_exchange', 'numerical', 'integerOnly'=>true),
			array('price, stock, discount, cost_price', 'numerical'),
			array('name, unit', 'length', 'max'=>765),
			array('code', 'length', 'max'=>25),
			array('lenght', 'length', 'max'=>10),
			array('tax', 'length', 'max'=>12),
			array('description, createdate, postdate, instruction, redemption_start_date, redemption_end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_package_line, name, description, price, stock, discount, unit, createdate, postdate, status_package, status_hiden, instruction, code, cost_price, lenght, duration_unit, lenght_exchange, redemption_start_date, redemption_end_date, tax', 'safe', 'on'=>'search'),
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
			'id_package_line' => 'Id Package Line',
			'name' => 'Name',
			'description' => 'Description',
			'price' => 'Price',
			'stock' => 'Stock',
			'discount' => 'Discount',
			'unit' => 'Unit',
			'createdate' => 'Createdate',
			'postdate' => 'Postdate',
			'status_package' => 'Status Package',
			'status_hiden' => 'Status Hiden',
			'instruction' => 'Instruction',
			'code' => 'Code',
			'cost_price' => 'Cost Price',
			'lenght' => 'Lenght',
			'duration_unit' => 'Duration Unit',
			'lenght_exchange' => 'Lenght Exchange',
			'redemption_start_date' => 'Redemption Start Date',
			'redemption_end_date' => 'Redemption End Date',
			'tax' => 'Tax',
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
		$criteria->compare('id_package_line',$this->id_package_line);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('status_package',$this->status_package);
		$criteria->compare('status_hiden',$this->status_hiden);
		$criteria->compare('instruction',$this->instruction,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('cost_price',$this->cost_price);
		$criteria->compare('lenght',$this->lenght,true);
		$criteria->compare('duration_unit',$this->duration_unit);
		$criteria->compare('lenght_exchange',$this->lenght_exchange);
		$criteria->compare('redemption_start_date',$this->redemption_start_date,true);
		$criteria->compare('redemption_end_date',$this->redemption_end_date,true);
		$criteria->compare('tax',$this->tax,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Package the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function package_list_pagination($curpage,$id_package_line,$searchPackage)
	{
		$start_point=20*($curpage-1);
		$p = new Package;			
		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));
		$v = new CDbCriteria();	
		$v->addCondition('t.status_package = 1');
		if($id_package_line==0) 
		{
			$v->addSearchCondition('code', $searchPackage, true);
			$v->addSearchCondition('name', $searchPackage, true, 'OR');
		}
		else
		{
			$v->addCondition('t.id_package_line = :id_package_line');
			$v->params = array(':id_package_line' => $id_package_line);
			$v->addSearchCondition('code', $searchPackage, true);
			$v->addSearchCondition('name', $searchPackage, true, 'OR');
		} 
	    $v->order= 'id DESC';
	    $v->limit = 20;
	    $v->offset = $start_point;
	    $q->mergeWith($v);	    
	     
	    return $p->findAll($v);
	}
}
