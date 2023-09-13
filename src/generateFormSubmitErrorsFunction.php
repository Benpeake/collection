<?php

//Generate form submit errors function 
function generateFormSubmitErrors(
    ?string $newAlbumName,
    ?string $newArtistName,
    ?string $newReleaseYear,
    ?string $newGenre,
    ?string $newScore,
    ?string $newImg
): array {
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
        $errors['score'] = 'Number between 1 and 10';
    }
    if (empty($newImg) || !preg_match('/\bhttps?:\/\/\S+\.(jpg)\b/i', $newImg)) {
        $errors['img'] = 'Image link is required';
    }

    return $errors;
}
