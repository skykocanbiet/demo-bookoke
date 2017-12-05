<?php

class LeadController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/layouts_menu';

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

	/**
	* Manages all models.
	*/
	public function actionViewLead()
	{
		$model = new CsLeadCustomer;
		$this->render('view_lead',array(
			'model'=>$model,
		));
	}

	public function actionSearchLeadCustomers()
	{

		$model 		   = new CsLeadCustomer;
		$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
		$lpp           = 12;
		$search_params = '';

		$orderBy 	   = '`fullname` ASC ';

		if ($_POST['value']) 
		{
			$search_params= 'AND (`fullname` LIKE "%'.$_POST['value'].'%" )';
		}

		$data  = $model->searchLeadCustomers('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);

		$this->renderPartial('search_list',array('list_data'=>$data));

	}

	public function actionDetailLeadCustomers()
	{
		$model = new CsLeadCustomer();

		if(isset($_POST['id']))
		{
			$model 	= $model->findByPk($_POST['id']);	
		}
		$this->renderPartial('view_information',array(
				'model'=>$model
		),false,false);
	}

	public function actionAdd()
	{
		$customer=new Customer;
		$csleadcustomer=new CsLeadCustomer;
		$customerlead=new CustomerLead;
		if(isset($_POST['customerNewName']) && isset($_POST['customerNewPhone']))
		{	
			$phone=$customer->getVnPhone($_POST['customerNewPhone']);

			$customer->code_number='1'.$customer->getCodeNumberCustomer();
			$customer->fullname=$_POST['customerNewName'];
			$customer->phone=$phone;					
			$customer->save();

			if($csleadcustomer->findAll('phone=:st',array(':st'=>$phone))==true) 
			{
				echo "-1";
				exit;					
			}
			else
			{	
				$csleadcustomer->fullname=$_POST['customerNewName'];			
				$csleadcustomer->phone=$phone;			
				$csleadcustomer->source=1;			
				$csleadcustomer->save();			
			}
			$id_lead=$csleadcustomer->findByAttributes(array('phone'=>$phone));	
			$id_customer=$customer->findByAttributes(array('phone'=>$phone));
			$customerlead->id_lead=$id_lead['id'];
			$customerlead->id_customer=$id_customer['id'];			
			if($customerlead->save())
			{
				echo "1";
				exit;
			}
			
		}
	}

	public function actionUpdateCustomerImage()
	{
		if(isset($_POST['id']))
		{
			$id=$_POST['id'];
			$data=Customer::model()->findBypk($id);
			$rnd = date("d-m-Y-H-i-s");			
			$image=$_FILES["image123"]["error"]==0?"{$rnd}-{$_FILES["image123"]["name"]}":$data['image'];
			$kq=Customer::model()->updateByPk($id, array('image'=>$image));	
			if($kq)
			{
				if($_FILES["image123"]["error"]==0)
				{
					if($data['image']!="" && $data['image']!="no_image.png" && $data['image']!="no_avatar.png")
					{
						unlink(Yii::app()->basePath.'/../upload/customer/'.$data['image']);
					}
					move_uploaded_file($_FILES["image123"]["tmp_name"],"./upload/customer/$image");
				}

			}	
			$model=Customer::model()->findBypk($id);
			$this->renderPartial('customer_image',array('model'=>$model),false,true);	
		}
	}

	public function actionUpdateCustomer()
	{
		if(isset($_POST['id']))
		{
			$id=$_POST['id'];
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			$phone=Customer::model()->getVnPhone($_POST['phone']);
			$gender=$_POST['gender'];
			$birthdate=$_POST['birthdate'];
			$identity_card_number=$_POST['identity_card_number'];
			$id_country=$_POST['id_country'];
			$id_job=$_POST['id_job'];
			$position=$_POST['position'];
			$organization=$_POST['organization'];
			$address=$_POST['address'];
			Customer::model()->updateByPk($id, array('fullname'=>$fullname,'email'=>$email,'phone'=>$phone,'gender'=>$gender,'birthdate'=>$birthdate,'identity_card_number'=>$identity_card_number,'id_country'=>$id_country,'id_job'=>$id_job,'position'=>$position,'organization'=>$organization,'address'=>$address));	
		}

	}



	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model = CustomerLead::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	}
}
