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
        <title>Registro de Proyecto</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Styles\register.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            .form-login {
            width: 400px;
            height: 610px;
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
        <h4>Formulario de Proyecto</h4>
        <p>
            <label for="nombre">Numero de Id</label>
            <input class="controls" type="text" id="proyectoId" name="proyectoId" placeholder="Escribe el numero de id" />
        </p>
        <p>
            <label for="nombre">Titulo de Proyecto</label>
            <input class="controls" type="text" id="titulo" name="titulo" placeholder="Escriba el titulo de tu proyecto" />
        </p>
        <p>
            <label for="email">Tareas del Proyecto</label>
            <input class="controls" type="text" id="tareas" name="tareas" placeholder="Indica las tareas del proyecto" />
        </p>
        <button  class="boton-login" type="submit" id="registerProject" name="registerProject">Register</button>
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