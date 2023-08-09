<?php
require_once('baseDatos.php');


$_SESSION['fecha']=$_POST['fecha'];
$_SESSION['valor']=$_POST['valor'];



$_SESSION['filtroPedidos']=1;


header("Location: prueba.php?pedidos=1");
?>