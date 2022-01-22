<?php

class Controller {
    static function view($view, $data=[]) {
        $viewData = $data;
        if(isset($GLOBALS["user"])) $sessionUser = $GLOBALS["user"];

        // affichage de la vue avec les data
        require_once APP_ROOT . "/resources/views/$view.php";
    }
}