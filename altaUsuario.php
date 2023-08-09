<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');
session_start();
var_dump($_POST);
// Se obtienen los datos del formulario
$usuario = $_POST['codigo'];


if(altaUsuario($usuario)==1){
    echo "Usuario dado de alta";
    $_SESSION['alta']=1;
    header("Location: prueba.php?usuarios=1");
}
else{
    
    
}



?>