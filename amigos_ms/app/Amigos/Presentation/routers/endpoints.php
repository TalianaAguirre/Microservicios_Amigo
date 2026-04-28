<?php

use Slim\App;
use app\Amigos\Presentation\Repositories\TestRepository;
use App\Amigos\Presentation\Repositories\AmigosRepository;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/test', [TestRepository::class, 'hola']);
    $app->get('/amigos', [AmigosRepository::class, 'all']);
    $app->post('/amigos', [AmigosRepository::class, 'create']);
    $app->get('/amigos/{id}', [AmigosRepository::class, 'detail']);
    $app->put('/amigos/{id}', [AmigosRepository::class, 'update']);
    $app->delete('/amigos/{id}', [AmigosRepository::class, 'delete']);
};
