<?php

spl_autoload_register(function($class){
    // Noitre traitement - Namespace -> chemin fichier.
    $baseDir = __DIR__ . '/src/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    // Vérifier sir le fichier existe. Si oui, on le require.
    if(file_exists($file)){
        require $file;
    }
});