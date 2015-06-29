<?php
require '../functions/registro.php';

if($_GET['verification_code']){

	verifica_usuario($_GET['id'], $_GET['verification_code']);
    header("Location: ../minhaconta/");
} else {
    header("Location: ../minhaconta/");
}
