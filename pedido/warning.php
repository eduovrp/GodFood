<?php

if(!isset($_SESSION))
{
  session_start();
}

if(isset($_SESSION['aviso_pgto'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Aviso!</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="../web/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="background-warning">

    <div class="middle-box text-center animated fadeInDown">
        <h1 class="aviso">ATENÇÃO!</h1>
        <br>
        <h3 class="font-bold"><?= $_SESSION['aviso_pgto'];?></h3>
        <div class="error-desc">
            Houve problemas com seu pagamento, caso tenha alguma duvida entre em contato conosco <a href="../contato/">clicando aqui!</a><br/>
            <br><a href="../" type="button" class="btn btn-outline btn-warning">Voltar ao Inicio</a>
        </div>
    </div>
</div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
unset($_SESSION['aviso_pgto']);
 } else {
    header('Location: ../');
} ?>
