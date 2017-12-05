<?php

class ExtensionCallController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='/layouts/main_extension';


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
	// $soap = new SoapService();
	// $rs= $soap->webservice_server_ws('listExtension',array("4","b471b02f1ac491391b9bd92c6f3a0b54"));
	// $listextension = json_decode($rs,true);
	// if ($listextension) {
	// 	$data = CsExtensionCall::model()->updateExtensionNew($listextension);
	// }
	$data = CsExtensionCall::model()->findAll();
	if ($data) {
		$this->render('view',array("listextension"=>$data));
	}
	
}

/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new CsExtensionCall;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['CsExtensionCall']))
{
$model->attributes=$_POST['CsExtensionCall'];
if($model->save())
$this->redirect(array('view','id'=>$model->id));
}

$this->render('create',array(
'model'=>$model,
));
}

/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/
public function actionUpdate($id)
{
$model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['CsExtensionCall']))
{
$model->attributes=$_POST['CsExtensionCall'];
if($model->save())
$this->redirect(array('view','id'=>$model->id));
}

$this->render('update',array(
'model'=>$model,
));
}

/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/
public function actionDelete($id)
{
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('CsExtensionCall');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
	$model=new CsExtensionCall('search');
	$model->unsetAttributes();  // clear any default values
	if(isset($_GET['CsExtensionCall']))
	$model->attributes=$_GET['CsExtensionCall'];

	$this->render('admin');
}

public function actionRegisterExtension()
{
	if (isset($_POST['id_user']) && $_POST['id_user']) {
		$data = CsExtensionCall::model()->RegisterExtension($_POST['id_user'],$_POST['extension']);
		if ($data) {
			echo "1";
		}else
		{
			echo "0";
		}
	}
}
/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=CsExtensionCall::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='cs-extension-call-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
