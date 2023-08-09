<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');
session_start();
var_dump($_POST);
// Se obtienen los datos del formulario
$producto = $_POST['codigo'];
$nuevasUnidades=$_POST['existencias'];
$nuevoPrecio=$_POST['precio'];
$descr=$_POST['descr'];
$imagen=$_POST['imagen'];

$_SESSION['modificado']=1;

echo $nuevoPrecio;

if(actualizarProducto($producto,$nuevoPrecio,$nuevasUnidades,$descr,$imagen)==1){
    echo "Producto actualizado";
    $_SESSION['modificado']=1;
    header("Location: prueba.php?modificados=1");
}
else{
    
    
}



?>