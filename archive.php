<?php

use Collection\GenresModel;
use Collection\RecordsModel;

require_once 'vendor/autoload.php';
require_once 'src/displayAllGenresFunction.php';
require_once 'src/generateFormSubmitErrorsFunction.php';
require_once 'src/dispayAllArchivedRecordsFunction.php';

//connect and format db
$db = new PDO('mysql:host=db; dbname=collection', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//create models
$recordModel = new RecordsModel($db);
$genresModel = new GenresModel($db);

// get all products
$allRecords = $recordModel->getAllArchivedRecords();

// get all genres
$genres = $genresModel->getAllGenres();

// Susccess messages
$successAddMessage = 'Record added to collection :)';
$successUpdateMessage = 'Record was updated :)';

// Handle user input
$CurrentrecordId  = $_POST['recordIDUpdate'] ?? false;
$genreFilterID = $_POST['selectGenre'] ?? null;


//handle remove record request
// if (isset($_POST['remove'])) {
//     $selectedRecordID = $_POST['recordID'];
//     if ($recordModel->removeRecord($selectedRecordID)) {
//         $recordModel->removeRecord($selectedRecordID);
//         header('Location: index.php');
//     }
// }

// THIS ABOVE FUNCTION WILL ESSENTIALY BE REVERSED 


//handle +Record click 
// if (isset($_POST['addRecordForm'])) {
//     $displayUpdateForm = false;
//     unset($_GET['success']);
//     unset($_GET['updated']);
// }

// + RECORD NEEDS TO JUST TAKE THE USER BACK TO INDEX? ABOVE

//handle genre filter
if (isset($_POST['selectGenre'])) {
    $allRecords = $recordModel->getAllArchivedRecords($genreFilterID);
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
            <a class='navLink'>MyRecords</a>
        </div>
        <div class='rightNav'>
            <form method="POST"><input href='#addRecord' class='navLink notButton' type='submit' value='+ Record' name='addRecordForm' /></form>
            <!-- <a class='navLink'>Archive</a> -->
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
            $selectedGenre = $genresModel->getGenreByID($genreFilterID);
            echo "<p class='mediumCopy'>No $selectedGenre->name records in collection</p>";
        } else {
            echo  displayAllArchivedRecords($allRecords);
        }
        ?>
    </div>
    <!-- record display -->

</body>

</html>