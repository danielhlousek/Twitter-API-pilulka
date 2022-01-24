<?php
namespace core;

class Dispatcher {

    /**
     * @var \core\Router
     */
    private $router;

    function __construct() {
        $this->router = new Router();
    }

    public final function dispatch() {
        $this->router->route(
            $_SERVER['REQUEST_METHOD'],
            $this->pathFromUri($_SERVER['REQUEST_URI']),
            $_REQUEST);
    }

    public final function routing($pattern, $action) {
        $this->router->addRouting($pattern, $action);
        return $this;
    }

    /**
     * @param $path
     * @return string
     */
    private function pathFromUri($path): string {
        $path = !empty($path) && $path[strlen($path) - 1] == '/' ? substr($path, 0, strlen($path) - 1) : $path;
        if (empty($path)) {
            return '';
        }
        $queryPos = strpos($path, '?');
        if ($queryPos !== FALSE) {
            $path = substr($path, 0, $queryPos);
        }

        return $path[0] === '/' ? substr($path, 1) : $path;
    }
}
