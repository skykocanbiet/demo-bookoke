<?php
 
/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Push {
 
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPush() {

        $body = array();
        $body['is_background']  = $this->is_background;
        $body['message']        = $this->message;
        $body['image']          = $this->image;
        $body['payload']        = $this->data;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $body['timestamp'] = date('Y-m-d H:i:s');

        $res = array();
        $res['body'] = $this->message;
        $res['data'] =  $body;
        $res['title'] = $this->title;
        $res['sound'] = 'default';
        //$res['sound'] = '';
        
        return $res;
    }
 
}