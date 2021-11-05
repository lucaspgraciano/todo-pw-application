<?php

class Lista {
    private $titulo;
    private $email;

    function __construct(string $titulo, string $email) {
        $this->titulo = $titulo;
        $this->email = $email;
    }

    public function __get($campo) {
        return $this->$campo;
    }

    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    public function salvarNovaLista() {
        $con = Database::getConnection();
        $stm = $con->prepare('INSERT INTO Listas (titulo, email) VALUES (:titulo, :email)');
        $stm->bindValue(':titulo', $this->titulo);
        $stm->bindValue(':email', $this->email);
        $stm->execute();
    }

    public static function buscarListaPorUsuario($email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT titulo, email FROM Listas WHERE email = :email');
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetchAll();

        if ($resultado) {
            $listas = array();
            foreach ($resultado as $item) {
                $lista = new Lista($item['titulo'], $item['email']);
                array_push($listas, $lista);
            }
            return $listas;
        } else {
            return NULL;
        }
    }

    public static function buscarListaEspecifica($titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT titulo, email FROM Listas WHERE titulo = :titulo AND email = :email');
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetch();

        if ($resultado) {
            $lista = new Lista($resultado['titulo'], $resultado['email']);
            return $lista;
        } else {
            return NULL;
        }
    }

    public function apagarLista($titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('DELETE FROM Listas WHERE titulo = :titulo AND email = :email');
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
    }
}