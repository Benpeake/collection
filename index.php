<?php
session_start();

use Collection\GenresModel;
use Collection\RecordsModel;

require_once 'vendor/autoload.php';

//connect and format db
$db = new PDO('mysql:host=db; dbname=collection', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//create record model
$recordModel = new RecordsModel($db);
$genresModel = new GenresModel($db);

// get all products
$allRecords = $recordModel->getAllRecords();

// get all genres
$genres = $genresModel->getAllGenres();

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

//display genres function
function displayAllGenres(array $genres):string
{
    $htmlOutput = '';

    foreach ($genres as $genre){
        $htmlOutput .=
        "<option value={$genre['id']}>{$genre['name']}</option>";
    }

    return  $htmlOutput;
}


// Handle add-record input
$newAlbumName = $_POST['newAlbumName'] ?? false;
$newArtistName = $_POST['newArtistName'] ?? false;
$newReleaseYear = $_POST['newReleaseYear'] ?? false;
$newGenre = $_POST['newGenre'] ?? false;
$newScore = $_POST['newScore'] ?? false;
$newImg = $_POST['newImg'] ?? false;

//Generate for submit function 
function generateFormSubmitErrors(
    $newAlbumName,
    $newArtistName,
    $newReleaseYear,
    $newGenre,
    $newScore,
    $newImg
):array
{
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
        if (empty($newImg) || !preg_match('/\bhttps?:\/\/\S+\.(jpg)\b/i', $newImg)) {
            $errors['img'] = 'Image link is required';
        }

        return $errors;
}

//on new record submit...
if (isset($_POST['newRecord'])) {
//generate errros function 
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
        unset($_SESSION['formSuccess']);
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

<body id='addRecord'>
    <!-- nav-bar -->
    <div class='navBar'>
        <div class='leftNav'>
            <a class='navLink'>MyRecords</a>
        </div>
        <div class='rightNav'>
            <a class='navLink' href='#addRecord'>+ Record</a>
            <!-- <a class='navLink'>Archive</a> -->
        </div>
    </div>
    <!-- nav-bar -->

    <!-- add record form -->
    <div class='formContainerInfo'>
        <p class='whiteCopy'>Add record to collection</p>
        <p class='successCopy'><?php if(isset($_SESSION['formSuccess'])){echo $_SESSION['formSuccess'];}?></p>
        <!-- <p><a class='whiteCopy'>X</a></p> -->
    </div>
    <div class='formContainer'>
        <form class='newRecordForm' method='POST'>
            <div class='inputField'>
                <label for='newAlbumName'>Album name:</label>
                <div>
                <input type='text' value="<?php if($newAlbumName) echo $newAlbumName; ?>" name='newAlbumName' id='newAlbumName' />
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
                    <input type='text' value="<?php if($newArtistName) echo $newArtistName; ?>" name='newArtistName' id='newArtistName' />
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
                    <input type='number' value="<?php if($newReleaseYear) echo $newReleaseYear; ?>" name='newReleaseYear' id='newReleaseYear' min="1000" max="2023"/>
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
                    <input type='number' value="<?php if($newScore) echo $newScore; ?>" name='newScore' id='newScore' min='1' max='10'/>
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
                    <input type='text' value="<?php if($newImg) echo $newImg; ?>" name='newImg' id='newImg' />
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
                    <input class='button' type='submit' value='Add record' name='newRecord' />
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