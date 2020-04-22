<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://accounts.spotify.com/api/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic NTE3MTliZmUxYTc1NDI2NjlhZjBjZjg2NGNhMDNmZTQ6OTcxM2Y2NzVlYzkxNGUzZTk1MGU4OGVkZGI3NWUwZDE='
));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    'grant_type' => 'client_credentials'
)));

$server_output = json_decode(curl_exec($ch));
$accessToken = $server_output->access_token;

curl_close($ch);
$ch = curl_init();

$url = "https://api.spotify.com/v1/search?type=track&market=US&limit=10&q=" . urlencode($track);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $accessToken
));

$result = json_decode(curl_exec($ch));
if ($result === false) {
    echo "Error in cURL : " . curl_error($ch);
} else {
    $output = array();
    $result = $result->tracks->items;
    foreach ($result as $track) {
        $tmp = array(
            "title" => $track->name,
            "artwork" => $track->album->images[2]->url,
            "artist" => $track->artists[0]->name,
            "preview_url" => $track->preview_url
        );

        array_push($output, $tmp);
    }
}

curl_close($ch);
