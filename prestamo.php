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

      date_default_timezone_set('America/Mexico_City');

      $fecha_actual = date("Y-m-d H:i:s");

      if($_SESSION['prestador']==false){
        header("location: home.php");
      }

        $id_libro = $_POST['id'];
        $titulo = $_POST['libro'];

      if(isset($_POST['nombre'])){  
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $domicilio = $_POST['domicilio'];
        $libro = $_POST['id_libro'];
  
        $consulta = "INSERT INTO `prestamos` (`id_prestamo`, `nombre`, `telefono`, `domicilio`, `fecha_inicio`, `estado_prestamo`, `fecha_fin`, `fk_id_libro`) 
        VALUES (NULL, '$nombre', '$telefono', '$domicilio', '$fecha_actual', 'Activo', NULL, '$libro')";
  
        $resultado = conectar()->query($consulta);

        $consulta2 = "UPDATE `libros` 
        SET `estado` = 'No disponible'
        WHERE `libros`.`id_libro` = $libro";

        $resultado = conectar()->query($consulta2);

        header("location: prestamos.php");

      }

      $consulta = "SELECT * FROM `prestamos`";

      $resultado = conectar()->query($consulta);

    ?>
    <header>
      <div class="navegacion"><a class="logo" href="#"><h1>Biblioteca Digital Ayotitlan</h1></a>
        <nav>
          <ul>
            <li><a href='home.php'>Regresar</a></li>
            <li><a href='salir.php'>Cerrar Sesion</a></li>
          </ul>
        </nav>
      </div>
    </header>
  <section class="content-agregar">
      <div class="agregar" style="width: 30%">
      <form action="#" method="POST">
          <div class="campo">
            <label for="nombre">Nombre del responsable<span>*</span>:</label>
            <input type="text" REQUIRED name="nombre" maxlength="80">
          </div>
          <div class="campo">
            <label for="telefono">Contacto<span>*</span>:</label>
            <input type="text" REQUIRED name="telefono" maxlength="10">
          </div>
          <div class="campo">
            <label for="domicilio">Domicilio<span>*</span>:</label>
            <input type="text" REQUIRED name="domicilio" maxlength="40">
          </div>
          <div class="campo">
            <label for="libro">Libro:</label>
            <input type="text" REQUIRED name="libro" DISABLED value="<?php echo $titulo ?>">
          </div>
          <input type="text" name="id_libro" value="<?php echo $id_libro ?>" style="visibility: hidden; height: 0;">
          <input type="text" name="agregado" value="agregado" style="visibility: hidden; height: 0;">
          <input class="btn-agregar" type="submit" value="Hacer Prestamo">
        </form>
      </div>
  </section>
  <script>
    <?php 
      if(isset($_POST['agregado'])){
        echo "alert('Prestamos hecho!');";
      }
    ?>
  </script>
  </body>
</html>