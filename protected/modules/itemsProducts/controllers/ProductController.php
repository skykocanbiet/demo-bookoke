<?php

class ProductController extends Controller
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
            'modelName' => 'Product',
        )
    );
}
public function actionShow()
{
	$this->layout = '/layouts/main_sup';
	$pl = new ProductLine;
	$this->render('show',array('pl'=>$pl));
}
public function actionDetailProductLine()
{		
	if(isset($_POST['id']) && isset($_POST['curpage'])) 
	{
		$p = new Product;									
		$id_product_line=$_POST['id'];		
		$curpage=$_POST['curpage'];	
		$searchProduct=isset($_POST['searchProduct'])?$_POST['searchProduct']:"";					
        $limit=20;
        $t = new CDbCriteria(array('condition'=>'published="true"'));
		$n = new CDbCriteria();
        if($id_product_line==0) 
		{
			
		}
      	else
      	{
      		$n->addCondition('t.id_product_line = :id_product_lin3');
			$n->params = array(':id_product_lin3' => $id_product_line);
      	}
		$n->addSearchCondition('code', $searchProduct, true);
		$n->addSearchCondition('name', $searchProduct, true, 'OR');	
		$t->mergeWith($n);
        $count=$id_product_line==0?count($p->findAll($n)):count($p->findAll($n));
        $pages=(($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;		   
        $page_list="";		       	
        if(($curpage!=1)&&($curpage))
		{
			$page_list.='<span onclick="pagination(1,'.$id_product_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang đầu'><<</a></span>";
		}
		if(($curpage-1)>0)
		{			
			$page_list.='<span onclick="pagination('.$curpage.'-1,'.$id_product_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Về trang trước'><</a></span>";
		}				
		$vtdau=max($curpage-3,1);
		$vtcuoi=min($curpage+3,$pages);				
		for($i=$vtdau;$i<=$vtcuoi;$i++)
		{
			if($i==$curpage)
			{
				$page_list.='<span style="background:rgba(115, 149, 158, 0.80);"  class="div_trang">'."<b style='color:#FFFFFF;'>".$i."</b></span>";
			}
			else
			{
				$page_list.='<span onclick="pagination('.$i.','.$id_product_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang ".$i."'>".$i."</a></span>";
			}
		}
		if(($curpage+1)<=$pages)
		{
			$page_list.='<span onclick="pagination('.$curpage.'+1,'.$id_product_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang sau'>></a></span>";
			$page_list.='<span onclick="pagination('.$pages.','.$id_product_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang cuối'>>></a></span>";
		}	

       	$lst=$page_list;
		$pr=$p->product_list_pagination($curpage,$id_product_line,$searchProduct); 

		$this->renderPartial('detail_product_line',array('pr'=>$pr,'lst'=>$lst),false,true);
	}
}
public function actionAddProduct()
{	
	$criteria = new CDbCriteria;
	$criteria->addCondition('status_product = 1');
	$criteria->addCondition('code = :code');
	$criteria->params = array(':code' => $_POST['Product_Code']);	

	if(Product::model()->findAll($criteria) == true) {
		echo '-1';
		exit;	
	}

	$p = new Product;
	$p->id_product_line=$_POST['ProductLineId'];
	$p->name=$_POST['Product_Name'];
	$p->description=$_POST['Product_Description'];
	$p->price=str_replace('.','',$_POST['Product_Price']);
	$p->code=$_POST['Product_Code'];
	$p->cost_price=str_replace('.','',$_POST['Product_CostPrice']);
	$p->point_donate=$_POST['Product_Point_Donate'];
	$p->point_exchange=$_POST['Product_Point_Exchange'];	
	$p->tax=$_POST['Product_Tax'];
	$p->save();
	
	$id_product=$p->findByAttributes(array('id_product_line'=>$_POST['ProductLineId'],'code'=>$_POST['Product_Code'],'name'=>$_POST['Product_Name']));		

	if(!empty($_FILES["Product_Image"]["tmp_name"]))
	{			
		foreach($_FILES["Product_Image"]["tmp_name"] as $key=>$tmp_name)
	    {
	    	if($_FILES["Product_Image"]["error"][$key]==0)
			{

				$pi = new ProductImage;	

				$fileImageUpload       = $_FILES['Product_Image']['tmp_name'][$key];

		        $fileTypeUpload        = explode('/',$_FILES['Product_Image']["type"][$key]);
		        
		        $imageNameUpload       = date("dmYHis").$key.'.'.$fileTypeUpload[1];

		        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/product_image/'; 

		        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

		        if($resultImage){          
		            $pi->id_product=$id_product['id'];
		       		$pi->name=$_FILES["Product_Image"]["name"][$key];
		       		$pi->url_action="product_image";
		       		$pi->name_upload=$imageNameUpload;
		       		$pi->update_time=date('Y-m-d');
		       		$pi->save();
		        } 

	        }
		}	
	
	}		
	
	if(isset($_POST['hidden_inventory_increase']))
	{
		$increase=json_decode($_POST['hidden_inventory_increase']);
		
		for ($i=0;$i<count($increase);$i++) 
		{		
			$productinventoryincrease=new ProductInventoryIncrease;				
			$productinventoryincrease->id_product=$id_product['id'];
			$productinventoryincrease->id_branch=$increase[$i]->id_branch;
			$productinventoryincrease->available=$increase[$i]->available;
			$productinventoryincrease->status=$increase[$i]->status;
			$productinventoryincrease->save();		
		}
	}

	if(isset($_POST['hidden_inventory_decrease']))
	{
		$decrease=json_decode($_POST['hidden_inventory_decrease']);
		
		for ($i=0;$i<count($decrease);$i++) 
		{		
			$productinventorydecrease=new ProductInventoryDecrease;				
			$productinventorydecrease->id_product=$id_product['id'];
			$productinventorydecrease->id_branch=$decrease[$i]->id_branch;
			$productinventorydecrease->available=$decrease[$i]->available;
			$productinventorydecrease->status=$decrease[$i]->status;
			$productinventorydecrease->save();		
		}
	}

	echo '1';
	exit;	
		
}	

public function actionAddProductLine()
{
	$pl=new ProductLine;
	$pl->id_product_type=1;			
	$pl->name=$_POST['productNewName'];					
	$pl->save();
	
	echo "1";
	exit;
		
}

public function actionUpdateProductLine()
{
	$pl=ProductLine::model()->findByPk($_POST['id_product_line']);		
	$pl->name=$_POST['productlineNewName'];					
	$pl->update();
	
	echo "1";
	exit;
		
}

public function actionDeleteProductLine()
{
	$pl=ProductLine::model()->findByPk($_POST['id']);		
	$pl->status_proline=0;					
	$pl->update();		
	Product::model()->updateAll(array('status_product'=>0),'id_product_line="'.$_POST['id'].'"');
	echo "1";
	exit;
	
}

public function actionUpdateProduct()
{	
	$criteria=new CDbCriteria;
	$criteria->addCondition('status_product = 1');
	$criteria->condition = "id != :id AND code = :code";
	$criteria->params = array (
	    ':id' => $_POST['id_product'], ':code' => $_POST['code_product'],
	);
	if(Product::model()->findAll($criteria)==true){
		echo '-1';
		exit;	
	}
	
	$p = Product::model()->findByPk($_POST['id_product']);	
	$p->id_product_line=$_POST["id_product_line_".$_POST['id_product'].""];	
	$p->name=$_POST['name_product'];
	$p->description=$_POST['description_product'];
	$p->price=str_replace('.','',$_POST['price_product']);
	$p->code=$_POST['code_product'];
	$p->cost_price=str_replace('.','',$_POST['costprice_product']);
	$p->point_donate=$_POST['point_donate_product'];
	$p->point_exchange=$_POST['point_exchange_product'];
	$p->tax=$_POST['tax_product'];
	$p->update();

	if(!empty($_FILES["image_product"]["tmp_name"]))
	{		
		$oldImage = ProductImage::model()->findAllByAttributes(array('id_product'=>$_POST['id_product']));
		if(!empty($oldImage)){
	    	foreach ($oldImage as $oi) 
	    	{	   
	    		$pis = new ProductImage; 		
	    		$pis->deleteImageScaleAndCrop($oi['name_upload']);	    		
	    	} 
	    	$pis->deleteAllByAttributes(array('id_product'=>$_POST['id_product']));
	    }

		foreach($_FILES["image_product"]["tmp_name"] as $key=>$tmp_name)
	    {
			if($_FILES["image_product"]["error"][$key]==0)
			{	
				$pi = new ProductImage;

				$fileImageUpload       = $_FILES['image_product']['tmp_name'][$key];

		        $fileTypeUpload        = explode('/',$_FILES['image_product']["type"][$key]);
		        
		        $imageNameUpload       = date("dmYHis").$key.'.'.$fileTypeUpload[1];

		        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/product_image/'; 

		        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

		        if($resultImage){		            
		            
	            	$pi->id_product=$_POST['id_product'];
		       		$pi->name=$_FILES["image_product"]["name"][$key];
		       		$pi->url_action="product_image";
		       		$pi->name_upload=$imageNameUpload;
		       		$pi->update_time=date('Y-m-d');
		       		$pi->save();
		                      
		        }       
		        
			}
		}

	}		

	if(isset($_POST['ud_hidden_inventory_increase']))
	{
		$increase=json_decode($_POST['ud_hidden_inventory_increase']);
		
		for ($i=0;$i<count($increase);$i++) 
		{		
			$productinventoryincrease=new ProductInventoryIncrease;				
			$productinventoryincrease->id_product=$_POST['id_product'];
			$productinventoryincrease->id_branch=$increase[$i]->id_branch;
			$productinventoryincrease->available=$increase[$i]->available;
			$productinventoryincrease->status=$increase[$i]->status;
			$productinventoryincrease->save();		
		}
	}

	if(isset($_POST['ud_hidden_inventory_decrease']))
	{
		$decrease=json_decode($_POST['ud_hidden_inventory_decrease']);
		
		for ($i=0;$i<count($decrease);$i++) 
		{		
			$productinventorydecrease=new ProductInventoryDecrease;				
			$productinventorydecrease->id_product=$_POST['id_product'];
			$productinventorydecrease->id_branch=$decrease[$i]->id_branch;
			$productinventorydecrease->available=$decrease[$i]->available;
			$productinventorydecrease->status=$decrease[$i]->status;
			$productinventorydecrease->save();		
		}
	}	

	echo $_POST['code_product'];
	exit;		
		
}
public function actionDeleteProduct()
{		
	$p = Product::model()->findByPk($_POST['id']);
	$p->status_product=0;
	$p->update();

	$pi = new ProductImage;
	$pi->deleteAllByAttributes(array('id_product'=>$_POST['id']));
	$oldImage = $pi->findByAttributes(array('id_product'=>$_POST['id']));
	if($oldImage['name_upload']){
        $pi->deleteImageScaleAndCrop($oldImage['name_upload']);       
    }

	echo '1';
	exit;			
}
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new Product;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Product']))
{
$model->attributes=$_POST['Product'];
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

if(isset($_POST['Product']))
{
$model->attributes=$_POST['Product'];
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
$dataProvider=new CActiveDataProvider('Product');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Product('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Product']))
$model->attributes=$_GET['Product'];

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
$model=Product::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
/*------------------------------------------LMV---------------------------------------------------------*/
	public function actioncountservice()
	{
		if($_POST['id'] != 0){
			$data = count(Product::model()->findAllByAttributes(array("id_product_line"=>$_POST['id'])));
			echo '('.$data.')';
			exit();
		}else{
			$data = count(Product::model()->findAll());
			echo '('.$data.')';
			exit();
		}
	}
}
