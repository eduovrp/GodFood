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

    if($_SESSION['id_nivel'] != 5){
      $disabled = 'disabled="disabled"';
    } else {
      $disabled = "";
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GodFood - Restaurantes</title>

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
$restaurantes = gerenciaDadosRestaurante($_SESSION['restaurante']);
} else {
    $restaurante_ativo = null;
    $restaurantes = mostraRestaurantesCadastrados();
}



 ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h1>Gerenciar Restaurantes</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Gerenciar Restaurantes</strong>
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
                                	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#cadastraNovo" <?=$disabled?>>Cadastrar Novo</button>
                                </div>
                        	</div>
                        </form>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th class="nome_f">Nome</th>
                                <th>Tipo</th>
                                <th>Tempo Entrega</th>
                                <th>Status</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Horario</th>
                                <th>Compra Minima</th>
                                <th>Fav</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($restaurantes as $restaurante): ?>
                            <tr>
                                <td class="nome_f"><?=$restaurante['nome_fantasia'];?></td>
                                <td><?=$restaurante['tipo'];?></td>
                                <td><?=$restaurante['tempo_entrega'];?></td>

                                <?php $status = verificaStatus($restaurante['id_restaurante']);
                                    if($status['status'] == 'Fechado'){ ?>

                                <td><a type="submit" href="javascript:abrirRestaurante(<?=$restaurante['id_restaurante']; ?>)">Fechado</a></td>
                                <?php } else{ ?>
                                <td><a type="submit" href="javascript:fecharRestaurante(<?=$restaurante['id_restaurante']; ?>)">Aberto</a></td>
                                <?php } ?>

                                <td><?=$restaurante['fone'];?></td>
                                <td><?=$restaurante['cidade'];?></td>
                                <td><?=substr($restaurante['hora_abert'],0,-3).' até '.substr($restaurante['hora_fech'],0,-3)?></td>
                                <td><?='R$ '.number_format($restaurante['compra_minima'],2,",",".")?></td>
                                <?php if($restaurante['fav'] > 0){ ?>
                                <td><i class="fa fa-star"></i></td>
                                <?php } else{ ?>
                                <td><i class="fa fa-star-o"></i></td>
                                <?php } ?>
                                <td><a href="javascript:alterarDadosRestaurante(<?= $restaurante['id_restaurante']; ?>)"><i class="fa fa-pencil-square-o fa-1x"></i> Editar</a></td>
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
                    <h4 class="modal-title">Cadastrar Restaurante <i class="fa fa-building-o fa fa-1x"></i></h4>
                     <small class="font-bold">Todos os campos são obrigatórios</small>
                </div>
                <div class="modal-body">
                   <form action="cadastrar.php" method="POST">
                       <div class="input-group">
                           <div class="row">
                               <div class="col-md-8">
                                   <label for="razao">Razao Social *</label>
                                    <input type="text" class="form-control" name="razao" id="razao" required>
                               </div>
                                <div class="col-md-4">
                                   <label for="tipo">Tipo *</label>
                                    <input type="text" class="form-control" name="tipo" id="tipo" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-6">
                                   <label for="cnpj">CNPJ *</label>
                                    <input type="text" class="form-control" name="cnpj" id="cnpj" required>
                               </div>
                                <div class="col-md-6">
                                   <label for="fone">Fone *</label>
                                    <input type="text" class="form-control" name="fone" id="fone" required>
                               </div>
                           </div>
                           <br>
                             <div class="row">
                               <div class="col-md-8">
                                   <label for="nome_fantasia">Nome de Fantasia *</label>
                                    <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" required>
                               </div>
                                <div class="col-md-4">
                                   <label for="tempo_entrega">Tempo de Entrega *</label>
                                    <input type="text" class="form-control" name="tempo_entrega" id="tempo_entrega" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-10">
                                   <label for="logradouro">Logradouro *</label>
                                    <input type="text" class="form-control" name="logradouro" id="logradouro" required>
                               </div>
                                <div class="col-md-2">
                                   <label for="numero">Numero *</label>
                                    <input type="text" class="form-control" name="numero" id="numero" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-5">
                                   <label for="bairro">Bairro *</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" required>
                               </div>
                                <div class="col-md-7">
                                   <label for="cidade">Cidade *</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade" required>
                               </div>
                           </div>
                           <br>
                           <div class="row">
                               <div class="col-md-4">
                                   <label for="hora_abert">Hora Aberto *</label>
                                    <input type="text" class="form-control" name="hora_abert" id="hora_abert" required>
                               </div>
                                <div class="col-md-4">
                                   <label for="hora_fech">Hora Fechar *</label>
                                    <input type="text" class="form-control" name="hora_fech" id="hora_fech" required>
                               </div>
                               <div class="col-md-4">
                                   <label for="compra_min">Compra Minima *</label>
                                    <input type="text" class="form-control" name="compra_min" id="compra_min" required>
                                    <script type="text/javascript">$("#compra_min").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
                               </div>
                           </div>
                       </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="cadastrarRestaurante" value="cadastrarRestaurante">
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
        $('#cnpj').mask('99.999.999/9999-99');
        $('#fone').mask('(99) - 9999-9999');
        $('#hora_abert').mask('00:00');
        $('#hora_fech').mask('00:00');
      });
    </script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

      <form action="alterarDadosRestaurante.php" method="POST" id="alterarDadosRestaurante">
        <input type="hidden" name="id_restaurante">
      </form>

      <form action="updates.php" method="POST" id="abrirRestaurante">
        <input type="hidden" name="id_restaurante">
        <input type="hidden" name="abrirRestaurante" value="sim">
    </form>

    <form action="updates.php" method="POST" id="fecharRestaurante">
        <input type="hidden" name="id_restaurante">
        <input type="hidden" name="fecharRestaurante" value="sim">
    </form>
<script>
     function alterarDadosRestaurante(id_restaurante){
        f = document.getElementById('alterarDadosRestaurante');
        f.id_restaurante.value = id_restaurante;
        f.submit();
    }
     function abrirRestaurante(id_restaurante){
        f = document.getElementById('abrirRestaurante');
        f.id_restaurante.value = id_restaurante;
        f.submit();
    }
    function fecharRestaurante(id_restaurante){
        f = document.getElementById('fecharRestaurante');
        f.id_restaurante.value = id_restaurante;
        f.submit();
    }
</script>
</body>

</html>
<?php
} else {
    header('Location: login.php');
}
 ?>