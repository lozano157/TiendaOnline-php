<?php
require_once('baseDatos.php');

$codigo=$_POST["codigo"];
$estado = $_POST["estado"];


if($estado=="Entregado")
    $estado=3;
else if($estado=="Procesado")
        $estado=2;
else if($estado=="Enviado")
    $estado=1;
else if($estado=="Cancelado"){
    $estado=4;
    borrarDetalle($codigo);
}
if(actualizarEstadoProducto($codigo,$estado)==1)
    echo "Estado modificado";
    $_SESSION['modificado']=1;
    header("Location: prueba.php?pedidos=1");
        
?>
