<?php

require 'app/modelos/Usuarios.php';
require 'Controlador.php';
require 'app/modelos/Listas.php';
require 'app/modelos/Tarefas.php';

class LoginController extends Controller {
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

    public function login() {
        $usuario = Usuario::buscarUsuario($_POST['email']);

        if ($usuario && $usuario->igual($_POST['email'], $_POST['senha'])) {
            $_SESSION['user'] = $this->loggedUser = $usuario;
            header('Location: /user/home');
        } else {
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta');
        }
    }

    public function cadastrarIndex() {
        $this->view('user/register');
    }

    public function cadastrar() {
        try {
            $user = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
            $user->salvar();
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso');
        } catch (Throwable $th) {
            header('Location: /register?email=' . $_POST['email'] . '&mensagem=Email já cadastrado');
        }
    }

    public function home() {
        if (!$this->loggedUser) {
            header('Location: /login?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        $data = array();
        $listas = Lista::buscarListaPorUsuario($this->loggedUser->email);
        $tarefas = Tarefa::buscarTarefasPorUsuario($this->loggedUser->email);
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

    public function sair() {
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
        } else if (Lista::buscarListaEspecifica($_POST['titulo'], $this->loggedUser->email)) {
            header('Location: /user/home?mensagem=Lista "'. $_POST['titulo'] .'" já existe');
        } else {
            $lista = new Lista($_POST['titulo'], $this->loggedUser->email);
            $lista->salvarNovaLista();
            header('Location: /user/home');
        }
    }

    public function removerLista() {
        $lista = Lista::buscarListaEspecifica($_POST['titulo'], $this->loggedUser->email);
        try {
            $lista->apagarLista($_POST['titulo'], $this->loggedUser->email);
            Tarefa::apagarTarefasPorLista($_POST['titulo'], $this->loggedUser->email);
            header('Location: /user/home?mensagem=Lista deletada com sucesso');
        } catch (PDOException $erro) {
            header('Location: /user/home?mensagem=Erro ao deletar a lista "'. $_POST['titulo'] . '"');
        }
    }

    public function criarTarefa() {
        if (!$this->loggedUser) {
            header('Location: /login?mensagem=Você precisa se identificar primeiro');
        } else if (Tarefa::buscarTarefaEspecifica($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email)) {
            header('Location: /user/home?mensagem=A tarefa "' . $_POST['conteudo'] . '" já está cadastrada na lista "' . $_POST['titulo'] . '"');
        } else {
            $tarefa = new Tarefa($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email);
            $tarefa->salvarNovaTarefa();
            header('Location: /user/home');
        }
    }

    public function removerTarefa() {
        $tarefa = Tarefa::buscarTarefaEspecifica($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email);
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
            Tarefa::atualizarEstadoDaTarefa($_POST['conteudo'], $_POST['titulo'], $this->loggedUser->email, $_POST['estado']);
            header('Location: /user/home?mensagem=Tarefa atualizada com sucesso');
        } catch (PDOException $error) {
            header('Location: /user/home?mensagem=Erro ao atualizar a tarefa "'. $_POST['conteudo'] . '"');
        }
    }
}