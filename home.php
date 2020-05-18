<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Biblioteca Digital Ayotitlan</title>
    <link rel="stylesheet" href="css/estilos.css"/>
  </head>
  <body>
    <?php
      include("conexion.php");

      session_start();
      
    ?>
    <header>
      <div class="navegacion"><a class="logo" href="#"><h1>Biblioteca Digital Ayotitlan</h1></a>
        <nav>
          <ul>
            <?php 
            $admin = false;
            $prestador = false;

            if(isset($_SESSION['rol'])){
              $rol = $_SESSION['rol'];
              
              if($rol == '1'){
                echo "<li><strong style='color: red;'>Administrador</strong></li>";
                echo "<li><a href='nuevo-usuario.php'>Registrar Usuario</a></li>";
                echo "<li><a href='agregar.php'>Agregar Libro</a></li>";
                echo "<li><a href='salir.php'>Cerrar Sesion</a></li>";
                $_SESSION['admin'] = true;
                $_SESSION['prestador'] = false;
                $admin = true;
              } else if($rol == '2') {
                $_SESSION['admin'] = false;
                $_SESSION['prestador'] = true;
                $prestador = true;
                echo "<li><strong style='color: red;'>Prestador</strong></li>";
                echo "<li><a href='prestamos.php'>Prestamos</a></li>";
                echo "<li><a href='salir.php'>Cerrar Sesion</a></li>";
              }
            } else {
                $_SESSION['admin'] = false;
                $_SESSION['prestador'] = false;
                echo "<li><a href='login.php'>Iniciar Sesion</a></li>";
              }
            ?>
          </ul>
        </nav>
      </div>
    </header>
    <?php
    if(isset($_POST['busqueda'])){  
      $validacion = $_POST['busqueda'];
    } else {
      $validacion = "";
    }
    ?>
    <div class="container-objetos">
      <div class="contenido">
        <div class="buscar">
          <form action="#" method="POST">
            <input class="campo-texto" type="text" name="busqueda" placeholder="Buscar libros..." value="<?php echo $validacion; ?>"/>
            <input class="btn" type="submit" value="Buscar"/>
          </form>
        </div>
        <div class="libros">
          <h2>Resultados de la busqueda</h2>
          <ul>
            <?php 
              $consulta = "SELECT * FROM `libros` WHERE `titulo` LIKE '%$validacion%'";

              $resultado = conectar()->query($consulta);

              while($fila = $resultado->fetch_assoc()){

                ?> 
                <li>
                  <div class="libro">
                    <img class="cover" src="data:image/jpg;base64,<?php echo base64_encode($fila['portada']); ?>" width="200"/>
                    <div class="datos">
                      <div class="titulo"><span>Titulo: </span><h2><?php echo $fila['titulo']; ?></h2></div>
                      <div class="detalles">
                        <div class="contenedor_detalles">
                            <div class="dato"><span>Autor: </span><p><?php echo $fila['autor']; ?></p></div>
                            <div class="dato"><span>Paginas: </span><p><?php echo $fila['paginas']; ?></p></div>
                            <div class="dato"><span>Genero: </span><p><?php echo $fila['genero']; ?></p></div>
                            <div class="dato"><span>Estado: </span><p><?php echo $fila['estado']; ?></p></div>
                          </div>
                        <div class="descripcion"><strong>Descripcion: </strong><p><?php echo $fila['descr']; ?></p></div>
                      </div>                  
                    </div>
                    <?php
                    if($admin){
                      echo '<div class="botones">
                      <ul>
                        <li><form action="editar.php" method="POST">
                          <input name="id" value="'; echo $fila['id_libro']; echo '" style="visibility: hidden;">
                          <input class="btn" type="submit" value="Editar">
                        </form></li>';
                        echo '<li><form action="eliminar.php" method="POST" onSubmit="return confirm('; echo "'Estas seguro que lo quieres eliminar?'"; echo ');">
                          <input name="id" value="'; echo $fila['id_libro']; echo '" style="visibility: hidden; height: 0;">
                          <input class="btn" type="submit" value="Eliminar">
                        </form></li>
                      </ul>
                    </div>';
                    } else if($prestador && $fila['estado'] == 'Disponible'){
                      echo '<div class="botones">
                      <ul>
                        <li><form action="prestamo.php" method="POST">
                          <input name="id" value="'; echo $fila['id_libro']; echo '" style="visibility: hidden;">
                          <input name="libro" value="'; echo $fila['titulo']; echo '" style="visibility: hidden;">
                          <input class="btn" type="submit" value="Prestar">
                        </form></li>';
                    }
                    ?>
                    </div>
                  </li>
                <?php
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <script>
      <?php
        if($_POST['eliminado'] == 'si'){
          echo "alert('Libro eliminado!');";
        }
      ?>
    </script>
  </body>
</html>