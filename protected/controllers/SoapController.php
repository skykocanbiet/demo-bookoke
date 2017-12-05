<?php
class SoapController extends CController
{
    public function actions()
    {
        return array(
            'ws'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
    
    private function validate_ws(){

        return true;

        $ip = Yii::app()->request->userHostAddress;

        $IpList = array('221.133.14.72','221.133.14.73','113.161.81.29','127.0.0.1','221.133.14.70','119.9.91.238','119.9.93.254','221.133.14.78','113.161.72.61');
        
        return in_array($ip,$IpList);
    }
    
    private function validate_agent($id_agent,$hascode){

        $soap   = new SoapClients;
        return $soap->checkAgentWs($id_agent,$hascode);
    }

   /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getKeyWordProductListByLine($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }
        
        if($params[0] > 1){
            if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        }
        
        $soap = new SoapClients;
        
          //$id_author/id_dentist/$id_schedule
        return CJSON::encode($soap->getAddCsNotiSchedule(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /* --- HEAD WEB SERVICE Customer --- */

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkLoginUser($paramstring){
     
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        // $id_agent,$hascode,$code
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$code_number
        return CJSON::encode($soap->checkLoginUser(
            $params['2']
        ));
    }



    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updatePushIdOfAccount($paramstring){
        
        if(!$this->validate_ws()){
            return;
        }

        
        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 4 ){ return -1; }
        
        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id,device_id
        return CJSON::encode($soap->updatePushIdOfAccount(
            $params['0'],$params['2'],$params['3']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateProfile($paramstring){

        if(!$this->validate_ws()){
            return;
        }
          $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 16 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->updateProfile(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9'],$params['10'],$params['11'],$params['12'],$params['13'],$params['14'],$params['15']
        ));
    }


     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchCustomersAppointment($paramstring){
        
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);

        // $id_agent,$hascode,
        if(count($params) != 7 ){ return -1; }
        
        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        
    
        //$cur_page,$lpp,$id_dentis,$name_sup
        return CJSON::encode($soap->getListSearchCustomersAppointment(
            $params['2'],$params['3'],$params['4'],$params['5'],
            $params['6']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 13 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_user,$id_customer,$fullname,$phone,$email,$gender,$birthdate,$identity_card_number,$address,$id_country,$note
        return CJSON::encode($soap->updateCustomer(
            $params['2'],$params['3'],$params['4'],
            $params['5'],$params['6'],$params['7'],
            $params['8'],$params['9'],$params['10'],$params['11'],$params['12']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateImageProfileCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }
          $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer,$name_upload_old,$pEncodedString
        return CJSON::encode($soap->updateImageProfileCustomer(
            $params['2'],$params['3'],$params['4']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateInsurranceCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }
          $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 7 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer,$code_insurrance,$type_insurrance,$startdate,$enddate
        return CJSON::encode($soap->updateInsurranceCustomer(
            $params['2'],$params['3'],$params['4'],
            $params['5'],$params['6']
        ));
    }


     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function registerCustomerByDentist($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 13 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_company,$id_user,$fullname,$phone,$email,$gender,$birthdate,$identity_card_number,$address,$id_country,$note
        //["215","2","luu duc hoa","0903456789","hoachi@gmail.com","0","19-2-2009","01245485879","192 lo 18 cx bac hai","VN","tu nhien biet"]
        return CJSON::encode($soap->registerCustomerByDentist(
            $params['2'],$params['3'],$params['4'],
            $params['5'],$params['6'],$params['7'],
            $params['8'],$params['9'],$params['10'],$params['11'],$params['12']
        ));
    }


 /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkLoginface($paramstring){
     
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        // $id_agent,$hascode,$code
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$code_number
        return CJSON::encode($soap->checkLoginface(
            $params['2'], $params['3']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkLoginGG($paramstring){
      return 1;
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        // $id_agent,$hascode,$code
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$code_number
        return CJSON::encode($soap->checkLoginface(
            $params['2']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkLoginCustomer($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        // array($id_agent,$hascode,$username,$password) 
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$username,$password
        return CJSON::encode($soap->checkLoginCustomer(
            $params['2'],$params['3']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function forgotCustomerPassword($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        //$id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$username
        return CJSON::encode($soap->forgotCustomerPassword(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkForgotCustomerPassword($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        //$id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_customer,$password,$code_confirm
        return CJSON::encode($soap->checkForgotCustomerPassword(
            $params['2'],$params['3'],$params['4']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updatePushIdOfCustomer($paramstring){
        
        if(!$this->validate_ws()){
            return;
        }

        
        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 4 ){ return -1; }
        
        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_user,device_id
        return CJSON::encode($soap->updatePushIdOfCustomer(
            $params['0'],$params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkCodeConfirmByCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //id_customer,code_comfirm
        return CJSON::encode($soap->checkCodeConfirmByCustomer(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function deleteTransactionByCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //id_customer
        return CJSON::encode($soap->deleteTransactionByCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function returnConfirmationCodeByCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //id_customer
        return CJSON::encode($soap->returnConfirmationCodeByCustomer(
            $params['2']
        ));
    }
    

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function CancelCodeConfirmByCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //id_customer
        return CJSON::encode($soap->CancelCodeConfirmByCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function registerCustomerChatLive($paramstring){

        if(!$this->validate_ws()){
            return 0;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$name,$email,$phone
        return CJSON::encode($soap->registerCustomerChatLive(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkRegisterCustomerLead($paramstring){

        if(!$this->validate_ws()){
            return 0;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //name,email,phone
        return CJSON::encode($soap->checkRegisterCustomerLead(
            $params['2'],$params['3'],$params['4']
        ));
    }
     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function registerfacebook($paramstring){
       
       //return $paramstring;
        if(!$this->validate_ws()){
            return 0;
        }

        $params = CJSON::decode($paramstring);
       
        // $id_agent,$hascode
        if(count($params) != 10 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
    
        $soap   = new SoapClients;
        //name,email,phone,id_fb,name_fb,address,id_gg,name_gg
        return CJSON::encode($soap->registerCustomerLeadFB(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function registerCustomerLead($paramstring){
       //return $paramstring;
        if(!$this->validate_ws()){
            return 0;
        }

        $params = CJSON::decode($paramstring);
       
        // $id_agent,$hascode
        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
    
        $soap   = new SoapClients;
        //name,email,phone,username,password
        return CJSON::encode($soap->registerCustomerLead(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7']
        ));
    }
    

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkRegisterCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //name,email,phone
        return CJSON::encode($soap->checkRegisterCustomer(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getCustomerInformation($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->getCustomerInformation(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListMedicineAlert($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
  
        return CJSON::encode($soap->getListMedicineAlert());
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListMedicalHistoryAlertOfCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->getListMedicalHistoryAlertOfCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListMedicalHistoryAlertByIdCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->getListMedicalHistoryAlertByIdCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addNewMedicalHistoryAlert($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer,$chk_medical_history,$ipt_medical_history,$id_dentist
        return CJSON::encode($soap->addNewMedicalHistoryAlert(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateMedicalHistoryAlert($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer,$chk_medical_history,$ipt_medical_history
        return CJSON::encode($soap->updateMedicalHistoryAlert(
            $params['2'],$params['3'],$params['4']
        ));
    }
    

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListTreatmentGroupOfCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->getListTreatmentGroupOfCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkTreatmentOfCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->checkTreatmentOfCustomer(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addTreatmentOfCustomer($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_customer
        return CJSON::encode($soap->addTreatmentOfCustomer(
            $params['2']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListTreatmentProcess($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_mhg
        return CJSON::encode($soap->getListTreatmentProcess(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListTooth($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_customer,$id_mhg
        return CJSON::encode($soap->getListTooth(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListToothConcludeAndNote($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_customer,$id_mhg
        return CJSON::encode($soap->getListToothConcludeAndNote(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function saveTooth($paramstring){    

        if(!$this->validate_ws()){
            return;
        }   
        
        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
    
        //$id_customer, $id_mhg, $tooth_data, $tooth_image, $tooth_conclude, $tooth_note
        return CJSON::encode($soap->saveTooth(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addMedicalHistory($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 13 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time,$session_add_prescription,$session_add_lab
        return CJSON::encode($soap->addMedicalHistory(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],
            $params['7'],$params['8'],$params['9'],$params['10'],$params['11'],$params['12']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateMedicalHistory($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 12 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_medical_history,$id_customer,$id_history_group,$id_user,$id_dentist,$id_branch,$name,$description,$reviewdate,$length_time
        return CJSON::encode($soap->updateMedicalHistory(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],
            $params['7'],$params['8'],$params['9'],$params['10'],$params['11']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function deleteMedicalHistory($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_medical_history
        return CJSON::encode($soap->deleteMedicalHistory(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function savePrescription($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 10 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_group_history,$id_medical_history,$diagnose,$drug_name,$times,$dosage,$advise,$examination_after
        return CJSON::encode($soap->savePrescription(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function saveLab($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 10 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_group_history,$id_medical_history,$id_branch,$id_dentist,$sent_date,$received_date,$assign,$note
        return CJSON::encode($soap->saveLab(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getEvaluateStateOfTartar($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_mhg
        return CJSON::encode($soap->getEvaluateStateOfTartar(
            $params['2']
        ));
    }
    
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateEvaluateStateOfTartar($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$id_mhg,$evaluate_state_of_tartar
        return CJSON::encode($soap->updateEvaluateStateOfTartar(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addNewCustomer($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$fullname,$phone
        return CJSON::encode($soap->addNewCustomer(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addCustomer($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 9 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;

        //$fullname,$email,$phone,$address,$organization,$note
        return CJSON::encode($soap->addCustomer(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListCountry($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
   
        return CJSON::encode($soap->getListCountry());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSource($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
   
        return CJSON::encode($soap->getListSource());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSegment($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
   
        return CJSON::encode($soap->getListSegment());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getJob($paramstring){    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
   
        return CJSON::encode($soap->getJob());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListDentistForWorkTreatment($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
    
        return CJSON::encode($soap->getListDentistForWorkTreatment());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchServices($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);

        if(count($params) != 6 ){ return -1; }

        // $id_agent, $hascode
        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_branch ,$code, $name_sub, $price
        return CJSON::encode($soap->getListSearchServices(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchDentists($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_branch = 1,$id_service = 1
        return CJSON::encode($soap->getListSearchDentists(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchUsers($paramstring){

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 7 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$cur_page,$lpp,$group_id,$id_user,$username,$name
        return CJSON::encode($soap->getListSearchUsers(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchCustomers($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 11 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$cur_page,$lpp,$name_sup,$code_number,$email,$phone,$birthdate,$identity_card_number
        return CJSON::encode($soap->getListSearchCustomers(
            $params['2'],$params['3'],$params['4'],
            $params['5'],$params['6'],$params['7'],
            $params['8'],$params['9'],$params['10']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchBranchs($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$country,$city,$name_sub,$address
        return CJSON::encode($soap->getListSearchBranchs(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchSchedules($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$cur_page,$lpp,$id_dentis,$id_service,$start_time,$end_time
        return CJSON::encode($soap->getListSearchSchedules(
            $params['2'],$params['3'],$params['4'],$params['5'], $params['6'],$params['7']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getDetailSchedule($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_schedule
        return CJSON::encode($soap->getDetailSchedule(
            $params['2']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getBlankTime($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 7 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        //$id_branch,$id_service,$id_dentist='',$start_date,$end_date
        return CJSON::encode($soap->getBlankTime(
            $params['2'],$params['3'],$params['4'],
            $params['5'],$params['6']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addNewAppointment($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }
        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 6 ){ return -1; }
        
        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        $soap   = new SoapClients;
        // $id_customer, $sch, $cus, $medical_alert
        return CJSON::encode($soap->addNewAppointment(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateScheduleAppointment($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 14 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        
        //$id_Schedule, $id_dentist, $id_branch, $id_chair, $id_service,$lenght='', $start_time, $end_time,$status,$active,$note,$id_author
        return CJSON::encode($soap->updateScheduleAppointment(
            $params['2'],$params['3'],$params['4'],$params['5'], $params['6'],
            $params['7'],$params['8'],$params['9'],$params['10'],$params['11'],$params['12'],$params['13']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function checkScheduleTime($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        
        //$id_dentist,$time_start,$time_end,$id_schedule = 0
        return CJSON::encode($soap->checkScheduleTime(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getDentistServices($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;
        
        //$curpage,$id_dentist=0, $searchService
        return CJSON::encode($soap->getDentistServices(
            $params['2'],$params['3'],$params['4']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListNotifications($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$cur_page,$lpp,$id_dentist
        return CJSON::encode($soap->getListNotifications(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getSumNotificationsNotSeen($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_user,$group_id
        return CJSON::encode($soap->getSumNotificationsNotSeen(
            $params['2'],$params['3']
        ));
    }
    

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getAddNewNotiSchedule($paramstring){
        
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent,$hascode
        if(count($params) != 6 ){ return -1; }
        
        if($params[0] > 1){
            if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        }
        
        $soap = new SoapClients;
        
          //$id_author/id_dentist/$id_schedule,$action
        return CJSON::encode($soap->getAddCsNotiSchedule(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));

    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getDetailNotification($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_notification,id_user
        return CJSON::encode($soap->getDetailNotification(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getAllWatchedNotifications($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$list_noti,id_user
        return CJSON::encode($soap->getAllWatchedNotifications(
            $params['2'],$params['3']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function deleteNotifications($paramstring){
    

        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$list_noti,id_user
        return CJSON::encode($soap->deleteNotifications(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListProducts($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage,$numPerPage=10,$id_product_line=0,$searchProduct
        return CJSON::encode($soap->getListProducts(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListServices($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }
       
        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage,$numPerPage=10,$id_service_type=0,$searchService
        return CJSON::encode($soap->getListServices(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListGroupServices($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage,$numPerPage=10,$searchService
        return CJSON::encode($soap->getListGroupServices(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListDentist($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$searchDentist, $item ='10', $cur_page='1'
        return CJSON::encode($soap->getListDentist(
            $params['2'],$params['3'],$params['4']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getQuotationOrder($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 10 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage,$limit,$quote_time,$quote_branch,$quote_customer,$quote_code,$id_quotation, $status
        return CJSON::encode($soap->getQuotationOrder(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getQuoteTreatment($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 4 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_customer, $id_group_history
        return CJSON::encode($soap->getQuoteTreatment(
            $params['2'],$params['3']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addQuotationOrder($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 12 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$id_branch, $id_author, $id_customer, $create_date, $payment_date ,$sum_tax, $sum_amount , $note, $status , $quote_details
        return CJSON::encode($soap->addQuotationOrder(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9'],$params['10'],$params['11']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateQuotationOrder($paramstring){
        
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 10 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$id_quotation, $id_branch, $payment_date ,$sum_tax, $sum_amount, $note, $status , $update_quote_details
        return CJSON::encode($soap->updateQuotationOrder(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9x']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchQuote($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage=1,$limit=1,$quote_time='',$quote_branch='',$quote_customer='',$quote_code=''
        return CJSON::encode($soap->getListSearchQuote(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchOrder($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage=1,$limit=1,$order_time='',$order_branch='',$order_customer='',$order_code=''
        return CJSON::encode($soap->getListSearchOrder(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7']
        ));
    }


    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchInvoice($paramstring){
    
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode
        if(count($params) != 8 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        
        $soap   = new SoapClients;

        //$curpage=1,$limit=1,$invoice_time='',$invoce_branch='',$invoice_customer='',$invoice_code=''
        return CJSON::encode($soap->getListSearchInvoice(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getServiceOnl($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 6 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$curpage, $lpp, $id_service_type, $searchService
        return CJSON::encode($soap->getServiceOnl(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getDentistOnl($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 7 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$curpage= 1, $lpp = 20, $id_branch = 1, $id_service = 1, $searchDentist = ''
        return CJSON::encode($soap->getDentistOnl(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function addNewAppointmentOnl($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 10 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //addNewAppointmentOnl($id_customer, $id_dentist, $id_branch, $id_service, $lenght, $start_time, $end_time, $note='')
        return CJSON::encode($soap->addNewAppointmentOnl(
            $params['2'],$params['3'],$params['4'],$params['5'],$params['6'],$params['7'],$params['8'],$params['9']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function sendMailAppointment($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 6 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$id_customer, $email, $customer_name, $id_schedule
        return CJSON::encode($soap->sendMailAppointment(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function sendSMSAppointment($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 6 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$id_customer, $phone, $customer_name, $id_schedule
        return CJSON::encode($soap->sendSMSAppointment(
            $params['2'],$params['3'],$params['4'],$params['5']
        ));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function updateSchWithCode($paramstring){
        if(!$this->validate_ws()){
            return;
        }

        $params = CJSON::decode($paramstring);
        // $id_agent, $hascode

        if(count($params) != 5 ){ return -1; }


        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        $soap   = new SoapClients;

        //$id_customer, $id_schedule, $code
        return CJSON::encode($soap->updateSchWithCode(
            $params['2'],$params['3'],$params['4']
        ));
    }
    
     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getCompanyList($paramstring){
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        //$lat,$long,$distance
        $soap   = new SoapClients;
        return CJSON::encode($soap->getCompanyList(
            $params['2'],$params['3'],$params['4']
        ));
    }
    
    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListCompanyInformation($paramstring){
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        //$lat,$long,$distance
        $soap   = new SoapClients;
        return CJSON::encode($soap->getListCompanyInformation($params[2],$params[3],$params[4]));
    }
     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getsupplier($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 2 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        //$lat,$long,$distance
        $soap   = new SoapClients;
        return CJSON::encode($soap->getsupplier());
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function RetrieveAGroup($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }
        //$name_group
        $soap   = new SoapClients;
        return CJSON::encode($soap->RetrieveAGroup($params[2]));
    }

    /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchLinePromotions($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 5 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        //$curpage=1,$numPerPage=10,$searchName
        $soap   = new SoapClients;
        return CJSON::encode($soap->getListSearchLinePromotions(
            $params['2'],$params['3'],$params['4']
        ));
    }

     /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getListSearchPromotions($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 6 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        //$curpage=1,$numPerPage=10,$id_promotion_type=0 ,$searchName
        $soap   = new SoapClients;
        return CJSON::encode($soap->getListSearchPromotions(
            $params['2'],$params['3'],$params['4'],
            $params['5']
        ));
    }

         /**
     * @param string the input parameter
     * @return string the return val
     * @soap
     */
    public function getDetailPromotion($paramstring){
      
        if(!$this->validate_ws()){
            return;
        }
        
        $params = CJSON::decode($paramstring);
         
        // $id_agent,$hascode
        if(count($params) != 3 ){ return -1; }

        if(!$this->validate_agent($params[0],$params[1])){ return -2; }

        //$id_promotion
        $soap   = new SoapClients;
        return CJSON::encode($soap->getDetailPromotion(
            $params['2']
        ));
    }


    
   
}
?>