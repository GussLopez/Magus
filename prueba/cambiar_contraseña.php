<?php
session_start();

$conexion = mysqli_connect('localhost', 'root','','magus');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contraseña = $_POST['contraseña'];
    $nueva_contraseña = $_POST['nueva-contraseña'];
    $confirmar_contraseña = $_POST['confirmar-contraseña'];

    // var_dump($_POST);
    // var_dump($_SESSION);

    // Validar que las nuevas contraseñas coincidan
    if ($nueva_contraseña !== $confirmar_contraseña) {
        $_SESSION['mensaje'] = "Las nuevas contraseñas no coinciden.";
        header("Location: index.php");
        exit();
    }

    // Incluir archivo de configuración para conectar a la base de datos
    include '../conexion.php';

    // Obtener el id del usuario autenticado desde la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Obtener la contraseña actual del usuario desde la base de datos
    $sql = "SELECT contraseña FROM usuarios WHERE id_usuario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        //var_dump($row);


        if($contraseña == $row['contraseña']){
            $sql_update = "UPDATE usuarios SET contraseña= '$nueva_contraseña' WHERE id_usuario= '$id_usuario'";
        $resultado = mysqli_query($conexion, $sql_update);
        }

        

        // Verificar que la contraseña actual es correcta
    //     if (password_verify($contraseña, $row['contraseña'])) {
    //         // Hash de la nueva contraseña
    //         $nueva_contraseña_hashed = password_hash($nueva_contraseña, PASSWORD_DEFAULT);

    //         // Preparar y ejecutar la consulta SQL para actualizar la contraseña
    //         $sql_update = "UPDATE usuarios SET contraseña=? WHERE id_usuario=?";
    //         $stmt_update = $conexion->prepare($sql_update);
    //         $stmt_update->bind_param("si", $nueva_contraseña_hashed, $id_usuario);

    //         if ($stmt_update->execute()) {
    //             $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";
    //         } else {
    //             $_SESSION['mensaje'] = "Error al actualizar la contraseña: " . $stmt_update->error;
    //         }

    //         // Cerrar la conexión del stmt_update
    //         $stmt_update->close();
    //     } else {
    //         $_SESSION['mensaje'] = "La contraseña actual no es correcta.";
    //     }
    // } else {
    //     $_SESSION['mensaje'] = "No se encontró el usuario.";
    // }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();

    //header("Location: index.php");
    exit();
      }
}