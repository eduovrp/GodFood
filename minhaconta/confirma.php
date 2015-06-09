<?php
require '../functions/registro.php';

if(verifica_usuario($_GET['id'], $_GET['verification_code'])){
    header("Location: index.php");
} else {
    header("Location: index.php");
}
