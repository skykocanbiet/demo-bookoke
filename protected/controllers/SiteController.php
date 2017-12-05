<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    protected function beforeAction($action) {
        
        if($action->id == 'login' || $action->id == 'register' || $action->id == 'ticket' ){
                $this->layout = '//layouts/layouts_login';
        }
        else{
            $this->layout = '//layouts/layouts_login';
        }
        return parent::beforeAction($action);
    }

	
	public function actionIndex()
	{
		// $function_name="listExtension";
		// $param=array("4","b471b02f1ac491391b9bd92c6f3a0b54");
		// try {
		// 	$client = new SoapClient("http://webservice.bookoke.com/soap/ws", array('cache_wsdl' => "WSDL_CACHE_NONE"));
		// 	$result = $client->$function_name(CJSON::encode($param)); 
  //           print_r(CJSON::decode($result));
		// } catch (SoapFault $fault) {
		// 	trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		// }
		// exit();
		// $extention = "105";
		// $phone = "01693339812";



		$soap = new SoapService();
		$rs= $soap->webservice_server_ws('getListSearchSchedules',array('3',"f278b6889790ba05cb19c640056c36e8","1","50","","","",""));
		echo "<pre>";
		print_r($rs);
		echo "</pre>";
		exit;
		$this->render('index');

	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else{
				if(Yii::app()->errorHandler->error['code'] == 404)
				    $this->renderPartial('404');
				else
				    $this->render('error', $error);
			}
		}
	}


}