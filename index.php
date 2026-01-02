<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = dirname($_SERVER['SCRIPT_NAME']);

$route = str_replace($basePath, '', $uri);
$route = trim($route, '/');

$controllerPath = __DIR__ . '/app/Controllers/';

if ($route === '' || $route === 'index.php' || $route === 'musics') {
    require_once $controllerPath . 'MusicsController.php';
} 
elseif ($route === 'login') {
    require_once $controllerPath . 'LoginController.php';
} 
elseif ($route === 'register') {
    require_once $controllerPath . 'RegisterController.php';
} 
elseif ($route === 'library') {
    require_once $controllerPath . 'LibraryController.php';
} 
elseif ($route === 'account') {
    require_once $controllerPath . 'AccountController.php';
} 
elseif ($route === 'ajouter') {
    require_once $controllerPath . 'AddMusicController.php';
} 
elseif ($route === 'logout') {
    require_once $controllerPath . 'LogoutController.php';
} 
elseif (preg_match('/^musics\/(\d+)$/', $route, $matches)) {
    $_GET['id'] = $matches[1];
    require_once $controllerPath . 'FicheController.php';
}