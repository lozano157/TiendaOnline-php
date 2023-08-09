<?php

// Se ejecuta la consulta para obtener los productos
require_once('baseDatos.php');

?>
<br>
<h3><a href='#' onclick="Cargar('formularioInsertar.html','miDiv')">Insertar nuevo producto</a></h3>
<?php
if(isset($_SESSION['modificado'])&&$_SESSION['modificado']==1){
    echo"<h3>El producto ha sido modificado con exito</h3>";
    $_SESSION['modificado']=0;
}

if(isset($_SESSION['eliminado'])&& $_SESSION['eliminado']==1){
    echo"<h3>El producto ha sido eliminado con exito</h3>";
    $_SESSION['eliminado']=0;
}

if(!isset($_SESSION['filtroProductos']) || $_SESSION['filtroProductos']==0){
    $resultados=obtenerProductos();
}
else if(isset($_SESSION['filtroProductos']) && $_SESSION['filtroProductos']!=0){
    ?>
 <a href='#' onclick="Cargar('productos.php','miDiv')">Volver a todo el Listado</a><br>
 <?php    
 
 $resultados=filtrarProductos($_SESSION['existencias'],$_SESSION['valor'], $_SESSION['precio'],$_SESSION['euros'], $_SESSION['filtro2'],$_SESSION['valor2']);
    $_SESSION['filtroProductos']=0;
    
}
else {
    $resultados=obtenerProductos();
}


echo "  <br>
        <h2>Filtrar por:</h2>
        <table>
        <tr>
            <td>
                <form method='post' action='filtrarProductos.php'>
                Existencias:<select name='existencias' id='existencias'>
                    <option value='todos' selected>Cualquiera</option>
                    <option value='<' >Menor que</option>
                    <option value='>'>Mayor que</option>
                    <option value='='>Igual</option>
                   </select>
                <input type='number' id='valor' name='valor' min='0' value='0'></input>
                <br>
                <form method='post' action='filtrarUsuarios.php'>
                Precio:<select name='precio' id='precio'>
                    <option value='todos' selected>Cualquiera</option>
                    <option value='<' >Menor que</option>
                    <option value='>'>Mayor que</option>
                    <option value='='>Igual</option>
                   </select>
                <input type='number' id='euros' name='euros' min='0' value='0'></input>
                <br>
                Filtro2: <select name='filtro2' id='filtro2'>
                    <option value='nada' selected>-</option>
                    <option value='codigo'>Codigo</option>
                    <option value='descripcion'>Descripcion</option>
                   </select>
                <input type='text' id='valor2' name='valor2' value='null'></input>
                <input type='submit' value='Filtrar'>
                </form>
    
            </td>
    
        <tr>
    
    
      </table>
<h1>Listado de productos</h1>
";
echo "<table class='table'>
            <thead>
				<tr>
    
					<th>Codigo</th>
					<th>Descripcion</th>
                    <th>Imagen</th>
					<th>Precio</th>
                    <th>Existencias</th>
                    <th>Nuevos valores</th>
                    <th></th>
				</tr>
	          </thead>";
while($fila=mysqli_fetch_row($resultados)){
    echo "<tr>";
    
                    echo "<td>$fila[0]</td>";
                    echo "<td>$fila[1]</td>";
                    echo "<td>$fila[4]</td>";
                    echo "<td>$fila[2]</td>";
                    echo "<td>$fila[3]</td>";
                   
                        echo "<td>
                    <form method='post' action='actualizarValores.php'>
                        <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                        Nueva descripcion: <br><input type='text'  id='descr'  value='".$fila[1]."' name='descr'></input><br>
                        Nuevo precio: <br><input type='number' min='0' id='precio'  value='".$fila[2]."' name='precio'></input><br>
                        Nuevas existencias:<br><input type='number' min='0' id='existencias'  value='".$fila[3]."' name='existencias'></input><br>
                        Nueva imagen: <br><input type='text'  id='imagen'  value='".$fila[4]."' name='imagen'></input><br>
                        <br><input class='fondoAzul' type='submit' value='Actualizar'>
                    </form>
                    </td>";
                        
                        if(detalleContieneProducto($fila[0])!=1){
                            echo "<td>
                                <form method='post' action='eliminarProducto.php'>
                                    <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                                    <br><input class='fondoRojo' type='submit' value='Eliminar Producto'>
                                </form>
                                </td>";
                            
                            
                        }else 
                            echo"<td></td>";
                    
                    
                    
                    
                      echo "</tr>";
                            
}
echo "</table>";
mysqli_free_result($resultados);

?>
