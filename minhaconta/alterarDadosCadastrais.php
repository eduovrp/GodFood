<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Delivery</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
<link href="../web/css/bootstrap.min.css" rel='stylesheet' type='text/css' />

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
<link href="../web/css/pace.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
include 'mensagens.php';
require '../functions/registro.php';

	$current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION['return_url'] = $current_url;

if($_GET){
	$dados = buscaDadosCadastraisGET($_GET['cod'],$_GET['hash']);
	$_SESSION['cod_usuario'] = $_GET['cod'];

} else {
	$dados = buscaDadosCadastrais($_SESSION['id_usuario'],$_SESSION['login']);
	$_SESSION['cod_usuario'] = $dados['id_usuario'];

}


?>

	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="main">
	   <div class="container">
		  <div class="register">
		  	  <form action="update.php" id="form_cadastrar" method="POST">
				 <div class="register-top-grid">
					<h3>INFORMAÇÕES PESSOAIS</h3>
					<div class="col-md-6">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<label for="nome">NOME COMPLETO *</label>
						<input type="text" name="nome" value="<?=$dados['nome']?>" required>
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<label for="CPF">CPF</label>
						<input type="text" name="cpf" id="cpf" maxlength="14" value="<?=$dados['cpf']?>" required disabled>
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						 <label for="email">EMAIL</label>
						 <input type="text" name="email" value="<?=$dados['email']?>" required disabled>
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="login">USUARIO</label>
						 <input type="text" name="login" id="login" value="<?=$dados['login']?>" required disabled >
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
					 	 <label for="celular">CELULAR *</label> - digite apenas numeros.
						 <input type="text" name="celular" id="celular" value="<?=$dados['celular']?>" required>
					 </div>
					 </div>
					 <div class="col-md-6">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="telefone">TELEFONE </label> - digite apenas numeros.
						 <input type="text" name="telefone" id="telefone" value="<?=$dados['telefone']?>">
					 </div>
					 </div>
					 <br>
					 	<h3>ALTERAR SENHA</h3>
					 	<p class="text-muted margin"><strong>Atenção:</strong> Você pode alterar seus dados sem alterar sua senha, assim como pode alterar sua senha sem alterar seus dados cadastrais. <br>
					 	<strong>obs: </strong>A senha precisa ter 6 ou mais caracteres.</p>
					 	<br>
				<div class="col-md-6">
					<div class="wow fadeInRight" data-wow-delay="0.4s">
					<label for="senha"> NOVA SENHA</label>
					<input type="password" name="senha" id="senha">
					</div>
				</div>
				<div class="col-md-6">
					<div class="wow fadeInRight" data-wow-delay="0.4s">
					<label for="confirma_senha"> NOVA SENHA</label>
					<input type="password" name="confirma_senha" id="confirma_senha">
					</div>
				</div>
				</div>
			</div>
			<div class="wow fadeInLeft" data-wow-delay="0.4s">
				<div class="row">
					<div class="register-but">
							<button type="submit" class="ladda-button btn-cadastrar" data-size="m" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Atualizar Dados</button>
							<a href="../minhaconta/" class="btn btn-default btn-lg" title="voltar"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
						<div class="clearfix"> </div>
					   </form>
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

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../web/js/jquery.min.js"></script>
	<script type="text/javascript" src="../web/js/easing.js"></script>
	<script src="../web/js/bootstrap.min.js"></script>

	<script src="../pedido/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="../pedido/inspinia/js/plugins/ladda/ladda.js"></script>

    <script src="../web/js/pace.min.js"></script>

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 8000 } );
</script>

	<!--Mascaras -->
<script type="text/JavaScript" src="../web/js/jquery.mask.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  	$('#cep').mask('99999-999');
	  	$('#cpf').mask('999.999.999-99');
	  	$('#telefone').mask('(99) - 9999-9999');
	  	$('#celular').mask('(99) - 99999-9999');
	});
</script>
</body>
</html>