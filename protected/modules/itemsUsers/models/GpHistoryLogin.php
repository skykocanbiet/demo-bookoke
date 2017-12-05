<?php

/**
 * This is the model class for table "gp_history_login".
 *
 * The followings are the available columns in table 'gp_history_login':
 * @property double $id
 * @property string $username
 * @property string $password
 * @property string $ip
 * @property string $login_time
 * @property string $logout_time
 * @property string $error_code
 * @property string $error_msg
 */
class GpHistoryLogin extends CActiveRecord
{	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gp_history_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, ip', 'length', 'max'=>135),
			array('error_code', 'length', 'max'=>60),
			array('error_msg', 'length', 'max'=>300),
			array('login_time, logout_time', 'safe'),			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, ip, login_time, logout_time, error_code, error_msg', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',			
			'ip' => 'Ip',
			'login_time' => 'Login Time',
			'logout_time' => 'Logout Time',
			'error_code' => 'Error Code',
			'error_msg' => 'Error Msg',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('login_time',$this->login_time,true);
		$criteria->compare('logout_time',$this->logout_time,true);
		$criteria->compare('error_code',$this->error_code,true);
		$criteria->compare('error_msg',$this->error_msg,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GpHistoryLogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
