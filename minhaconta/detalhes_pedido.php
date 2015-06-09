<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

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
<script src="../web/js/jquery-2.1.1.js"></script>
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
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
<script type="text/javascript" src="../web/js/easing.js"></script>
 <script src="../web/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
 ?>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="container">
		<div class="login-page">

                <div class="clearfix"></div>
                <br>
	<?php
include 'mensagens.php';

require '../functions/pedidos.php';

$itens = lista_itens_pedido($_POST['id']);

$detalhes = detalhes_pedido($_POST['id']);

$endereco_entrega = select_endereco_entrega_detalhes($_POST['id']);
?>

<div class="wow fadeInLeft" data-wow-delay="0.4s">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
	   <table class="table table-bordered table-hover">
	    <thead>
	      <tr>
	        <th><h3>Restaurante</h3></th>
	        <th><h3>Status do Pedido</h3></th>
	        <th><h3>Endereço de Entrega</h3></th>

	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td><?=$detalhes['nome'];?></td>
	        <td><h4><?=$detalhes['status'];?></h4></td>
	        <td>
	        <?php
	        echo $endereco_entrega['endereco'];
	        ?>
	        </td>
	      </tr>
	    </tbody>
	  </table>
      </div>
<br>
<br>
  <div class="panel panel-default">
	   <table class="table table-hover">
	    <thead>
	      <tr>
	        <td><h3>Nome do Produto</h3></td>
	        <td align="center"><h3>Quantidade</h3></td>
	        <td align="center"><h3>Adicional</h3></td>
	        <td align="center"><h3>Borda Recheada</h3></td>
	        <td align="center"><h3>Valor Unitario</h3></td>
	        <td align="center"><h3>Subtotal</h3></td>
	      </tr>
	    </thead>
	    <tbody>
	     <?php
	     $total = 0;
		foreach($itens as $item): ?>
	      <tr>
	        <td><?=$item['nome']." (".$item['categoria'].")";?></td>
	        <td align="center"><?=$item['qtd'];?></td>
	        <td align="center"><?=$item['adicional'];?></td>
	        <td align="center"><?=$item['borda'];?></td>
	        <td align="center"><?=number_format($item['valor'],2,",",".");?></td>
	        <td align="center"><?=number_format($item['subtotal'],2,",",".");?></td>
	        <?php $total = $total + $item['subtotal']; ?>
	      </tr>
	    <?php endforeach;
		 ?>
	    </tbody>
	  </table>
      </div>
    </div>
        <div align="right">
    	<h4>Total dos Produtos: <?=number_format($total,2,",",".");?></h4>
    	<br>
    	<h3>Total do Pedido: <?=number_format($detalhes['total_pago'],2,",",".");?></h3>
    	<span>(Valor referente total dos produtos + taxa de entrega + taxa de serviço)</span>
    </div>
    <h3><a href="pedidos.php" type="button" class="btn btn-danger btn-lg btn-outline">Voltar</a></h3>
  </div>
 </div>
</div>
<div class="clearfix"></div>
		<div class="contact-section" id="contact">
			<div class="container">
				<div class="contact-section-grids">
					<div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
						<h4>A Empresa</h4>
						<ul>
							<li>
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-long-arrow-right fa-inverse"></i>
									</span>Sobre
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
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-long-arrow-right fa-inverse"></i>
									</span>Termos de Uso
								</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="#">
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
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-facebook fa-inverse"></i>
									</span>Facebook
								</a>
							</li>
						</ul>
							<ul>
							<li>
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-instagram fa-inverse"></i>
									</span>Instagram
								</a>
							</li>
						</ul>
							<ul>
							<li>
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-twitter fa-inverse"></i>
									</span>Twitter
								</a>
							</li>
						</ul>
							<ul>
							<li>
								<a href="#">
									<span class="fa-stack fa-lg">
						 			<i class="fa fa-youtube fa-inverse"></i>
									</span>Youtube
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3 contact-section-grid nth-grid wow fadeInRight" data-wow-delay="0.4s">
						<h4>Inscreva-se na nossa Newsletter</h4>
						<p>E receba todas as Novidades no seu E-mail</p>
						<form action="subscribe.php" method="POST" accept-charset="utf-8" onsubmit="return sucesso()">
						<input type="text" class="text" value="" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
						<input type="submit" value="Cadastrar">
						</form>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<div class="footer">
		<div class="container">
			<p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; 2014  All rights  Reserved | Template by &nbsp;<a href="http://w3layouts.com" target="target_blank">W3Layouts</a></p>
		</div>
	</div>
</body>
</html>

<?php
} else {
    header('Location: index.php');
}
?>