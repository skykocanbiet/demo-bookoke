<?php

class CompanyController extends Controller
{
	public $layout='/layouts/main_sup';
	public function actionView()
	{
		$this->render('view');
	}

public function actionUpdateproviderImage()
{
	if(isset($_POST['id']))
	{
		$provider=new Company;
		$id=$_POST['id'];
		$data=Company::model()->findBypk($id);
		$fileImageUpload       = $_FILES["image123"]['tmp_name'];

		$fileTypeUpload        = explode('/',$_FILES["image123"]["type"]);

		$imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];
		//$rnd = date("d-m-Y-H-i-s");			
		$image=$_FILES["image123"]["error"]==0?$imageNameUpload:$data['images'];
		$kq=Company::model()->updateByPk($id, array('images'=>$image));	
		if($kq)
		{
			if($_FILES["image123"]["error"]==0)
			{
				if($data['images']!="" && $data['images']!="no_image.png" && $data['images']!="no_avatar.png")
				{
					unlink( Yii::getPathOfAlias('webroot').'/upload/provider/lg/'.$data['images']);
					unlink( Yii::getPathOfAlias('webroot').'/upload/provider/sm/'.$data['images']);
					unlink( Yii::getPathOfAlias('webroot').'/upload/provider/md/'.$data['images']);
				}

				/*move_uploaded_file($_FILES["image123"]["tmp_name"],"./upload/provider/lg/$image");*/
				$fileImageUpload       = $_FILES["image123"]['tmp_name'];

				 $fileTypeUpload        = explode('/',$_FILES["image123"]["type"]);
				        
				 $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

				 $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/provider/'; 

				 $resultImage = $provider->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);
			}

		}	
		$model=Company::model()->findBypk($id);
		$this->renderPartial('customer_image',array('model'=>$model),false,true);	
	}
}
public function actionaddprovider()
	{
		
			$provider=new Company;
			$web = new MiniWebsite;
			$webinfo = new MiniWebsiteInfo;
			/*if($_FILES["Product_Image"]["error"]==0)
	{		
*/
			$user = Yii::app()->user->getState('user_id');	
			if(isset($_POST['providerName']) /*&& isset($_POST['providerDes'])*/ && isset($_POST['providerAddress']) && isset($_POST['providerPhone']) && isset($_POST['providerHPhone']) && isset($_POST['providerMail']) && isset($_POST['providerCountry']) && isset($_POST['providerCity']) && isset($_POST['providerState']) && isset($_POST['providerZipcode']) && isset($_POST['providerX']) && isset($_POST['providerY'])&& isset($_POST['WebsiteUrl']) && isset( $_FILES['fileUpload']['name']) && isset($_POST['websubmain']))
			{	
				
				$provider->Name=$_POST['providerName'];
/*				$provider->Des = $_POST['providerDes'];
*/				$provider->Address = $_POST['providerAddress'];
				$provider->Phone = $_POST['providerPhone'];				
				$provider->Home_Phone = $_POST['providerHPhone'];
				$provider->Email = $_POST['providerMail'];
				$provider->Id_Country = $_POST['providerCountry'];
				$provider->Id_City = $_POST['providerCity'];
				$provider->Id_State = $_POST['providerState'];
				$provider->Zipcode = $_POST['providerZipcode'];
				$provider->X = $_POST['providerX'];
				$provider->Y = $_POST['providerY'];
				$provider->link=$_POST['WebsiteUrl'];
       			
				$provider->Status = "1";
				//
				
				if($_FILES["fileUpload"]["error"]==0)
					{	

						$fileImageUpload       = $_FILES['fileUpload']['tmp_name'];

				        $fileTypeUpload        = explode('/',$_FILES['fileUpload']["type"]);
				        
				        $imageNameUpload       = date("dmYHis").'.'.$fileTypeUpload[1];

				        $imageUploadSource     = Yii::getPathOfAlias('webroot').'/upload/provider/'; 

				        $resultImage = $provider->saveImageScaleAndCrop($fileImageUpload,500,500,$imageUploadSource,$imageNameUpload);

				        $provider->images= $imageNameUpload;
				       
        				
					}	

					$provider->insert();
					$id = $provider->Id;
					$subdomain = $_POST['websubmain'];
						if($id != ""){
							$web->name = $_POST['providerName'];
							$web->description = "";
							$web->sub_domain = $subdomain ;
							$web->folder = $subdomain;
							$web->status = "1";
							$web->locked = "0";
							$web->id_user = $user;
							$web->id_company = $id;
							mkdir(Yii::getPathOfAlias('webroot')."/upload/".$subdomain);
							$web->insert();
							$miniweb = $web->id;
								if($miniweb !="")
								{
									$webinfo->id_website = $miniweb;
									$webinfo->logo = "logo.png";
									$webinfo->cover_photo = "cover_photo.png";
									$webinfo->insert();
									echo $id;
									exit();
						}
					}
			}
		//}
	}
