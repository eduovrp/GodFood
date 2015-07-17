<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>GodFood - Contato</title>
<link rel="icon" type="image/png" href="web/images/plate.png" />
<meta charset="UTF-8">
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="../pedido/inspinia/css/ladda.min.css">
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
<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../web/css/pace.css">
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
<div class="menu-bar">
			<div class="container">
				<div class="top-menu">
					<ul>
						<li class="active"><a href="../">Inicio</a></li>|
						<li><a href="../termos-de-uso">Termos de Uso</a></li>|
						<li><a href="../minhaconta/pedidos">Pedidos</a></li>|
						<li><a href="./">Contato</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>

<?php
require_once '../minhaconta/classes/Login.php';

$login = new Login();

if ($login->usuarioLogado() == true) {
?>
				<div class="login-section">
					<ul>
						<li><a href="#">Bem-vindo, <?=$_SESSION['login']?></a></li>
						<li><a href="../minhaconta/">Minha Conta</a></li> |
						<?php

						if(isset($_SESSION['products'])){
						$total = 0;

					    foreach ($_SESSION["products"] as $cart_itm)
					    {
					        $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
					        $subtotal = ($valorTotalProduto*$cart_itm["qtd"]);
					        $total = ($total + $subtotal);
					    }
						 ?>
						<li><a href="../pedido/produtos">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
						if($_SESSION['compra_minima'] > $total){
        					$_SESSION['taxa_servico'] = 0;}

							$total = $total + $_SESSION['taxa_servico'] + $_SESSION['taxa'];

						 echo count($_SESSION['products']).' Item  ';

						 echo '[ R$ '. number_format($total,2,",",".").' ]';

						 } else { ?>

						 <li><a href="#" class="popover-bottom" data-toggle="popover"
						 data-content="Seu carrinho está vazio, por favor insira seu cep para escolher seus produtos.">
							<i class="fa fa-shopping-cart"></i>
						
						<?php
							echo 'Carrinho Vazio';
							} ?>

						</a></li> |
						<li><a href="../minhaconta/?logout">Sair</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

<?php } else { ?>

				<div class="login-section">
					<ul>
						<li><a href="../minhaconta/">Login</a>  </li> |
						<li><a href="../minhaconta/cadastrar">Registre-se</a> </li> |
						
						<?php
						if(isset($_SESSION['products'])){
						$total = 0;
						
					    foreach ($_SESSION["products"] as $cart_itm)
					    {
					        $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
					        $subtotal = ($valorTotalProduto*$cart_itm["qtd"]);
					        $total = ($total + $subtotal);
					    }
						 ?>
						<li><a href="../pedido/produtos">
						<i class="fa fa-shopping-cart"></i>
						
						<?php
						if($_SESSION['compra_minima'] > $total){
        					$_SESSION['taxa_servico'] = 0;}

							$total = $total + $_SESSION['taxa_servico'] + $_SESSION['taxa'];

						 echo count($_SESSION['products']).' Item  ';

						 echo '[ R$ '. number_format($total,2,",",".").' ]';

						 } else { ?>
						
						 <li><a href="#" class="popover-bottom" data-toggle="popover"
						 data-content="Seu carrinho está vazio, por favor insira seu cep para escolher seus produtos.">
						 <i class="fa fa-shopping-cart"></i>

						<?php
							echo 'Carrinho Vazio';
							} ?>
						</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
<?php } ?>
	<!-- header-section-ends -->
	<div class="contact-section-page">
		<div class="contact-head">
		    <div class="container">
				<h3>Contato</h3>
				<p>Home/Contato</p>
			</div>
		</div>
		<div class="contact_top">
			 		<div class="container">
			 			<div class="col-md-6 contact_left wow fadeInRight" data-wow-delay="0.4s">
			 				<h4>Formulario de Contato</h4>
			 				<p>Tem alguma duvida, critica ou sugestão? conta pra gente, se for critica a gente ignora.</p>
							  <form action="envia.php" method="POST">
								 <div class="form_details">
					                 <input type="text" class="text" name="nome" placeholder="Nome" required>
									 <input type="text" class="text" name="email" placeholder="Email" required>
									 <input type="text" class="text" name="assunto" placeholder="Assunto" required>
									 <textarea value="Mensagem" name="mensagem" placeholder="Mensagem" required></textarea>
									 <div class="clearfix"> </div>
									 <div class="sub-button wow swing animated" data-wow-delay= "0.1s">
									 	<button name="submit" type="submit" class="ladda-button btn-msg" data-size="m" data-style="zoom-in"><i class="fa fa-envelope-o fa-1x"></i> Enviar Mensagem</button>
									 </div>
						          </div>
						       </form>
					        </div>
					        <div class="col-md-6 company-right wow fadeInLeft" data-wow-delay="0.4s">
					        	<div class="contact-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14976.843472545801!2d-50.92566143974611!3d-20.208556698653304!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1425991880786"> </iframe>
		</div>

	  <div class="company-right">
					        	<div class="company_ad">
							     		<h3>contato</h3>
				      						<address>
											 <p><strong>email: </strong> <a href="mail-to: suporte@godfood.com.br">suporte@godfood.com.br</a></p>
											 <p><strong>Telefone: </strong> +55 17 - 997640291</p>
									   		<p>Santa Fé do Sul - SP</p>

							   			</address>
							   		</div>
									</div>
									<div class="follow-us">
										<h3>Siga-me os bons</h3>
										<br>
										<a href="#">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-facebook fa-stack-2x"></i>
											</span>
										</a>
										<a href="#">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-instagram fa-stack-2x"></i>
											</span>
										</a>
										<a href="#">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-twitter fa-stack-2x"></i>
											</span>
										</a>
									</div>


							 </div>
						</div>
					</div>

	</div>
	<!-- footer-section-starts -->
	<div class="footer">
		<div class="container">
			<p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; 2014  All rights  Reserved | Template by &nbsp;<a href="http://w3layouts.com" target="target_blank">W3Layouts</a></p>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../web/js/jquery.min.js"></script>
<script type="text/javascript" src="../web/js/easing.js"></script>
<script src="../web/js/bootstrap.min.js"></script>
<script src="../web/js/pace.min.js"></script>

    <script src="../pedido/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="../pedido/inspinia/js/plugins/ladda/ladda.js"></script>

    <script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>


</body>
</html>