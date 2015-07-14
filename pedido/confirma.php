<?php
require '../functions/registro.php';

if(verifica_usuario($_GET['id'], $_GET['verification_code'])){
    header("Location: ./resumo");
} else {
    header("Location: ./resumo");
}
