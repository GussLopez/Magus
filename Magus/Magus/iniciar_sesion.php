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
        // Consulta de usuario
        $Sql = "SELECT * FROM usuarios WHERE Correo = '$email' AND Contraseña='$password'";
        $result = mysqli_query($conexion, $Sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['Correo'] === $email && $row['Contraseña'] === $password) {
                $_SESSION['Usuario'] = $row['Usuario'];
                $_SESSION['Nombre'] = $row['Nombre'];
                $_SESSION['Apellido'] = $row['Apellido'];
                $_SESSION['Correo'] = $row['Correo'];
                $_SESSION['Telefono'] = $row['Telefono'];
                header("Location: /Magus/inicio.php");
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
