<?php

use Collection\GenresModel;
use Collection\RecordsModel;

require_once 'vendor/autoload.php';
require_once 'src/displayAllGenresFunction.php';
require_once 'src/generateFormSubmitErrorsFunction.php';
require_once 'src/DisplayAllRecordsFunction.php';
require_once 'src/returnDataBaseFunction.php';

//connect and format db
$db = returnDatabase();

//create models
$recordModel = new RecordsModel($db);
$genresModel = new GenresModel($db);

// get all genres
$genres = $genresModel->getAllGenres();

// Susccess messages
$successAddMessage = 'Record added to collection :)';
$successUpdateMessage = 'Record was updated :)';

// Handle user input
$newAlbumName = $_POST['newAlbumName'] ?? false;
$newArtistName = $_POST['newArtistName'] ?? false;
$newReleaseYear = $_POST['newReleaseYear'] ?? false;
$newGenre = $_POST['newGenre'] ?? false;
$newScore = $_POST['newScore'] ?? false;
$newImg = $_POST['newImg'] ?? false;
$CurrentrecordId  = $_POST['recordIDUpdate'] ?? false;
$genreFilterID = $_GET['selectGenre'] ?? null;

//on new record submit...
if (isset($_POST['newRecord'])) {
    $newRecordErrors = generateFormSubmitErrors(
        $newAlbumName,
        $newArtistName,
        $newReleaseYear,
        $newGenre,
        $newScore,
        $newImg
    );

    // if no errors proceed... if errors display
    if (empty($newRecordErrors)) {
        $recordModel->addRecord($newAlbumName, $newArtistName, $newReleaseYear, $newGenre, $newScore, $newImg);
        header('Location: addrecord.php');
        exit();
    } else if (!empty($newRecordErrors)) {
        unset($_GET['success']);
        unset($_GET['updated']);
    }
}

//handle remove record request
if (isset($_POST['remove'])) {
    $selectedRecordID = $_POST['recordID'];
    if ($recordModel->removeRecord($selectedRecordID)) {
        header('Location: index.php');
    }
}

$displayUpdateForm = false;
//handle update record request P1 - send user to form / populate it accordingly / change form appearance 
if (isset($_POST['update'])) {
    unset($_GET['updated']);
    unset($_GET['success']);

    $currentRecord = $recordModel->getRecord($_POST['recordIDUpdate']);

    $newAlbumName = $currentRecord->album_name;
    $newArtistName = $currentRecord->artist_name;
    $newReleaseYear = $currentRecord->release_year;
    $newGenre = $currentRecord->genre_id;
    $newScore = $currentRecord->score;
    $newImg = $currentRecord->img;
    $genreNameForm  = $currentRecord->genre_name;
    $recordIdForm = $currentRecord->id;

    $displayUpdateForm = true;
}

//handle update record request P2 - update record logic
if (isset($_POST['updateRecord'])) {

    $newRecordErrors = generateFormSubmitErrors(
        $newAlbumName,
        $newArtistName,
        $newReleaseYear,
        $newGenre,
        $newScore,
        $newImg
    );

    // if no errors proceed... if errors display
    if (empty($newRecordErrors)) {
        $recordModel->updateRecord($newAlbumName, $newArtistName, $newReleaseYear, $newGenre, $newScore, $newImg, $CurrentrecordId);
        $displayUpdateForm = false;
        header("Location: index.php?updated=1");
    } else if (!empty($newRecordErrors)) {
        $displayUpdateForm = true;
        unset($_GET['success']);
        unset($_GET['updated']);
    }
}

//handle +Record Nav click
if (isset($_POST['addRecordForm'])) {
    $displayUpdateForm = false;
    unset($_GET['success']);
    unset($_GET['updated']);
}

