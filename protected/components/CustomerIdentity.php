<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class CustomerIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the phone and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

    private $_id;

    public function authenticate() {

		$phone=strtolower($this->username);
        
		$data = Customer::model()->findByAttributes(array('phone'=>$phone));

        if($data === null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->errorMessage = 'Incorrect phone or password.';
        }
        else {
			if($data->status == '-1') {
			     //if user is blocked
    			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    			$this->errorMessage = 'Your login has been blocked. Please contact the Support nha khoa 2000.';
    			return $this->errorCode;
			}
            else {
                
    			if($data->password !== md5($this->password)) { //if password not match
        			$this->errorCode = self::ERROR_PASSWORD_INVALID;
        			$this->errorMessage = 'Incorrect password.';
    			}
    			else {

                    Yii::app()->user->setState('customer_id', $data->id);
        			Yii::app()->user->setState('customer_name', $data->fullname);
        			Yii::app()->session['guest'] = false;

                    $this->errorCode=self::ERROR_NONE;

                  

					return $this->errorCode;
    			}
            }
		}
        
		return !$this->errorCode;

        //$rs_customer = new CHttpRequest();
        //$arr = array("username"=>$this->username,
                   // "password"=>($this->errorCode != self::ERROR_NONE)?$this->password:'',
                   // "ip"=>$rs_customer->getUserHostAddress(),
                   // "error_code"=>$this->errorCode,
                    //"error_msg"=>$this->errorMessage);

        //save in history login
        //$history_login_id = $Customer->saveHistoryLogin($arr);
        //Yii::app()->user->setState('history_login_id', $history_login_id);


    }

}