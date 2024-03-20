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
    <br>
    <p><a class="password-recovery" href="changePassword.php">Recuperar Contraseña</a></p>

</fieldset>
</form>

</body>
</html>
