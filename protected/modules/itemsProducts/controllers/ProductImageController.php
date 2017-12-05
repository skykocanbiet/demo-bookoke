<?php

class ProductImageController extends Controller
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
public function actions()
{	
    return array(
        'toggle' => array(
            'class'=>'booster.actions.TbToggleAction',
            'modelName' => 'ProductImage',
        )
    );
}
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
function change_file($target,$newcopy,$w,$h,$ext)
	{
		// print_r($target);
		// exit();
		list($w_orig,$h_orig)=getimagesize($target);

		$scale_ratio=$w_orig/$h_orig;
		if(($w/$h)>$scale_ratio)
		{
			$w=$h*$scale_ratio;
		}else
		{
			$h=$w*$scale_ratio;
		}
		$img="";
		if($ext=="png" || $ext=="PNG")
		{
			$img=imagecreatefrompng($target);
		}else
		if($ext=="gif" || $ext=="GIF")
		{
			$img=imagecreatefromgif($target);
		}else
		{
			$img=imagecreatefromjpeg($target);
		}
		$tci=imagecreatetruecolor($w,$h);
		$whiteBackground = imagecolorallocate($tci, 255, 255, 255);
		imagefill($tci,0,0,$whiteBackground);
		imagecopyresampled($tci,$img,0,0,0,0,$w,$h,$w_orig,$h_orig);
		imagejpeg($tci,$newcopy,80);
		
	}

