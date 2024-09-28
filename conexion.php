<?php

$host = "localhost";
$user = "root";
$pass = "123456789";

$db = "magus";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    echo "coneccion fallida";
}

?>