<?php
// Se incluye el archivo que contiene la función comprobarUsuario
require_once('baseDatos.php');

// Se obtienen los datos del formulario
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$res=comprobarUsuario($usuario, $clave);

// Se llama a la función comprobarUsuario para verificar si los datos son válidos
if ($res==1) {
    // Si los datos son válidos, se redirige al usuario a la página listadoProductos.php
    $_SESSION['usuario']=$usuario;
    header("Location: prueba.php");
    exit;
} else {
    // Si los datos son inválidos, se muestra un mensaje de error en la página index.php
    
    
    if($res==-1)
        $_SESSION['error_message']= "Usuario invalido. Por favor, intenta de nuevo.";
    elseif($res==-2)
        $_SESSION['error_message']= "Clave invalido. Por favor, intenta de nuevo.";
    elseif($res==-3)
        $_SESSION['error_message']= "Lo sentimos, en estos momentos su usuario no se encuentra en nuestra lista de administradores.";
    else
        $_SESSION['error_message']= "Error inesperado. Por favor, intentalo de nuevo";
     header("Location: index.php");
     exit;
}
?>
