<?php

namespace Repository;

use PDO;

readonly final class GamesRepository{
    public function __construct(private readonly PDO $pdo){}

    public function findAllSortedByRating() : array {
        $sql = $this->pdo->query("SELECT * FROM games ORDER BY rating DESC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll() : array {
        $sql = $this->pdo->query("SELECT * FROM games");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findTop(int $limit) : array {
        $sql = $this->pdo->prepare("SELECT * FROM games ORDER BY id LIMIT :limit");
        $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() : int {
        $sql = $this->pdo->query("SELECT COUNT(*) FROM games");
        return $sql->fetchColumn();
    }

    public function getGameById(int $id) : array {
        $sql = $this->pdo->prepare("SELECT * FROM games WHERE id = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getRandomGame() : array {
        $sql = $this->pdo->query("SELECT * FROM games ORDER BY RAND() LIMIT 1");
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function groupByRating() : array {
        $sql = $this->pdo->prepare("SELECT rating, COUNT(rating) AS total FROM games GROUP BY rating ORDER BY rating ASC");
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($data as $row) {
            $result[$row['rating']] = $row['total'];
        }

        return $result;
    }

    public function findRecent(int $limit) : array {
        $sql = $this->pdo->prepare("SELECT * FROM games ORDER BY rating DESC LIMIT :limit");
        $sql->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createGame(array $data) : int{
        $sql = $this->pdo->prepare("INSERT INTO games (title, platform, genre, releaseYear, rating, description, notes) VALUES (:title, :platform, :genre, :releaseYear, :rating, :description, :notes)");
        $sql->execute([
            'title' => $data['title'],
            'platform' => $data['platform'],
            'genre' => $data['genre'],
            'releaseYear' => $data['releaseYear'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'notes' => $data['notes']
        ]);

        return $this->pdo->lastInsertId();
    }
}