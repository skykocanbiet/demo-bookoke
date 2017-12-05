<?php

/**
 * This is the model class for table "v_branch_services".
 *
 * The followings are the available columns in table 'v_branch_services':
 * @property integer $id
 * @property integer $id_dentist
 * @property string $dentist_name
 * @property integer $id_service
 * @property string $service_name
 * @property integer $dow
 * @property string $start
 * @property string $end
 * @property integer $id_chair
 * @property integer $id_branch
 * @property string $note
 */
class VBranchServices extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_branch_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dentist_name, service_name', 'required'),
			array('id, id_dentist, id_service, dow, id_chair, id_branch', 'numerical', 'integerOnly'=>true),
			array('dentist_name', 'length', 'max'=>128),
			array('service_name', 'length', 'max'=>255),
			array('note', 'length', 'max'=>45),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_dentist, dentist_name, id_service, service_name, dow, start, end, id_chair, id_branch, note', 'safe', 'on'=>'search'),
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
			'id_dentist' => 'Id Dentist',
			'dentist_name' => 'Dentist Name',
			'id_service' => 'Id Service',
			'service_name' => 'Service Name',
			'dow' => 'Dow',
			'start' => 'Start',
			'end' => 'End',
			'id_chair' => 'Id Chair',
			'id_branch' => 'Id Branch',
			'note' => 'Note',
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
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('dentist_name',$this->dentist_name,true);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('dow',$this->dow);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('id_chair',$this->id_chair);
		$criteria->compare('id_branch',$this->id_branch);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VBranchServices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getDentistWork($id_branch = 1,$id_service = 1,$chair_type = 2) {
		if($id_service == 1){		// khám tư vấn - xem tất cả bác sỹ có thời gian làm việc
			$con = "id_service = $id_service";
		}
		else {				// bác sỹ hiển thị theo dịch vụ
			$con = "id_service = $id_service";
		}
		$dentistWork = Yii::app()->db->createCommand("SELECT DISTINCT `id_dentist` AS id, `dentist_name` AS name FROM `v_branch_services` WHERE `id_branch` = $id_branch AND $con")->queryAll();

		return $dentistWork;
	}

	public function getServiceList($id_branch=1) {
		$serviceList = Yii::app()->db->createCommand("SELECT DISTINCT `id_service` AS id, `service_name` AS name FROM `v_branch_services` WHERE `id_branch` = $id_branch AND status_hiden = 1 ORDER BY id_service")->queryAll();
		return $serviceList;
	}
}
