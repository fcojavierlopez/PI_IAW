<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body>
      <?php
      include '../usuarios/conexion.php';
$usuario=$_GET['usuario'];

if ($result = $connection->query("UPDATE usuarios SET `TEMA` = '2' WHERE CORREO_ELECTRONICO ='$usuario';"))
   {
  header ("Location: ../usuarios/home.php");
} else {

      echo "Error: " . $result . "<br>" . mysqli_error($connection);
}

unset($connection);
?>

       ?>
      <script type="text/javascript" src=" "></script>
    </body>
</html>
