<?php
error_reporting(E_ALL ^ E_WARNING);

include 'app/model/Database.php';
include 'app/libs/Route.php';
include_once 'app/controller/Main.php';

Database::createSchema();

use Steampixel\Route;

$controller = new MainController();

Route::add('/', fn () => $controller->loginIndex(), ['GET']);
Route::add('/login', fn () => $controller->loginIndex(), ['GET']);
Route::add('/register', fn () => $controller->cadastrarIndex(), ['GET']);
Route::add('/user/home', fn () => $controller->homeIndex(), ['GET']);
Route::add('/user/public', fn () => $controller->publicIndex(), ['GET']);
Route::add('/user/search', fn () => $controller->searchIndex(), ['GET']);

Route::add('/login', fn ()  => $controller->logarUsuario(), ['POST']);
Route::add('/register', fn ()  => $controller->cadastrarNovoUsuario(), ['POST']);
Route::add('/logout', fn () => $controller->deslogarUsuario(), ['POST']);
Route::add('/user/home/new_list', fn () => $controller->criarLista(), ['POST']);
Route::add('/user/home/remove_list', fn () => $controller->removerLista(), ['POST']);
Route::add('/user/home/update_task_visibility', fn () => $controller->atualizarLista(), ['POST']);
Route::add('/user/home/add_task', fn () => $controller->criarTarefa(), ['POST']);
Route::add('/user/home/remove_task', fn () => $controller->removerTarefa(), ['POST']);
Route::add('/user/home/update_task', fn () => $controller->atualizarTarefa(), ['POST']);
Route::add('/user/home/search', fn () => $controller->busca(), ['POST']);

Route::add('/*', function () {
    http_response_code(404);
    echo "Page not found!";
}, ['get']);

Route::run('/');