<?php
include 'conexion.php';

// Verificar si se ha proporcionado un token
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Preparar la consulta para verificar el token
    $consulta = "SELECT id_usuario FROM tokens_restablecimiento WHERE token = ? AND fecha_expiracion > NOW()";  
    if ($stmt = $conexion->prepare($consulta)) {
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // El token es válido, mostrar el formulario de restablecimiento de contraseña
            if (isset($_POST['restablecer'])) {
                $nueva_contraseña = $_POST['nueva_contraseña'];
                $id_usuario = null;

                $stmt->bind_result($id_usuario);
                $stmt->fetch();

                // Actualizar la contraseña
                $consulta_update = "UPDATE usuarios SET Contraseña = ? WHERE id_usuario = ?";
                if ($stmt_update = $conexion->prepare($consulta_update)) {
                    $stmt_update->bind_param('si', $nueva_contraseña, $id_usuario);
                    $stmt_update->execute();

                    if ($stmt_update->affected_rows > 0) {
                        echo '<p class="token">Contraseña restablecida exitosamente.</p>';
                    } else {
                        echo '<p class="token">Error al restablecer la contraseña.</p>';
                    }
                    
                    $stmt_update->close();
                } else {
                    echo '<p class="token">Error al preparar la consulta para actualizar la contraseña.</p>';
                }
                
                // Eliminar el token después de usarlo
                $consulta_delete = "DELETE FROM tokens_restablecimiento WHERE token = ?";
                if ($stmt_delete = $conexion->prepare($consulta_delete)) {
                    $stmt_delete->bind_param('s', $token);
                    $stmt_delete->execute();
                    $stmt_delete->close();
                } else {
                    echo '<p class="token">Error al preparar la consulta para eliminar el token.</p>';
                }
            }
        } else {
            echo '<p class="token">Token inválido o expirado.</p>';
        }

        $stmt->close();
    } else {
        echo '<p class="token">Error al preparar la consulta para verificar el token.</p>';
    }

    $conexion->close();
} else {
    echo '<p class="token">Token no proporcionado.</p>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body{
            font-family: "Lato", sans-serif;
            display: flex;
            flex-flow: column;
            justify-content: center;
        }

        .form-container{
            display: flex;
            flex-flow: column;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
            border: solid 2px gainsboro;
            height: 400px;
            padding: 50px;
            border-radius: 10px;
        }
        h2{
            margin-bottom: 50px;
        }

        input{
            display: flex;
            margin-top: 10px;
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border: solid 1px gray;
        }

        button{
            display: flex;
            margin-top: 40px;
            padding: 10px;
            color: white;
            background-color: #ff3700;
            border-radius: 5px;
            border: 0;
            font-size: 14px;
            cursor: pointer;
            transition: all ease-in-out .3s;
        }

        button:hover{
            background-color: #ff3900;
        }

        a{
            display: flex;
            text-align: center;
            color: #ff3700;
            text-decoration: none;
            margin-top: 20px;
        }
        a:hover{
            text-decoration: underline;
        }

        .token{
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Recuperar Contraseña</h2>
        <form action="" method="POST">
            <label for="nueva_contraseña">Nueva contraseña:</label> 
            <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>
            <button type="submit" name="restablecer">Restablecer Contraseña</button>
        </form>
        <a href="index.php">Iniciar sesión</a>
    </div>
</body>
</html>
