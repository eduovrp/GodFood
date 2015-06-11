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
    verifica_post();

    $current_url = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Funcionarios</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>

</head>

<body>
    <div id="wrapper">
<?php
include 'includes/nav.html';

if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);


$funcionarios = buscaFuncionarios($_SESSION['restaurante']);
$niveis = buscaNiveisUsuarios();

 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Gerenciar Funcionarios</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Gerenciar Funcionarios</strong>
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
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                            <div class="input-group">
                                <div class="col-lg-1">
                                	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#cadastraNovo">Cadastrar Novo</button>
                                </div>
                        	</div>
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th class="nome_f">Nome</th>
                                <th>CPF</th>
                                <th>Usuario</th>
                                <th>Nivel de Acesso</th>
                                <th>Telefone</th>
                                <th>Data do Cadastro</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($funcionarios as $funcionario): ?>
                            <tr>
                                <td class="nome_f"><?=$funcionario['nome'];?></td>
                                <td><?=$funcionario['cpf'];?></td>
                                <td><?=$funcionario['usuario'];?></td>
                                <td><?=$funcionario['nivel'];?></td>
                                <td><?=$funcionario['telefone'];?></td>
                                <td><?=$funcionario['data'];?></td>
                                <td><a href="javascript:alterarDadosFuncionario(<?= $funcionario['id_funcionario']; ?>)"><i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal inmodal fade" id="cadastraNovo" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Cadastrar funcionario <i class="fa fa-user-plus fa fa-1x"></i></h4>
                     <small class="font-bold">Campos com * são obrigatórios</small>
                </div>
                <div class="modal-body">
                   <form action="cadastrar.php" method="POST">
                       <div class="input-group">
                           <div class="row">
                               <div class="col-md-7">
                                   <label for="nome">Nome do Funcionario *</label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                               </div>
                                <div class="col-md-5">
                                   <label for="cpf">CPF *</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-6">
                                   <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" name="telefone" id="telefone">
                               </div>
                                <div class="col-md-6">
                                   <label for="nivel">Nivel *</label>
                                    <select name="nivel" class="form-control">
                                  <?php foreach($niveis as $nivel): ?>
                                      <option value="<?=$nivel['id_nivel']?>"><?=$nivel['sub_nome']?></option>
                                  <?php endforeach; ?>
                                    </select>
                               </div>
                           </div>
                           <br>
                             <div class="row">
                               <div class="col-md-6">
                                   <label for="usuario">Nome de Usuario *</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" required>
                               </div>
                                <div class="col-md-6">
                                   <label for="senha">Senha *</label>
                                    <input type="password" class="form-control" name="senha" id="senha" required>
                               </div>
                           </div>
                        </div>
                    </div>
                  <br>

                <div class="modal-footer">
                    <input type="hidden" name="cadastrarFuncionario" value="cadastrarFuncionario">
                    <button type="button" class="btn btn-default btn-outline" data-dismiss="modal"><i class="fa fa-arrow-left fa-1x"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-outline"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
                    </div>
                    </form>
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
        $('#telefone').mask('(99) - 9999-9999');
      });
    </script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

      <form action="alterarDadosFuncionario.php" method="POST" id="alterarDadosFuncionario">
        <input type="hidden" name="id_funcionario">
      </form>

<script>
     function alterarDadosFuncionario(id_funcionario){
        f = document.getElementById('alterarDadosFuncionario');
        f.id_funcionario.value = id_funcionario;
        f.submit();
    }
</script>
</body>

</html>
<?php
  } else {
    $_SESSION['mensagem'] = "Você precisa escolher um restaurante para gerenciar seus funcionarios";
    header('Location: restaurantes.php');
  }
} else {
    header('Location: login.php');
}
 ?>