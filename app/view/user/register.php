<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../../public/css/login_register.css" rel="stylesheet">
        <title>REGISTRO</title>
    </head>
    <body>
        <div class="container">
            <main class="login_form">
                <p class="main-title">Cadastrar-se</p>
                <form class="main-login_form" method="POST">
                        <?php require 'app/view/commons/alert.php' ?>
                        <p for="name">Primeiro Nome</p>
                        <input type="text" id="name" name="nome" placeholder="exemplo" required>
                        <p for="email">E-mail</p>
                        <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                        <p for="senha">Senha</p>
                        <input type="password" id="password" name="senha" placeholder="********" required>
                        <br>
                        <button type="submit">Entrar</button>
                </form>
                <div class="main-login_register_link">
                    <p>Já possui conta? <a href="/login">Acesse agora</a></p>
                </div>
            </main>
        </div>
    </body>
</html>
