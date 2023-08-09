<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');
var_dump($_POST);
// Se obtienen los datos del formulario
$usuario = $_POST['codigo'];


if(bajaUsuario($usuario)==1){
    echo "Usuario dado de baja";
    $_SESSION['baja']=1;
    
    header("Location: prueba.php?usuarios=1");
}
else{
    
    
}



?>