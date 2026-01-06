<?php

namespace Controller;

use JetBrains\PhpStorm\NoReturn;
use Core\Response;
use Core\Session;
use Core\Request;
use Helper\Debug;
use Repository\GamesRepository;

require_once __DIR__ . '/../Helper/debug.php';

final readonly class AppController {

    public function __construct(
        private Response $response,
        private GamesRepository $gamesRepository,
        private Session $session,
        private Request $request,
    ) {}

    public function home() : void{
        $games = $this->gamesRepository->findTop(3);

        $this->response->render('home', [
            'featuredGames' => $games,
            'total' => $this->gamesRepository->countAll()
        ]);
    }

    public function games() : void{
        $games = $this->gamesRepository->findAllSortedByRating();

        $this->response->render('games', [
            'games' => $games
        ]);
    }

    public function gameById(int $id) : void{
        $game = $this->gamesRepository->getGameById($id);

        $this->response->render('detail', [
            'id' => $id,
            'game' => $game,
            'success' => $this->session->pullFlash('success')
        ]);
    }

    #[NoReturn]
    public function random(): void{
        $lastId = $this->session->get('last_random_id');
        $game = null;

        for($i = 0; $i < 5; $i++){
            $candidate = $this->gamesRepository->getRandomGame();

            if($candidate['id'] !== $lastId){
                $game = $candidate;
            }
        }

        $this->session->set('last_random_id', $game['id']);

        $this->response->redirect('/games/' . $game['id']);
    }

    public function notFound() : void{
        $this->response->render('not-found', [], 404);
    }

    public function add() : void{
        if($this->request->isPost()){
            $this->handleAddGame();
            return;
        }

        $this->response->render('add', []);
    }

    public function handleAddGame() : void{
        $title = trim($this->request->post("title"));   // trim sert à enlever les espaces au début et à la fin des inputs
        $platform = trim($this->request->post("platform"));
        $genre = trim($this->request->post("genre"));
        $releaseYear = trim($this->request->post("releaseYear"));
        $rating = trim($this->request->post("rating"));
        $description = trim($this->request->post("description"));
        $notes = trim($this->request->post("notes"));

        $errors = [];

        if($title === '') $errors['title'] = 'Title should not be empty';
        if($platform === '') $errors['platform'] = 'Platform should not be empty';
        if($genre === '') $errors['genre'] = 'Genre should not be empty';
        if($rating < 0 || $rating > 10) $errors['rating'] = 'Rating should be between 0 and 10';
        if($releaseYear < 1960 || $releaseYear > (int)Date('Y')) $errors['releaseYear'] = 'Release year should be between 1960 and 2025';
        if($description === '') $errors['description'] = 'Description should not be empty';
//        if($notes === '') $errors['notes'] = 'Notes should not be empty';

        $old = [
            'title' => $title,
            'platform' => $platform,
            'genre' => $genre,
            'releaseYear' => $releaseYear,
            'rating' => $rating,
            'description' => $description,
            'notes' => $notes
        ];

        if(!empty($errors)){
            $this->response->render('add', ['old' => $old, 'errors' => $errors], 422);
            return;
        }

        $newGameId = $this->gamesRepository->createGame($old);

        $this->session->flash('success', 'Game added successfully');

        $this->response->redirect('/games/' . $newGameId);
    }
}
