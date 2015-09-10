<?php
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_SESSION['doisSabores'])){ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="../web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Shopping Cart Custon CSS -->
<link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
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
<link rel="stylesheet" href="inspinia/css/ladda.min.css">

<link href="inspinia/css/iCheck/custom.css" rel="stylesheet">
</head>
<body>
    <!--  -->
    <div class="header">

<?php
if(!isset($_SESSION))
 {
   session_start();
 }
include 'includes/menu-top.php';

require '../functions/pedidos.php';
require '../functions/restaurantes.php';

if(isset($_SESSION['id_restaurante'])){

        $categorias = buscaCategoriaSelecionada($_SESSION['id_categoria']);

        $restaurante = mostra_infos_restaurante($_SESSION['id_restaurante'],$_SESSION['cep']);
        $_SESSION['taxa_servico'] = $restaurante['taxa_servico']; // taxa de serviço
        $_SESSION['taxa'] = $restaurante['taxa']; // entrega
        $_SESSION['compra_minima'] = $restaurante['compra_minima']; // valor da compra minima

        $primeiroSabor = $_SESSION['doisSabores'];
?>
<div class="animated fadeInRight">

    <div id="products-wrapper">
    <div class="row">
        <h1 align="center"><?=$restaurante['nome_fantasia']?></h1>
    </div>
    <br>
<div class="alert alert-info alert-dismissible" role="alert">
      <h4>Por favor, escolha o sabor da outra metade para finalizar o item, é só clicar no botão verde do sabor desejado o/</h4>
      <ul class="descricao">
          <li><?=$primeiroSabor['name']?></li>
          <li>Adicional: <?=$primeiroSabor['adicional']?></li>
          <li>Borda: <?=$primeiroSabor['borda']?></li>
          <li>Valor: <?=$primeiroSabor['valor']?></li>
      </ul>
    </div>
     <div class="products">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- Collapse das Categorias -->
    <?php foreach ($categorias as $cat): ?>
<!-- Header das Categorias -->
  <div class="panel panel-default">
  <a data-toggle="collapse" data-parent="#accordion" href="#<?= $cat['id_categoria']; ?>" aria-expanded="true" aria-controls="<?= $cat['id_categoria']; ?>">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
          <?= $cat['nome'];?>
      </h4>
    </div>
    </a>

    <div id="<?= $cat['id_categoria']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body"> <!-- Inicio dos produtos -->
    <?php
     $produtos = listaProdutos2Sabor($_SESSION['id_categoria'],$_SESSION['codigo1']);

      foreach($produtos as $produto):
?>
    <div class="col-lg-12">
        <div class="contact-box-n">
        <form action="add-segundo-sabor.php" method="POST">
            <h3><?= $produto['nome_produto'] ?></h3>
                <div class="product-desc"><?= $produto['descricao'] ?></div>
                    <div class="adicionar"><strong>
                        <?= "R$ ".number_format($produto['valor_unit'],2,",","."); ?></strong>
                
                        <input type="hidden" name="codigo" value="<?= $produto['codigo']?>" />
                        <input type="hidden" name="type" value="add_segundo_sabor" />
                        <input type="hidden" name="doisSabores" value="yep">
                        <button type="submit" class="add_to_cart" ><i class="fa fa-check-circle fa-3x"></i></button>
                 </form>
                    </div> <!-- Fim dos Produtos -->
        </div>
    </div>
     <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>
</div>

<div class="animated shake">
  <div class="shopping-cart">
    <h2>Seu Pedido <i class="fa fa-shopping-cart"></i></h2>
    <?php
    if(isset($_SESSION["products"]))
    {
        $total = 0;
        echo '<ol class="shopping-cart-itens">';
        foreach ($_SESSION["products"] as $cart_itm): ?>
            <li class="cart-itm">
                <h3><?=$cart_itm['name']?></h3>
                    <div class="p-qty">Quantidade : <?=$cart_itm['qtd']?></div>
                    <div class="p-adic"><strong>Adicional</strong> : <?=$cart_itm['adicional']?> , <strong>Borda</strong> : <?=$cart_itm['borda']?></div>

            <?php if(strlen($cart_itm['obs'])>5){ ?>
                    <p>Obs: <?=$cart_itm['obs'];?>;</p>

            <?php } $valorTotalProduto = ($cart_itm['valor']+$cart_itm['valor_adicional']+$cart_itm['valor_borda']);
            $subtotal = ($valorTotalProduto*$cart_itm['qtd']);?>

                    <div class="p-price">Valor : R$ <?=number_format($subtotal,2,",",".");?></div>
            </li>

            <?php

            $total = ($total + $subtotal);
        endforeach; ?>
        </ol>
          <div class="taxa">
          <p>
          <?php if($restaurante['compra_minima'] > $total){
            $restaurante['taxa_servico'] = 0; ?>

            Valor Minimo: R$ <?=number_format($restaurante['compra_minima'],2,",",".");?> <br><br>

          <?php } $grandTotal = $total + $restaurante['taxa'] + $restaurante['taxa_servico']; ?>

                <strong>Sub-total: R$ <?=number_format($total,2,",",".");?> <br></strong>
                Taxa de entrega: R$ <?=number_format($restaurante['taxa'],2,",",".");?> <br>

                <?php if($restaurante['compra_minima'] < $total){ ?>
                Serviços: R$ <?=number_format($restaurante['taxa_servico'],2,",",".");?> <br>
            </p>
                <?php } ?>

                <p><strong>Total: R$ <?=number_format($grandTotal,2,",",".");?></strong> <br></p>

        </div>
            <br>

    <?php }else{ ?>
        <h4>:( Seu carrinho está vazio</h4>
            <h5 align="center">Que tal escolher algo gostoso para comer?</h5>
<?php }?>
    </div>
  </div>
</div>
<div class="clearfix"> </div>
<br>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../web/js/jquery.min.js"></script>
    <script src="../web/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../web/js/easing.js"></script>

    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="../web/js/pace.min.js"></script>

    <script src="inspinia/js/plugins/ladda/spin.js"></script>
    <script src="inspinia/js/plugins/ladda/ladda.js"></script>

    <script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 10000 } );
</script>

    <!-- iCheck -->
    <script src="js/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

</body>


    <script>
        $(document).ready(function(){
            $('.contact-box-n').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>

</body>

</html>

<?php } else {
    $_SESSION['acesso_invalido'] = "Desculpe,
                Você não tem permissão para ver está pagina!
                <br>";
    header('Location: ./erro');
   }
} else {
    header('Location: ./produtos');
}
?>