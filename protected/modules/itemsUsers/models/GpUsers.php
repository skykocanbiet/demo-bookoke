<?php

/**
 * This is the model class for table "users_ccp".
 *
 * The followings are the available columns in table 'users_ccp':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password
 * @property integer $device_type
 * @property string $device_id
 * @property string $email
 * @property string $image
 * @property integer $group_id
 * @property string $createDate
 * @property string $lastvisitDate
 * @property integer $block
 */
class GpUsers extends CActiveRecord
{
    public $repeatpassword;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gp_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone, name', 'required'),
			array('group_id,phone, device_type, block,book_onl,status_hidden, stt_status,ct_status', 'numerical', 'integerOnly'=>true),
			array('username, name, password, email', 'length', 'max'=>128),
			array('code', 'length', 'max'=>50),
            array('username','unique', 'message'=>'username is already exist, please change'),
			array('exp, diploma, certificate, language, description, createDate, lastvisitDate', 'safe'),
            array('repeatpassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,code, username, name, password, email,exp, diploma, certificate, language, description, image, group_id, createDate,device_id, device_type, lastvisitDate, block, stt_status,status_hidden,ct_status,phone,book_onl', 'safe', 'on'=>'search'),
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
            'rel_group' => array(self::BELONGS_TO,'GpGroup','group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' =>'Code',
			'username' => 'Username',
			'device_id'	=> 'device_id',
			'name' => 'Name',
			'password' => 'Password',
            'repeatpassword' => 'Confirm Password',
			'email' => 'Email',
			'exp' => 'Experience',
			'diploma' => 'Diploma',
			'certificate' => 'Certificate',
			'language' => 'Language',
			'description'	=> 'Description',
			'image' => 'Image',
			'group_id' => 'Group',
			'device_type'	=> 'Device Type',
			'createDate' => 'Create',
			'lastvisitDate' => 'Lastvisit',
			'block' => 'Block',
			'stt_status' =>'STT Status',
			'status_hidden' => 'Status Hidden',
			'ct_status' =>'CT Hidden',
			'phone'	=> 'Phone',
			'book_onl' =>'Book Online',
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
		$criteria->compare('code',$this->code);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('device_id',$this->device_id,true);
		$criteria->compare('device_type',$this->device_type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('exp',$this->exp,true);
		$criteria->compare('diploma',$this->diploma,true);
		$criteria->compare('certificate',$this->certificate,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('createDate',$this->createDate,true);
		$criteria->compare('lastvisitDate',$this->lastvisitDate,true);
		$criteria->compare('block',$this->block);
		$criteria->compare('stt_status',$this->stt_status);
		$criteria->compare('status_hidden',$this->block);
		$criteria->compare('ct_status',$this->ct_status);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('book_onl',$this->book_onl,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersCcp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function ImageUserValidation($attribute,$param){
    	if(is_object($this->image)){
    		list($width, $height) = getimagesize($this->image->tempname);
    		if($width!=1000 || $height!=1000)
    			$this->addError('image','Image size should be 1000*1000 dimension');
    	}
    }

    public function saveImageScaleAndCrop($fileImageUpload,$w='1000',$h='1000',$imageUploadSource,$imageNameUpload){

            $image = new EasyImage($fileImageUpload);

            $image->scaleAndCrop($w, $h);
            
            $image->save($imageUploadSource."lg/".$imageNameUpload);
            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/2, $h/2);
            $image->save($imageUploadSource."md/".$imageNameUpload);

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/4, $h/4);
            $image->save($imageUploadSource."sm/".$imageNameUpload);

            return true;
    }

    public function deleteImageScaleAndCrop($fileImageDelete){

    	   unlink("upload/users/lg/".$fileImageDelete);
		   unlink("upload/users/md/".$fileImageDelete);
		   unlink("upload/users/sm/".$fileImageDelete);
    }

	public function send_notification_ios($deviceToken, $message,$alert){   //$type 0:passenger, 1:driver
	  // Put your device token here (without spaces):
	  //$deviceToken = '407ce4fc74152a4d08c5d553ac09ecacc713962af7e681c4bce83d7345f24727';

	  // Put your private key's passphrase here:
	  $passphrase = 'nhakhoa2000';
	  //return $test;   
	  // Put your alert message here:
	  //$message = 'My first push notification for iOs 9!';

	  ////////////////////////////////////////////////////////////////////////////////
	  try{
	   $ctx = stream_context_create();
	   stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');

	  stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	  
	  // Open a connection to the APNS server
	  $fp = stream_socket_client(
	      //'ssl://gateway.push.apple.com:2195', $err,
	     'ssl://gateway.sandbox.push.apple.com:2195', $err,
	     
	     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	 
	  if (!$fp)
	     exit("Failed to connect: $err $errstr" . PHP_EOL);

	  //echo 'Connected to APNS' . PHP_EOL;

	  // Create the payload body
	  $body['aps'] = array(
	      'event'=>'message',
	      'alert'=>$alert,
	      'payload' => $message,//array
	      'sound' => 'default',
	     );

	  // Encode the payload as JSON
	  $payload = json_encode($body);

	  // Build the binary notification
	  $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

	  // Send it to the server
	  $result = fwrite($fp, $msg, strlen($msg));

	  //if (!$result)
	     //echo 'Message not delivered' . PHP_EOL;
	  //else
	     //echo 'Message successfully delivered' . PHP_EOL;

	  // Close the connection to the server
	  fclose($fp);
	  
	  return $result;
	   
	  }catch (Exception $e) {
	   	return  $e->getMessage();
	  }
	  
	  
	 }

	 public function GetNotifications($data){
        $fileSource       =  Yii::getPathOfAlias('webroot').'/notification.json'; 
        $jsonData         = array("current_time"=>strtotime(date('Y-m-d H:i:s')),"status"=>"1","data"=>$data);
        file_put_contents($fileSource, json_encode($jsonData)); 
    }

	public function searchStaffs($and_conditions='',$or_conditions='',$additional='', $lpp='10', $cur_page='1'){

    	$lpp_org = $lpp;

		$con = Yii::app()->db;

		$sql = "select count(*) from gp_users where status_hidden >= 0";

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

		$sql = "select * from gp_users where status_hidden >=0  ";
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
    public function getListDentists(){

    	$data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('gp_users')
                    ->where('gp_users.status_hidden=:status_hidden and gp_users.ct_status=:ct_status', array(':status_hidden' => 1, 'ct_status' =>0))
                    ->order(array('gp_users.stt_status','gp_users.image desc'))
                    ->queryAll();

    	return	$data;
    }
    public function getListDentists_ct(){

    	$data   = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('gp_users')
                    ->where('gp_users.status_hidden=:status_hidden and gp_users.ct_status=:ct_status', array(':status_hidden' => 1, 'ct_status' =>1))
                    ->order(array('gp_users.stt_status','gp_users.image desc'))
                    ->queryAll();

    	return	$data;
    }

    public function getService(){
    	$con = Yii::app()->db;
    	$sql = "select * from cs_service";
    	$data = $con->createCommand($sql)->queryAll();
    	return $data ;
    	
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
	public function getCodeNumberCustomer(){
        $date = date('Y-m-d');
        $con = Yii::app()->db;
        $st  = 0;      
        $sql = "SELECT COUNT(*) FROM `gp_users` WHERE DATE(`createdate`) = DATE('$date') ";
        $dem = $con->createCommand($sql)->queryScalar();
        
        if($dem ==0){
            $dem = '000';
        }else{
            if($dem < 100){
                $dem = '0'.$dem;
                if($dem < 10){
                    $dem = '0'.$dem;
                }
            }
        }
        
        $create_date = str_replace(array('-',' ',':'),'',substr( $date, 2 ));        
        if($dem > 0){
            $order_code = $create_date.$dem;
        }else{
            $order_code = $create_date.$dem;
        }
        return $order_code;
    }
    public function deleteStaff($id)
    {
    	if ($id) {
    		$command = Yii::app()->db->createCommand();
    		$data = $command->update('gp_users', array(
			    'status_hidden'=>-1,
			), 'id=:id', array(':id'=>$id));
	    	// $command->delete('gp_users', 'id=:id', array(':id'=>$id));
	    	if ($data) {
	    		return $data;
	    	}
    	}
    	
    }
    public function addUserChat($username,$password,$name,$email)
    {
    	$data =array( 
    					"username" =>$username,
    					"name"=>$name,
    					"password"=>$password,
    					"email"=>$email
    				);
    	$strJsonData = json_encode($data);
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/users';
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strJsonData);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }
    public function getUserChat($username)
    {
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/users/'.$username;
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }else {
            return $output;
        }
    }
	public function getRoom($username)
    {
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/chatrooms/'.$username;
		//http://example.org:9090/plugins/restapi/v1/chatrooms/test 
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        if ($output == false) {
            return curl_error($ch); 
        }else {
            return $output;
        }
    }
    public function updateUserChat($username,$password,$name,$email)
    {
    	$data =array( 
    					"username" =>$username,
    					"name"=>$name,
    					"password"=>$password,
    					"email"=>$email
    				);
    	$strJsonData = json_encode($data);
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/users/'.$username;
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strJsonData);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }
    public function createChatRoom($roomName,$naturalName,$description)
    {
    	$data =array( 
			"roomName" =>$roomName,
			"naturalName"=>$naturalName,
			"description"=>$description
    	);
    	$strJsonData = json_encode($data);
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/chatrooms';
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strJsonData);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }
    public function createGroup($name,$description)
    {
    	$input_xml= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><group><name>'.$name.'</name><description>'.$description.'</description></group>';
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/groups';
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/xml',
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$input_xml);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }

    }
    public function RetrieveAllGroups()
    {
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/groups';
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 'xmlRequest='.$input_xml);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }
    public function RetrieveAGroup()
    {
    	$namegroup = "designroom";
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/groups/'.$namegroup;
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        	'Content-Type: application/xml',
        	'Authorization: gm76ifqJDeH5SsEv'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }
    public function AddUserToGroup()
    {
    	$ch = curl_init();
    	if (false === $ch) {
            throw new Exception('failed to initialize');
        }
        $gatewayUrl = 'http://chat.bookoke.com:9090/plugins/restapi/v1/users/huy/groups/Dau Ip BookOke';
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: gm76ifqJDeH5SsEv',
        'Content-Type: application/xml'
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        if ($output ===false) {
            return curl_error($ch); 
        }
        else {
            return $output;
        }
    }

    
    


}
