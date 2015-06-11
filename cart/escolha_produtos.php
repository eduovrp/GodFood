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
<title>GodFood - Pedido</title>
<link rel="icon" type="image/png" href="../web/images/plate.png" />
<link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../web/js/jquery.min.js"></script>
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
<script type="text/javascript" src="../web/js/easing.js"></script>

 <script src="../web/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../web/font-awesome-4.3.0/css/font-awesome.min.css">

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

$current_url = base64_encode($url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if($_POST){

    $id = $_POST['id'];
    $_SESSION['id'] = $_POST['id'];
}
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $_SESSION['id_restaurante'] = $id;
                }
    if(isset($id)){

        $categorias = mostra_categorias($id);
        $restaurante = mostra_infos_restaurante($id,$_SESSION['cep']);
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
                        <button type="button" class="add_to_cart" data-toggle="modal" data-target="#myModa<?= $produto['codigo']?>"><i class="fa fa-plus-circle fa-3x"></i></button>
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
                        <div class="adicionar">
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
                    <label>
                        <input type="radio" name="borda" checked="" value="0"> Borda sem recheio</input></div>
                    </label>
                <?php foreach ($bordas as $borda): ?>
                    <div class="col-md-4">
                    <label>
                        <input type="radio" name="borda" value="<?=$borda['id_borda'];?>"> <?=$borda['nome'];?> + R$ <?=number_format($borda['valor'],2,",",".");?></input>
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
                    <label>
                        <input type="radio" name="adicional" checked="" value="0"> Nenhum Adicional</input></div>
                    </label>
                <?php foreach ($adicionais as $adicional): ?>
                    <div class="col-md-4">
                    <label>
                        <input type="radio" name="adicional" value="<?=$adicional['id_adicional'];?>"> <?=$adicional['nome'];?> + R$ <?=number_format($adicional['valor'],2,",",".");?></input>
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
                    </div>
                    <div class="modal-footer">
<!--Input Hidden + botão submit  -->
        <input type="hidden" name="codigo" value="<?= $produto['codigo']?>" />
        <input type="hidden" name="type" value="add" />
        <input type="hidden" name="return_url" value="<?=$current_url?>" />
        <input type="hidden" name="categoria_in" value="<?=$cat['id_categoria'];?>">

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adcionar ao Carrinho</button>
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
        echo '<ol>';
        foreach ($_SESSION["products"] as $cart_itm): ?>
            <li class="cart-itm">
                <span class="remove-itm"><a href="cart_update.php?removep=<?=$cart_itm['code']?>&return_url=<?=$current_url?>">&times;</a></span>
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

        <span class="empty-cart"><a href="cart_update.php?removep=<?=$cart_itm["code"]?>&emptycart=1&return_url=<?=$current_url?>"><input type="button" class="esvaziar" value="Esvaziar Carrinho"></a></input></span>

        <?php if($restaurante['compra_minima'] > $total){ ?>
            <a href="#"><input type="button" class="btn btn-block" value="Prosseguir" disabled="disabled"></a></input>

        <?php } else { ?>
            <a href="view_cart.php"><input type="button" class="btn btn-block" value="Prosseguir"></a></input>
        <?php } ?>

    <?php }else{ ?>

        <h4>:( Seu carrinho está vazio</h4>
            <h5 align="center">Que tal escolher algo gostoso para comer?</h5>

<?php }?>
    </div>
  </div>
</div>

</body>
    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="inspinia/js/plugins/pace/pace.min.js"></script>


    <script>
        $(document).ready(function(){
            $('.contact-box-n').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>
</html>

<?php } else {
    $_SESSION['acesso_invalido'] = "Desculpe,
                Você não tem permissão para ver está pagina!
                <br>";
    header('Location: error.php');
   }
?>