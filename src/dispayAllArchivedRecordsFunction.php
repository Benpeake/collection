<?php

function displayAllArchivedRecords(array $records): string
{

    $htmlOutput = '';

    if (empty($records)) {
        $htmlOutput = "<p class='mediumCopy'>No records currently in archive</p>";
    }

    foreach ($records as $record) {
        $htmlOutput .=
            "<div class='archivedContainer'>
                <form method='POST'>
                    <input type='submit' value='Return' name='return' class='returnButton' />
                    <input type='hidden' name='recordID' value='$record->id' />
                </form>     
            <div class='albumContainer archived'>
            <img src='$record->img' alt='$record->album_name' width='300' height='300' >
            <div class='albumStats'>
                <p class='smallCopy'><strong>Album:</strong> $record->album_name</p>
                <p class='smallCopy'><strong>Artist:</strong> $record->artist_name</p>
                <p class='smallCopy'><strong>Year of release:</strong> $record->release_year</p>
                <div class='genre-input'><p class='smallCopy'><strong>Genre:</strong> $record->genre_name</p><div class='dot $record->genre_name'></div></div>
                <p class='smallCopy'><strong>Score:</strong> $record->score/10</p>
                <div class='buttonContainer'>    
                </div>
            </div>
          </div>
        </div>";
    }

    return $htmlOutput;
}
