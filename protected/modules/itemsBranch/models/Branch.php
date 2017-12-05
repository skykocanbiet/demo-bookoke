<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $point_x
  * @property string $point_y
 * @property integer $id_country
 * @property integer $id_city
 * @property string $hotline1
 * @property string $hotline2
 * @property integer $status
 */
class Branch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('id_city, status', 'numerical', 'integerOnly'=>true),
			array('id_country', 'length', 'max'=>255),			
			array('name, address, email', 'length', 'max'=>255),
			array('hotline1, hotline2', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, email, id_country, id_city, point_x, point_y, hotline1, hotline2, status', 'safe', 'on'=>'search'),
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
			'rel_country' => array(self::BELONGS_TO,'CsCountry','id_country'),
			'rel_city' => array(self::BELONGS_TO,'CsCity','id_city'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'address' => 'Address',
			'email'	=> 'Email',
			'id_country' => 'Country',			
			'id_city' => 'City',
			'hotline1' => 'Hotline1',
			'hotline2' => 'Hotline2',
			'point_x' => 'Point X',	
			'point_y' => 'Point Y',
			'status' => 'Status',
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

		$criteria->with = array('rel_country','rel_city');		

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rel_country.country',$this->id_country,true);	
		$criteria->compare('rel_city.name_long',$this->id_city,true);
		$criteria->compare('point_x',$this->point_x,true);
		$criteria->compare('point_y',$this->point_y,true);
		$criteria->compare('hotline1',$this->hotline1,true);
		$criteria->compare('hotline2',$this->hotline2,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getListBranchs(){
		$criteria = new CDbCriteria();
		$criteria->condition = 'status=:status';
		$criteria->params = array(':status'=>1);
		return Branch::model()->findAll($criteria);
	}

	public function searchBranchs($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from branch where 1 = 1 ";

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

		$sql = "select * from branch where 1 = 1  ";
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

	public function getListCity(){
		return CsCity::model()->findAllByAttributes(array('id_country'=>'VN'));
	}

	public function addNewBranch($name){

		if(!$name){
			return -1; 
 		} 

 		$model = new Branch;
 		$model->name = $name;
 		

		if($model->validate() && $model->save()){	

			for ($i=2;$i<=8;$i++) 
			{				
				$branch_schedule             = new BranchSchedule;				
				$branch_schedule->id_branch  = $model->id;
				$branch_schedule->weekday    = $i;
				$branch_schedule->start_time = date("H:i:s", strtotime("8 am"));
				$branch_schedule->end_time   = date("H:i:s", strtotime("8 pm"));
				if ($i == 7 || $i == 8) {
					$branch_schedule->status = 0;
				}
				$branch_schedule->save();
			}
			
			return $model->name;

		}
		else
			return 0;		

	}

	public function updateBranch($data = array('id' => '','name' => '', 'flag_online' => '', 'hotline1' => '', 'address' => '', 'id_city' => '')){

		if(!$data['id'] || !$data['name']){
			return -1; 
 		} 

 		$ud = Branch::model()->findByPk($data['id']); 

 		if(!$ud) {
			return -2;			
		}
		$ud->flag_online=$data['flag_online'];
		$ud->attributes = $data;

		if($ud->validate() && $ud->save()){	
			return $ud->id;
		}
		else
			return 0;		

	}
	public function updateBranchSchedule($id, $flag, $time){

		if(!$id){
			return -1; 
 		} 

		if ($flag == 0) {
			return $result = BranchSchedule::model()->updateByPk($id, array('start_time'=>$time));	
		}else {
			return $result = BranchSchedule::model()->updateByPk($id, array('end_time'=>$time));	
		}		
		
	}

	public function updateBranchStatus($id, $status){

		if(!$id){
			return -1; 
 		} 
		
		return $result = BranchSchedule::model()->updateByPk($id, array('status'=>$status));			
		
	}
}
