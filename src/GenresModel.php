<?php

namespace Collection;

use PDO;

class GenresModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //select all genres
    public function getAllGenres(): array

    {
        $query = $this->db->prepare("SELECT `id`, `name` FROM `genre`");

        $query->execute();

        $genres = $query->fetchAll();

        return $genres;
    }

    //get genre by genreID
    public function getGenreByID(int $id)
    {

        if (!$id) {
            return false;
        }

        $query = $this->db->prepare("SELECT `id`, `name` FROM `genre` WHERE `genre`.`id` = :genreID");

        $query->bindParam('genreID', $id);

        $query->execute();

        $genreData = $query->fetch();

        $genre = new Genre(
            $genreData['id'],
            $genreData['name'],
        );

        return $genre;
    }
}
