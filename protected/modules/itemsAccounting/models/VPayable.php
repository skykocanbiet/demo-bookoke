<?php

/**
 * This is the model class for table "v_payable".
 *
 * The followings are the available columns in table 'v_payable':
 * @property integer $id
 * @property string $number
 * @property integer $type
 * @property string $note
 * @property double $amount
 * @property integer $order_number
 * @property string $requester_date
 * @property string $approval_date
 * @property integer $status
 * @property integer $payment_status
 * @property integer $id_user
 * @property integer $id_receiver
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $in_words
 * @property string $description
 * @property integer $st_receiver
 * @property string $user_name
 */
class VPayable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_payable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, type, status, payment_status, order_number, id_user, id_receiver, st_receiver', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name, address, in_words', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('user_name', 'length', 'max'=>128),
			array('note, requester_date, approval_date, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, type, note, order_number, amount, requester_date, approval_date, status, payment_status, id_user, id_receiver, name, phone, address, in_words, description, st_receiver, user_name', 'safe', 'on'=>'search'),
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
			'requester_date' => 'Requester Date',
			'approval_date' => 'Approval Date',
			'status' => 'Status',
            'payment_status'    => 'Payment Status',
			'id_user' => 'Id User',
			'id_receiver' => 'Id Receiver',
			'name' => 'Name',
			'phone' => 'Phone',
			'address' => 'Address',
			'in_words' => 'In Words',
			'description' => 'Description',
			'st_receiver' => 'St Receiver',
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
		$criteria->compare('requester_date',$this->requester_date,true);
		$criteria->compare('approval_date',$this->approval_date,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_receiver',$this->id_receiver);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('in_words',$this->in_words,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('st_receiver',$this->st_receiver);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VPayable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
// tim kiem du lieu
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
    public function getListUsers(){
        return GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
    }

// tao moi phieu thu    
    /*public function AddnewOrderPayableAccount($order_code){
        
        $Oders = VOrder::model()->findAllByAttributes(array('order_code'=>$order_code));
        
        if($Oders){
            $transaction = Yii::app()->db->beginTransaction();
            $result = "0";
            foreach($Oders as $temps){
            
                $Supplier    =  VProduct::model()->findByAttributes(array('id_product'=>$temps['id_product_detail']));
                
                if($Supplier && $temps['amount'] > 0 && $temps['st'] == 2){
                    try {
                        
                        $PaReceiver = new PaReceiver();
                        $PaReceiver->phone       = $Supplier->sup_phone;
                        $PaReceiver->name        = $Supplier->sup_name;
                        $PaReceiver->address     = $Supplier->sup_add;
                        
                        $PaReceiver->description = 'Thanh toán tiền hàng: <br/>('.$order_code.' - '.$temps['product_name'].')';
                        
                        if($PaReceiver->validate() &&  $PaReceiver->save()){
                            $payment_type     = "";
                            if($temps['payment_type'] == 'cash'){
                                $payment_type = 1;
                                $stPayable    = 3;
                                $approvalDate = date("Y-m-d");
                            }
                            
                            if($temps['payment_type'] == 'credit_card'){
                                $payment_type = 2;
                                $stPayable    = 1;
                                $approvalDate = null;
                            }
                            
                            $PA = new PayableAccount();
                            $PA->id_user        = $temps['id_user'];
                            $PA->number         = $this->getApNumber(date("Y-m-d"));
                            $PA->amount         = (((($temps['amount']-$temps['discount'])*(100 - $temps['costofgoodssold']))/100)+$temps['shipping_fee']);
                            $PA->type           = 0;
                            $PA->order_number   = $order_code;
                            $PA->id_receiver    = $PaReceiver->id;
                            $PA->requester_date = date("Y-m-d");
                            $PA->payment_status = $payment_type;
                            $PA->approval_date  = $approvalDate;
                            $PA->status         = $stPayable;
                        
                           
                            if($PA->validate() && $PA->save()){
                                $result = 1;
                            }else{ throw new Exception('Error . Not found Receivable Account null!');break; }
                            
                        }else{ throw new Exception('Error . Not found Payer null!');break; }
                        
                    } catch (Exception $error) {
                        $transaction ->rollback();
                        $result = $error;
                    }
                }
            }
            
            if($result == 1){
                $transaction ->commit();
                return $result;
            }
        }
        return false;
    }*/

    /**
     * Default param in newPayAcc
     *     PaReceiver - thong tin khach hang
     * 'id_customer' => ,      // id khach hang (neu co)
     * 'name'        => ,      // ho ten khach hang
     * 'phone'       => ,      // so dien thoai
     * 'address'     => ,      // dia chi
     * 
     * 'description' => ,      // mo ta phieu thu THANH TOÁN HÓA ĐƠN SỐ 170328001
     *     PayableAccount - thong tin phieu thu
     * 'note'           => ,   // ghi chu
     * 'amount'         => ,   // so tien nhan tu khach
     * 'currExchange'   => ,   // so tien nhan tu khach - vnd
     * 'order_number'   => ,   // ma hoa don
     * 'id_user'        => ,   // nguoi tao
     * 'requester_date' => ,   // ngay tao
     * 'payment_status' => ,   // hinh thuc thanh toan
     * 'type'           => ,    // loai phieu thu
     */
    public function AddnewPayableAccount($newPayAcc= array()){
      
        if(isset($newPayAcc['id_customer']) && $newPayAcc['id_customer']){
            $customer = Customer::model()->findByPk($newPayAcc['id_customer']);
            $cus['name']    = $customer->fullname;
            $cus['phone']   = $customer->phone;
            $cus['address'] = $customer->address;
        }
        else
            $cus = $newPayAcc;
        $cus['description'] = $newPayAcc['description'];


        //return $cus;
        $payCus = new PaReceiver();
        $payCus->attributes = $cus;
        
        $payInfo = new PayableAccount();
        $payInfo->attributes = $newPayAcc;
        $payInfo->number = $this->getApNumber();

        if($payInfo->validate() && $payCus->validate()){
            $payCus->save();

            $payInfo->id_receiver = $payCus->id;
            $payInfo->save();

            return array('status'=>1 );
        }
        return array('status'=>0, 'errorCus'=>$payCus->getErrors(), 'errorInfo'=> $payInfo->getErrors());
    }
    public function AddnewOrderPayableAccountReset($order_code){
        
        $Oders = VOrder::model()->findAllByAttributes(array('order_code'=>$order_code));
        //return  $this->getApNumberReset('2016-05-11');
        if($Oders){
            $transaction = Yii::app()->db->beginTransaction();
            $result = "0";
            foreach($Oders as $temps){
            
                $Supplier    =  VProduct::model()->findByAttributes(array('id_product'=>$temps['id_product_detail']));
                
                if($Supplier && $temps['amount'] > 0 && $temps['st'] == 2){
                    try {
                        
                        $PaReceiver = new PaReceiver();
                        $PaReceiver->phone       = $Supplier->sup_phone;
                        $PaReceiver->name        = $Supplier->sup_name;
                        $PaReceiver->address     = $Supplier->sup_add;
                        
                        $PaReceiver->description = 'Thanh toán tiền hàng: <br/>('.$order_code.' - '.$temps['product_name'].')';
                        
                        if($PaReceiver->validate() &&  $PaReceiver->save()){
                            $payment_type = "";
                            if($temps['payment_type'] == 'cash'){
                                $payment_type = 1;
                                $stPayable    = 3;
                                $approvalDate = substr($temps['create_date'],0,10);;
                            }
                            
                            if($temps['payment_type'] == 'credit_card'){
                                $payment_type = 2;
                                $stPayable    = 1;
                                $approvalDate = null;
                            }
                            
                            $PA = new PayableAccount();
                            $PA->id_user        = $temps['id_user'];
                            $PA->number         = $this->getApNumber(substr($temps['create_date'],0,10));
                            $PA->amount         = (((($temps['amount']-$temps['discount'])*(100 - $temps['costofgoodssold']))/100)+$temps['shipping_fee']);
                            $PA->type           = 0;
                            $PA->order_number   = $order_code;
                            $PA->id_receiver    = $PaReceiver->id;
                            $PA->requester_date = substr($temps['create_date'],0,10);;
                            $PA->payment_status = $payment_type;
                            $PA->approval_date  = $approvalDate;
                            $PA->status         = $stPayable;
                            
                            if($PA->validate() && $PA->save()){
                                $result = 1;
                            }else{ throw new Exception('Error . Not found Receivable Account null!');break; }
                            
                        }else{ throw new Exception('Error . Not found Payer null!');break; }
                        
                    } catch (Exception $error) {
                        $transaction ->rollback();
                        $result = $error;
                    }
                }
            }
            
            if($result == 1){
                $transaction ->commit();
                return $result;
            }
        }
        return false;
    }

//lay ma phieu thu
    public function getApNumber($date=''){
        if(!$date)
            $date = date('Y-m-d');
        $con = Yii::app()->db;
        $st          = 0;      
        $sql = "SELECT COUNT(*) FROM `payable_account` WHERE DATE(`requester_date`) = DATE('$date') ";
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
            $number = 'CNVPA-'.$create_date.$dem;
        }else{
            $number = 'CNVPA-'.$create_date.$dem;
        }
        return $number;
    }
    
    public function SearchPayableAccount($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1',$status,$requester_date)
    {
        $lpp_org = $lpp;
        
        $con = Yii::app()->db;
        
        $sql = "select count(*) from v_payable where 1 = 1";
        
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
        
        if($requester_date != ""){
            $sql .= " $requester_date";
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
  
        $sql = "select * from v_payable where 1 = 1";
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
        
        if($requester_date != ""){
            $sql .= " $requester_date";
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
    
    public function cancelPayableOrder($order_number){
        $model  =   VPayable::model()->findByAttributes(array('order_number'=>$order_number));
        if($model){
            try{
                $transaction = Yii::app()->db->beginTransaction();
                
            	$delete_ra = PayableAccount::model()->updateByPk($model->id,array('status'=>'-1'));
                
                if($delete_ra){
                    
                    $PaReceiver = PaReceiver::model()->updateByPk($model->id_receiver,array('status'=>0));
    
                    if($PaReceiver){
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
