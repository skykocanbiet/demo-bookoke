<?php

/** 
 * This is the model class for table "customer_member". 
 * 
 * The followings are the available columns in table 'customer_member': 
 * @property integer $id
 * @property string $code_member
 * @property string $id_customer
 * @property integer $id_member
 * @property integer $point
 * @property string $create_date
 * @property integer $status
 */ 
class CustomerMember extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('id_member, point, status', 'numerical', 'integerOnly'=>true),
            array('code_member', 'length', 'max'=>45),
            array('id_customer', 'length', 'max'=>20),
            array('create_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code_member, id_customer, id_member, point, create_date, status', 'safe', 'on'=>'search'), 
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
            'code_member' => 'Code Member',
            'id_customer' => 'Id Customer',
            'id_member' => 'Id Member',
            'point' => 'Point',
            'create_date' => 'Create Date',
            'status' => 'Status',
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
		$criteria->compare('code_member',$this->code_member,true);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('id_member',$this->id_member);
		$criteria->compare('point',$this->point);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function updateMember($id_customer,$sumamount='', $point = '')
	{
		if(!$id_customer){
			return -1;
		}

		if(!$sumamount && !$point) {
			return -1;
		}

		if($sumamount) {
			$point = ceil((int)$sumamount / Yii::app()->params['member_unit_point']);
		}

		if($point > 0) {
			$cusMem = CustomerMember::model()->findByAttributes(array('id_customer'=>$id_customer));


			if($cusMem) {
				$point_1     	= (int)$cusMem->point;

				$pointSum   	= $point_1 + (int)$point;
				
				$cusMem->point 	= (int)$pointSum;
				//id_member
				$criteria = new CDbCriteria;
				$criteria->condition = "point_max >= '$pointSum' AND point_min <= '$pointSum'";
				$id_member = Member::model()->find($criteria);
				if($id_member){
					$cusMem->id_member = $id_member->id;
				}
				//end
				if($cusMem->validate()) {
					
					if($cusMem->save()) {
						return $point;
					}
					return 0;
				}
				else 
					return $cusMem->getErrors();
			}
		}
		else {
			return 0;
		}
	}
	public function updateCusMember($id_customer,$code_member,$status)
	{
		if(!$id_customer){
			return -1; 
 		}
 		$status  = $status==0?1:0;
 		$command = Yii::app()->db->createCommand();
 		$result = $command->update('customer_member', array('code_member'=>$code_member,'status'=>$status), 'id_customer=:id_customer', array(':id_customer'=>$id_customer));
 		return $result;
	}
	public function codeCustomerMember($length) 
	{
	    $keys = array_merge(range(0,9));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $key;
	}

	
}
