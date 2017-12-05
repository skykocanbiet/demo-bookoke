<?php

class MaterialController extends Controller
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

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView()
	{
		$model = new VMaterial;
		$this->render('_view',array('model'=>$model));
	}

	public function actionAddMaterial()
	{	
		

		if(Material::model()->findAll('code=:st',array(':st'=>$_POST['Product_Code']))==true){
			echo '-1';
			exit;	
		}

		$p = new Material;
		$p->id_material_line=$_POST['ProductLineId'];
		$p->name=$_POST['Product_Name'];
		$p->description=$_POST['Product_Description'];
		$p->price=str_replace('.','',$_POST['Product_Price']);
		$p->code=$_POST['Product_Code'];
		$p->cost_price=str_replace('.','',$_POST['Product_CostPrice']);
		$p->point_donate=$_POST['Product_Point_Donate'];
		$p->point_exchange=$_POST['Product_Point_Exchange'];	
		
		$p->save();
		
		$id_product=$p->findByAttributes(array('id_material_line'=>$_POST['ProductLineId'],'code'=>$_POST['Product_Code'],'name'=>$_POST['Product_Name']));		

		if(!empty($_FILES["Product_Image"]["tmp_name"]))
		{			
			
		    	if($_FILES["Product_Image"]["error"]==0)
				{

					$pi = new MaterialImage;	

					$fileImageUpload       = $_FILES['Product_Image']['tmp_name'];

			        $fileTypeUpload        = explode('/',$_FILES['Product_Image']["type"]);
			        
			        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

			        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/material_image/'; 

			        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

			        if($resultImage){          
			            $pi->id_material=$id_product['id'];
			       		$pi->name=$_FILES["Product_Image"]["name"];
			       		$pi->url_action="product_image";
			       		$pi->name_upload=$imageNameUpload;
			       		$pi->update_time=date('Y-m-d');
			       		$pi->save();
			        } 

		        }
				
		
		}		
		
		// if(isset($_POST['hidden_inventory_increase']))
		// {
		// 	$increase=json_decode($_POST['hidden_inventory_increase']);
			
		// 	for ($i=0;$i<count($increase);$i++) 
		// 	{		
		// 		$productinventoryincrease=new ProductInventoryIncrease;				
		// 		$productinventoryincrease->id_product=$id_product['id'];
		// 		$productinventoryincrease->id_branch=$increase[$i]->id_branch;
		// 		$productinventoryincrease->available=$increase[$i]->available;
		// 		$productinventoryincrease->status=$increase[$i]->status;
		// 		$productinventoryincrease->save();		
		// 	}
		// }

		// if(isset($_POST['hidden_inventory_decrease']))
		// {
		// 	$decrease=json_decode($_POST['hidden_inventory_decrease']);
			
		// 	for ($i=0;$i<count($decrease);$i++) 
		// 	{		
		// 		$productinventorydecrease=new ProductInventoryDecrease;				
		// 		$productinventorydecrease->id_product=$id_product['id'];
		// 		$productinventorydecrease->id_branch=$decrease[$i]->id_branch;
		// 		$productinventorydecrease->available=$decrease[$i]->available;
		// 		$productinventorydecrease->status=$decrease[$i]->status;
		// 		$productinventorydecrease->save();		
		// 	}
		// }

		echo '1';
		exit;	
			
	}


	public function actionViewListMaterial()
	{		
		
	if(isset($_POST['id']) && isset($_POST['curpage'])) 
	{
		$p = new Material;									
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
      		$n->addCondition('t.id_material_line = :id_product_lin3');
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
		$pr=$p->material_list_pagination($curpage,$id_product_line,$searchProduct); 

		$this->renderPartial('view_list_material',array('pr'=>$pr,'lst'=>$lst),false,true);
	}
	}
	
	public function actionAddMaterialLine()
	{
		$pl=new MaterialLine;
		$pl->id_material_type=1;			
		$pl->name=$_POST['materialNewName'];					
		$pl->save();
		
		echo "1";
		exit;
			
	}

	public function actionUpdateMaterial()
	{	
		$criteria=new CDbCriteria;
		$criteria->addCondition('status_material = 1');
		$criteria->condition = "id != :id AND code = :code";
		$criteria->params = array (
		    ':id' => $_POST['id_product'], ':code' => $_POST['code_product'],
		);
		if(Product::model()->findAll($criteria)==true){
			echo '-1';
			exit;	
		}
		
		$p = Material::model()->findByPk($_POST['id_product']);	
		$p->id_material_line=$_POST["id_product_line_".$_POST['id_product'].""];	
		$p->name=$_POST['name_product'];
		$p->description=$_POST['description_product'];
		$p->price=str_replace('.','',$_POST['price_product']);
		$p->code=$_POST['code_product'];
		$p->cost_price=str_replace('.','',$_POST['costprice_product']);
		$p->point_donate=$_POST['point_donate_product'];
		$p->point_exchange=$_POST['point_exchange_product'];
		


		$p->update();

		if(!empty($_FILES["image_product"]["tmp_name"]))
		{		
			$oldImage = MaterialImage::model()->findAllByAttributes(array('id_material'=>$_POST['id_product']));
			if(!empty($oldImage)){
		    	foreach ($oldImage as $oi) 
		    	{	   
		    		$pis = new MaterialImage; 		
		    		$pis->deleteImageScaleAndCrop($oi['name_upload']);	    		
		    	} 
		    	$pis->deleteAllByAttributes(array('id_material'=>$_POST['id_product']));
		    }

		
				if($_FILES["image_product"]["error"]==0)
				{	
					$pi = new MaterialImage;

					$fileImageUpload       = $_FILES['image_product']['tmp_name'];

			        $fileTypeUpload        = explode('/',$_FILES['image_product']["type"]);
			        
			        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

			        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/material_image/'; 

			        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

			        if($resultImage){		            
			            
		            	$pi->id_material=$_POST['id_product'];
			       		$pi->name=$_FILES["image_product"]["name"];
			       		$pi->url_action="product_image";
			       		$pi->name_upload=$imageNameUpload;
			       		$pi->update_time=date('Y-m-d');
			       		$pi->save();
			                      
			        }       
			        
				}
			

		}			

		echo $_POST['code_product'];
		exit;		
			
	}

	public function actionUpdateMaterialLine()
	{
		$pl=MaterialLine::model()->findByPk($_POST['id_material_line']);		
		$pl->name=$_POST['materiallineNewName'];					
		$pl->update();
		
		echo "1";
		exit;
			
	}

	public function actionDeleteProductLine()
	{
		$pl=MaterialLine::model()->findByPk($_POST['id']);		
		$pl->status_proline=0;					
		$pl->update();		
		Material::model()->updateAll(array('status_material'=>0),'id_material_line="'.$_POST['id'].'"');
		echo "1";
		exit;
		
	}

	public function actionDeleteMaterial()
	{		
		$p = Material::model()->findByPk($_POST['id']);
		$p->status_material=0;
		$p->update();

		

		echo '1';
		exit;			
	}

/*------------------------------------------LMV---------------------------------------------------------*/
	// public function actioncountservice()
	// {
	// 	if($_POST['id'] != 0){
	// 		$data = count(MaterialLine::model()->findAllByAttributes(array("id_material_line"=>$_POST['id'])));
	// 		echo '('.$data.')';
	// 		exit();
	// 	}else{
	// 		$data = count(MaterialLine::model()->findAll());
	// 		echo '('.$data.')';
	// 		exit();
	// 	}
	// }
}