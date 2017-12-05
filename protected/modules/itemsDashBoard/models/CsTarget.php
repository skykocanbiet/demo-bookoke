<?php

/**
 * This is the model class for table "{{target}}".
 *
 * The followings are the available columns in table '{{target}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $year
 * @property integer $month
 * @property double $revenue_target
 * @property integer $new_account_target
 * @property integer $appointment_target
 * @property integer $worktime_target
 * @property string $description
 */
class CsTarget extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cs_target';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, year, month, new_account_target, appointment_target, revenue_target', 'required'),
            array('user_id, year, month, new_account_target, appointment_target, worktime_target', 'numerical', 'integerOnly'=>true),
            array('revenue_target', 'numerical'),
            array('description', 'safe'),
            array('user_id','ValidateUserExist'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, year, month, revenue_target, new_account_target, appointment_target, description', 'safe', 'on'=>'search'),
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
            'user_id' => 'User',
            'year' => 'Year',
            'month' => 'Month',
            'revenue_target' => 'Revenue Target',
            'new_account_target' => 'New Account Target',
            'appointment_target' => 'Appointment Target',
            'worktime_target'=> 'Work time Target',
            'description' => 'Description',
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('year',$this->year);
        $criteria->compare('month',$this->month);
        $criteria->compare('revenue_target',$this->revenue_target);
        $criteria->compare('new_account_target',$this->new_account_target);
        $criteria->compare('appointment_target',$this->appointment_target);
        $criteria->compare('worktime_target',$this->worktime_target);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CsTarget the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getListUsers(){
        return User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
    }
    public function getListMonths(){
        return Yii::app()->locale->getMonthNames();
    }
    public function ValidateUserExist($attribute,$params){
        if(empty($this->id)){
            $model = CsTarget::model()->findAllByAttributes(array('user_id'=>$this->user_id,'month'=>$this->month,'year'=>$this->year));
            if(count($model)>0){
                 $this->addError($attribute, 'Target for this User in this month already exist!');
            }
        }
    }
    
    public function AjaxSearch($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
    {
        $lpp_org = $lpp;
        $con     = Yii::app()->db;
        $sql     = "select count(*) from cs_target where 1 = 1";
        if($and_conditions and is_array($and_conditions)){
            foreach($and_conditions as $k => $v){
                $sql .= " and `$k` = '$v'";
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
  
        $sql = "select * from cs_target where 1 = 1";
        if($and_conditions and is_array($and_conditions)){
            foreach($and_conditions as $k => $v){
                $sql .= " and `$k` = '$v'";
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
    
    public function getDefaultTargetInfo($date_type = 'today',$from_day,$to_day,$id_user = "",$id_branch=''){
        
        if ($date_type == 'quarters'){
            $target = $this->getDefaultTargetQuartersInfo($from_day,$to_day,$id_user);    
        }else{

            $month             = date("m",strtotime($from_day));
            $year              = date("Y",strtotime($from_day));
            $toal_day_in_month = cal_days_in_month(CAL_GREGORIAN,$month,$year); // Tong so ngay trong thang 
            if($id_branch){
                if($id_user){
                    $target = Yii::app()->db->createCommand()
                    ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
                    ->from('cs_target')
                    ->leftJoin('gp_users', 'cs_target.user_id = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                    ->where('user_id=:user_id', array(':user_id'=>$id_user))
                    ->andwhere('id_branch=:id_branch', array(':id_branch'=>$id_branch))
                    ->andWhere('month=:month', array(':month'=>$month))
                    ->andWhere('year=:year', array(':year'=>$year))
                    ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
                    ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
                    ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
                    ->andWhere('worktime_target>:worktime_target', array(':worktime_target' => 0))
                    ->queryRow();
               }else {
                    $target = Yii::app()->db->createCommand()
                    ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
                    ->from('cs_target')
                    ->leftJoin('gp_users', 'cs_target.user_id = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                    ->where('id_branch=:id_branch', array(':id_branch'=>$id_branch))
                    ->andWhere('month=:month', array(':month'=>$month))
                    ->andWhere('year=:year', array(':year'=>$year))
                    ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
                    ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
                    ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
                    ->andWhere('worktime_target>:worktime_target', array(':worktime_target' => 0))
                    ->queryRow();
                }

         }else{
            if($id_user){
                    $target = Yii::app()->db->createCommand()
                    ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
                    ->from('cs_target')
                    ->leftJoin('gp_users', 'cs_target.user_id = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                    ->where('user_id=:user_id', array(':user_id'=>$id_user))
                    ->andWhere('month=:month', array(':month'=>$month))
                    ->andWhere('year=:year', array(':year'=>$year))
                    ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
                    ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
                    ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
                    ->andWhere('worktime_target>:worktime_target', array(':worktime_target' => 0))
                    ->queryRow();
               }else {
                $target = Yii::app()->db->createCommand()
                ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
                ->from('cs_target')
                ->where('month=:month', array(':month'=>$month))
                ->andWhere('year=:year', array(':year'=>$year))
                ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
                ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
                ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
                ->andWhere('worktime_target>:worktime_target', array(':worktime_target' => 0))
                ->queryRow();
            }
        }
            if($target['target_revenue'] || $target['target_new_account']  || $target['target_appointment'] ){
                if($date_type == 'today'){
                    $target['target_revenue']     =  $target['target_revenue']/$toal_day_in_month;
                    $target['target_new_account'] =  $target['target_new_account']/$toal_day_in_month;
                    $target['target_appointment'] =  $target['target_appointment']/$toal_day_in_month;
                    $target['target_rerformance'] =  $target['target_rerformance']/$toal_day_in_month; 
                }else if($date_type == 'week'){
                    $target['target_revenue']     =  $target['target_revenue']/4;
                    $target['target_new_account'] =  $target['target_new_account']/4;
                    $target['target_appointment'] =  $target['target_appointment']/4;
                    $target['target_rerformance'] =  $target['target_rerformance']/4;
                } 
            }
        }
        return $target;
    }
    public function getDefaultTargetQuartersInfo($from_day,$to_day,$id_user){
        
        $firstmonth        = date("m",strtotime($from_day));
        $year              = date("Y",strtotime($from_day));
        if($id_user){
            $target = Yii::app()->db->createCommand()
            ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
            ->from('cs_target')
            ->leftJoin('gp_users', 'cs_target.user_id = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('user_id=:user_id', array(':user_id'=>$id_user))
            ->andwhere(array('in', 'month', array($firstmonth,$firstmonth+1,$firstmonth+2)))
            ->andWhere('year=:year', array(':year'=>$year))
            ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
            ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
            ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
            ->queryRow();
        }else{
            $target = Yii::app()->db->createCommand()
            ->select('SUM(revenue_target) AS target_revenue,SUM(new_account_target) AS target_new_account,SUM(appointment_target) AS target_appointment,SUM(worktime_target) AS target_rerformance')
            ->from('cs_target')
            ->where('year=:year', array(':year'=>$year))
            ->andwhere(array('in', 'month', array($firstmonth,$firstmonth+1,$firstmonth+2)))
            ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
            ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
            ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
            ->queryRow();
        }
        return $target;
    } 
    public function getPresentRevenueDiscount($array_info){ //discount
        if($array_info['id_branch']){
            if($array_info['user_id']){
                return $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->leftJoin('v_invoice', 'v_invoice_detail.id_invoice = v_invoice.id')
                ->where('id_user=:id_user', array(':id_user'=>$array_info['user_id']))
                ->andwhere('v_invoice.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andWhere('v_invoice_detail.id_discount !=:id_discount', array(':id_discount'=>NULL))
                ->andWhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1)) 
                ->queryRow();
            }else{
                return $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->leftJoin('v_invoice', 'v_invoice_detail.id_invoice = v_invoice.id')
                ->where('v_invoice.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andwhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('v_invoice_detail.id_discount !=:id_discount', array(':id_discount'=>NULL))
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->andwhere(array('in', 'id_user',  $array_info['users']))
                ->queryRow();
            }
        }else{
            if($array_info['user_id']){
                return $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->where('id_user=:id_user', array(':id_user'=>$array_info['user_id']))
                ->andWhere('v_invoice_detail.id_discount !=:id_discount', array(':id_discount'=>NULL))
                ->andWhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1)) 
                ->queryRow();
            }else{
                return $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->where('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('v_invoice_detail.id_discount !=:id_discount', array(':id_discount'=>NULL))
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->andwhere(array('in', 'id_user',  $array_info['users']))
                ->queryRow();
            }
        }
    }
    public function getPresentInfoUser($array_info){
        
        $month              = date("m",strtotime($array_info['to']));
        $year               = date("Y",strtotime($array_info['to']));
        
        $array_info['users']= $this->ListUserTarget($month,$year);

        $PresentRevenue     = $this->getPresentRevenueCash($array_info);// Doanh thu 
        $PresentNewAccount  = $this->getPresentNewAccount($array_info);// Khach moi 
        $PresentSchedule    = $this->getPresentSchedule($array_info);//Lich hen 
        $PresentPerformance = $this->getPresentPerformance($array_info);// Hieu Xuat 
       
        return $data        = array_merge($PresentRevenue,$PresentNewAccount,$PresentSchedule,$PresentPerformance);
        
    }
    
    public function getPresentRevenueCash($array_info){// Doanh thu
        if($array_info['id_branch']){
            if($array_info['user_id']){
                 $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->leftJoin('v_invoice', 'v_invoice_detail.id_invoice = v_invoice.id')
                ->where('v_invoice_detail.id_user=:id_user', array(':id_user'=>$array_info['user_id']))
                ->andwhere('v_invoice.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andWhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('ISNULL(v_invoice_detail.id_discount)')
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->queryRow();
            }else{
               
                 $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->leftJoin('v_invoice', 'v_invoice_detail.id_invoice = v_invoice.id')
                ->where('v_invoice.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andwhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('ISNULL(v_invoice_detail.id_discount)')
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->andwhere(array('in', 'id_user',  $array_info['users']))
                ->queryRow();
            }
        }else{
            if($array_info['user_id']){
                 $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->where('v_invoice_detail.id_user=:id_user', array(':id_user'=>$array_info['user_id']))
                ->andWhere('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('ISNULL(v_invoice_detail.id_discount)')
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->queryRow();
            }else{
               
                 $data = Yii::app()->db->createCommand()
                ->select('SUM(amount) as present_revenue')
                ->from('v_invoice_detail')
                ->leftJoin('customer', 'v_invoice_detail.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
                ->where('v_invoice_detail.create_date>=:start', array(':start' => $array_info['from']))
                ->andWhere('v_invoice_detail.create_date<=:end', array(':end' => $array_info['to']))
                ->andWhere('ISNULL(v_invoice_detail.id_discount)')
                ->andWhere('v_invoice_detail.status<=:status', array(':status' => 1))
                ->andwhere(array('in', 'id_user',  $array_info['users']))
                ->queryRow();
            }
        }

        $discountPayment         = $this->getPresentRevenueDiscount($array_info);
        $cashPayment             = ($data['present_revenue']) - $discountPayment['present_revenue'];
        $data['present_revenue'] = $cashPayment;
        return $data;
    }

    public function getPresentNewAccount($array_info){ //khachhang
        if($array_info['id_branch']){
            if($array_info['user_id']){ 
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_new_account')
                ->from('customer')
                ->leftJoin('cs_schedule', 'customer.id = cs_schedule.id_customer AND cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                ->where('customer.status=:status', array(':status' => '1'))
                //them  vao
                ->andwhere('cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                //end
                ->andwhere('cs_schedule.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andWhere('customer.createdate>=:start', array(':start' => $array_info['from']))
                ->andWhere('customer.createdate<=:end', array(':end' => $array_info['to']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }else{
                //return $array_info['users'];
                return  $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_new_account')
                ->from('customer')
                ->leftJoin('cs_schedule', 'customer.id = cs_schedule.id_customer')
                ->where('customer.status=:status', array(':status' => '1'))
                ->andwhere('cs_schedule.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andWhere('customer.createdate>=:start', array(':start' => $array_info['from']))
                ->andWhere('customer.createdate<=:end', array(':end' => $array_info['to']))
                ->andwhere(array('in', 'cs_schedule.id_dentist',  $array_info['users']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }
        }else{
            if($array_info['user_id']){
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_new_account')
                ->from('customer')
                ->leftJoin('cs_schedule', 'customer.id = cs_schedule.id_customer AND cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                ->where('customer.status=:status', array(':status' => '1'))
                //them  vao
                ->andwhere('cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                //end
                ->andWhere('customer.createdate>=:start', array(':start' => $array_info['from']))
                ->andWhere('customer.createdate<=:end', array(':end' => $array_info['to']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }else{
                //return $array_info['users'];
                return  $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_new_account')
                ->from('customer')
                ->leftJoin('cs_schedule', 'customer.id = cs_schedule.id_customer')
                ->where('customer.status=:status', array(':status' => '1'))
                ->andWhere('customer.createdate>=:start', array(':start' => $array_info['from']))
                ->andWhere('customer.createdate<=:end', array(':end' => $array_info['to']))
                ->andwhere(array('in', 'cs_schedule.id_dentist',  $array_info['users']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }
        }
    }
 
    public function getPresentSchedule($array_info){ //lich hen (doi create_date thanh starttime)
        if($array_info['id_branch']){
            if($array_info['user_id']){
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_schedule')
                ->from('cs_schedule')
                ->leftJoin('gp_users', 'cs_schedule.id_dentist = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                ->where('cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                ->andwhere('cs_schedule.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andWhere('cs_schedule.start_time>=:start', array(':start' => $array_info['from']))
                ->andWhere('cs_schedule.start_time<=:end', array(':end' => $array_info['to']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }else{
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_schedule')
                ->from('cs_schedule')
                ->leftJoin('gp_users', 'cs_schedule.id_dentist = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                ->where('cs_schedule.id_branch=:id_branch', array(':id_branch'=>$array_info['id_branch']))
                ->andwhere('cs_schedule.start_time>=:start', array(':start' => $array_info['from']))
                ->andWhere('cs_schedule.start_time<=:end', array(':end' => $array_info['to']))
                ->andwhere(array('in', 'cs_schedule.id_dentist',  $array_info['users']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }
        }else{
           if($array_info['user_id']){
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_schedule')
                ->from('cs_schedule')
                ->leftJoin('gp_users', 'cs_schedule.id_dentist = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                ->where('cs_schedule.id_dentist=:id_dentist', array(':id_dentist'=>$array_info['user_id']))
                ->andWhere('cs_schedule.start_time>=:start', array(':start' => $array_info['from']))
                ->andWhere('cs_schedule.start_time<=:end', array(':end' => $array_info['to']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            }else{
                return $data = Yii::app()->db->createCommand()
                ->select('count(*) as present_schedule')
                ->from('cs_schedule')
                ->leftJoin('gp_users', 'cs_schedule.id_dentist = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
                ->andwhere('cs_schedule.start_time>=:start', array(':start' => $array_info['from']))
                ->andWhere('cs_schedule.start_time<=:end', array(':end' => $array_info['to']))
                ->andwhere(array('in', 'cs_schedule.id_dentist',  $array_info['users']))
                ->andwhere('cs_schedule.active=:active', array(':active' => '1'))
                ->queryRow();
            } 
        }

    }
    
    public function getPresentPerformance($array_info){ //hieu xuat
       if($array_info['id_branch']){
            if($array_info['user_id']){
                 $data = CsSchedule::model()->getSumSchedule($array_info['id_branch'],$array_info['user_id'],$array_info['from'],$array_info['to']);
                 return array('present_rerformance'=>$data);
            }else{
                //return $array_info;
                 $data = CsSchedule::model()->getSumSchedule($array_info['id_branch'],"",$array_info['from'],$array_info['to']);
                 return array('present_rerformance'=>$data);
            }
        }else
        {   if($array_info['user_id']){
                 $data = CsSchedule::model()->getSumSchedule('',$array_info['user_id'],$array_info['from'],$array_info['to']);
                 return array('present_rerformance'=>$data);
            }else{
              $data = CsSchedule::model()->getSumSchedule('',"",$array_info['from'],$array_info['to']);
              return array('present_rerformance'=>$data);
            }
        }
    }
    
    public function ListUserTarget($month,$year){
        $listUser =  $target = Yii::app()->db->createCommand()
            ->select('user_id')
            ->from('cs_target')
            ->where('month=:month', array(':month'=>$month))
            ->andWhere('year=:year', array(':year'=>$year))
            ->andWhere('revenue_target>:revenue_target', array(':revenue_target' => 0))
            ->andWhere('new_account_target>:new_account_target', array(':new_account_target' => 0))
            ->andWhere('appointment_target>:appointment_target', array(':appointment_target' => 0))
            ->queryColumn();
            return $listUser;

    }
    
    public function AutoSetTargetUser($id_user,$month,$year){
        $target = new CsTarget();
        $target->user_id = $id_user;
        $target->month   = $month;
        $target->year    = $year;
        $target->save(false);
    }
    public function GetUpdateChart(){
        $old_msg_id = $_GET['old_msg_id']; 
        $result = mysql_query("SELECT id FROM chatpoll ORDER BY id DESC LIMIT 1");
        while($row = mysql_fetch_array($result))
        {
            $last_msg_id = $row['id']; 
        }
        while($last_msg_id <= $old_msg_id)
        {
            usleep(1000);
            clearstatcache();
            $result = mysql_query("SELECT id FROM chatpoll ORDER BY id DESC LIMIT 1");
            while($row = mysql_fetch_array($result))
            {
                $last_msg_id = $row['id'];
            }
        }
        $response = array();
        $response['msg'] = 'new';
        $response['old_msg_id'] = $last_msg_id;
        echo json_encode($response);
    }
    public function GetNotificationsDashboard(){
        $fileSource       =  Yii::getPathOfAlias('webroot').'/notification.json'; 
        $jsonData         = array("current_time"=>strtotime(date('Y-m-d H:i:s')),"status"=>"1");
        file_put_contents($fileSource, json_encode($jsonData)); 
    }
    public function getPresentDay($array_info){
        $month              = date("m",strtotime($array_info['to']));
        $year               = date("Y",strtotime($array_info['to']));
        
        $array_info['users'] = $this->ListUserTarget($month,$year);
        $data['revenue']     = $this->getPresentDayRevenueCash($array_info);
        $data['newaccount']  = $this->getPresentDayNewAccount($array_info);
        $data['callsale']    = $this->getPresentDayCallsSale($array_info);
        return $data;      
    }
    public function getPresentDayRevenueCash($array_info){
        if($array_info['user_id']){
             $data = Yii::app()->db->createCommand()
            ->select('SUM(amount) as present_revenue, date')
            ->from('v_invoice')
            ->leftJoin('customer', 'v_invoice.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
            ->where('id_user=:id_user', array(':id_user'=>$array_info['user_id']))
            ->andWhere('payment_type !=:payment_type', array(':payment_type'=>'return'))
            ->andWhere('date>=:start', array(':start' => $array_info['from']))
            ->andWhere('date<=:end', array(':end' => $array_info['to']))

            ->andWhere('st<=:st', array(':st' => 2)) 
            ->group('CAST(`date` AS DATE)') 
            ->queryAll();
        }else{
             $data = Yii::app()->db->createCommand()
            ->select('SUM(amount) as present_revenue, date')
            ->from('v_invoice')
            ->leftJoin('gp_users', 'v_invoice.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->leftJoin('customer', 'v_invoice.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
            ->where('date>=:start', array(':start' => $array_info['from']))
            ->andWhere('date<=:end', array(':end' => $array_info['to']))

            ->andWhere('st<=:st', array(':st' => 2)) 
            ->andWhere('payment_type !=:payment_type', array(':payment_type'=>'return'))
            ->andwhere(array('in', 'id_user',  $array_info['users']))
            ->group('CAST(`date` AS DATE)')
            ->queryAll();
        }
        return $data;
    }
    
    public function getPresentDayNewAccount($array_info){
        if($array_info['user_id']){
            return $data = Yii::app()->db->createCommand()
            ->select('count(*) as present_new_account, create_date as date')
            ->from('customer')
            ->leftJoin('gp_users', 'customer.userid = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('userid=:id_user', array(':id_user'=>$array_info['user_id']))
            ->andWhere('status=:status', array(':status' => '1'))
            ->andWhere('create_date>=:start', array(':start' => $array_info['from']))
            ->andWhere('create_date<=:end', array(':end' => $array_info['to']))
            ->group('CAST(`create_date` AS DATE)')
            ->queryAll();
        }else{
            return $data = Yii::app()->db->createCommand()
            ->select('count(*) as present_new_account, create_date as date')
            ->from('customer')
            ->leftJoin('gp_users', 'customer.userid = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('status=:status', array(':status' => '1'))
            ->andWhere('create_date>=:start', array(':start' => $array_info['from']))
            ->andWhere('create_date<=:end', array(':end' => $array_info['to']))
            ->andwhere(array('in', 'userid',  $array_info['users']))
            ->group('CAST(`create_date` AS DATE)')
            ->queryAll();
        }
    }
    
    public function getPresentDayCallsSale($array_info){
        if($array_info['user_id']){
            return $data = Yii::app()->db->createCommand()
            ->select('count(*) as present_calls, call_date as date')
            ->from('cs_call')
            ->leftJoin('gp_users', 'cs_call.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('id_user=:id_user', array(':id_user'=>$array_info['user_id']))
            ->andWhere('call_date>=:start', array(':start' => $array_info['from']))
            ->andWhere('call_date<=:end', array(':end' => $array_info['to']))
            ->group('CAST(`call_date` AS DATE)')
            ->queryAll();
        }else{
            return $data = Yii::app()->db->createCommand()
            ->select('count(*) as present_calls, call_date as date')
            ->from('cs_call')
            ->leftJoin('gp_users', 'cs_call.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('call_date>=:start', array(':start' => $array_info['from']))
            ->andWhere('call_date<=:end', array(':end' => $array_info['to']))
            ->andwhere(array('in', 'id_user',  $array_info['users']))
            ->group('CAST(`call_date` AS DATE)')
            ->queryAll();
        }
    }
    public function getAllTickets($array_info){
        if($array_info['user_id']){
            return 0;
        }else{
            return 0;
        }
    }
    
    
    /** Perfozmance **/
    
    public function getPerfozmanceDefaultTarget($date_type = 'today',$from_day,$to_day,$id_user = ""){
        

        $month             = date("m",strtotime($from_day));
        $year              = date("Y",strtotime($from_day));
        $toal_day_in_month = cal_days_in_month(CAL_GREGORIAN,$month,$year); // Tong so ngay trong thang

        $target = Yii::app()->db->createCommand()
        ->select('cs_target.revenue_target AS target_revenue, cs_target.user_id,gp_users.name')
        ->from('cs_target')
        ->leftJoin('gp_users', 'gp_users.id = cs_target.user_id AND gp_users.group_id=:group', array(':group'=>3))
        ->where('cs_target.month=:month', array(':month'=>$month))
        ->andWhere('cs_target.year=:year', array(':year'=>$year))
        ->andWhere('cs_target.revenue_target>:revenue_target', array(':revenue_target' => 0))
        ->andWhere('cs_target.new_account_target>:new_account_target', array(':new_account_target' => 0))
        ->andWhere('cs_target.appointment_target>:appointment_target', array(':appointment_target' => 0))
        ->andWhere('cs_target.worktime_target>:worktime_target', array(':worktime_target' => 0))
        ->queryAll();
        
        $data = array();
        foreach($target as $k => $v )
        {
            if($v['target_revenue']  ){
                if($date_type == 'today'){
                    $data[$v['user_id']]['name']               =  $v['name'];
                    $data[$v['user_id']]['id_user']            =  $v['user_id'];
                    $data[$v['user_id']]['target_revenue']     =  round($v['target_revenue']/$toal_day_in_month,2);
                }else if($date_type == 'week'){
                    $data[$v['user_id']]['name']               =  $v['name'];
                    $data[$v['user_id']]['id_user']            =  $v['user_id'];
                    $data[$v['user_id']]['target_revenue']     =  round($v['target_revenue']/4,2);
                }else{
                    $data[$v['user_id']]['name']               =  $v['name'];
                    $data[$v['user_id']]['id_user']            =  $v['user_id'];
                    $data[$v['user_id']]['target_revenue']     =  round($v['target_revenue'],2);
                } 
            }
        }
        
        return $data;
    }
    public function getPerfozmancePresentInfoUser($array_info){
        
        $month              = date("m",strtotime($array_info['to']));
        $year               = date("Y",strtotime($array_info['to']));
        
        $array_info['users']= $this->ListUserTarget($month,$year);
        $PresentRevenue     = $this->getPerfozmancePresentRevenueCash($array_info);
        return $PresentRevenue  ;
    }
    
    public function getPerfozmancePresentCallsSale($array_info){
        $month              = date("m",strtotime($array_info['to']));
        $year               = date("Y",strtotime($array_info['to']));
        $array_info['users']= $this->ListUserTarget($month,$year);
        $calls = array();
        $data = Yii::app()->db->createCommand()
            ->select('count(*) as `calls`,id_user')
            ->from('cs_call')
            ->leftJoin('gp_users', 'cs_call.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
            ->where('call_date>=:start', array(':start' => $array_info['from']))
            ->andWhere('call_date<=:end', array(':end' => $array_info['to']))
            ->andwhere(array('in', 'id_user',  $array_info['users']))
            ->group('cs_call.id_user')
            ->queryAll();
            
        foreach($data as $k => $v){
            if($v['calls'] >= 1 ){
                $calls[$v['id_user']] = $v['calls'];
            }
            
        }
        return $calls;
        
    }
    public function getPerfozmancePresentRevenueCash($array_info){
        $Payment = array();
        $RevenueCash = Yii::app()->db->createCommand()
        ->select('SUM(amount) as present_revenue, id_user')
        ->from('v_order')
        ->leftJoin('gp_users', 'v_order.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
        ->leftJoin('customer', 'v_order.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
        ->where('date>=:start', array(':start' => $array_info['from']))
        ->andWhere('date<=:end', array(':end' => $array_info['to']))
        ->andWhere('payment_type !=:payment_type', array(':payment_type'=>'return'))

        ->andWhere('st<=:st', array(':st' => 2)) 
        ->andwhere(array('in', 'id_user',  $array_info['users']))
        ->group('v_order.id_user')
        ->queryAll();
        
        $returnPayment           = $this->getPerfozmancePresentRevenueReturn($array_info);
        
        $discountPayment         = $this->getPerfozmancePresentRevenueDiscount($array_info);

        
        if(count($returnPayment) == 0 && count($discountPayment)  == 0  ){
            foreach($RevenueCash as $k  => $v ){
                if($v['present_revenue']){
                    $Payment[$v['id_user']] = $v['present_revenue'];
                }
            }
            
        }else{
            foreach($RevenueCash as $k  => $v ){
                if($v['present_revenue']){
                    $key = $v['id_user'];
                    $Payment[$key] = $v['present_revenue'];
                    
                    if(array_key_exists($key,$returnPayment)){
                        $Payment[$key] = $Payment[$key]- $returnPayment[$key];
                    }
                    if( array_key_exists($key,$discountPayment)){
                        $Payment[$key] = $Payment[$key]- $discountPayment[$key]['present_revenue'];
                    }
                }
            }
        }
        return $Payment;
    }
    
    public function getPerfozmancePresentRevenueReturn($array_info){
        $data = array();
        $RevenueReturn = Yii::app()->db->createCommand()
        ->select('SUM(amount) as present_revenue, id_user')
        ->from('v_order')
        ->leftJoin('gp_users', 'v_order.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
        ->leftJoin('customer', 'v_order.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
        ->where('date>=:start', array(':start' => $array_info['from']))
        ->andWhere('date<=:end', array(':end' => $array_info['to']))
        ->andWhere('payment_type=:payment_type', array(':payment_type'=>'return'))

        ->andWhere('st<=:st', array(':st' => 2)) 
        ->andwhere(array('in', 'id_user',  $array_info['users']))
        ->group('v_order.id_user')
        ->queryAll();
        
        foreach($RevenueReturn as $k => $v){
            if($v['present_revenue'] >= 1 ){
                $data[$v['id_user']] = $v['present_revenue'];
            }
        }
        return $data;
    }
    
    public function getPerfozmancePresentRevenueDiscount($array_info){
        $data = array();
        $RevenueDiscount = Yii::app()->db->createCommand()
        ->select('SUM(discount) as present_revenue, id_user')
        ->from('v_order')
        ->leftJoin('gp_users', 'v_order.id_user = gp_users.id AND gp_users.group_id=:group', array(':group'=>3))
        ->leftJoin('customer', 'v_order.id_customer = customer.id AND customer.status=:status', array(':status'=>1))
        ->where('date>=:start', array(':start' => $array_info['from']))
        ->andWhere('date<=:end', array(':end' => $array_info['to']))
        ->andWhere('payment_type !=:payment_type', array(':payment_type'=>'return'))
        ->andWhere('st<=:st', array(':st' => 2)) 
        ->andWhere('discount>=:discount', array(':discount'=>0))
        ->andwhere(array('in', 'id_user',  $array_info['users']))
        ->group('v_order.id_user')
        ->queryAll();
        foreach($RevenueDiscount as $k => $v){
            if($v['present_revenue'] >= 1){
                $data[$v['id_user']] = $v['present_revenue'];
            }
        }
        return $data;
    }
}
