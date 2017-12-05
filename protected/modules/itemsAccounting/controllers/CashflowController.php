<?php

class CashflowController extends Controller
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
    
    /** CASHFLOW **/
    public function actionIndex(){
        $model = new VOrder;
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('viewCashflow',array('model'=>$model));
        }
        else{
            $this->render('viewCashflow',array('model'=>$model));
        }
    }

    public function actionSearchCashflow(){
        
        $cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
        $lpp           = Yii::app()->params['lpp10'];
        $search_params = array();
    
        if($_REQUEST['from_date'] && $_REQUEST['to_date']){
            $from = $_REQUEST['from_date'].' 00:00:00';
            $to   = $_REQUEST['to_date'].' 23:59:59';
        }else{
            $from   = date("Y-m-d").' 00:00:00';
            $to     = date("Y-m-d").' 23:59:59';
        }

        $this->renderPartial('searchCashflowOfYear',array('data'=>array()));
        
    }

}
