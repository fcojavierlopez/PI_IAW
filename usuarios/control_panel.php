<?php
session_start();
// Para comprobar que sigo manteniendo la sesión -> var_dump($_SESSION);

if ($_SESSION['TIPO_USUARIO']==NULL) {
  header ("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>G&E - Panel de Control</title>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<style>
    body {
        background-image: url("../img/fondo_login_5.jpg");
        background-color: #cccccc;
        background-size: 100%;
        background-repeat: no-repeat;
        overflow-x: hidden;
      }
      /*label {
        color: white;
      }*/
</style>

<body>
  <div class="container">
  <header class="jumbotron">

    <h3 class="text-center">Panel de Control - Administrador</h3>

</header>

<div class="container-fluid">
</div>
</div>
<br/>
<div class="col-sm-offset-4 col-sm-10">
<h3>EDICIÓN</h3>

  <ul>
  <li><a href="../administrador/editar_usuario.php">Usuarios</a></li>
  <li><a href="../artistas/editar_artista.php">Artistas</a></li>
  <li><a href="../eventos/editar_eventos.php">Eventos</a></li>
  <li><a href="../localidades/editar_localidades.php">Localidades</a></li>
  <li><a href="../asiste/editar_asiste.php">Asistencias</a></li>
  <li><a href="../compra/editar_compra.php">Compras</a></li>
</ul>

<br><br>

<!-- <a href='login.php'>Volver a Inicio</a> -->

<br><br>

<input type="button" class="btn btn-primary" value="Volver a Inicio" onclick = "location='./login.php'"/>
<input type="button" class="btn btn-primary" value="Cerrar Sesión" onclick = "location='./logout.php'"/>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
