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

    $current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;

    if(isset($_SESSION['restaurante'])){
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Funcionarios</title>
    <link rel="icon" type="image/png" href="../web/images/plate.png" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="css/ladda.min.css">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>

</head>

<body>
<?php if(isset($_SESSION['restaurante'])){
$restaurante_ativo = mostra_restaurante_ativo($_SESSION['restaurante']);
} else {
    $restaurante_ativo = null;
}
$nivelUsuario = verificaNivelUsuario($_SESSION['id_nivel']);
?>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                    <img src="css/logo-branca.png" height="163" width="190" alt="GodFoo">
                    </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li>
                    <a href="timeline.php"><i class="fa fa-cutlery"></i> <span class="nav-label">Pedidos</span> </span>
                <?php
                    if(isset($_SESSION['restaurante'])){
                        $count = verificaQtdPedidosNav($_SESSION['restaurante']); ?>
                    <span class="label label-success pull-right"><?=$count['pedidos'];?></span>
                <?php } ?>
                </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plus"></i> <span class="nav-label">Gerenciar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="categorias.php">Categorias</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="adicionais.php">Adicionais</a></li>
                        <li><a href="bordas.php">Bordas Recheadas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="relatorioVendas.php">Vendas</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Administrar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="gerenciaRestaurantes.php">Restaurante</a></li>
                        <li><a href="gerenciaFuncionarios.php">Funcionarios</a></li>
                    </ul>
                </li>
                <li>
                   <a href="cidade_entrega.php"><i class="fa fa-truck"></i> <span class="nav-label">Entregas</span></a>
                </li>
                <?php if($_SESSION['id_nivel'] == 5){ ?>
                <li>
                    <a href="pesquisa-pedidos.php"><i class="fa fa-search"></i> <span class="nav-label">Pesquisar Pedido </span></a>
                </li>
                <li>
                    <a href="cadastrar_cidade.php"><i class="fa fa-globe"></i> <span class="nav-label">Cadastrar Cidade</span></a>
                </li>
                <li>
                    <a href="restaurantes.php"><i class="fa fa-building-o"></i> <span class="nav-label">Alterar Restaurante</span></a>
                </li>
                <?php } ?>
                <li>
                    <a href="login.php?logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Sair</span></a>
                </li>
            </ul>
        </div>
    </nav>
    
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="welcome-message">
                            <span class="m-r-sm text-muted welcome-message">Seja bem-vindo, <?=$_SESSION['nome']?></span>
                        </li>
                        <li class="logout">
                            <a href="login.php?logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div> 
    
<?php

$funcionarios = buscaFuncionarios($_SESSION['restaurante']);
$niveis = buscaNiveisUsuarios();

 ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Gerenciar Funcionarios</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li>
                            Administrar
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
                    <?php if($_SESSION['id_nivel'] >= 3){ ?>
                            <div class="input-group">
                                <div class="col-lg-1">
                                	<button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#cadastraNovo">Cadastrar Novo</button>
                                </div>
                        	</div>
                    <?php } ?>
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
<?php if($_SESSION['id_nivel'] >= 3){ ?>
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
                    <button type="submit" class="ladda-button btn btn-primary btn-outline" data-size="s" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Cadastrar</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
<?php } ?>
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

        <script src="js/plugins/ladda/spin.js"></script>
    <script src="js/plugins/ladda/ladda.js"></script>

    <!-- Scripts JS -->

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

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