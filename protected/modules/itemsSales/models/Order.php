<?php

/** 
 * This is the model class for table "order". 
 * 
 * The followings are the available columns in table 'order': 
 * @property integer $id
 * @property string $code
 * @property integer $id_quotation
 * @property string $code_quotation
 * @property integer $id_author
 * @property integer $id_customer
 * @property integer $id_branch
 * @property integer $id_segment
 * @property string $segment_description
 * @property integer $id_group_history
 * @property string $create_date
 * @property string $complete_date
 * @property double $sum_amount
 * @property double $sum_tax
 * @property integer $id_note
 * @property integer $status
 * @property string $currency_use
 */ 

class Order extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'order'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('id_author, id_customer, id_branch', 'required'),
            array('id_quotation, id_author, id_customer, id_branch, id_segment, id_group_history, id_note, status', 'numerical', 'integerOnly'=>true),
            array('sum_amount, sum_tax', 'numerical'),
            array('code, code_quotation', 'length', 'max'=>45),
            array('segment_description', 'length', 'max'=>255),
            array('currency_use', 'length', 'max'=>10),
            array('create_date, complete_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, id_quotation, code_quotation, id_author, id_customer, id_branch, id_segment, segment_description, id_group_history, create_date, complete_date, sum_amount, sum_tax, id_note, status, currency_use', 'safe', 'on'=>'search'),
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
            'code' => 'Code',
            'id_quotation' => 'Id Quotation',
            'code_quotation' => 'Code Quotation',
            'id_author' => 'Id Author',
            'id_customer' => 'Id Customer',
            'id_branch' => 'Id Branch',
            'id_segment' => 'Id Segment',
            'segment_description' => 'Segment Description',
            'id_group_history' => 'Id Group History',
            'create_date' => 'Create Date',
            'complete_date' => 'Complete Date',
            'sum_amount' => 'Sum Amount',
            'sum_tax' => 'Sum Tax',
            'id_note' => 'Id Note',
            'status' => 'Status',
            'currency_use' => 'Currency Use',
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
        $criteria->compare('code',$this->code,true);
        $criteria->compare('id_quotation',$this->id_quotation);
        $criteria->compare('code_quotation',$this->code_quotation,true);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('id_segment',$this->id_segment);
        $criteria->compare('segment_description',$this->segment_description,true);
        $criteria->compare('id_group_history',$this->id_group_history);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('complete_date',$this->complete_date,true);
        $criteria->compare('sum_amount',$this->sum_amount);
        $criteria->compare('sum_tax',$this->sum_tax);
        $criteria->compare('id_note',$this->id_note);
        $criteria->compare('status',$this->status);
        $criteria->compare('currency_use',$this->currency_use,true);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return Order the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    }
	
// tao ma don hang
    public function createCodeOrder()
    {
        $date = date('Y-m-d');
        $code = str_replace(array('-',' ',':'),'',substr( $date, 2 ));
        $num = Order::model()->count(array('condition' => 'date(create_date)="'.$date.'"')) + 1;
        $codenum = str_pad($num, '3' ,'0', STR_PAD_LEFT);
        $code .= $codenum;
        return $code;
    }
// chuyen doi ty gia - http://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx
    public function getCurrent()
    {
        $context  = stream_context_create(array('http' => array('header' => 'Content-type: application/xml')));
        $url    = 'https://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
        $xml = file_get_contents($url, false, $context);
        $result = simplexml_load_string($xml);

        $curr   = array();
        $json   = json_encode($result);
        $result = json_decode($json,TRUE);

        if(isset($result['Message']) && $result['Message'] == 'No data'){
            return 0;
        }
        
        $curr['DateTime'] = isset($result['DateTime']) ? $result['DateTime'] : '';

        foreach ($result['Exrate'] as $key => $value) {
            $value      = $value['@attributes'];
            $curr[$key] = $value;
        }

        return $curr;
    }
