<?php

/**
 * This is the model class for table "segment".
 *
 * The followings are the available columns in table 'segment':
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $code
 * @property string $description
 * @property integer $status
 * @property string $createdate
 */
class Segment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'segment';
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
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, color, code', 'length', 'max'=>255),
			array('description, createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, color, code, description, status, createdate', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'color' => 'Color',
			'code' => 'Code',
			'description' => 'Description',
			'status' => 'Status',
			'createdate' => 'Createdate',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Segment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"))
	{    
	    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
	    foreach ($delimiters as $dlnr => $delimiter) {
	        $words = explode($delimiter, $string);
	        $newwords = array();
	        foreach ($words as $wordnr => $word) {
	            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
	                // check exceptions list for any words that should be in upper case
	                $word = mb_strtoupper($word, "UTF-8");
	            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
	                // check exceptions list for any words that should be in upper case
	                $word = mb_strtolower($word, "UTF-8");
	            } elseif (!in_array($word, $exceptions)) {
	                // convert to uppercase (non-utf8 only)
	                $word = ucfirst($word);
	            }
	            array_push($newwords, $word);
	        }
	        $string = join($delimiter, $newwords);
	   }
	   return $string;
	}	

	public function pageList($curpage,$pages,$id_segment)
	{
		$page_list="";	

        if(($curpage!=1)&&($curpage))
		{
			$page_list.='<span onclick="pagination(1,'.$id_segment.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang đầu'><<</a></span>";
		}
		if(($curpage-1)>0)
		{			
			$page_list.='<span onclick="pagination('.$curpage.'-1,'.$id_segment.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Về trang trước'><</a></span>";
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
				$page_list.='<span onclick="pagination('.$i.','.$id_segment.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Trang ".$i."'>".$i."</a></span>";
			}
		}
		if(($curpage+1)<=$pages)
		{
			$page_list.='<span onclick="pagination('.$curpage.'+1,'.$id_segment.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang sau'>></a></span>";
			$page_list.='<span onclick="pagination('.$pages.','.$id_segment.');" style="cursor:pointer;" class="div_trang">'."<a style='color:#000000;' title='Đến trang cuối'>>></a></span>";
		}	

	    return $page_list;
	}

	public function listCustomerSegmentPagination($curpage,$limit,$id_segment)
	{
		$start_point=20*($curpage-1);	
		$criteria = new CDbCriteria();		
		$criteria->addCondition('id_segment = :id_segment');
		$criteria->params = array(':id_segment' => $id_segment);			
	    $criteria->order = 'id DESC';
	    $criteria->limit = $limit;
	    $criteria->offset = $start_point;    
	     
	    return CustomerSegment::model()->findAll($criteria);
	}

	public function searchSegment($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1')
	{
		$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from segment where 1 = 1 ";

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

		$sql = "select * from segment where 1 = 1  ";
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

	public function getVnPhone($phone){
		 $phone =preg_replace("/[^0-9]/", "", $phone);//remove none numberic
		 if(strlen($phone)==0)
			 return "";
		if(strlen($phone)>16)
			$phone = substr($phone,0,16);
		if(substr( $phone, 0, 1 ) === "0"){
			$phone ="84". substr($phone,1,strlen($phone));
		} else if(substr( $phone, 0, 3 ) == "840"){
			$phone ="84".substr( $phone, 3, strlen($phone) );
		}
		else if(substr( $phone, 0, 2 ) != "84"){
			$phone ="84".$phone;
		}
		return $phone;
	}

	public function addSegment($data = array('name' => '', 'color' => '', 'code' => '', 'description' => '', 'segment_rule' => '')) 
	{
		
		if(!$data['name']) {
			return -1; 
 		} 

 		$segment  = new Segment; 

 		if($data['code'] != '' && $segment->findAll('code=:code',array(':code'=>$data['code'])) == true){
			return -2; 	
		}

		$data['color'] = $data['color']?$data['color']:'black';

 		$segment->attributes = $data;

		if($segment->validate() && $segment->save()){
			
			if ($data['segment_rule']) {

				$list_data = array();

				for ($i=0;$i<count($data['segment_rule']);$i++) 
				{				
					$segment_rule             = new SegmentRule;				
					$segment_rule->id_segment = $segment->id;
					$segment_rule->rule   	  = $data['segment_rule'][$i]->rule;
					$segment_rule->value_type = $data['segment_rule'][$i]->value_type;
					$segment_rule->value      = $data['segment_rule'][$i]->value;
					$segment_rule->value_end  = $data['segment_rule'][$i]->value_end;
					$segment_rule->save();

					switch ($data['segment_rule'][$i]->rule) {
                        case 2:                          
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('gender=:gender', array(':gender' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                                               
                            break; 
                        case 5:
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('code_number=:code_number', array(':code_number' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                             
                            break;  
                        case 7:
                            $list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('phone=:phone', array(':phone' => $this->getVnPhone($data['segment_rule'][$i]->value)))			               
			                ->queryAll();                             
                            break;                                                       
                        case 8:
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('email=:email', array(':email' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                            
                            break; 
                        case 6:
                            $list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('birthdate > :start AND birthdate < :end', array(':start' => $data['segment_rule'][$i]->value,':end' => $data['segment_rule'][$i]->value_end))			               
			                ->queryAll();                            
                            break;  
                    }  

					$list_data[$i] = $list_cus;
				}	

				$list_id = array();

				for ($i=0;$i<count($list_data);$i++) 
				{
					for ($j=0;$j<count($list_data[$i]);$j++) 
					{
						$list_id[$j] = $list_data[$i][$j];
					}
				}
				if ($list_id) {

					foreach ($list_id as $key => $value)
					{				
						$customer_segment              = new CustomerSegment;				
						$customer_segment->id_customer = $value['id_customer'];
						$customer_segment->id_segment  = $segment->id;
						$customer_segment->code_number = $value['code_number'];
						$customer_segment->fullname    = $value['fullname'];
						$customer_segment->gender      = $value['gender'];
						$customer_segment->birthdate   = $value['birthdate'];
						$customer_segment->phone       = $value['phone'];
						$customer_segment->email       = $value['email'];
						$customer_segment->save();
					}

				}

				return 1;

			}else {

				return 1;

			}	

		}else{

			return 0;
			
		}	

	}	

	public function updateSegment($data = array('id_segment' => '','name' => '', 'color' => '', 'code' => '', 'description' => '', 'segment_rule' => '')) 
	{
		
		if(!$data['id_segment'] && !$data['name']) {
			return -1; 
 		} 

 		$segment  = new Segment;  		

		if($data['code'] != ''){
			$criteria=new CDbCriteria;
			$criteria->condition = "id != :id AND code = :code";
			$criteria->params = array (
			    ':id' => $data['id_segment'], ':code' => $data['code'],
			);
			if($segment->findAll($criteria)==true){
				return -2; 	
			}
		}

		$data['color'] = $data['color']?$data['color']:'black';

		$segment = $segment->findByPk($data['id_segment']);

 		$segment->attributes = $data;

		if($segment->validate() && $segment->save()){
			
			if ($data['segment_rule']) {

				$list_data = array();

				SegmentRule::model()->deleteAllByAttributes(array('id_segment'=>$data['id_segment']));	

				for ($i=0;$i<count($data['segment_rule']);$i++) 
				{				
					$segment_rule             = new SegmentRule;				
					$segment_rule->id_segment = $data['id_segment'];
					$segment_rule->rule   	  = $data['segment_rule'][$i]->rule;
					$segment_rule->value_type = $data['segment_rule'][$i]->value_type;
					$segment_rule->value      = $data['segment_rule'][$i]->value;
					$segment_rule->value_end  = $data['segment_rule'][$i]->value_end;
					$segment_rule->save();

					switch ($data['segment_rule'][$i]->rule) {
                        case 2:                          
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('gender=:gender', array(':gender' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                                               
                            break; 
                        case 5:
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('code_number=:code_number', array(':code_number' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                             
                            break;  
                        case 7:
                            $list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('phone=:phone', array(':phone' => $this->getVnPhone($data['segment_rule'][$i]->value)))			               
			                ->queryAll();                             
                            break;                                                       
                        case 8:
                        	$list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('email=:email', array(':email' => $data['segment_rule'][$i]->value))			               
			                ->queryAll();                            
                            break; 
                        case 6:
                            $list_cus = Yii::app()->db->createCommand()
			                ->select('id id_customer, code_number, fullname, gender, birthdate, phone, email')
			                ->from('customer')
			                ->where('birthdate > :start AND birthdate < :end', array(':start' => $data['segment_rule'][$i]->value,':end' => $data['segment_rule'][$i]->value_end))			               
			                ->queryAll();                            
                            break;  
                    }  

					$list_data[$i] = $list_cus;
				}	

				$list_id = array();

				for ($i=0;$i<count($list_data);$i++) 
				{
					for ($j=0;$j<count($list_data[$i]);$j++) 
					{
						$list_id[$j] = $list_data[$i][$j];
					}
				}
				if ($list_id) {

					CustomerSegment::model()->deleteAllByAttributes(array('id_segment'=>$data['id_segment']));	

					foreach ($list_id as $key => $value)
					{				
						$customer_segment              = new CustomerSegment;				
						$customer_segment->id_customer = $value['id_customer'];
						$customer_segment->id_segment  = $data['id_segment'];
						$customer_segment->code_number = $value['code_number'];
						$customer_segment->fullname    = $value['fullname'];
						$customer_segment->gender      = $value['gender'];
						$customer_segment->birthdate   = $value['birthdate'];
						$customer_segment->phone       = $value['phone'];
						$customer_segment->email       = $value['email'];
						$customer_segment->save();
					}

				}

				return 1;

			}else {

				return 1;

			}	

		}else{

			return 0;
			
		}	

	}
}
