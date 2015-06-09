<?php 
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['start']) && isset($_POST['end'])){
    $_SESSION['data1'] = implode("-",array_reverse(explode("/",$_POST['start'])));
    $_SESSION['data2'] = implode("-",array_reverse(explode("/",$_POST['end'])));
}

if(isset($_SESSION['data1']) && isset($_SESSION['data2'])){
    $data1 = $_SESSION['data1']." 00:00:00";
    $data2 = $_SESSION['data2']." 23:59:59";
     $dataS1 = implode("/",array_reverse(explode("-",$_SESSION['data1'])));
      $dataS2 = implode("/",array_reverse(explode("-",$_SESSION['data2'])));

} else {
    $data1 = date('Y-m-d')." 00:00:00";
    $data2 = date('Y-m-d')." 23:59:59";
     $dataS1 = date('d/m/Y');
      $dataS2 = date('d/m/Y');
}