<?php

$host = "localhost";
$user = "root";
$pass = "";

$db = "magus";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    echo "coneccion fallida";
}

?>