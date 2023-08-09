<?php
require_once('baseDatos.php');



$_SESSION['estado']=$_POST['estado'];
$_SESSION['filtro2']=$_POST['filtro2'];
$_SESSION['valor']=$_POST['valor'];

$_SESSION['filtroUsuarios']=1;


header("Location: prueba.php?usuarios=1");

?>