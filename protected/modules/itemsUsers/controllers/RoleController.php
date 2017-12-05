<?php

class RoleController extends Controller
{
    /**
    * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
    * using two-column layout. See 'protected/views/layouts/column2.php'.
    */
    public $layout='/layouts/main_role';
    
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
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $this->render('view',array(
        'model'=>$this->loadModel($id),
        ));
    }
    
    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
    {
        $model=new GpRole;
        $list_controller = GpController::model()->findAll();
        $list_action =  GpAction::model()->findAll();
		
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        
        if(isset($_POST['GpRole']))
        {
            $model->attributes=$_POST['GpRole'];
            $id_action = "-";
            foreach($list_controller as $key => $value){
                $id_controller = $value['id'];
                if(isset($_POST[$id_controller])){
                    foreach($_POST[$id_controller] as $temp){
                        $id_action = $id_action.$temp.'-';
                    }
                }
            }
            $model->action_id = $id_action;
            if($model->save())
            $this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('create',array('model'=>$model,'list_controller'=>$list_controller,'list_action'=>$list_action));
    }
    
    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        $list_controller = GpController::model()->findAll();
        $list_action =  GpAction::model()->findAll() ;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        
        if(isset($_POST['GpRole']))
        {
            $model->attributes=$_POST['GpRole'];
            
            $id_action = "-";
            foreach($list_controller as $key => $value){
                $id_controller = $value['id'];
                if(isset($_POST[$id_controller])){
                    foreach($_POST[$id_controller] as $temp){
                        $id_action = $id_action.$temp.'-';
                    }
                }
            }
            $model->action_id = $id_action;
            if($model->save())
            $this->redirect(array('view','id'=>$model->id));
        }
        
        $this->render('update',array(
        'model'=>$model,
        'list_controller'=>$list_controller,
        'list_action'=>$list_action
        ));
    }
    public function actionManager()
    {

        $data 			 = GpRole::model()->getControllersActions();
       
		$list_controller = GpController::model()->findAll();

        $this->render('manager');
    }
    
    public function actionViewActionContent(){
        
        if(isset($_POST['id'])){
            if($_POST['id'] == 1){
                echo '0';exit;
            }
            $list_controller = GpController::model()->findAll();
            $list_action     = GpAction::model()->findAll();
            $model           = GpRole::model()->findByAttributes(array('group_id'=>$_POST['id']));
            $this->renderPartial('view_content_actions',array('model'=>$model,'list_controller'=>$list_controller),false,true);
        }
    }

    public function actionUpdateRole(){
        if($_POST['GpRole']['group_id']){
            $list_controller = GpController::model()->findAll();
            $model           = new GpRole();
            $id_action       = "-";
            foreach($list_controller as $key => $value){
                $id_controller = $value['id'];
                if(isset($_POST[$id_controller])){
                    foreach($_POST[$id_controller] as $temp){
                        $id_action = $id_action.$temp.'-';
                    }
                }
            }
            $info_role = $model->findByAttributes(array('group_id'=>$_POST['GpRole']['group_id']));
            $return = $model->updateByPk($info_role->id,array('action_id'=>$id_action));
            if($return){
                echo '1';exit;
            }
            echo '-1';
        }
        
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
        $dataProvider=new CActiveDataProvider('GpRole');
        $this->render('index',array('dataProvider'=>$dataProvider,));
    }
    
    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new GpRole('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['GpRole']))
        $model->attributes=$_GET['GpRole'];
        
        $this->render('admin',array(
        'model'=>$model,
        ));
    }
    
    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded
    */
    public function loadModel($id)
    {
        $model=GpRole::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='gp-role-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDecentralize(){
        $this->render('decentralize');
    }
}
