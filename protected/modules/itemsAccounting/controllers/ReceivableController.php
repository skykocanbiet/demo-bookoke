<?php

class ReceivableController extends Controller
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

	/** RECEIVABLE **/
	public function actionIndex()
	{
		$model = new VReceivable;
		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('viewAccountReceivable',array('model'=>$model));
        }else{
            $this->render('viewAccountReceivable',array('model'=>$model));
        }
	}
    
    public function actionSearch_v_receivable($cur_page = ''){
        if(isset($_POST['cur_page'])){
            
            $cur_page      = $_POST['cur_page']?$_POST['cur_page']:1;
            $lpp           = Yii::app()->params['lpp10'];
            if(isset($_POST['lpp']) ){
                $lpp = $_POST['lpp'];
            }
            $status        = "";
            $received_date = ""; 
            $search_params = array();
            
            if(isset($_REQUEST['type']) and $_REQUEST['type'] != "")
            $search_params['type'] = $_REQUEST['type'];
            
            
            if( isset($_REQUEST['status']) && ($_REQUEST['status'] != "") ){
                if($_REQUEST['status'] == 0 ){
                    $status = " `status` <= 2  ";
                }
                if($_REQUEST['status'] == 3 ){
                    $search_params['status'] = $_REQUEST['status'];
                }
            }
            
            if(isset($_REQUEST['received_date']) and $_REQUEST['received_date'] != ""){
                $model = new VPayable;
                if(strlen($_REQUEST['received_date']) > 1){
                    $received_date =  "AND `received_date` = '".$_REQUEST['received_date']."' ";
                }elseif($_REQUEST['received_date'] == 1){
                    
                    $today     = $model->getToday();
                    $received_date =  "AND `received_date` = '".$today."' ";
                    
                }elseif($_REQUEST['received_date'] == 2){
                    
                    $from = date("Y-m-d", strtotime('monday this week')); 
                    $to  = date("Y-m-d", strtotime('sunday this week'));
                    $received_date =  "AND ( `received_date` >=  '".$from."' AND `received_date` <=  '".$to."' ) ";
                    
                }elseif($_REQUEST['received_date'] == 3){
                    
                    $firstDayThisMonth = date('Y-m-d', strtotime('first day of this month'));
                    $lastDayThisMonth = date('Y-m-d', strtotime('last day of this month'));
                    $received_date =  "AND ( `received_date` >=  '".$firstDayThisMonth."' AND `received_date` <= '".$lastDayThisMonth."' ) ";
                    
                }elseif($_REQUEST['received_date'] == 4){
                    
                    $firstDayNextMonth = date('Y-m-d', strtotime('first day of next month'));
                    $lastDayNextMonth = date('Y-m-d', strtotime('last day of next month'));
                    $received_date =  "AND ( `received_date` >=  '".$firstDayNextMonth."' AND `received_date` <=  '".$lastDayNextMonth."' ) ";
                    
                }
                elseif($_REQUEST['received_date'] == 5){
                    
                    $firstDayNextMonth = date('Y-m-d', strtotime('first day of last month'));
                    $lastDayNextMonth = date('Y-m-d', strtotime('last day of last month'));
                    $received_date =  "AND ( `received_date` >=  '".$firstDayNextMonth."' AND `received_date` <=  '".$lastDayNextMonth."' ) ";
                    
                }
            }
            

            if($_POST['number']){
                $number = ' (AND `number` LIKE "%'.$_POST['number'].'%"  OR `order_number` LIKE "%'.$_POST['number'].'%" )';
            }else{
                $number = '';
            }
            
            $list_data     = VReceivable::model()->SearchReceivableAccount(
                             $search_params,
                             '',
                             ' '.$number.' AND `name` LIKE "%'.$_POST['payer'].'%"  AND `phone` LIKE "%'.$_POST['phone'].'%"  order by  confirmed_date DESC, received_date DESC',
                             $lpp,$cur_page,$status,$received_date
                             );
                             
            $this->renderPartial('searchAccountReceivable',array('list_data'=>$list_data));
        }
	}
    
    public function actionAddnew_v_receivable(){
        $model    = new VReceivable();
        if(isset($_POST['VReceivable'])){
            
            $model->attributes = $_POST['VReceivable'];
            
            if($model->validate()){

                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $RaPayer = new RaPayer();
                    $RaPayer->attributes = $_POST['VReceivable'];
                    
                    if($RaPayer->save()){
                        $RA = new ReceivableAccount();
                        
                        $RA->attributes     = $_POST['VReceivable'];
                        $RA->number         = $model->getArNumber($_POST['VReceivable']['received_date']);
                        $RA->id_user        = $_POST['VReceivable']['id_user'];
                        $RA->note           = $_POST['VReceivable']['note'];
                        $RA->payment_status = $_POST['VReceivable']['payment_status'];
                        $RA->id_payer       = $RaPayer->id;
                        $RA->received_date  = $_POST['VReceivable']['received_date'];
                        $RA->confirmed_date = NULL;
                        
                        if($RA->save()){
                            $transaction ->commit();
                            Yii::app()->user->setFlash('success','Sussecfull '.$RA->number);
                            $this->renderPartial('addnewAccountReceivable', array('model'=>$model),false,true);
                            Yii::app()->end();
                        }
                        throw new Exception('Error . Not found receiver null');
                    }
                    throw new Exception('Error . Not found receiver null');
                    
                } catch (Exception $error) {
                    throw $error;
                    $transaction ->rollback();
                }
            }
        }
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        $this->renderPartial('addnewAccountReceivable', array('model'=>$model),false,true);
    }
    public function actionEdit_v_receivable(){
        $model    = new VReceivable();
        if(isset($_POST['VReceivable'])){
            
            $model  =  $this->loadModelVReceivable($_POST['VReceivable']['id']);
            
            $model->attributes = $_POST['VReceivable'];
            
            if($model->validate()){
                
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $RaPayer   = RaPayer::model()->findByPk($model->id_payer);
                    $RaPayer->attributes = $_POST['VReceivable'];
                    
                    if($RaPayer->save(false)){
                        $PA = ReceivableAccount::model()->findByPk($model->id);
                        $PA->attributes     = $_POST['VReceivable'];
                        $PA->id_user        = $_POST['VReceivable']['id_user'];
                        $PA->note           = $_POST['VReceivable']['note'];
                        $PA->amount         = $_POST['VReceivable']['amount'];
                        $PA->type           = $_POST['VReceivable']['type'];
                        $RA->payment_status = $_POST['VReceivable']['payment_status'];
                        $PA->id_payer       = $RaPayer->id;
                        $RA->confirmed_date = NULL;
                        
                        if($PA->save(false)){
                            $transaction ->commit();
                            Yii::app()->user->setFlash('success','Sussecfull'.$PA->number);
                            $this->renderPartial('editAccountReceivable', array('model'=>$model),false,true);
                            Yii::app()->end();
                        }
                        throw new Exception('Error . Not found receiver null');
                    }
                    throw new Exception('Error . Not found receiver null');
                    
                } catch (Exception $error) {
                    $transaction ->rollback();
                    throw $error;
                }
            }
        }else{
            $model  =  $this->loadModelVReceivable($_POST['id']);
        }
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        $this->renderPartial('editAccountReceivable', array('model'=>$model),false,true);
    }
    public function actionDelete_v_receivable(){
        $model  = new VReceivable();
        
        $model  = $this->loadModelVReceivable($_POST['id']);
        
        try{
            $transaction = Yii::app()->db->beginTransaction();
            
        	$result = ReceivableAccount::model()->updateByPk($model->id,array('status'=>'-1'));
            
        	if($result == null){
        		throw new Exception('Receivable account null !');
        	}
            
            if($result){
                
                $result = RaPayer::model()->updateByPk($model->id_payer,array('status'=>0));
                
                if($result){
                    
                    if($model->order_number){
                        $idPayable = $this->loadModelPayableAcount($model->order_number);
                        $result = PayableAccount::model()->updateByPk($idPayable,array('status'=>'-1'));
                        if($result){
                            $result = PaReceiver::model()->updateByPk($idPayable->id_receiver,array('status'=>0));
                        }
                    }
                    
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
            $this->renderPartial('editAccountReceivable',array('model'=>$model),false,true);
        }

	}
    public function actionConfirmedReceivable(){
        if($_POST['id'] && isset($_POST['status'])){
            
            $RA       = ReceivableAccount::model()->findByPk($_POST['id']);
            $group_no = Yii::app()->user->getState('group_no');

            if($RA->status  < 3 ){
                
                if($group_no=='admin'|| $group_no=="superadmin"){
                    if( $RA->status == $_POST['status']){
                        $RA->status = $_POST['status']-1;
                    }else{
                        $RA->status = $_POST['status'];
                    }
                }
                
                if($group_no=="manager"){
                    if( $RA->status == $_POST['status']){
                        $RA->status = $_POST['status']-1;
                    }elseif($RA->status == 0 ||  $RA->status == 2){
                        $RA->status = $_POST['status'];
                    }
                }
                
                if($_POST['status'] == '3'){
                    $RA->confirmed_date = date("Y-m-d");
                }
                
                if($RA->save(false)){
                    if($RA->order_number && $_POST['status'] == 3 ){
                            $Payable = PayableAccount::model()->findByAttributes(array('order_number'=>$RA->order_number));
                        if($Payable){
                            $result  = PayableAccount::model()->updateByPk($Payable->id,array('status'=>3));
                        }
                    }
                    echo "1"; exit;
                }
            }
            echo "-1";
        }
    }
    
    public function loadModelVReceivable($id)
    {
        $model  =   VReceivable::model()->findByAttributes(array('id'=>$id));
        if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function loadModelPayableAcount($order_number)
    {
        $model  =   VPayable::model()->findByAttributes(array('order_number'=>$order_number));
        if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
        return $model->id;
    }
    
    public function actionResetRA(){
        
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
        
        if(is_array($data) && count($data) > 0){
           
            foreach( $data['data'] as $k => $value  ){
                if(User::model()->findAllByAttributes(array('block'=>0,'group_id'=>3,'id'=>$value['id_user']))){
                    if (strtotime($value['create_date']) > strtotime('2016-05-01 00:00:00')) {
                        if($value['payment_type'] != 'return' && $value['amount'] > 0 ){
                            $resultRA = VReceivable::model()->AddnewOrderReceivableAccountReset($value['order_code']);
                            //print_r($resultRA);exit;
                        }
                    }
                } 
            }
        }
    }


}
