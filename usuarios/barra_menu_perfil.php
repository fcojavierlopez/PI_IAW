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

    if ($_SESSION['TIPO_USUARIO']==NULL) {
      header ("Location: index.html");
    }
    ?>
    <div class="container">
    <div class="row">
    <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Inicio</a></li>
                <li class="active"><a href="conciertos.php">Conciertos</a></li>
                <li class="active"><a href="festivales.php">Festivales</a></li>
                <li class="dropdown active">
                  <a data-toggle="dropdown" class="dropdown-toggle">Otros<b class="caret"></b></a>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="monologos.php">Monólogos</a></li>
                    <li><a href="musicales.php">Musicales</a></li>
                  </ul>
                </li>

            </ul>


            <ul class="nav navbar-nav navbar-right">
              <p class="navbar-text text-right"><?php echo $_SESSION['NOMBRE']; ?></p>

              <li class="active"><a href="logout.php">Cerrar Sesión</a></li>
            </ul>

            <form role="search" class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" placeholder="Search" class="form-control">
              </div>
            </form>
        </div>
      </nav>
    </div>
