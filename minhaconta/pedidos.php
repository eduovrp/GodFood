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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Delivery</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="../web/js/wow.min.js"></script>
<link href="../web/css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>

<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">
<link href="../web/css/pace.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
require '../functions/pedidos.php';

$current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$_SESSION['return_url'] = $current_url;

$pedidos_l5 = lista_pedidos_limit5($_SESSION['id_usuario']);

$todos_pedidos = lista_todos_pedidos($_SESSION['id_usuario']);
?>

<div class="wow fadeInLeft" data-wow-delay="0.4s">
	<div class="container">
		<br><br>
  		<div class="menu-minha-conta">
				<div class="row">
				<ul>
					<h3>PEDIDOS</h3>
					<li><a href="../minhaconta/">Ultimo pedido</a></li>
					<li><a href="pedidos">Ver todos</a></li>

					<h3>ENDEREÇOS</h3>
					<li><a href="cadastrar-endereco">Cadastrar novo endereço</a></li>
					<li><a href="#">Meus endereços</a></li>

					<h3>MEU CADASTRO</h3>
					<li><a href="alterarDadosCadastrais">Alterar dados cadastrais</a></li>
				</ul>
				</div>
		</div>

<div class="minha-conta-content">

<div class="wow fadeInLeft" data-wow-delay="0.4s">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
          Ultimos 5 Pedidos
      </h4>
    </div>
    </a>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
	      <table class="table table-hover">
	    <thead>
	      <tr>
	        <th>Pedido</th>
	        <th>Data</th>
	        <th>Status</th>
	        <th>Valor Total</th>
	        <th>Detalhes</th>
	      </tr>
	    </thead>
	    <tbody>
	     <?php
		foreach($pedidos_l5 as $pedido): ?>
	      <tr>
	        <td><?=$pedido['num_pedido'];?></td>
	        <td><?=$pedido['data'];?></td>
	        <td><?=$pedido['status_reduzido']?></td>
	        <td><?= number_format($pedido['valor_total'],2,",",".");?></td>
			<td><a href="javascript:enviarId(<?= $pedido['num_pedido']; ?>)" class="list-group-item">Ver Detalhes</a></td>
	      </tr>
	    <?php endforeach;
		 ?>
	    </tbody>
	  </table>
      </div>
    </div>
  </div>
 </div>
  <div class="panel panel-default">
   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
          Todos os Pedidos
      </h4>
    </div>
    </a>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
	<table class="table table-bordered table-hover">
	    <thead>
	      <tr>
	        <th>Pedido</th>
	        <th>Data</th>
	        <th>Status</th>
	        <th>Valor Total</th>
	        <th>Detalhes</th>
	      </tr>
	    </thead>
	    <tbody>
	     <?php
		foreach($todos_pedidos as $tpedido): ?>
	      <tr>
	        <td><?=$tpedido['num_pedido'];?></td>
	        <td><?=$tpedido['data'];?></td>
	        <td><?=$tpedido['status_reduzido']?></td>
	        <td><?= number_format($tpedido['valor_total'],2,",",".");?></td>
			<td><a href="javascript:enviarId(<?= $tpedido['num_pedido']; ?>)" type="submit">Ver Detalhes</a></td>
	      </tr>
	    <?php endforeach;
		 ?>
	    </tbody>
	  </table>
      </div>
    </div>
  </div>
</div>
      </div>
	</div>
  </div>
  <br><br>
<div class="clearfix"></div>
		<!--Contatos e Footer Section-->
        <div class="contact-section" id="contact">
            <div class="container">
                <div class="contact-section-grids">
                    <div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
                        <h4>A Empresa</h4>
                        <ul>
                            <li>
                                <a href="https://www.godfood.com.br/contato">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Contato
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Politica de Privacidade
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="https://www.godfood.com.br/termos-de-uso">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Termos de Uso
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#Order">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Entenda como funciona
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
                        <h4>Nossos Parceiros</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 1
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 2
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 3
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-long-arrow-right fa-inverse"></i>
                                    </span>Empresa 4
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 contact-section-grid wow fadeInRight" data-wow-delay="0.4s">
                        <h4>Siga-me os bons</h4>
                        <ul>
                            <li>
                                <a href="https://facebook.com/godfooddelivery" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-facebook fa-inverse"></i>
                                    </span>Facebook
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://instagram.com/god.food" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-instagram fa-inverse"></i>
                                    </span>Instagram
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://plus.google.com/u/0/109781837218722392654/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-google-plus fa-inverse"></i>
                                    </span>Google +
                                </a>
                            </li>
                        </ul>
                            <ul>
                            <li>
                                <a href="https://twitter.com/GodFoodDelivery" target="_blank">
                                    <span class="fa-stack fa-lg">
                                    <i class="fa fa-twitter fa-inverse"></i>
                                    </span>Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
					<div class="col-md-3 contact-section-grid nth-grid wow fadeInRight" data-wow-delay="0.4s">
						<h4>Inscreva-se na nossa Newsletter</h4>
						<p>E receba todas as Novidades no seu E-mail</p>
						<form action="../subscribe.php" method="POST" accept-charset="utf-8" onsubmit="return sucesso()">
						<input type="text" class="text" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
						<input type="submit" value="Cadastrar">
						</form>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<script src="../web/js/jquery.min.js"></script>
	<script src="../web/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../web/js/easing.js"></script>
	<script src="../web/js/pace.min.js"></script>

	<form action="detalhes/pedido" method="POST" id="formEnviarId">
		<input type="hidden" name="id_pedido">
	</form>

<script>
	function enviarId(id_pedido){
		f = document.getElementById('formEnviarId');
		f.id_pedido.value = id_pedido;
		f.submit();
	}
</script>
</body>
</html>
<?php
} else {
    header('Location: index.php');
}
?>