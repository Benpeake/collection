<?php

namespace Collection;

readonly class Record
{
    public int $id;
    public string $album_name;
    public string $artist_name;
    public int $release_year;
    public int $score;
    public string $img;
    public int $deleted;
    public string $genre_name;
    public int $genre_id;

    public function __construct(
        int $id,
        string $albumName,
        string $artistName,
        int $releaseYear,
        int $score,
        string $img,
        int $deleted,
        string $genreName,
        int $genre_id
    ) {
        $this->id = $id;
        $this->album_name = $albumName;
        $this->artist_name = $artistName;
        $this->release_year = $releaseYear;
        $this->score = $score;
        $this->img = $img;
        $this->deleted = $deleted;
        $this->genre_name = $genreName;
        $this->genre_id = $genre_id;
    }
}
