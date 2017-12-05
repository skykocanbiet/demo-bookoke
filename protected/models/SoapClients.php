	<?php 
class SoapClients 
{
    /** ----------- AGENT  ----------- **/
    public function checkAgentWs($id_agent,$haf_code){

        $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('ws_agent')
                ->where('id=:id', array(':id'=> $id_agent))
                ->andWhere('haf_code=:haf_code', array(':haf_code' => $haf_code))
                ->andWhere('status=:status', array(':status' => '1'))
                ->queryRow();

        if($data){ return true; }
    }

    public function checkInput($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }
    
    public function checkPhoneNumber($phone){
        $phone           = preg_replace("/[^0-9]/", "", $phone);
        $strlen_phone    = strlen($phone);

        if ($strlen_phone<10 || $strlen_phone>14) {
                return false;
        }

        $prefix_phone  = substr($phone, 0, 1);

        if($prefix_phone == "0"){
            $phone =  '84'.substr($phone,1,strlen($phone));
        }
        
        return $phone;
    }

    public function checkEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              return false;
        }
        return true;
    }

    /** ----------- Customer  ----------- **/
    public function checkRegisterCustomerLead($name,$email,$phone){

        if(!$name){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'name not invalid');
        }

        if(!$email){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'email not invalid');
        }else{

            $email = $this->checkInput($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              return  array('status' => 'Fail' ,'error'=>'0', 'error-message'=>'Invalid email format');
            }
        }

        if(!$phone){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'phone not invalid');
        }else{
            $phone = $this->checkPhoneNumber($phone);
            if($phone == false){
                array('status' => 'Fail','error'=>'0', 'error-message'=>'Invalid phone format');
            }
        }

        $Cus = Customer::model()->findAll('email=:st',array(':st'=>$email));

        if($Cus) 
        {
            return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'Email already exists '.$email);
        }
        

        if(CsLead::model()->findAll('phone=:phone',array(':phone'=>$phone)))
        {
            return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'phone already exists '.$phone);
            
        }

        return  array('status' => 'successful');
        // kiem tra email-> truy van DB duy nhat
        // kiem tra phone-> nam trong lead
         //return  array('status' => 'successful', 'data'=>$data);
         //return  array('status' => 'Fail', 'error-message'=>'Id not found!');

    }

    public function registerCustomerByDentist($id_company,$id_user,$fullname,$phone,$email,$gender,$birthdate,$identity_card_number,$address,$id_country,$note){

        if(!$id_user){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'id_user not invalid');
        }

        if(!$fullname){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'fullname not invalid');
        }

        if(!$phone){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'phone not invalid');
        }else{
            $phone = $this->checkPhoneNumber($phone);
            if($phone == false){
                array('status' => 'Fail','error'=>'0', 'error-message'=>'Invalid phone format');
            }
        }


        $email = $this->checkInput($email);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return  array('status' => 'Fail' ,'error'=>'0', 'error-message'=>'Invalid email format');
        }

        

        if(Customer::model()->findAll('email=:st',array(':st'=>$email)))
        {
            return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'Email already exists '.$email);
        }

        $data_phone = Customer::model()->findByAttributes(array('phone'=>$phone));

        if($data_phone){
            return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'Phone number exists!');
        }

        $transaction = Yii::app()->db->beginTransaction();
        try {

            $lead           = new CsLead;
            $lead ->phone   = $phone;

            if( $lead->validate() && $lead->save() ){

                $model                 = new Customer();
                $model->fullname       = $fullname;
                $model->phone          = $phone;
                $model->phone_sms      = $phone;
                $model->email          = $email;
                $model->address        = $address;
                $model->birthdate      = $birthdate;
                $model->identity_card_number    = $identity_card_number;
                $model->gender          = $gender;
                $model->code_number     = Customer::model()->getCodeNumberCustomer();
                $model->status          = 1;

                if($model->validate() && $model->save() ){

                    $cus_lead = CustomerLead::model()->getRelationshipLeadCustomer($lead->id,$model->id);

                    if($cus_lead){
                        $transaction ->commit();
                        return  array('status' => 'successful','data'=>array('id_customer'=>$model->id));
                    }

                    $model->delete();
                    $lead->delete();
                    throw new Exception('Add Relationship fail');

                }
                $lead->delete();
                throw new Exception('Add Customer fail'); // them khach hang that bai

            }

        throw new Exception('Add Lead phone fail');// them lead phone that bai


        } catch (Exception $e) {
            $transaction ->rollback();
            return  array('status' => 'Fail','error'=>'-3', 'error-message'=>$e->getMessage());
            Yii::app()->end();
        }  

    }


    public function registerCustomerLead($name,$email,$phone,$username,$password,$repeatpassword)
    {

        if(!$name){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'name not invalid');
        }

        if(!$email){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'email not invalid');
        }else{

            $email = $this->checkInput($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              return  array('status' => 'Fail' ,'error'=>'0', 'error-message'=>'Invalid email format');
            }
        }

        if(!$phone){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'phone not invalid');
        }else{
            $phone = $this->checkPhoneNumber($phone);
            if($phone == false){
                array('status' => 'Fail','error'=>'0', 'error-message'=>'Invalid phone format');
            }
        }

        if(!$password){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'password not invalid');
        }

        if(!$repeatpassword){
            return  array('status' => 'Fail','error'=>'0', 'error-message'=>'repeatpassword not invalid');
        }

        if($password != $repeatpassword){
            return  array('status' => 'Fail','error'=>'-3', 'error-message'=>'Please enter Confirm Password not invalid');
        }

        $cus = Customer::model()->findAll('phone=:phone',array(':phone'=>$phone));

        if($cus)
        {
            return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'phone already exists '.$phone);
            
        }

        $Cus = Customer::model()->findAll('email=:st',array(':st'=>$email));

        if($Cus) 
        {
            return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'Email already exists '.$email);
        }

        $model              = new Customer();
        $dataArray          = array('fullname'=>$name,'email'=>$email,'phone'=>$phone,'username'=>null,'password'=>$password,'code_number'=>null, 'code_number_old'=>null);

        $model->attributes  = $dataArray;

        $transaction = Yii::app()->db->beginTransaction();
        try {

            $lead           = new CsLead;
            $lead ->phone   = $lead->getVnPhone($phone);
        
            if( $lead->validate() && $lead->save() ){

                $model                 = new Customer();
                $model->attributes     = $dataArray;

                $model->phone          = $lead ->phone;
                $model->phone_sms      = $lead ->phone;
                $model->repeatpassword = $model->password;
                $model->password       = $model->password;
                $model->status         = 0;
                $model->code_confirm   = Sms::model()->getRandomeCodeNumber(4);
                
                if($model->validate() && $model->save() ){
                     

                    $cus_lead = CustomerLead::model()->getRelationshipLeadCustomer($lead->id,$model->id);

                    if($cus_lead){
                        $rs = $this->SendSMSCodeConfirmByCustomer($model->id,$model->fullname,$model->phone,$model->code_confirm);
                        if($rs){
                            $transaction ->commit();
                            return  array('status' => 'successful','data'=>array('id_customer'=>$model->id));
                            Yii::app()->end();
                        }
                        $model->delete();
                        $lead->delete();
                        throw new Exception('send sms fail');
                    }

                    $model->delete();
                    $lead->delete();
                    throw new Exception('Add Customer fail'); 
            
                    /*$chat   = new Chat();

                    $addchat   =  $chat->addUserChat($phone,md5($password),$name,$email);

                    if($addchat == "")
                    {
                        $namegroup       =  'BookOke Leads';
                        $addchatgroup    =   $chat->AddUserToGroup($phone,$namegroup);
                        if($addchatgroup == "")
                        {
                            $transaction ->commit();
                            
                            return  array('status' => 'successful','data'=>array('id_customer'=>$model->id));

                        }
                        throw new Exception('Add group chat fail');

                    }
                    throw new Exception('Add user chat fail'); //them user chat that bai*/

                }
                $lead->delete();
                throw new Exception('Add Customer fail'); // them khach hang that bai
           
            }
            
            throw new Exception('Add Lead phone fail');// them lead phone that bai
          

        } catch (Exception $e) {
            
            $transaction ->rollback();
            return  array('status' => 'Fail','error'=>'-5', 'error-message'=>$e->getMessage());
            Yii::app()->end();
        }    
            
    }
    public function deleteTransactionByCustomer($id_customer){

        $model  =   Customer::model();
        $transaction=$model->dbConnection->beginTransaction();
        try
        {
            // find and save are two steps which may be intervened by another request
            // we therefore use a transaction to ensure consistency and integrity
            $post=$model->findByPk($id_customer);

            if($post->delete()){
                $cus_lead = CustomerLead::model()->findByAttributes(array('id_customer'=>$id_customer));
                $lead     = CsLead::model()->findByPk($cus_lead->id_lead);
                if($cus_lead && $lead){
                    $cus_lead->delete();
                    $lead->delete();
                    $transaction->commit();
                    return  array('status' => 'successful','data'=>array('id_customer'=>''));
                    Yii::app()->end();

                }
            }
            throw new Exception('delete customer fail');

        }
        catch(Exception $e)
        {
            $transaction->rollback();
            return array('status'=>'Fail', 'error-message'=>$e->getMessage());
            Yii::app()->end();
        }

        return array('status'=>'Fail', 'error-message'=>'id_customer invalid');
    }

    public function forgotCustomerPassword($username){

        $code_confirm = Sms::model()->getRandomeCodeNumber(4);

        if($this->checkEmail($username)){
            $data = Customer::model()->findByAttributes(array('email'=>$username));
            if ($data) {
                $rs = Customer::model()->updateByPk($data->id,array("code_confirm"=>$code_confirm));
                return array('status'=>'successful','data'=>$rs);
            }
            return array('status'=>'Fail', 'error-message'=>'email invalid');
        }

        //dang nhap = phone
        $phone_number = $this->checkPhoneNumber($username);
        if($phone_number){
            $data = Customer::model()->findByAttributes(array('phone'=>$phone_number));
            if ($data) {
                $rs = Customer::model()->updateByPk($data->id,array("code_confirm"=>$code_confirm));

                $this->SendSMSCodeConfirmByCustomer($data->id,$data->fullname,$phone_number,$data->code_confirm);

                return array('status'=>'successful','data'=>array("id_customer"=>$data->id));
            }
        }
        return array('status'=>'Fail', 'error-message'=>'phone or email invalid');
    }

    public function checkForgotCustomerPassword($id_customer,$password,$code_confirm){

        $data   = Customer::model()->findByPk($id_customer);

        if(!$data){
            if($data->code_confirm = $code_confirm){
                $rs = Customer::model()->updateByPk($id_customer,array("password"=>$password));
                return  array('status' => 'successful','data'=>$rs);
            }
            return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'code_confirm invalid');
        }

       return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'id_customer not found');
    }
    
    public function SendSMSCodeConfirmByCustomer($id_customer,$name_customer,$phone,$code_confirm)
    {
       
        $text   = "BookOke thong bao ".$code_confirm." la ma kich hoat cua Quy Khach. Xin cam on!";
        //return $sms;
        $result = Sms::model()->sendSms($phone, $text, '', '', $id_customer, $name_customer, '', $type = 2, $source = 4);
        return $result;
    }

    public function returnConfirmationCodeByCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        $data           = Customer::model()->findByPk($id_customer);
        $code_confirm   = Sms::model()->getRandomeCodeNumber(4);

        if($data && $code_confirm){

            $text   = "BookOke thong bao ".$code_confirm." la ma kich hoat cua Quy Khach. Xin cam on!";

            $rs     = Customer::model()->updateByPk($id_customer,array("code_confirm"=>$code_confirm));

            $result = Sms::model()->sendSms($data->phone, $text, '', '', $id_customer, $data->fullname, '', $type = 2, $source = 4);

            return  array('status' => 'successful','data'=>$rs);
            
        }

        return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'id_customer not found');

        
    }

    public function CancelCodeConfirmByCustomer($id_customer)
    {
        if(!$id_customer){
             return  array('status' => 'Fail','error'=>'0', 'error-message'=>'id_customer not invalid');
        }
       
        $data   = Customer::model()->findByPk($id_customer);

        if($data){
            $rs = Customer::model()->updateByPk($id_customer,array("code_confirm"=>null));
            return  array('status' => 'successful','data'=>$rs);
        }

       return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'id_customer not found');
       
    }


    public function checkCodeConfirmByCustomer($id_customer,$code_confirm)
    {
        if(!$id_customer){
             return  array('status' => 'Fail','error'=>'0', 'error-message'=>'id_customer not invalid');
        }
        if(!$code_confirm){
             return  array('status' => 'Fail','error'=>'0', 'error-message'=>'code_confirm not invalid');
        }

        $data   = Customer::model()->findByPk($id_customer);

        if(!$data){
            return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'id_customer not found');
        }

        if($data->code_confirm == $code_confirm){

            $rs = Customer::model()->updateByPk($id_customer,array("status_confirm"=>1,"activedate"=>date("Y-m-d H:i:s")));

            if($rs){
                $chat      = new Chat();
                $addchat   =  $chat->addUserChat($data->phone,$data->password,$data->fullname,$data->email);

                if($addchat == "")
                {
                    $namegroup       =  'BookOke Leads';
                    $addchatgroup    =   $chat->AddUserToGroup($data->phone,$namegroup);
                    if($addchatgroup == "")
                    {
                        return  array('status' => 'successful','data'=>$rs);
                    }
                     return  array('status' => 'Fail','error'=>'-4','error-message'=>'Add chat group fail');
                }
                return  array('status' => 'Fail','error'=>'-3','error-message'=>'Add chat fail');
            }
            return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'update code_confirm fail');
        }
        return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'code_confirm invalid');
       
    }


     public function registerCustomerLeadFB($name,$email,$phone,$id_fb,$name_fb,$address,$id_gg,$name_gg)
    {
      
       
        $checkData = $this->checkRegisterCustomerLead($name,$email,$phone);

       // return $checkData;
        if($checkData['status']== 'Fail'){
            return $checkData;
        }

        $model              = new Customer();
        $dataArray          = array('fullname'=>$name,'email'=>$email,'phone'=>$phone,'code_number'=>null,'code_number_old'=>null,'id_fb'=>$id_fb,'name_fb'=>$name_fb,'address'=>$address,'id_gg'=>$id_gg,'name_gg'=>$name_gg);

        $model->attributes  = $dataArray;

        $transaction = Yii::app()->db->beginTransaction();
        try {

            $lead           = new CsLead;
            $lead ->phone   = $lead->getVnPhone($phone);
        
            if( $lead->validate() && $lead->save() ){

                $model                 = new Customer();
                $model->attributes     = $dataArray;

                $model->phone          = $phone;
                $model->phone_sms      = $phone;
                //$model->repeatpassword = md5($model->password);
                //$model->password       = md5($model->password);
                $model->status         = 0;
                
                if($model->validate() && $model->save() ){

                    CustomerLead::model()->getRelationshipLeadCustomer($lead->id,$model->id);
                    $id = $model->id;

                    $chat   = new Chat();
                    if($id_fb == null){
                        $username = $id_gg;
                    }else{
                        $username = $id_fb;
                    }
                    $password = 'callnex2017';
                    $addchat   =  $chat->addUserChat($username,md5($password),$name,$email);

                    if($addchat == "")
                    {
                        $namegroup       =  'BookOke Leads';
                        $addchatgroup    =   $chat->AddUserToGroup($username,$namegroup);
                        if($addchatgroup == "")
                        {
                           
                            $transaction ->commit();
                            return array('status' => 'successful','data'=>array('id'=>$model->id,'name'=>$model->name_fb));

                        }
                        throw new Exception('Add group chat fail');

                    }
                    throw new Exception('Add user chat fail'); //them user chat that bai

                }else{
                    $data = $lead->findAllByAttributes(array("id"=>$lead->id));
                    throw new Exception('Add Customer fail'); 
                }// tai sao luu khong duoc ma ko rollback ?
                throw new Exception('Add Customer fail'); // them khach hang that bai
           
            }
            throw new Exception('Add Lead phone fail');// them lead phone that bai
          

        } catch (Exception $e) {
             $transaction ->rollback();
             return  array('status' => 'Fail','error'=>'-5', 'error-message'=>$e->getMessage());
        }    

        //return  array('status' => 'successful');
        // exit();
            
    }
    public function registerCustomerChatLive($name,$email,$phone){

        $checkData = $this->checkRegisterCustomerLead($name,$email,$phone);

        if($checkData['status']== 'Fail' && $checkData['error']== '-1'){

            $Cus = Customer::model()->findAll('email=:st',array(':st'=>$email));

            return  array('status' => 'successful', 'data'=>$Cus);
        }

        if($checkData['status']== 'Fail'){
            return $checkData;
        }

        $username   = explode("@", $email);
        $username   = $username[0];
        $password   = "callnex2015";

        $dataArray  = array('fullname'=>$name,'email'=>$email,'phone'=>$phone,'username'=>$username,'password'=>$password,'code_number'=>null, 'code_number_old'=>null);

        $transaction = Yii::app()->db->beginTransaction();
        try {

            $lead           = new CsLead;
            $lead ->phone   = $lead->getVnPhone($phone);
        
            if($lead->validate() && $lead->save() ){

                $model                 = new Customer();
                $model->attributes     = $dataArray;

                $model->phone          = $phone;
                $model->phone_sms      = $phone;
                $model->repeatpassword = md5($model->password);
                $model->password       = md5($model->password);
                $model->status         = 0;
                
                if($model->validate() && $model->save() ){

                    CustomerLead::model()->getRelationshipLeadCustomer($lead->id,$model->id);

                    $chat   = new Chat();

                    $addchat   =  $chat->addUserChat($username,md5($password),$name,$email);

                    if($addchat == "")
                    {
                        $transaction ->commit();
                        return  array('status' => 'successful','data'=>array('username'=>$username,'password'=>md5($password)));

                       /* $namegroup       =  'BookOke Leads';
                        $addchatgroup    =   $chat->AddUserToGroup($username,$namegroup);
                        if($addchatgroup == "")
                        {
                            $transaction ->commit();
                            return  array('status' => 'successful','data'=>array('username'=>$username,'password'=>md5($password)));

                        }
                        throw new Exception('Add group chat fail');*/

                    }
                    throw new Exception('Add user chat fail'); //them user chat that bai

                }else{
                    $data = $lead->findAllByAttributes(array("id"=>$lead->id));
                    throw new Exception('Add Customer fail');

                }// tai sao luu khong duoc ma ko rollback ?
                throw new Exception('Add Customer fail'); // them khach hang that bai
            }
            throw new Exception('Add Lead phone fail');// them lead phone that bai
          

        } catch (Exception $e) {
             $transaction ->rollback();
             return  array('status' => 'Fail','error'=>'-5', 'error-message'=>$e->getMessage());
        }
        
    }

 
    public function getCustomerInformation($id){
       if($id){
            $dataInfo = array();

            $data = Yii::app()->db->createCommand()
                    ->select('*, DAY(birthdate) AS datebirth, MONTH(birthdate) AS monthbirth, YEAR(birthdate) AS yearbirth ')
                    ->from('customer')
                    ->where('customer.id=:id', array(':id'=> $id))
                    ->andWhere('status>=:status', array(':status' => '0'))
                    ->queryRow();

            $dataInfo =  $data;

            if ($data) {
                 $data_insurrance = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('cs_customer_insurrance')
                    ->where('cs_customer_insurrance.id_customer=:id_customer', array(':id_customer'=> $id))
                    ->queryRow();

                    if ($data_insurrance) {
                         $dataInfo['insurrance'] = $data_insurrance;
                    }else{
                        $dataInfo['insurrance'] = null;
                    }


                    $data_social = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('customer_relation_social')
                    ->where('customer_relation_social.customer_1=:customer_1', array(':customer_1'=> $id))
                    ->queryAll();

                    if ($data_social) {
                         $dataInfo['relation_social'] = $data_social;
                    }else{
                        $dataInfo['relation_social'] = null;
                    }

                    $data_family = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('customer_relationship')
                    ->where('customer_relationship.customer_1=:customer_1', array(':customer_1'=> $id))
                    ->queryAll();

                    if ($data_family) {
                         $dataInfo['relation_family'] = $data_family;
                    }else{
                        $dataInfo['relation_family'] = null;
                    }
                   
            }

            return  array('status' => 'successful', 'data'=>$dataInfo);
        }
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

     public function checkLoginCustomer($username,$password){
        
        if($username && $password){

            // dang nhap = email
            if($this->checkEmail($username)){
                $data = Customer::model()->findByAttributes(array('email'=>$username));
                if ($data) {
                    if($data->password == $password){
                        return array('status'=>'successful','data'=>$data);
                    }
                    return array('status'=>'Fail', 'error-message'=>'Password invalid');
                }
                return array('status'=>'Fail', 'error-message'=>'email invalid');
            }

            //dang nhap = phone
            $phone_number = $this->checkPhoneNumber($username);
            if($phone_number){
                $data = Customer::model()->findByAttributes(array('phone'=>$phone_number));
                if ($data) {
                    if($data->password == $password){
                        return array('status'=>'successful','data'=>$data);
                    }
                    return array('status'=>'Fail', 'error-message'=>'Password invalid');
                }
            }
            return array('status'=>'Fail', 'error-message'=>'phone or password invalid');
            
        }
        return  array('status' => 'Fail', 'error-message'=>'phone or email invalid');
    }

    public function updatePushIdOfCustomer($id_agent,$id,$device_id){
        // cap nhat loai thiet bi
        $device_type = 1;

        if($id_agent == 3){
            $device_type = 2;
        }

        if(!$id){
            return  array('status' => 'Fail', 'error-message'=>'id invalid!');
        }

        Customer::model()->updateByPk($id,array('device_id'=>$device_id,'device_type'=>$device_type));

        return  array('status' => 'successful', 'data'=>'1');

    }

    /* Alert History (Benh su y khoa))*/

    public function getListMedicineAlert(){

        $data = Customer::model()->getListMedicineAlert();

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Not Data found!');
        
    }
    public function getListMedicalHistoryAlertOfCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }
        
        $data = Customer::model()->getListMedicalHistoryAlertOfCustomer($id_customer);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Not Data found!');
        
    }

    public function getListMedicalHistoryAlertByIdCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }
        
        $data = Customer::model()->getListMedicalHistoryAlertByIdCustomer($id_customer);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Not Data found!');
        
    }

    public function addNewMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history,$id_dentist){


        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        if(!$id_dentist){
            return  array('status' => 'Fail', 'error-message'=>'id_dentist not invalid');
        }

        if(!$chk_medical_history){
            return  array('status' => 'Fail', 'error-message'=>'chk_medical_history not invalid');
        }

        if(!$ipt_medical_history){
            return  array('status' => 'Fail', 'error-message'=>'ipt_medical_history not invalid');
        }
        
        $data = Customer::model()->addNewMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history,$id_dentist);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');

    }


    public function updateMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history){


        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        if(!$chk_medical_history){
            return  array('status' => 'Fail', 'error-message'=>'id_dentist not invalid');
        }
        
        //$id_customer,$chk_medical_history,$ipt_medical_history
        $data = Customer::model()->updateMedicalHistoryAlert($id_customer,$chk_medical_history,$ipt_medical_history);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');

    }

    


    /* Treatment (Dot dieu tri)*/

    public function getListTreatmentGroupOfCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        $data = Customer::model()->getListMedicalHistoryGroupByCustomer($id_customer);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function checkTreatmentOfCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        $data = Customer::model()->checkTreatment($id_customer);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function addTreatmentOfCustomer($id_customer){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }

        $data = Customer::model()->addTreatment($id_customer);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    /* Treatment Process (Danh sach qua tri dieu tri) */
    public function getListTreatmentProcess($id_mhg){

        if(!$id_mhg){
            return  array('status' => 'Fail', 'error-message'=>'id_history_group not invalid');
        }

        $data = Customer::model()->getListTreatmentProcessOfCustomer($id_mhg);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function getListTooth($id_customer,$id_mhg){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }
        if(!$id_mhg){
            return  array('status' => 'Fail', 'error-message'=>'id_mhg not invalid');
        }        

        $data =  ToothData::model()->getListTooth($id_customer,$id_mhg);    
        
        return  array('status' => 'successful','data'=>$data); 

    }

    public function getListToothConcludeAndNote($id_customer,$id_mhg){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }
        if(!$id_mhg){
            return  array('status' => 'Fail', 'error-message'=>'id_mhg not invalid');
        }        

        $data =  ToothData::model()->getListToothConcludeAndNote($id_customer,$id_mhg);    
        
        return  array('status' => 'successful','data'=>$data); 

    }

    public function saveTooth($id_customer, $id_mhg, $tooth_data, $tooth_image, $tooth_conclude, $tooth_note){   
        
        if(!$id_customer) {
            return  array('status' => 'Fail', 'error-message'=>'id_customer not invalid');
        }   
        
        if(!$id_mhg) {
            return  array('status' => 'Fail', 'error-message'=>'id_mhg not invalid');
        }  
        
        if(!is_array($tooth_data)){
            $tooth_data =   json_decode($tooth_data);
        }
        
        if(!is_array($tooth_image)){
            $tooth_image =  json_decode($tooth_image);
        }
        
        if(!is_array($tooth_conclude)){
            $tooth_conclude =   json_decode($tooth_conclude);
        }
        
        if(!is_array($tooth_note)){
            $tooth_note =   json_decode($tooth_note);
        }      
        
        
        $data =  ToothData::model()->saveToothService($id_customer, $id_mhg, $tooth_data, $tooth_image, $tooth_conclude, $tooth_note);        
        
        
        return  array('status' => 'successful', 'data'=>$data);
    }

    public function addMedicalHistory($id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time,$session_add_prescription,$session_add_lab){
        
        if(!$id_history_group){
            return  array('status' => 'Fail', 'error-message'=>'id_history_group not invalid');
        }
        if(!$id_user ){
            return  array('status' => 'Fail', 'error-message'=>'id_user not invalid');
        }
        if(!$id_dentist ){
            return  array('status' => 'Fail', 'error-message'=>'id_dentist not invalid');
        }
        if(!$name ){
            return  array('status' => 'Fail', 'error-message'=>'name not invalid');
        }

        $data = Customer::model()->addMedicalHistory($id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time,$session_add_prescription,$session_add_lab);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function updateMedicalHistory($id_medical_history,$id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time){

        if(!$id_medical_history){
            return  array('status' => 'Fail', 'error-message'=>'id_medical_history not invalid');
        }   
        if(!$id_user ){
            return  array('status' => 'Fail', 'error-message'=>'id_user not invalid');
        }
        if(!$id_dentist ){
            return  array('status' => 'Fail', 'error-message'=>'id_dentist not invalid');
        }
        if(!$name ){
            return  array('status' => 'Fail', 'error-message'=>'name not invalid');
        }   

        $data = Customer::model()->updateMedicalHistory($id_medical_history,$id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function deleteMedicalHistory($id_medical_history){

        if(!$id_medical_history){
            return  array('status' => 'Fail', 'error-message'=>'id_history_group not invalid');
        }

        $data = Customer::model()->deleteMedicalHistory($id_medical_history);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function savePrescription($id_group_history,$id_medical_history,$diagnose,$drug_name,$times,$dosage,$advise,$examination_after){    
        
        if(!$id_group_history) {
            return  array('status' => 'Fail', 'error-message'=>'id_group_history not invalid');
        }  
    
        $data =  Customer::model()->savePrescription($savePrescription = array('id_group_history' => $id_group_history,'id_medical_history' => $id_medical_history, 'diagnose' => $diagnose, 'drug_name' => $drug_name, 'times' => $times, 'dosage' => $dosage, 'advise' => $advise, 'examination_after' => $examination_after));

        if($data <= 0){
            return  array('status' => 'Fail', 'error-message'=>$data);
        }

        return  array('status' => 'successful', 'data'=>$data);
    }

    public function saveLab($id_group_history,$id_medical_history,$id_branch,$id_dentist,$sent_date,$received_date,$assign,$note){    
        
        if(!$id_medical_history) {
            return  array('status' => 'Fail', 'error-message'=>'id_medical_history not invalid');
        }  
        
        $data =  Customer::model()->saveLab($saveLab = array('id_group_history' => $id_group_history,'id_medical_history' => $id_medical_history, 'id_branch' => $id_branch, 'id_dentist' => $id_dentist, 'sent_date' => $sent_date, 'received_date' => $received_date, 'assign' => $assign, 'note' => $note));

        if($data <= 0){
            return  array('status' => 'Fail', 'error-message'=>$data);
        }

        return  array('status' => 'successful', 'data'=>$data);
    }

    public function getEvaluateStateOfTartar($id_mhg){    
        
        if(!$id_mhg) {
            return  array('status' => 'Fail', 'error-message'=>'id_mhg not invalid');
        } 
        
        $data =  Customer::model()->getEvaluateStateOfTartar($id_mhg);

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }
    
    public function updateEvaluateStateOfTartar($id_mhg,$evaluate_state_of_tartar){    
        
        if(!$id_mhg) {
            return  array('status' => 'Fail', 'error-message'=>'id_mhg not invalid');
        } 
        
        if(!$evaluate_state_of_tartar) {
            return  array('status' => 'Fail', 'error-message'=>'evaluate_state_of_tartar not invalid');
        }
        
        $data =  Customer::model()->updateEvaluateStateOfTartar($id_mhg,$evaluate_state_of_tartar);

        if($data <= 0){
            return  array('status' => 'Fail', 'error-message'=>$data);
        }

        return  array('status' => 'successful', 'data'=>$data);
    }

    public function addNewCustomer($fullname,$phone){    
        
        if(!$fullname) {
            return  array('status' => 'Fail', 'error-message'=>'fullname not invalid');
        } 
        
        if(!$phone) {
            return  array('status' => 'Fail', 'error-message'=>'phone not invalid');
        }
        
        $data =  Customer::model()->addNewCustomer($fullname,$phone);

        if($data <= 0){
            return  array('status' => 'Fail', 'error-message'=>$data);
        }

        return  array('status' => 'successful', 'data'=>$data);
    }

    public function addCustomer($fullname,$email,$phone,$address,$organization,$note,$id_branch){    
        
        if(!$fullname) {
            return  array('status' => 'Fail', 'error-message'=>'fullname not invalid');
        }        
        
        if(!$phone) {
            return  array('status' => 'Fail', 'error-message'=>'phone not invalid');
        }  

        if(!$id_branch) {
            return  array('status' => 'Fail', 'error-message'=>'id_branch not invalid');
        }      
        
        $data =  Customer::model()->addCustomer($dataCustomer = array('username'=>'','password'=>'','repeatpassword'=>'','fullname'=>$fullname, 'address'=>$address, 'phone'=>$phone, 'phone_sms'=>'', 'email'=>$email, 'image'=>'', 'id_country'=>'', 'gender'=>'', 'birthdate'=>'', 'status'=>'1', 'identity_card_number'=>'', 'id_branch'=>$id_branch, 'organization'=>$organization, 'note'=>$note));

        if($data['status'] == 1){
            return  array('status' => 'successful', 'data'=>$data);
        }

        return  array('status' => 'Fail', 'error-message'=>$data);
    }

    public function getListCountry(){  
               
        $data =  Customer::model()->getListCountry();

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function getListSource(){  
               
        $data =  Customer::model()->getListSource();

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function getListSegment(){  
               
        $data =  Customer::model()->getListSegment();

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function getJob(){  
               
        $data =  Customer::model()->getJob();

        if($data){
            return  array('status' => 'successful', 'data'=>$data);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'Id not found!');
    }

    public function getListDentistForWorkTreatment(){    
        
        $data =  Customer::model()->getListDentists();        

        return  array('status' => 'successful', 'data'=>$data);
    }

    public function updateCustomer($id_user,$id_customer,$fullname,$phone,$email,$gender,$birthdate,$identity_card_number,$address,$id_country,$note){

            if(!$id_customer){
                return  array('status' => 'Fail','error'=>'0', 'error-message'=>'id_customer not invalid');
            }

            if(!$fullname){
                return  array('status' => 'Fail','error'=>'0', 'error-message'=>'fullname not invalid');
            }

            if(!$phone){
                return  array('status' => 'Fail','error'=>'0', 'error-message'=>'phone not invalid');
            }

            
            $model  = new Customer();
            $data   = $model->findByPk($id_customer);
            $lead   = "";
          

            if($data){
                $arayNew = array();

                 if($data->phone != $phone){
                    $cus_phonenew = Customer::model()->findByAttributes(array("phone"=>$phone));

                    if($cus_phonenew){
                        return  array('status' => 'Fail','error'=>'-2', 'error-message'=>'phone already exists '.$phone);
                    }

                    $lead       = CsLead::model()->findByAttributes(array("phone"=>$phone));
                    $arayNew['phone']  = $phone;
                }

                if( $email && $data->email != $email){

                    $email = $this->checkInput($email);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      return  array('status' => 'Fail' ,'error'=>'0', 'error-message'=>'Invalid email format');
                    }

                    if(Customer::model()->findAll('email=:st',array(':st'=>$email)))
                    {
                        return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'Email already exists '.$email);
                    }
                    $arayNew['email'] = $email;
                }

                if($data->fullname != $fullname){
                    $arayNew['fullname']  = $fullname;
                }

                if($data->gender != $gender){
                    $arayNew['gender']  = $gender;
                }

                if($data->birthdate != $birthdate){
                    $arayNew['birthdate']  = $birthdate;
                }

                if($data->id_country != $id_country){
                    $arayNew['id_country']  = $id_country;
                }

                if($data->identity_card_number != $identity_card_number){
                    $arayNew['identity_card_number']  = $identity_card_number;
                }

                if($data->address != $address){
                    $arayNew['address']  = $address;
                }

                if($data->note != $note){
                    $arayNew['note']  = $note;
                }

                if(!$arayNew){
                    return  array('status' => 'Fail','error'=>'-4', 'error-message'=>'Data not change');
                }

                $rs = Customer::model()->updateByPk($id_customer,$arayNew);

                $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('customer')
                ->where('customer.id=:id', array(':id'=> $id_customer))
                ->queryRow();

                if($rs){
                    if($lead){
                        $lead = CsLead::model()->updateByPk($lead->id,array("phone"=>$phone));

                    }
                    return  array('status' => 'successful', 'data'=>$data);
                }
                return  array('status' => 'successful','data'=>$data);

            }
            return  array('status' => 'Fail','error'=>'-3', 'error-message'=>'id_customer not found');

    }

     public function updateInsurranceCustomer($id_customer,$code_insurrance,$type_insurrance,$startdate,$enddate){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id not invalid');
        }

        $data  = CsCustomerInsurrance::model()->findByAttributes(array('id_customer'=>$id_customer,'status'=>1));


        if($data){ // da ton tai id_insurrance trong db

            $rs = CsCustomerInsurrance::model()->updateByPk($data->id, array('id_customer'=>$id_customer,'code_insurrance'=>$code_insurrance,'type_insurrance'=>$type_insurrance,'startdate'=>$startdate,'enddate'=>$enddate)); 

            return  array('status' => 'successful','data'=>$rs);

        }else{ // khong ton tai id_insurrance

            $model = new CsCustomerInsurrance();
            $model->id_customer         = $id_customer;
            $model->code_insurrance     = $code_insurrance;    
            $model->type_insurrance     = $type_insurrance;
            $model->startdate           = $startdate;
            $model->enddate             = $enddate;
            if ($model->save()) {
               return  array('status' => 'successful','data'=>array('id_insurrance'=>$model->id));
            }
           
        }

        return  array('status' => 'Fail','error'=>'-1','error-message'=>'update fail');


    }

    public function updateImageProfileCustomer($id_customer,$name_upload_old,$pEncodedString){

        if(!$id_customer){
            return  array('status' => 'Fail', 'error-message'=>'id not invalid');
        }

        $id_customer = (int)$id_customer;
        
        $pEncodedString = 'data:image/jpeg;base64,'.$pEncodedString;

        list($type, $pEncodedString)    = explode(';', $pEncodedString);
        list(,$extension)               = explode('/',$type);
        list(,$pEncodedString)          = explode(',', $pEncodedString);

        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' ||  $extension == 'gif'){

            $imageNameUpload       = date("dmYHis").'.'.$extension;

            $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/customer/avatar/'.$imageNameUpload;

            $filesize = file_put_contents($imageUploadSource, base64_decode($pEncodedString));

            if($filesize){
                

                $cus = Customer::model()->updateByPk($id_customer,array("image"=>$imageNameUpload));

                if($name_upload_old && $cus){
                    unlink(Yii::getPathOfAlias('webroot').'/upload/customer/avatar/'.$name_upload_old);
                }

                if($cus){
                    return  array('status' => 'successful','data'=>$imageNameUpload);
                }

                
            }
            return  array('status' => 'Fail','error'=>'-2','error-message'=>'upload fail');

        }

        return  array('status' => 'Fail','error'=>'-1','error-message'=>'image64 invalid .determine image type png | jpg | jpeg | gif');

    }

    public function getListSearchCustomers($cur_page,$lpp,$name_sup,$code_number,$email,$phone,$birthdate,$identity_card_number,$status){

        if(!$cur_page || !$lpp){
            return  array('status' => 'Fail', 'error-message'=>'cur_page or lpp not invalid');
        }
        if($lpp > 20){
            $lpp = 20;
        }

        $model         = new Customer;
        $search_params = '';    
        $orderBy       = '`fullname` ASC ,`code_number` DESC ';
        

        if($status == '' || $status == null ){
            $search_params   = 'AND `customer`.`status` >= 0 ';
        }else{
            $search_params   = 'AND `customer`.`status` = '.$status.' ';
        }

        if ($name_sup) 
        {
            $search_params   .= 'AND ( (`fullname` LIKE "%'.$name_sup.'%" ) OR (`code_number` LIKE "%'.$name_sup.'%" ) ) ';
        }
        
        if($email){
             $search_params .= 'AND ( `email` LIKE "%'.$email.'%" ) ';
        }

        if($phone){
             $search_params .= 'AND ( `phone` LIKE "%'.$phone.'%" ) ';
        }

        if($birthdate){
             $search_params .= 'AND ( `birthdate` LIKE "%'.$birthdate.'%" ) ';
        }

        if($identity_card_number){
             $search_params .= 'AND ( `identity_card_number` LIKE "%'.$identity_card_number.'%" ) ';
        }

        $data  = $model->searchCustomers('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);

        return  array('status' => 'successful','paging'=>$data['paging'], 'data'=>$data['data']);        
    }


    public function getListSearchCustomersAppointment($cur_page,$lpp,$id_user,$name_sup,$status){

        
        if(!$cur_page || !$lpp){
            return  array('status' => 'Fail', 'error-message'=>'cur_page or lpp not invalid');
        }

        if(!$id_user){
            return  array('status' => 'Fail', 'error-message'=>'id_user not invalid');
        }

        $user = GpUsers::model()->findByPk($id_user);

        if ($user && $user->group_id == 3) {
             $id_dentist  = $id_user;
        }else{
            $id_dentist = '';
        }

        if($id_dentist){

            if($status == '' || $status == 0){
                
                    $num_row= Yii::app()->db->createCommand()
                    ->select('Count(*)')
                    ->from('v_schedule')
                    ->where('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                    ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
                    ->group('v_schedule.id_customer')
                    ->order('v_schedule.start_time ASC')            
                    ->queryAll();

                    $num_row =count($num_row);

                    if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                            
                    $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
                    

                    $data   = Yii::app()->db->createCommand()
                            ->select('v_schedule.id as id_schedule, v_schedule.code_schedule, v_schedule.id_customer, v_schedule.fullname, v_schedule.phone, v_schedule.image_customer,v_schedule.status_customer, v_schedule.status')
                            ->from('v_schedule')
                            ->where('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                            ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
                            ->group('v_schedule.id_customer')
                            ->order('v_schedule.start_time ASC')
                            ->limit($lpp, $paging['start_num'] - 1)
                            ->queryAll();
                         
                     return  array('status' => 'successful', 'paging'=>$paging, 'data'=>$data);

            }elseif($status){
                
                    $num_row= Yii::app()->db->createCommand()
                    ->select('Count(*)')
                    ->from('v_schedule')
                    ->where('v_schedule.status=:st1', array(':st1'=>$status))
                    ->andWhere('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                    ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
                    ->group('v_schedule.id_customer')
                    ->order('v_schedule.start_time ASC')            
                    ->queryAll();

                    $num_row =count($num_row);

                    if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                            
                    $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
                    
                    $data   = Yii::app()->db->createCommand()
                            ->select('v_schedule.id as v_schedule.id_schedule, v_schedule.code_schedule, v_schedule.id_customer, v_schedule.fullname, v_schedule.phone, v_schedule.image_customer,v_schedule.status_customer, v_schedule.status')
                            ->from('v_schedule')
                            ->where('v_schedule.status=:st1', array(':st1'=>$status))
                            ->andWhere('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                            ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
                            ->group('v_schedule.id_customer')
                            ->order('v_schedule.start_time ASC')
                            ->limit($lpp, $paging['start_num'] - 1)
                            ->queryAll();
                         
                     return  array('status' => 'successful', 'paging'=>$paging, 'data'=>$data);

            }

            
        }else{

              $num_row= Yii::app()->db->createCommand()
            ->select('Count(*)')
            ->from('v_schedule')
            ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
            ->group('v_schedule.id_customer')
            ->order('v_schedule.start_time ASC')            
            ->queryAll();

            $num_row =count($num_row);

            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('v_schedule.id as id_schedule, v_schedule.code_schedule, v_schedule.id_customer, v_schedule.fullname, v_schedule.phone, v_schedule.image_customer,v_schedule.status_customer, v_schedule.status')
                    ->from('v_schedule')
                    ->andWhere('v_schedule.fullname LIKE :fullname OR v_schedule.phone LIKE :phone OR v_schedule.code_number LIKE :code_number'  , array(':fullname'=>'%'.$name_sup.'%', ':phone'=>'%'.$name_sup.'%', ':code_number'=>'%'.$name_sup.'%'))
                    ->group('v_schedule.id_customer')
                    ->order('v_schedule.start_time ASC')
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();
                 
             return  array('status' => 'successful', 'paging'=>$paging, 'data'=>$data); 
        }

         
    }
    
    /** ----------- USER  ----------- **/

    public function LoginUser($username,$password){
  
        if($username && $password){

            $model          = new LoginUserForm;

            $model->username = $username;

            $model->password = $password;

            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login()){
                

                return  array('status' => 'successful', 'data'=>Yii::app()->user->id);
            }
        }
        return  array('status' => 'Fail', 'error-message'=>json_encode($model->errors));
    }

    public function checkLoginUser($code){
        
        if($code){
            
            $data = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('gp_users')
                    ->where('code=:code', array(':code'=> $code))
                    ->queryRow();
            
            if($data){
               
                 if($data['block']){
                    return  array('status' => 'Fail', 'error-message'=>'username was block!');
                 }

                 return  array('status' => 'successful', 'data'=>$data);
            }
        }
        return  array('status' => 'Fail', 'error-message'=>'username or password invalid');
    }

    public function updatePushIdOfAccount($id_agent,$id_user,$device_id){
        // cap nhat loai thiet bi
        $device_type = 1;

        if($id_agent == 3){
            $device_type = 2;
        }

        if(!$id_user){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid!');
        }

        GpUsers::model()->updateByPk($id_user,array('device_id'=>$device_id,'device_type'=>$device_type));

        return  array('status' => 'successful', 'data'=>'1');

    }

    public function getListSearchDentists($id_branch,$id_service){

        $data = VServicesHours::model()->getDentistWork($id_branch,$id_service);

        return  array('status' => 'successful', 'data'=>$data); 

    }

    public function getListDentist($searchDentist, $lpp='10', $cur_page='1'){

        $search_params = 'AND (`name` LIKE "%'.$searchDentist.'%" ) AND group_id = 3';

        $data = GpUsers::model()->searchStaffs('','',' '. $search_params, $lpp, $cur_page);

        return  array('status' => 'successful', 'data'=>$data); 
    }

    public function getListSearchUsers($cur_page,$lpp,$group_id,$id_user,$username,$name){

       if($id_user){
            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('gp_users')
                ->where('gp_users.id=:id', array(':id' => $id_user))
                ->andWhere('gp_users.block=:block', array(':block' => 0))
                ->andWhere('gp_users.username LIKE :username'  , array(':username'=>'%'.$username.'%'))
                ->andWhere('gp_users.name LIKE :name'  , array(':name'=>'%'.$name.'%'))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('id,name')
                    ->from('gp_users')
                    ->where('gp_users.id=:id', array(':id' => $id_user))
                    ->andWhere('gp_users.block=:block', array(':block' => 0))
                    ->andWhere('gp_users.username LIKE :username'  , array(':username'=>'%'.$username.'%'))
                    ->andWhere('gp_users.name LIKE :name'  , array(':name'=>'%'.$name.'%'))
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();
         }else{
            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('gp_users')
                ->where('gp_users.block=:block', array(':block' => 0))
                ->andWhere('gp_users.username LIKE :username'  , array(':username'=>'%'.$username.'%'))
                ->andWhere('gp_users.name LIKE :name'  , array(':name'=>'%'.$name.'%'))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('id,name')
                    ->from('gp_users')
                    ->where('gp_users.block=:block', array(':block' => 0))
                    ->andWhere('gp_users.username LIKE :username'  , array(':username'=>'%'.$username.'%'))
                    ->andWhere('gp_users.name LIKE :name'  , array(':name'=>'%'.$name.'%'))
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();
         }

        return  array('status' => 'successful','paging'=>$paging, 'data'=>$data);

    }

    /** ----------- SCHEDULES  ----------- **/
    //getBlankTime($id_branch,$id_service,$id_dentist='',$start_date,$end_date) 
    
    public function getBlankTime($id_branch,$id_service,$id_dentist,$start_date,$end_date){
         return array('status' => 'successful', 'data'=>CsSchedule::model()->getBlankTime($id_branch,$id_service,$id_dentist,$start_date,$end_date));
    }

    // getDentistServices($curpage=1,$id_dentist=0,$searchService)
    public function getDentistServices($curpage,$id_dentist,$searchService)
    {
        return array('status' => 'successful', 'data'=>CsSchedule::model()->getDentistServices($curpage,$id_dentist,$searchService));
    }

    public function checkScheduleTime($id_dentist,$time_start,$time_end,$id_schedule = 0)
    {
        if(!$id_dentist) {
            return  array('status' => 'Fail', 'error-message'=>'-4');           // ko co nha sy
        }

        $start  = DateTime::createFromFormat('Y-m-d H:i:s', $time_start)->format('Y-m-d H:i:s');
        $end    = DateTime::createFromFormat('Y-m-d H:i:s', $time_end)->format('Y-m-d H:i:s');

        if(!$start || !$end) {
            return  array('status' => 'Fail', 'error-message'=>'-3');           // dinh dang thoi gian ko dung
        }

        $wt     = CsSchedule::model()->checkWorkingTime($id_dentist,$start,$end);
        if(!$wt) {
            return  array('status' => 'Fail', 'error-message'=>'-2');           // nha sy ko co thoi gian lam viec
        }

        $sch    =  CsSchedule::model()->checkScheduleEvent($start,$end,$id_dentist,$id_schedule);
        if(!$sch) {
            return  array('status' => 'Fail', 'error-message'=>'-1');           // co lich hen trung
        }

        return array('status' => 'successful', 'data'=>'1');
    }


    public function getListSearchSchedules($cur_page,$lpp,$id_dentist,$id_service,$start_time,$end_time){
        
        if(!$cur_page || !$lpp){
            return  array('status' => 'Fail', 'error-message'=>'cur_page or lpp invalid');
        }

        if($id_dentist){
            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('v_schedule')
                ->where('v_schedule.status>=:status', array(':status' => 0))
                ->andWhere('v_schedule.status_active=:status_active', array(':status_active' => 1))
                ->andWhere('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                ->andWhere('v_schedule.start_time>=:start', array(':start' => $start_time.' 00:00:00'))
                    ->andWhere('v_schedule.start_time<=:end', array(':end' => $end_time.' 23:59:59'))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('v_schedule')
                    ->where('v_schedule.status>=:status', array(':status' => 0))
                    ->andWhere('v_schedule.status_active=:status_active', array(':status_active' => 1))
                    ->andWhere('v_schedule.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                    ->andWhere('v_schedule.start_time>=:start', array(':start' => $start_time.' 00:00:00'))
                    ->andWhere('v_schedule.start_time<=:end', array(':end' => $end_time.' 23:59:59'))
                    ->order('v_schedule.start_time ASC')
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();

             return  array('status' => 'successful','paging'=>$paging, 'data'=>$data);
         }else{

            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('v_schedule')
                ->where('v_schedule.status>=:status', array(':status' => 0))
                ->andWhere('v_schedule.status_active=:status_active', array(':status_active' => 1))
                ->andWhere('v_schedule.start_time>=:start', array(':start' => $start_time.' 00:00:00'))
                ->andWhere('v_schedule.start_time<=:end', array(':end' => $end_time.' 23:59:59'))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('v_schedule')
                    ->where('v_schedule.status>=:status', array(':status' => 0))
                    ->andWhere('v_schedule.status_active=:status_active', array(':status_active' => 1))
                    ->andWhere('v_schedule.start_time>=:start', array(':start' => $start_time.' 00:00:00'))
                    ->andWhere('v_schedule.start_time<=:end', array(':end' => $end_time.' 23:59:59'))
                    ->order('v_schedule.start_time ASC')
                    //->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();

             return  array('status' => 'successful','paging'=>$paging, 'data'=>$data);

         }
         return  array('status' => 'Fail', 'error-message'=>'id_dentist invalid');
    }

    public function getDetailSchedule($id_Schedule){

        if(!$id_Schedule || $id_Schedule == 0 || $id_Schedule == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_Schedule invalid');
        }

        $data = VSchedule::model()->findByAttributes(array("id"=>$id_Schedule));

        return  array('status' => 'successful', 'data'=>$data);

    }


    // tao lich hen
    // $id_cus = 0: khach hang moi
    public function addNewAppointment($id_cus = 0,$sch, $cus, $al){

       

        if(!is_array($sch))
            return  array('status' => 0, 'error-message'=>'schedule invalid');

        // dang ki hay cap nhat khach hang moi $sch
        if($id_cus == 0) {       // khong co ma khach hang
            if(!is_array($cus))
                return  array('status' => 0, 'error-message'=>'customer invalid');

            $customer = Customer::model()->addCustomer(array(
                'fullname'             =>$cus['fullname'],
                'phone'                =>$cus['phone'],
                'email'                =>$cus['email'],
                'gender'               =>$cus['gender'],
                'birthdate'            =>$cus['birthdate'],
                'id_country'           =>$cus['id_country'],
                'identity_card_number' =>$cus['identity_card_number'],
                'image'                =>$cus['image'],
                'status'               =>'1',
            ));

            if(!isset($customer['status'])) {
                return  array('status' => 0, 'error-message'=> $customer);
            }
            else
                $id_cus = $customer['data']->id;
        }
        else {          // co ma khach hang
            $customer = Customer::model()->findByPk($id_cus);
            if(!$customer)
                return array('status' => 0, 'error-message'=> 'id_customer invalid');
        }

        // tao lich hen $sch
        $schedule =  CsSchedule::model()->addNewScheduleCheck(array(
                'id_customer' => $id_cus,
                'code'        => '',
                'id_dentist'  => $sch['id_dentist'],
                'id_author'   => $sch['id_author'],
                'id_branch'   => $sch['id_branch'],
                'id_chair'    => $sch['id_chair'],
                'id_service'  => $sch['id_service'],
                'lenght'      => $sch['lenght'],
                'start_time'  => $sch['start_time'],
                'end_time'    => $sch['end_time'],
                'status'      => $sch['status'],
                'active'      => 1,
                'note'        => $sch['note'],
            ));

        if($schedule['status'] != 1) {
             return $schedule;
        }



        // tao benh su y khoa
        if($al){
            $alCK = array();
            $alNo = array();
            foreach ($al as $key => $value) {
                $alCk[] = $key;
                $alNo[] = $value;
            }
            $al = Customer::model()->addNewMedicalHistoryAlert($id_cus,$alCk,$alNo,$sch['id_dentist']);
        }

         //$data = $this->getAddCsNotiSchedule('74','75',45,"add");

        //return array('status' => 1, 'success'=>$schedule['success']['id']);

        //$id_author,$id_dentist,$result_id,$action
        $this->getAddCsNotiSchedule($sch['id_author'],$sch['id_dentist'],$schedule['success']['id'],"add");

        return array('status' => 1, 'success'=> $schedule['success']);

    }
    
    //array('id'=>'', 'id_dentist'=>'', 'id_branch'=>'', 'id_chair'=>'', 'id_service'=>'',
    // 'lenght' => '', 'start_time'=>'', 'end_time'=>'', '$status'=>'', 'active'=>'', 'note'=>'')

    public function updateScheduleAppointment($id_Schedule, $id_dentist, $id_branch, $id_chair, $id_service,$lenght='', $start_time, $end_time,$status,$active,$note, $id_author){

        if(!$id_Schedule || $id_Schedule == 0 || $id_Schedule == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_Schedule invalid');
        }
        if(!$id_dentist || $id_dentist == 0 || $id_dentist == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_dentist invalid');
        }
        if(!$id_service || $id_service == 0 || $id_service == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_service invalid');
        }
        if(!$id_branch || $id_branch == 0 || $id_branch == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_customer invalid');
        }
        if(!$start_time || $start_time == 0 || $start_time == ''){
            return  array('status' => 'Fail', 'error-message'=>'start_time invalid');
        }
        if(!$end_time || $end_time == 0 || $end_time == ''){
            return  array('status' => 'Fail', 'error-message'=>'end_time invalid');
        }

        // Update Schedule
        $result =  CsSchedule::model()->updateScheduleCheck($updateSchedule = array(
            'id'=>$id_Schedule, 'id_dentist'=>$id_dentist, 'id_branch'=> $id_branch, 
            'id_chair'=>'0', 'id_service'=>$id_service, 'lenght' => $lenght, 
            'start_time'=>$start_time, 'end_time'=>$end_time, 'status'=>$status, 
            'active'=>$active, 'note'=>$note
        ));

        if($result['status'] == 1){

            if(!$id_author){
                $id_author = $result['success']['id_author'];
            }

            return $this->getAddCsNotiSchedule($id_author,$id_dentist,$id_Schedule,"update");

            return  array('status' => 'successful', 'data'=>1); 
        }

        return  array('status' => 'Fail', 'error-message'=>$result['error-message']);
        
    }

    /** ----------- SERVICES  ----------- **/
    public function getListSearchServices($id_branch,$code,$name_sub,$price){

        $data = VServicesHours::model()->getServiceList();

        return  array('status' => 'successful', 'data'=>$data);

    }

    public function getListServices($curpage=1,$numPerPage=10,$id_service_type=0,$searchService){

        $data = CsService::model()->service_list_pagination($curpage,$numPerPage,$id_service_type,$searchService);

        return  array('status' => 'successful', 'numRow'=>$data['numRow'], 'numPage'=>$data['numPage'], 'data'=>$data['data']);

    }

    public function getListGroupServices($curpage=1,$numPerPage=10,$searchGroupService){

        $data = CsServiceType::model()->searchGroupServices($curpage,$numPerPage,$searchGroupService);

        return  array('status' => 'successful', 'numRow'=>$data['numRow'], 'numPage'=>$data['numPage'], 'data'=>$data['data']);

    }

    /** ----------- BRANCH  ----------- **/
    public function getListSearchBranchs($country,$city,$name_sub,$address){

             $data   = Yii::app()->db->createCommand()
                ->select('*')
                ->from('branch')
                ->where('branch.status=:status', array(':status' => 1))
                ->andWhere('branch.name LIKE :name'  , array(':name'=>'%'.$name_sub.'%'))
                ->order('branch.name')
                ->queryAll();

            return  array('status' => 'successful', 'data'=>$data);
    }
    

    /** ----------- Notifications  ----------- **/

    public function getListNotifications($cur_page="1",$lpp="10",$id_dentist){
        $user = GpUsers::model()->findByPk($id_dentist);

        if($user && $user->group_id == 3){

            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('v_notification')
                ->where('v_notification.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                ->andWhere('v_notification.status=:status', array(':status' => 0))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('v_notification')
                    ->where('v_notification.id_dentist=:id_dentist', array(':id_dentist' => $id_dentist))
                    ->andWhere('v_notification.status=:status', array(':status' => 0))
                    ->order('v_notification.creatdate DESC')
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();

        }else{

            $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('v_notification')
                ->where('v_notification.status=:status', array(':status' => 0))
                ->queryScalar();
                
            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($cur_page,$lpp,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('v_notification')
                    ->where('v_notification.status=:status', array(':status' => 0))
                    ->order('v_notification.creatdate DESC')
                    ->limit($lpp, $paging['start_num'] - 1)
                    ->queryAll();

        }

        $dataArray            = array();

        foreach ($data as $key => $value) {

            $dataArray[$key]                = $value;

            $dataArray[$key]['data']        = json_decode($value['data']);
            $dataArray[$key]['watched']     = 0; // chua xem
            $checkWatched                   = $this->checkViewIdUserNoti($id_dentist,$value['id']);

            if($checkWatched){
                $dataArray[$key]['watched'] = 1;//da xem
            }

            # code...
        }

        return  array('status' => 'successful','paging'=>$paging, 'data'=>$dataArray);
    }

    public function checkViewIdUserNoti($id_user,$id_notification){

          $data  = CsNotificationsHistory::model()->findByAttributes(array("id_user"=>$id_user,"id_notification"=>$id_notification));

          if($data){
                return true;
          }

          return false;
    }

    public function getDetailNotification($id_notification,$id_user){

        if(!$id_notification || $id_notification == 0 || $id_notification == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_notification invalid');
        }

        $data = CsNotifications::model()->findByPk($id_notification);

        if($data){


            $checkWatched = $this->checkViewIdUserNoti($id_user,$id_notification);

            if($checkWatched == false){
                 $CsNotificationsHistory = new CsNotificationsHistory();
                $CsNotificationsHistory->id_notification = $id_notification;
                $CsNotificationsHistory->id_user = $id_user;
                $CsNotificationsHistory->status = 0;
                $CsNotificationsHistory->save();
             }

           
        }

        return  array('status' => 'successful', 'data'=>$data);

    }

    public function getAllWatchedNotifications($list_noti,$id_user){

        if(!$id_user || $id_user == 0 || $id_user == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid');
        }

        $rs = 0;

        if(is_numeric($list_noti) && $list_noti == 0 ){ // xem tấc cả

            $list_data = CsNotifications::model()->findAllByAttributes(array("status"=>0));

            foreach($list_data as $k => $value ){

                $checkWatched = $this->checkViewIdUserNoti($id_user,$value['id']);

                if($checkWatched == false){
                    $CsNotificationsHistory = new CsNotificationsHistory();
                    $CsNotificationsHistory->id_notification = $value['id'];
                    $CsNotificationsHistory->id_user = $id_user;
                    $CsNotificationsHistory->status = 0;
                    if($CsNotificationsHistory->save()){
                        $rs = $CsNotificationsHistory->id;
                    }
                    
                 }
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

        if(is_array($list_noti)){// lấy mang checked 

            foreach($list_noti as $k => $value){
                
                if(is_numeric($value)){
                    $checkWatched = $this->checkViewIdUserNoti($id_user,$value);

                    if($checkWatched == false){
                        $CsNotificationsHistory                     = new CsNotificationsHistory();
                        $CsNotificationsHistory->id_notification    = $value;
                        $CsNotificationsHistory->id_user            = $id_user;
                        $CsNotificationsHistory->status             = 0;
                        if($CsNotificationsHistory->save()){
                            $rs = $CsNotificationsHistory->id;
                        }
                        
                     }
                }
                
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

         return  array('status' => 'Fail','error'=> -1, 'error-message'=>'du lieu khong hop le');

    }

    public function deleteNotifications($list_noti,$id_user){

       if(!$id_user || $id_user == 0 || $id_user == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid');
        }

        $rs = 0;

        if(is_numeric($list_noti) && $list_noti == 0 ){ // xem tấc cả
        
            $list_data = CsNotifications::model()->findAllByAttributes(array("status"=>0));

            foreach($list_data as $k => $value ){

               $rs = CsNotifications::model()->updateByPk($value['id'],array("status"=>-1));

               if($rs){
                     $sql = "UPDATE cs_notifications_history set `status`= -1 where id_notification=".$value['id']."";
                     Yii::app()->db->createCommand($sql)->execute();
               }
               
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

        if(is_array($list_noti)){// lấy mang checked 

            foreach($list_noti as $k => $value){
                
                if(is_numeric($value)){
                    $rs =  CsNotifications::model()->updateByPk($value,array("status"=>-1));
                    if($rs){
                         $sql = "UPDATE cs_notifications_history set `status`= -1 where id_notification=".$value."";
                         Yii::app()->db->createCommand($sql)->execute();
                   }
                }
                
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

         return  array('status' => 'Fail','error'=> -1, 'error-message'=>'du lieu khong hop le');
    }



    public function getAddCsNotiSchedule($id_author,$id_dentist,$result_id,$action){
        
       if(!$result_id){
            return  array('status' => 'Fail', 'error-message'=>$result_id.' result_id invalid');
       }

       $result =  CsNotifications::model()->saveNotificationSchedule($id_author,$id_dentist,$result_id,$action);

       if($result){
            return  array('status' => 'successful', 'data'=>$result);
       }
       return  array('status' => 'Fail', 'error-message'=>'Cập nhật thất bại');
       
    }

    public function getSumNotificationsNotSeen($id_user,$group_id){

        if(!$id_user || $id_user == 0 || $id_user == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid');
        }

        if($id_user && $group_id == Yii::app()->params['id_group_dentist']){
            $data   = Yii::app()->db->createCommand()
                ->select('COUNT(*)')
                ->from('v_notification')
                ->where('v_notification.id_dentist=:id_dentist', array(':id_dentist' => $id_user))
                ->andWhere('v_notification.status=:status', array(':status' => 0))
                ->order('v_notification.creatdate DESC')
                ->queryScalar();
        }else{
            $data   = Yii::app()->db->createCommand()
                ->select('COUNT(*)')
                ->from('v_notification')
                ->where('v_notification.status=:status', array(':status' => 0))
                ->order('v_notification.creatdate DESC')
                ->queryScalar();
        }

        $data_watched   = Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('cs_notifications_history')
            ->where('cs_notifications_history.id_user=:id_user', array(':id_user' => $id_user))
            ->andWhere('cs_notifications_history.status=:status', array(':status' => 0))
            ->queryScalar();
        
        if($data){
            if($data_watched){
                return  array('status' => 'successful', 'data'=> $data-$data_watched);
            }else{
                 return  array('status' => 'successful', 'data'=> $data);
            }
        }else{
             return  array('status' => 'successful', 'data'=> 0);
        }
        
        return  array('status' => 'Fail', 'error-message'=>'thất bại');
       
    }




    /** ----------- OTHER  ----------- **/

    /**  Check Phone **/
    private function validatePhone($phone) {
        
        $numbersOnly = ereg_replace("[^0-9]", "", $phone);
        
        $numberOfDigits = strlen($numbersOnly);
        if ($numberOfDigits == 7 or $numberOfDigits == 12) {
            return true;
        } else {
            return false;
        }
    }
    /** Pagging **/
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
    function getSumNumRow($datalist){
        $num_row = 0;
        foreach ($datalist as $key => $value) {
                $num_row = $num_row + $value['totalSum'];
        }
        return $num_row;
    }

    /** ----------- PRODUCT  ----------- **/
    public function getListProducts($curpage=1,$numPerPage=10,$id_product_line=0,$searchProduct){
       $result =  Product::model()->product_list_pagination($curpage,$numPerPage,$id_product_line,$searchProduct);

       return  array('status' => 'successful','data'=>$result);
    }

    /** ----------- SALES  ----------- **/
    public function addQuotationOrder($id_branch, $id_author, $id_customer, $create_date, $payment_date ,$sum_tax, $sum_amount , $note, $status , $quote_details){

        if(!$id_branch || $id_branch == 0 || $id_branch == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_branch invalid');
        }
        if(!$id_customer || $id_customer == 0 || $id_customer == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_customer invalid');
        }
        if(!$id_author || $id_author == 0 || $id_author == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_author invalid');
        }
        if(!is_array($quote_details))
        {
            return  array('status' => 'Fail', 'error-message'=>'quote_details invalid');
        }
        

       $result =  Quotation::model()->addQuotation($add_quote = array('id_branch'=>$id_branch, 'id_author'=>$id_author, 'id_customer'=>$id_customer, 'create_date'=>$create_date, 'payment_date'=>$payment_date ,'sum_tax'=>$sum_tax, 'sum_amount'=> $sum_amount, 'note'=>$note, 'status'=>0 , 'add_quote_details' => $quote_details));

       if($result <= 0){
            return  array('status' => 'Fail', 'error-message'=>$result);
        }

       return  array('status' => 'successful', 'data'=>$result);
    }

    public function updateQuotationOrder($id_quotation, $id_branch, $payment_date ,$sum_tax, $sum_amount, $note, $status , $update_quote_details){

        if(!$id_quotation || $id_quotation == 0 || $id_quotation == '') {
            return  array('status' => 'Fail', 'error-message'=>'id_quotation invalid');
        }
        if(!$id_branch || $id_branch == 0 || $id_branch == '') {
            return  array('status' => 'Fail', 'error-message'=>'id_branch invalid');
        }
        
        if(!is_array($update_quote_details)) {
            return  array('status' => 'Fail', 'error-message'=>'update_quote_details invalid');
        }
        
       $result =  Quotation::model()->updateQuotation($update_quote = array('id'=>$id_quotation, 'id_branch'=>$id_branch, 'payment_date'=>$payment_date ,'sum_tax'=>$sum_tax, 'sum_amount'=> $sum_amount, 'note'=>$note, 'status'=>$status , 'update_quote_details' => $update_quote_details));

       if($result <= 0){
            return  array('status' => 'Fail', 'error-message'=>$result);
        }

       return  array('status' => 'successful', 'data'=>$result);
    }

    public function getQuotationOrder($curpage=1,$limit=1,$quote_time='',$quote_branch='',$quote_customer='',$quote_code='',$id='',$status = ''){
        $data = array();

        if(!$quote_customer)
            return array('status' => 'Fail', 'error'=>"-1");

        if($quote_customer && $status == 1) {
            $curpage = 1;
            $limit = 1;
        }

        $quote =  VQuotations::model()->searchQuotation($curpage,$limit,$quote_time,$quote_branch,$quote_customer,$quote_code,$id,$status);
        
        if(!$quote['data']) {
            return array('status' => 'Fail', 'error'=>"-1");
        }

        $first_id = end($quote['data'])->id;
        $last_id = reset($quote['data'])->id;

        $condition = " $first_id <= id_quotation AND id_quotation <= $last_id AND status >= 0";

        $quotationDetail = VQuotationDetail::model()->searchQuotationDetail($condition);

        if(!$quotationDetail) {
            return array('status' => 'Fail', 'error'=>"-1");
        }

        foreach ($quote['data'] as $key => $value) {
            $id = $value['id'];

            $quoteDetail = array_filter($quotationDetail,function($v) use ($id){
                if($v['id_quotation'] == $id)
                    return true;
            });

            $data[] = array(
                'quote'=>$value,
                'quoteDetail'=>$quoteDetail,
            );
        }

        return array('status' => 'successful', 'data'=>array('count'=>$quote['count'],'quote'=>$data));
    }

    public function getQuoteTreatment($id_customer, $id_group_history)
    {
        if(!$id_customer)
            return array('status' => 'Fail', 'error'=>"-1");        // ko co ma khach hang

        if(!$id_group_history)
            return array('status' => 'Fail', 'error'=>"-2");        // ko co dot dieu tri

        $quote  = VQuotations::model()->findByAttributes(array('id_customer'=>$id_customer,'id_group_history'=>$id_group_history));

        if(!$quote) {
            return array('status' => 'Fail', 'error'=>"-3");        // bao gia khong ton tai
        }

        $condition = "id_quotation = ". $quote->id;

        $quotationDetail = VQuotationDetail::model()->searchQuotationDetail($condition);

        if(!$quotationDetail) {
            return array('status' => 'Fail', 'error'=>"-4");        // chi tiet bao gia ko ton tai
        }

        return array('status' => 'Successful', 'data'=>array('quote'=>$quote,'quoteDetail'=>$quotationDetail));        // bao gia khong ton tai
    }

    public function getListSearchQuote($curpage=1,$limit=1,$quote_time='',$quote_branch='',$quote_customer='',$quote_code=''){

	    if(!$curpage || !$limit){
	         return  array('status' => 'Fail','error'=>'0', 'error-message'=>'cur_page or limit  not invalid');
	    }
	    $data 		= array();
        $i          = 0;

	    $quote = VQuotations::model()->searchQuotation($curpage,$limit,$quote_time,$quote_branch,$quote_customer,$quote_code);
	 	
	    if ($quote && count($quote['data']) > 0) {

	    	$first_id 	= end($quote['data'])->id;
        	$last_id 	= reset($quote['data'])->id;

	    	$condition 		 = " $first_id <= id_quotation AND id_quotation <= $last_id AND status >= 0";
        	$quotationListDetail = VQuotationDetail::model()->searchQuotationDetail($condition);

        	if(!$quotationListDetail) {
	            return array('status' => 'Fail', 'error'=>"-1",'error-message'=>'Not found quotation detail');
	        }

	        foreach ($quote['data'] as $key => $value) {
	            $id = $value['id'];


                $dataInfo                = array();
                $dataInfo                = $value->attributes;
                $dataInfo['data_detail'] = $this->getDetailByIdQuote($value['id'],$quotationListDetail);


                $data[$i] = $dataInfo;

                $i++;
	        }
	    }

	    return array('status' => 'successful', 'data'=>array('paging'=>$quote['paging'],'data'=>$data));

    }

     public function getDetailByIdQuote($id,$listInfo){
        $data = array();
        foreach ($listInfo as $key => $value) {
            if($value['id_quotation'] == $id){
                $data[] = $value;
            }
        }
        return $data;

    }


     public function getListSearchOrder($curpage=1,$limit=1,$order_time='',$order_branch='',$order_customer='',$order_code=''){

	    if(!$curpage || !$limit){
	         return  array('status' => 'Fail','error'=>'0', 'error-message'=>'cur_page or limit  not invalid');
	    }
	    $data 		= array();
        $i          = 0;

	    $order     = VOrder::model()->searchOrder($curpage,$limit,$order_time,$order_branch,$order_customer,$order_code);
	 	
	    if ($order && count($order['data']) > 0) {
	
	    	$first_id 	= end($order['data'])->id;
        	$last_id 	= reset($order['data'])->id;


	    	$condition   = " $first_id <= id_order AND id_order <= $last_id ";

        	$orderListDetail = VOrderDetail::model()->searchOrderDetail($condition);

        	if(!$orderListDetail) {
	            return array('status' => 'Fail', 'error'=>"-1",'error-message'=>'Not found quotation detail');
	        }

	        foreach ($order['data'] as $key => $value) {
               
	            $id        = $value['id'];

                $dataInfo                = array();
                $dataInfo                = $value->attributes;
                $dataInfo['data_detail'] = $this->getDetailByIdOrder($value['id'],$orderListDetail);


                $data[$i] = $dataInfo;

                $i++;
	        }
	    }

	    return array('status' => 'successful', 'data'=>array('paging'=>$order['paging'],'data'=>$data));

    }


    public function getDetailByIdOrder($id_order,$listInfo){
        $data = array();
        foreach ($listInfo as $key => $value) {
            if($value['id_order'] == $id_order){
                $data[] = $value;
            }
        }
        return $data;

    }


    public function getListSearchInvoice($curpage=1,$limit=1,$invoice_time='',$invoice_branch='',$invoice_customer='',$invoice_code=''){

        if(!$curpage || !$limit){
             return  array('status' => 'Fail','error'=>'0', 'error-message'=>'cur_page or limit  not invalid');
        }
        $data       = array();
        $i          = 0;


        //$curpage,$limit,$invoice_time,$invoice_branch,$invoice_customer,$invoice_code,$id_invoice
        $invoice     = VInvoice::model()->searchInvoice($curpage,$limit,$invoice_time,$invoice_branch,$invoice_customer,$invoice_code,'');
   
        if ($invoice && count($invoice['data']) > 0) {
    
            $first_id   = end($invoice['data'])->id;
            $last_id    = reset($invoice['data'])->id;


            $condition   = " $first_id <= id_invoice AND id_invoice <= $last_id ";
 
            $invoiceListDetail = VInvoiceDetail::model()->searchInvoiceDetail($condition);
  
            if(!$invoiceListDetail) {
                return array('status' => 'Fail', 'error'=>"-1",'error-message'=>'Not found quotation detail');
            }

            foreach ($invoice['data'] as $key => $value) {
               
                $id                      = $value['id'];

                $dataInfo                = array();
                $dataInfo                = $value->attributes;
                $dataInfo['data_detail'] = $this->getDetailByIdInvoice($value['id'],$invoiceListDetail);

                $data[$i] = $dataInfo;
               
                $i++;
            }
        }

        return array('status' => 'successful', 'data'=>array('paging'=>$invoice['paging'],'data'=>$data));

    }


    public function getDetailByIdInvoice($id_invoice,$listInfo){
        $data = array();
        foreach ($listInfo as $key => $value) {
            if($value['id_invoice'] == $id_invoice){
                $data[] = $value;
            }
        }
        return $data;

    }

     /** ----------- book schedule online  ----------- **/
     public function getServiceOnl($curpage= 1, $lpp = 20, $id_service_type = 0, $searchService)
     {
        $data = VServicesHours::model()->getServiceOnl($curpage, $lpp, $id_service_type, $searchService);

        return  array('status' => 'successful', 'numRow'=>$data['numRow'], 'numPage'=>$data['numPage'], 'data'=>$data['data']);
     }

     public function getDentistOnl($curpage= 1, $lpp = 20, $id_branch, $id_service, $searchDentist = '')
     {
        if(!$id_branch || !$id_service)
            return array('status' => -1 ,'error' => "Khong du du lieu!");
        $data =  VServicesHours::model()->getDentistOnl($curpage, $lpp, $id_branch, $id_service, $searchDentist);
        return  array('status' => 'successful', 'numRow'=>$data['numRow'], 'numPage'=>$data['numPage'], 'data'=>$data['data']);
     }

     // get blanktime
     
     public function addNewAppointmentOnl($id_customer, $id_dentist, $id_branch, $id_service, $lenght, $start_time, $end_time, $note='')
     {
        if(!$id_customer || !$id_dentist || !$id_branch || !$id_service || !$lenght || !$start_time || !$end_time)
            return array('status' => -1, 'error' => "Khong du du lieu!");

        $csSch = new CsSchedule();

        $sch = $csSch->addNewScheduleCheck(array(
             'code'         =>'', 
             'code_confirm' =>$csSch->codeConfirm(),
             'id_customer'  =>$id_customer,
             'id_dentist'   =>$id_dentist,
             'id_author'    =>0,
             'id_branch'    =>$id_branch,
             'id_chair'     =>'0',
             'id_service'   =>$id_service,
             'lenght'       =>$lenght,
             'start_time'   =>$start_time,
             'end_time'     =>$end_time,
             'status'       =>0,
             'source'       =>3,            // 3: mobile
             'active'       =>0,
             'active'       =>0,
             'note'         =>$note
        ));

        return $sch;
     }

     public function sendMailAppointment($id_customer, $email, $customer_name, $id_schedule)
     {
         if(!$id_customer || !$id_schedule)
            return array('status' => -1, 'error' => 'Khong du du lieu!');

        $sch = CsSchedule::model()->findByPk($id_schedule);

        if($sch)
        {
            if($sch->id_customer == $id_customer)
            {
                $code_confirm = $sch->code_confirm;
                $sendMail = CsSchedule::model()->SendEmail($email, $customer_name, $code_confirm, '', 1);
                return $sendMail;
            }
            else
                return array('status' => -2, 'error' => 'Khach hang khong dung!');
        }
        else
            return array('status' => -3, 'error' => 'Khong ton tai lich hen!');
     }

     public function sendSMSAppointment($id_customer, $phone, $customer_name, $id_schedule)
     {
         if(!$id_customer || !$id_schedule)
            return array('status' => -1, 'error' => 'Khong du du lieu!');

        $sch = CsSchedule::model()->findByPk($id_schedule);

        $phone = $this->checkPhoneNumber($phone);

        if($sch)
        {
            if($sch->id_customer == $id_customer)
            {
                $code_confirm = $sch->code_confirm;
                $text = "Ma xac nhan lich hen cua ban la:" . $code_confirm;
                $sendSMS = Sms::model()->sendSms($phone, $text, 0, '', $id_customer, $customer_name, $id_schedule, 3, 4);
                if($sendSMS <= 0)
                    return array('status'=> $sendSMS, 'error'=>Sms::model()->$sendSMSError[$sendSMS]);
                else
                    return array('status'=> $sendSMS, 'success'=>'success');
            }
            else
                return array('status' => -2, 'error' => 'Khach hang khong dung!');
        }
        else
            return array('status' => -3, 'error' => 'Khong ton tai lich hen!');
     }

    public function updateSchWithCode($id_customer, $id_schedule, $code)
    {

        if(!$id_customer || !$id_schedule || !$code)
            return array('status' => -1, 'error' => 'Khong du du lieu!');

        $upSch = CsSchedule::model()->updateScheduleCode(array(
                    'status' =>1, 
                    'active' =>1,
                    'id'     =>$id_schedule,
                    'code'   =>$code,
                ));

        //$upSch = CsSchedule::model()->findByPk($id_schedule);
        //$sch = CsSchedule::model()->findByPk($id_schedule);
        return $upSch;
    }
    public function updateProfile($id,$fullname,$address,$phone,$email,$id_country,$gender,$birthdate,$id_job,$position,$organization,$note,$identity_card_number,$image)
    {
       if($id){
            $customer = new Customer;
            $data = $customer->updateProfileCustomer($id,$fullname,$address,$phone,$email,$id_country,$gender,$birthdate,$id_job,$position,$organization,$note,$identity_card_number,$image);
            if($data){
                return array('status'=>'successful', 'data'=>$data);
            }
             return array('status'=>'fail', 'data'=>$data);
       }
    }

    public function getCompanyList($lat,$long,$distance){
        
        return array('status' => 'successful', 'data'=>Company::model()->getListCompany($lat,$long,$distance));
    }
    /*LMV company*/
    public function getListCompanyInformation($status,$location,$store){
        
        return array('status' => 'successful', 'data'=>Company::model()->detailex($status,$location,$store));
    }

    public function checkLoginface($id_fb,$id_gg){
        //return 1;
        //check gg
        if($id_gg != null){
        $data = Customer::model()->findByAttributes(array('id_gg'=>$id_gg));
            if ($data == null) {
                return array('status'=>'successful');
            }else{
                return array('status'=>'Fail', 'data'=>$data);
            }
        }
        //check face
        $data = Customer::model()->findByAttributes(array('id_fb'=>$id_fb));
            if ($data == null) {
                return array('status'=>'successful');
            }else{
                return array('status'=>'Fail', 'data'=>$data);
            }    
       
    }
    public function checkLoginGG($id_gg){
        //return 1;
        $data = Customer::model()->findByAttributes(array('id_gg'=>$id_gg));
            if ($data == null) {
                return array('status'=>'successful');
            }else{
                return array('status'=>'Fail', 'data'=>$data);
            }
    }
    public function getsupplier(){
       $model   = new Company;
       $data    = $model->getsupplier();
        if($data) { 
            return $data;
         }
    }

    /* CHAT API */
    public function RetrieveAGroup($name_group){
      

        if(!$name_group){
            return  array('status' => 'Fail', 'error-message'=>'name_group not invalid');
        }

        $chat       = new Chat();
    
        $rs         = $chat->RetrieveAGroup($name_group);
        $xml        = simplexml_load_string($rs);
        $json       = json_encode($xml);
        $array      = json_decode($json,TRUE);
        return array('status'=>'successful','data'=>$array);
    }

    // Lấy nhóm chương trình
    public function getListSearchLinePromotions($curpage=1,$numPerPage=10,$searchName){

        if($numPerPage> 20){
            $numPerPage = 20;
        }

        $num_row= Yii::app()->db->createCommand()
                ->select('Count(*)')
                ->from('croup_promotion')
                ->where('croup_promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))     
                ->queryAll();

        $num_row =count($num_row);

        if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$curpage,'lpp'=>$numPerPage,'start_num'=>1), 'data'=>'') ;
                
        $paging = $this->getPageSearch($curpage,$numPerPage,$num_row);
        

        $data   = Yii::app()->db->createCommand()
                ->select('*')
                ->from('croup_promotion')
                ->andWhere('croup_promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))
                ->limit($numPerPage, $paging['start_num'] - 1)
                ->queryAll();
             
         return  array('status' => 'successful', 'paging'=>$paging, 'data'=>$data); 

    }
    // lấy danh sach chuong trinh
    public function getListSearchPromotions($curpage=1,$numPerPage=10,$id_promotion_type=0  ,$searchName){
        if($id_promotion_type){

            $num_row= Yii::app()->db->createCommand()
                    ->select('Count(*)')
                    ->from('promotion')
                    ->where('promotion.id_croup=:id_promotion_type', array(':id_promotion_type' => $id_promotion_type))
                    ->andWhere('promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))
                    ->order('promotion.start_date ASC')            
                    ->queryAll();

            $num_row =count($num_row);

            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$curpage,'lpp'=>$numPerPage,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($curpage,$numPerPage,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('promotion')
                    ->where('promotion.id_croup=:id_promotion_type', array(':id_promotion_type' => $id_promotion_type))
                    ->andWhere('promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))
                    ->order('promotion.start_date ASC')        
                    ->limit($numPerPage, $paging['start_num'] - 1)
                    ->queryAll();
             
        }else{
            $num_row= Yii::app()->db->createCommand()
            ->select('Count(*)')
            ->from('promotion')
            ->where('promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))
            ->order('promotion.start_date ASC')            
            ->queryAll();

            $num_row =count($num_row);

            if(!$num_row) return array('status' => 'successful','paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$curpage,'lpp'=>$numPerPage,'start_num'=>1), 'data'=>'') ;
                    
            $paging = $this->getPageSearch($curpage,$numPerPage,$num_row);
            
            $data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('promotion')
                    ->where('promotion.name LIKE :name '  , array(':name'=>'%'.$searchName.'%'))
                    ->order('promotion.start_date ASC')        
                    ->limit($numPerPage, $paging['start_num'] - 1)
                    ->queryAll();
             
        }

        return  array('status' => 'successful', 'paging'=>$paging, 'data'=>$data); 

    }
    // lấy chi tiết chương trình
    public function getDetailPromotion($id_promotion){

        if(!$id_promotion || $id_promotion == 0 || $id_promotion == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_branch invalid');
        }

        $dataInfo= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion')
                ->where('promotion.id=:id', array(':id' => $id_promotion))
                ->andWhere('promotion.status>=:status', array(':status' => 0))        
                ->queryRow();

                
        if(!$dataInfo){
            return  array('status' => 'Fail','error'=>'-1', 'error-message'=>'id_promotion not found');
        }

        $data                   = array();
        $data['info']           = $dataInfo;
        $data['dataBranch']     = array();
        $data['dataProduct']    = array();
        $data['dataService']    = array();
        $data['type_segment']   = array();
        $data['type_price']     = array();

        // Theo chi nhanh
        if($dataInfo['type_branch'] !== 0){
            $dataBranch= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion_branch')
                ->where('promotion_branch.id_promotion=:id_promotion', array(':id_promotion' => $id_promotion))    
                ->queryAll();
            $data['dataBranch'] = $dataBranch;
        }

        //Theo San pham
        if($dataInfo['type_product'] !== 0){
            $dataProduct= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion_product')
                ->where('promotion_product.id_promotion=:id_promotion', array(':id_promotion' => $id_promotion))
                ->andWhere('promotion_product.id_product>=:id_product', array(':id_product' => 0))  
                ->queryAll();
            $data['dataProduct'] = $dataProduct;
        }

        // theo dich Vu
        if($dataInfo['type_service'] !== 0){
            $dataService= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion_product')
                ->where('promotion_product.id_promotion=:id_promotion', array(':id_promotion' => $id_promotion))
                ->andWhere('promotion_product.id_service>=:id_service', array(':id_service' => 0))     
                ->queryAll();
            $data['dataService'] = $dataProduct;
        }

        //
        if($dataInfo['type_segment'] !== 0){
            $dataSegment= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion_segment')
                ->where('promotion_segment.id_promotion=:id_promotion', array(':id_promotion' => $id_promotion))
                ->queryAll();
            $data['dataSegment'] = $dataSegment;
        }

        if($dataInfo['type_price'] !== 0){
            $dataPrice= Yii::app()->db->createCommand()
                ->select('*')
                ->from('promotion_value')
                ->where('promotion_value.id_promotion=:id_promotion', array(':id_promotion' => $id_promotion))
                ->queryAll();
            $data['dataPrice'] = $dataPrice;
        }

        return array('status'=>'successful', 'data'=>$data);

    }
    
}

?>