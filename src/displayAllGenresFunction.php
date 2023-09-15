<?php

//display genres function
function displayAllGenres(array $genres): string
{
    $htmlOutput = '';

    foreach ($genres as $genre) {
        $htmlOutput .=
            "<option value={$genre['id']}>{$genre['name']}</option>";
    }

    return  $htmlOutput;
}
