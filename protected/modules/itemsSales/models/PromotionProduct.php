<?php

/**
 * This is the model class for table "promotion_product".
 *
 * The followings are the available columns in table 'promotion_product':
 * @property integer $id
 * @property integer $id_promotion
 * @property integer $id_product
 * @property integer $id_service
 * @property double $sale
 * @property string $createdate
 * @property string $startday
 * @property string $stopdate
 */
class PromotionProduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promotion_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_promotion, id_product, id_service', 'numerical', 'integerOnly'=>true),
			array('sale', 'numerical'),
			array('createdate, startday, stopdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_promotion, id_product, id_service, sale, createdate, startday, stopdate', 'safe', 'on'=>'search'),
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
			'id_promotion' => 'Id Promotion',
			'id_product' => 'Id Product',
			'id_service' => 'Id Service',
			'sale' => 'Sale',
			'createdate' => 'Createdate',
			'startday' => 'Startday',
			'stopdate' => 'Stopdate',
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
		$criteria->compare('id_promotion',$this->id_promotion);
		$criteria->compare('id_product',$this->id_product);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('startday',$this->startday,true);
		$criteria->compare('stopdate',$this->stopdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PromotionProduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getDeals(){
		$con = Yii::app()->db;
		$sql = "SELECT a.id, c.Name, a.name, a.images, b.startday, b.stopdate, b.sale, b.price 
					FROM  promotion a  INNER JOIN  promotion_product b 
					INNER JOIN company c 
					WHERE a.id = b.id_promotion 
					AND a.id_company = c.Id ";
				$data = $con->createCommand($sql)->queryAll();
    			return $data;
	}
	public function getget(){
		$con = Yii::app()->db;
		$sql = "SELECT b.Name,b.Id, a . * from promotion a inner join company b where a.id_company = b.ID and 1 = 1 ";
		$data = $con->createCommand($sql)->queryAll();
    	return $data;
	}
	public function getcompany(){
		$con = Yii::app()->db;
		$sql = "SELECT * from  company  where  1 = 1 ";
				$data = $con->createCommand($sql)->queryAll();
    			return $data;
	}
	public function getvaluepromotion($id){
		$con = Yii::app()->db;
		$sql = "SELECT * from  promotion_value  where  id_promotion =".$id;
				$data = $con->createCommand($sql)->queryAll();
    			return $data;
	}
	public function getpproduct($id){
		$con = Yii::app()->db;
		$sql = "SELECT * from  promotion_product  where  id_promotion =".$id;
				$data = $con->createCommand($sql)->queryAll();
    			return $data;
	}
	public function deleteservice($id){
		$con = Yii::app()->db;
		$sql = "select * from promotion_product where id_promotion =".$id;
		
		
			
			return true;

		
	}	
	public function deletepromotionproduct($id){
		$con = Yii::app()->db;
		$sql = "DELETE FROM 'promotion_product' WHERE 'id_promotion' =".$id;
		return true;
		
	}
	public function getbranch($id){
		$con = Yii::app()->db;
		$sql = "SELECT  * 
				FROM  `promotion_branch` 
				
				WHERE   `id_promotion`= ".$id;
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}	
}
