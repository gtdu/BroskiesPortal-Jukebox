<?php

include_once("init.php");

if ($_SESSION['level'] == 0 || $_SESSION['level'] > 2) {
    die();
}

$handle = $config['dbo']->prepare('SELECT * FROM playlists ORDER BY name');
$handle->execute();
$playlists = $handle->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
</head>

<body>
    <h1 class="mt-2">Jukebox: Recommend Music</h1>
    <?php
    if ($_SESSION['level'] == 2):
        ?>
        <div class="d-flex mt-3 mb-3">
            <div class="btn-group flex-fill" role="group" aria-label="Basic example">
                <a href="recommendations.php" class="btn btn-warning">Manage System</a>
            </div>
        </div>
        <?php
    endif;
    ?>

    <form method="post" action="results.php">
        <div class="form-group">
            <label for="emailHelp">Track Name</label>
            <input id="emailHelp" type="text" class="form-control" name="track" placeholder="Cocaine Jesus">
            <small class="form-text text-muted">Search using Spotify</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Playlist</label>
            <select id="exampleInputEmail1" class="form-control" name="playlist">
                <?php
                foreach ($playlists as $row) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
