<?php

include_once('global.php');

include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"]))
{
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}


$email = isset($_GET['employee_id']) ? $_GET['employee_id'] : '';
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
$tarea_proyecto = isset($_GET['tarea_proyecto']) ? $_GET['tarea_proyecto'] : '';
       

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="Styles\changePass.css">
    <title>Editar Empleado</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
             .form-login {
                width: 400px;
                height: 720px;
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
    <form class="form-login" id="loginForm" name="loginForm" method="post" autocomplete="on">        
        <h4>Editar Empleado</h4>
        <p>
            <label for="email">Email</label>
            <input class="controls" type="email" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($email); ?>"/>
        </p>
        <p>
            <label for="new_nombre">Nombre</label>
            <input class="controls" type="text" id="new_nombre" name="new_nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre); ?>"/>
        </p>
        <p>
            <label for="new_apellido">Apellidos</label>
            <input class="controls" type="text" id="new_apellido" name="new_apellido" placeholder="Apellido" value="<?php echo htmlspecialchars($apellido); ?>"/>
        </p>
        <button class="boton-login" type="submit" id="editEmpleado" name="editEmpleado">Cambiar</button>       
    </form>        
</main>
        <aside class="sidebar"></aside>

    </body>

</html>


