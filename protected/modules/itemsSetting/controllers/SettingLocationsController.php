<?php

class SettingLocationsController extends Controller
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

	public function actionView()
	{
		/*$soap = new SoapService();
		$soapResult = $soap->webservice_server_ws("getAddNewNotiSchedule",array('1','317db7dbff3c4e6ec4bdd092f3b220a8','42','{"id":"118","code_schedule":"JDZR0009","code_active":null,"id_customer":"3","code_number":"1161219000","fullname":"Nguyen Van B","phone":"84123456789","image_customer":null,"status_customer":"1","id_dentist":"78","name_dentist":"\u0110\u1ed7 V\u0103n H\u1ea3i","id_author":"2","author":"Admin EDG","id_branch":"1","id_chair":"0","id_service":"101","name_service":"L\u1ea5y d\u1ea5u ch\u1ec9nh nha","code_service":"LDCN","lenght":"30","start_time":"2017-01-13 13:35:00","end_time":"2017-01-13 14:05:00","create_date":"2017-01-13 12:22:11","status":"1","status_active":"1","id_group_history":null,"id_quotation":null,"note":""}',"add"));

		echo "<pre>";
		print_r($soapResult);
		echo "</pre>";
		exit;*/

		$model = new Branch();
		$this->render('view',array("model"=>$model));
	}

	public function actionSearchBranchs()
	{

		$model 		   = new Branch;
		$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
		$lpp           = 20;
		$search_params = '';
		$orderBy 	   = '`name` ASC ';		

		if ($_POST['value']) 
		{
			$search_params= 'AND (`name` LIKE "%'.$_POST['value'].'%" ) OR (`id` LIKE "%'.$_POST['value'].'%" )';
		}

		$data  = $model->searchBranchs('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);
		if($cur_page > $data['paging']['cur_page']){	
			echo '<script>stopped = true; </script>';	
			exit;
		}

		$this->renderPartial('search_list',array('list_data'=>$data,'page'=>$data['paging']['cur_page']));

	}

	public function actionDetailBranch()
	{
		$model = new Branch();

		$data  = "";  

		if(isset($_POST['id']))
		{		
			$model 	= $model->findByPk($_POST['id']);

			$data	= BranchSchedule::model()->findAllByAttributes(array('id_branch'=>$_POST['id']));	
		}	

		$this->renderPartial('detail_branch',array(
				'model'=>$model,'data'=>$data
		),false,false);
	}

	public function actionAddNewBranch()
	{
	
		if($_POST['customerNewName'])
		{	
			$result = Branch::model()->addNewBranch($_POST['customerNewName']);

			echo $result;
		
		}
	}

	public function actionUpdateBranch()
	{		

		if($_POST['id'] && $_POST['name'])
		{	
			$result = Branch::model()->updateBranch(array('id'=>$_POST['id'], 'name'=>$_POST['name'], 'flag_online'=>$_POST['flag_online'], 'hotline1'=>$_POST['hotline1'], 'address'=>$_POST['address'], 'id_city'=>$_POST['id_city']));
			echo $result;		
		}	
		
	}

	public function actionUpdateBranchSchedule()
	{		

		if($_POST['id'])
		{	

			$str  = $_POST['hours'].":".str_pad($_POST['minutes'], 2, "0", STR_PAD_LEFT)." ".$_POST['ampm'];

			$time = date("H:i:s", strtotime($str));			
			
			$result = Branch::model()->updateBranchSchedule($_POST['id'], $_POST['flag'], $time);
			
			echo $result;		

		}	
		
	}

	public function actionUpdateBranchStatus()
	{		

		if($_POST['id'])
		{						
			
			$result = Branch::model()->updateBranchStatus($_POST['id'], $_POST['status']);
			
			echo $result;		

		}	
		
	}

}
