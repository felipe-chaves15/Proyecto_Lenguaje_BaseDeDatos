
<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"]))
{
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

?>




<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="Styles\changePass.css">
    <title>Cambio de Contraseña</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <style>
            .form-login {
            width: 400px;
            height: 780px;
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
            <form  class="form-login" id="loginForm" name="loginForm"  method="post" autocomplete="off">        
                       <h4>Cambio de Contraseña</h4>
                    <p>
                    <label for="email">Email</label>
                    <input class="controls" type="email" id="email" name="email" placeholder="Correo Electrónico"/>
                    </p>
                    <br/>
                    <p>
                    <label for="password_Actual">Contraseña Actual</label>
                    <input class="controls" type="password" id="password_Actual" name="password_Actual" placeholder="Contraseña"/>
                    </p>
                    <br/>
                    <p>
                    <label for="password_New">Nueva Contraseña:</label>
                    <input class="controls" type="password" id="password_New" name="password_New" placeholder="Contraseña"/>
                    <p>
                    <br>
                    <label for="password_Confirm">Confirmar Nueva Contraseña:</label>
                    <input class="controls" type="password" name="password_Confirm" required>
                    <button class="boton-login" type="submit" id="password_Change" name="password_Change">Cambiar contrasena</button>      
            </form>        
        </main>
        <aside class="sidebar"></aside>

    </body>
</html>


</body>
</html>