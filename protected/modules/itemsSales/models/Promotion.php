<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property integer $id
 * @property integer $id_company
 * @property string $name
 * @property string $images
 * @property integer $code
 * @property string $description
 * @property double $sum_amount
 * @property integer $type_price
 * @property double $price
 * @property integer $status
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 */
class Promotion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, end_date', 'required'),
			array('id_company, code, type_price, status, id_user', 'numerical', 'integerOnly'=>true),
			array('sum_amount, price', 'numerical'),
			array('name', 'length', 'max'=>100),
			array('images, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_company, name, images, code, description, sum_amount, type_price, price, status, id_user, start_date, end_date', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'id_company' => 'Id Company',
			'name' => 'Name',
			'images' => 'Images',
			'code' => 'Code',
			'description' => 'Description',
			'sum_amount' => 'Sum Amount',
			'type_price' => 'Type Price',
			'price' => 'Price',
			'status' => 'Status',
			'id_user' => 'Id User',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_company',$this->id_company);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sum_amount',$this->sum_amount);
		$criteria->compare('type_price',$this->type_price);
		$criteria->compare('price',$this->price);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promotion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function saveImageScaleAndCrop($fileImageUpload,$w='500',$h='280',$imageUploadSource,$imageNameUpload){
    		
            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop(500, 280);
           	$img = $image->save($imageUploadSource."lg/".$imageNameUpload);
 
            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop(500/2, 280/2);
            $image->save($imageUploadSource."md/".$imageNameUpload);

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop(500/4, 280/4);
            $image->save($imageUploadSource."sm/".$imageNameUpload);

            return true;
    }
    public function geteditdetail($id){
    	$con = Yii::app()->db;
		$sql = "SELECT b.Name,b.Id, a . * from promotion a inner join company b where a.id_company = b.ID and a.id =  ".$id;
		$data = $con->createCommand($sql)->queryAll();
    	return $data;
    }
    public function selectpromotion($id){
    	$con = Yii::app()->db;
		$sql = "select * from  promotion_value  where  id_promotion =".$id;
		

    	$data = $con->createCommand($sql)->queryAll();
    	return $data;
    	
    }	
    public function getdelete($id){
    	$con = Yii::app()->db;
		$sql = "DELETE FROM `promotion_value` WHERE `id_promotion` ='62'" ;
    	$data = $con->createCommand($sql);
    	
    	return $data;
    	
    }
    public function getdealuser(){
		$con = Yii::app()->db;
		$sql = "SELECT b.Name,b.Id, a . * from promotion a inner join company b where a.id_company = b.ID and 1 = 1 ";
		$data = $con->createCommand($sql)->queryAll();
    	return $data;
	}
	public function getsegment(){
		$con = Yii::app()->db;
		$sql = "SELECT * FROM `segment` WHERE `status` = 1";
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	public function getbranch(){
		$con = Yii::app()->db;
		$sql = "SELECT * FROM `branch` WHERE `status` = 1";
		$data = $con->createCommand($sql)->queryAll();
		return $data;
	}
	public function getbranchfor($id){
		$result = array();
		$data = PromotionBranch::model()->findAllByAttributes(array("id_promotion"=>$id));
		if($data && count($data) > 0){
			foreach ($data as $key => $value) {
				$result[$value['id_branch']] = $value['id'];
			}
		}
		return $result;

	}
	public function getsegmentfor($id){
		$result = array();
		$data = PromotionSegment::model()->findAllByAttributes(array("id_promotion"=>$id));
		if($data && count($data) > 0){
			foreach ($data as $key => $value) {
				$result[$value['id_segment']] = $value['id'];
			}
		}
		return $result;

	}
	public function getsegmentforeach($id){
		
		$data = PromotionBranch::model()->findAllByAttributes(array("id_promotion"=>$id));
		
		return $data;

	}
	public function getdeletesegment($id){
		
		$data = PromotionBranch::model()->findAllByAttributes(array("id_promotion"=>$id));
		
		return $data;

	}
	/*searchPromotion*/
	 public function searchPromotion($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{

		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from promotion where 1 = 1  ";

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

		$sql = "select * from promotion where 1 = 1  ";
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
	/*endsearch*/
/*3/1*/
public function searchcrouppromotion($id){
		
		$result = array();
		$data = Promotion::model()->findAllByAttributes(array("id_croup"=>$id));
		return array('data'=>$data);

	
	
	}
public function getget(){
		$con = Yii::app()->db;
		$result = array();
		$sql = "SELECT b.Name,b.Id, a . * from promotion a inner join company b where a.id_company = b.ID and 1 = 1 ";
		$data = $con->createCommand($sql)->queryAll();
    	return array('data'=>$data);
	}

	// lay danh sach khuyen mai hien hanh
	public function getActivePromotion()
	{
		$now = date('Y-m-d H:i:s');
		$atPro = Promotion::model()->findAll(array(
			'select'	=>	'*',
			'condition' =>	"start_date <= '$now' AND '$now' <= end_date AND status = 2",
		));

		return $atPro;
	}
	public function getservice($id){
		/*$data = PromotionBranch::model()->findAllByAttributes(array("id_promotion"=>$id));
		
		return $data;*/
		$data = CsService::model()->findAllByAttributes(array('id_company'=>$id));
		return $data;
	}
	public function getproduct($id){
		/*$data = PromotionBranch::model()->findAllByAttributes(array("id_promotion"=>$id));
		
		return $data;*/
		$data = Product::model()->findAllByAttributes(array('id_company'=>$id));
		return $data;
	}
}
