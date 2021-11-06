<?php

abstract class Controller{
    public function view(string $view, $data = []){
      require 'app/view/' . $view . '.php';
    }
}
