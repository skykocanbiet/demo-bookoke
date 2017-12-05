<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $Id
 * @property string $Name
 * @property string $Des
 * @property string $Phone
 * @property string $Home_Phone
 * @property string $Address
 * @property string $Email
 * @property integer $Id_Country
 * @property integer $Id_City
 * @property integer $Id_State
 * @property integer $Zipcode
 * @property integer $X
 * @property integer $Y
 * @property integer $Status
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Phone, Home_Phone, Address, Email, X, Y', 'required'),
			array('Id_Country, Id_City, Id_State, Zipcode, X, Y, Status', 'numerical', 'integerOnly'=>true),
			array('Name, Des, Address, Email', 'length', 'max'=>100),
			array('Phone, Home_Phone', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Name, Des, Phone, Home_Phone, Address, Email, Id_Country, Id_City, Id_State, Zipcode, X, Y, Status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Name' => 'Name',
			'Des' => 'Des',
			'Phone' => 'Phone',
			'Home_Phone' => 'Home Phone',
			'Address' => 'Address',
			'Email' => 'Email',
			'Id_Country' => 'Id Country',
			'Id_City' => 'Id City',
			'Id_State' => 'Id State',
			'Zipcode' => 'Zipcode',
			'X' => 'X',
			'Y' => 'Y',
			'Status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Des',$this->Des,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Home_Phone',$this->Home_Phone,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Id_Country',$this->Id_Country);
		$criteria->compare('Id_City',$this->Id_City);
		$criteria->compare('Id_State',$this->Id_State);
		$criteria->compare('Zipcode',$this->Zipcode);
		$criteria->compare('X',$this->X);
		$criteria->compare('Y',$this->Y);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getCompanyDeals(){
    	$con = Yii::app()->db;
    	$sql = "SELECT  `Name` ,  `Id` FROM  `company` WHERE  `Status` =1 ORDER BY  `Name` ASC ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    }
	 public function getCompany(){
	 	
    	$con = Yii::app()->db;
    	$sql = "SELECT * FROM  company a INNER JOIN mini_website b WHERE a.Id = b.id_company AND (a.`Status` = 0 || a.`Status` = 1)  ORDER BY  a.`Name` ASC LIMIT 0, 20 ";
    	$model = $con->createCommand($sql)->queryAll();
    	return $model ;
    	
    }
    public function getDetailProvider($id){
	 	
    	$con = Yii::app()->db;
    	$sql = "SELECT * FROM  company a INNER JOIN mini_website b WHERE a.Id = b.id_company AND (a.`Status` = 0 || a.`Status` = 1) AND a.Id = '".$id."'";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
    public function getCity(){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_city where id_country = 'VN'";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
     public function getCity1(){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_city";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
     public function getState(){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_state where id_country = 'VN'";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
     public function getCountry(){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_country";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
     public function getCityCoutry($id){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_city where id_country = '".$id."'";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    }
     public function state_ct($id){
    	
    	$con = Yii::app()->db;

    	$sql = "select * from cs_state where id_country = '".$id."' ";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
    }
    public function getCountCompany(){
    	$con = Yii::app()->db;
    	$sql = "select count(*) from company WHERE  Status = 1 || Status = 0";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    }
    public function saveImageScaleAndCrop($fileImageUpload,$w='1000',$h='1000',$imageUploadSource,$imageNameUpload){
    		
            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w, $h);
           	$img = $image->save($imageUploadSource."lg/".$imageNameUpload);
 
            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/2, $h/2);
            $image->save($imageUploadSource."md/".$imageNameUpload);

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/4, $h/4);
            $image->save($imageUploadSource."sm/".$imageNameUpload);

            return true;
    }
    public function searchProvider($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{

		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "SELECT COUNT(*) FROM  company a INNER JOIN mini_website b WHERE a.Id = b.id_company AND
			 (a.`Status` = 0 || a.`Status` = 1) 
				";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = $con->createCommand($sql)->queryScalar();
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		$sql = "select * from  company a INNER join mini_website b where a.Id = b.id_company and (a.`Status` = 0 || a.`Status` = 1)  ";
		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}
	public function searchDS1($and_conditions='',$or_conditions='',$additional='', $lpp='12', $cur_page='1')
	{
		
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "SELECT COUNT(*) FROM  company a INNER JOIN mini_website b WHERE a.Id = b.id_company AND
			 (a.`Status` = 1) 
				 ";

		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$num_row = $con->createCommand($sql)->queryScalar();
		

		if(!$num_row) return array('paging'=>array('num_row'=>'0','num_page'=>'1','cur_page'=>$cur_page,'lpp'=>$lpp,'start_num'=>1),'data'=>'');

		if($lpp == 'all'){
			$lpp = $num_row;
		}

		//  Page 1
		if( $num_row < $lpp){
			$cur_page = 1;
			$num_page = 1;
			$lpp      = $num_row;
			$start    = 0 ;

		}else{
			// Tinh so can phan trang
			$num_page =  ceil($num_row/$lpp);

			// So trang hien tai lon hon tong so ph�n trang mot page
			if($cur_page >=  $num_page){
				$cur_page = $num_page;
				$lpp      =  $num_row - ( $num_page - 1 ) * $lpp_org;

			}
			$start = ($cur_page -1) * $lpp_org;
		}

		$sql = "SELECT * FROM  company a INNER JOIN mini_website b WHERE a.Id = b.id_company AND
			 (a.`Status` = 1) 
				 ";
		if($and_conditions and is_array($and_conditions)){
			foreach($and_conditions as $k => $v){
				$sql .= " and $k = '$v'";
			}
		}elseif($and_conditions){
			$sql .= " and $and_conditions";
		}

		if($or_conditions and is_array($or_conditions)){
			foreach($or_conditions as $k => $v){
				$sql .= " or $k = '$v'";
			}
		}elseif($or_conditions){
			$sql .= " or $or_conditions";
		}

		if($additional){
			$sql .= " $additional";
		}

		$sql .= " limit ".$start.",".$lpp;


		$data = $con->createCommand($sql)->queryAll();

		return array('paging'=>array('num_row'=>$num_row,'num_page'=>$num_page,'cur_page'=>$cur_page,'lpp'=>$lpp_org,'start_num'=>$start+1),'data'=>$data);
	}
	public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {

	    $theta = $longitude1 - $longitude2;

	    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));

	    $miles = acos($miles);

	    $miles = rad2deg($miles);

	    $miles = $miles * 60 * 1.1515;

	   

	    $kilometers = $miles * 1.609344;

	   

	    return compact('kilometers');

	}
	
	public function detailex($status,$location,$store){
		if($status == 1){
	    	$con 	= Yii::app()->db;
	    	$sql 	= "SELECT a.*, b.*, c.`id` AS id_br , c.`address`, c.`images` AS img_br, c.point_x as point_x , c.point_y FROM  company a INNER JOIN mini_website b INNER JOIN branch c WHERE a.Id = b.id_company AND a.Id = c.id_company AND (a.`Status` = 1) AND a.statushot = 1";
	    	$data 	= $con->createCommand($sql)->queryAll();
	    	return $data ;
    	}else{
    		/*echo($location);
    		 exit();*/
    		$con 	= Yii::app()->db;
    		$sql 	= "SELECT a.*, b.*, c.`id` AS id_br , c.`address` AS addr, c.`images` AS img_br , c.point_x as point_x , c.point_y as point_y  FROM  company a INNER JOIN mini_website b INNER JOIN branch c WHERE a.Id = b.id_company AND a.Id = c.id_company AND (a.`Status` = 1) ";
    		if($location != '')
    		{
    			$sql.= ' and c.address LIKE "%'.$location.'%"';
    		}
    		if($store != '')
    		{
    			$sql.= ' and c.name LIKE "%'.$store.'%"';
    		}
    		$data = $con->createCommand($sql)->queryAll();
    		return $data ;
    	}
    }

	public function getselect(){
	$con = Yii::app()->db;
    	$sql = "select * from company";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
	}
	public function getdetail($id){
		 	
	    	$con = Yii::app()->db;
	    	$sql = "SELECT * FROM  company a INNER JOIN mini_website b INNER JOIN mini_website_info c WHERE a.Id = b.id_company AND b.id = c.id_website  AND a.Id = '".$id."'";
	    	$data = $con->createCommand($sql)->queryAll();
	    	return $data ;
	    	
	}

	/**
	*Duc test
	*lay ds Company trong pham vi distance(km)
	*/
	public function getListCompany($lat,$long,$distance=1000){

		$sql = "SELECT *,calculateDistance($lat,$long,branch.point_x,branch.point_y) AS distance FROM branch WHERE  `status` = 1 HAVING distance < ".$distance." ORDER BY distance";

		/*$sql = "SELECT *,calculateDistance($lat,$long,company.X,company.Y) AS distance FROM company WHERE  `status` = 1 HAVING distance < ".$distance." ORDER BY distance";*/

		$data = $con->createCommand($sql)->queryAll();
    	return $data;
	}
	public function getsupplier(){
		$con = Yii::app()->db;
		$sql = "SELECT * FROM company";
		$data = $con->createCommand($sql)->queryAll();
    	return $data;
	}
}
