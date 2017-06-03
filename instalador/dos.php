<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>INSTALADOR</title>
  </head>
  <body>
<?php
include '../usuarios/conexion.php';

$query1="CREATE TABLE `artista` (
  `ID_ARTISTA` int(5) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `GENERO` varchar(50) DEFAULT NULL,
  `DESCRIPCION` varchar(60000) DEFAULT NULL,
  `IMAGEN` varchar(100) DEFAULT NULL,
  `URL` varchar(100) DEFAULT NULL
)";

$result = $connection->query($query1);
              if (!$result) {
                 echo "Query Error";
               var_dump($query1);
            }


$query2="CREATE TABLE `asiste` (
  `ID_EVENTO` int(5) NOT NULL,
  `ID_ARTISTA` int(5) NOT NULL
)";

$result = $connection->query($query2);
              if (!$result) {
                 echo "Query Error";
               var_dump($query2);
            }

$query3="CREATE TABLE `compra` (
  `CORREO_ELECTRONICO` varchar(50) NOT NULL,
  `ID_EVENTO` int(5) NOT NULL,
  `NUMERO_ENTRADAS` int(3) DEFAULT NULL
)";

$result = $connection->query($query3);
              if (!$result) {
                 echo "Query Error";
               var_dump($query3);
               }


$query4="CREATE TABLE `eventos` (
  `ID_EVENTO` int(5) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `TIPO` varchar(50) DEFAULT NULL,
  `PRECIO` float NOT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `FECHA_INICIO` date DEFAULT NULL,
  `FECHA_FIN` date DEFAULT NULL,
  `ID_LUGAR` int(5) NOT NULL
)";

$result = $connection->query($query4);
              if (!$result) {
                 echo "Query Error";
               var_dump($query4);
               }


$query5="CREATE TABLE `lugar` (
  `ID_LUGAR` int(5) NOT NULL,
  `LOCALIDAD` varchar(50) NOT NULL,
  `PROVINCIA` varchar(50) DEFAULT NULL,
  `PAIS` varchar(50) DEFAULT NULL,
  `LATITUD` float(12,10) DEFAULT NULL,
  `LONGITUD` float(12,10) DEFAULT NULL
)";

$result = $connection->query($query5);
              if (!$result) {
                 echo "Query Error";
               var_dump($query5);
               }


$query6="CREATE TABLE `usuarios` (
  `CORREO_ELECTRONICO` varchar(50) NOT NULL,
  `PASSWD` varchar(64) NOT NULL,
  `FECHA_ALTA` date DEFAULT NULL,
  `EDAD` int(3) DEFAULT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `TIPO_USUARIO` tinyint(1) DEFAULT NULL,
  `TEMA` int(1) NOT NULL DEFAULT '1'
)";

$result = $connection->query($query6);
              if (!$result) {
                 echo "Query Error";
               var_dump($query6);
               }


$alt1="ALTER TABLE `artista`
  ADD PRIMARY KEY (`ID_ARTISTA`);";

  $result = $connection->query($alt1);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt1);
                 }

$alt2="ALTER TABLE `asiste`
  ADD PRIMARY KEY (`ID_EVENTO`,`ID_ARTISTA`),
  ADD KEY `asiste_ibfk_1` (`ID_ARTISTA`);";

  $result = $connection->query($alt2);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt2);
                 }


$alt3="ALTER TABLE `compra`
  ADD PRIMARY KEY (`CORREO_ELECTRONICO`,`ID_EVENTO`),
  ADD KEY `compra_ibfk_2` (`ID_EVENTO`);";

  $result = $connection->query($alt3);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt3);
                 }


$alt4="ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID_EVENTO`),
  ADD KEY `eventos_ibfk_1` (`ID_LUGAR`);";

  $result = $connection->query($alt4);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt4);
                 }


$alt5="ALTER TABLE `lugar`
  ADD PRIMARY KEY (`ID_LUGAR`);";

  $result = $connection->query($alt5);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt5);
                 }

$alt6="ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CORREO_ELECTRONICO`);";

  $result = $connection->query($alt6);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt6);
                 }

$alt7="ALTER TABLE `artista`
  MODIFY `ID_ARTISTA` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;";

  $result = $connection->query($alt7);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt7);
                 }

$alt8="ALTER TABLE `eventos`
  MODIFY `ID_EVENTO` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;";

  $result = $connection->query($alt8);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt8);
                 }

$alt9="ALTER TABLE `lugar`
  MODIFY `ID_LUGAR` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;";

  $result = $connection->query($alt9);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt9);
                 }


$alt10="ALTER TABLE `asiste`
  ADD CONSTRAINT `asiste_ibfk_1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `artista` (`ID_ARTISTA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asiste_ibfk_2` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE;";

  $result = $connection->query($alt10);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt10);
                 }


$alt11="ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`CORREO_ELECTRONICO`) REFERENCES `usuarios` (`CORREO_ELECTRONICO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE;";

  $result = $connection->query($alt11);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt11);
                 }


$alt12="ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`ID_LUGAR`) REFERENCES `lugar` (`ID_LUGAR`) ON DELETE CASCADE ON UPDATE CASCADE;";

  $result = $connection->query($alt12);
                if (!$result) {
                   echo "Query Error";
                 var_dump($alt12);

               }else{
                        header("Refresh:0; url=tres.php");
          }

 ?>


  </body>
</html>
