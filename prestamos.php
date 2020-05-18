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


      if(isset($_POST['prestamo'])){
        $id_prestamo = $_POST['prestamo'];
        $id_libro = $_POST['libro'];
        $q2 = "UPDATE `prestamos` SET `estado_prestamo` = 'Finalizado', `fecha_fin` = '$fecha_actual' 
            WHERE `prestamos`.`id_prestamo` = $id_prestamo";

        $q3 = "UPDATE `libros` SET `estado` = 'Disponible' WHERE `libros`.`id_libro` = $id_libro";

        $resultado = conectar()->query($q2);
        $resultado = conectar()->query($q3);
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
      <div class="agregar" style="width: 70%">
      <h1>Prestamos</h1>
      <table>
        <tr>
          <th>Responsable</th>
          <th>Contacto</th>
          <th>Domicilio</th>
          <th>Inicio Prestamo</th>
          <th>Estado</th>
          <th>Fin Prestamo</th>
          <th>Libro</th>
        </tr>
        <?php 
        while($fila = $resultado->fetch_assoc()){
        ?>
        <tr>
          <td><?php echo $fila['nombre']; ?></td>
          <td><?php echo $fila['telefono']; ?></td>
          <td><?php echo $fila['domicilio']; ?></td>
          <td><?php echo $fila['fecha_inicio']; ?></td>
          <td><?php echo $fila['estado_prestamo']; ?></td>
          <td><?php echo $fila['fecha_fin']; ?></td>
          <td><?php
            $id_libro = $fila['fk_id_libro'];
            $q = "SELECT * FROM libros WHERE id_libro = $id_libro"; 
            $libro = conectar()->query($q);
            $array = mysqli_fetch_array($libro);
            
            echo $array['titulo'];
           ?></td>
          <?php
          if($fila['estado_prestamo']=="Activo"){
            echo '<td style="text-align: center;">
            <form action="#" method="POST" onSubmit="return confirm('; echo "'Estas seguro en finalizar el prestamo?'"; echo ');">
              <input name="prestamo" value="'; echo $fila['id_prestamo']; echo '" style="visibility: hidden; height: 0; width: 0;">
              <input name="libro" value="'; echo $array['id_libro']; echo '" style="visibility: hidden; height: 0; width: 0;">
              <input class="btn" type="submit" value="Finalizar" style="border: 1px solid #fff">
            </form></td>';
          }
          ?>
        </tr>
        <?php } ?>
      </table>
      </div>
  </section>
  </body>
</html>