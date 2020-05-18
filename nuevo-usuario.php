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

      if(isset($_POST['usuario'])){  
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $rol = $_POST['rol'];


        $consulta = "INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `nombre`, `apellidos`, `fk_id_rol`) 
                    VALUES (NULL, '$usuario', '$password', '$nombre', '$apellido', '$rol')";
  
        $resultado = conectar()->query($consulta);
      }
    ?>
    <header>
      <div class="navegacion"><a class="logo" href="#"><h1>Biblioteca Digital Ayotitlan</h1></a>
        <nav>
          <ul>
            <li><a href='usuarios.php'>Eliminar Usuario</a></li>
            <li><a href='home.php'>Regresar</a></li>
            <li><a href='salir.php'>Cerrar Sesion</a></li>
          </ul>
        </nav>
      </div>
    </header>
  <section class="content-agregar">
      <div class="agregar">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="campo">
            <label for="usuario">Usuario<span>*</span>:</label>
            <input type="text" REQUIRED name="usuario" maxlenght="40">
          </div>
          <div class="campo">
            <label for="password">Contraseña<span>*</span>:</label>
            <input type="password" REQUIRED name="password" maxlenght="40">
          </div>
          <div class="campo">
            <label for="nombre">Nombre<span>*</span>:</label>
            <input type="text" REQUIRED name="nombre" maxlenght="40">
          </div>
          <div class="campo">
            <label for="apellido">Apellidos<span>*</span>:</label>
            <input type="text" REQUIRED name="apellido" maxlenght="40">
          </div>
          <?php
          $q = "SELECT * FROM roles_usuarios";

          $respuesta = conectar()->query($q);
          ?>
          <div class="campo">
            <label for="rol">Tipo de usuario<span>*</span>:</label>
            <select type="text" REQUIRED name="rol" maxlenght="40">
              <?php 
              while($fila = $respuesta->fetch_assoc()){
              ?>
              <option value="<?php echo $fila['id_rol'];?>"><?php echo $fila['rol'];?></option>
              <?php } ?>
            </select>
          </div>
          <input type="text" name="agregado" value="agregado" style="visibility: hidden; height: 0;">
          <input class="btn-agregar" type="submit" value="Agregar">
        </form>
      </div>
  </section>
  <script>
    <?php 
      if(isset($_POST['agregado'])){
        echo "alert('Usuario agregado!');";
      }
    ?>
  </script>
  </body>
</html>