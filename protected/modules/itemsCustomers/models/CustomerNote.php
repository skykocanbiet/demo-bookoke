<?php

/**
 * This is the model class for table "customer_note".
 *
 * The followings are the available columns in table 'customer_note':
 * @property integer $id
 * @property string $note
 * @property integer $id_user
 * @property integer $id_customer
 * @property integer $flag
 */
class CustomerNote extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_customer, flag', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, note, id_user, id_customer, flag', 'safe', 'on'=>'search'),
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
			'note' => 'Note',
			'id_user' => 'Id User',
			'id_customer' => 'Id Customer',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerNote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function addnote($note=array('note'=>'','id_user'=>'','id_customer'=>'','flag'=>'','important'=>'','status'=>''))
	{

		$model = new CustomerNote;
		$model->attributes 	   		= $note;
		$model->id_user 			= Yii::app()->user->getState('user_id');
		$model->status 			= $note['status'];
		if($model->validate() && $model->insert() )
		{
			return array('id_customer'=>$model->id_customer, 'id'=>$model->id);
		}

		return array('id_customer'=>'-1');; 
	}
	public function updatenote($id,$note)
	{
		if($note !=""){
			CustomerNote::model()->updateByPk($id, array('note'=>$note, 'status'=>1));
			return $id; 
		}
		else
		{
			CustomerNote::model()->updateByPk($id, array('status'=>-1));
			return $id; 
		}
		
	}
	public function searchnote($status, $flag, $id_customer, $date)
	{
		$con = Yii::app()->db;
		$sql = "SELECT * FROM customer_note  WHERE id_customer = '".$id_customer."' ";
		if($status != "" ){
			$sql.= " and status = '".$status."'";
		}
		if($flag != ""){
			$sql.= " and flag = '".$flag."'";
		}
		if($date != ""){
			$date1 = date('Y-m-d', strtotime($date));
			$sql.= " and DATE(`create_date` ) = '".$date1."'";
		}
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
}
