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

    //select all records
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

    // soft delete record by ID
    public function removeRecord(int $id): bool
    {
        $query = $this->db->prepare("UPDATE `records` SET `deleted` = 1 WHERE `id` = :idNum LIMIT 1");

        $query->bindParam('idNum', $id);

        $query->execute();

        if (!$id) {
            return false;
        }

        return true;
    }

    //updat a record by ID
    public function updateRecord(
        string $albumName,
        string $artistName,
        int $releaseYear,
        int $genreID,
        int $score,
        string $img,
        int $id,
    ) {
        $query = $this->db->prepare(
            "UPDATE `records` 
            SET `album_name` = :albumName, 
                `artist_name` = :artistName, 
                `release_year` = :releaseYear, 
                `genre_id` = :genreID, 
                `score` = :score, 
                `img` = :img
            WHERE `id` = :idNum"
        );

        $query->bindParam('albumName', $albumName);
        $query->bindParam('artistName', $artistName);
        $query->bindParam('releaseYear', $releaseYear);
        $query->bindParam('genreID', $genreID);
        $query->bindParam('score', $score);
        $query->bindParam('img', $img);
        $query->bindParam('idNum', $id);

        $query->execute();
    }

    //get record by ID
    public function getRecord(int $id): Record|false
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
            WHERE `records`.`id` = :idNum 
        "
        );

        $query->bindParam('idNum', $id);

        $query->execute();

        $recordData = $query->fetch();

        if (!$id) {
            return false;
        }

        $record = new Record(
            $recordData['id'],
            $recordData['album_name'],
            $recordData['artist_name'],
            $recordData['release_year'],
            $recordData['score'],
            $recordData['img'],
            $recordData['deleted'],
            $recordData['genre_name']
        );

        return $record;
    }
}
