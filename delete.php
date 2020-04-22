<?php

include_once("init.php");

if ($_SESSION['level'] != 2) {
    die();
}

if (isset($_GET['recommendation'])) {
    $handle = $config['dbo']->prepare('DELETE FROM recommendations WHERE id = ?');
    $handle->bindValue(1, $_GET['recommendation']);
    $handle->execute();
} else if (isset($_GET['playlist'])) {
    $handle = $config['dbo']->prepare('DELETE FROM playlists WHERE id = ?; DELETE FROM recommendations WHERE playlistID = ?');
    $handle->bindValue(1, $_GET['playlist']);
    $handle->bindValue(2, $_GET['playlist']);
    $handle->execute();
}

header("Location: recommendations.php");
