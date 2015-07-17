<?php

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['id_restaurante'])){
    if($_SESSION['compra_minima'] <= $_SESSION['grandTotal']){
        if(isset($_POST['endereco']) || isset($_SESSION['endereco'])){
            $current_url = base64_encode($url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
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
<title>GodFood - Resumo do Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Shopping Cart Custon CSS -->
<link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="style/resumo.css" rel="stylesheet" type="text/css" media="all" />

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="../web/js/wow.min.js"></script>
<link href="../web/css/animate.css" rel='stylesheet' type='text/css' />
<script> new WOW().init(); </script>

<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">
<link href="../web/css/pace.css" rel='stylesheet' type='text/css' />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65249437-1', 'auto');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">

<?php
include 'includes/menu-top.php';
include 'mensagens.php';
require '../functions/pedidos.php';
require '../functions/restaurantes.php';

if(isset($_POST['endereco'])){
    $_SESSION['endereco'] = $_POST['endereco'];
}

$rest = buscaDadosRestaurante($_SESSION['id_restaurante']);
$endereco = select_endereco_entrega($_SESSION['endereco']);
?>
 <div class="container">
    <div class="resumo">
        <h1>Efetuar Pagamento</h1>
<div class="animated fadeInRight">
        <div class="section-resumo">
            <h3>Resumo do Pedido</h3>
            <table class="table table-hover">
        <thead>
          <tr>
            <th>Nome do Produto</th>
            <th>Qtd</th>
            <th class="mob-disp">Adicional</th>
            <th class="mob-disp">Borda Recheada</th>
            <th>Subtotal</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
         <?php
         $total = 0;
    if(isset($_SESSION['products'])){
        foreach($_SESSION['products'] as $cart_itm): 
            $categoria = buscaCategoria2Sabor($cart_itm['id_categoria']);
            ?>
          <tr>
            <td><strong><?=$cart_itm['name']?> (<?= $categoria['nome'];  ?>)</strong></td>
            <td><?=$cart_itm['qtd'];?></td>
            <td class="mob-disp"><?=$cart_itm['adicional'];?></td>
            <td class="mob-disp"><?=$cart_itm['borda'];?></td>

        <?php $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']); 
              $subtotal = $valorTotalProduto*$cart_itm["qtd"];?>

            <td>R$ <?=number_format($subtotal,2,",",".");?></td>
            <td><a href="cart_update.php?removep=<?=$cart_itm['code']?>&return_url=<?=$current_url?>"><i class="fa fa-trash-o fa-1x"></i> Excluir</a></td>
        <?php $total = $total + $subtotal; ?>
          </tr>
        <?php endforeach;
    }   
    if($total < $_SESSION['compra_minima']){
        header( "refresh:0.1;url=escolha_produtos.php" ); 
    }
         ?>
         <tr>
            <td>Serviço + Taxa de Entrega</td>
            <td></td>
            <td class="mob-disp"></td>
            <td class="mob-disp"></td>
            <td>R$ <?=number_format(($_SESSION['taxa_servico']+$_SESSION['taxa']),2,",",".");?></td>
            <td></td>
        </tr>
        <?php $grandTotal = $total + $_SESSION['taxa_servico'] + $_SESSION['taxa'];
        $_SESSION['grandTotal'] = $grandTotal; ?>
        <tr>
            <td></td>
            <td class="mob-disp"></td>
            <td class="mob-disp"></td>
            <td><strong>Total</strong></td>
            <td>R$ <?=number_format($grandTotal,2,",",".");?></td>
            <td></td>
        </tr>
        </tbody>
      </table>
        </div>
</div>
<div class="animated fadeInLeft">
        <div class="section-resumo">
            <h3>Endereço para Entrega</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Endereço:</strong> <?= $endereco['logradouro'].', '.$endereco['numero'].' - '.$endereco['bairro']?></td>
                        <td class="mob-disp"><strong>Complemento/Referencia:</strong> <?=$endereco['complemento'].' / '.$endereco['referencia']?></td>
                        <td><strong>Cidade:</strong> <?=$endereco['cidade'].' - '.$endereco['estado'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<div class="animated fadeInDown">
        <div class="section-resumo">
            <h3>Dados do Restaurante</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong><?=$rest['nome_fantasia']?></strong> </td>
                        <td><strong>Tipo:</strong> <?=$rest['tipo']?></td>
                        <td><strong>Tempo de Entrega:</strong> <?=$rest['tempo_entrega']?></td>
                        <td><strong>Contato:</strong> <?=$rest['fone']?></td>
                        <td class="mob-disp"><strong>Cidade:</strong> <?=$rest['cidade']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<div class="animated fadeInUp">
        <a href="./produtos" class="btn btn-danger btn-lg pull-right"><i class="fa fa-arrow-left fa-1x"></i> Voltar</a>
    </div>
<div class="view-cart-final" align="center">
<form method="POST" action="confirma-pagamento.php">
    <script type="text/javascript"
        src="https://pagar.me/assets/checkout/checkout.js"
        data-button-text="Pagar com cartão de crédito"
        data-ui-color="#9a2529"
        data-payment-methods="credit_card"
        data-customer-data="false"
        data-encryption-key="ek_test_YL0gTuW5wGR5BNLXePXSP52ieHogfD"
        data-amount="<?=$grandTotal*100?>">
    </script>
</form>
</div>
</div>     
</div>             
<div class="clearfix"> </div>
<br>
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
                        <form action="../subscribe.php" method="POST" accept-charset="utf-8">
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../web/js/jquery.min.js"></script>
    <script src="../web/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../web/js/easing.js"></script>

    <script src="../web/js/pace.min.js"></script>

<?php 
        } else {
            header('Location: ./produtos');
        }
    } else {
        header('Location: ./produtos');
    }
} else {  
    header('Location: ../');
} ?>
</body>
</html>