<?php

/** 
 * This is the model class for table "quotation". 
 * 
 * The followings are the available columns in table 'quotation': 
 * @property integer $id
 * @property string $code
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
 * @property string $note
 * @property integer $status
 * @property string $currency_use
 */ 
class Quotation extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public $note;
    public function tableName() 
    { 
        return 'quotation'; 
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
            array('id_author, id_customer, id_branch, id_segment, id_group_history, status', 'numerical', 'integerOnly'=>true),
            array('sum_amount, sum_tax', 'numerical'),
            array('code, currency_use', 'length', 'max'=>45),
            array('segment_description', 'length', 'max'=>255),
            array('create_date,complete_date, note', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, id_author, id_customer, id_branch, id_segment, segment_description, id_group_history, create_date, complete_date, sum_amount, sum_tax, note, currency_use, status', 'safe', 'on'=>'search'),
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
            'id_author' => 'Người tạo',
            'id_customer' => 'Khách hàng',
            'id_branch' => 'Văn phòng',
            'id_segment' => 'Id Segment',
            'segment_description' => 'Segment Description',
            'id_group_history' => 'Id Group History',
            'create_date' => 'Ngày tạo',
            'complete_date' => 'Ngày kết thúc',
            'sum_amount' => 'Sum Amount',
            'sum_tax' => 'Sum Tax',
            'note' => 'Note',
            'status' => 'Status',
            'currency_use' => 'currency_use',
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
        $criteria->compare('note',$this->note,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('currency_use',$this->currency_use);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return Quotation the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    } 
/****tao ma bao gia****/
    public function createCodeQuotation()
    {
        $date = date('Y-m-d');
        $code = str_replace(array('-',' ',':'),'',substr( $date, 2 ));
        $num = Quotation::model()->count(array('condition' => 'date(create_date)="'.$date.'"')) + 1;
        $codenum = str_pad($num, '3' ,'0', STR_PAD_LEFT);
        $code .= $codenum;
        return $code;
    }
/****them bao gia moi (DV chup hinh)****/
    public function addQuoteExam($add_quote = array('id_quotation'=>'', 'id_branch'=>'', 'id_author'=>'', 'id_user'=>'', 'id_customer'=>'', 'id_service'=>'', 'id_group_history'=>'', 'id_schedule'=>'' ,'note'=>'', 'status'=>0,))
    {

        if(!$add_quote['id_branch'] || !isset($add_quote['id_branch'])) {
            return -1;          // thiếu chi nhánh
        }
        if(!$add_quote['id_author'] || !isset($add_quote['id_author'])) {
            return -2;          // thiếu người tạo
        }
        if(!$add_quote['id_customer'] || !isset($add_quote['id_customer'])) {
            return -3;          // thiếu khách hàng
        }
        if(!$add_quote['id_group_history'] || !isset($add_quote['id_group_history'])) {
            return -4;          // ko co dot dieu tri
        }
        if(!$add_quote['id_service'] || !isset($add_quote['id_service'])) {
            return -5;          // ko co dich vu
        }
        if(!$add_quote['id_user'] || !isset($add_quote['id_user'])) {
            return -6;          // thiếu người thực hiện
        }
        
        $up = 0;
        $id_quotation = 0;

        $quote = Quotation::model()->findByAttributes(array('id_group_history'=>$add_quote['id_group_history'],'id_customer'=>$add_quote['id_customer']));

        if($quote) {
            $id_quotation = $quote->id;
            $quoteDetail  = QuotationService::model()->findAllByAttributes(array('id_quotation'=>$id_quotation));
            $id_service   = $add_quote['id_service'];

            // bao gia co dich vu chup hinh
            if($quoteDetail) {
                $sv = array_filter($quoteDetail, function($k) use($id_service){
                    if($k['id_service'] == $id_service)
                        return true;
                });
                if($sv)
                    return 0;       // báo giá có dich vu chup hinh
            }
            $up = 1;        // bao gia ko co dich vu chup hinh
        }
        

        $service        =       CsService::model()->findByPk($add_quote['id_service']);

        if(!$service) {
            return -7;          // Dich vu khong co
        }

        $note = (isset($add_quote['note']))  ? $add_quote['note'] : '';

        if($up == 0 && $id_quotation == 0)
        { 
            $quote        =       $this->addQuotation(array(
               'id_branch'         =>  $add_quote['id_branch'], 
               'id_author'         =>  $add_quote['id_author'], 
               'id_customer'       =>  $add_quote['id_customer'],
               'id_group_history'  =>  $add_quote['id_group_history'],
               'sum_tax'           =>  $service->tax,
               'sum_amount'        =>  $service->price, 
               'note'              =>  $note,
               'id_schedule'       =>  $add_quote['id_schedule'],
               'status'            =>  0,
               'add_quote_details' => array(array(
                   'id_service'  => $add_quote['id_service'],
                   'description' => $service['name'],
                   'id_user'     => $add_quote['id_user'],
                   'unit_price'  => $service->price,
                   'amount'      => $service->price,
                   'qty'         => 1,
                   'status'      => $add_quote['status'],
                   'tax'         => $service->tax,
                   'id_segment'          => (isset($add_quote['id_segment'])) ? $add_quote['id_segment'] : '',
                   'segment_description' => (isset($add_quote['segment_description'])) ? $add_quote['segment_description'] : '',
               ))
           ));
        }
        else {
            $quote   = $this->updateQuotation(array(
                'id'                =>  $id_quotation, 
                'id_branch'         =>  $add_quote['id_author'],
                'note'              =>  $note,
                'id_schedule'       =>  $add_quote['id_schedule'],
                'update_quote_details' => array(array(
                    'id_service'  => $add_quote['id_service'],
                    'description' => $service['name'],
                    'id_user'     => $add_quote['id_user'],
                    'unit_price'  => $service->price,
                    'amount'      => $service->price,
                    'qty'         => 1,
                    'status'      => $add_quote['status'],
                    'tax'         => $service->tax,
            ))));
        }


        return $quote;
    }
/****tao bao gia****/
    public function addQuotation($add_quote = array('id_branch'=>'', 'id_author'=>'', 'id_customer'=>'', 'create_date'=>'', 'complete_date'=>'' ,'sum_tax'=>'', 'sum_amount'=> '', 'id_group_history'=>'', 'id_schedule'=>'', 'note'=>'', 'status'=>0 , 'add_quote_details' => array()))
    {
        $quote       = new Quotation();
        $id_schedule = isset($add_quote['id_schedule']) ? $add_quote['id_schedule']: '';

        $quote->attributes  = $add_quote;

        $all                = true;
        $sum_invoice          = 0;
        $tax_invoice          = 0;

        if($quote->validate()) {

            if(!isset($add_quote['add_quote_details']) || !is_array ($add_quote['add_quote_details']))
                return -2;              // khong co chi tiet bao gia

            $trans = Yii::app()->db->beginTransaction();

            try {
                $quote->code           =   $quote::model()->createCodeQuotation();
                $quote->save();
                $quote_detail_validate =   false;

                $invoice =   new Invoice();

                $invoice->attributes     =   $quote->attributes;
                $invoice->id_quotation   =   $quote->id;
                $invoice->code_quotation =   $quote->code;
                $invoice->id_schedule    =   $id_schedule;

                $invoice_details          =   array();
                $invoice_check            =   false;
                $invoice_detail_validate  =   true;
                $invoices                 =   false;

                foreach ($add_quote['add_quote_details'] as $key => $quote_item) {

                    if(!is_array($quote_item)) {
                        $trans->rollback();
                        return -3;              //    ko du du lieu chi tiet bao gia
                    }

                    $quote_detail               =   new QuotationService();
                    
                    $quote_detail->attributes   =   $quote_item;
                    $quote_detail->id_quotation =   $quote->id;
                    $quote_detail->id_author    =   $quote->id_author;

                    if($quote_detail->validate()) {
                        $quote_detail->save();

                        if($quote_detail->status == 1) {          // co dieu tri
                            $invoice_check      =   true;
                            
                            $new_invoice_detail =   new InvoiceDetail();
                            
                            $new_invoice_detail->attributes =   $quote_detail->attributes;
                            $new_invoice_detail->status     =   0;
                            
                            $sum_invoice                    +=  (int)$new_invoice_detail->amount;
                            $tax_invoice                    +=  (int)$new_invoice_detail->tax;

                            if($new_invoice_detail->validate()) {
                                $invoice_details[]            =   $new_invoice_detail;
                            }
                            else 
                                $invoice_detail_validate      =   false;
                        }
                    }
                }

                $id_inv = '';

                if($invoice_check && $invoice_detail_validate) {
                    $invoice->attributes          =   $quote->attributes;
                    $invoice->code                =   $invoice::model()->createCodeinvoice();
                    $invoice->sum_amount          =   $sum_invoice;
                    $invoice->sum_tax             =   $tax_invoice;
                    $invoice->balance             =   $sum_invoice;

                    $invoice->save();

                    $id_inv = $invoice->id;

                    foreach ($invoice_details as $key => $invoice_item) {
                        $invoice_item->id_invoice   =   $invoice->id;
                        $invoice_item->save();
                    }
                }

                if($id_schedule)
                {
                    $updateSchedule = CsSchedule::model()->updateSchedule(array('id'=>$id_schedule, 'id_quotation'=>$quote->id,'id_invoice'=>$id_inv));
                }

                $trans->commit();
            }
            catch (Exception $e) {
                $trans->rollback();
                $all    =   false;
                return 0;                // co loi xay ra
            }
            if($all) {
                return array('rs'=> 1,'quote'=>$quote->id,'invoice'=>$id_inv);
            }
        }
        else
            return -1;                      // bao gia khong xac thuc
    }
/****cap nhat bao gia****/
    public function updateQuotation($update_quote = array('id'=>'', 'id_schedule'=>'', 'id_branch'=>'', 'complete_date'=>'' ,'sum_tax'=>'', 'sum_amount'=> '', 'note'=>'', 'status'=>'' , 'update_quote_details' => array()))
    {
        if(!$update_quote['id'])
            return -1;          // khong co ma bao gia
        if(!$update_quote['update_quote_details'] || !is_array($update_quote['update_quote_details']))
            return -2;              // khong co chi tiet bao gia

        $id_schedule = isset($update_quote['id_schedule']) ? $update_quote['id_schedule']: '';

        $sum_quote       = 0;
        $tax_quote       = 0;
        $all             = true;
        $sum_inv         = 0;
        $tax_inv         = 0;
        $sum_invoice     = 0;
        $tax_invoice     = 0;
        $novat_invoice   = 0;
        $balance_invoice = 0;
        $id_inv          = '';
        
        $quote     = Quotation::model()->findByPk($update_quote['id']);
        if(!$quote)
            return -2;      // ko co bao gia

        $sum_quote = $quote->sum_amount;
        $tax_quote = $quote->sum_tax;
        
        $quote->attributes = $update_quote;

        if($quote->validate()) {
            $trans = Yii::app()->db->beginTransaction();

            try {
                $quote_detail_validate =   true;
                
                $invoice = Invoice::model()->findByAttributes(array('id_quotation'=>$update_quote['id']));

                if(!$invoice) 
                    $invoice              =   new Invoice();
                else {
                    $sum_invoice     = $invoice->sum_amount;
                    $tax_invoice     = $invoice->sum_tax;
                    $novat_invoice   = $invoice->sum_no_vat;
                    $balance_invoice = $invoice->balance;
                }

                $invoice->attributes     =   $quote->attributes;
                $invoice->id_quotation   =   $update_quote['id'];
                
                $invoice_details         =   array();
                $invoice_check           =   false;
                $invoice_detail_validate =   true;
                $invoices                =   false;

                foreach ($update_quote['update_quote_details'] as $key => $quote_item) {
                    if(!is_array($quote_item)) {
                        $trans->rollback();
                        return -3;              // ko du du lieu chi tiet bao gia
                    }

                    $old =   false;

                    if(isset($quote_item['id'])){
                        $quote_detail =   QuotationService::model()->findByPk($quote_item['id']);
                        if($quote_detail->status == 1)
                            $old = true;            // co dieu tri
                    }
                    else
                        $quote_detail =   new QuotationService();       // ko co dieu tri
                    
                    $quote_detail->attributes   =   $quote_item;
                    $quote_detail->id_quotation =   $quote->id;

                    if($quote_detail->validate()) {
                        if(!$old) {
                            $sum_quote += (int)$quote_detail->amount;
                            $tax_quote += (int)$quote_detail->tax;
                            
                            $quote_detail->save();

                            if($quote_detail->status == 1)
                            {
                                $invoice_check      =   true;
                            
                                $new_invoice_detail =   new InvoiceDetail();
                                
                                $new_invoice_detail->attributes =   $quote_detail->attributes;
                                $new_invoice_detail->status     =   0;
                                
                                $sum_inv +=  (int)$new_invoice_detail->amount;
                                $tax_inv +=  (int)$new_invoice_detail->tax;

                                if($new_invoice_detail->validate()) 
                                    $invoice_details[]            =   $new_invoice_detail;
                                else 
                                    $invoice_detail_validate =   false;
                            }
                        }
                    }
                    else
                        $quote_detail_validate =   false;
                }
                
                $quote->sum_amount = $sum_quote;
                $quote->sum_tax    = $tax_quote;
                
                $quote->save();

                if($invoice_check && $invoice_detail_validate) {
                    $invoice->attributes  =   $quote->attributes;
                    $invoice->sum_amount  =   (int)$sum_invoice + (int)$sum_inv;
                    $invoice->sum_tax     =   (int)$tax_invoice + (int)$tax_inv;
                    $invoice->sum_no_vat  =   (int)$novat_invoice + (int)$sum_inv;
                    $invoice->balance     =   (int)$balance_invoice + (int)$sum_inv;
                    $invoice->id_schedule =   $id_schedule;

                    $invoice->save();

                    $id_inv = $invoice->id;

                    foreach ($invoice_details as $key => $invoice_item) {
                        $invoice_item->id_invoice   =   $invoice->id;

                        $invoice_item->save();
                    }
                    $invoices          =       true;
                }

                if($id_schedule)
                {
                    $updateSchedule = CsSchedule::model()->updateSchedule(array('id'=>$id_schedule, 'id_quotation'=>$quote->id,'id_invoice'=>$id_inv));
                }
                
                $trans->commit();
            }
            catch (Exception $e) {
                $trans->rollback();
                $all    =   true;
                return 0;                // co loi xay ra
            }
            if($all) {
                return array('rs'=> 1,'quote'=>$quote->id,'invoice'=>$id_inv);
            }
        }
        return -1;                      // bao gia khong xac thuc
    }
/****ham tao bao gia****/
    function converdate($date){
        $datetime = DateTime::createFromFormat('d/m/Y', $date);
        if($datetime)
            return $datetime->format('Y-m-d');
        return $date;
    }

    public function addQuote($newQuote = array(), $newQuoteDetail = array())
    {
        if(!is_array($newQuote) || empty($newQuote) || !is_array($newQuoteDetail) || empty($newQuoteDetail))
            return array('status'=>'0', 'error'=>'Không tồn tại thông tin báo giá!');

        $checkOrder   = 0;          // dich vu check dieu tri
        $orderDetails = array();    // thong tin don hang
        $quoteDetails = array();    // thong tin bao gia
        $sumAmount    = 0;          // tong tien bao gia
        $sumTax       = 0;          // tong thue bao gia

        // thong tin bao gia
        $quote = new Quotation();
        $quote->attributes    = $newQuote;
        $quote->create_date   = $this->converdate($quote->create_date);
        $quote->complete_date = $this->converdate($quote->complete_date);
        if($quote->code == '')
            $quote->code = $this->createCodeQuotation();

        // kiem tra thong tin bao gia va thong tin don hang
        if($quote->validate()) {
            // chi tiet bao gia
            foreach ($newQuoteDetail as $key => $value) {
                $quoteDetail = new QuotationService();
                $quoteDetail->attributes = $value;
                // luu chi tiet bao gia vao mang
                $quoteDetails[] = $quoteDetail;

                $sumAmount      += $quoteDetail->amount;
                $sumTax         += $quoteDetail->tax;

                // co check dieu tri -> tao don hang va hoa don
                if($quoteDetail->status == 1) {
                    if(!$checkOrder) {
                        $checkOrder = 1;
                        // dua toan bo chi tiet bao gia vao don hang
                        $orderDetails = $newQuoteDetail;
                        // bao gia co don hang
                        $quote->status = 1;
                    }
                }
            }

            // thong tin tong tien va thue cua bao gia
            if($quote->sum_amount != $sumAmount) {
                $quote->sum_amount = $sumAmount;
                $quote->sum_tax    = $sumTax;
            }

            // luu ghi chu
            $id_note = '';
            if($quote->note) {
                $note = CustomerNote::model()->addnote(array(
                        'note'        => $quote->note,
                        'id_user'     => $quote->id_author,
                        'id_customer' => $quote->id_customer,
                        'flag'        => 2,         // 2: báo giá
                        'important'   => 0,
                        'status'      => 1,
                ));
                if(isset($note['id']))
                    $quote->id_note = $note['id'];
            }

            // luu bao gia vao db
            $quote->save();

            // luu chi tiet bao gia
            foreach ($quoteDetails as $key => $value) {
                $value->id_quotation = $quote->id;
                $value->save();
            }

            return array('status'=>1, 'checkOrder' => $checkOrder, 'orderDetails' => $orderDetails, 'quote'=>$quote->attributes);
        }
        return array('status'=>0,'error'=>$quote->getError());
    }
/****ham cap nhat bao gia****/
    public function updateQuote($infoQuote = array(), $updateQuoteOldDetail = array(), $updateQuoteNewDetail = array())
    {
        if(!is_array($infoQuote) || empty($infoQuote))
            return array('status'=>'0', 'error'=>'Không tồn tại thông tin báo giá!');

        if(!is_array($updateQuoteOldDetail) || empty($updateQuoteOldDetail))
            return array('status'=>'0', 'error'=>'Không tồn tại thông tin báo giá cũ!');

        if(!empty($updateQuoteNewDetail) && !is_array($updateQuoteNewDetail))
            return array('status'=>'0', 'error'=>'Thông tin báo giá mới không đúng định dạng!');

        $id_quotation = isset($infoQuote['id']) ? $infoQuote['id'] : '';

        $quote                = Quotation::model()->findByPk($id_quotation);
        $quote->attributes    = $infoQuote;
        $quote->create_date   = $this->converdate($quote->create_date);
        $quote->complete_date = $this->converdate($quote->complete_date);

        if(!$quote){
            return array('status'=>'0', 'error'=>'Không tồn tại báo giá!');
        }

        $oldDetailValidate = 1;      // xac thuc chi tiet bao gia cu
        $newDetailValidate = 1;      // xac thuc chi tiet bao gia moi
        $checkOrderOld     = $quote->status;     // kiem tra don hang cu
        $checkOrderNew     = 0;         // kiem tra don hang moi
        $quoteDetails      = array();   // mang chi tiet bao gia
        $orderDetails      = array();   // mang chi tiet don hang

        // cap nhat bao gia cu - status -1: xoa, 0: bao gia, 1: dieu tri
        foreach ($updateQuoteOldDetail as $key => $value) {
            $id_old = isset($value['id']) ? $value['id'] : '';
            
            // co id dich vu -> bao gia co dich vu
            // status khac dieu tri
            if($id_old && $value['quote_old'] != 1){
                $oldDetail = QuotationService::model()->findByPk($id_old);

                // co thong tin dich vu trong bao gia
                if($oldDetail){
                    $oldDetail->attributes = $value;
                    // xoa dich vu
                    if($value['del'] == 1)
                        $oldDetail->status = -1;
            
                    $oldDetail->save();

                    // kiem tra don hang moi
                    if($oldDetail->status == 1){
                        if(!$checkOrderNew){
                            $checkOrderNew = 1;
                        }
                    }
                }
                // khong co thong tin dich vu trong bao gia
            }
            // khong co id -> tao moi dich vu cho bao gia
            else if(!$id_old){
                $newDetail = new QuotationService();
                $newDetail->attributes = $value;
                $newDetail->id_quotation = $quote->id;

                $newDetail->save(false);

                // kiem tra don hang moi
                if($newDetail->status == 1){
                    if(!$checkOrderNew){
                        $checkOrderNew = 1;
                    }
                }
            }
        }

        // tao dich vu bao gia moi
        foreach ($updateQuoteNewDetail as $key => $value) {
            $newDetail = new QuotationService();
            $newDetail->attributes = $value;
            $newDetail->id_quotation = $quote->id;

            $newDetail->save(false);

            // kiem tra don hang moi
            if($newDetail->status == 1){
                if(!$checkOrderNew){
                    $checkOrderNew = 1;
                }
            }
        }

        if($checkOrderNew || $checkOrderOld)
            $quote->status = 1;

        $quote->save();
        
        return array('status'=>'1','orderDetails'=>array_merge($updateQuoteOldDetail, $updateQuoteNewDetail), 'checkOrderOld' => $checkOrderOld, 'checkOrderNew'=>$checkOrderNew);
    }
/****Lay thong tin nhom khach hang ****/
    public function getCusSeg($id_customer)
    {
        if(!$id_customer)
            return -1;      // khong co ma khach hang

        return $cusSeg = Yii::app()->db->createCommand()
                ->select('customer_segment.id_customer,customer_segment.id_segment,segment.name')
                ->from('customer_segment')
                ->where('id_customer=:id_customer', array(':id_customer' => $id_customer))
                ->leftJoin('segment', 'segment.id = customer_segment.id_segment')
                ->queryAll();
    }
} 
