<?php

if(!isset($_SESSION))
{
  session_start();
}

if(isset($_SESSION['erro_pgto']) || isset($_SESSION['acesso_invalido'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - ERRO!</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="../web/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="background-error">

    <div class="middle-box text-center animated fadeInDown">
        <h1 class="erro">ERRO!</h1>
        <?php if(isset($_SESSION['erro_pgto'])){ ?>
        <h3 class="font-bold"><?= $_SESSION['erro_pgto'];?></h3>

        <div class="error-desc">
            Verifique se os dados do pagamento estão corretos ou entre em contato com sua operadora de crédito, qualquer problema, chama a gente <a href="../contato.php">clicando aqui!</a><br/>
            <br><a href="../" type="button" class="btn btn-outline btn-danger">Voltar ao Inicio</a>
        </div>
        <?php } else { ?>
        <h3 class="font-bold"><?= $_SESSION['acesso_invalido'];?></h3>

        <div class="error-desc">
            Você deveria estar vendo ela? entre em contato conosco <a href="../contato.php">clicando aqui!</a><br/>
            <br><a href="../" type="button" class="btn btn-outline btn-danger">Voltar ao Inicio</a>
        </div>
    <?php } ?>
    </div>
</div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
unset($_SESSION['erro_pgto']);
 } else {
    header('Location: ../');
} ?>
