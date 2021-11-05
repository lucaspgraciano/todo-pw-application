<?php

class Tarefa {
    private $conteudo;
    private $titulo;
    private $email;
    private $estado;

    function __construct(string $conteudo, string $titulo, string $email, string $estado = "Em andamento") {
        $this->conteudo = $conteudo;
        $this->titulo = $titulo;
        $this->email = $email;
        $this->estado = $estado;
    }

    public function __get($campo) {
        return $this->$campo;
    }

    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    public function salvarNovaTarefa() {
        $con = Database::getConnection();
        $stm = $con->prepare('INSERT INTO Tarefas (conteudo, titulo, email, estado) VALUES (:conteudo, :titulo, :email, :estado)');
        $stm->bindValue(':conteudo', $this->conteudo);
        $stm->bindValue(':titulo', $this->titulo);
        $stm->bindValue(':email', $this->email);
        $stm->bindValue(':estado', $this->estado);
        $stm->execute();
    }

    public static function buscarTarefasPorUsuario($email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT conteudo, titulo, email, estado FROM Tarefas WHERE email = :email');
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetchAll();

        if ($resultado) {
            $tarefas = array();
            foreach ($resultado as $item) {
                $tarefa = new Tarefa($item['conteudo'], $item['titulo'], $item['email'], $item['estado']);
                array_push($tarefas, $tarefa);
            }
            return $tarefas;
        } else {
            return NULL;
        }
    }

    public static function buscarTarefaPorTituloUsuario($titulo, $email){
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT conteudo, titulo, email, estado FROM Tarefas WHERE titulo = :titulo AND email = :email');
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetchAll();

        if ($resultado) {
            $tarefas = array();
            foreach ($resultado as $item) {
                $tarefa = new Tarefa($item['conteudo'], $item['titulo'], $item['email'], $item['estado']);
                array_push($tarefas, $tarefa);
            }
            return $tarefas;
        } else {
            return NULL;
        }
    }

    public static function buscarTarefaEspecifica($conteudo, $titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('SELECT conteudo, titulo, email, estado FROM Tarefas WHERE conteudo = :conteudo AND titulo = :titulo AND email = :email');
        $stm->bindValue(':conteudo', $conteudo);
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $resultado = $stm->fetch();

        if ($resultado) {
            $tarefa = new Tarefa($resultado['conteudo'], $resultado['titulo'], $resultado['email'], $resultado['estado']);
            return $tarefa;
        } else {
            return NULL;
        }
    }

    public function apagarTarefaEspecifica($conteudo, $titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('DELETE FROM Tarefas WHERE conteudo = :conteudo AND titulo = :titulo AND email = :email');
        $stm->bindValue(':conteudo', $conteudo);
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
    }

    public static function apagarTarefasPorLista($titulo, $email) {
        $con = Database::getConnection();
        $stm = $con->prepare('DELETE FROM Tarefas WHERE titulo = :titulo AND email = :email');
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->execute();
    }

    public static function atualizarEstadoDaTarefa($conteudo, $titulo, $email, $estado) {
        $con = Database::getConnection();
        $novo_estado = NULL;
        if ($estado == "Em andamento") {
            $novo_estado = "Concluída";
        } else {
            $novo_estado = "Em andamento";
        }
        $stm = $con->prepare('UPDATE Tarefas SET estado = :estado WHERE conteudo = :conteudo AND titulo = :titulo AND email = :email');
        $stm->bindValue(':conteudo', $conteudo);
        $stm->bindValue(':titulo', $titulo);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':estado', $novo_estado);
        $stm->execute();
    }
}