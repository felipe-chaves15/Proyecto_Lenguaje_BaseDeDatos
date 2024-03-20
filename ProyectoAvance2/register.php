<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"])) {
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Usuario</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Styles\register.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            .form-login {
            width: 400px;
            height: 1010px;
            background: rgb(36, 33, 33);
            padding: 30px;
            margin: auto;
            margin-top: 100px;
            border-radius: 4px;
            font-family: 'calibri';
            color: white;
            box-shadow: 7px 13px 37px #000;
            }
        </style>

    </head>
    <body class="grid-container">
        <header class="header">
          
        </header>
        <navbar class="navbar"></navbar>
        <main class="main">
        <form class="form-login" id="registerForm" name="registerForm" method="post" autocomplete="off"  >
    <fieldset>
        <h4>Formulario de Registro</h4>
        <p>
            <label for="nombre">Nombre</label>
            <input class="controls" type="text" id="nombre" name="nombre" placeholder="Escriba su Nombre" />
        </p>
        <p>
            <label for="nombre">Apellidos</label>
            <input class="controls" type="text" id="apellidos" name="apellidos" placeholder="Escriba sus apellidos" />
        </p>
        <p>
    <label for="rol">Rol</label>
    <select class="controls" class="controls" id="rol" name="rol">
        <option value="usuario" id="rol" name="rol" >Usuario</option>
        <option value="administrativo" id="rol" name="rol" >Administrativo</option>
    </select>
</p>
        <p>
            <label for="email">Email</label>
            <input class="controls" type="email" id="email" name="email" placeholder="Correo Electrónico" />
        </p>
        <p>
            <label for="register_password">Password</label>
            <input class="controls" type="password" id="register_password" name="register_password" placeholder="Contraseña" />
        </p>
        <p>
            <label for="confirm_password">Confirm Password</label>
            <input class="controls" type="password" id="confirm_password" name="confirm_password" placeholder="Contraseña" />
        </p>
        <button  class="boton-login" type="submit" id="register" name="register">Register</button>
    </fieldset>
</form>
        </main>
        <aside class="sidebar"></aside>

    </body>
</html>


<script type="text/javascript">
    $(document).ready(function() {
        $("#registerForm").validate();
        rules: {
                email: {
                    required: true;
                };
                register_password: {
                    required: true;
                    minlength: 6;
                    maxlength: 12
                };
                confirm_password: {
                    required: true;
                    minlength: 6;
                    maxlength: 12
                    equalTo: "password"
                }
            };
            //JSON anotacion para describir objetos
            messages: {
                email: {
                    required: "El correo electronico es obligatorio."
                };
                password: {
                    required: "La clave es obligatoria.";
                    minlength: "La clave debe de tener al menos 6 caracteres";
                    maxlength: "La clave ni debe de exceder los 12 caracteres"
                };
                confirm_password: {
                    required: "La confirmacion de la contraseña es obligatoria.";
                    minlength: "La confirmacion de la contraseña debe de tener al menos 6 caracteres";
                    maxlength: "La confirmacion de la contraseña no debe de exceder los 12 caracteres";
                    equalTo: "La confirmacion de la contraseña debe de ser igual a la contraseña "
                };
            }
    });
</script>