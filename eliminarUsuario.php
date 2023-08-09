<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');
session_start();
var_dump($_POST);
// Se obtienen los datos del formulario
$usuario = $_POST['codigo'];


if(eliminarUsuario($usuario)==1){
    echo "Usuario eliminado";
    $_SESSION['eliminado']=1;
    
    header("Location: prueba.php?usuarios=1");
}
else{
    
    
}



?>