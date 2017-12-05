<?php

/**
 * This is the model class for table "v_material".
 *
 * The followings are the available columns in table 'v_material':
 * @property integer $id_material_type
 * @property string $pt_name
 * @property string $pt_image
 * @property string $pt_description
 * @property integer $id_material_line
 * @property string $pl_name
 * @property string $pl_description
 * @property integer $id_material
 * @property string $name
 * @property string $description
 * @property string $instruction
 * @property double $price
 * @property double $stock
 * @property double $discount
 * @property string $createdate
 * @property string $postdate
 * @property string $unit
 * @property integer $status_material
 * @property integer $status_hiden
 */
class VMaterial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pt_name, name, price', 'required'),
			array('id_material_type, id_material_line, id_material, status_material, status_hiden', 'numerical', 'integerOnly'=>true),
			array('price, stock, discount', 'numerical'),
			array('pt_name, pt_image, name, unit', 'length', 'max'=>765),
			array('pl_name', 'length', 'max'=>384),
			array('pt_description, pl_description, description, instruction, createdate, postdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_material_type, pt_name, pt_image, pt_description, id_material_line, pl_name, pl_description, id_material, name, description, instruction, price, stock, discount, createdate, postdate, unit, status_material, status_hiden', 'safe', 'on'=>'search'),
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
			'id_material_type' => 'Id Material Type',
			'pt_name' => 'Pt Name',
			'pt_image' => 'Pt Image',
			'pt_description' => 'Pt Description',
			'id_material_line' => 'Id Material Line',
			'pl_name' => 'Pl Name',
			'pl_description' => 'Pl Description',
			'id_material' => 'Id Material',
			'name' => 'Name',
			'description' => 'Description',
			'instruction' => 'Instruction',
			'price' => 'Price',
			'stock' => 'Stock',
			'discount' => 'Discount',
			'createdate' => 'Createdate',
			'postdate' => 'Postdate',
			'unit' => 'Unit',
			'status_material' => 'Status Material',
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

		$criteria->compare('id_material_type',$this->id_material_type);
		$criteria->compare('pt_name',$this->pt_name,true);
		$criteria->compare('pt_image',$this->pt_image,true);
		$criteria->compare('pt_description',$this->pt_description,true);
		$criteria->compare('id_material_line',$this->id_material_line);
		$criteria->compare('pl_name',$this->pl_name,true);
		$criteria->compare('pl_description',$this->pl_description,true);
		$criteria->compare('id_material',$this->id_material);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('instruction',$this->instruction,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('status_material',$this->status_material);
		$criteria->compare('status_hiden',$this->status_hiden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VMaterial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getListMaterialLine(){
		
		return MaterialLine::model()->findAllByAttributes(array("status_proline"=>1));
	}

	public function getListBranchs(){
		return Branch::model()->getListBranchs();
	}
}
