<?php

function getAllGames() : array{
    // 1. Path jusqu'aux jeux.
    $path = __DIR__ . '/../../data/games.json';

    // 2. Lire le fichier.
    $json = file_get_contents($path);

    // 3. Décoder le JSON pour récupérer un tableau de jeux.
    if($json === false){
        return [];
    }
    else{
        $data = json_decode($json, true);
    }

    // 4. Retourner les jeux.
    return is_array($data) ? $data : [];
}