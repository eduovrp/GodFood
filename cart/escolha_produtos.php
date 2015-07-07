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
if(!isset($_SESSION['doisSabores'])){ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GodFood - Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />

<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
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

require 'config.php';
require '../functions/pedidos.php';
require '../functions/restaurantes.php';

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if(isset($_POST['id_restaurante'])){

if(isset($_SESSION['id_restaurante'])){
    if(isset($_POST['id_restaurante']) != $_SESSION['id_restaurante']){
        unset($_SESSION['products']);
    }
}

    $id_restaurante = $_POST['id_restaurante'];
    $_SESSION['id_restaurante'] = $_POST['id_restaurante'];
} else {
    if(isset($_SESSION['id_restaurante'])){
        $id_restaurante = $_SESSION['id_restaurante'];
    }
}

if(isset($id_restaurante)){
        $categorias = mostra_categorias($id_restaurante);
        $restaurante = mostra_infos_restaurante($id_restaurante,$_SESSION['cep']);
        $_SESSION['taxa_servico'] = $restaurante['taxa_servico']; // taxa de serviço
        $_SESSION['taxa'] = $restaurante['taxa']; // entrega
        $_SESSION['compra_minima'] = $restaurante['compra_minima']; // valor da compra minima
?>
<div class="animated fadeInRight">

    <div id="products-wrapper">
    <div class="row">
        <h1 align="center"><?=$restaurante['nome_fantasia']?></h1>
    </div>
    <br>
<div class="alert alert-danger alert-dismissible" role="alert">
      <h4>Você está em um ambiente de teste, nenhum pedido será registrado oficialmente nem entregue, caso encontre algum problema, bug ou erro, por favor, entre em contato conosco. Agradecemos sua compreensão.</h4>
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
    <?php

    if(isset($_SESSION['categoria_in'])){
        if($_SESSION['categoria_in'] == $cat['id_categoria'] ){
            $categoria_in = 'in';
            unset($_SESSION['categoria_in']);
        } else { $categoria_in = '';
    }
    } else{
        $categoria_in = '';
    }
     ?>
    <div id="<?= $cat['id_categoria']; ?>" class="panel-collapse collapse <?=$categoria_in;?>" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body"> <!-- Inicio dos produtos -->
    <?php
     $produtos = lista_produtos($cat['id_categoria']);
     $adicionais = busca_adicionais($cat['id_categoria']);
     $bordas = busca_bordas($cat['id_categoria']);
     $verificaBorda = verificaBorda($cat['id_categoria']);
     $verificaAdicional = verificaAdicional($cat['id_categoria']);
      foreach($produtos as $produto):
?>
    <div class="col-lg-12">
        <div class="contact-box-n">
            <h3><?= $produto['nome_produto'] ?></h3>
                <div class="product-desc"><?= $produto['descricao'] ?></div>
                    <div class="adicionar"><strong>
                        <?= "R$ ".number_format($produto['valor_unit'],2,",","."); ?></strong>
                        <button type="button" class="add_to_cart" data-toggle="modal" data-target="#myModa<?= $produto['codigo']?>"><i class="fa fa-cart-plus fa-2x"></i></button>
                    </div> <!-- Fim dos Protuso -->


<!-- Inicio do Modal dos Adicionais  -->
        <div class="modal inmodal" id="myModa<?= $produto['codigo']?>" tabindex="-1" role="dialog"  aria-hidden="true">
            <form action="cart_update.php" method="POST">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-cutlery modal-icon"></i>
                        <h4 class="modal-title">Aprimore seu Produto</h4>
                        <small><strong><?= $produto['nome_produto'];?></strong> <br> <?= $produto['descricao'] ?></small>
                    </div>
                    <div class="modal-body">
                        <div class="adicionar qtd-add">
                        Quantidade
                        <input type="number" min="1" name="qtd" value="1" />
                        </div>
            <?php if($verificaBorda == true){ ?>
            <br>
                 <h3>Bordas Recheadas</h3>
                        <p>Se você quer aproveitar cada centimetro da sua pizza, porque não rechear as bordas? Assim você evita o desperdicio e vamos combinar, fica bem mais saboroso *o*</p>
                    <br>
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                    <label class="radio-i">
                        <input type="radio" name="borda" class="i-checks" checked="" value="0"> Borda sem recheio</input></div>
                    </label>
                <?php foreach ($bordas as $borda): ?>
                    <div class="col-md-4">
                    <label class="radio-i">
                        <input type="radio" name="borda" class="i-checks" value="<?=$borda['id_borda'];?>"> <?=$borda['nome'];?> + R$ <?=number_format($borda['valor'],2,",",".");?></input>
                    </label>
                    </div>
                <?php endforeach; ?>
                 </div>
                </div>
            <?php }
                if($verificaAdicional == true){ ?>
                    <h3>Adicionais</h3>
                        <p>Escolha sabiamente seu adicional jovem padawan, pois você pode escolher apenas <strong>01</strong></p>
                    <br>
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                    <label class="radio-i">
                        <input type="radio" name="adicional" class="i-checks" checked="" value="0"> Nenhum Adicional</input></div>
                    </label>
                <?php foreach ($adicionais as $adicional): ?>
                    <div class="col-md-4">
                    <label class="radio-i">
                        <input type="radio" name="adicional" class="i-checks" value="<?=$adicional['id_adicional'];?>"> <?=$adicional['nome'];?> + R$ <?=number_format($adicional['valor'],2,",",".");?></input>
                    </label>
                    </div>
                <?php endforeach; ?>
                 </div>
                </div>
                 <br>
            <?php } ?>
                 <div class="row">
                     <div class="col-md-12">
                     <label for="obs"><h3>Observação</h3></label>
                     <p>Neste campo, você pode inserir alguma observação sobre o produto que você deseja. <br> <strong>Não é obrigatório.</strong></p>
                         <input type="text" class="form-control" id="obs" name="obs" placeholder="Ex: Retirar Tomate, Retirar Milho, etc">
                     </div>
                 </div>
            <?php if($cat['2sabores'] == 'Sim'){ ?>
                 <br><br>
                <h4>
                    <label class="checkb"><input type="checkbox" class="i-checks" name="doisSabores"> Quero <?=$produto['categoria']?> com 02 Sabores!</label>
                </h4>  
            <?php } ?> 
                 </div>
                    
                    <div class="modal-footer">
<!--Input Hidden + botão submit  -->
        <input type="hidden" name="codigo" value="<?= $produto['codigo']?>" />
        <input type="hidden" name="type" value="add" />
        <input type="hidden" name="return_url" value="<?=$current_url?>" />
        <input type="hidden" name="categoria_in" value="<?=$cat['id_categoria'];?>">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-1x"></i> Cancelar</button>
                        <button type="submit" class="ladda-button btn btn-primary" data-size="s" data-style="zoom-in"><i class="fa fa-check fa-1x"></i> Adcionar ao Carrinho</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Fim do Modal  -->

            </form>
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
                <span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm['code']?>&return_url=<?=$current_url?>" class="btn btn-default btn-sm"><i class="fa fa-trash-o fa-1x"></i></a></span>
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
        <span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm["code"]?>&emptycart=1&return_url=<?=$current_url?>" class="btn btn-danger btn-md">Esvaziar Carrinho <i class="fa fa-trash-o fa-1x"></i></a></span>
        <br><br><br>
        <?php if($restaurante['compra_minima'] > $total){ ?>
        <br>
            <a href="#" class="btn btn-lg btn-warning btn-block disabled">Valor inferior ao minimo <i class="fa fa-exclamation-triangle"></i></a>

        <?php } else { ?>
        <br>
            <a href="view_cart.php" class="btn btn-lg btn-success btn-block">Ver resumo do pedido <i class="fa fa-check"></i></a>
        <?php } ?>

    <?php }else{ ?>

        <h4>:( Seu carrinho está vazio</h4>
            <h5 align="center">Que tal escolher algo gostoso para comer?</h5>
                <br>
<?php }?>
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
                        <form action="../subscribe.php" method="POST" accept-charset="utf-8" onsubmit="return sucesso()">
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

    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="../web/js/pace.min.js"></script>

    <script src="inspinia/js/plugins/ladda/spin.js"></script>
    <script src="inspinia/js/plugins/ladda/ladda.js"></script>

    <script type="text/javascript">
                // Bind normal buttons
            Ladda.bind( 'button[type=submit]', { timeout: 15000 } );
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
    header('Location: error.php');
   }
} else {
    header('Location: complete-product.php');
}
?>