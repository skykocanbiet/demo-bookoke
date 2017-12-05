<?php
define('FIREBASE_API_KEY', 'AAAA1fXQE_g:APA91bE8AYSH5FfMbOUvFsWYA9I9KOzwvqqny0wCHuScXOZMZIN3xuS-OKwmpqUcm-F9DoRNNqDMZTK25uzFiKU5mPHB_4fqBO1D4EYu2_DauhK7ke3CpqQFcJv2sNOtuR0sEq3qJyq-');
/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Firebase {
    
    // sending push message to single user by firebase reg id
    public function send($to, $message) {
       
        $fields = array(
            'to' => $to,
            'notification' => $message,
            // 'priority' => 'high',
            'content_available' => true,
        );
        // echo '<pre>';
        //     print_r($fields);
        // echo '</pre>';exit;
        return $this->sendPushNotification($fields);
    }
 
    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
    	$fields = array(
            'to' => '/topics/' . $to,
            'notification' => $message,
            // 'priority' => 'high',
            'content_available' => true,
        );
        return $this->sendPushNotification($fields);
    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
 
        return $this->sendPushNotification($fields);
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
        // echo '<pre>';
        //     print_r($fields);
        // echo '</pre>';exit;
 
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key=' . "AAAA1fXQE_g:APA91bE8AYSH5FfMbOUvFsWYA9I9KOzwvqqny0wCHuScXOZMZIN3xuS-OKwmpqUcm-F9DoRNNqDMZTK25uzFiKU5mPHB_4fqBO1D4EYu2_DauhK7ke3CpqQFcJv2sNOtuR0sEq3qJyq-",
            // 'Authorization: key=' . "AIzaSyBraiRsBZMKMVJ8hDezEiR5QQ8k22gWGhs",
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        // echo '<pre>';
        // print_r($ch);
        // echo '</pre>';exit;

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
 
        return $result;
    }
}