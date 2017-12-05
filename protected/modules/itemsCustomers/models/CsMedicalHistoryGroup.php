<?php

/**
 * This is the model class for table "cs_medical_history_group".
 *
 * The followings are the available columns in table 'cs_medical_history_group':
 * @property integer $id
 * @property integer $id_customer
 * @property string $name
 * @property string $createdata
 * @property integer $status
 * @property integer $status_healthy
 * @property integer $status_process
 */
class CsMedicalHistoryGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_medical_history_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer', 'required'),
			array('id_customer, status, status_healthy, status_process', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, name, createdata, status, status_healthy, status_process', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'createdata' => 'Createdata',
			'status' => 'Status',
			'status_healthy' => 'Status Healthy',
			'status_process' => 'Status Process',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('createdata',$this->createdata,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_healthy',$this->status_healthy);
		$criteria->compare('status_process',$this->status_process);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsMedicalHistoryGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getMedicalHistoryGroup($id_customer){
		
		return $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_medical_history_group')
                ->where('id_customer=:id_customer', array(':id_customer' => $id_customer))
                ->order('cs_medical_history_group.createdata DESC')
                ->queryAll();
	}

}
