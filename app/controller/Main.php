<?php

require 'app/model/Usuarios.php';
require 'Controller.php';
require 'app/model/Listas.php';
require 'app/model/Tarefas.php';

class MainController extends Controller {
    private $loggedUser;

    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) $this->loggedUser = $_SESSION['user'];
    }

    public function loginIndex() {
        if (!$this->loggedUser) {
            $this->view('user/login');
        } else {
            header('Location: /user/home');
        }
    }

    public function cadastrarIndex() {
        $this->view('user/register');
    }

    public function homeIndex() {
        if (!$this->loggedUser) {
            header('Location: /login?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        $data = array();
        $listas = Listas::buscarListaPorUsuario($this->loggedUser->email);
        $tarefas = Tarefas::buscarTarefasPorUsuario($this->loggedUser->email);
        if (is_null($listas) && is_null($tarefas)) {
            array_push($data, $this->loggedUser);
        } else if (!is_null($listas) && is_null($tarefas)) {
            $listas = array_reverse($listas);
            array_push($data,$this->loggedUser, $listas);
        } else {
            $listas = array_reverse($listas);
            array_push($data,$this->loggedUser, $listas, $tarefas);
        }
        $this->view('user/home', $data);
    }

    public function logarUsuario() {
        $usuario = Usuarios::buscarUsuario($_POST['email']);
        if (is_null($usuario)) {
            header('Location: /login?mensagem=Usuário não cadastrado');
        } elseif ($usuario && $usuario->autenticarEmailSenha($_POST['email'], $_POST['senha'])) {
            $_SESSION['user'] = $this->loggedUser = $usuario;
            header('Location: /user/home');
        } else {
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta');
        }
    }

    public function cadastrarNovoUsuario() {
        try {
            $user = new Usuarios($_POST['email'], $_POST['senha'], $_POST['nome']);
            $user->salvarNovoUsuario();
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso');
        } catch (Throwable $th) {
            header('Location: /register?email=' . $_POST['email'] . '&mensagem=Email já cadastrado');
        }
    }

    public function deslogarUsuario() {
        if (!$this->loggedUser) {
            header('Location: /login?mensagem=Você precisa se identificar primeiro');
            return;
        }
        unset($_SESSION['user']);
        header('Location: /login?mensagem=Usuário deslogado com sucesso');
    }

    public function criarLista() {
        if (!$this->loggedUser) {
            header('Location: /login?mensagem=Você precisa se identificar primeiro');
            return;
        } else if (empty($_POST['titulo'])) {
            header('Location: /user/home?mensagem=Título da lista deve ser preenchdio');
        } else if (Listas::buscarListaEspecifica($_POST['titulo'], $this->loggedUser->email)) {
            header('Location: /user/home?mensagem=Lista "'. $_POST['titulo'] .'" já existe');
        } else {
            $lista = new Listas($_POST['titulo'], $this->loggedUser->email);
            $lista->salvarNovaLista();
            header('Location: /user/home');
        }
    }

    public function removerLista() {
        $lista = Listas::buscarListaEspecifica($_POST['titulo'], $this->loggedUser->email);
        try {
            $lista->apagarLista($_POST['titulo'], $this->loggedUser->email);
            Tarefas::apagarTarefasPorLista($_POST['titulo'], $this->loggedUser->email);
            header('Location: /user/home?mensagem=Lista deletada com sucesso');
        } catch (PDOException $erro) {
            header('Location: /user/home?mensagem=Erro ao deletar a lista "'. $_POST['titulo'] . '"');
        }
    }

    public function criarTarefa() {
        if (!$this->loggedUser) {
            header('Location: /login?mensagem=Você precisa se identificar primeiro');
        } else if (Tarefas::buscarTarefaEspecifica($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email)) {
            header('Location: /user/home?mensagem=A tarefa "' . $_POST['conteudo'] . '" já está cadastrada na lista "' . $_POST['titulo'] . '"');
        } else {
            $tarefa = new Tarefas($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email);
            $tarefa->salvarNovaTarefa();
            header('Location: /user/home');
        }
    }

    public function removerTarefa() {
        $tarefa = Tarefas::buscarTarefaEspecifica($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email);
        try {
            $tarefa->apagarTarefaEspecifica($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email);
            header('Location: /user/home?mensagem=Tarefa deletada com sucesso');
        } catch (PDOException $error) {
            header('Location: /user/home?mensagem=Erro ao deletar a tarefa "' . $_POST['conteudo'] . '"');
        }
    }

    public function atualizarTarefa() {
        var_dump($_POST);
        try {
            Tarefas::atualizarEstadoDaTarefa($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email, $_POST['estado']);
            header('Location: /user/home?mensagem=Tarefa atualizada com sucesso');
        } catch (PDOException $error) {
            header('Location: /user/home?mensagem=Erro ao atualizar a tarefa "'. $_POST['conteudo'] . '"');
        }
    }
}