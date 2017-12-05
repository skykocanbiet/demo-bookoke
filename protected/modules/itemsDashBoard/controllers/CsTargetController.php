<?php

class CsTargetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/view';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
		$dataProvider = new CActiveDataProvider('CsTarget');
		$this->renderPartial('index',array('dataProvider'=>$dataProvider,true,true));
	}

    public function actionSearchList()
    {

        $model         = new GpUsers;
        $cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
        $lpp           = 20;
        $search_params = '';
        $orderBy       = '`name` ASC ';     

        if ($_POST['value']) 
        {
            $search_params= 'AND (`name` LIKE "%'.$_POST['value'].'%" ) OR (`id` LIKE "%'.$_POST['value'].'%" )';
        }



        $data  = $model->searchStaffs('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);


        if($cur_page > $data['paging']['cur_page']){    
            echo '<script>stopped = true; </script>';   
            exit;
        }

        $this->renderPartial('search_list',array('list_data'=>$data,'page'=>$data['paging']['cur_page']));

    }
    public function actionDetailTarget()
    {
        $model = new CsTarget();

        $data  = "";  

        if(isset($_POST['id']))
        {       

            $data   = $model->findAllByAttributes(array('user_id'=>$_POST['id']));
        }   

        $this->renderPartial('_ajax_search',array('list_product'=>$data,'subject_js'=>Yii::app()->controller->id));

        $this->renderPartial('_ajax_search',array(
                'model'=>$model,'data'=>$data
        ),false,false);
    }

    
    public function actionView()
	{
        $list_month   =  Yii::app()->locale->getMonthNames();
        $model        = new CsTarget();
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('view',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
        else{
            $this->render('view',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
	}
    
    public function actionAdmin()
	{
        $list_month   =  Yii::app()->locale->getMonthNames();
        $model        = new CsTarget();
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('admin',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
        else{
            $this->render('admin',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
	}
    
    public function actionAjaxSearch($cur_page = '1')
    {
        $cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
        $lpp           = Yii::app()->params['lpp15'];
        
        $search_params = array();
        
        if(isset($_REQUEST['user_id']) and $_REQUEST['user_id'])
        $search_params['user_id'] = $_REQUEST['user_id'];
        
        if(isset($_REQUEST['month']) and $_REQUEST['month'])
        $search_params['month'] = $_REQUEST['month'];
        
        if(isset($_REQUEST['year']) and $_REQUEST['year'])
        $search_params['year'] = $_REQUEST['year'];
        
        if(isset($_REQUEST['revenue_target']) and $_REQUEST['revenue_target'])
        $search_params['revenue_target'] = $_REQUEST['revenue_target'];
        
        if(isset($_REQUEST['new_account_target']) and $_REQUEST['new_account_target'])
        $search_params['new_account_target'] = $_REQUEST['new_account_target'];
        
        if(isset($_REQUEST['call_target']) and $_REQUEST['call_target'])
        $search_params['call_target'] = $_REQUEST['call_target'];
        
        
        $list_product  = CsTarget::AjaxSearch($search_params,'','ORDER BY month DESC , revenue_target DESC ,new_account_target DESC ',$lpp,$cur_page);
        Yii::app()->session['chart_info'] = $list_product;
        $this->renderPartial('_ajax_search',array('list_product'=>$list_product,'subject_js'=>Yii::app()->controller->id));
    }
    
    public function actionCreate()
    {
        $list_month   =  Yii::app()->locale->getMonthNames();
        $model = new CsTarget();
        
        
        if(isset($_POST['CsTarget'])){
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            
            $model->attributes = $_POST['CsTarget'];
            try {
               if($model->validate()){
                    if($model->save(false)){ 
                        $data_response = $_POST['CsTarget'];
                        $this->renderPartial('admin',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id),false,false);
                        Yii::app()->end();
                    }
                } 
            }
            catch(CDbException $e) {
            	$model->addError(null, $e->getMessage());
            }
        }
        
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        $this->renderPartial('_form', array('model'=>$model,'list_month'=>$list_month),false,true); 
    }
    
    public function actionUpdate()
    {
        $list_month   =  Yii::app()->locale->getMonthNames();
        if(isset($_POST['id'])){
             $model  =  $this->loadModel($_POST['id']);
        }
        if(isset($_POST['CsTarget']['id'])){
            
            $model  =  $this->loadModel($_POST['CsTarget']['id']);
             // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            
            $model->attributes = $_POST['CsTarget'];
            
            try{
                if($model->validate()){
                    if($model->save(false)){ 
                        $this->renderPartial('admin',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
                        Yii::app()->end();
                    }
                } 
            }
            catch(CDbException $e) {
            	$model->addError(null, $e->getMessage());
            }
            
        }
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        $this->renderPartial('_form', array('model'=>$model,'list_month'=>$list_month),false,true);
    }
    
    public function actionDelete()
    {
        try{
        	if($_POST['id'] == ""){
        		throw new Exception('Id does not exist');
        	}
            $model    =  $this->loadModel($_POST['id']);
        	if($model == null){
        		throw new Exception('CsTarget Null');
        	}
            $model->delete();
            $this->actionAjaxSearch();
        }
        catch(Exception $e){
        	Yii::app()->user->setFlash('error',$e->getMessage());
            $this->actionAjaxSearch();
        }
	}
    
	public function actionChart()
	{
	    $list_month   =  Yii::app()->locale->getMonthNames();
        $list_week    =  Yii::app()->getDateFormatter();
	    $from_date    =  date('Y-m-d').' 00:00:00';
        $to_date      =  date('Y-m-d').' 23:59:59';
        
        $target       = CsTarget::model()->getDefaultTargetInfo('today',$from_date,$to_date);
        
        $present      = CsTarget::model()->getPresentInfoUser(array('user_id'=>'','from'=>$from_date,'to'=>$to_date));

        $data_info    = array_merge($target,$present);
      
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('chart',array('data_info'=>$data_info,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
        else{
            $this->render('chart',array('data_info'=>$data_info,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
        
	}
    
    public function actionSearchDashboard()
    {
        if($_POST['from_day'] && $_POST['to_day'] ){
            $from_date    = $_POST['from_day'].' 00:00:00';
            $to_date      = $_POST['to_day'].' 23:59:59';
            $id_user      = $_POST['id_user'];
            $date_type    = $_POST['date_type'];
            
            $interval   = date_diff(date_create($from_date),date_create($to_date));
            $month      = date("m",strtotime($from_date));
            $now_target = "";
            if($month >= date("m") and $interval->days > 0  ){
                $now_target = $interval->days +1;
                if(strtotime($to_date) > strtotime(date('Y-m-d'))){
                    $now_target = date('d');
                }
            }
            
            $toal_day_in_month = cal_days_in_month(CAL_GREGORIAN,$month,date("Y"));
            
            if( $interval->days+1 < $now_target ){
                $toal_day_in_month = $toal_day_in_month/4;
                $now_target = $interval->days;
            }
            
            $target       = CsTarget::model()->getDefaultTargetInfo($date_type,$from_date,$to_date,$id_user);
            
            $present      = CsTarget::model()->getPresentInfoUser(array('user_id'=>$_POST['id_user'],'from'=>$from_date,'to'=>$to_date));
            
            $data_info    = array_merge($target,$present);
             
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('dashboard',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month));
            }else{
                $this->render('dashboard',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month));
            }
        }
        
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CsTarget the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
    {
		$model = CsTarget::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CsTarget $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='View-Frm-CsTarget')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionKeyPerformanceIndicators()
    {
        $list_month   =  Yii::app()->locale->getMonthNames();
        $model        = new CsTarget();
        if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('keyperformanceindicators',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
        else{
            $this->render('keyperformanceindicators',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
    }
}
