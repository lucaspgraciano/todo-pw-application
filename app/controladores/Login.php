<?php

require 'app/modelos/Usuarios.php';
require 'Controlador.php';

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
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta!');
        }
    }

    public function cadastrarIndex() {
        $this->view('user/register');
    }

    public function cadastrar() {
        try {
            $user = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
            $user->salvar();
            header('Location: /login?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            header('Location: /register?email=' . $_POST['email'] . '&mensagem=Email já cadastrado!');
        }
    }

    public function home() {
        if (!$this->loggedUser) {
            header('Location: /login?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        $this->view('user/home', $this->loggedUser);
    }

    public function sair() {
        if (!$this->loggedUser) {
            header('Location: /login?mensagem=Você precisa se identificar primeiro');
            return;
        }
        unset($_SESSION['user']);
        header('Location: /login?mensagem=Usuário deslogado com sucesso!');
    }
}