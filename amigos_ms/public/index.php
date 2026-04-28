<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Config/database.php';


require __DIR__ . '/../app/Amigos/Presentation/Repositories/TestRepository.php';
require __DIR__ . '/../app/Amigos/Presentation/Repositories/AmigosRepository.php';
require __DIR__ . '/../app/Amigos/Models/Amigo.php';
require __DIR__ . '/../app/Amigos/Controllers/AmigosController.php';
$endpointsAmigos = require __DIR__ . '/../app/Amigos/Presentation/routers/endpoints.php';

$app = AppFactory::create();

$endpointsAmigos($app);

$app->run();
