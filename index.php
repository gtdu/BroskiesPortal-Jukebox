<?php

$ch = curl_init();

$postData = array(
    'session_token' => $_GET['session_token'],
    'api_key' => "__INSERT_API_TOKEN__",
);


curl_setopt($ch, CURLOPT_URL,"http://broskies.gtdu.org/api/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

$server_output = json_decode(curl_exec($ch));

curl_close($ch);

if ($server_output->level == 0) {
    echo "No access";
} else if ($server_output->level == 1) {
    echo "Normal access";
} else if ($server_output->level == 2) {
    echo "Admin access";
} else {
    echo "Error";
}
