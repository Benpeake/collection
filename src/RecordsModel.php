<?php

namespace Collection;

use PDO;

class RecordsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //select all record
    public function getAllRecords(): array

    {
        $query = $this->db->prepare(
            "SELECT
            `records`.`id`,
            `records`.`album_name`,
            `records`.`artist_name`,
            `records`.`release_year`,
            `records`.`score`,
            `records`.`img`,
            `records`.`deleted`,
            `genre`.`name` AS `genre_name`
            FROM `records`
            INNER JOIN `genre`
            ON `records`.`genre_id` = `genre`.`id`
            WHERE `records`.`deleted` = 0 
        "
        );

        $query->execute();

        $recordsData = $query->fetchAll();

        $allRecords = [];

        foreach ($recordsData as $recordData) {

            $allRecords[] = new Record(
                $recordData['id'],
                $recordData['album_name'],
                $recordData['artist_name'],
                $recordData['release_year'],
                $recordData['score'],
                $recordData['img'],
                $recordData['deleted'],
                $recordData['genre_name'],
            );
        }

        return $allRecords;
    }

    // Add record
    public function addRecord(
        string $albumName,
        string $artistName,
        int $releaseYear,
        int $genreID,
        int $score,
        string $img,
    ) {
        $query = $this->db->prepare(
            "INSERT INTO `records`
        (`album_name`,`artist_name`, `release_year`, `genre_id`, `score`, `img`)
        VALUES (:albumName, :artistName, :releaseYear, :genreID, :score, :img);
        "
        );

        $query->bindParam('albumName', $albumName);
        $query->bindParam('artistName', $artistName);
        $query->bindParam('releaseYear', $releaseYear);
        $query->bindParam('genreID', $genreID);
        $query->bindParam('score', $score);
        $query->bindParam('img', $img);

        $query->execute();
    }

}
