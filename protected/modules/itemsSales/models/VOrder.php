<?php

/** 
 * This is the model class for table "v_order". 
 * 
 * The followings are the available columns in table 'v_order': 
 * @property integer $id
 * @property string $code
 * @property integer $id_quotation
 * @property string $code_quotation
 * @property integer $id_branch
 * @property string $branch_name
 * @property integer $id_customer
 * @property string $customer_name
 * @property integer $id_author
 * @property string $author_name
 * @property string $create_date
 * @property double $sum_amount
 * @property double $sum_tax
 * @property string $note
 * @property integer $status
 */ 
class VOrder extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'v_order'; 
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
            array('id, id_quotation, id_branch, id_customer, id_author, status', 'numerical', 'integerOnly'=>true),
            array('sum_amount, sum_tax', 'numerical'),
            array('code', 'length', 'max'=>45),
            array('code_quotation', 'length', 'max'=>20),
            array('branch_name, customer_name', 'length', 'max'=>255),
            array('author_name', 'length', 'max'=>128),
            array('create_date, note', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, code, id_quotation, code_quotation, id_branch, branch_name, id_customer, customer_name, id_author, author_name, create_date, sum_amount, sum_tax, note, status', 'safe', 'on'=>'search'),
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
            'id_branch' => 'Id Branch',
            'branch_name' => 'Branch Name',
            'id_customer' => 'Id Customer',
            'customer_name' => 'Customer Name',
            'id_author' => 'Id Author',
            'author_name' => 'Author Name',
            'create_date' => 'Create Date',
            'sum_amount' => 'Sum Amount',
            'sum_tax' => 'Sum Tax',
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
        $criteria->compare('id_quotation',$this->id_quotation);
        $criteria->compare('code_quotation',$this->code_quotation,true);
        $criteria->compare('id_branch',$this->id_branch);
        $criteria->compare('branch_name',$this->branch_name,true);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('customer_name',$this->customer_name,true);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('author_name',$this->author_name,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('sum_amount',$this->sum_amount);
        $criteria->compare('sum_tax',$this->sum_tax);
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
     * @return VOrder the static model class 
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

	public function searchOrder($curpage,$limit,$order_time,$order_branch,$order_customer,$order_code)
    {
        $start_point=$limit*($curpage-1);
        $p = new VOrder;           
        $q = new CDbCriteria(array(
        	'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        $v->addCondition('t.status >= 0');
        $time = 0;

        if($order_time) {       // thời gian
            if($order_time == 2) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($order_time == 3) {         // 7 ngày trước
                $time = date('Y-m-d',strtotime(date('Y-m-d') . ' - 7 day'));
                $v->addCondition('DATE(create_date) >= :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($order_time == 4) {         // tháng trước
                 $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
        }

        if($order_branch) {         // văn phòng
            $v->addCondition('id_branch ='. $order_branch);
        }

        if($order_customer) {         // văn phòng
            $v->addCondition('id_customer = '. $order_customer);
        }

        if($order_code) {
            $v->addSearchCondition('code', $order_code, true);
        }

        $count     = count($p->findAll($v));

        $paging    = $this->getPageSearch($curpage,$limit,$count);

        $v->order  = 'id DESC';
        $v->limit  = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'paging'=>$paging,'data'=>$data);
    }
}
