<?php

class Database {
    static $con;

    static public function getConnection() {
        if (isset(self::$con)) return self::$con;

        self::$con = new PDO('sqlite:todo-app.sqlite');
        self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$con;
    }

    static public function createSchema(){
        $con = self::getConnection();
        $con->exec(file_get_contents(__DIR__ . '/schema/usuarios.sql'));
        $con->exec(file_get_contents(__DIR__ . '/schema/listas.sql'));
        $con->exec(file_get_contents(__DIR__ . '/schema/tarefas.sql'));
    }
}