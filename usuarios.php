<?php

// Se ejecuta la consulta para obtener los productos
require_once('baseDatos.php');
if(isset($_SESSION['modificado'])&&$_SESSION['modificado']==1){
    echo"<br><h3>El usuario ha sido modificado con exito</h3>";
    $_SESSION['modificado']=0;
}

if(isset($_SESSION['modificado'])&&$_SESSION['modificado']==2){
    echo"<br><h3>El usuario no ha podido ser modificado</h3>";
    $_SESSION['modificado']=0;
}

if(isset($_SESSION['eliminado'])&&$_SESSION['eliminado']==1){
    echo "<br><h3>El usuario ha sido eliminado con exito</h3>";
    $_SESSION['eliminado']=0;
}

if(isset($_SESSION['baja'])&&$_SESSION['baja']==1){
    echo"<br><h3>El usuario ha sido dado de baja con exito</h3>";
    $_SESSION['baja']=0;
}

if(isset($_SESSION['alta'])&&$_SESSION['alta']==1){
    echo"<br><h3>El usuario ha sido dado de alta con exito</h3>";
    $_SESSION['alta']=0;
}

if(!isset($_SESSION['filtroUsuarios']) || $_SESSION['filtroUsuarios']==0){
    $resultados=obtenerUsuarios();
}
else if(isset($_SESSION['filtroUsuarios']) && $_SESSION['filtroUsuarios']!=0){
?>    
 <a href='#' onclick="Cargar('usuarios.php','miDiv')">Volver a todo el Listado</a><br>
 <?php    
 
    $resultados=filtrarUsuarios($_SESSION['estado'], $_SESSION['filtro2'], $_SESSION['valor']);
    $_SESSION['filtroUsuarios']=0;
    
}
else {
    $resultados=obtenerUsuarios();
}



echo "  <br>
        <h2>Filtrar por:</h2>
        <table>
        <tr>
            <td>
                <form method='post' action='filtrarUsuarios.php'>
                Estado:<select name='estado' id='estado'>
                    <option value='todos' selected>Todos</option>
                    <option value='1' >Activo</option>
                    <option value='0'>Inactivo</option>
                   </select>
                
                Filtro2: <select name='filtro2' id='filtro2'>
                    <option value='nada' selected>-</option>
                    <option value='usuario'>Usuario</option>
                    <option value='correo'>Mail</option>
                    <option value='nombre'>Nombre</option>
                    <option value='poblacion'>Poblacion</option>
                    <option value='provincia'>Provincia</option>
                    <option value='cp'>CP</option>
                   </select>
                <input type='text' id='valor' name='valor' value='null'></input>
                <input type='submit' value='Filtrar'>
                </form>

            </td>

        <tr>


      </table>";

echo "<table class='table'>
            <thead>
				<tr>
					
					<h1>Listado de usuarios</h1>
					
				</tr>
	          </thead>";
while($fila=mysqli_fetch_row($resultados)){
    echo "<tr>";
    if($fila[1]==1)
        echo "<td>  
                <form method='post' action='modificarUsuario.php'>
                <b>Estado:<select name='estado' id='estado'>
                <option value='activo' selected>Activo</option>
                <option value='inactivo'>Inactivo</option>
            </select>";
    else
        echo "<td>
                <form method='post' action='modificarUsuario.php'>
                <b>Estado:<select name='estado' id='estado'>
                <option value='activo' >Activo</option>
                <option value='inactivo' selected>Inactivo</option>
            </select>";
        if($fila[2]==1)
            echo "Admin:<select name='administrador' id='administrador'>
                <option value='si' selected>Admin</option>
                <option value='no'>No admin</option>
            </select>";
            else
                echo "Admin:<select name='administrador' id='administrador'>
                <option value='si' >Admin</option>
                <option value='no' selected>No admin</option>
            </select>";
            
                
    echo "User:<input type='text' id='usuario'  value='".$fila[3]."' name='usuario'  style='width : 5%; heigth : 80'></input>";
    echo "Mail:<input type='mail' id='correo'  value='".$fila[5]."' name='correo' style='width : 7%; heigth : 120'></input>";
    echo "Name:<input type='text' id='nombre'  value='".$fila[6]."' name='nombre'style='width : 4%; heigth : 80'></input>";
    echo "Surname:<input type='text' id='apellidos'  value='".$fila[7]."' name='apellidos'style='width : 5%; heigth : 80'></input>";
    echo "C/:<input type='text' id='domicilio'  value='".$fila[8]."' name='domicilio'style='width : 80px; heigth : 80'></input>";
    echo "Pobl:<input type='text' id='poblacion'  value='".$fila[9]."' name='poblacion'style='width : 80px; heigth : 80'></input>";
    echo "Prov:<input type='text' id='provincia'  value='".$fila[10]."' name='provincia'style='width : 80px; heigth : 80'></input>";
    echo "CP:<input type='number' id='cp'  value='".$fila[11]."' name='cp'style='width : 4%; heigth : 80'></input>";
    echo "TLF:<input type='number' id='tlf'  value='".$fila[12]."' name='tlf'style='width : 6.2%; heigth : 100'></input>";
    
    echo "<input id='codigo' hidden value='".$fila[0]."' name='codigo'>
         <input class='fondoAzul' type='submit' value='Actualizar Datos'>
        </form></td>";
    
    
    
    
    
    if($fila[1]==1){
        echo "<td>
            <form method='post' action='bajaUsuario.php'>
                <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                <input class='fondoNaranja'type='submit' value='Dar de baja'>
            </form>
            </td>";
    }
    else {
            echo "<td>
                <form method='post' action='altaUsuario.php'>
                    <input id='codigo' hidden value='".$fila[0]."' name='codigo'>
                    <input class='fondoVerde' type='submit' value='Dar de alta'>
                </form>
                </td>";
    }
    $pedidos=numeroPedidosUsuario($fila[0]);//funciona
    if($pedidos==0)
        echo "<td>
            <form method='post' action='eliminarUsuario.php'>
                <input  id='codigo' hidden value='".$fila[0]."' name='codigo'>
                <input class='fondoRojo' type='submit' value='Eliminar'>
            </form>
            </td>";
    else 
        echo "<td></td>";
  
    echo "</tr>";
    
}
echo "</table>";
mysqli_free_result($resultados);

?>