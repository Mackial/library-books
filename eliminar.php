<?php

include("conexion.php");

session_start();

if(isset($_POST['id'])){
  $id = $_POST['id'];

  $q = "DELETE FROM `libros` WHERE `libros`.`id_libro` = $id";

  $consulta = mysqli_query(conectar(), $q);

  header("location: home.php");

} else if (isset($_POST['id_usuario'])){
  $id = $_POST['id_usuario'];

  $q = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` = $id";

  $consulta = mysqli_query(conectar(), $q);

  header("location: usuarios.php");
}
?>