/****ham tao don hang ****/
    public function addOrder($newOrder = array(), $newOrderDetail = array())
    {
        if(!is_array($newOrder) || empty($newOrder) || !is_array($newOrderDetail) || empty($newOrderDetail))
            return array('status'=>'0', 'error'=>'Không tồn tại thông tin đơn hàng!');

        $checkInvoice   = 0;          // kiem tra hoa don
        $orderDetails   = array();    // thong tin don hang
        $invoiceDetails = array();    // thong tin hoa don
        $sumAmount      = 0;          // tong tien don hang
        $sumTax         = 0;          // tong thue don hang

        // thong tin don hang
        $order = new Order();
        $order->attributes    = $newOrder;
        $order->create_date   = Quotation::model()->converdate($order->create_date);
        $order->complete_date = Quotation::model()->converdate($order->complete_date);
        $order->code          = $this->createCodeOrder();
        $order->status        = 0;

        // kiem tra thong tin don hang va thong tin hoa don
        if($order->validate()) {
            // chi tiet bao gia
            foreach ($newOrderDetail as $key => $value) {
                $orderDetail = new OrderDetail();
                $orderDetail->attributes = $value;
                // luu chi tiet bao gia vao mang
                $orderDetails[] = $orderDetail;

                $sumAmount      += $orderDetail->amount;
                $sumTax         += $orderDetail->tax;

                // co check dieu tri -> tao hoa don
                if($orderDetail->status == 1) {
                    if(!$checkInvoice) {
                        $checkInvoice = 1;
                        // don hang co hoa don
                        $order->status = 1;
                    }
                    $invoiceDetails[] = $value;
                }
            }

            // thong tin tong tien va thue cua don hang
            if($order->sum_amount != $sumAmount) {
                $order->sum_amount = $sumAmount;
                $order->sum_tax    = $sumTax;
            }
            // luu don hang vao db
            $order->save();

            // luu chi tiet hoa don
            foreach ($orderDetails as $key => $value) {
                $value->id_order = $order->id;
                $value->save(false);
            }

            return array('status'=>1, 'checkInvoice' => $checkInvoice, 'invoiceDetails' => $invoiceDetails, 'order'=>$order->attributes);
        }
        return array('status'=>0,'error'=>$order->getErrors());
    }
/****ham cap nhat don hang don hang ****/
    public function updateOrder($orderInfo = array(), $orderDetails = array())
    {
        if(!is_array($orderInfo) || empty($orderInfo) || !is_array($orderDetails) || empty($orderDetails))
            return array('status'=>'0', 'error'=>'Đơn hàng không đúng định dạng!');

        $id_order = (isset($orderInfo['id']) && $orderInfo['id']) ? $orderInfo['id'] : '';
        $id_quotation = (isset($orderInfo['id_quotation']) && $orderInfo['id_quotation']) ? $orderInfo['id_quotation'] : '';

        if(!$id_order && !$id_quotation)
            return array('status'=>'0', 'error'=>'Không tồn tại mã đơn hàng hoặc mã báo giá!');

        if($id_order){
            $order = Order::model()->findByPk($id_order);
        }
        else if($id_quotation){
            $order = Order::model()->findByAttributes(array('id_quotation'=>$id_quotation));
        }

        $invoiceDetails = array();

        if($order){
            OrderDetail::model()->deleteAll("id_order = " . $order->id);
        }
        else {
            $order = new Order;
        }
        $order->attributes = $orderInfo;

        // co va khong ton tai id order item
        foreach ($orderDetails as $key => $value) {
            $orderItem             = new OrderDetail();
            $orderItem->attributes = $value;
            $orderItem->id_order   = $order->id;
            
            if(isset($value['quote_old']) && $value['quote_old'] == 1){
                $orderItem->status = 1;
            }
            else if($value['status'] == 1){
                $invoiceDetails[] = $value;
            }

            $orderItem->save(false);
        }
        
         $order->save(false);

        return array('status'=> 1, 'order'=>$order->attributes, 'invoiceDetails'=> $invoiceDetails);
    }
}