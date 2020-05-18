<?php
  function conectar(){
    $host='localhost';
		$user='root';
		$password='';
    $db='bibliote_prueba';
    $con = mysqli_connect($host, $user, $password, $db);
    // mysqli_set_charset($con, 'utf8');
    // mysqli_select_db($db, $con);

    return $con;
  }
?>