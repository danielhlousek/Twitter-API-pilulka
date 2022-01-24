<?php

namespace core;

use app\ErrorController;

class Router
{

    private $routing = [];

    public final function addRouting($pattern, $action)
    {
        $this->routing[$pattern] = $action;
    }

    public final function route($method, $path, $params)
    {
        $path = "{$method} " . $this->withEscapedSlashes("/{$path}");

        foreach ($this->routing as $pattern => $handler) {
            $patternParams = $this->patternParams($pattern);

            if (!empty($patternParams)) {
                $pattern = $this->withParams($pattern);
            }

            $pattern = $this->withEscapedSlashes($pattern);
            $pattern = $this->withMethod($pattern);
            if ($this->requestMatches($pattern, $path, $patternParams, $params)) {
                $handler($params);

                return;
            }
        }

        (new ErrorController())->notFound();

        return;
    }

    private function requestMatches($pattern, $path, $patternParams, &$params)
    {
        if (preg_match("/^{$pattern}$/i", $path, $matches)) {
            if ($patternParams) {
                for ($i = 0; $i < sizeof($patternParams); $i++) {
                    $params[$patternParams[$i]] = $matches[$i + 1];
                }
            }
            return true;
        }
        return false;
    }

    private function patternParams($pattern)
    {
        $matches = [];
        if (preg_match_all('/{(\w+)}/', $pattern, $matches)) {
            return $matches[1];
        }
    }

    private function withEscapedSlashes($pattern)
    {
        return str_replace('/', ':', $pattern);
    }

    private function withMethod($pattern)
    {
        return !preg_match("/^[A-Z]+ .+$/i", $pattern) ? "GET {$pattern}" : $pattern;
    }

    private function withParams($pattern)
    {
        return preg_replace('/{\w+}/', '([^:]+)', $pattern);
    }
}