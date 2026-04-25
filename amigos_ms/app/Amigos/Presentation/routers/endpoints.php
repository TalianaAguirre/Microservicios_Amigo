<?php

use Slim\App;
use app\Amigos\Presentation\Repositories\TestRepository;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/test', [TestRepository::class, 'hola']);
    $app->post('/crearamigos', [AmigosRepository::class, 'create']);
};
