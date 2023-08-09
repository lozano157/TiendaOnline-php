<?php
require_once('baseDatos.php');


$_SESSION['existencias']=$_POST['existencias'];
$_SESSION['precio']=$_POST['precio'];
$_SESSION['euros']=$_POST['euros'];
$_SESSION['filtro2']=$_POST['filtro2'];
$_SESSION['valor']=$_POST['valor'];
$_SESSION['valor2']=$_POST['valor2'];



$_SESSION['filtroProductos']=1;


header("Location: prueba.php?productos=1");
?>