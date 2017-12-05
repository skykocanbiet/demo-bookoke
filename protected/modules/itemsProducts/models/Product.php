<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $id_product_line
 * @property string $name
 * @property string $description
 * @property double $price
 * @property double $stock
 * @property double $discount
 * @property string $unit
 * @property string $createdate
 * @property string $postdate
 * @property integer $status_product
 * @property integer $status_hiden
 * @property string $instruction
 * @property string $code
 * @property double $cost_price
 * @property integer $point_donate
 * @property integer $point_exchange
 * @property string $tax
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_product_line, name, price, code, cost_price', 'required'),
			array('id_product_line, status_product, status_hiden, point_donate, point_exchange', 'numerical', 'integerOnly'=>true),
			array('price, stock, discount, cost_price', 'numerical'),
			array('name, unit', 'length', 'max'=>765),
			array('code', 'length', 'max'=>25),
			array('tax', 'length', 'max'=>12),
			array('description, createdate, postdate, instruction', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_product_line, name, description, price, stock, discount, unit, createdate, postdate, status_product, status_hiden, instruction, code, cost_price, point_donate, point_exchange, tax', 'safe', 'on'=>'search'),
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
			'rel_line' => array(self::BELONGS_TO,'ProductLine','id_product_line'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_product_line' => 'Id Product Line',
			'name' => 'Name',
			'description' => 'Description',
			'price' => 'Price',
			'stock' => 'Stock',
			'discount' => 'Discount',
			'unit' => 'Unit',
			'createdate' => 'Createdate',
			'postdate' => 'Postdate',
			'status_product' => 'Status Product',
			'status_hiden' => 'Status Hiden',
			'instruction' => 'Instruction',
			'code' => 'Code',
			'cost_price' => 'Cost Price',
			'point_donate' => 'Point Donate',
			'point_exchange' => 'Point Exchange',
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
		$criteria->compare('id_product_line',$this->id_product_line);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('status_product',$this->status_product);
		$criteria->compare('status_hiden',$this->status_hiden);
		$criteria->compare('instruction',$this->instruction,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('cost_price',$this->cost_price);
		$criteria->compare('point_donate',$this->point_donate);
		$criteria->compare('point_exchange',$this->point_exchange);
		$criteria->compare('tax',$this->tax,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function product_list_pagination($curpage,$id_product_line,$searchProduct)
	{
		$start_point=30*($curpage-1);
		$p = new Product;			
		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));
		$v = new CDbCriteria();	
		$v->addCondition('t.status_product = 1');
		if($id_product_line==0) 
		{
			$v->addSearchCondition('code', $searchProduct, true);
			$v->addSearchCondition('name', $searchProduct, true, 'OR');
		}
		else
		{
			$v->addCondition('t.id_product_line = :id_product_line');
			$v->params = array(':id_product_line' => $id_product_line);
			$v->addSearchCondition('code', $searchProduct, true);
			$v->addSearchCondition('name', $searchProduct, true, 'OR');
		} 
	    $v->order= 'id DESC';
	    $v->limit = 30;
	    $v->offset = $start_point;
	    $q->mergeWith($v);	    
	     
	    return $p->findAll($v);
	}
}
