<?php

use Collection\GenresModel;
use Collection\RecordsModel;

require_once 'vendor/autoload.php';
require_once 'src/displayAllGenresFunction.php';
require_once 'src/dispayAllArchivedRecordsFunction.php';
require_once 'src/returnDataBaseFunction.php';

//connect and format db
$db = returnDatabase();

//create models
$recordModel = new RecordsModel($db);
$genresModel = new GenresModel($db);

// get all genres
$genres = $genresModel->getAllGenres();

// Handle user input
$CurrentrecordId  = $_POST['recordIDUpdate'] ?? false;
$genreFilterID = $_POST['selectGenre'] ?? null;

//handle return record request
if (isset($_POST['return'])) {
    $selectedRecordID = $_POST['recordID'];
    if ($recordModel->returnRecord($selectedRecordID)) {
        header('Location: archive.php');
    }
}

// Either show all products or filtered products...
if (isset($_POST['selectGenre'])) {
    $allRecords = $recordModel->getAllRecords(1, $genreFilterID);
} else {
    $allRecords = $recordModel->getAllRecords(1);
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
            <a href='index.php' class='navLink'>+ Record</a>
            <a href='archive.php' class='navLink'>Archive</a>
        </div>
    </div>
    <!-- nav-bar -->
    <!-- Filter records -->
    <div class='filterContainer'>
        <form method="POST" id='filterForm'>
            <select class='filter' name='selectGenre' id='selectGenre'>
                <option>Select...</option>
                <option value='0'>All records</option>
                <?php
                echo displayAllGenres($genres);
                ?>
            </select>
            <label for='selectGenre'>Filter by genre</label>
    </div>
    <!-- Filter records -->
    <!-- record display -->
    <div class='flexConatiner'>
        <?php
        if ($allRecords == false) {
            if ($genreFilterID == null || !$genreFilterID) {
                echo "<p class='mediumCopy'>No records currently in archive</p>";
            } else {
                $selectedGenre = $genresModel->getGenreByID($genreFilterID);
                echo "<p class='mediumCopy'>No $selectedGenre->name records in archive</p>";
            }
        } else {
            echo  displayAllArchivedRecords($allRecords);
        }
        ?>
    </div>
    <!-- record display -->

</body>

</html>