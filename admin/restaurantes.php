<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

if(isset($_POST['return_url'])){

$return_url = base64_decode($_POST["return_url"]);
unset($_SESSION['return_url']);

    } else if(isset($_SESSION['return_url'])){

        $return_url = base64_decode($_SESSION["return_url"]);
        unset($_SESSION['return_url']);

}else{
    $return_url = "index.php";
}

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    require 'functions/functions.php';
        if($_SESSION['id_nivel'] == 5){

verifica_post();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood | Restaurantes</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="css/ladda.min.css">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

<script>
    function busca_categorias(){
      var restaurante = $('#restaurante').val();
      if(restaurante){
        var url = 'ajax_busca_categorias.php?restaurante='+restaurante;
        $.get(url, function(dataReturn) {
          $('#busca_categorias').html(dataReturn);
        });
      }
    }
</script>

</head>

<body class="gray-bg">
<?php
include 'mensagens.php';
$restaurantes = busca_restaurantes();
?>

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><i class="fa fa-unlock-alt fa-2x"></i></h1>

            </div>
            <h3>Selecione o Restaurante desejado para prosseguir</h3>

            <p>Entre, tem ar condicionado.</p>
            <form class="m-t" role="form" action="<?=$return_url;?>" method="POST">
                <div class="form-group">
                    <label for="restaurante">Restaurante</label>
                        <select name="restaurante" class="form-control" id="restaurante"  onchange="busca_categorias()">
                        <option value="0">Todos</option>
                    <?php  foreach ($restaurantes as $restaurante) : ?>
                        <option value="<?= $restaurante['id_restaurante']; ?>"><?= $restaurante['nome_fantasia']; ?></option>}";
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                <div id="busca_categorias">
                    <label>Categoria</label>
                <select class="form-control" name="categoria" id="categoria">
                  <option value="0">Todas</option>
                </select>
                </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Prosseguir <i class="fa fa-arrow-right fa-1x"></i></button>
            </form>
            <a href="index.php">ir para o inicio</a>
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
<?php
    }else{
        header('Location: index.php');
    }
} else{
    header('Location: login.php');
}
 ?>
