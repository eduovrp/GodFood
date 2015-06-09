<?php
require '../functions/registro.php';

if(verifica_usuario($_GET['id'], $_GET['verification_code'])){
    header("Location: view_cart.php");
} else {
    header("Location: view_cart.php");
}
