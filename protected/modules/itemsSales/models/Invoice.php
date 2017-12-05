<?php

/** 
 * This is the model class for table "invoice". 
 * 
 * The followings are the available columns in table 'invoice': 
 * @property integer $id
 * @property string $code
 * @property integer $id_quotation
 * @property string $code_quotation
 * @property integer $id_order
 * @property string $code_order
 * @property integer $id_schedule
 * @property integer $id_author
 * @property integer $id_customer
 * @property integer $id_branch
 * @property integer $id_group_history
 * @property string $create_date
 * @property string $complete_date
 * @property double $sum_amount
 * @property double $sum_no_vat
 * @property double $sum_tax
 * @property double $vat
 * @property string $note
 * @property string $date_vat
 * @property string $place_vat
 * @property double $balance
 * @property integer $status
 * @property string $currency_use
 */ 

class Invoice extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'invoice'; 
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
            array('id_quotation, id_order, id_schedule, id_author, id_customer, id_branch, id_group_history, status', 'numerical', 'integerOnly'=>true),
            array('sum_amount, sum_no_vat, sum_tax, vat, balance', 'numerical'),
            array('code', 'length', 'max'=>45),
            array('code_quotation, code_order', 'length', 'max'=>20),
            array('place_vat', 'length', 'max'=>255),
            array('currency_use', 'length', 'max'=>10),
            array('complete_date, note, date_vat', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, id_quotation, code_quotation, id_order, code_order, id_schedule, id_author, id_customer, id_branch, id_group_history, create_date, complete_date, sum_amount, sum_no_vat, sum_tax, vat, note, date_vat, place_vat, balance, status, currency_use', 'safe', 'on'=>'search'),
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
            'id_order' => 'Id Order',
            'code_order' => 'Code Order',
            'id_schedule' => 'Id Schedule',
            'id_author' => 'Id Author',
            'id_customer' => 'Id Customer',
            'id_branch' => 'Id Branch',
            'id_group_history' => 'Id Group History',
            'create_date' => 'Create Date',
            'complete_date' => 'Complete Date',
            'sum_amount' => 'Sum Amount',
            'sum_no_vat' => 'Sum No Vat',
            'sum_tax' => 'Sum Tax',
            'vat' => 'Vat',
            'note' => 'Note',
            'date_vat' => 'Date Vat',
            'place_vat' => 'Place Vat',
            'balance' => 'Balance',
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
        $criteria->compare('id_order',$this->id_order);
        $criteria->compare('code_order',$this->code_order,true);
        $criteria->compare('id_schedule',$this->id_schedule);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('id_group_history',$this->id_group_history);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('complete_date',$this->complete_date,true);
        $criteria->compare('sum_amount',$this->sum_amount);
        $criteria->compare('sum_no_vat',$this->sum_no_vat);
        $criteria->compare('sum_tax',$this->sum_tax);
        $criteria->compare('vat',$this->vat);
        $criteria->compare('note',$this->note,true);
        $criteria->compare('date_vat',$this->date_vat,true);
        $criteria->compare('place_vat',$this->place_vat,true);
        $criteria->compare('balance',$this->balance);
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
     * @return Invoice the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    } 
// tao ma hoa don
	public function createCodeInvoice()
    {
        $date = date('Y-m-d');
        $code = str_replace(array('-',' ',':'),'',substr( $date, 2 ));
        $num = Invoice::model()->count(array('condition' => 'date(create_date)="'.$date.'"')) + 1;
        $codenum = str_pad($num, '3' ,'0', STR_PAD_LEFT);
        $code .= $codenum;
        return $code;
    }
/****ham tao hoa don ****/
    public function addInvoice($newInvoice = array(), $newInvoiceDetail = array())
    {
        if(!is_array($newInvoice) || empty($newInvoice) || !is_array($newInvoiceDetail) || empty($newInvoiceDetail))
            return array('status'=>'0', 'error'=>'Không tồn tại thông tin hóa đơn!');
        $sumAmount      = 0;          // tong tien hoa don
        $sumTax         = 0;          // tong thue hoa don

        // thong tin hoa don
        $invoice = new Invoice();
        $invoice->attributes    = $newInvoice;
        $invoice->create_date   = Quotation::model()->converdate($invoice->create_date);
        $invoice->complete_date = Quotation::model()->converdate($invoice->complete_date);
        $invoice->code          = $this->createCodeInvoice();
        $invoice->status        = 0;

        // kiem tra thong tin hoa don
        if($invoice->validate()) {
            // chi tiet bao gia
            foreach ($newInvoiceDetail as $key => $value) {
                $invoiceDetail = new InvoiceDetail();
                $invoiceDetail->attributes = $value;
                // luu chi tiet bao gia vao mang
                $invoiceDetails[] = $invoiceDetail;

                $sumAmount      += $invoiceDetail->amount;
                $sumTax         += $invoiceDetail->tax;
            }

            // thong tin tong tien va thue cua hoa don
            $invoice->sum_amount = $sumAmount;
            $invoice->sum_tax    = $sumTax;
            $invoice->sum_no_vat = $sumAmount;
            $invoice->balance    = $sumAmount;
        
            // luu don hang vao db
            $invoice->save();

            // luu chi tiet hoa don
            foreach ($invoiceDetails as $key => $value) {
                $value->id_invoice = $invoice->id;
                $value->save();
            }

            return array('status'=>1, 'invoice' => $invoice->attributes);
        }
        return array('status'=>0,'error'=>$invoice->getError());
    }
}
