<?php

class Listas {
    private $titulo;
    private $email;
    private $visibilidade;

    function __construct(string $titulo, string $email, int $visibilidade = 0) {
        $this->titulo = $titulo;
        $this->email = $email;
        $this->visibilidade = $visibilidade;
    }

    public function __get($campo) {
        return $this->$campo;
    }

    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    public function salvarNovaLista() {
        $con = Database::getConnection();
        $stm = $con->prepare('INSERT INTO Listas (titulo, email, visibilidade) VALUES (:titulo, :email, :visibilidade)');
        $stm->bindValue(':titulo', $this->titulo);
        $stm->bindValue(':email', $this->email);
        $stm->bindValue(':visibilidade', $this->visibilidade);
        $stm->execute();
    }

    public static function buscarListaPorUsuario($email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT titulo, email, visibilidade FROM Listas WHERE email = :email');
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetchAll();

        if ($resultado) {
            $listas = array();
            foreach ($resultado as $item) {
                $lista = new Listas($item['titulo'], $item['email'], $item['visibilidade']);
                array_push($listas, $lista);
            }
            return $listas;
        } else {
            return NULL;
        }
    }

    public static function buscarListaEspecifica($titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT titulo, email, visibilidade FROM Listas WHERE titulo = :titulo AND email = :email');
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetch();

        if ($resultado) {
            $lista = new Listas($resultado['titulo'], $resultado['email'], $resultado['visibilidade']);
            return $lista;
        } else {
            return NULL;
        }
    }

    public static function buscarListaPublica() {
        $visibilidade_publica = 1;
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT titulo, email, visibilidade FROM Listas WHERE visibilidade = :visibilidade');
        $stm->bindValue(':visibilidade', $visibilidade_publica);
        $stm->execute();
        $resultado = $stm->fetchAll();

        if ($resultado) {
            $listas = array();
            foreach ($resultado as $item) {
                $lista = new Listas($item['titulo'], $item['email'], $item['visibilidade']);
                array_push($listas, $lista);
            }
            return $listas;
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

    public static function atualizarVisibilidade($titulo, $email, $visibilidade) {
        $con = Database::getConnection();
        $nova_visibilidade = NULL;
        if ($visibilidade == 0) {
            $nova_visibilidade = 1;
        } else {
            $nova_visibilidade = 0;
        }
        $stm = $con->prepare('UPDATE Listas SET visibilidade = :visibilidade WHERE titulo = :titulo AND  email = :email');
        $stm->bindValue(':visibilidade', $nova_visibilidade);
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
    }   
}