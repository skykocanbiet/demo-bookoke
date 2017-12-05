<?php

class PayableController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='/layouts/main_sup';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return parent::accessRules();
	}

	public function actionIndex()
	{
		$model = new VPayable;
		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('viewAccountPayable',array('model'=>$model));
        }else{
            $this->render('viewAccountPayable',array('model'=>$model));
        }
	}

    public function actionSearch_v_payable($cur_page = ''){
        if(isset($_POST['cur_page'])){
            $cur_page      = $_POST['cur_page']?$_POST['cur_page']:1;
            $lpp           = 30;
            if(isset($_POST['lpp']) ){
                $lpp = $_POST['lpp'];
            }
            
            $search_params  = array();
            $status         = "";
            $requester_date = "";
            
            if(isset($_REQUEST['type']) and $_REQUEST['type'] != "")
            $search_params['type'] = $_REQUEST['type'];
            
            /* if(isset($_REQUEST['id_user']) and $_REQUEST['id_user'] != "")
            $search_params['id_user'] = $_REQUEST['id_user'];*/
            
            if( isset($_REQUEST['status']) && ($_REQUEST['status'] != "") ){
                if($_REQUEST['status'] == 0 ){
                    $status = " `status` <= 2  ";
                }
                if($_REQUEST['status'] == 3 ){
                    $search_params['status'] = $_REQUEST['status'];
                }
            }
            
            if(isset($_REQUEST['requester_date']) and $_REQUEST['requester_date'] != ""){
                $model = new VPayable;
                if(strlen($_REQUEST['requester_date']) > 1){
                    $requester_date =  "AND `requester_date` = '".$_REQUEST['requester_date']."' ";
                }elseif($_REQUEST['requester_date'] == 1){
                    
                    $today     = $model->getToday();
                    $requester_date =  "AND `requester_date` = '".$today."' ";
                    
                }elseif($_REQUEST['requester_date'] == 2){
                    
                    $from = date("Y-m-d", strtotime('monday this week')); 
                    $to  = date("Y-m-d", strtotime('sunday this week'));
                    $requester_date = "AND (`requester_date` BETWEEN  '".$from."' AND '".$to."') ";
                    
                }elseif($_REQUEST['requester_date'] == 3){
                    
                    $firstDayThisMonth = date('Y-m-d', strtotime('first day of this month'));
                    $lastDayThisMonth = date('Y-m-d', strtotime('last day of this month'));
                    $requester_date =  "AND (`requester_date` BETWEEN  '".$firstDayThisMonth."' AND '".$lastDayThisMonth."') ";
                    
                }elseif($_REQUEST['requester_date'] == 4){
                    
                    $firstDayNextMonth = date('Y-m-d', strtotime('first day of next month'));
                    $lastDayNextMonth = date('Y-m-d', strtotime('last day of next month'));
                    $requester_date =  "AND (`requester_date` BETWEEN  '".$firstDayNextMonth."' AND '".$lastDayNextMonth."' ) ";
                    
                }elseif($_REQUEST['requester_date'] == 5){
                    
                    $firstDayNextMonth = date('Y-m-d', strtotime('first day of last month'));
                    $lastDayNextMonth = date('Y-m-d', strtotime('last day of last month'));
                    $requester_date =  "AND ( `requester_date` >=  '".$firstDayNextMonth."' AND `requester_date` <=  '".$lastDayNextMonth."' ) ";
                    
                }
            }
            
            if($_POST['number']){
                $number = ' (AND `number` LIKE "%'.$_POST['number'].'%"  OR `order_number` LIKE "%'.$_POST['number'].'%" )';
            }else{
                $number = '';
            }

            $list_data     = VPayable::model()->SearchPayableAccount(
                             $search_params,
                             '',
                             ' '.$number.'   order by  approval_date DESC, requester_date DESC',
                             $lpp,$cur_page,$status,$requester_date);
            // echo "<pre>"; print_r($list_data);echo "</pre>";exit;
            
            $this->renderPartial('searchAccountPayable',array('list_data'=>$list_data));
        }
	}
    
    public function actionAddnew_v_payable(){
        $model    = new VPayable();
        
        if(isset($_POST['VPayable'])){

            $payAcc = VPayable::model()->AddnewPayableAccount($_POST['VPayable']);
        }

        Yii::app()->clientscript->scriptMap['jquery.js'] = false;

        $this->renderPartial('addnewAccountPayable', array('model'=>$model),false,true); 
    }
    
    public function actionEdit_v_payable(){
        
        $model    = new VPayable();
        
        if(isset($_POST['VPayable'])){
            
            $model  =  $this->loadModelVPayable($_POST['VPayable']['id']);
            
            $model->attributes = $_POST['VPayable'];
          
            if($model->validate()){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $PaReceiver   = PaReceiver::model()->findByPk($model->id_receiver);
                    $PaReceiver->attributes = $_POST['VPayable'];
                    
                    if($PaReceiver->save(false)){
                        
                        $PA = PayableAccount::model()->findByPk($model->id);
                        
                        $PA->attributes     =  $_POST['VPayable'];
                        $PA->id_user        =  $_POST['VPayable']['id_user'];
                        $PA->note           =  $_POST['VPayable']['note'];
                        $PA->payment_status =  $_POST['VPayable']['payment_status'];
                        $PA->id_receiver    =  $PaReceiver->id;
                        $PA->requester_date =  $_POST['VPayable']['requester_date'];
                        $PA->approval_date  =  NULL;
                        
                        if($PA->save(false)){
                            $transaction ->commit();
                            Yii::app()->user->setFlash('success','Save '.$PA->number.' Sussecfull');
                            $this->renderPartial('editAccountPayable', array('model'=>$model),false,true);
                            Yii::app()->end();
                        }
                        throw new Exception('Error . Not found receiver null');
                        
                    }
                    throw new Exception('Error . Not found receiver null');
                    
                }catch (Exception $error){
                    throw $error;
                    $transaction ->rollback();
                }
            }
        }else{
            $model  =  $this->loadModelVPayable($_POST['id']);
        }
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        $this->renderPartial('editAccountPayable', array('model'=>$model),false,true);
    }

    public function actionDelete_v_payable(){ 

        $model  = new VPayable();
        
        $model  = $this->loadModelVPayable($_POST['id']);
        
        try{
            $transaction = Yii::app()->db->beginTransaction();
            
        	$delete_ra = PayableAccount::model()->updateByPk($model->id,array('status'=>'-1'));
            
            if($delete_ra){
                
                $PaReceiver = PaReceiver::model()->updateByPk($model->id_receiver,array('status'=>0));

                if($PaReceiver){
                    $transaction ->commit();
                    echo '1'; Yii::app()->end();
                }
                throw new Exception('Error . Error delete Payer !');
            }
            throw new Exception('Error . Error delete receivable  account!');
            
        }
        
        catch(Exception $e){
            $transaction ->rollback();
            Yii::app()->user->setFlash('error',$e->getMessage());
            $this->renderPartial('editAccountPayable',array('model'=>$model),false,true);
        }

	}
    
    public function actionApprovalPayable(){
        if($_POST['id'] && isset($_POST['status'])){
            
            $PA       = PayableAccount::model()->findByPk($_POST['id']);
            $group_no = Yii::app()->user->getState('group_no');
            
            if($PA->status  < 3){
                
                if($group_no=='admin'|| $group_no=="superadmin"){
                    if( $PA->status == $_POST['status']){
                        $PA->status = $_POST['status']-1;
                    }else{
                        $PA->status = $_POST['status'];
                    }
                }
                
                if($group_no=="manager"){
                    if( $PA->status == $_POST['status']){
                        $PA->status = $_POST['status']-1;
                    }elseif($PA->status == 0 ||  $PA->status == 2){
                        $PA->status = $_POST['status'];
                    }
                }
                
                if($_POST['status'] == '3'){
                    $PA->approval_date = date("Y-m-d");
                }else{
                    $PA->approval_date = null;
                }
                
                if($PA->save(false)){
                    echo "1"; exit;
                }
            }
            
            
            echo "-1";
        }
    }
    public function actionResetPA(){
        
        $cur_page      = 1;
        $lpp           = 100;
        $search_params = array();
        $month = 5;
        
        if($month){
            $toal_day_in_month = cal_days_in_month(CAL_GREGORIAN,$month,date("Y"));
            $from = date("Y").'-'.$month.'-'.'01'.' 00:00:00';
            $to   = date("Y").'-'.$month.'-'.$toal_day_in_month.' 23:59:59';
            $date = "AND ( `date` BETWEEN '$from' AND '$to' )";
        }
        $search_params['st'] = 2;
        
        $data  = VOrder::searchSaleOrders($search_params,'',' '.$date.'  ORDER BY `date` DESC , amount DESC ',$lpp,$cur_page);
        
        //echo "<pre>";print_r($data);echo "</pre>";exit;
        if(is_array($data) && count($data) > 0){
           
            foreach( $data['data'] as $k => $value  ){
                if (strtotime($value['create_date']) > strtotime('2016-05-01 00:00:00')) {
                    if($value['payment_type'] != 'return' && $value['amount'] > 0 ){
                        $resultRA = VPayable::model()->AddnewOrderPayableAccountReset($value['order_code']);
                        //print_r($resultRA);exit;
                    }
                }
            }
        }
    }
    public function loadModelVPayable($id)
    {
        $model  =   VPayable::model()->findByAttributes(array('id'=>$id));
        if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

}
