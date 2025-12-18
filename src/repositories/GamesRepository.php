<?php

readonly final class GamesRepository{
    public function __construct(private readonly PDO $pdo){}

    public function findAllSortedByRating() : array{
        $sql = $this->pdo->prepare("SELECT * FROM games ORDER BY rating DESC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll() : array{
        $sql = $this->pdo->prepare("SELECT * FROM games");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}