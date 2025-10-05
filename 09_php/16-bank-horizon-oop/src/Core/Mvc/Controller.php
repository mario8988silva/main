<?php namespace Core\Mvc;

use Core\Http\Response;

abstract class Controller {

    protected function redirect(string $url) {
        Response::redirect($url);
    }

    protected function render(string $view, array $params = [], bool $layout = true) {
        Response::render($view, $params, $layout);
    }
}