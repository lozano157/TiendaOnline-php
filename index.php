<?php
require_once("baseDatos.php");

if(isset($_SESSION['error_message'])){
    echo "", $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if(isset($_SESSION['codigo']))
    session_destroy();

?>

<html>

<head>

<title>Login Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/css.css">
  <link rel="stylesheet" href="./css/form.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
 <h1>Acceso a Administracion</h1>
 <h2>Introduzca sus datos</h2>
  <form class="form-horizontal" method="post" action="accesoUsuario.php" >
    <div class="form-group">
      <label class="control-label col-sm-2" for="usuario">Usuario*</label>
      <div class="col-sm-10">
        <input required type="text" class="form-control" id="usuario" placeholder="Nombre de Usuario" name="usuario">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Pass*</label>
      <div class="col-sm-10">          
        <input minlength="4" maxlength="16" type="password" required class="form-control" id="clave" placeholder="8-16 Caracteres" name="clave">
      </div>
    </div>
    
    <div class="form-group ">        
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-default fondoVerde" value="Entrar a Administracion"></input>
      </div>
    </div>
  </form>
</div>



</body>

</html>