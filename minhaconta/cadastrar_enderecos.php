<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Cadastrar Endereço</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="../cart/inspinia/css/ladda.min.css">

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
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
<?php
include 'includes/menu-top.php';
include 'mensagens_cad.php';

if(isset($_SESSION['id_usuario']) && isset($_SESSION['login_status'])){

require '../functions/registro.php';

if(isset($_SESSION['return_url'])){

    $return_url = base64_decode($_SESSION["return_url"]);
    unset($_SESSION['return_url']);

}else{
    $return_url = "../minhaconta/";
}

if(isset($_SESSION['cep'])){
$dados = busca_dados_endereco($_SESSION['cep']);
} else{
 $dados = NULL;
}
 ?>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
	<div class="main">
	   <div class="container">
		  <div class="register">
		  	  <form action="registra_endereco.php" method="POST">
				 <div class="register-top-grid">
					<h3>INFORMAÇÕES PARA ENTREGAS</h3>
					<div class="row">
					<div class="col-md-5">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<label for="logradouro">LOGRADOURO * (Ex: Rua 14, Avenida Central, Etc..)</label>
						<input type="text" name="logradouro" id="logradouro" required>
					 </div>
					 </div>
					 <div class="col-md-1">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						<label for="numero">NUMERO *</label>
						<input type="text" name="numero" id="numero" required>
					 </div>
					 </div>
					 <div class="col-md-3">
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						 <label for="bairro">BAIRRO *</label>
						 <input type="text" name="bairro" id="bairro" required>
					 </div>
					 </div>
					</div>
					<div class="row">
					<div class="col-md-5">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="cidade">CIDADE *</label>
						 <input type="text" name="cidade" id="cidade" value="<?= $dados['nome_cidade'];?>" required>
					 </div>
					 </div>
					 <div class="col-md-1">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="estado">ESTADO * </label>
						 <input type="text" name="estado" id="estado" value="<?= $dados['sigla'];?>" required>
					 </div>
					 </div>
					 <div class="col-md-3">
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <label for="cep">CEP * </label>
						 <input type="text" name="cep" id="cep" value="<?= $dados['cep'];?>" placeholder="_____-___" required>
					 </div>
					 </div>
					 </div>
					 <div class="clearfix"> </div>
					 <div class="row">
					 <div class="col-md-6">
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked="" required><i> </i>Concordo com os <a href="../termos-de-entrega.php" target="_blank" class="termos-a"> Termos de Entrega</a></label>
					   </a>
					 </div>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>INFORMAÇÕES COMPLEMENTARES</h3>
						    </div>

						    <div class="row">
						    <div class="col-md-4">
						     <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<label for="complemento">COMPLEMENTO</label>
								<input type="text" name="complemento" id="complemento">
					 		</div>
					 		</div>
					 		<div class="col-md-5">
							 <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<label for="referencia">REFERENCIA</label>
								<input type="text" name="referencia" id="referencia">
							 </div>
							 </div>
							 </div>
					 </div>
				<div class="clearfix"> </div>
				<div class="row">
					<div class="register-but">
						   	<button type="submit" class="ladda-button btn btn-cadastrar" data-size="m" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Cadastrar Endereço</button>
							<a href="<?=$return_url?>" class="btn btn-default btn-lg" title="voltar"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
						   <div class="clearfix"> </div>
					   </form>
					</div>
				</div>
		   </div>
	     </div>
	    </div>

<?php
unset($_SESSION['cadastrado']);
 } else {
 	$_SESSION['acesso_invalido'] = "Desculpe,
				Você não tem permissão para ver está pagina, você precisa estar logado.
				<br>";
	header('Location: error.php');
   }
?>

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
	<!-- content-section-ends -->
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
	
	<script src="../cart/inspinia/js/plugins/ladda/spin.js"></script>
    <script src="../cart/inspinia/js/plugins/ladda/ladda.js"></script>

<script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
</script>

		<!--Mascaras -->
	<script type="text/JavaScript" src="../web/js/jquery.mask.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#cep').mask('99999-999');
});
   </script>
</body>
</html>