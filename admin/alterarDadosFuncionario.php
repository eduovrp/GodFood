<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
    require 'functions/functions.php';
    if(isset($_POST['id_funcionario'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Alterar Dados</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>

</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';
$_SESSION['id_funcionario'] = $_POST['id_funcionario'];
if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);

} else {
    $restaurante_ativo = null;
}

$funcionario = mostraDadosFuncionario($_POST['id_funcionario']);
$niveis = buscaNiveisUsuarios();
 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Alterar Dados</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Alterar Dados</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                          <div class="col-md-5">
                          <h2 align="center"><?=$restaurante_ativo['nome_fantasia'];?></h2>
					      </div>
	                </div>
                </div>
            </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php include 'mensagens.php'; ?>
               <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <form action="updates.php" method="POST">
                      <h2>Alteração de cadastro</h2>
                    </div>
                    <div class="ibox-content">
                       <div class="input-group">
                           <div class="row">
                               <div class="col-md-7">
                                   <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="<?=$funcionario['nome']?>" required>
                               </div>
                                <div class="col-md-5">
                                   <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" value="<?=$funcionario['cpf']?>" disabled="disabled">
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-6">
                                   <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" name="telefone" value="<?=$funcionario['telefone']?>" id="telefone">
                               </div>
                                <div class="col-md-6">
                                   <label for="nivel">Nivel</label>
                                    <select name="nivel" class="form-control">
                                  <?php foreach($niveis as $nivel): 
                                    if($nivel['id_nivel'] == $funcionario['id_nivel']){ 
                                    $selected = "selected"; } else { $selected = ""; } ?>
                                      <option value="<?=$nivel['id_nivel']?>" <?=$selected?>><?=$nivel['sub_nome']?></option>
                                  <?php endforeach; ?>
                                    </select>
                               </div>
                           </div>
                           <br>
                             <div class="row">
                               <div class="col-md-6">
                                   <label for="usuario">Nome de Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?=$funcionario['usuario']?>" disabled="disabled">
                               </div>
                                <div class="col-md-6">
                                   <label for="senha">Senha</label>
                                    <input type="password" class="form-control" name="senha" id="senha" placeholder="******">
                               </div>
                           </div>
                  <br>
                          <br>
                        <div align="right">
                          <input type="hidden" name="alterarDadosFuncionario" value="alterar">
                            <a href="gerenciaFuncionarios.php" type="button" class="btn btn-danger btn-lg btn-outline"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
                            &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary btn-lg btn-outline"><i class="fa fa-check fa-1x"></i> Atualizar</button>
                          </form>
                          </div>
                       </div>

                        </div>
                    </div>
                </div>
              </div>
     </div>
            <div class="footer">
                <div>
                    <strong>Copyright &copy;</strong> - GodFood - Delivery  2015
                </div>
            </div>

        </div>
 </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!--Mascaras -->
    <script type="text/JavaScript" src="js/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cpf').mask('999.999.999-99');
        $('#telefone').mask('(99) - 99999-9999');

      });
    </script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

</body>

</html>
<?php
  } else {
      header('Location: gerenciaFuncionarios.php');
  }
} else {
    header('Location: login.php');
}
 ?>

