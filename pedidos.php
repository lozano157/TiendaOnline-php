<?php

// Se ejecuta la consulta para obtener los productos
require_once('baseDatos.php');

if(isset($_SESSION['modificado'])&&$_SESSION['modificado']==1){
    echo"<br><h3>El estado ha sido modificado con exito</h3>";
    $_SESSION['modificado']=0;
}

if(isset($_SESSION['eliminado'])&&$_SESSION['eliminado']==1){
    echo"<br><h3>El pedido ha sido eliminado con exito</h3>";
    $_SESSION['eliminado']=0;
}



if(!isset($_SESSION['filtroPedidos']) || $_SESSION['filtroPedidos']==0){
    $resultados=obtenerPedidos();
}
else if(isset($_SESSION['filtroPedidos']) && $_SESSION['filtroPedidos']!=0){
    ?>
 <a href='#' onclick="Cargar('pedidos.php','miDiv')">Volver a todo el Listado</a><br>
 <?php    
 
 $resultados=filtrarPedidos($_SESSION['fecha'],$_SESSION['valor']);
    $_SESSION['filtroPedidos']=0;
    
}
else {
    $resultados=obtenerPedidos();
}

echo "<br>";
echo "  
        <h2>Filtrar por fecha:</h2>
        <table>
        <tr>
            <td>
                 <form method='post' action='filtrarPedidos.php'>
                 <select name='fecha' id='fecha'>
                    <option value='nada' selected>-</option>
                    <option value='<' >Menor que</option>
                    <option value='>'>Mayor que</option>
                    <option value='='>Igual</option>
                  </select>
                <input type='date' id='valor' name='valor' ></input>
                <input type='submit' value='Filtrar'>
                </form>
    
            </td>
    
        <tr>
    
    
      </table>";


echo "<br>";
echo "<h1>Listado de pedidos</h1>";
echo "<table class='table'>
            <thead>
				<tr>
    
					<th>Codigo</th>
					<th>Usuario</th>
                    <th>Fecha</th>
                    <th>Productos</th>
					<th>Importe Total</th>
                    <th>Estado</th>
<th>Nuevo Estado</th>
                    <th></th>
				</tr>
	          </thead>";
while($fila=mysqli_fetch_row($resultados)){
    echo "<tr>";
    
                    echo "<td>$fila[0]</td>";
                    $datosUsuario=obtenerNombreUsuario($fila[1]);
                    $dato=mysqli_fetch_row($datosUsuario);
                    echo "<td>$dato[3]</td>";
                    echo "<td>$fila[2]</td>";
                    $detalles=obtenerDetallesProducto($fila[0]);
                    echo "<td>";
                    echo "<table>";
                    while($aux=mysqli_fetch_row($detalles)){
                        echo "<tr>";
                        $producto=mysqli_fetch_row(obtenerProducto($aux[1]));
                        echo "<td>Producto$producto[0], $producto[1]</td>";
                        echo "<td>Precio unitario: $aux[3]</td>";
                        echo "<td> Cantidad: $aux[2] </td>";
                        
                        echo "</tr>";
                        
                    }
                    echo"</table>";
                    echo "</td>";
                    
                    
                    echo "<td>$fila[3]</td>";
                    $estado=obtenerNombreEstado($fila[4]);
                    echo "<td>$estado</td>";
                    
                    if($estado=="Enviado")
                        echo "<td>
                             <form method='post' action='actualizarEstados.php'>
                                <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                                <select name='estado' id='estado'>
                                    <option value='Entregado' selected>Entregado</option>
                                    <option value='Cancelado'>Cancelado</option>
                                </select>
                                <br><input type='submit' value='Actualizar'>
                            </form>
                        </td>";
                        else if($estado=="Procesado"){//si estado = cancelado actualizar BBDD
                        echo "<td>
                             <form method='post' action='actualizarEstados.php'>
                                <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                                <select name='estado' id='estado'>
                                    <option value='Enviado' selected>Enviado</option>
                                    <option value='Entregado' >Entregado</option>
                                    <option value='Cancelado'>Cancelado</option>
                                </select>
                                <br><input type='submit' value='Actualizar'>
                            </form>
                        </td>";
                        }
                        
                    else 
                            echo "<td><h2>Ninguno</h2></td>";
                        
                    if($estado=="Cancelado"){ 
                        echo "<td>
                             <form method='post' action='eliminarPedido.php'>
                                <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                               
                                <br><input class='fondoRojo' type='submit' value='Eliminar Pedido'>
                            </form>
                        </td>";
                    }
                     
                    
                 
                    
                    
                    
                      echo "</tr>";
                            
}
echo "</table>";
mysqli_free_result($resultados);

?>
