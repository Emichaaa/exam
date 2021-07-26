<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Fetch data from cURL
$curl_data = json_decode(file_get_contents('php://input'), true);


if(!empty($curl_data['user'])){

    // Prepare log row and add it to txt file
    $curl_time = date("Y-m-d H:i:s",time());
    $curl_username = (!empty($curl_data['user']['username']) ? "Username - " . $curl_data['user']['username'] . ";" : "");
    $curl_user_email = (!empty($curl_data['user']['user_email']) ? " Email - " . $curl_data['user']['user_email'] . ";" : "");
    $log_row = $curl_time . " : " . $curl_username . $curl_user_email;
    $log_file = file_put_contents('api-logs.txt', $log_row.PHP_EOL , FILE_APPEND | LOCK_EX);

    // If row added to log file - return "record log" response
    if($log_file){
        echo "record log";
    }
}
else {
    echo "error";
}


?>