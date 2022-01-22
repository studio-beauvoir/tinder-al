<?php

class Controller {
    static function view($view, $data=[]) {
        $viewData = $data;
        $sessionUser = $GLOBALS["user"];

        // affichage de la vue avec les data
        require_once APP_ROOT . "/views/$view.php";
    }
}