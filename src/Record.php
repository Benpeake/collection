<?php

readonly class Record
{
    public int $id;
    public string $album_name;
    public string $artist_name;
    public int $genre_id;
    public int $release_year;
    public int $score;
    public string $img;
    public int $deleted;

    public function __construct(
        int $id,
        string $albumName,
        string $artistName,
        int $genreID,
        int $releaseYear,
        int $score,
        string $img,
        int $deleted
    ){
        $this->id = $id;
        $this->album_name = $albumName;
        $this->artist_name = $artistName;
        $this->genre_id = $genreID;
        $this->release_year = $releaseYear;
        $this->score = $score;
        $this->img = $img;
        $this->deleted = $deleted;
    }


}