// Either show all products or filtered records...
if (isset($_GET['selectGenre'])) {
    $allRecords = $recordModel->getAllRecords(0, $genreFilterID);
} else {
    $allRecords = $recordModel->getAllRecords(0);
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

<body id='addRecord'>
    <!-- nav-bar -->
    <div class='navBar'>
        <div class='leftNav'>
            <a href='index.php' class='navLink'>MyRecords</a>
        </div>
        <div class='rightNav'>
            <form method="POST"><input href='#addRecord' class='navLink notButton' type='submit' value='+ Record' name='addRecordForm' /></form>
            <a href='archive.php' class='navLink'>Archive</a>
        </div>
    </div>
    <!-- nav-bar -->

    <!-- add record form -->
    <div class='formContainerInfo'>
        <?php

        if ($displayUpdateForm) {
            echo "<p class='whiteCopy'>Update <span class='underline'>$newAlbumName</span></p>";
        } else {
            echo "<p class='whiteCopy'>Add record to collection</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p class='successCopy'>$successAddMessage</p>";
        }
        if (isset($_GET['updated'])) {
            echo "<p class='successCopy'>$successUpdateMessage</p>";
        }

        ?>
    </div>
    <div class='formContainer'>
        <form class='newRecordForm' method='POST'>
            <div class='inputField'>
                <label for='newAlbumName'>Album name:</label>
                <div>
                    <input type='text' value="<?php if ($newAlbumName) echo $newAlbumName; ?>" name='newAlbumName' id='newAlbumName' />
                    <?php
                    if (isset($newRecordErrors['albumName'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['albumName']}</p>";
                    } else {
                        echo "<p class='errorMessagePlaceholder'>.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newArtistName'>Artist name:</label>
                <div>
                    <input type='text' value="<?php if ($newArtistName) echo $newArtistName; ?>" name='newArtistName' id='newArtistName' />
                    <?php
                    if (isset($newRecordErrors['artistName'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['artistName']}</p>";
                    } else {
                        echo "<p class='errorMessagePlaceholder'>.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newReleaseYear'>Release year:</label>
                <div>
                    <input type='number' value="<?php if ($newReleaseYear) echo $newReleaseYear; ?>" name='newReleaseYear' id='newReleaseYear' min="1000" max="2023" />
                    <?php
                    if (isset($newRecordErrors['releaseYear'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['releaseYear']}</p>";
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
                        <?php
                        echo displayAllGenres($genres);
                        ?>
                    </select>
                    <?php
                    if (isset($newRecordErrors['genre'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['genre']}</p>";
                    } else {
                        echo "<p class='errorMessagePlaceholder'>.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newScore'>Score (1-10):</label>
                <div>
                    <input type='number' value="<?php if ($newScore) echo $newScore; ?>" name='newScore' id='newScore' min='1' max='10' />
                    <?php
                    if (isset($newRecordErrors['score'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['score']}</p>";
                    } else {
                        echo "<p class='errorMessagePlaceholder'>.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class='inputField'>
                <label for='newImg'>Image (link):</label>
                <div>
                    <input type='text' value="<?php if ($newImg) echo $newImg; ?>" name='newImg' id='newImg' />
                    <?php
                    if (isset($newRecordErrors['img'])) {
                        echo "<p class='errorMessage'>{$newRecordErrors['img']}</p>";
                    } else {
                        echo "<p class='errorMessagePlaceholder'>.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class='formContainerInfo'>
                <div class='inputField'>
                    <?php
                    if ($displayUpdateForm) {
                        echo "<input class='button' type='submit' value='Update record' name='updateRecord' />";
                        echo " <input href='#addRecord' type='hidden' name='recordIDUpdate' value='$CurrentrecordId' />";
                    } else {
                        echo "<input class='button' type='submit' value='Add record' name='newRecord' />";
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
    <!-- add record form -->
    <!-- Filter records -->
    <div class='filterContainer'>
        <form method="GET" id='filterForm'>
            <select class='filter' name='selectGenre' id='selectGenre'>
                <option>Select...</option>
                <option value='0'>All records</option>
                <?php
                echo displayAllGenres($genres);
                ?>
            </select>
            <label for='selectGenre'>Filter by genre</label>
        </form>
        <form method="GET" id='textFilterForm'>
            <input type="text" class="filter" name='textFilter' id='textFilter' placeholder="Search..."/>
        </form>
    </div>
    <!-- Filter records -->
    <!-- record display -->
    <div class='flexConatiner'>
        <?php
        if ($allRecords == false) {
            $selectedGenre = $genresModel->getGenreByID($genreFilterID);
            echo "<p class='mediumCopy'>No $selectedGenre->name records in collection</p>";
        } else {
            echo displayAllRecords($allRecords);
        }
        ?>
    </div>
    <!-- record display -->

</body>

</html>