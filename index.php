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

$diplayFormErrors = false;
$displayFormSucces = false;
$formSuccess = 'record added to collection';

//on submit...
if (isset($_POST['newRecord'])) {

    //handle errors
    $errors = [];

    if (empty($newAlbumName)) {
        $errors['albumName'] = 'Album name is required';
    }
    if (empty($newArtistName)) {
        $errors['artistName'] = 'Artist name is required';
    }
    if (empty($newReleaseYear) || !is_numeric($newReleaseYear) || strlen((string)$newReleaseYear) != 4) {
        $errors['releaseYear'] = 'Invalid release year';
    }
    if ($newGenre === 0 || empty($newGenre)) {
        $errors['genre'] = 'Music genre is required';
    }
    if (empty($newScore) || !is_numeric($newScore) || $newScore < 1 || $newScore > 10) {
        $errors['score'] = 'number between 1 and 10';
    }
    if (empty($newImg)) {
        $errors['img'] = 'Image link is required';
    }
    // if no errors proceed... if errors display
    if (empty($errors)) {
        $recordModel->addRecord($newAlbumName, $newArtistName, $newReleaseYear, $newGenre, $newScore, $newImg);
        $displayFormSucces = true;
    } else if (!empty($errors)) {
        $diplayFormErrors = true;
    }
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
            <!-- <a class='navLink'>+ Record</a> -->
            <!-- <a class='navLink'>Archive</a> -->
        </div>
    </div>
    <!-- nav-bar -->

    <!-- add record form -->
    <div class='formContainerInfo'>
        <p class='whiteCopy'>Add record to collection</p>
        <!-- <p><a class='whiteCopy'>X</a></p> -->
    </div>
    <div class='formContainer'>
        <form class='newRecordForm' method='POST'>
            <div class='inputField'>
                <label for='newAlbumName'>Album name:</label>
                <div>
                    <input type='text' name='newAlbumName' id='newAlbumName' />
                    <?php
                        if ($diplayFormErrors && isset($errors['albumName'])) {
                            echo "<p class='errorMessage'>$errors[albumName]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newArtistName'>Artist name:</label>
                <div>
                    <input type='text' name='newArtistName' id='newArtistName' />
                    <?php
                        if ($diplayFormErrors && isset($errors['artistName'])) {
                            echo "<p class='errorMessage'>$errors[artistName]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newReleaseYear'>Release Year:</label>
                <div>
                    <input type='number' name='newReleaseYear' id='newReleaseYear' />
                    <?php
                        if ($diplayFormErrors && isset($errors['releaseYear'])) {
                            echo "<p class='errorMessage'>$errors[releaseYear]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newGenre'>Music genre:</label>
                <div>
                    <select name='newGenre' id='newGenre'>
                        <option value=0>Select...</option>
                        <option class='Soul' value=1>Soul</option>
                        <option value=2>Funk</option>
                        <option value=3>Pop</option>
                        <option value=4>Rock</option>
                        <option value=5>Metal</option>
                        <option value=6>Hip-Hop</option>
                        <option value=7>Jazz</option>
                        <option value=8>Country</option>
                    </select>
                    <?php
                        if ($diplayFormErrors && isset($errors['genre'])) {
                            echo "<p class='errorMessage'>$errors[genre]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newScore'>Score (1-10):</label>
                <div>
                    <input type='number' name='newScore' id='newScore' />
                    <?php
                        if ($diplayFormErrors && isset($errors['score'])) {
                            echo "<p class='errorMessage'>$errors[score]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newImg'>Image (link):</label>
                <div>
                    <input type='text' name='newImg' id='newImg' />
                    <?php
                        if ($diplayFormErrors && isset($errors['img'])) {
                            echo "<p class='errorMessage'>$errors[img]</p>";
                        } else {
                            echo "<p class='errorMessagePlaceholder'>.</p>";
                        }                        
                    ?>
                </div>
            </div>
            <div class='formContainerInfo'>
                <div class='inputField'>
                    <input class='button' type='submit' value='Add record' name='newRecord' />
                    <?php
                    // // if($displayFormSucces){
                    //     echo "<p>$formSuccess</p>";
                    // // }
                    ?>
                </div>
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