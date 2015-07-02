<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	   
    <link href="css/style_alternative.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
<script type="text/javascript">
        $(document).ready(function() {

            $('.footable').footable();

        });
 </script>
</head>
<body>
	
</body>
</html>

<?php
if(!isset($_SESSION))
{
    session_start();
}
	//recebemos nosso par?etro vindo do form
	$parametro = isset($_POST['pesquisaPedido']) ? $_POST['pesquisaPedido'] : null;
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .=" <table class='footable table table-stripped toggle-arrow-tiny' data-page-size='15'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th data-toggle='true'>Numero do Produto</th>";
	$msg .="			<th data-hide='phone'>Data do Pedido</th>";
	$msg .="			<th data-hide='all'>Endereço de Entrega</th>";
	$msg .="			<th data-hide='phone'>Restaurante</th>";
	$msg .="			<th data-hide='phone'>Status</th>";
	$msg .="			<th data-sort-ignore='true'>Ação</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";

				//requerimos a classe de conexão
				require 'functions/pesquisas.php';

include 'includes/verificaDatasRelatorio.php';

				$resultado = pesquisaPedidos($parametro, $data1, $data2);
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td class='bold'>".$res['id_pedido']."</td>";
	$msg .="					<td>".$res['data_pedido']."</td>";
	$msg .="					<td>".$res['endereco']."</td>";
	$msg .="					<td>".$res['restaurante']."</td>";
if($res['status'] == 2 || $res['status'] == 3 || $res['status'] == 9){
	$msg .="					<td><span class='label label-danger'>Cancelado</span></td>";
} elseif($res['status'] == 8){
	$msg .="					<td><span class='label label-danger'>Erro</span></td>";
} elseif($res['status'] == 1){
	$msg .="					<td><span class='label label-default'>Aguardando</span></td>";
} elseif($res['status'] == 10){
	$msg .="					<td><span class='label label-warning'>Pendente</span></td>";
} elseif($res['status'] == 7){
	$msg .="					<td><span class='label label-info'>Concluido</span></td>";
} else{
	$msg .="					<td><span class='label label-primary'>Em andamento</span></td>";
}
	$msg .="					<td><a href='javascript:detalhesPedido(".$res['id_pedido'].")'><i class='fa fa-search-plus fa-1x'></i> Detalhar</a></td>";
	$msg .="				</tr>";
							}
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";

	$msg .="	 <tfoot>";
	$msg .="	 	<tr>";
	$msg .="	 		<td colspan='6'>";
	$msg .="	 			<ul class='pagination pull-right'></ul>";
	$msg .="	 		</td>";
	$msg .="	 	</tr>";
	$msg .="	 </tfoot>";

	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>

      <form action="detalhesPedido.php" method="POST" id="detalhesPedido">
        <input type="hidden" name="id_pedido">
      </form>

    <script>
     function detalhesPedido(id_pedido){
        f = document.getElementById('detalhesPedido');
        f.id_pedido.value = id_pedido;
        f.submit();
    }
</script>