<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');
session_start();
var_dump($_POST);
// Se obtienen los datos del formulario
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$existencias = $_POST['existencias'];
$imagen= $_POST['imagen'];


if(insertarProducto($descripcion,$precio,$existencias,$imagen)==1){
    echo "Usuario dado de baja";
    
    header("Location: prueba.php?productos=1");
}
else{
    
    
}



?>