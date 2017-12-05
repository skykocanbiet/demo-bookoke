<?php
class AdminController extends Controller
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
		/*
		$_REQUEST   = new CHttpRequest();
		echo "<pre>";
		print_r($_REQUEST->getUserHostAddress());
		echo "</pre>";
		exit;*/
		//$ip_address = IpRequest::model()->findByAttributes(array('ip_address'=>$_REQUEST->getUserHostAddress()));

	
		$ip_address = true;

		if($ip_address){
		
			//Get action name
			$current_action = strtolower($this->getAction()->getId());
			
			if(Yii::app()->user->isGuest && $current_action != 'login') {
				$this->redirect(array('admin/login'));
			}
		
			if($action->id == 'login'){
				$this->layout = '//layouts/layouts_login';
				return parent::beforeAction($action);
			}
			if($action->id == 'error'){
				$this->layout = '//layouts/layouts_login';
				return parent::beforeAction($action);
			}
			if($action->id == 'logout'){
				return parent::beforeAction($action);
			}

			$this->redirect('http://bookoke.com');

		}
		
		$this->redirect('http://bookoke.com');
    }

	public function checkIpRequestAdmin(){
	
		$_REQUEST   = new CHttpRequest();

		$ip_address = IpRequest::model()->findByAttributes(array('ip_address'=>$_REQUEST->getUserHostAddress()));
		if($ip_address){
			return true;
		}
		return false;
	}
	public function checkLoginAdmin(){
		//Get action name
        $current_action = strtolower($this->getAction()->getId());
		
		if(Yii::app()->user->isGuest && $current_action != 'login') {
            $this->redirect(array('home/index'));
        }
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
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
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginUserForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_GET['username']) && isset($_GET['password'])){
			$model=new LoginUserForm;
			$model->username = $_GET['username'];
			$model->password = $_GET['password'];


			if($model->validate() && $model->login()){

				Yii::app()->user->setState('registered', true);

				//$this->redirect(Yii::app()->user->returnUrl);
                if(Yii::app()->user->getState('queue_login') == '1') {
			        $this->redirect(array('site/registerextension'));
			    }
				
				if(Yii::app()->user->getState('group_id') ==  Yii::app()->params['id_group_subadmin']  ){
					$this->redirect('itemsSchedule/calendar/index');
			    }

			    if(Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_admin'] ){
					$this->redirect('itemsSchedule/calendar/index');
			    }

			    if(Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_dentist'] || Yii::app()->user->getState('group_id') ==  Yii::app()->params['id_group_receptionist']){
			    	$this->redirect('itemsSchedule/calendar/index');
			    }

			    if(Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_admin_support']){
			    	$this->redirect('itemsAccounting/Payable/Index');
			    }

			    if(Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_assistant']){
			    	$this->redirect('itemsCustomers/Accounts/admin');
			    }
			    
			    if(Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_customer_service']){
			    	$this->redirect('itemsSchedule/account/index');
			    }else{
			    	$this->redirect('home/error');
			    }
            }

            $this->redirect('http://bookoke.com/login');
            Yii::app()->end();
		}

		$this->redirect('http://bookoke.com/login');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{	
	
		$UserManager = new UserManager;
		$UserManager->saveHistoryLogout(Yii::app()->user->getState("history_login_id"));
		Yii::app()->user->logout();
        $this->redirect('http://bookoke.com/login');
	}
}