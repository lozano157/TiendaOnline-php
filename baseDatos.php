<?php
session_start();
function abrirConexionBD(){
    
    $recurso=mysqli_connect("localhost:3307","root2","1234","daw");
    if(mysqli_connect_error()){
        printf("Error conectando a la base de datos: %s\n",mysqli_connect_error());
        return false;
    }
    
    $recurso->set_charset("utf8");
    return $recurso;
    
    
    
}

function cerrarConexionBD(&$recurso) {
    mysqli_close($recurso);
}

 
 function comprobarUsuario($usuario, $clave)
 {
     $recurso = abrirConexionBD();
     if ($recurso) {
        $resultados=0;
         //if($mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE usuario=? and clave =? and admin='1'"))
         if($mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE usuario=? ")){//comprobar si existe el usuario en la BBDD
                mysqli_stmt_bind_param($mi_consulta, "s", $usuario);
                mysqli_stmt_execute($mi_consulta);
                $resultados=mysqli_stmt_get_result($mi_consulta);
        
                if(mysqli_num_rows($resultados)>0){ //si existe el usuario se comprueba si existe la clave
                    mysqli_free_result($resultados);
                    $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE usuario=? and clave=? ");
                    mysqli_stmt_bind_param($mi_consulta, "ss", $usuario,$clave);
                    mysqli_stmt_execute($mi_consulta);
                    $resultados=mysqli_stmt_get_result($mi_consulta);
                    
                    if(mysqli_num_rows($resultados)>0){//si existe comprobamos si es admin
                        mysqli_free_result($resultados);
                        $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE usuario=? and clave=? and admin='1'");
                        mysqli_stmt_bind_param($mi_consulta, "ss", $usuario,$clave);
                        mysqli_stmt_execute($mi_consulta);
                        $resultados=mysqli_stmt_get_result($mi_consulta);
                        
                        if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
                            $fila=mysqli_fetch_row($resultados);
                            $_SESSION['codigo']=$fila[0];
                            $_SESSION['modificado']=0;
                            mysqli_free_result($resultados);
                            return 1;
                        }else{//el usuario no es admin
                            mysqli_free_result($resultados);
                            mysqli_stmt_close($mi_consulta);
                            return -3;
                        }
                    }
                    else{//si no existe devolvemos -2 e informamos que la clave es incorrecta
                        mysqli_free_result($resultados);
                        mysqli_stmt_close($mi_consulta);
                        return -2;
                    }
                }
                else{
                    mysqli_free_result($resultados);
                    mysqli_stmt_close($mi_consulta);
                    return -1;//no existe el usuario
                }
                  
         }
         
         
         
     }
     mysqli_free_result($resultados);
     mysqli_stmt_close($mi_consulta);
     return 0; //No se ha podido estableder conexion con la BBDD
 }
 
 function obtenerUsuarios(){
     $recurso=abrirConexionBD();
     $encontrado=false;
     if($recurso){
         $consulta="SELECT * FROM `usuarios`";
         $resultados=mysqli_query($recurso, $consulta);
         $_SESSION['prueba']=$resultados;
         return $resultados;
         
     }
     return $encontrado;
 }
 
 
 function datosUsuario($codigo){
    $recurso=abrirConexionBD();
     $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE codigo=? ");
     mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
     mysqli_stmt_execute($mi_consulta);
     
 }
 
 function numeroPedidosUsuario($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `pedidos` WHERE persona=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
             return 1;
         }
         
     }
     return 0;
     
 }
     
 
 function eliminarUsuario($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"DELETE FROM `usuarios` WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
     
 }
 
 
 function bajaUsuario($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"UPDATE `usuarios` SET activo='0' WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
     
 }
 
 function altaUsuario($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"UPDATE `usuarios` SET activo='1' WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
     
 }
     
 
 function obtenerProductos(){
     $recurso=abrirConexionBD();
     $encontrado=false;
     if($recurso){
         $consulta="SELECT * FROM `productos`";
         $resultados=mysqli_query($recurso, $consulta);
         return $resultados;
         
     }
     return $encontrado;
 }
 
 
 function actualizarProducto($codigo,$precio,$existencias,$descr,$imagen){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"UPDATE `productos` SET existencias=?,precio=?,descripcion=?,imagen=? WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "idssi",$existencias,$precio,$descr,$imagen, $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
 }
 
 function insertarProducto($descripcion,$precio,$existencias,$imagen){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"INSERT INTO `productos` VALUES (null,?,?,?,?) ");
         mysqli_stmt_bind_param($mi_consulta, "sdis",$descripcion,$precio,$existencias, $imagen);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
 }
 
 function obtenerPedidos(){
     $recurso=abrirConexionBD();
     $encontrado=false;
     if($recurso){
         $consulta="SELECT * FROM `pedidos`";
         $resultados=mysqli_query($recurso, $consulta);
         return $resultados;
         
     }
     return $encontrado;
 }
 
 function obtenerNombreUsuario($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `usuarios` WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
             return $resultados;
         }
         
     }
     return 0;
     
 }
 
 function obtenerDetallesProducto($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `detalle` WHERE codigo_pedido=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
             return $resultados;
         }
         
     }
     return null;
     
 }
 
 function obtenerProducto($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `productos` WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
             return $resultados;
         }
         
     }
     return 0;
     
 }
 function cerrarSesion(){
     session_destroy();
     header("Location: index.php");
     
 }
 
 
 
 function modificarUsuario($codigo,$estado,$administrador,$usuario,$correo,$nombre,$apellidos,$domicilio,$poblacion,$provincia,$cp,$tlf){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"UPDATE `usuarios` SET activo=?, admin=?, usuario=?, correo=?, nombre=?, apellidos=?, domicilio=?, poblacion=?, provincia=?, cp=?, telefono=? WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "iisssssssiii",$estado,$administrador,$usuario,$correo,$nombre,$apellidos,$domicilio,$poblacion,$provincia,$cp,$tlf, $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
 }
 
 
 
 function obtenerNombreEstado($codigo){
         $recurso=abrirConexionBD();
         if($recurso){
             $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `estados` WHERE codigo=? ");
             mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
             mysqli_stmt_execute($mi_consulta);
             $resultados=mysqli_stmt_get_result($mi_consulta);
             if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
                 $fila=mysqli_fetch_row($resultados);
                 return $fila[1];
             }
             
         }
         return 0;
         
     
     
     
 }
 
 function actualizarEstadoProducto($codigo,$estado){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"UPDATE `pedidos` SET estado=? WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "ii",$estado, $codigo);
         mysqli_stmt_execute($mi_consulta);
         return 1;
         
         
     }
     return 0;
     
 }
 
 
 
 function borrarDetalle($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `detalle` WHERE codigo_pedido=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){//el usuario existe y es admin
             while($fila=mysqli_fetch_row($resultados)){
                 $mi_consulta=mysqli_prepare($recurso,"UPDATE `productos` SET existencias=existencias+? WHERE codigo=? ");
                 mysqli_stmt_bind_param($mi_consulta, "ii",$fila[2], $fila[1]);
                 mysqli_stmt_execute($mi_consulta);
             }
             
         }
         
         return 1;
         
     }
     return 0;
     
     
     
     
 }
 
 
 
 function eliminarPedido($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"DELETE FROM `detalle` WHERE codigo_pedido=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         
         $mi_consulta=mysqli_prepare($recurso,"DELETE FROM `pedidos` WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         
         return 1;
         
         
     }
     return 0;
     
     
     
     
 }
 
 
 
 function filtrarUsuarios($estado,$filtro2,$valor){
     $recurso=abrirConexionBD();
     if($recurso){
         if($estado=="todos" && $filtro2!="nada" &&$valor!="null" ){
             $consulta="SELECT * FROM `usuarios` WHERE $filtro2='$valor' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($estado=="todos" && $filtro2=="nada" ){
             $consulta="SELECT * FROM `usuarios` ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($estado!="todos" && $filtro2!="nada" && $valor!="null"){
             $consulta="SELECT * FROM `usuarios` WHERE $filtro2='$valor' and activo='$estado'";
             $resultados=mysqli_query($recurso, $consulta);
             
         }
         else if($estado!="todos" && $filtro2=="nada" ){
             $consulta="SELECT * FROM `usuarios` WHERE activo='$estado'  ";
             $resultados=mysqli_query($recurso, $consulta);
             
         }
         else if($estado!="todos" && $filtro2!="nada" && $valor=="null" ){
             $consulta="SELECT * FROM `usuarios` WHERE activo='$estado'  ";
             $resultados=mysqli_query($recurso, $consulta);
             
         }
         else{
             $consulta="SELECT * FROM `usuarios` ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         
         
         $_SESSION['filtroUsuarios']= serialize($resultados);
         
         return $resultados;
         
         
     }
     return null;
     
     
     
 }
 
 
 
 function filtrarProductos ($existencias,$valor,$precio,$euros,$filtro2,$valor2){
     $recurso=abrirConexionBD();
     if($recurso){
         if($existencias=="todos" && $precio=="todos" && $filtro2=="nada"){
             $consulta="SELECT * FROM `productos` ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias=="todos" && $precio!="todos" && $filtro2=="nada"){
             $consulta="SELECT * FROM `productos` where precio$precio'$euros' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias=="todos" && $precio!="todos" && $filtro2!="nada"){
             $consulta="SELECT * FROM `productos` where precio$precio'$euros' and $filtro2='$valor2' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias=="todos" && $precio=="todos" && $filtro2!="nada"){
             $consulta="SELECT * FROM `productos` where $filtro2='$valor2' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias!="todos" && $precio=="todos" && $filtro2=="nada"){
             $consulta="SELECT * FROM `productos` where existencias$existencias'$valor' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias!="todos" && $precio!="todos" && $filtro2=="nada"){
             $consulta="SELECT * FROM `productos` where existencias$existencias'$valor' and precio$precio'$euros' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias!="todos" && $precio=="todos" && $filtro2!="nada"){
             $consulta="SELECT * FROM `productos` where existencias$existencias'$valor' and $filtro2='$valor2' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         else if($existencias!="todos" && $precio!="todos" && $filtro2!="nada"){
             $consulta="SELECT * FROM `productos` where existencias$existencias'$valor' and $filtro2='$valor2' and precio$precio'$euros' ";
             $resultados=mysqli_query($recurso, $consulta);
         }
        return $resultados;
     
     
    }
    return null;
 }
 
 
 
 function filtrarPedidos($fecha,$valor){
     $recurso=abrirConexionBD();
     if($recurso){
         if($fecha=="nada"){
             $consulta="SELECT * FROM `pedidos` ";
             $resultados=mysqli_query($recurso, $consulta);
         }
         elseif($fecha!="nada"){
                 $consulta="SELECT * FROM `pedidos` where fecha$fecha'$valor' ";
                 $resultados=mysqli_query($recurso, $consulta);
         
         
        }  
        return $resultados;
     
     }
     return null;
 }
 
 function detalleContieneProducto($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         $mi_consulta=mysqli_prepare($recurso,"SELECT * FROM `detalle` WHERE codigo_producto=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         $resultados=mysqli_stmt_get_result($mi_consulta);
         if(mysqli_num_rows($resultados)>0){
             return 1;
         }
         
     }
     return 0;
     
 }
 
 
 function eliminarProducto($codigo){
     $recurso=abrirConexionBD();
     if($recurso){
         
         $mi_consulta=mysqli_prepare($recurso,"DELETE FROM `productos` WHERE codigo=? ");
         mysqli_stmt_bind_param($mi_consulta, "i", $codigo);
         mysqli_stmt_execute($mi_consulta);
         
         return 1;
         
         
     }
     return 0;
     
     
     
     
 }
 
