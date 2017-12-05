<?php

class OpportunityController extends Controller
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

public function actionAdd()
{
$customer=new Customer;
if(isset($_POST['customerNewName']) && isset($_POST['customerNewPhone']))
{	
	$phone=$customer->getVnPhone($_POST['customerNewPhone']);
	if($customer->findAll('phone=:st',array(':st'=>$phone))==true) 
	{
		echo "-1";
		exit;					
	}

	$customer->code_number='1'.$customer->getCodeNumberCustomer();
	$customer->fullname=$_POST['customerNewName'];
	$customer->phone=$phone;
	$customer->status=0;					
	$customer->save();

	echo "1";
	exit;	
}
}

public function actionAdmin()
{

	$model = new Customer;
	$this->render('admin',array(
	'model'=>$model,
	));
}

public function actionDeals()
{
    $this->render('deals');
}

public function actionSearchCustomers()
{

	$model 		   = new Customer;
	$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
	$lpp           = 20;
	$search_params = '';
	$orderBy 	   = '`fullname` ASC ';

	if($_POST['type'] == 4){
		$orderBy = '`code_number` DESC ';
	}

	if ($_POST['value']) 
	{
		$search_params= 'AND (`fullname` LIKE "%'.$_POST['value'].'%" ) OR (`code_number` LIKE "%'.$_POST['value'].'%" )';
	}

	$data  = $model->searchOpportunity('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);
	if($cur_page > $data['paging']['cur_page']){	
		echo '<script>stopped = true; </script>';	
		exit;
	}

	$this->renderPartial('search_sort',array('list_data'=>$data,'page'=>$data['paging']['cur_page']));

}






public function actionSearchopportunity()
    {
        $model=new Lead;
        $id_lead='';
        if(isset($_REQUEST['leadid']))
        {
            $id_lead=$_REQUEST['leadid'];
            //$id_lead='1';
        }
        if(Yii::app()->request->isAjaxRequest) {
                $this->renderPartial('searchopportunity',array('idlead'=>$id_lead,'model'=>$model));
        }
         else{
            $this->render('searchopportunity', array('idlead'=>"",'model'=>""));
         }

    }
	public function actionCreatenewopportunity(){
		if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('createnewopportunity');
        }
        else{
            $this->render('createnewopportunity');
        }
	}
	public function actionAjax_new(){
	   
	   if($_GET['idlead'] && $_GET['product'] ){
	       
	        $idlead   = $_GET['idlead'];
    		$product  = $_GET['product'];
    		$note     = $_GET['note'];
            
    		$csopp = new CsOpportunity();
    		$csopp->id_product = $product;
    		$csopp->id_lead = $idlead;
    		$csopp->opportunity = $note;
    		$csopp->save(false);
            
    		$return = CsRawLead::model()->updateByPk($idlead,array('flag'=>1));
            echo $return;
            
	   }else{
	       echo '-1';
	   }
		
	}
	public function actionSpecialopportunity(){
		if(Yii::app()->request->isAjaxRequest) {
                $this->renderPartial('specialnewopportunity');
        }
         else{
            $this->render('specialnewopportunity');
         }
	}
    public function actionAjax_searchopp()
    {
        $model=new Lead;
        $id_user = Yii::app()->user->getState('id_user');
        $firstname=$_REQUEST['search_firstname'];
        $phone=$_REQUEST['search_phone'];
        $cur_page=$_REQUEST['page'];
        $flag=$_REQUEST['flag'];// flag = 0 lay danh lead, flag = 1 lay danh sach opportunity
        $type=$_REQUEST['type'];
        $sort=$_REQUEST['sort'];
        $search_state=$_REQUEST['search_state'];
        //die('sdsdsds');
        $list_lead100=$model->show_opportunity($firstname,$phone,$search_state,$id_user,$flag,$type,$cur_page,$sort);

        $arr_page=$model->phantrang_opportunity($firstname,$phone,$search_state,$id_user,$flag,$type);
        $num_page=$arr_page['num_page'];
        $num_record=$arr_page['n_record'];
        $this->renderPartial('ajax_searchopp',array('list_lead100'=>$list_lead100,'num_page'=>$num_page,'current_page'=>$cur_page,'num_record'=>$num_record),false, true);
        /**/
    }
	public function actionAjax_searchopp_detail()
    {
        $model=new Lead;
        $id_user = Yii::app()->user->getState('id_user');
        $idlead=$_REQUEST['idlead'];
        
        $cur_page=$_REQUEST['page'];
        
        $list_lead100=CsOpportunity::model()->show_opportunity($id_user,$cur_page,$idlead);
        //echo $list_lead100;
		
        $arr_page=CsOpportunity::model()->phantrang_opportunity($id_user,$idlead);
        $num_page=$arr_page['num_page'];
        $num_record=$arr_page['n_record'];
        $this->renderPartial('ajax_searchopp_detail',
        array(  'list_lead100'=>$list_lead100,
                'num_page'=>$num_page,
                'current_page'=>$cur_page,
                'num_record'=>$num_record
        ),false,true);
        /**/
    }
	public function actionDetail(){
        $model=new Lead;
        $id_user = Yii::app()->user->getState('id_user');
        $id_lead=$_REQUEST['id_lead'];
        $info = $model->view_info_lead($id_lead);
		$numcall = count(CsCall::model()->findAllByAttributes(array('id_lead'=>$id_lead)));
		
		$listopportunity = CsOpportunity::model()->findAllByAttributes(array('id_lead'=>$id_lead));
        
        $v_current_use = $model->get_current_use($id_lead);
        if(!$v_current_use){
            $v_current_use = "";
        }
		
        $this->renderPartial('detail',
        array(  'listopportunity'=>$listopportunity,
                'numcall'=>$numcall,
                'idlead'=>$id_lead,
                'info'=>$info,
                'v_current_use'=>$v_current_use,
                'id_user'=>$id_user,
                'model'=>$model
        ),false, true);
    }
	public function actionChange_status(){
		$st = $_POST['st'];
		$idopportunity = $_POST['idopportunity'];
		CsOpportunity::model()->updateByPk($idopportunity,array('st'=>$st));
	}
	public function actionAjax_searchopp1()
    {
        $model   = new Lead;
        $id_user = Yii::app()->user->getState('id_user');
        $phone   = $_REQUEST['search_phone'];
        $cur_page=$_REQUEST['page'];
        $flag    =$_REQUEST['flag'];// flag = 0 lay danh lead, flag = 1 lay danh sach opportunity
        
        //die('sdsdsds');
        $list_lead100=$model->show_opportunity1($phone,$id_user,$flag,$cur_page);
        //echo $list_lead100;
        
        $arr_page   =$model->phantrang_opportunity1($phone,$id_user,$flag);
        $num_page   =$arr_page['num_page'];
        $num_record =$arr_page['n_record'];
        $this->renderPartial('ajax_searchopp',
        array(  'list_lead100'=>$list_lead100,
                'num_page'    =>$num_page,
                'current_page'=>$cur_page,
                'num_record'  =>$num_record
        ),false, true);
        /**/
    }
    public function actionFilteropportunity()
    {
        if(Yii::app()->request->isAjaxRequest) {
                $this->renderPartial('filteropportunity');
        }
         else{
            $this->render('filteropportunity');
         }
    }
    public function actionReportopportunity()
    {
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('reportopportunity');
        }
        else{
            $this->render('reportopportunity');
        }
    }
	public function actionInformation(){
		$idlead = $_GET['id_lead'];
		$this->renderPartial('information',array('idlead'=>$idlead));
	}

    
    public function actionDealopportunity(){
        
        $model      = new CsOpportunity();

        if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('dealopportunity',array('model'=>$model));
        }else{
            $this->render('dealopportunity',array('model'=>$model));
        }
    }
    public function actionAjaxSearchDealOpportunity(){
        if($_POST['cur_page']){
            
            $model      = new CsOpportunity();
            $data       = $model->AjaxSearchOpportunity();           
            $stage      = $model->InfoDealStage();

            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('AjaxSearchDealOpportunity',
                array(  'model'     =>$model,
                        'data'      =>$data,
                        'stage'     =>$stage                       
                ));
            }else{
                $this->render('AjaxSearchDealOpportunity',
                array(  'model'     =>$model,
                        'data'      =>$data,
                        'stage'     =>$stage                       
                ));
            }
            
        }
    }

    public function actionAjaxSearchDealTable(){
        if($_POST['cur_page']){
            
            $model      = new CsOpportunity();
            $data       = $model->AjaxSearchDealTable();  
           
            $this->renderPartial('table',
            array(  'model'     =>$model,
                    'data'      =>$data                                     
            ));
            
        }
    }

    public function actionEditTitle(){
        if ( isset($_POST['id']) && isset($_POST['title']) ) {
            $model      = new CsOpportunity();
            $editTitle  = $model->editTitle($_POST['id'],$_POST['title']);
            if ($editTitle == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionEditValue(){
        if ( isset($_POST['id']) && isset($_POST['value']) && isset($_POST['currency']) ) {

            $exchange_rate = 22000; 
            if ($_POST['value']){     

                if ($_POST['currency']=="VND"){
                    $_POST['value'] = $_POST['value'];
                }
                else{
                    $_POST['value'] = $_POST['value']*$exchange_rate;
                }      

            } 
            else{
                $_POST['value'] = 0;
            }

            $model      = new CsOpportunity();
            $editValue  = $model->editValue($_POST['id'],$_POST['value'],$_POST['currency']);
            if ($editValue == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionEditOrganization(){
        if ( isset($_POST['id']) && isset($_POST['organization']) ) {
            $model      = new CsOpportunity();
            $editOrganization  = $model->editOrganization($_POST['id'],$_POST['organization']);
            if ($editOrganization == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionEditContactPerson(){
        if ( isset($_POST['id']) && isset($_POST['contact_person']) ) {
            $model      = new CsOpportunity();
            $editContactPerson  = $model->editContactPerson($_POST['id'],$_POST['contact_person']);
            if ($editContactPerson == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionEditFinishDate(){
        if ( isset($_POST['id']) && isset($_POST['finish_date']) ) {
            $model      = new CsOpportunity();
            $editFinishDate  = $model->editFinishDate($_POST['id'],$_POST['finish_date']);
            if ($editFinishDate == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionDeleteDeal(){
        if (isset($_POST['id'])) {
            $model      = new CsOpportunity();
            $deleteDeal  = $model->deleteDeal($_POST['id']);
            if ($deleteDeal == 1) {
                echo "1";
                exit;
            }
        }
    }

    public function actionUpdateStageOpportunity(){
        if($_POST['id'] && $_POST['stage']){
            $model =  new CsOpportunity();
            $data  = $model->findByPk($_POST['id']);
            
            if($data->stage ==  $_POST['stage']){
                echo '0';exit;
            }else{
                
                $id_user    = Yii::app()->user->getState('id_user');
                $group_no   = Yii::app()->user->getState('group_no');
                
                if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="manager" ){ 
                    $id_user = "";
                }
                
                $result = $model->updateByPk($_POST['id'],array('stage'=>$_POST['stage'],'move_date'=>date("Y-m-d H:i:s")));
                
                $valueDealOld = number_format($model->toalValueDeal($data->stage,$id_user),0,",",".")." VND";
                $totalDealOld = $model->toalDealStage($data->stage,$id_user);
                
                $valueDealNew = number_format($model->toalValueDeal($_POST['stage'],$id_user),0,",",".")." VND";
                $totalDealNew = $model->toalDealStage($_POST['stage'],$id_user);
                
                echo (json_encode(array(
                    'id'            => $data->id,
                    'stageOld'      => $data->stage,
                    'valueDealOld'  => $valueDealOld,
                    'totalDealOld'  => $totalDealOld,
                    'valueDealNew'  => $valueDealNew,
                    'totalDealNew'  => $totalDealNew,
                ))); 
            }
        }
    }
    public function actionAjax_update_total_value_deal(){
        if($_POST['id']){
           $model = new CsOpportunity(); 
           
           if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('AjaxSearchDealOpportunity',
                array('valueDeal'=>$valueDeal,
                      'totalDeal'=>$totalDeal
                ));
           }else{
                $this->render('AjaxSearchDealOpportunity',
                array('valueDeal'=>$valueDeal,
                      'totalDeal'=>$totalDeal
                ));
           }
        }
    }
    public function actionAddnewDealOpportunity(){
        
        if($_POST['contact_person_name'] || $_POST['organization_name'] || $_POST['stage'] || $_POST['finish_date']){ 
                $exchange_rate = 22000; 
                if ($_POST['deal_value']){     

                    if ($_POST['currency']=="VND"){
                        $_POST['deal_value'] = $_POST['deal_value'];
                    }
                    else{
                        $_POST['deal_value'] = $_POST['deal_value']*$exchange_rate;
                    }      

                } 
                else{
                    $_POST['deal_value'] = 0;
                }

                if ($_POST['finish_date']){
                    $finish_date         = $_POST['finish_date'];
                    $explode_dash        = explode('/',$finish_date);
                    $_POST['finish_date']= $explode_dash[2]."-".$explode_dash[1]."-".$explode_dash[0];                   
                }                
                $model     = new CsOpportunity();
                $_POST['phone'] = $model->getVnPhone($_POST['phone']); 
                try{  
                    $model->attributes  = $_POST;   
                    if($model->validate()){                          
                        if($model->save()){                             
                            echo '1';
                        }                      
                    }
                }
                catch(CDbException $e) {
                	$model->addError(null, $e->getMessage());
                }            
        }
    }
    public function actionView_schedule_activity(){
        if($_POST['id']){
            echo json_encode(CsOpportunity::model()->getIdDeal($_POST['id']));   
        }
    }
    public function actionSave_schedule_activity(){        
        //Update Opportunity
        $explode_space              =   explode(' ',$_POST['datetime_schedule']);  
        $date_schedule              =   $explode_space[0];        
        $explode_slash              =   explode('/',$date_schedule);
        $_POST['datetime_schedule'] =   $explode_slash[2]."-".$explode_slash[1]."-".$explode_slash[0]." ".$explode_space[1];      
        if($_POST['time_schedule']=="") $_POST['time_schedule']=NULL;

        if($_POST['id_opportunity']){
            $model                    = new CsOpportunity();
            $opp                      =  $model->findByPk($_POST['id_opportunity']);
            $opp->title               = $_POST['title'];  
            $opp->contact_person_name = $_POST['contact_person_name']; 
            $opp->organization_name   = $_POST['organization_name'];         
            $opp->save();
        }
        
        // Save Opportunity Schedule
        $model =  new CsOpportunitySchedule();
        if($_POST['id']){    
            $model = $model->findByPk($_POST['id']);
            $model->attributes =  $_POST;
        }else{
            $model->attributes = $_POST;
        }
        echo $model->save(false);
        
    }
    public function actionEdit_schedule_activity(){
        if($_POST['id']){
            echo json_encode(CsOpportunity::model()->getIdScheduleActivity($_POST['id']));
        }
    }
    public function actionReturn_view_activity(){
        if($_POST['id']){
            $model  = new CsOpportunity();
            $schedule           = $model->checkSchedule($_POST['id']);
            $id_opportunity     = $_POST['id'];
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('return_view_activity',
                array(  'model'         =>$model,
                        'schedule'      =>$schedule,
                        'id_opportunity'=>$id_opportunity
                ));
            }else{
                $this->render('return_view_activity',
                array(  'model'         =>$model,
                        'schedule'      =>$schedule,
                        'id_opportunity'=>$id_opportunity
                ));
            }
        }
    }
    public function actionListPhoneContact(){
        if(isset($_POST['phone'])){

            $model      = new CsOpportunity();
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="manager" ){ 
                $id_user = "";
            }
            
            $listphone = $model->getAllListPhone($id_user,$_POST['phone']);
            print_r(json_encode($listphone));
            
        }
    }

    public function actionListContactPersonNameContact(){
        if(isset($_POST['contact_person_name'])){

            $model      = new CsOpportunity();
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="business" ){ 
                $id_user = "";
            }
            
            $list_contact_person_name = $model->getAllListContactPersonName($id_user,$_POST['contact_person_name']);
            print_r(json_encode($list_contact_person_name));
            
        }
    }

    public function actionListOrganizationNameContact(){
        if(isset($_POST['organization_name'])){

            $model      = new CsOpportunity();
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="business" ){ 
                $id_user = "";
            }
            
            $list_organization_name = $model->getAllListOrganizationName($id_user,$_POST['organization_name']);
            print_r(json_encode($list_organization_name));
            
        }
    }

    public function actionCheck_phone_opportunity(){
        if($_POST['phone']){
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="manager" ){
                $id_user = "";
            }
            
            echo CsOpportunity::model()->CheckPhoneOpp($id_user,$_POST['phone']) ;
        }
        
    }

    public function actionCheck_contact_person_name_opportunity(){
        if($_POST['contactpersonname']){
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="business" ){
                $id_user = "";
            }
            
            print_r(CsOpportunity::model()->CheckContactPersonNameOpp($id_user,$_POST['contactpersonname'])) ;
        }
        
    }

    public function actionCheck_organization_name_opportunity(){
        if($_POST['organizationname']){
            $id_user    = Yii::app()->user->getState('id_user');
            $group_no   = Yii::app()->user->getState('group_no');
            
            if($group_no=='admin'|| $group_no=="superadmin" || $group_no=="business" ){
                $id_user = "";
            }
            
            print_r(CsOpportunity::model()->CheckOrganizationNameOpp($id_user,$_POST['organizationname'])) ;
        }
        
    }

    public function actionExport(){
       
        $exclude = array('phone');
        
        $headers = array('phone' => 'phone');
        
        $listdata = CsOpportunity::model()->ExportPhone();
//        echo "<pre>";
//        print_r($listdata);
//        echo "</pre>";
//        exit;
        if($listdata){
            Yii::import('ext.ECSVExport');
            $csv = new ECSVExport($listdata);        
            $csv->setHeaders($headers);
            $csv->convertActiveDataProvider=false;
            $output = $csv->toCSV();
            $filename="accountcallnex.csv";
            Yii::app()->getRequest()->sendFile($filename, $output, "text/csv; charset=UTF-8", false);
        }
        
    }

}

