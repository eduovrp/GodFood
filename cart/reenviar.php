<?php 
require '../functions/registro.php';
if($_GET['cod']){
$cod = base64_decode($_GET["cod"]);

$dados = buscaCodAtivacao($cod);

reenviaEmailConfirmacao($cod, $dados['email'], $dados['hash_ativar_conta']);

header('Location: view_cart.php');
}
?>