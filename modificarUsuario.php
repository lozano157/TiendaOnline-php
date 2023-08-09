<?php
require_once('baseDatos.php');

$codigo=$_POST["codigo"];
$estado = $_POST["estado"];
$administrador=$_POST["administrador"];
$usuario=$_POST["usuario"];
$correo=$_POST["correo"];
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$domicilio=$_POST["domicilio"];
$poblacion=$_POST["poblacion"];
$provincia=$_POST["provincia"];
$cp=$_POST["cp"];
$tlf=$_POST["tlf"];




if($estado=="activo")
    $estado=1;
else
    $estado=0;

    
if($administrador=="si")
    $administrador=1;
else 
    $administrador=0;

if($usuario!=null && $usuario!="" && $correo!="" && $correo!=null ){
    if(modificarUsuario($codigo,$estado,$administrador,$usuario,$correo,$nombre,$apellidos,$domicilio,$poblacion,$provincia,$cp,$tlf)==1){
        echo "Usuario modificado";
        $_SESSION['modificado']=1;
        header("Location: prueba.php?usuarios=1");
    }
    else{//problema
        echo "Usuario no modificado";
        $_SESSION['modificado']=2;
        header("Location: prueba.php?usuarios=1");
            
    }
}

else{//valores en blanco
    echo "Usuario no modificado";
    $_SESSION['modificado']=2;
    header("Location: prueba.php?usuarios=1");
}