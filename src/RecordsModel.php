<?php

class RecordsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;  
    }

    //select all record
    public function getAllRecords()
    {
        $query = $this->db->prepare("SELECT * FROM `records` WHERE `deleted` = 0");

        $query->execute();

        $recordData = $query->fetchAll();

        $allRecords = [];

        foreach($recordData as $record){

            $allRecords[] = new Record(
                $record['id'],
                $record['album_name'],
                $record['artist_name'],
                $record['genre_id'],
                $record['release_year'],
                $record['score'],
                $record['img'],
                $record['deleted']
            );
        }

        return $allRecords;
    }

}
?>