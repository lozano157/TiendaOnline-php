<?php
require_once('baseDatos.php');

$codigo=$_POST["codigo"];



if(eliminarPedido($codigo)==1){
    echo "Pedido eliminado";
    $_SESSION['eliminado']=1;
    header("Location: prueba.php?pedidos=1");
    
}
                
?>