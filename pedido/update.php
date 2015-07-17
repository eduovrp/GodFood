<?php 
require '../functions/restaurantes.php';
if(!isset($_SESSION))
{
    session_start();
}

if($_POST){
	if($_POST['godshield'] == 'no'){

		$_SESSION['checked'] = NULL;
		$_SESSION['taxa_servico'] = 0;
		$_SESSION['godshield'] = 'no';

		header('Location: ./produtos');
	} else if($_POST['godshield'] == 'yes'){

		$restaurante = mostra_infos_restaurante($_SESSION['id_restaurante'],$_SESSION['cep']);

        $_SESSION['taxa_servico'] = $restaurante['taxa_servico']; // taxa de serviço
		$_SESSION['checked'] = 'checked';
		$_SESSION['godshield'] = 'yes';

		header('Location: ./produtos');
	}
}

 ?>