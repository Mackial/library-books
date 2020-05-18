<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="css/estilos.css"/>
  </head>
  <body>
    <?php
      session_start();

    ?>
    <section>
      <div class="contenedor">
        <div class="login">
          <div class="login-datos">
            <form action="loguear.php" method="POST">
            <p>Usuario</p>
            <input class="entrada" REQUIRED type="text" name="usuario">
            <p>Contraseña</p>
            <input class="entrada" REQUIRED type="password" name="clave">
            <div class="">
              <input class="login-btn" type="submit" value="Ingresar">
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      <?php 
        $da = $_SESSION['alert'];

        if($_SESSION['alert'] == "si"){
          echo "alert('Datos Incorrectos!');";
        }
       ?>
    </script>
  </body>
</html>