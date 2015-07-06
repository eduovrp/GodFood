<?php 

if(!isset($_SESSION))
{
    session_start();
}

echo date('d/m', strtotime("-1 days"));
 ?>