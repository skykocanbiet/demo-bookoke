<?php

/**
 * This is the model class for table "activity_log".
 *
 * The followings are the available columns in table 'activity_log':
 * @property integer $id
 * @property string $table
 * @property string $view
 * @property string $action
 * @property string $date_log
 * @property integer $id_user
 * @property string $old_values
 * @property string $new_values
 */
class ActivityLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activity_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('table, view, action, date_log, id_user, old_values, new_values', 'required'),
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('table, view, action', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, table, view, action, date_log, id_user, old_values, new_values', 'safe', 'on'=>'search'),
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
			'table' => 'Table',
			'view' => 'View',
			'action' => 'Action',
			'date_log' => 'Date Log',
			'id_user' => 'Id User',
			'old_values' => 'Old Values',
			'new_values' => 'New Values',
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
		$criteria->compare('table',$this->table,true);
		$criteria->compare('view',$this->view,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('date_log',$this->date_log,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('old_values',$this->old_values,true);
		$criteria->compare('new_values',$this->new_values,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivityLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function write_log($table, $view, $action, $id_user, $old_values, $new_values){
        $sql = 'insert into activity_log (`table`, view, action, date_log, id_user, old_values, new_values)
                values ("'.$table.'","'.$view.'","'.$action.'", NOW(),'.$id_user.',"'.$old_values.'","'.$new_values.'")';
        Yii::app()->db->createCommand($sql)->execute();
    }
}
