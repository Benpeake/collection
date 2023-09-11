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
        $query = $this->db->prepare("SELECT * FROM `records` WHERE `deleted` = 0");

        $query->execute();

        $recordsData = $query->fetchAll();

        $allRecords = [];

        foreach ($recordsData as $recordData) {

            $allRecords[] = new Record(
                $recordData['id'],
                $recordData['album_name'],
                $recordData['artist_name'],
                $recordData['genre_id'],
                $recordData['release_year'],
                $recordData['score'],
                $recordData['img'],
                $recordData['deleted']
            );
        }

        return $allRecords;
    }

    //Get genre by ID
    public function getGenreByID(int $genreID)
    {
        $query = $this->db->prepare(
            "SELECT `genre`.`name`
            FROM `records`
            INNER JOIN `genre`
            ON `records`.`genre_id` = `genre`.`id`
            WHERE `records`.`deleted` = 0 AND `genre`.`id`= :genreID
        "
        );

        $query->bindParam('genreID', $genreID);

        $query->execute();

        $genre = $query->fetch();

        if (!$genreID) {
            return false;
        }

        return $genre;
    }
}
