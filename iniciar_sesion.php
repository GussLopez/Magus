<?php
session_start();
include('conexion.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    
    if (empty($email)) {
        header("Location: index.php?error=El correo es requerido");
        exit();
    } elseif (empty($password)) {
        header("Location: index.php?error=La contraseña es requerida");
        exit();
    } else {
        $sql = "SELECT * FROM usuarios WHERE Correo = ? AND Contraseña = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['Correo'] === $email && $row['Contraseña'] === $password) {
                // Almacenar id_usuario y otros datos en la sesión
                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['Nombre'] = $row['Nombre'];
                $_SESSION['Apellido'] = $row['Apellido'];
                $_SESSION['Correo'] = $row['Correo'];
                $_SESSION['Telefono'] = $row['Telefono'];
                
                // Redirigir al usuario a una página con su id_usuario en la URL
                header("Location: /Magus/inicio.php?id_usuario=" . $row['id_usuario']);
                exit();
            } else {
                header("Location: index.php?error=El correo o la contraseña son incorrectos");
                exit();
            }
        } else {
            header("Location: index.php?error=El correo o la contraseña son incorrectos");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
