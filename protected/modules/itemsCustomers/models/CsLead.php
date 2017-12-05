<?php

/**
 * This is the model class for table "cs_lead".
 *
 * The followings are the available columns in table 'cs_lead':
 * @property integer $id
 * @property string $phone
 * @property string $note
 * @property string $createdate
 */
class CsLead extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_lead';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone', 'required'),
			array('phone', 'length', 'max'=>20),
			array('phone', 'unique','message'=>'Phone number had exist'),
			array('note', 'length', 'max'=>255),
			array('createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, phone, note, createdate', 'safe', 'on'=>'search'),
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
			'phone' => 'Phone',
			'note' => 'Note',
			'createdate' => 'Createdate',
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
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsLead the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function registerLeadCustomer($dataLeadCustomer = array('phone'=>'', 'password'=>'','repeatpassword'=>'', 'fullname' =>'', 'address'=>'', 'email'=>'', 'id_country'=>'','gender'=>'', 'birthdate'=>'','source'=>'0','status'=>'0')) {

	$model 				   = $this->getPhoneLeadCustomer($dataLeadCustomer['phone']);
	$model->attributes 	   = $dataLeadCustomer;
	$model->phone 		   = $dataLeadCustomer['phone'] =  $this->getVnPhone($model->phone);
	
	$model->repeatpassword = md5($dataLeadCustomer['repeatpassword']);
	$model->password  	   = md5($model->password);

	if($model->validate()){
		
		$model->save(false);
	}

	return $model;

    }

    public function getIdLead($phone){
     	$lead =  CsLead::model()->findByAttributes(array('phone'=>$phone));

     	if($lead){
     		return $lead->id;
     	}

     	$model = new CsLead();
 		$model->phone = $phone;




 		if($model->validate()){
			$model->save(false);
			return $model->id;
			return $model->id;
		}
		return false;
    }


    public function getVnPhone($phone){
		
		 $phone =preg_replace("/[^0-9]/", "", $phone);//remove none numberic

		 if(strlen($phone)==0)
			 return "";
		if(strlen($phone)>16)
			$phone = substr($phone,0,16);
		if(substr( $phone, 0, 1 ) === "0"){
			$phone ="84". substr($phone,1,strlen($phone));
		} else if(substr( $phone, 0, 3 ) == "840"){
			$phone ="84".substr( $phone, 3, strlen($phone) );
		}
		else if(substr( $phone, 0, 2 ) != "84"){
			$phone ="84".$phone;
		}
		return $phone;
	}

	

	public function searchLeadCustomers($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from cs_lead_customer where 1 = 1 ";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = $con->createCommand($sql)->queryScalar();
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		$sql = "select id,fullname,image,phone from cs_lead_customer where 1 = 1  ";
		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}
	
}
