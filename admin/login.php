<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

unset($_SESSION['return_url']);

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    header('Location: ./');
}
 ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood | Login</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="css/ladda.min.css">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
        <?php include 'mensagens.php'; ?>

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><i class="fa fa-lock fa-2x"></i></h1>

            </div>
            <h3>Bem vindo a area de admin do GodFood - Delivery</h3>
            <p>Se você possui um usuario e senha, insira nos campos a baixo para entrar. Caso você tenha problemas para logar, por favor entre em contato conosco o mais rapido possivel <br>
            <a href="#">clicando aqui </a>
            </p>
            <p>Entre, tem ar condicionado.</p>
            <form class="m-t" role="form" action="./restaurantes" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" name="login" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                </div>
                <button type="submit" class="ladda-button btn btn-primary block full-width m-b" data-size="s" data-style="zoom-in">Login <i class="fa fa-sign-in fa-1x"></i></button>
            </form>
            <p class="m-t"> <small>GodFood - Adminstração &copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/plugins/ladda/spin.js"></script>
    <script src="js/plugins/ladda/ladda.js"></script>

    <!-- Scripts JS -->

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

</body>

</html>
