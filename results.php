<?php

include_once("init.php");

if ($_SESSION['level'] == 0 || $_SESSION['level'] > 2) {
    die();
}

$track = $_POST['track'];

$playlist_id = $_POST['playlist'];
$handle = $config['dbo']->prepare('SELECT * FROM playlists WHERE id = ?');
$handle->bindValue(1, $playlist_id);
$handle->execute();
$playlist_name = $handle->fetchAll(\PDO::FETCH_ASSOC)[0]['name'];

include_once("search.php");

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    iframe {
        height: 40px;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1 class="mt-2">Jukebox: <?php echo $playlist_name; ?></h1>
    <div class="d-flex mt-3 mb-3">
        <div class="btn-group flex-fill" role="group" aria-label="Basic example">
            <a href="dashboard.php" class="btn btn-warning">New Search</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Track</th>
                <th>Artist</th>
                <th>Preview</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <?php
        foreach ($output as $track) {
            $data = base64_encode(json_encode($track));
            echo "<tr>";
            echo "<td><img src='" . $track['artwork'] . "'></td>";
            echo "<td>" . $track['title'] . "</td>";
            echo "<td>" . $track['artist'] . "</td>";
            echo "<td><iframe src='" . $track['preview_url'] . "'></iframe></td>";
            echo "<td><a href='save.php?playlist=" . $playlist_id . "&data=" . $data . "' class='btn btn-primary'>Add to Playlist</a></td>";
            echo "</tr>";
        }
        ?>
    </tabl>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
