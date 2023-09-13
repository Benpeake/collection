<?php

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
