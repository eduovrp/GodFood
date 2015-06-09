<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
var_dump($_POST);
var_dump($_SESSION);
$_SESSION['data1'] = implode("-",array_reverse(explode("/",$_POST['start'])));
$_SESSION['data2'] = implode("-",array_reverse(explode("/",$_POST['end'])));

$d1 = $_SESSION['data1'].' 00:00:00';
echo $d1;
echo '<br>';
echo date("Y-d-m H:i:s", strtotime("- 3 hours"));

 ?>