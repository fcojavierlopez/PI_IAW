<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

  </head>
  <body>





<?php
session_start();

include 'conexion.php';

//Comprobacion de login
if (isset($_POST['email'])) {


$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM usuarios WHERE CORREO_ELECTRONICO = '$email' AND PASSWD=md5('$password')";

$result = $connection->query($query);
$obj=$result->fetch_object();

if ($result->num_rows > 0) {


    $_SESSION['loggedin'] = true;
    $_SESSION['CORREO_ELECTRONICO'] = $email;
    $_SESSION['TIPO_USUARIO'] = $obj->TIPO_USUARIO;
    $_SESSION['NOMBRE'] = $obj->NOMBRE;


}
else {
  echo "Email o Contraseña son incorrectos.";

  echo "<br><a href='index.html'>Volver a Intentarlo</a>";
}

}
//TERmina comprobacion
//Comprobar que se esta intentando conectarse
if ($_SESSION['TIPO_USUARIO']==NULL) {
  header ("Location: index.html");
}

      header ("Location: home.php");
      /*echo "Bienvenido " .$_SESSION['NOMBRE'];
      echo "<br><br>";
      echo "Actualmente esta página está en construcción<br>";


      if ($_SESSION['TIPO_USUARIO']== '1') {

        echo "<br><a href='control_panel.php'>Edición</a>";
        echo "<br>";

      }*/

      //  echo "<br><br><a href=logout.php>Cerrar Sesión</a>";



 mysqli_close($connection);

 ?>
 <br><br>
<!-- <input type="button" class="btn btn-primary" value="Cerrar Sesión" onclick = "location='./logout.php'"/> -->
 <script src="../js/jquery.js"></script>
 <script src="../js/bootstrap.min.js"></script>
</body>
</html>
