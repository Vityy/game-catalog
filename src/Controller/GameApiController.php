<?php

namespace Controller;

use Core\Request;
use Core\Response;
use Repository\GamesRepository;

class GameApiController
{
    public function getTop(Request $request, GamesRepository $gamesRepository, Response $response) : void {
        $response->json($gamesRepository->findTop(3));
    }

    public function getMostRecent(Request $request, GamesRepository $gamesRepository, Response $response) : void {
        $response->json($gamesRepository->findRecent(3));
    }

    public function groupAllWithRating(Request $request, GamesRepository $gamesRepository, Response $response) : void {
        $response->json($gamesRepository->groupByRating());
    }
}