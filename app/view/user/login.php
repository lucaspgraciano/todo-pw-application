<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../public/images/favicon.ico"/>
        <link href="../../../public/css/login_register.css" rel="stylesheet">
        <title>Todo App | Autenticar-se</title>
    </head>
    <body>
        <div class="container">
            <main class="login_form">
                <p class="main-title">Autenticar-se</p>
                <form class="main-login_form" method="POST">
                        <?php require 'app/view/commons/alert.php' ?>
                        <p for="email">E-mail</p>
                        <input type="email" id="email" name="email" placeholder="exemplo@email.com"/>
                        <p for="senhea">Senha</p>
                        <input type="password" id="password" name="senha" placeholder="**">
                        <br>
                        <button type="submit">Entrar</button>
                </form>
                <div class="main-login_register_link">
                    <p>Não tem cadastro? <a href="/register">Cadastre-se</a></p>
                </div>
            </main>
            <img src="../../../public/images/selfie.svg" class="login_bg-svg">
        </div>
    </body>
</html>