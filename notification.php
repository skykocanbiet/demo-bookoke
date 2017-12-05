<?php

/**
 * Server-side file.
 * This file is an infinitive loop. Seriously.
 * It gets the file data.txt's last-changed timestamp, checks if this is larger than the timestamp of the
 * AJAX-submitted timestamp (time of last ajax request), and if so, it sends back a JSON with the data from
 * data.txt (and a timestamp). If not, it waits for one seconds and then start the next while step.
 *
 * Note: This returns a JSON, containing the content of data.txt and the timestamp of the last data.txt change.
 * This timestamp is used by the client's JavaScript for the next request, so THIS server-side script here only
 * serves new content after the last file change. Sounds weird, but try it out, you'll get into it really fast!
 */

// set php runtime to unlimited
set_time_limit(180);

// where does the data come from ? In real world this would be a SQL query or something
$data_source_file = 'notification.json';
$reponse          =   "";
$t_no             =   0;
// main loop
while (true) {

    // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
    $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;

    // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
    clearstatcache();

    // get timestamp of when file has been changed the last time
    $last_change_in_data_file = filemtime($data_source_file);
    
    // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
    if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {
      
       $data = json_decode(file_get_contents($data_source_file));
        if($last_ajax_call) {
            $reponse = $data->status;
        }   
        // put data.txt's content and timestamp of last data.txt change into array
        $result = array(
            'data' => $reponse,
            'timestamp' => $last_change_in_data_file
        );

        // encode to JSON, render the result (for AJAX)
        $json = json_encode($result);
        echo $json;

        // leave this loop step
        break;

    }
    // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
    sleep(10);
    
    $t_no++; 
    
    if($t_no == 30){ // call back request
    
        $result = array(
            'data' => '',
            'timestamp' => $last_ajax_call
        );
        
        $json = json_encode($result);
        echo $json;break;// leave this loop step
        
    }
    
    if($t_no == 180){ // timeout request
        echo '0';break;
    }
    
}
