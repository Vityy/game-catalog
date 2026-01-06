<?php

namespace Core;

final class Cors
{
    public static function handle() : void {
        $allowedOrigins = 'http://localhost:4200';
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if($origin === $allowedOrigins) {
            // On laisse passer la communication
            header("Access-Control-Allow-Origin: $allowedOrigins");
            // Si on se servait de la session et cookies + log in
            // header("Access-Control-Allow-Credentials: true");
        }

        header("Access-Control-Allow-Header: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }
}