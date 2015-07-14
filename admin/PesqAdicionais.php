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
	$parametro = isset($_POST['pesquisaAdicional']) ? $_POST['pesquisaAdicional'] : null;
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .=" <table class='footable table table-stripped toggle-arrow-tiny' data-page-size='10'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th data-toggle='true'>Nome do Ingrediente</th>";
	$msg .="			<th data-hide='phone'>Categoria</th>";
	$msg .="			<th data-hide='phone'>Valor</th>";
	$msg .="			<th data-hide='phone'>Status</th>";
	$msg .="			<th data-sort-ignore='true'>Ação</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";

				
				require 'functions/pesquisas.php';

					$resultado = pesquisaAdicionais($parametro, $_SESSION['restaurante']);
					
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td class='bold'>".$res['nome']."</td>";
	$msg .="					<td>".$res['categoria']."</td>";
	$msg .="					<td>R$ ".number_format($res['valor'],2,",",".")."</td>";
if($res['status'] == 0){
	$msg .="					<td><span class='label label-danger'>Desativado</span></td>";
} else {
	$msg .="					<td><span class='label label-primary'>Ativado</span></td>";
}
	$msg .="					<td><a href='javascript:alterarDadosAdicional(".$res['id_adicional'].")'><i class='fa fa-pencil-square-o fa-1x'></i> Editar</a></td>";
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

      <form action="./alterar/adicional" method="POST" id="alterarDadosAdicional">
        <input type="hidden" name="id_adicional">
      </form>

<script>
     function alterarDadosAdicional(id_adicional){
        f = document.getElementById('alterarDadosAdicional');
        f.id_adicional.value = id_adicional;
        f.submit();
    }
</script>