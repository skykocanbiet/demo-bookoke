<?php

/**
 * This is the model class for table "cs_target".
 *
 * The followings are the available columns in table 'cs_target':
 * @property integer $id
 * @property integer $user_id
 * @property integer $year
 * @property integer $month
 * @property integer $revenue_target
 * @property integer $new_account_target
 * @property integer $appointment_target
 * @property integer $worktime_target
 * @property string $description
 * @property integer $status_default
 */
class CsTarget extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_target';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, year, month, revenue_target, new_account_target, appointment_target, worktime_target, status_default', 'numerical', 'integerOnly'=>true),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, year, month, revenue_target, new_account_target, appointment_target, worktime_target, description, status_default', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'year' => 'Year',
			'month' => 'Month',
			'revenue_target' => 'Revenue Target',
			'new_account_target' => 'New Account Target',
			'appointment_target' => 'Appointment Target',
			'worktime_target' => 'Worktime Target',
			'description' => 'Description',
			'status_default' => 'Status Default',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('year',$this->year);
		$criteria->compare('month',$this->month);
		$criteria->compare('revenue_target',$this->revenue_target);
		$criteria->compare('new_account_target',$this->new_account_target);
		$criteria->compare('appointment_target',$this->appointment_target);
		$criteria->compare('worktime_target',$this->worktime_target);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status_default',$this->status_default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsTarget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getUserGoal($id_user)
	{			
		if(!$id_user){
			return 0; 
 		} 	
		
		return $data = CsTarget::model()->findAllByAttributes(array('user_id'=>$id_user),array('order'=>'id ASC'));
	}
	public function getWorktime_target($branch_id,$id_user,$form_date,$to_date)
	{			
		if(!$id_user){
			return 0; 
 		} 	
		
		return CsSchedule::model()->getSumWork($branch_id,$id_user,$form_date,$to_date);
	}
	public function addGoal($year,$month,$user_id,$revenue_target, $new_account_target,$appointment_target,$worktime_target,$check_td) 
	{
		if(!$user_id){
			return -1; 
 		}
		if(!$revenue_target || $revenue_target < 0){
			return -2; 
 		}
 		if(!$new_account_target){
			return 0; 
 		}
 		if(!$appointment_target){
			return 0; 
 		}
 		if(!$worktime_target){
			return 0; 
 		}
 		$goal  = new CsTarget;
 		$goal->year = $year;
 		$goal->month = $month;
 		$goal->user_id = $user_id;
 		$goal->revenue_target = $revenue_target;
 		$goal->new_account_target = $new_account_target;
 		$goal->appointment_target = $appointment_target;
 		$goal->worktime_target = $worktime_target;
	 	if($goal->validate()) {
						
			if($goal->save()) {
				if($check_td == 1){
					$goal_td  = new CsTarget;
			 		$goal_td->year = $year;
			 		$goal_td->month = $month +1;
			 		$goal_td->user_id = $user_id;
			 		$goal_td->revenue_target = $revenue_target;
			 		$goal_td->new_account_target = $new_account_target;
			 		$goal_td->appointment_target = $appointment_target;
			 		$goal_td->worktime_target = $worktime_target;
			 		if($goal_td->validate() && $goal_td->save()){
			 			return 2;
			 		}
				}else
				return 1;
			}
			return 0;
		}
		else 
		return $goal->getErrors();
	}

	public function updateGoal($id,$month,$revenue_target, $new_account_target,$appointment_target,$worktime_target) 
	{
		if(!$id){
			return -1; 
 		}
 		if(!$revenue_target || $revenue_target < 0){
			return -2; 
 		}
 		$model = new CsTarget;
 		 return $result = $model->updateByPk($id, array('month'=>$month,'revenue_target'=>$revenue_target,'new_account_target'=>$new_account_target,'appointment_target'=>$appointment_target,'worktime_target'=>$worktime_target));	
	}
}
