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

      if($_SESSION['admin']==false){
        header("location: home.php");
      }

      $consulta = "SELECT * FROM `usuarios`";

      $resultado = conectar()->query($consulta);
    ?>
    <header>
      <div class="navegacion"><a class="logo" href="#"><h1>Biblioteca Digital Ayotitlan</h1></a>
        <nav>
          <ul>
            <li><a href='nuevo-usuario.php'>Regresar</a></li>
            <li><a href='salir.php'>Cerrar Sesion</a></li>
          </ul>
        </nav>
      </div>
    </header>
  <section class="content-agregar">
      <div class="agregar" style="width: 70%">
      <table>
        <tr>
          <th>Usuario</th>
          <th>Clave</th>
          <th>Nombre</th>
          <th>Tipo de usuario</th>
          <th></th>
        </tr>
        <?php 
        while($fila = $resultado->fetch_assoc()){
        ?>
        <tr>
          <td><?php echo $fila['usuario']; ?></td>
          <td><?php echo $fila['clave']; ?></td>
          <td><?php echo $fila['nombre']; ?> <?php echo $fila['apellidos'] ?></td>
          <td><?php 
          if($fila['fk_id_rol'] == 1){ echo "Administrador"; } else { echo "Prestador"; } ?></td>
          <td style="text-align: center;">
            <form action="eliminar.php" method="POST" onSubmit="return confirm('Estas seguro que lo quieres eliminar?');">
              <input name="id_usuario" value="<?php echo $fila['id_usuario']; ?>" style="visibility: hidden; height: 0; width: 0;">
              <input class="btn" type="submit" value="Eliminar" style="border: 1px solid #fff">
            </form></td>
        </tr>
        <?php } ?>
      </table>
      </div>
  </section>
  </body>
</html>