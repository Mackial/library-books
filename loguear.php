<?php

include("conexion.php");

session_start();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$q = "SELECT COUNT(*) AS contar FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$q2 = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

$consulta = mysqli_query(conectar(), $q);
$consulta2 = mysqli_query(conectar(), $q2);

$array2 = mysqli_fetch_array($consulta2);

$array = mysqli_fetch_array($consulta);

if($array['contar']>0){
  $_SESSION['username'] = $usuario;
  $_SESSION['rol'] = $array2['fk_id_rol'];
  header("location: home.php");
} else {
  $_SESSION['alert'] = "si";
  header("location: login.php");
}

?>