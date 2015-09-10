<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Delivery</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
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
<link href="../web/css/pace.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
include 'mensagens.php';
require '../functions/registro.php';

?>

	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="main">
	   <div class="container">
		  <div class="register">
		  	<?php if(isset($_GET['email']) && isset($_GET['verification_code'])){
		  		$_SESSION['email'] = $_GET['email'];
		  		$_SESSION['verification_code'] = $_GET['verification_code'];
		  		?>

			<form action="reset_senha.php" id="form_cadastrar" method="POST">
				 <div class="register-top-grid">
				 	<h3>Recuperação de Senha</h3>
				 	<br>
				 	<div class="row">
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="senha">INSIRA SUA NOVA SENHA *</label>
						 <input type="password" name="senha" id="senha" required>
						 <label for="confirma_senha">CONFIRME SUA NOVA SENHA *</label>
						 <input type="password" name="confirma_senha" id="confirma_senha" required>
					   	 <button type="submit" tabindex="10" class="ladda-button btn btn-cadastrar" data-size="m" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Alterar Senha</button>
					   </div>
					   </div>
				   </form>
			<?php } else { ?>
			<div class="wow fadeInRight" data-wow-delay="0.4s">
		  	  <form action="reset_senha.php" id="form_cadastrar" method="POST">
				 <div class="register-top-grid">
				 	<h3>Você receberá um email para confirmação, clique no link recebido para recuperar sua senha.</h3>
				 	<br>
				 	<div class="row">
					 <div class="col-md-6">
						<label for="email">INSIRA SEU EMAIL *</label>
						<input type="text" name="email" id="email" required>
						<br><br>
						<a href="../minhaconta/" class="btn btn-default btn-lg" title="voltar">Voltar</a>
						<button type="submit" tabindex="10" class="ladda-button btn btn-cadastrar" data-size="m" data-style="zoom-in"><i class="fa fa-envelope fa-1x"></i> Enviar</button>
					</div>
					</div>
				   </form>
			<?php } ?>
				</div>
		   </div>
	     </div>
	    </div>

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

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../web/js/jquery.min.js"></script>
	<script type="text/javascript" src="../web/js/easing.js"></script>
	<script src="../web/js/bootstrap.min.js"></script>
	<script src="../web/js/pace.min.js"></script>

	<script src="../pedido/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="../pedido/inspinia/js/plugins/ladda/ladda.js"></script>

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 15000 } );
</script>
</body>
</html>