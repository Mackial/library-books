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

      if(isset($_POST['id'])){
        $id = $_POST['id'];
      
        $consulta = "SELECT * FROM `libros` WHERE `id_libro` = $id";
    
        $resultado = conectar()->query($consulta);
    
        $fila = $resultado->fetch_assoc();
      }

      if(isset($_POST['titulo'])){  
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descripcion = $_POST['descripcion'];
        $paginas = $_POST['paginas'];
        $genero = $_POST['genero'];
        // $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
  
        $consulta = "UPDATE `libros` 
                    SET `titulo` = '$titulo', `autor` = '$autor', `descr` = '$descripcion', `paginas` = '$paginas', `genero` = '$genero'
                    WHERE `libros`.`id_libro` = $id";
  
        $resultado = conectar()->query($consulta);
      }

    ?>
    <header>
      <div class="navegacion"><a class="logo" href="#"><h1>Biblioteca Digital Ayotitlan</h1></a>
        <nav>
          <ul>
            <li><a href='home.php'>Buscar</a></li>
            <li><a href='salir.php'>Cerrar Sesion</a></li>
          </ul>
        </nav>
      </div>
    </header>
  <section class="content-agregar">
      <div class="agregar">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="campo">
            <label for="titulo">Titulo:</label>
            <input type="text" REQUIRED name="titulo" id="titulo" maxlenght="40" value="<?php echo $fila['titulo']; ?>">
          </div>
          <div class="campo">
            <label for="autor">Autor:</label>
            <input type="text" REQUIRED name="autor" id="autor" maxlenght="40" value="<?php echo $fila['autor']; ?>">
          </div>
          <div class="campo">
            <label for="descripcion">Descripcion:</label>
            <textarea type="text" REQUIRED name="descripcion" id="descripcion"><?php echo $fila['descr']; ?></textarea>
          </div>
          <div class="campo">
            <label for="paginas">No. paginas:</label>
            <input type="text" REQUIRED name="paginas" id="paginas" maxlenght="40" value="<?php echo $fila['paginas']; ?>">
          </div>  
          <div class="campo">
            <label for="genero">Genero:</label>
            <input type="text" REQUIRED name="genero" id="genero" maxlenght="40" value="<?php echo $fila['genero']; ?>">
          </div>
          <input type="text" name="id" value="<?php echo $fila['id_libro']; ?>" style="visibility: hidden; height: 0;">
          <input type="text" name="editado" value="editado" style="visibility: hidden; height: 0;">
          <input class="btn-agregar" type="submit" value="Actualizar">
        </form>
      </div>
  </section>
  <script>
    <?php
      if($_POST['editado'] == 'editado'){
        echo "alert('Se actualizo el libro!');";
        echo "location.href = 'home.php';";
      }
    ?>
  </script>
  </body>
</html>