<?php
    
    include_once('global.php');
    include_once(CONTROLLERS_PATH . '/userController.php');

    if (isset($_POST["errorMessage"]))
    {
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
    }
    #echo PATH;
    #echo VIEWS_PATH;

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="Styles/forms.css">
  <title>Login</title>
</head>
<body>
  <form class="form-login" id="loginForm" name="loginForm" method="post" autocomplete="off">
    <fieldset>
    <h4>Login</h4>
    <input type="email" name="email" id="email" class="controls"  placeholder="Ingrese su Correo" required>
    <input class="controls" type="password" name="password" id="password" placeholder="Ingrese su Contraseña" minlength="6" maxlength="12" required>
    <button id="login"  class="boton-login" name="login">Login</button>
    <p><a href= "register.php">¿No tienes Cuenta? Registrate</a></p>


</fieldset>
</form>

</body>
</html>


<?php


include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Realizar la conexión a la base de datos Oracle
    $conn = oci_connect('LENGDB_ADM', '1234', 'localhost/XE');

    // Verificar la conexión
    if (!$conn) {
        $errorMessage = oci_error();
        echo '<div class="alert">Error de conexión: ' . $errorMessage['message'] . '</div>';
    } else {
        // Consulta SQL para verificar el correo electrónico y la contraseña
        $sql = "SELECT * FROM CLIENTES WHERE CORREO = :email AND PASSWORD = :password";
        $stmt = oci_parse($conn, $sql);

        // Vincular parámetros
        oci_bind_by_name($stmt, ':email', $email);
        oci_bind_by_name($stmt, ':password', $password);

        // Ejecutar consulta
        $result = oci_execute($stmt);

        // Verificar si se encontró un usuario con el correo electrónico y la contraseña proporcionados
        if ($row = oci_fetch_assoc($stmt)) {
            // Autenticación exitosa, iniciar sesión y almacenar información del usuario en la sesión
            $_SESSION['user_id'] = $row['ID_CLIENTE'];
            $_SESSION['user_email'] = $row['CORREO'];
            
            // Redireccionar a la página principal
            header("Location: principal.php");
            exit();
        } else {
            // Autenticación fallida, mostrar mensaje de error
            echo '<div class="alert">Correo electrónico o contraseña incorrectos.</div>';
        }

        // Liberar recursos
        oci_free_statement($stmt);
        oci_close($conn);
    }
}
?>

