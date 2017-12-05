<?php

/**
 * This is the model class for table "cs_notifications".
 *
 * The followings are the available columns in table 'cs_notifications':
 * @property integer $id
 * @property integer $id_author
 * @property integer $id_dentist
 * @property string $action
 * @property integer $flag
 * @property string $data
 * @property string $createdate
 * @property integer $status
 */
class CsNotifications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_author, id_dentist, flag, status', 'numerical', 'integerOnly'=>true),
			array('action', 'length', 'max'=>255),
			array('data, createdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_author, id_dentist, action, flag, data, createdate, status', 'safe', 'on'=>'search'),
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
			'id_author' => 'Id Author',
			'id_dentist' => 'Id Dentist',
			'action' => 'Action',
			'flag' => 'Flag',
			'data' => 'Data',
			'createdate' => 'Createdate',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsNotifications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function sendPush($regId,$title,$message,$data) {
        // Enabling error reporting

        require_once __DIR__ . '/../components/push.php';
        require_once __DIR__ . '/../components/firebase.php';

        $push = new Push();
        $firebase = new Firebase();

        // push type - single user / topic
        $push_type = 'individual';
         
        // whether to include to image or not
        $include_image = "";
 
 
        $push->setTitle($title);
        $push->setMessage($message);
       	$push->setImage('');

        $push->setIsBackground(FALSE);
        $push->setPayload($data);
 
        $json = '';
        $response = '';
 
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            
            $response = $firebase->send($regId, $json);
        }
        return $response;

    }

    public function sendMail($mailHost,$mailPort,$username,$password,$mailFrom,$mailTo,$title,$email_content){
        
        $SM = Yii::app()->swiftMailer;
        
        // New transport 
        $Transport = $SM->smtpTransport($mailHost, $mailPort)
        ->setUsername($username)
        ->setPassword($password);
        
         // Mailer
        $Mailer = $SM->mailer($Transport);
        
        // New message
        $Message = $SM
            ->newMessage($title)
            ->setFrom($mailFrom)
            ->setTo($mailTo)
            ->addPart($email_content, 'text/html','utf-8');
        $result = $Mailer->send($Message);
        return $result;
    }


	public function getListNotifications(){		

     $data   = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from('v_notification')
	        ->order('v_notification.creatdate DESC')
	        ->limit(10)
	        ->queryAll();
        return $data;
	}


	public function getUserListNotifications($id_user){
		if($id_user && Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_dentist']){
			$data   = Yii::app()->db->createCommand()
		        ->select('*')
		        ->from('v_notification')
				->where('v_notification.id_dentist=:id_dentist', array(':id_dentist' => $id_user))
		        ->limit(20)
		        ->order('v_notification.creatdate DESC')
		        ->queryAll();
		}else{
			$data   = Yii::app()->db->createCommand()
		        ->select('*')
		        ->from('v_notification')
		        ->limit(20)
		        ->order('v_notification.creatdate DESC')
		        ->queryAll();
		}
     
        return $data;
	}

	public function getSumNotificationsNotSeen($id_user){

		if($id_user && Yii::app()->user->getState('group_id') == Yii::app()->params['id_group_dentist'] ){

			$data   = Yii::app()->db->createCommand()
		        ->select('COUNT(*)')
		        ->from('v_notification')
		        ->where('v_notification.id_dentist=:id_dentist', array(':id_dentist' => $id_user))
		        ->andWhere('v_notification.status=:status', array(':status' => 0))
		        ->order('v_notification.creatdate DESC')
		        ->queryScalar();

		}else{
			$data   = Yii::app()->db->createCommand()
		        ->select('COUNT(*)')
		        ->from('v_notification')
		        ->where('v_notification.status=:status', array(':status' => 0))
		        ->order('v_notification.creatdate DESC')
		        ->queryScalar();
				
		}
	
		$data_watched   = Yii::app()->db->createCommand()
	        ->select('COUNT(*)')
	        ->from('cs_notifications_history')
	        ->where('cs_notifications_history.id_user=:id_user', array(':id_user' => $id_user))
	        ->andWhere('cs_notifications_history.status=:status', array(':status' => 0))
	        ->queryScalar();
		
        return $data-$data_watched;

	}


	public function getUser($id_user){
		return GpUsers::model()->findByPk($id_user);
	}

	public function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
		$then = new DateTime( $datetime );
		$diff = (array) $now->diff( $then );

		$diff['w']  = floor( $diff['d'] / 7 );
		$diff['d'] -= $diff['w'] * 7;

		$string = array(
			'y' => 'năm',
			'm' => 'tháng',
			'w' => 'tuần',
			'd' => 'ngày',
			'h' => 'giờ',
			'i' => 'phút',
			's' => 'giây',
		);

		foreach( $string as $k => & $v )
		{
			if ( $diff[$k] )
			{
				$v = $diff[$k] . ' ' . $v .( $diff[$k] > 1 ? '' : '' );
			}
			else
			{
				unset( $string[$k] );
			}
		}

		if ( ! $full ) $string = array_slice( $string, 0, 1 );
		return $string ? implode( ', ', $string ) . ' trước' : 'just now';
	}

	public function saveNotificationCustomer($id_author,$id_customer,$action){

		$flag = 3; // Cờ thông báo khách hàng tiềm năng
		
		if($id_customer){

			$data = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('customer')
                    ->where('id=:id', array(':id'=> $id_customer))
                    ->queryRow();

            if($id_author == '' || $id_author == 0){
            	$id_author = null;
            }

			if($data){
				$modelNoti = new CsNotifications();
				$modelNoti->id_author 	= $id_author;
				$modelNoti->id_dentist 	= NULL;
				$modelNoti->action    	= $action;
				$modelNoti->flag    	= $flag; // customer
				$modelNoti->data    	= json_encode($data);

				if($modelNoti->save(false)){

					$title = "BookOke";

					if($action == "add"){
						$message = 'Bạn có Khách Hàng tiềm năng mới '.$data['fullname'];
					}

					if($action == "update"){
						$message = 'Bạn có Khách Hàng tiềm năng mới '.$data['fullname'];
					}
					
					if($data['id']){
						$userCustomer = Customer::model()->findByPk($data['id']);
						if($userCustomer && $userCustomer->device_id){
							$this->sendPush($userCustomer->device_id,$title,$message,$modelNoti->data);
						}
					}

					if($id_author){
						$userAuthor = GpUsers::model()->findByPk($id_author);

						if($userAuthor && $userAuthor->device_id){

							if($userAuthor->group_id == Yii::app()->params['id_group_subadmin'] || $userAuthor->group_id == Yii::app()->params['id_group_admin']  ){
								$this->sendPush($userAuthor->device_id,$title,$message,$modelNoti->data);
							}
						}
					}

					$soap = new SoapService();
					
					$rs = $soap->webservice_server_ws("getAddNewNotiSchedule",array('1','317db7dbff3c4e6ec4bdd092f3b220a8',Yii::app()->params['id_company'],json_encode($data),$action));

					return Yii::app()->params['id_company'] ;
				}
			} 
		}

        return false;
	}
	
	public function saveNotificationSchedule($id_author,$id_dentist,$id_schedule,$action){

		$flag = 0; // Cờ Thống báo lịch hẹn
		if($id_schedule){

			$data = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('v_schedule')
                    ->where('id=:id', array(':id'=> $id_schedule))
                    ->queryRow();

			if($data){
				$modelNoti = new CsNotifications();
				$modelNoti->id_author 	= $id_author;
				$modelNoti->id_dentist 	= $id_dentist;
				$modelNoti->action    	= $action;
				$modelNoti->flag    	= $flag;
				$modelNoti->data    	= json_encode($data);



				if($modelNoti->save(false)){
					$title = "BookOke";

					if($action == "add"){
						$messageDentist  = 'Bạn có lịch hẹn mới từ Khách Hàng '."\n".$data['fullname'];
						$messageAuthor   = 'Bạn có lịch hẹn mới từ Khách Hàng '."\n".$data['fullname'];
						$messageCustomer = 'Quý khách đã tạo một lịch hẹn từ Bookoke .Bác sĩ: '.$data['name_dentist'].' vào lúc '.$data['start_time'];
					}

					if($action == "update"){
						$messageDentist  = 'Bạn có thay đổi lịch hẹn từ Khách Hàng '."\n".$data['fullname'];
						$messageAuthor   = 'Bạn có thay đổi lịch hẹn từ Khách Hàng '."\n".$data['fullname'];
						$messageCustomer = 'Quý khách đã thay đổi lịch hẹn từ Bookoke .Bác sĩ: '.$data['name_dentist'].' vào lúc '.$data['start_time'];
					}	

					if($id_dentist){

						$userDentist = GpUsers::model()->findByPk($id_dentist);
						if($userDentist && $userDentist->device_id){
							$this->sendPush($userDentist->device_id,$title,$messageDentist,$modelNoti->attributes);
						}
					}
					
					if($data['id_customer']){
						
						$userCustomer = Customer::model()->findByPk($data['id_customer']);
						if($userCustomer && $userCustomer->device_id){
							$this->sendPush($userCustomer->device_id,$title,$messageCustomer,$modelNoti->attributes);
						}
					}

					

					if($id_author && ($id_author != $id_dentist) ){

						$userAuthor = GpUsers::model()->findByPk($id_author);

						if($userAuthor && $userAuthor->device_id){

							if($userAuthor->group_id == Yii::app()->params['id_group_subadmin'] || $userAuthor->group_id == Yii::app()->params['id_group_admin']  ){
								$this->sendPush($userAuthor->device_id,$title,$messageAuthor,$modelNoti->attributes);
							}
						}
					}

					
					$listUserPush =  GpNotificationPush::model()->findAll('status=:status',array(':status'=>1));

					if($listUserPush && count($listUserPush) > 0) {

						foreach ($listUserPush as $key => $value) {

							$userPush = GpUsers::model()->findByPk($value['id_user']);

							if($userPush && $userPush->device_id && ($userPush->id != $id_author ) ){
								$this->sendPush($userPush->device_id,$title,$messageAuthor,$modelNoti->attributes);
							}

						}

					}
					

					$soap = new SoapService();
					
					$rs   = $soap->webservice_server_ws("getAddNewNotiSchedule",array('1','317db7dbff3c4e6ec4bdd092f3b220a8',Yii::app()->params['id_company'],json_encode($data),$action));

					return $modelNoti->id;
				}
			} 
		}

        return false;
	}

	public function getAllWatchedNotifications($list_noti,$id_user){


        if(!$id_user || $id_user == 0 || $id_user == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid');
        }

        $rs = 0;

        if(is_numeric($list_noti) && $list_noti == 0 ){ // xem tất cả

            $list_data = CsNotifications::model()->findAllByAttributes(array("status"=>0));

            foreach($list_data as $k => $value ){
                $checkWatched = $this->checkViewIdUserNoti($id_user,$value['id']);

                if($checkWatched == false){
                    $CsNotificationsHistory = new CsNotificationsHistory();
                    $CsNotificationsHistory->id_notification = $value['id'];
                    $CsNotificationsHistory->id_user = $id_user;
                    $CsNotificationsHistory->status = 0;
                    if($CsNotificationsHistory->save()){
                        $rs = $CsNotificationsHistory->id;
                    }
                    
                 }
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

        if(is_array($list_noti)){// lấy mang checked 

            foreach($list_noti as $k => $value){
                
                if(is_numeric($value)){
                    $checkWatched = $this->checkViewIdUserNoti($id_user,$value);

                    if($checkWatched == false){
                        $CsNotificationsHistory                     = new CsNotificationsHistory();
                        $CsNotificationsHistory->id_notification    = $value;
                        $CsNotificationsHistory->id_user            = $id_user;
                        $CsNotificationsHistory->status             = 0;
                        if($CsNotificationsHistory->save()){
                            $rs = $CsNotificationsHistory->id;
                        }
                        
                     }
                }
                
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xem rùi');

        }

         return  array('status' => 'Fail','error'=> -1, 'error-message'=>'du lieu khong hop le');

    }

    public function deleteNotifications($list_noti,$id_user){

       if(!$id_user || $id_user == 0 || $id_user == ''){
            return  array('status' => 'Fail', 'error-message'=>'id_user invalid');
        }

        $rs = 0;

        if(is_numeric($list_noti) && $list_noti == 0 ){ // xóa tất cả
        
            $list_data = CsNotifications::model()->findAllByAttributes(array("status"=>0));

            foreach($list_data as $k => $value ){

               $rs = CsNotifications::model()->updateByPk($value['id'],array("status"=>-1));

               if($rs){
                     $sql = "UPDATE cs_notifications_history set `status`= -1 where id_notification=".$value['id']."";
                     Yii::app()->db->createCommand($sql)->execute();
               }
               
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xóa rùi');

        }

        if(is_array($list_noti)){// lấy mang checked 

            foreach($list_noti as $k => $value){
                
                if(is_numeric($value)){
                    $rs =  CsNotifications::model()->updateByPk($value,array("status"=>-1));
                    if($rs){
                         $sql = "UPDATE cs_notifications_history set `status`= -1 where id_notification=".$value."";
                         Yii::app()->db->createCommand($sql)->execute();
                   }
                }
                
            }

            if($rs){
                return  array('status' => 'successful', 'data'=>$rs);
            }

            return  array('status' => 'Fail','error'=> -2, 'error-message'=>'Cập nhật thất bại bạn đã xóa rùi');

        }

         return  array('status' => 'Fail','error'=> -1, 'error-message'=>'du lieu khong hop le');
    }

     public function checkViewIdUserNoti($id_user,$id_notification){

          $data  = CsNotificationsHistory::model()->findByAttributes(array("id_user"=>$id_user,"id_notification"=>$id_notification));

          if($data){
                return true;
          }

          return false;
    }
    
}