public function actionCreate()
{

$model=new ProductImage;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['ProductImage']))
{
	$tmp_name=$_FILES["ProductImage"]["tmp_name"];
	$name=$_FILES["ProductImage"]["name"];
	$hinh_type=$_FILES["ProductImage"]["type"];
	$hinh_size=$_FILES["ProductImage"]["size"];
	$duoi = explode(".",$name['name_upload']);
	$filext=($duoi[1]=="png" or $duoi[1]=="PNG" or $duoi[1]=="jpg" or $duoi[1]=="JPG" or $duoi[1]=="gif" or $duoi[1]=="GIF")?$duoi[1]:"";
	$hinh_name=($_FILES["ProductImage"]["error"]['name_upload']==0)?$_FILES["ProductImage"]["name"]:"";
	// $hinh = $hinh_name['name_upload'];
	$hinh       = $_FILES['ProductImage']['name']['name_upload'];
	$ext        = pathinfo($hinh, PATHINFO_EXTENSION);
	$rnd = date("dmYHis");
	$newName = $rnd.'.'.$ext;
	if($hinh!="" and $filext!="")
	{
		
		// print_r($_FILES["ProductType"]["tmp_name"]['image']);
		// 	exit();
		$kq=move_uploaded_file($_FILES["ProductImage"]["tmp_name"]['name_upload'],"upload/product_image/lg/$newName");
		$fileSource =  Yii::getPathOfAlias('webroot'); 
		$target_file="upload/product_image/lg/$newName";
		$resized_file="upload/product_image/md/$newName";	
		$width=500;
		$height=500;
		$this->change_file($target_file,$resized_file,$width,$height,$filext);	
		
		$target_file="upload/product_image/lg/$newName";
		$resized_file="upload/product_image/sm/$newName";
		$width=250;
		$height=250;
		$this->change_file($target_file,$resized_file,$width,$height,$filext);
			
	}else
	{
		$hinh="Thất bại";
		print_r($hinh);
		exit();
	}
	// $rnd = date("d-m-Y-H-i-s");
	$model->attributes=$_POST['ProductImage'];
	$uploadedFile=CUploadedFile::getInstance($model,'name_upload');
	if($uploadedFile !== null)
	{
		// $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		$model->name_upload = $newName;
		$model->name=$uploadedFile;
	}
	if($model->save())
	{
		// if($uploadedFile !== null)
		// $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/product_image/'.$fileName);
		$this->redirect(array('view','id'=>$model->id));
	}
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

if(isset($_POST['ProductImage']))
{
	$rnd = date("d-m-Y-H-i-s");
	$_POST['ProductImage']['name_upload'] = $model->name_upload;

	$old_image=$model->name_upload;
	$model->attributes=$_POST['ProductImage'];
	$uploadedFile=CUploadedFile::getInstance($model,'name_upload');
	if($uploadedFile !== null)
	{
		$tmp_name=$_FILES["ProductImage"]["tmp_name"];
		$name=$_FILES["ProductImage"]["name"];
		$hinh_type=$_FILES["ProductImage"]["type"];
		$hinh_size=$_FILES["ProductImage"]["size"];
		$duoi = explode(".",$name['name_upload']);
		$filext=($duoi[1]=="png" or $duoi[1]=="PNG" or $duoi[1]=="jpg" or $duoi[1]=="JPG" or $duoi[1]=="gif" or $duoi[1]=="GIF")?$duoi[1]:"";
		$hinh_name=($_FILES["ProductImage"]["error"]['name_upload']==0)?$_FILES["ProductImage"]["name"]:"";
		// $hinh = $hinh_name['name_upload'];
		$hinh       = $_FILES['ProductImage']['name']['name_upload'];
		$ext        = pathinfo($hinh, PATHINFO_EXTENSION);
		$rnd = date("dmYHis");
		$newName = $rnd.'.'.$ext;
		if($hinh!="" and $filext!="")
		{
			
			// print_r($_FILES["ProductType"]["tmp_name"]['image']);
			// 	exit();
			$kq=move_uploaded_file($_FILES["ProductImage"]["tmp_name"]['name_upload'],"upload/product_image/lg/$newName");
			$fileSource =  Yii::getPathOfAlias('webroot'); 
			$target_file="upload/product_image/lg/$newName";
			$resized_file="upload/product_image/md/$newName";	
			$width=500;
			$height=500;
			$this->change_file($target_file,$resized_file,$width,$height,$filext);	
			
			$target_file="upload/product_image/lg/$newName";
			$resized_file="upload/product_image/sm/$newName";
			$width=250;
			$height=250;
			$this->change_file($target_file,$resized_file,$width,$height,$filext);
				
		}else
		{
			$hinh="Thất bại";
			print_r($hinh);
			exit();
		}

		// $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		$model->name_upload = $newName;
		$model->name=$uploadedFile;
	}
	if($model->save())
	{
		 if(!empty($uploadedFile))  // check if uploaded file is set or not
	    {	
	    	if($old_image!="" && $old_image!="no_image.png")
	    	{
	    		unlink(Yii::app()->basePath.'/../upload/product_image/lg/'.$old_image);
	    		unlink(Yii::app()->basePath.'/../upload/product_image/md/'.$old_image);
	    		unlink(Yii::app()->basePath.'/../upload/product_image/sm/'.$old_image);
	    	 	// $fullPath =Yii::app()->basePath.'/../upload/product_type/'.$fileName;
	    	}
	        // $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/product_image/'.$fileName);
	    }
		$this->redirect(array('view','id'=>$model->id));
	}
	
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
		$image =ProductImage::model()->findAll('id=:st',array(':st'=>$id));
		   if(count($image)!=0 and $image[0]['name_upload']!=""){
			   $xoa=$image[0]['name_upload'];
			   unlink(Yii::app()->basePath.'/../upload/product_image/lg/'.$xoa);
			   unlink(Yii::app()->basePath.'/../upload/product_image/md/'.$xoa);
			   unlink(Yii::app()->basePath.'/../upload/product_image/sm/'.$xoa);
			   //unlink("upload/post/promotion/$xoa");
		   }
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
$dataProvider=new CActiveDataProvider('ProductImage');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new ProductImage('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['ProductImage']))
$model->attributes=$_GET['ProductImage'];

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
$model=ProductImage::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='product-image-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
