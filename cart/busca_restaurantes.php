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
<title>GodFood - Restaurantes</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../web/js/jquery.min.js"></script>
<!-- Custom Theme Files - INSPINIA -->
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
require '../functions/restaurantes.php';
if(!isset($_SESSION))
 {
   session_start();
 }
unset($_SESSION["products"]);
if($_POST){
	$cep = $_POST['cep'];
$restaurantes = verificaRestauranteCep($cep); // verifica se existe restaurante no cep digitado
$restaurantesAberto = lista_restaurantes($cep); //faz a pesquisa usando o cep
$restaurantesFechado = lista_restaurantes_fechados($cep); //~~~
$restFechFav = lista_restaurantes_fechados_fav($cep);
$restAbertFav = lista_restaurantes_abert_fav($cep);
$_SESSION['cep'] = $_POST['cep']; //joga o cep em session para usar futuramente
} else {
	$restaurantes = null;
}
	if($restaurantes != false){ ?>
<div id="page-wrapper" class="gray-bg">

	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
    <div class="panel-heading" role="tab" id="headingOne">
      <h2>
          Restaurantes Abertos
      </h2>
    </div>
    </a>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <div class="col-md-12">
	<?php foreach($restAbertFav as $abertFav): ?>

      <div class="col-md-6">
                <div class="contact-box-fav">
                    <a href="javascript:verCardapio(<?= $abertFav['id_restaurante']; ?>)">
                    <div class="col-md-4">
                            <img alt="image" class="img-responsive" src="images/logos/default-logo.png" height="200" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3><strong><?= $abertFav['nome_fantasia']; ?></strong></h3>
                        <p><i class="fa fa-map-marker"></i> <?= $abertFav['logradouro'].", ".$abertFav['numero']." - ". $abertFav['bairro'];?><br>
                        <?= $abertFav['cidade'];?></p><br>
                            <p><strong><i class="fa fa-cutlery"></i> <?= $abertFav['especialidade']; ?>
                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$abertFav['tempo_entrega'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                             <i class="fa fa-truck"> R$ <?= number_format($abertFav['taxa_entrega'],2,",","."); ?></i></strong><br>
                            Aberto das <strong><?=substr($abertFav['hora_abert'],0,-3)?>h</strong> até as <strong><?=substr($abertFav['hora_fech'],0,-3)?>h</strong><br>
                            <h5 align="center"><strong>Ver Cardápio</strong></h5></p>
                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            </div>
          <?php endforeach; ?>
          </div>
          <div class="clearfix"></div>
           <div class="col-md-12">
			<?php foreach ($restaurantesAberto as $restAberto): ?>
             <div class="col-md-4">
                <div class="contact-box">
                    <a href="javascript:verCardapio(<?= $restAberto['id_restaurante']; ?>)">
                    <div class="col-md-4">
                            <img alt="image" class="img-responsive" src="images/logos/default-logo.png" height="200" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3><strong><?= $restAberto['nome_fantasia']; ?></strong></h3>
                        <p><i class="fa fa-map-marker"></i> <?= $restAberto['logradouro'].", ".$restAberto['numero']." - ". $restAberto['bairro'];?><br>
                        <?= $restAberto['cidade'];?></p><br>
                            <p><strong><i class="fa fa-cutlery"></i> <?= $restAberto['especialidade']; ?>
                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$restAberto['tempo_entrega'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                             <i class="fa fa-truck"> R$ <?= number_format($restAberto['taxa_entrega'],2,",","."); ?></i></strong><br>
                            Aberto das <strong><?=substr($restAberto['hora_abert'],0,-3)?>h</strong> até as <strong><?=substr($restAberto['hora_fech'],0,-3)?>h</strong><br>
                            <h5 align="center"><strong>Ver Cardápio</strong></h5></p>
                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            </div>
	<?php endforeach;?>
	</div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h2>
          Restaurantes Fechados
      </h2>
    </div>
    </a>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      <div class="col-md-12">
	<?php foreach($restFechFav as $restFav): ?>

      <div class="col-md-6">
                <div class="contact-box-fav">
                    <a href="#" onClick='alert("Desculpe, o restaurante está fechado")'>
                    <div class="col-md-4">
                            <img alt="image" class="img-responsive" src="images/logos/default-logo.png" height="200" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3><strong><?= $restFav['nome_fantasia']; ?></strong></h3>
                        <p><i class="fa fa-map-marker"></i> <?= $restFav['logradouro'].", ".$restFav['numero']." - ". $restFav['bairro'];?><br>
                        <?= $restFav['cidade'];?></p><br>
                            <p><strong><i class="fa fa-cutlery"></i> <?= $restFav['especialidade']; ?>
                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$restFav['tempo_entrega'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                             <i class="fa fa-truck"> R$ <?= number_format($restFav['taxa_entrega'],2,",","."); ?></i></strong><br>
                            Aberto das <strong><?=substr($restFav['hora_abert'],0,-3)?>h</strong> até as <strong><?=substr($restFav['hora_fech'],0,-3)?>h</strong><br>
                            <h5 align="center"><strong>Ver Cardápio</strong></h5></p>
                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            </div>
          <?php endforeach; ?>
          </div>
          <div class="clearfix"></div>
           <div class="col-md-12">
			<?php foreach ($restaurantesFechado as $restauranteFechado): ?>
             <div class="col-md-4">
                <div class="contact-box">
                    <a href="#" onClick='alert("Desculpe, o restaurante está fechado")'>
                    <div class="col-md-4">
                            <img alt="image" class="img-responsive" src="images/logos/default-logo.png" height="200" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3><strong><?= $restauranteFechado['nome_fantasia']; ?></strong></h3>
                        <p><i class="fa fa-map-marker"></i> <?= $restauranteFechado['logradouro'].", ".$restauranteFechado['numero']." - ". $restauranteFechado['bairro'];?><br>
                        <?= $restauranteFechado['cidade'];?></p><br>
                            <p><strong><i class="fa fa-cutlery"></i> <?= $restauranteFechado['especialidade']; ?>
                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$restauranteFechado['tempo_entrega'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                             <i class="fa fa-truck"> R$ <?= number_format($restauranteFechado['taxa_entrega'],2,",","."); ?></i></strong><br>
                            Aberto das <strong><?=substr($restauranteFechado['hora_abert'],0,-3)?>h</strong> até as <strong><?=substr($restauranteFechado['hora_fech'],0,-3)?>h</strong><br>
                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            </div>
	<?php endforeach;?>
	</div>
      </div>
    </div>
  </div>
</div>
<?php } else {
		?>
		<div class='srch-rest-error'>
			<h3>Desculpe,
				Não encontramos nenhum restaurante parceiro perto de você :(
				Verifique se o CEP digitado está correto e
				<a href='../'>tente novamente</a> .
			</h3>
				<h4>Conhece algum restaurante que nos aceitaria como parceiros?
					<br>
					<a href='../contato.php'>Clica aqui e conta pra gente!</a>
				</h4>
		</div>
<?php } ?>
			</div>
		</div>
	</div>

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
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<div class="footer">
		<div class="container">
			<p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; 2014  All rights  Reserved | Template by &nbsp;<a href="http://w3layouts.com" target="target_blank">W3Layouts</a></p>
		</div>
	</div>
	<form action="escolha_produtos.php" method="POST" id="formVerCardapio">
		<input type="hidden" name="id">
	</form>
<script>
	function verCardapio(id){
		f = document.getElementById('formVerCardapio');
		f.id.value = id;
		f.submit();
	}
</script>

    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="inspinia/js/plugins/pace/pace.min.js"></script>


    <script>
        $(document).ready(function(){
            $('.contact-box').each(function() {
                animationHover(this, 'pulse');
            });
        });
        $(document).ready(function(){
            $('.contact-box-fav').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>
</body>
</html>