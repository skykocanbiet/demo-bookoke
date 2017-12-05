<?php

/**
 * This is the model class for table "mini_website".
 *
 * The followings are the available columns in table 'mini_website':
 * @property integer $id
 * @property integer $id_customer
 * @property string $sub_domain
 * @property string $description
 * @property string $name
 * @property integer $status
 * @property integer $locked
 */
class MiniWebsite extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mini_website';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer, sub_domain, description, name, status, locked', 'required'),
			array('id_customer, status, locked', 'numerical', 'integerOnly'=>true),
			array('sub_domain, description, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, sub_domain, description, name, status, locked', 'safe', 'on'=>'search'),
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
			'sub_domain' => 'Sub Domain',
			'description' => 'Description',
			'name' => 'Name',
			'status' => 'Status',
			'locked' => 'Locked',
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
		$criteria->compare('sub_domain',$this->sub_domain,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('locked',$this->locked);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MiniWebsite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getSubDomainOfCustomerWebsite($idCustomer){
		$rs = MiniWebsite::model()->findAllByAttributes(array('id_customer' => $idCustomer));
		if ($rs != NULL) {
			return $rs[0];
		}else{
			return NULL;
		}
	}

	public function getWebsiteInfoWithDomainName($domainName = '') {
		$rs = MiniWebsite::model()->findAllByAttributes(array('sub_domain' => $domainName));
		if ($rs != NULL) {
			return $rs[0];
		}else{
			return NULL;
		}
	}

	public function getWebsiteIDOfCustomer($idCustomer = 0) {
		$rs = MiniWebsite::model()->findAllByAttributes(array('id_customer' => $idCustomer));
		if ($rs != NULL) {
			return $rs[0];
		}else{
			return NULL;
		}
	}
	public function updatedata($name, $sub, $id_company) 
	{
			$con = Yii::app()->db;
			$sql="UPDATE mini_website SET name = '$name', sub_domain = '$sub', id_company='$id_company', folder = '$sub', status = 1, locked = 0 , id_user = 1";
			$data=$con->createCommand($sql)->execute();
			return ($data);	
				
	}

}
