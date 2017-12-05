<?php

/**
 * This is the model class for table "v_receivable".
 *
 * The followings are the available columns in table 'v_receivable':
 * @property integer $id
 * @property integer $number
 * @property integer $type
 * @property string $note
 * @property double $amount
 * @property integer $order_number
 * @property string $received_date
 * @property string $confirmed_date
 * @property integer $status
 * @property integer $payment_status
 * @property integer $id_user
 * @property integer $id_payer
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $in_words
 * @property string $description
 * @property integer $status_payer
 * @property string $user_name
 */
class VReceivable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_receivable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, number, type, phone, amount', 'required'),
			array('id, type, order_number, status, payment_status, id_user, id_payer, status_payer', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name, address, in_words', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('user_name', 'length', 'max'=>128),
			array('note, received_date, confirmed_date, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, type, note, amount, order_number, received_date, confirmed_date, status, payment_status, id_user, id_payer, name, phone, address, in_words, description, status_payer, user_name', 'safe', 'on'=>'search'),
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
			'number' => 'Number',
			'type' => 'Type',
			'note' => 'Note',
			'amount' => 'Amount',
			'order_number' => 'Order Number',
			'received_date' => 'Received Date',
			'confirmed_date' => 'Confirmed Date',
			'status' => 'Status',
            'payment_status'=>'Payment Status',
			'id_user' => 'Id User',
			'id_payer' => 'Id Payer',
			'name' => 'Name',
			'phone' => 'Phone',
			'address' => 'Address',
			'in_words' => 'In Words',
			'description' => 'Description',
			'status_payer' => 'Status Payer',
			'user_name' => 'User Name',
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
		$criteria->compare('number',$this->number);
		$criteria->compare('type',$this->type);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('received_date',$this->received_date,true);
		$criteria->compare('confirmed_date',$this->confirmed_date,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_payer',$this->id_payer);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('in_words',$this->in_words,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status_payer',$this->status_payer);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VReceivable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getListUsers(){
        return User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
    }
    public function getYesterday()
    {
		$con=Yii::app()->db;
		$sql = "SELECT DATE_SUB(CURDATE(), INTERVAL 1 DAY) as yesterday";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$yesterday = $row['yesterday'];
		return $yesterday;
	}

	public function getToday()
    {
		$con=Yii::app()->db;
		$sql = "SELECT CURDATE() as today";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$today = $row['today'];
		return $today;
	}

    public function getthisweek()
    {
        $con=Yii::app()->db;
		$sql = "SELECT DATE_ADD(CURDATE(), INTERVAL(2-DAYOFWEEK(CURDATE())) DAY) as week";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$week = $row['week'];
		return $week;
    }
    public function getlastweek()
    {
        $con=Yii::app()->db;
		$sql = "SELECT DATE_SUB(DATE_ADD(CURDATE(), INTERVAL(2-DAYOFWEEK(CURDATE())) DAY), INTERVAL 7 DAY) as lastweek";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$week = $row['lastweek'];
		return $week;
    }
    public function getlastmonth()
    {
        $con=Yii::app()->db;
		$sql = "
        SELECT DATE_FORMAT(DATE_SUB(CURDATE(),INTERVAL DAYOFMONTH(CURDATE()) DAY),'%Y-%m-01') AS FisrtDayOfPreviousMonth,
	   (DATE_SUB(CURDATE(),INTERVAL DAYOFMONTH(CURDATE()) DAY)) AS LastDayOfPreviousMonth";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		return $row;
    }
    public function gettothisweek()
    {
        $con=Yii::app()->db;
        $sql = "SELECT DATE_ADD(CURDATE(), INTERVAL(2-DAYOFWEEK(CURDATE())) DAY) as fromdate";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$week = $row['fromdate'];
		$sql = "SELECT DATE_ADD('$week', INTERVAL 7 DAY) as todate";
		$command=$con->createCommand($sql);
	    $row=$command->queryRow();
		$week = $row['todate'];
		return $week;
    }
    public function AddnewOrderReceivableAccount($order_code){
        
        $Oders = VOrder::model()->findAllByAttributes(array('order_code'=>$order_code));
        
        if($Oders){
            
            $transaction = Yii::app()->db->beginTransaction();
            $result = "";
            try {
                foreach($Oders as $temps){
                    if(User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3,'id'=>$temps['id_user']))){
                        
                        $leadInfo =  CsRawLead::model()->findByPk($temps['id_customer']);
                        
                        if($leadInfo && $temps['amount'] > 0  && $temps['st'] == 2){
                            
                            $RaPayer = new RaPayer();
                            $RaPayer->phone       = $leadInfo->phone;
                            $RaPayer->name        = $leadInfo->firstname.' '.$leadInfo->lastname;
                            $RaPayer->address     = $leadInfo->address;
                            
                            $RaPayer->description = "Doanh thu bán hàng: <br/>(".$order_code." - ".$temps['product_name'].")";
                            
                            if($RaPayer->validate() &&  $RaPayer->save()){
                                
                                
                                $payment_type  = "";
                                
                                if($temps['payment_type'] == 'credit_card'){
                                    $payment_type  = 2;
                                    $stReceivable  = 1;
                                    $confirmedDate = null;
                                }
                                
                                if($temps['payment_type'] == 'cash'){
                                    $payment_type  = 1;
                                    $stReceivable  = 3;
                                    $confirmedDate = date("Y-m-d");
                                }
                                
                                $RA = new ReceivableAccount();
                                $RA->id_payer       = $RaPayer->id;
                                $RA->number         = $this->getArNumber(date("Y-m-d"));
                                $RA->amount         = ($temps['amount']-$temps['discount']+$temps['shipping_fee']);
                                $RA->type           = 0;
                                $RA->order_number   = $order_code;
                                $RA->id_user        = $temps['id_user'];
                                $RA->received_date  = date("Y-m-d");
                                $RA->confirmed_date = $confirmedDate;
                                $RA->payment_status = $payment_type;
                                $RA->status         = $stReceivable;
                                if($RA->validate() && $RA->save()){
                                    $result = 1;
                                }else{ throw new Exception('Error . Not found Receivable Account null!'); break;}
                                
                            }else{ throw new Exception('Error . Not found Payer null!');break; }
                        }
                    }else{
                        $result = 1;
                    }
                }
            
            } catch (Exception $error) {
                $transaction ->rollback();
                $result = $error ;
            }
            
            if($result == 1){
                $transaction ->commit();
            }
            
            return $result;
        }
        
    }
    public function AddnewOrderReceivableAccountReset($order_code){
        
        $Oders = VOrder::model()->findAllByAttributes(array('order_code'=>$order_code));
        
        if($Oders){
            
            $transaction = Yii::app()->db->beginTransaction();
            $result = "";
            try {
                foreach($Oders as $temps){
                    
                    $leadInfo =  CsRawLead::model()->findByPk($temps['id_customer']);
                    if($leadInfo && $temps['amount'] > 0  && $temps['st'] == 2){
                        
                        $RaPayer = new RaPayer();
                        $RaPayer->phone       = $leadInfo->phone;
                        $RaPayer->name        = $leadInfo->firstname.' '.$leadInfo->lastname;
                        $RaPayer->address     = $leadInfo->address;
                        
                        $RaPayer->description = "Doanh thu bán hàng: <br/>(".$order_code." - ".$temps['product_name'].")";
                        
                        //return $RaPayer->description;
                        
                        if($RaPayer->validate() &&  $RaPayer->save()){
                            
                            $payment_type  = "";
                            
                            if($temps['payment_type'] == 'credit_card'){
                                $payment_type  = 2;
                                $stReceivable  = 1;
                                $confirmedDate = null;
                            }
                            
                            if($temps['payment_type'] == 'cash'){
                                $payment_type  = 1;
                                $stReceivable  = 3;
                                $confirmedDate = substr($temps['create_date'],0,10);
                            }
                            
                            $RA = new ReceivableAccount();
                            $RA->id_payer       = $RaPayer->id;
                            $RA->number         = $this->getArNumber(substr($temps['create_date'],0,10));
                            $RA->amount         = ($temps['amount']-$temps['discount']+$temps['shipping_fee']);
                            $RA->type           = 0;
                            $RA->order_number   = $order_code;
                            $RA->id_user        = $temps['id_user'];
                            $RA->received_date  = substr($temps['create_date'],0,10);
                            $RA->confirmed_date = $confirmedDate;
                            $RA->payment_status = $payment_type;
                            $RA->status         = $stReceivable;
                            
                            if($RA->validate() && $RA->save()){
                                $result = 1;
                            }else{ throw new Exception('Error . Not found Receivable Account null!'); break;}
                            
                        }else{ throw new Exception('Error . Not found Payer null!');break; }
                    }
                }
            
            } catch (Exception $error) {
                $transaction ->rollback();
                $result = $error ;
            }
            
            if($result == 1){
                $transaction ->commit();
            }
            
            return $result;
        }
        
    }
    public function getArNumber($date){
        $con = Yii::app()->db;
        $st          = 0;      
        $sql = "SELECT COUNT(*) FROM `receivable_account` WHERE DATE(`received_date`) = DATE('$date') ";
        $dem = $con->createCommand($sql)->queryScalar();
        
        if($dem ==0){
            $dem = '000';
        }else{
            if($dem < 100){
                $dem = '0'.$dem;
                if($dem < 10){
                    $dem = '0'.$dem;
                }
            }
        }
        
        $create_date = str_replace(array('-',' ',':'),'',substr( $date, 2 ));
        
        if($dem > 0){
            $number = 'CNVRA-'.$create_date.$dem;
        }else{
            $number = 'CNVRA-'.$create_date.$dem;
        }
        return $number;
    }
    public function SearchReceivableAccount($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1',$status,$received_date)
    {
        $lpp_org = $lpp;
        
        $con = Yii::app()->db;
        
        $sql = "select count(*) from v_receivable where 1 = 1";
        
        if($and_conditions and is_array($and_conditions)){
            foreach($and_conditions as $k => $v){
                $sql .= " and $k = '$v'";
            }            
        }elseif($and_conditions){
            $sql .= " and $and_conditions";
        }
        
        if($status != ""){
            $sql .= " and $status";
        }
        
        if($received_date != ""){
            $sql .= " $received_date";
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
            
        if($num_row < $lpp){
            $cur_page = 1;
            $num_page = 1;
            $lpp = $num_row;
            $start = 0;
        }else{
            $num_page = ceil($num_row/$lpp); 
            if($cur_page >= $num_page){
                $cur_page = $num_page;

                $lpp = $num_row - ($num_page - 1) * $lpp_org;
            } 
            $start = ($cur_page - 1) * $lpp_org;
        }
  
        $sql = "select * from v_receivable where 1 = 1";
        if($and_conditions and is_array($and_conditions)){
            foreach($and_conditions as $k => $v){
                $sql .= " and $k = '$v'";
            }            
        }elseif($and_conditions){
            $sql .= " and $and_conditions";
        }
        
        if($status != ""){
            $sql .= " and $status";
        }
        
        if($received_date != ""){
            $sql .= " $received_date";
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
    
    public function cancelReceivableOrder($order_number){
        $model  =   VReceivable::model()->findByAttributes(array('order_number'=>$order_number));
        
         if($model){
            try{
                $transaction = Yii::app()->db->beginTransaction();
                
            	$result = ReceivableAccount::model()->updateByPk($model->id,array('status'=>'-1'));
                
            	if($result == null){
            		throw new Exception('Receivable account null !');
            	}
                
                if($result){
                    
                    $result = RaPayer::model()->updateByPk($model->id_payer,array('status'=>0));
                    
                    if($result){
                        $transaction ->commit();
                        return true;
                    }
                    throw new Exception('Error . Error delete Payer !');
                    
                }
                throw new Exception('Error . Error delete receivable  account!');
            }
            
            catch(Exception $e){
                $transaction ->rollback();
                return false;
            }
            
         }
         
    }
  
    
}
