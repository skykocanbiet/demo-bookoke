<?php

class DashBoardBusinessController extends Controller
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

        $id_user  = Yii::app()->user->getState('id_user');
        $id_branch ='';
        $group_no = Yii::app()->user->getState('group_no');

        if($group_no=='admin'||$group_no=='manager'||$group_no=='superadmin' || $group_no=='puplicoffice')
        {
            $id_user = "";
        }else{
            $target_user = CsTarget::model()->findByAttributes(array('user_id'=>$id_user,'month'=>date('m'),'year'=>date('Y')));
            if(!$target_user){
                CsTarget::model()->AutoSetTargetUser($id_user,date('m'),date('Y'));
            }
        }

        $list_month   =  Yii::app()->locale->getMonthNames();

        $list_week    =  Yii::app()->getDateFormatter();

        $from_date    =  date('Y-m-d').' 00:00:00';
        $to_date      =  date('Y-m-d').' 23:59:59';
        
        $target       = CsTarget::model()->getDefaultTargetInfo('today',$from_date,$to_date,$id_user,$id_branch);
        
        $present      = CsTarget::model()->getPresentInfoUser(array('user_id'=>$id_user,'from'=>$from_date,'to'=>$to_date,'id_branch'=>$id_branch));
        $data_info    = array_merge($target,$present);
        $this->render('index',array('data_info'=>$data_info,'id_user'=>$id_user));
    }

    public function actionSearchDashboard(){

        if($_POST['from_day'] && $_POST['to_day'] ){
            $from_date    = $_POST['from_day'].' 00:00:00';
            $to_date      = $_POST['to_day'].' 23:59:59';
            $date_type    = $_POST['date_type'];
            $id_user      = $_POST['id_user'];
            $id_branch      = $_POST['id_branch'];
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
            
            $target       = CsTarget::model()->getDefaultTargetInfo($date_type,$from_date,$to_date,$id_user,$id_branch);

            $present      = CsTarget::model()->getPresentInfoUser(array('user_id'=>$id_user,'from'=>$from_date,'to'=>$to_date,'id_branch'=>$id_branch));

            $data_info    = array_merge($target,$present);

            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('ajax_search_dashboard',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month));
            }
            else{
                $this->render('ajax_search_dashboard',array('data_info'=>$data_info,'now_target'=>$now_target,'toal_day_in_month'=>$toal_day_in_month));
            }
        }
    }
    public function actionGetTime()
    {
        if ($_POST['time']=='today') // ngày hiện tại
        {
            $fromdate = date("Y-m-d");
            $todate= date("Y-m-d");
        }
        else if($_POST['time']=='week') // Tuần hiện tại
        {   
            $fromdate = date("Y-m-d",strtotime('monday this week'));
            $todate= date("Y-m-d",strtotime('sunday this week'));

        }
        else if($_POST['time']=='month') //  tháng hiện tại
        {
            $fromdate = date("Y-m-01", strtotime("first day of this month"));
            $todate= date("Y-m-t", strtotime("last day of this month"));
        }
        $arrayTime = array('fromdate' => $fromdate,'todate'=>$todate);
        print_r(json_encode($arrayTime));
    }
    public function actionChangeBranch()
    {
        if (isset($_POST['dataBranch']) && $_POST['dataBranch']) {
            $listdata     = array();
            $listdata[""] = "Tất cả";
            $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3,'id_branch'=>$_POST['dataBranch']));
            foreach($User as $temp){
                $listdata[$temp['id']] =  $temp['name'];
            }
            echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control','onChange'=>'SearchDashboard()'));
        }
        else{
            $listdata     = array();
            $listdata[""] = "Tất cả";
            $User         = GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
            foreach($User as $temp){
                $listdata[$temp['id']] =  $temp['name'];
            }
            echo CHtml::dropDownList('frm_search_user_id','',$listdata,array('class'=>'form-control','onChange'=>'SearchDashboard()'));
        }
        
    }
}
