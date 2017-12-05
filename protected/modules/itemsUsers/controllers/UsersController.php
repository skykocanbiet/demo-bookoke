<?php

class UsersController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
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
    // public function actionToggleBlock($id) {
    //     $model = $this->loadModel($id);
     
    //     if(!is_null($model) && $model->hasAttribute('block')) {
    //         $model->block = $model->block == 0 ? 1 : 0;
    //         $model->update(); // no validation
    //     }
    // }
    // public function actions()
    // {   
    //     return array(
    //         'toggle' => array(
    //             'class'=>'booster.actions.TbToggleAction',
    //             'modelName' => 'gp_users',
    //         )
    //     );
    // }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id)
        ));
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
	 
	 public function actions()
    {   
        return array(
            'toggle' => array(
                'class'=>'booster.actions.TbToggleAction',
                'modelName' => 'GpUsers',
            )
        );
    }
    public function actionCreate()
    {
        $model = new GpUsers;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        
        if (isset($_POST['GpUsers'])) {
            $model->attributes      = $_POST['GpUsers'];
            $model->id_branch       =  1;
            $model->createDate      = date('Y-m-d H:i:s');
            $model->password        = md5($_POST['GpUsers']['password']);
            $model->repeatpassword  = md5($_POST['GpUsers']['repeatpassword']);
            $model->lastvisitDate   =  null;

            if($_FILES['GpUsers'] && $_FILES['GpUsers']['error']["image"] == 0){
                $model->image    = $_FILES['GpUsers'];
            }

            
            if($model->validate()){
                //Neu ton tai anh moi => kiem tra cap nhat lai avatar moi       
                if($_FILES['GpUsers']['error']["image"] == 0){


                    $fileImageUpload       = $_FILES['GpUsers']['tmp_name']['image'];

                    $fileTypeUpload        = explode('/',$_FILES['GpUsers']["type"]["image"]);

                    
                    $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

                    $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/users/'; 


                    $resultImage = $model->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

                    $model->image          = Null;
                    
                    if($resultImage){
                        $model->image = $imageNameUpload;
                    } 

                }


                if($model->save()){
                    $this->redirect(array('admin','id'=>$model->id));
                    Yii::app()->end();
                }
            } 

        }
        $this->render('create', array('model' => $model),false,true);
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $model->repeatpassword = $model->password;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['GpUsers']))
        {

            $old_password        = $model->password;
             

            $oldImage        = $model->image;

            $model->attributes   = $_POST['GpUsers'];

            if($_FILES['GpUsers'] && $_FILES['GpUsers']['error']["image"] == 0){
                $model->image    = $_FILES['GpUsers'];
            }
   /*         echo '<pre>';
            print_r($_FILES['GpUsers']);
            echo '</pre>';
            exit();*/
            if($model->validate())
            {

                // New ton tai password moi, Kiem tra cap nhat password 
                if($model->password != $old_password && $model->repeatpassword == $model->password){
                    $model->password = md5($_POST['GpUsers']['password']);
                    $model->repeatpassword = $model->password;
                }
/*                echo "<pre>";
                print_r($_FILES);
                echo "</pre>";
                 echo "<pre>";
                print_r($model->image);
echo "</pre>";
                exit();*/
                //Neu ton tai anh moi => kiem tra cap nhat lai avatar moi       
                if($_FILES['GpUsers']['error']["image"] == 0)
                {

                        $fileImageUpload       = $_FILES['GpUsers']['tmp_name']['image'];
                        $fileTypeUpload        = explode('/',$_FILES['GpUsers']["type"]["image"]);
                        
                        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];
                        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/users/'; 

                        $resultImage = $model->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

                        if($resultImage){
                            if($oldImage){
                                $model->deleteImageScaleAndCrop($oldImage);
                            }
                            $model->image = $imageNameUpload;
                        }else{
                            $model->image = "";
                        }    

                }

                if ($model->save())
                {
                    $this->redirect(array('view','id'=>$model->id));
                    //$this->renderPartial('admin', array( 'model' => $model),false,true);
                }
            }
            
        }
        $this->render('update', array('model' => $model),false,true);
    }
    
    public function actionBlock_Toggle()
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['GpUsers'])) {
            $model->attributes = $_POST['GpUser'];
            if ($model->save())
            {
                $this->renderPartial('admin', array( 'model' => $model),false,true);
            }
        }
        
        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'admin'
                ));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
    public function actionUpdateNotification(){
        if($_POST['id_notification']){
			$model = new CsNotificationsHistory();
			
			$data_noti = $model->findByAttributes(array("id_notification"=>$_POST['id_notification'],"id_user"=>Yii::app()->user->getState('user_id')));
			
			if($data_noti){
				echo 0;
			}else{
				$model = new CsNotificationsHistory();
				$model->id_notification = $_POST['id_notification'];
				$model->id_user = Yii::app()->user->getState('user_id');
				$model->save(false);
                if($model->save(false)){
                    echo 1;
                }
				
			}
        }
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('GpUsers');
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    public function actionTestSend(){

        $mailHost      = 'ssl://mail.bookoke.com';
        $mailPort      = '465';
        $username      = 'support@bookoke.com';
        $password      = 'callneX@2017';
        $mailFrom      = 'hanh.nguyen@bookoke.com';
        $title         = 'BookOke Support';
        $mailTo        = 'hanh.nguyen@bookoke.com';
        $email_content = 'dang test mail24-2-2017';

        $rs=  CsNotifications::model()->sendMail($mailHost,$mailPort,$username,$password,$mailFrom,$mailTo,$title,$email_content);

        var_dump($rs);
       /* $regId   = "eZq-9xeen_s:APA91bH0TrwFfZ8UX3DiyZfCgNnlxFbuno3-JflZRnhambZdHMrw4c8ZIoangLFnNUtAggvQxkKJEZoYF8mIWEEgGtuC-DsWnaK4I3oAhkBcTl8UCrah5xY3VZgqKmgEFanpuf7k2jhc";
        $title   = "Dat lich hen";
        $message = "Ban co lich moi tu khach hang";
        $data    = "dang cap nhat";

        $model      = new CsNotifications();
        $response   = $model->sendPush($regId,$title,$message,$data);
        var_dump($response);*/

     /*   $soapClient = new SoapClients();
          $response =$soapClient->getListSearchSchedules("1", "25", "", "0", "2017-02-12", "2017-02-18");
           var_dump($response);*/


    }
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {

        $model = new GpUsers('search');

        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['GpUsers']))
            $model->attributes = $_GET['GpUsers'];

        $this->render('admin', array( 'model' => $model),false,true);
    }

    
    /**
     * Returns the data model based on the primary key given in the GET variable.
      If the data model is not found, an HTTP exception will be raised.
     @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = GpUsers::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gp-users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
?>