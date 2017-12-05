<?php

/** 
 * This is the model class for table "v_invoice". 
 * 
 * The followings are the available columns in table 'v_invoice': 
 * @property integer $id
 * @property string $code
 * @property integer $id_order
 * @property integer $id_branch
 * @property string $branch_name
 * @property integer $id_customer
 * @property string $customer_name
 * @property integer $id_author
 * @property string $author_name
 * @property string $create_date
 * @property double $sum_amount
 * @property double $sum_tax
 * @property double $vat
 * @property string $note
 * @property integer $status
 */ 
class VInvoice extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'v_invoice'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('branch_name', 'required'),
            array('id, id_order, id_branch, id_customer, id_author, status', 'numerical', 'integerOnly'=>true),
            array('sum_amount, sum_tax, vat', 'numerical'),
            array('code', 'length', 'max'=>45),
            array('branch_name, customer_name', 'length', 'max'=>255),
            array('author_name', 'length', 'max'=>128),
            array('create_date, note', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, id_order, id_branch, branch_name, id_customer, customer_name, id_author, author_name, create_date, sum_amount, sum_tax, vat, note, status', 'safe', 'on'=>'search'),
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
            'id_order' => 'Id Order',
            'id_branch' => 'Id Branch',
            'branch_name' => 'Branch Name',
            'id_customer' => 'Id Customer',
            'customer_name' => 'Customer Name',
            'id_author' => 'Id Author',
            'author_name' => 'Author Name',
            'create_date' => 'Create Date',
            'sum_amount' => 'Sum Amount',
            'sum_tax' => 'Sum Tax',
            'vat' => 'Vat',
            'note' => 'Note',
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
        $criteria->compare('code',$this->code,true);
        $criteria->compare('id_order',$this->id_order);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('branch_name',$this->branch_name,true);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('customer_name',$this->customer_name,true);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('author_name',$this->author_name,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('sum_amount',$this->sum_amount);
        $criteria->compare('sum_tax',$this->sum_tax);
        $criteria->compare('vat',$this->vat);
        $criteria->compare('note',$this->note,true);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return VInvoice the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    }

    function getPageSearch($cur_page,$lpp,$num_row){

        $lpp_org = $lpp;

        if($lpp == 'all'){
            $lpp = $num_row;
        }
        if($num_row < $lpp){
            $cur_page = 1;
            $num_page = 1;
            $lpp      = $num_row;
            $start    = 0;
        }else{
            $num_page     = ceil($num_row/$lpp); 
            if($cur_page >= $num_page){
                $cur_page = $num_page;
                $lpp      = $num_row - ($num_page - 1) * $lpp_org;
            } 
            $start        = ($cur_page - 1) * $lpp_org;
        }
        return array(   'num_row'   =>$num_row,
                        'num_page'  =>$num_page,
                        'cur_page'  =>$cur_page,
                        'lpp'       =>$lpp_org,
                        'start_num' =>$start+1
                );

    }

	public function searchInvoice($curpage,$limit,$invoice_time,$invoice_branch,$invoice_customer,$invoice_code,$id)
    {
        $start_point=$limit*($curpage-1);
        $p     = new VInvoice;
        $count = 0;
        $q     = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();

        if($invoice_time) {       // thời gian
            if($invoice_time == 2) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($invoice_time == 3) {         // 7 ngày trước
                $time = date('Y-m-d',strtotime(date('Y-m-d') . ' - 7 day'));
                $v->addCondition('DATE(create_date) >= :create_date');
                $v->params = array(':create_date' => $time);
            }
            else {                               // tháng trước
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
        }

        if($invoice_branch) {         // văn phòng
            $v->addCondition('id_branch ='. $invoice_branch);
        }

        if($invoice_customer) {         // văn phòng
            $v->addCondition('id_customer = '. $invoice_customer);
        }

        if($invoice_code) {
            $v->addSearchCondition('id', $invoice_code, true);
        }

        if($id) {
        	$v->addCondition('id <> '. $id);
        }

        $v->addCondition('status >= 0');
    	$count=count($p->findAll($v));

        $paging    = $this->getPageSearch($curpage,$limit,$count);
        
        $v->order= 'id DESC';
        $v->limit = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'paging'=>$paging,'data'=>$data);
    }

     public function searchInvoiceForCus($curpage, $lpp, $id_customer) 
    {
        if(!$id_customer)
            return -1;

        $start_point = $lpp*($curpage-1);
      
        $p = new VInvoice;

        $v = new CDbCriteria(); 
        
        $v->addCondition("id_customer = $id_customer");

        $tolItem = count($p->findAll($v));
        $tolPage = ceil($tolItem/$lpp);
      
        $v->order= 'id DESC';
        $v->limit = $lpp;
        $v->offset = $start_point;

        $data = $p->findAll($v);

        return array('tolItem'=>$tolItem, 'tolPage'=>$tolPage, 'data'=>$data);
    }

     public function search_invoicedetail($curpage,$limit,$type,$branch,$search_time,$lstUser,$fromtime="",$totime="")
    {
         $start_point=$limit*($curpage-1);
        $p = new VInvoice;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        if($type==2){
        $v->addCondition('t.status >=0');
        }elseif($type==3){
             $v->addCondition('t.balance >0');
        }
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($search_time == 2) {         // trong tuan
                $time_fisrt = date('Y-m-d',strtotime('monday this week'));
                $time_last = date('Y-m-d',strtotime('sunday this week'));  
                $v->addCondition('DATE(create_date) >="'. $time_fisrt .'" AND DATE(create_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif($search_time == 4){
                $time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }elseif($search_time == 5){
                $v->addCondition('DATE(create_date) >="'. $fromtime .'" AND DATE(create_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }
               $count=count($p->findAll($v));

        $v->order= 'id ASC';
      
        $v->limit = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }


     public function search_exportinvoice($type,$branch,$search_time,$lstUser,$fromtime,$totime)
    {
        $p = new VInvoice;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        if($type==2){
        $v->addCondition('t.status >=0');
        }elseif($type==3){
             $v->addCondition('t.balance >0');
        }
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($search_time == 2) {         // 7 ngày trước
                $time_fisrt = date('Y-m-d',strtotime('monday this week'));
                $time_last = date('Y-m-d',strtotime('sunday this week'));  

                $v->addCondition('DATE(create_date) >="'. $time_fisrt .'" AND DATE(create_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif($search_time == 4){
                $time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }elseif($search_time == 5){
                $v->addCondition('DATE(create_date) >="'. $fromtime .'" AND DATE(create_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }
               $count=count($p->findAll($v));

        $v->order= 'id ASC';
     
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }
}
