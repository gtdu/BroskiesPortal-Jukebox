<?php

include_once("init.php");

if ($_SESSION['level'] != 2) {
    die();
}

$handle = $config['dbo']->prepare('SELECT recommendations.id, title, artwork, artist, preview_url, name FROM recommendations, playlists WHERE playlistID = playlists.id ORDER BY name, title');
$handle->execute();
$data = $handle->fetchAll(\PDO::FETCH_ASSOC);

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
    <h1 class="mt-2">Manage Jukebox</h1>
    <div class="d-flex mt-3 mb-3">
        <div class="btn-group flex-fill" role="group" aria-label="Basic example">
            <a href="dashboard.php" class="btn btn-warning">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Playlist</th>
                <th>&nbsp;</th>
                <th>Track</th>
                <th>Artist</th>
                <th>Preview</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <?php
        foreach ($data as $track) {
            echo "<tr>";
            echo "<th>" . $track['name'] . "</th>";
            echo "<td><img src='" . $track['artwork'] . "'></td>";
            echo "<td>" . $track['title'] . "</td>";
            echo "<td>" . $track['artist'] . "</td>";
            echo "<td><iframe src='" . $track['preview_url'] . "'></iframe></td>";
            echo "<td><a href='delete.php?id=" . $track['id'] . "' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tabl>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
