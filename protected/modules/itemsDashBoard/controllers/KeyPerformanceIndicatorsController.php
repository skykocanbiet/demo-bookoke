<?php

class KeyPerformanceIndicatorsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	   if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('index',array());
        }
        else{
            $this->render('index',array());
        }
	}
  
    public function actionKpi()
    {
        $list_month   =  Yii::app()->locale->getMonthNames();
        $model        = new CsTarget();
        if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('view_kpi',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }else{
            $this->render('view_kpi',array('model'=>$model,'list_month'=>$list_month,'subject_js'=>Yii::app()->controller->id));
        }
    }
    public function actionAjaxSearchKpi(){
        if($_POST['from_day'] && $_POST['to_day'] ){
            $from_date    = $_POST['from_day'].' 00:00:00';
            $to_date      = $_POST['to_day'].' 23:59:59';
            $user_id      = $_POST['user_id'];
            $date_type    = $_POST['date_type'];
        
            $interval   = date_diff(date_create($from_date),date_create($to_date));// khoang thoi gian from day to day
            $month      = date("m",strtotime($to_date));
            $now_target = "";
            
            
            if($month >= date("m") and $interval->days > 0  ){
                $now_target = $interval->days +1;
                if(strtotime($to_date) > strtotime(date('Y-m-d'))){
                    $now_target = date('d');
                }
            }
            
            $toal_day_in_month = cal_days_in_month(CAL_GREGORIAN,$month,date("Y"));
            
            if( strtotime(date('Y-m-d')) <= strtotime($to_date) &&  $interval->days > 30 && $date_type = 'quarters' )
            {
                $interval          = date_diff(date_create($from_date),date_create(date('Y-m-d')));
                $now_target        = $interval->days +1;
                $to_date           = date('Y-m-d');
            }
            
            if($interval->days > 30 && $date_type = 'quarters'){
                $toal_day_in_month = $interval->days +1;
                $now_target        = $interval->days +1;
            }
            
            $target     = CsTarget::model()->getDefaultTargetInfo($date_type,$from_date,$to_date,$user_id);
            
            $present    = CsTarget::model()->getPresentInfoUser(array('user_id'=>$_POST['user_id'],'from'=>$from_date,'to'=>$to_date));
            
            $data_info  = array_merge($target,$present);
            
            $presentday = CsTarget::model()->getPresentDay(array('user_id'=>$_POST['user_id'],'from'=>$from_date,'to'=>$to_date));
            
            $fileSource = dirname(__FILE__).DIRECTORY_SEPARATOR.'../views/keyPerformanceIndicators/keyactivities.json';
            
            $keyactivities = json_decode(file_get_contents($fileSource));
            
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('ajax_search_kpi',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month,'month'=>$month,'presentday'=>$presentday,'keyactivities'=>$keyactivities),false,true);
            }
            else{
                $this->render('ajax_search_kpi',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month,'month'=>$month,'presentday'=>$presentday,'keyactivities'=>$keyactivities),false,true);
            }
        }
    }
    public function actionSave_key_activities(){
        
        $fileSource = dirname(__FILE__).DIRECTORY_SEPARATOR.'../views/keyPerformanceIndicators/keyactivities.json';
        file_put_contents($fileSource,$_POST['datakpi']);
        if(is_array(json_decode(file_get_contents($fileSource)))){
            echo "1";exit;
        }
        echo "-1";
    }
    public function actionAjax_search_key_activities(){
        
        $fileSource    = dirname(__FILE__).DIRECTORY_SEPARATOR.'../views/keyPerformanceIndicators/keyactivities.json';
        
        $keyactivities = json_decode(file_get_contents($fileSource));
        
        if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('view_key_activities_kpi',array('keyactivities'=>$keyactivities));
        }
        else{
            $this->render('view_key_activities_kpi',array('keyactivities'=>$keyactivities));
        }
    }
    
}
