<?php

class Database {
    static $con;

    static public function getConnection() {
        if (isset(self::$con)) return self::$con;

        self::$con = new PDO('sqlite:progweb-todo.sqlite');
        self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$con;
    }

    static public function createSchema(){
        $con = self::getConnection();
        $con->exec('
            CREATE TABLE IF NOT EXISTS Usuarios (
                nome TEXT NOT NULL,
                email TEXT PRIMARY KEY NOT NULL,
                senha TEXT NOT NULL
                )
        ');
    }
}