<?php

/**
 * This is the model class for table "pricebook_service".
 *
 * The followings are the available columns in table 'pricebook_service':
 * @property integer $id
 * @property integer $id_pricebook
 * @property integer $id_service
 * @property integer $id_service_type
 * @property string $code
 * @property string $name
 * @property double $price
 * @property string $due_price
 * @property string $image
 * @property string $description
 * @property string $content
 * @property string $length
 * @property string $createdate
 * @property integer $status_hiden
 * @property integer $status
 * @property string $color
 * @property integer $point_donate
 * @property integer $point_exchange
 * @property string $tax
 * @property integer $flag
 * @property integer $id_company
 */
class PricebookService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pricebook_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pricebook, id_service, id_service_type, code, name', 'required'),
			array('id_pricebook, id_service, id_service_type, status_hiden, status, point_donate, point_exchange, flag, id_company', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('code', 'length', 'max'=>25),
			array('name, image, color', 'length', 'max'=>255),
			array('due_price', 'length', 'max'=>100),
			array('description', 'length', 'max'=>500),
			array('length', 'length', 'max'=>10),
			array('tax', 'length', 'max'=>12),
			array('content, createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_pricebook, id_service, id_service_type, code, name, price, due_price, image, description, content, length, createdate, status_hiden, status, color, point_donate, point_exchange, tax, flag, id_company', 'safe', 'on'=>'search'),
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
			'id_pricebook' => 'Id Pricebook',
			'id_service' => 'Id Service',
			'id_service_type' => 'Id Service Type',
			'code' => 'Code',
			'name' => 'Name',
			'price' => 'Price',
			'due_price' => 'Due Price',
			'image' => 'Image',
			'description' => 'Description',
			'content' => 'Content',
			'length' => 'Length',
			'createdate' => 'Createdate',
			'status_hiden' => 'Status Hiden',
			'status' => 'Status',
			'color' => 'Color',
			'point_donate' => 'Point Donate',
			'point_exchange' => 'Point Exchange',
			'tax' => 'Tax',
			'flag' => 'Flag',
			'id_company' => 'Id Company',
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
		$criteria->compare('id_pricebook',$this->id_pricebook);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('id_service_type',$this->id_service_type);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('due_price',$this->due_price,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('status_hiden',$this->status_hiden);
		$criteria->compare('status',$this->status);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('point_donate',$this->point_donate);
		$criteria->compare('point_exchange',$this->point_exchange);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('id_company',$this->id_company);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PricebookService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function searchPriceBookServices($curpage,$numPerPage,$id_pricebook,$search)
	{
		if(!$id_pricebook)
			return -1;

		$start_point=$numPerPage*($curpage-1);
		$cs = new PricebookService;		
		
		$q = new CDbCriteria(array(
    	'condition'=>'published="true"'
		));

		$v = new CDbCriteria();	
		$v->addCondition('t.status = 1');

		$v->addCondition('t.id_pricebook = :id_pricebook');
		$v->params = array(':id_pricebook' => $id_pricebook);

		$v->addSearchCondition('code', $search, true);
		$v->addSearchCondition('name', $search, true, 'OR');

		$numRow  = count($cs->findAll($v));
		$numPage = ceil($numRow/$numPerPage);
		 
		$v->order  = 'id DESC';
		$v->limit  = $numPerPage;
		$v->offset = $start_point;
	    $q->mergeWith($v);	    
	     
	    return array('numRow'=>$numRow,'numPage'=>$numPage,'data'=>$cs->findAll($v));
	}
}
