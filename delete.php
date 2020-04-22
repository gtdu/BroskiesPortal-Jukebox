<?php

include_once("init.php");

if ($_SESSION['level'] != 2) {
    die();
}

$handle = $config['dbo']->prepare('DELETE FROM recommendations WHERE id = ?');
$handle->bindValue(1, $_GET['id']);
$handle->execute();

header("Location: recommendations.php");
