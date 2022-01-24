<?php
declare(strict_types = 1);

namespace app;

require_once('./core/Dispatcher.php');
require_once('./core/Router.php');
require_once('./core/DotEnv.php');
require_once('./controllers/ErrorController.php');
require_once('./controllers/PostController.php');
require_once('./controllers/ApiController.php');

require 'vendor/autoload.php';

use core\Dispatcher;
use core\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

(new Dispatcher())
    ->routing('/twitter/posts', function () {
        (new PostController())->list();
    })
    ->routing('/', function () {
        (new PostController())->list();
    })
    ->routing('/twitter/posts/{postCount}', function ($params) {
        (new PostController())->list($params);
    })
    ->routing('/api/posts', function () {
        (new ApiController())->list();
    })
    ->routing('/api/posts/{postCount}', function ($params) {
        (new ApiController())->list($params);
    })
    ->dispatch();

