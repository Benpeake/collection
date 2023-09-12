<?php

use Collection\RecordsModel;

require_once 'vendor/autoload.php';

//connect and format db
$db = new PDO('mysql:host=db; dbname=collection', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//create record model
$recordModel = new RecordsModel($db);

// get all products
$allRecords = $recordModel->getAllRecords();

//display records function
function displayAllRecords(array $records): string
{
    $htmlOutput = '';

    foreach ($records as $record) {
        $htmlOutput .=
            "<div class='albumContainer'>
            <img src='$record->img' alt='$record->album_name' width='300' height='300' >
            <div class='albumStats'>
                <p class='smallCopy'><strong>Album:</strong> $record->album_name</p>
                <p class='smallCopy'><strong>Artist:</strong> $record->artist_name</p>
                <p class='smallCopy'><strong>Year of release:</strong> $record->release_year</p>
                <div class='genre-input'><p class='smallCopy'><strong>Genre:</strong> $record->genre_name</p><div class='dot $record->genre_name'></div></div>
                <p class='smallCopy'><strong>Score:</strong> $record->score/10</p>
            </div>
        </div>";
    }

    return $htmlOutput;
}

// Handle add record
$newAlbumName = $_POST['newAlbumName'] ?? false;
$newArtistName = $_POST['newArtistName'] ?? false;
$newReleaseYear = $_POST['newReleaseYear'] ?? false;
$newGenre = $_POST['newGenre'] ?? false;
$newScore = $_POST['newScore'] ?? false;
$newImg = $_POST['newImg'] ?? false;

if (isset($_POST['newRecord'])) {
    $recordModel->addRecord($newAlbumName, $newArtistName, $newReleaseYear, $newGenre, $newScore, $newImg);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Template</title>

    <meta name="description" content="Template HTML file">
    <meta name="author" content="iO Academy">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link rel="icon" href="images/favicon.png" sizes="192x192">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">

    <script defer src="js/index.js"></script>
</head>

<body>
    <!-- nav-bar -->
    <div class='navBar'>
        <div class='leftNav'>
            <a class='navLink'>MyRecords</a>
        </div>
        <div class='rightNav'>
            <a class='navLink'>+ Record</a>
            <!-- <a class='navLink'>Archive</a> -->
        </div>
    </div>
    <!-- nav-bar -->

        <!-- add record form -->
        <div class='formContainer'>
        <form class ='newRecordForm'method='POST'>
            <div class='inputField'>
                <label for='newAlbumName'>Album name:</label>
                <input type='text' name='newAlbumName' id='newAlbumName' />
            </div>
            <div class='inputField'>
                <label for='newArtistName'>Artist name:</label>
                <input type='text' name='newArtistName' id='newArtistName' />
            </div>
            <div class='inputField'>
                <label for='newReleaseYear'>Release Year:</label>
                <input type='number' name='newReleaseYear' id='newReleaseYear' />
            </div>
            <div class='inputField'>
            <label for='newGenre'>Genre:</label>
                <select name='newGenre' id='newGenre'>
                    <option value=1>Soul</option>
                    <option value=2>Funk</option>
                    <option value=3>Pop</option>
                    <option value=4>Rock</option>
                    <option value=5>Metal</option>
                    <option value=6>Hip-Hop</option>
                    <option value=7>Jazz</option>
                    <option value=8>Country</option>
                </select>
            </div>
            <div class='inputField'>
                <label for='newScore'>Score (1-10):</label>
                <input type='number' name='newScore' id='newScore' />
            </div>
            <div class='inputField'>
                <label for='newImg'>Image (link):</label>
                <input type='text' name='newImg' id='newImg' />
            </div>
            <div class='inputField'>
                <input type='submit' value='Add record' name='newRecord' />
            </div>
        </form>
    </div>
    <!-- add record form -->

    <!-- record display -->
    <div class='flexConatiner'>
        <?php
        echo displayAllRecords($allRecords)
        ?>
    </div>
    <!-- record display -->

</body>

</html>