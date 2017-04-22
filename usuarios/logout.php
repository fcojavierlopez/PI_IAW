<?php
session_start();
unset ($SESSION['CORREO_ELECTRONICO']);
session_destroy();
header('Location:http://localhost:8080/proyecto_WEB/usuarios/index.html');
?>
