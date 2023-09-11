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
function displayAllRecords(array $records):string
{
    $htmlDisplay = '';

    foreach ($records as $record) {
        $htmlDisplay .= "<div class='albumContainer'>
            <img src='$record->img' alt='$record->album_name' width='300' height='300' >
            <div class='albumStats'>
                <p class='smallCopy'><strong>Album:</strong> $record->album_name</p>
                <p class='smallCopy'><strong>Artist:</strong> $record->artist_name</p>
                <p class='smallCopy'><strong>Year of release:</strong> $record->release_year</p>
                <p class='smallCopy'><strong>Genre:</strong> $record->genre_name</p>
                <p class='smallCopy'><strong>Score:</strong> $record->score/10</p>
            </div>
        </div>";
    }

    return $htmlDisplay;
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
    <!-- font install -->
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
            <!-- <a class='navLink'>+ Record</a>
            <a class='navLink'>Archive</a> -->
        </div>
    </div>
    <!-- nav-bar -->

    <!-- record display -->
    <div class='flexConatiner'>
        <?php
        echo displayAllRecords($allRecords)
        ?>
    </div>
    <!-- record display -->
    
</body>

</html>