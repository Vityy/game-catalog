<?php

namespace Core;

use PDO;

final class Database {
    public static function makePdo(array $configDb) : PDO {
//        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

        $dsnSprintF = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $configDb['host'],
            $configDb['port'],
            $configDb['db'],
            $configDb['charset']
        );

        return new PDO($dsnSprintF, $configDb['user'], $configDb['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
    }
}
