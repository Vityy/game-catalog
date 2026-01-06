<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

final class Response {
    public function render(string $view, array $data = [], int $status = 200): void {
        http_response_code($status);
        extract($data);
        require __DIR__ . '/../../views/partials/header.php';
        require __DIR__ . '/../../views/pages/' . $view . '.php';
        require __DIR__ . '/../../views/partials/footer.php';
    }

    #[NoReturn]
    public function redirect(string $to, int $status = 302) : void {
        header('Location:' . $to, true, $status);
        exit;
    }

    public function json(mixed $data, int $status = 200) : void {
        // Définir le code HTTP de la réponse
        http_response_code($status);
        // Spécifier que ce sera au format JSON
        header('Content-Type: application/json; charset=utf-8');
        // Convertir des données en json
//        json_encode($data, JSON_UNESCAPED_SLASHES);
        echo json_encode($data);
    }
}