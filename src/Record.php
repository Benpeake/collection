<?php

readonly class Record
{
    public int $id;
    public string $albumName;
    public string $artistName;
    public int $genreID;
    public int $releaseYear;
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
        $this->albumName = $albumName;
        $this->artistName = $artistName;
        $this->genreID = $genreID;
        $this->releaseYear = $releaseYear;
        $this->score = $score;
        $this->img = $img;
        $this->deleted = $deleted;
    }


}
