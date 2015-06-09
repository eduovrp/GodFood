<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>

	<label>Categoria</label>
	<select class="form-control" name="categoria" id="categoria">
  <option value="0">Todas</option>
  	<?php
  require 'functions/functions.php';
  $restaurante = $_GET['restaurante'];
  $categorias = busca_categorias($restaurante);

foreach($categorias as $categoria): ?>
    <option value="<?=$categoria['id_categoria'];?>"><?=$categoria['nome'];?></option>
<?php
  endforeach;
?>
</select>
</body>
</html>
