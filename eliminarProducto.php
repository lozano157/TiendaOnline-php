<?php
require_once('baseDatos.php');
$codigo=$_POST['codigo'];


$res=eliminarProducto($codigo);


if($res==1){
    $_SESSION['eliminado']=1;
    header("Location: prueba.php?productos=1");
}

?>

