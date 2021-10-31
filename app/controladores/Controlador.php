<?php

abstract class Controller {
    public function view(string $view, $data = []) {
        require 'app/visoes' . $view . '.php';
    }
}