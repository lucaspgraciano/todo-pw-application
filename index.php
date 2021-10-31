<?php

error_reporting(E_ALL ^ E_WARNING);

include 'app/Database.php';
include 'libs/Route.php';

Database::createSchema();

use Steampixel\Route;

include_once 'app/controladores/Login.php';

$controller = new LoginController();


Route::add('/login', fn () => $controller->loginIndex(), ['get']);
Route::add('/register', fn () =>$controller->cadastrarIndex(), ['get']);
Route::add('/user/home', fn () => $controller->home(), ['get']);

Route::add('/login', fn ()  => $controller->login(), ['post']);
Route::add('/register', fn ()  => $controller->cadastrar(), ['post']);
Route::add('/logout', fn () => $controller->sair(), ['post']);

Route::add('/.*', function () {
    http_response_code(404);
    echo "Page not found!";
}, ['get']);

Route::run('/');