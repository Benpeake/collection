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

        $genres= $query->fetchAll();

        return $genres;
    }

}
