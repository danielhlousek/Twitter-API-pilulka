<?php
declare(strict_types = 1);

namespace app;

require_once 'core/Controller.php';

use core\Controller;

class ErrorController extends Controller {

    function notFound() {
        http_response_code(404);
        $this->render('notFound');
    }
}
