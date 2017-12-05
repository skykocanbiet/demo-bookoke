<?php

class PackagesController extends Controller
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
		$pl = new PackageLine;
		$this->render('view',array('pl'=>$pl));
	}

	public function actionDetailPackageLine()
	{		
		if(isset($_POST['id']) && isset($_POST['curpage'])) 
		{
			$p = new Package;									
			$id_package_line=$_POST['id'];		
			$curpage=$_POST['curpage'];	
			$searchPackage=isset($_POST['searchPackage'])?$_POST['searchPackage']:"";					
	        $limit=20;
	        $t = new CDbCriteria(array('condition'=>'published="true"'));
			$n = new CDbCriteria();
	        if($id_package_line==0) 
			{
				
			}
	      	else
	      	{
	      		$n->addCondition('t.id_package_line = :id_package_lin3');
				$n->params = array(':id_package_lin3' => $id_package_line);
	      	}
			$n->addSearchCondition('code', $searchPackage, true);
			$n->addSearchCondition('name', $searchPackage, true, 'OR');	
			$t->mergeWith($n);
	        $count=$id_package_line==0?count($p->findAll($n)):count($p->findAll($n));
	        $pages=(($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;		   
	        $page_list="";		       	
	        if(($curpage!=1)&&($curpage))
			{
				$page_list.='<span onclick="pagination(1,'.$id_package_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang đầu'><<</a></span>";
			}
			if(($curpage-1)>0)
			{			
				$page_list.='<span onclick="pagination('.$curpage.'-1,'.$id_package_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Về trang trước'><</a></span>";
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
					$page_list.='<span onclick="pagination('.$i.','.$id_package_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang ".$i."'>".$i."</a></span>";
				}
			}
			if(($curpage+1)<=$pages)
			{
				$page_list.='<span onclick="pagination('.$curpage.'+1,'.$id_package_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang sau'>></a></span>";
				$page_list.='<span onclick="pagination('.$pages.','.$id_package_line.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang cuối'>>></a></span>";
			}	

	       	$lst=$page_list;
			$pr=$p->package_list_pagination($curpage,$id_package_line,$searchPackage); 

			$this->renderPartial('package_detail',array('pr'=>$pr,'lst'=>$lst),false,true);
		}
	}

	public function actionAddPackage()
	{	
		
		if(Package::model()->findAll('code=:st',array(':st'=>$_POST['Package_Code']))==true){
			echo '-1';
			exit;	
		}

		$p = new Package;
		$p->id_package_line=$_POST['PackageLineId'];
		$p->name=$_POST['Package_Name'];
		$p->description=$_POST['Package_Description'];
		$p->price=str_replace('.','',$_POST['Package_Price']);
		$p->code=$_POST['Package_Code'];
		$p->cost_price=str_replace('.','',$_POST['Package_CostPrice']);
		$p->lenght=$_POST['Package_Lenght'];
		$p->duration_unit=$_POST['Package_Duration_Unit'];
		if (isset($_POST['Package_Lenght'])) 
		{
			if($_POST['Package_Duration_Unit']==3) 
			{
				$p->lenght_exchange=$_POST['Package_Lenght'];
			}
			elseif($_POST['Package_Duration_Unit']==4)
			{
				$p->lenght_exchange=$_POST['Package_Lenght']*7;
			} 
			elseif($_POST['Package_Duration_Unit']==5)
			{
				$p->lenght_exchange=$_POST['Package_Lenght']*30;
			}
			else
			{
				$p->lenght_exchange=$_POST['Package_Lenght']*365;
			} 
		}		
		$p->redemption_start_date=$_POST['Package_StartDate'];
		$p->redemption_end_date=$_POST['Package_EndDate'];
		$p->tax=$_POST['Package_Tax'];
		$p->save();
		
		$id_package=$p->findByAttributes(array('id_package_line'=>$_POST['PackageLineId'],'code'=>$_POST['Package_Code'],'name'=>$_POST['Package_Name']));		

		if($_FILES["Package_Image"]["error"]==0)
		{	

			$pi = new PackageImage;	

			$fileImageUpload       = $_FILES['Package_Image']['tmp_name'];

	        $fileTypeUpload        = explode('/',$_FILES['Package_Image']["type"]);
	        
	        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

	        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/package_image/'; 

	        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

	        if($resultImage){          
	            $pi->id_package=$id_package['id'];
	       		$pi->name=$_FILES["Package_Image"]["name"];
	       		$pi->url_action="package_image";
	       		$pi->name_upload=$imageNameUpload;
	       		$pi->update_time=date('Y-m-d');
	       		$pi->save();
	        } 
	        
		}	
		
		if(isset($_POST['Package_Service']))
		{
			$package_service=json_decode($_POST['Package_Service']);
			
			for ($i=0;$i<count($package_service);$i++) 
			{		
				$ps=new PackageService;				
				$ps->id_package=$id_package['id'];
				$ps->id_service=$package_service[$i]->id_service;
				$ps->quantity=isset($package_service[$i]->quantity)?$package_service[$i]->quantity:"";
				$ps->type=isset($package_service[$i]->type)?$package_service[$i]->type:"";
				$ps->save();		
			}
		}

		echo '1';
		exit;	
			
	}	

	public function actionUpdatePackage()
	{		

		$criteria=new CDbCriteria;
		$criteria->condition = "id != :id AND code = :code";
		$criteria->params = array (
		    ':id' => $_POST['id_package'], ':code' => $_POST['code_package'],
		);
		if(Package::model()->findAll($criteria)==true){
			echo '-1';
			exit;	
		}
		
		$p = Package::model()->findByPk($_POST['id_package']);	
		$p->id_package_line=$_POST["id_package_line_".$_POST['id_package'].""];	
		$p->name=$_POST['name_package'];
		$p->description=$_POST['description_package'];
		$p->price=str_replace('.','',$_POST['price_package']);
		$p->code=$_POST['code_package'];
		$p->cost_price=str_replace('.','',$_POST['costprice_package']);
		$p->lenght=$_POST['lenght_package'];
		$p->duration_unit=$_POST['duration_unit_package'];
		if (isset($_POST['lenght_package'])) 
		{
			if($_POST['duration_unit_package']==3) 
			{
				$p->lenght_exchange=$_POST['lenght_package'];
			}
			elseif($_POST['duration_unit_package']==4)
			{
				$p->lenght_exchange=$_POST['lenght_package']*7;
			} 
			elseif($_POST['duration_unit_package']==5)
			{
				$p->lenght_exchange=$_POST['lenght_package']*30;
			}
			else
			{
				$p->lenght_exchange=$_POST['lenght_package']*365;
			} 
		}		
		$p->redemption_start_date=$_POST['startdate_package'];
		$p->redemption_end_date=$_POST['enddate_package'];
		$p->tax=$_POST['tax_package'];
		$p->update();

		if($_FILES["image_package"]["error"]==0)
		{	

			$pi = new PackageImage;

			$oldImage = $pi->findByAttributes(array('id_package'=>$_POST['id_package']));		

			$fileImageUpload       = $_FILES['image_package']['tmp_name'];

	        $fileTypeUpload        = explode('/',$_FILES['image_package']["type"]);
	        
	        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

	        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/package_image/'; 

	        $resultImage = $pi->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

	        if($resultImage){
	            if($oldImage['name_upload']){
	                $pi->deleteImageScaleAndCrop($oldImage['name_upload']);
	                $piud = PackageImage::model()->findByAttributes(array('id_package'=>$_POST['id_package']));	
		            $piud->name = $_FILES["image_package"]["name"];
		            $piud->name_upload = $imageNameUpload;
		            $piud->update_time=date('Y-m-d');
		       		$piud->update();
	            }
	            else
	            {
	            	$pi->id_package=$_POST['id_package'];
		       		$pi->name=$_FILES["image_package"]["name"];
		       		$pi->url_action="package_image";
		       		$pi->name_upload=$imageNameUpload;
		       		$pi->update_time=date('Y-m-d');
		       		$pi->save();
	            }            
	        }       
	        
		}

		if(isset($_POST['Package_Service']))
		{			
			$package_service=json_decode($_POST['Package_Service']);
			PackageService::model()->deleteAllByAttributes(array('id_package'=>$_POST['id_package']));
			for ($i=0;$i<count($package_service);$i++) 
			{		
				$ps=new PackageService;				
				$ps->id_package=$_POST['id_package'];
				$ps->id_service=$package_service[$i]->id_service;
				$ps->quantity=isset($package_service[$i]->quantity)?$package_service[$i]->quantity:"";
				$ps->type=isset($package_service[$i]->type)?$package_service[$i]->type:"";
				$ps->save();		
			}
		}

		echo $_POST['code_package'];
		exit;		
			
	}

	public function actionDeletePackage()
	{		
		$p = Package::model()->findByPk($_POST['id']);
		$p->status_package=0;
		$p->update();

		$pi = new PackageImage;
		$pi->deleteAllByAttributes(array('id_package'=>$_POST['id']));
		$oldImage = $pi->findByAttributes(array('id_package'=>$_POST['id']));
		if($oldImage['name_upload']){
	        $pi->deleteImageScaleAndCrop($oldImage['name_upload']);       
	    }
	    PackageService::model()->deleteAllByAttributes(array('id_package'=>$_POST['id']));
		echo '1';
		exit;			
	}

	public function actionAddPackageLine()
	{
		$pl=new PackageLine;			
		$pl->name=$_POST['packageNewName'];					
		$pl->save();
		
		echo "1";
		exit;
			
	}

	public function actionUpdatePackageLine()
	{
		$pl=PackageLine::model()->findByPk($_POST['id_package_line']);		
		$pl->name=$_POST['packagelineNewName'];					
		$pl->update();
		
		echo "1";
		exit;
			
	}

	public function actionDeletePackageLine()
	{
		$pl=PackageLine::model()->findByPk($_POST['id']);		
		$pl->status_proline=0;					
		$pl->update();		
		Package::model()->updateAll(array('status_package'=>0),'id_package_line="'.$_POST['id'].'"');
		echo "1";
		exit;
		
	}
	/*------------------------------------------LMV---------------------------------------------------------*/
	public function actioncountservice()
	{
		if($_POST['id'] != 0){
			$data = count(Package::model()->findAllByAttributes(array("id_package_line"=>$_POST['id'])));
			echo '('.$data.')';
			exit();
		}else{
			$data = count(Package::model()->findAll());
			echo '('.$data.')';
			exit();
		}
	}
}
