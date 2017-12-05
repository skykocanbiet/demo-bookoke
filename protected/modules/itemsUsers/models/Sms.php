
<?php

/** 
 * This is the model class for table "sms". 
 * 
 * The followings are the available columns in table 'sms': 
 * @property integer $id
 * @property string $id_sms
 * @property integer $id_author
 * @property string $author
 * @property integer $id_customer
 * @property string $customer
 * @property string $phone
 * @property string $content
 * @property string $create_date
 * @property integer $type
 * @property string $id_schedule
 * @property integer $source
 * @property integer $status
 * @property integer $flag
 */ 
class Sms extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */
    public $sendSMSError = array(
         '0'   =>  'invalid username or password',
         '-1'   =>  'invalid brandname',
         '-2'   =>  'invalid phonenumber',
         '-3'   =>  'Brandname chua khai bao ',
         '-4'   =>  'Partner chua khai bao ',
         '-5'   =>  'template chua khai bao',
         '-6'   =>  'login telco system fail',
         '-7'   =>  'error sending sms to telco',
         '-100' =>  'database error',
         '1'    => 'success'
    );

    public function tableName() 
    { 
        return 'sms'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('id_author, id_customer, type, source, status, flag', 'numerical', 'integerOnly'=>true),
            array('id_sms, author, customer, content', 'length', 'max'=>255),
            array('phone, id_schedule', 'length', 'max'=>20),
            array('create_date', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, id_sms, id_author, author, id_customer, customer, phone, content, create_date, type, id_schedule, source, status, flag', 'safe', 'on'=>'search'),
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
            'id'          => 'ID',
            'id_sms'      => 'Id Sms',
            'id_author'   => 'Id Author',
            'author'      => 'Author',
            'id_customer' => 'Id Customer',
            'customer'    => 'Customer',
            'phone'       => 'Phone',
            'content'     => 'Content',
            'create_date' => 'Create Date',
            'type'        => 'Type',
            'id_schedule' => 'Id Schedule',
            'source'      => 'Source',
            'status'      => 'Status',
            'flag'        => 'Flag',
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
        $criteria->compare('id_sms',$this->id_sms,true);
        $criteria->compare('id_author',$this->id_author);
        $criteria->compare('author',$this->author,true);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('customer',$this->customer,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('type',$this->type);
        $criteria->compare('id_schedule',$this->id_schedule,true);
        $criteria->compare('source',$this->source);
        $criteria->compare('status',$this->status);
        $criteria->compare('flag',$this->flag);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return Sms the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    }

   function getSmsConnectInfo() {
        return array(
            'url'       => 'http://221.132.39.104:8083/bsmsws.asmx?wsdl',
            'username'  => 'bookokews',
            'password'  => 'Bo0k%K0ke!',
            'brandname' => 'BOOKOKE',
            'loaitin'   => 1
        );
    }
    
   /*
    * $type(loai tin nhan): 1: thong bao
    * $source (nguon gui): 1: nhan vien
    */
    function sendSms($phone, $text, $id_author, $author, $id_customer, $customer, $id_schedule, $type = 1, $source = 1)
    { 
        $soap = new SoapService();
        $smsResult = $soap->webservice_server_ws('sendSMS',array('1','317db7dbff3c4e6ec4bdd092f3b220a8',$phone, $text, $id_author, $author, $id_customer, $customer, $id_schedule, $type, $source ));

        $id_sms = 0;
        $status = 1;
        if($smsResult['status'] == 1){
            $id_sms = $smsResult['idSms'];
        }
        else {
            $status = $smsResult['status'];
        }
        
        $saveSMS = $this->saveSMS(array(
            'id_sms'      =>$id_sms,
            'id_author'   =>$id_author,
            'author'      =>$author,
            'phone'       =>$phone,
            'content'     =>$text,
            'type'        =>$type,
            'source'      =>$source,
            'status'      =>$status,             // trang thai tin nhan
            'id_customer' =>$id_customer,
            'customer'    =>$customer,
            'id_schedule' =>$id_schedule,
            'flag'        =>1               // 1: gui thanh cong, 
        ));
          
        return $status;
    }

    function saveSMS($smss = array('id_sms'=>'','id_author'=>'','author'=>'','phone'=>'','content'=>'','type'=>'','source'=>'','status'=>'','id_customer'=>'','customer'=>'', 'id_schedule'=>'','flag'=>1))
    {
        $sms                =   new Sms();
        $sms->attributes    =   $smss;
    
        if($sms->validate()) {
            return $sms->save();
        }
        return $sms->getErrors();
        return CActiveForm::validate($sms);
        return 0;
    }

    public function searchSms($curpage,$limit,$time,$phone,$ct)
    {
        $start_point = $limit*($curpage-1);
        
        $p           = new Sms;           
        $q           = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));

        $v     = new CDbCriteria();
        $v->addCondition('flag >= 0');
        if($time) {
            if($time == 2) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(create_date) = :create_date');
                $v->params = array(':create_date' => $time);
            }
            elseif ($time == 3) {         // 7 ngày trước
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
        if($phone) {
            $v->addSearchCondition('phone',$phone,true);
        }
        if($ct) {
            $v->addSearchCondition('content',$ct,true);
        }
        $count =count($p->findAll($v));
        
        $v->limit  = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);

        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }

    public function delSms($id)
    {
        return Sms::model()->updateByPk($id, array('flag' =>-1));
    }

}