public function actionUpdateProvider()
{
	$provider=new Company;
	if(isset($_POST['id']))
	{

		$id=$_POST['id'];
		$Name=$_POST['Name'];
		$Email=$_POST['Email'];
		$Phone=$_POST['Phone'];
		$Home_Phone=$_POST['Home_Phone'];
		$Address=$_POST['Address'];
		$X = $_POST['X'];
		$Y = $_POST['Y'];
		$link = $_POST['link'];

		$update = Company::model()->updateByPk($id, array('Name'=>$Name,'Email'=>$Email,'Phone'=>$Phone,'Home_Phone'=>$Home_Phone,'Address'=>$Address, 'X'=>$X, 'Y'=>$Y, 'link'=>$link));
		
		echo ($Name);
		exit();
	
	}

}
public function actionupdateStatusOn(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "1";
		
		$update = Company::model()->updateByPk($id, array('Status'=>$Status));
		
	}
}
public function actionupdateStatusOff(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "0";
		
		$update = Company::model()->updateByPk($id, array('Status'=>$Status));
		
	}
}
public function actionSearchProvider()
{

	$model 		   = new Company;
	$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
	$lpp           = 20;
	$search_params = '';
	$orderBy 	   = '`Name` ASC ';

	if($_POST['type'] == 4){
		$orderBy = '`code_number` DESC ';
	}

	if ($_POST['value']) 
	{
		$search_params= 'AND (`Name` LIKE "%'.$_POST['value'].'%" )';
	}
	
	$data  = $model->searchProvider('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);
	if($cur_page > $data['paging']['cur_page']){
		echo "<script>stopped=true;</script>";
		exit();
	}

	$this->renderPartial('search_sort',array('list_data'=>$data));

}
public function actionDetailProvider()
			{

				$web = new MiniWebsite;
				$model = new Company();
				if(isset($_POST['id'])){
					$id = $_POST['id'];
					$datas 	= $model->findBypk($id);
					$data 	= $model->getdetail($id);
				}
				
			
				$this->renderPartial('provider_info',array(
						'model'=>$datas ,'data'=> $data[0]),false,false);
				
			}
public function actionCityCoutry()
			{

				
				$model = new Company();
				if(isset($_POST['id'])){
					$id = $_POST['id'];

				}

				$data = $model->getCityCoutry($id);

				$this->renderPartial('citycountry',array('model'=>$data),false,false);
			}
public function actionStateCountry()
			{

				
				$model = new Company();
				if(isset($_POST['code'])){
					$id = $_POST['code'];

				}

				$data = $model->state_ct($id);
				
				$this->renderPartial('statecountry',array('model'=>$data),false,false);
			}
			public function actiondeleteProvider(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "-1";
		
		$update = Company::model()->updateByPk($id, array('Status'=>$Status));
		echo "1";
		exit();
		
	}
}
public function actionupdateProviderCountry(){
	if(isset($_POST['id']))
	{

		$id=$_POST['id'];
		$Id_Country = $_POST['Id_Country'];

		$update = Company::model()->updateByPk($id, array('Id_Country'=>$Id_Country));	
	
	}
}
public function actionupdateProviderSave(){
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$Id_City = $_POST['Id_City'];
		$update = Company::model()->updateByPk($id, array('Id_City'=>$Id_City));	
		
		# code...
	}
}
public function actionCityCoutry1()
			{

				
				$model = new Company();
				if(isset($_POST['code'])){
					$id = $_POST['code'];
					$code = $_POST['id'];

				}

				$data = $model->getCityCoutry($id);

				$this->renderPartial('city',array('model'=>$data, 'code'=>$code),false,false);
			}	
public function actionStateCountry1()
			{

				
				$model = new Company();
				if(isset($_POST['code'])){
					$id = $_POST['code'];
					$code = $_POST['id'];

				}

				$data = $model->state_ct($id);
				
				$this->renderPartial('state',array('model'=>$data, 'code'=>$code),false,false);
			}	
public function actionupdateProviderSaveState(){
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$Id_State = $_POST['Id_State'];
		$update = Company::model()->updateByPk($id, array('Id_State'=>$Id_State));	
		
		# code...
	}

}
public function actionSearchDS(){
	echo "string";
	}
public function actionDistance(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "0";
		
		$update = Company::model()->updateByPk($id, array('statushot'=>$Status));
		
	}
}
public function actionFeatured(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "1";
		
		$update = Company::model()->updateByPk($id, array('statushot'=>$Status));
		
	}
}
public function actionMost(){
	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$Status = "2";
		
		$update = Company::model()->updateByPk($id, array('statushot'=>$Status));
		
	}
}
public function actionupdatesubmain(){
	$web = new MiniWebsite;
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sub = $_POST['subdomain'];
		$update = $web->updateByPk($id, array('sub_domain'=>$sub));
	}
}
}