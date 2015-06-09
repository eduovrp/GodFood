<?php

if(!isset($_SESSION))
{
  session_start();
}

if(isset($_SESSION['sucesso_pgto'])){
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Sucesso!</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="background-sucesso">

    <div class="middle-box text-center animated fadeInDown">
        <h1>SUCESSO!</h1>
        <h3 class="font-bold"><?= $_SESSION['sucesso_pgto'];?></h3>

        <div class="error-desc">
            Você pode acompanhar seu pedido acessando sua conta no painel do usuario, ou clicando <a href="../minhaconta/pedidos.php">aqui!</a><br/>
            <br><a href="../" type="button" class="btn btn-outline btn-primary">Voltar ao Inicio</a>
        </div>
    </div>
</div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php
unset($_SESSION['sucesso_pgto']);
 } else {
    header('Location: ../');
} ?>

