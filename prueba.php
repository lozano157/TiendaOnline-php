<?php 
require("baseDatos.php");
if (!isset($_SESSION['codigo'])) {
    // Se muestra el mensaje de error y luego se elimina de la sesión
    header("Location: index.php");
}
?>

<html lang="es">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="./css/css.css">
<script>
  function cerrarSesion() {
    // Realizar acciones de cierre de sesión aquí
    // Por ejemplo, redirigir a una página de cierre de sesión
    window.location.href = "cerrarSesion.php";
  }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script  src="./js/cargarPaginas.js"></script>
<script src="./js/libCapas2223.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<link rel="icon" type="image/png" href="../img/zapatillas.png" sizes="64x64">

<title>Zapatillas Admin</title>
</head>
<body onload="Cargar('inicio.html', 'miDiv')">

<div id="nav">
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
		
		<div class="container-fluid">
		
			<a class="navbar-brand" href="#" onclick="Cargar('inicio.html','miDiv')" > Inicio</a>
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarsExampleDefault">
				<span class="navbar-toggler-icon"></span>
			
			</button>
		
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav me-auto" >
				
							
				
				
					
					<li class="nav-item">
						<a class="nav-link active"  href="#" onclick="Cargar('productos.php','miDiv')"> Productos</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link active"  href="#" onclick="Cargar('usuarios.php','miDiv')"> Usuarios</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link active"  href="#" onclick="Cargar('pedidos.php','miDiv')"> Pedidos</a>
					</li>
					
					
					<li class="nav-item">
						<a href="#" class="nav-link active" onclick="cerrarSesion()">Cerrar Sesion</a>

					</li>
					
					
				</ul>
				
				
				
			</div>
			
		</div>
		
	</nav>
	</div>
	<br><br>
<div id="miDiv">
	
</div>


</body>
</html>