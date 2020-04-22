<?php

include_once("init.php");

if ($_SESSION['level'] == 0 || $_SESSION['level'] > 2) {
    die();
}

$data = json_decode(base64_decode($_GET['data']));
$playlist = $_GET['playlist'];

$handle = $config['dbo']->prepare('INSERT INTO recommendations (playlistID, title, artwork, artist, preview_url) VALUES (?, ?, ?, ?, ?)');
$handle->bindValue(1, $playlist);
$handle->bindValue(2, $data->title);
$handle->bindValue(3, $data->artwork);
$handle->bindValue(4, $data->artist);
$handle->bindValue(5, $data->preview_url);
$handle->execute();

header("Location: dashboard.php");
