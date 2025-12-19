<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . '/../services/games.php';
require_once __DIR__ . '/../helpers/debug.php';

final class AppController {

    public function handleRequest(string $path) : void{

        if (preg_match('#^/games/(\d+)$#', $path, $m)) {
            $this->gameById((int)$m[1]);
            return;
        }

        switch($path){
            case '/':
                $this->home();
                break;
            case '/games':
                $this->games();
                break;
            case '/random':
                $this->getRandom();
                break;
            default:
                $this->notFound();
                break;
        }
    }

    private function render(string $view, array $data = []): void{
        extract($data);
        // Header
        require __DIR__ . '/../../views/partials/header.php';
        require __DIR__ . '/../../views/pages/' . $view . '.php';
        // Footer
        require __DIR__ . '/../../views/partials/footer.php';
    }

    private function home() : void{
        $games = getLimitedGames(3);

        http_response_code(200);

        $this->render('home', [
            'featuredGames' => $games,
            'total' => countAll()
        ]);
    }

    private function games() : void{
        $games = getAllGamesSortedByRating();

        http_response_code(200);

        $this->render('games', [
            'games' => $games
        ]);
    }

    private function gameById(int $id) : void{
        $game = getGameById($id);

        http_response_code(200);

        $this->render('detail', [
            'id' => $id,
            'game' => $game
        ]);
    }

    #[NoReturn]
    private function getRandom(): void{
        $game = getRandomGame();
        $previousGameId = 0;

        if(isset($_COOKIE['gameId'])){
            $previousGameId = $_COOKIE['gameId'];
        }

        while($game['id'] === $previousGameId){
            $game = getRandomGame();
        }

        setcookie('gameId', $game['id'], time() + 3600*24*30, "/");

        header('Location: /games/' . $game['id']);
        die();
    }

    private function notFound() : void{
        http_response_code(404);
        $this->render('not-found');
    }
}
