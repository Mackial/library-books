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

      if(isset($_POST['titulo'])){  
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descripcion = $_POST['descripcion'];
        $paginas = $_POST['paginas'];
        $genero = $_POST['genero'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
  
        $consulta = "INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `descr`, `paginas`, `genero`, `estado`, `portada`) 
        VALUES (NULL, '$titulo', '$autor', '$descripcion', '$paginas', '$genero', 'Disponible', '$imagen')";
  
        $resultado = conectar()->query($consulta);

      }
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
      <div class="agregar">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="campo">
            <label for="titulo">Titulo<span>*</span>:</label>
            <input type="text" REQUIRED name="titulo" maxlenght="40">
          </div>
          <div class="campo">
            <label for="autor">Autor<span>*</span>:</label>
            <input type="text" REQUIRED name="autor" maxlenght="40">
          </div>
          <div class="campo">
            <label for="descripcion">Descripcion<span>*</span>:</label>
            <textarea type="text" REQUIRED name="descripcion" maxlenght="40"></textarea>
          </div>
          <div class="campo">
            <label for="paginas">No. paginas<span>*</span>:</label>
            <input type="text" REQUIRED name="paginas" maxlenght="40">
          </div>
          <div class="campo">
            <label for="genero">Genero<span>*</span>:</label>
            <input type="text" REQUIRED name="genero" maxlenght="40">
          </div>
          <div class="campo">
            <label for="portada">Portada<span>*</span>:</label>
            <input type="file" REQUIRED name="imagen" onchange="return validarImagen()">
          </div>
            <input type="text" name="agregado" value="agregado" style="visibility: hidden; height: 0;">
          <input class="btn-agregar" type="submit" value="Agregar">
        </form>
      </div>
  </section>
  <script>
    function validarImagen(){
      var input = document.getElementById('portada');
      var ruta = input.value;
      var tiposPermitidos = /(.jpg)$/i;

      if(!tiposPermitidos.exec(ruta)){
        alert('Solo se permiten imagenes con extencion jpg');
        input.value='';
        return false;
      }
    }
    <?php 
      if(isset($_POST['agregado'])){
        echo "alert('Libro agregado!');";
      }
    ?>
  </script>
  </body>
</html>