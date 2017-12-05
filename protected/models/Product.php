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
			array('id_product_line, name, price', 'required'),
			array('id_product_line, status_product, status_hiden', 'numerical', 'integerOnly'=>true),
			array('price, stock, discount', 'numerical'),
			array('name, unit', 'length', 'max'=>765),
			array('description, instruction, createdate, postdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_product_line, name, description, instruction, price, stock, discount, unit, createdate, postdate, status_product, status_hiden', 'safe', 'on'=>'search'),
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
			'instruction' => 'Instruction',
			'price' => 'Price',
			'stock' => 'Stock',
			'discount' => 'Discount',
			'unit' => 'Unit',
			'createdate' => 'Createdate',
			'postdate' => 'Postdate',
			'status_product' => 'Status Product',
			'status_hiden' => 'Status Hiden',
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
		$criteria->compare('instruction',$this->instruction,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('status_product',$this->status_product);
		$criteria->compare('status_hiden',$this->status_hiden);

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

	public function searchProduct($curpage,$id_product_line,$searchProduct)
	{
		$start_point=10*($curpage-1);
		$cs = new Product;		
		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));
		$v = new CDbCriteria();	
		
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
	    $v->limit = 20;
	    $v->offset = $start_point;
	    $q->mergeWith($v);	    
	     
	    return $cs->findAll($v);
	}
	/*Lê Minh Vương*/
	public static function getproduct($id){
		$con = Yii::app()->db;
    	$sql = "select * from product where `id_company` ='".$id."' ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
	}
	public static function getservice($id){
		$con = Yii::app()->db;
    	$sql = "select * from cs_service where `id_company` ='".$id."' ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
	}
	public static function getpriceservice($id){
		$con = Yii::app()->db;
    	$sql = "select price from cs_service where `id` ='".$id."' ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
	}
	public static function getpriceproduct($id){
		$con = Yii::app()->db;
    	$sql = "select price from product where `id` ='".$id."' ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
	}
	/*End Lê Minh Vương*/
}
