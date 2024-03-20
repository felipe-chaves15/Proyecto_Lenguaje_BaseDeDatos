<?php

include_once('global.php');

include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"]))
{
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

$proyectoId = isset($_GET['project_id']) ? $_GET['project_id'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$horasTrabajadas = isset($_GET['horasTrabajadas']) ? $_GET['horasTrabajadas'] : '';

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="Styles\changePass.css">
    <title>Editar Proyecto</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            .form-login {
    width: 400px;
    height: 600px;
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
        <h4>Editar Proyecto</h4>
        <p>
            <label for="proyectoId">Proyecto Id</label>
            <input class="controls" type="text" id="proyectoId" name="proyectoId" placeholder="Indique el id de proyecto" value="<?php echo htmlspecialchars($proyectoId); ?>"/>
        </p>
        <p>
            <label for="new_titulo">Titulo</label>
            <input class="controls" type="text" id="new_titulo" name="new_titulo" placeholder="Titulo del Proyecto" value="<?php echo htmlspecialchars($titulo); ?>"/>
        </p>
        <p>
            <label for="new_horasTrabajadas">Total de horas Trabajadas</label>
            <input class="controls" type="text" id="new_horasTrabajadas" name="new_horasTrabajadas" placeholder="Total de horas trabajadas" value="<?php echo htmlspecialchars($horasTrabajadas); ?>"/>
        </p>
        <button class="boton-login" type="submit" id="editProyecto" name="editProyecto">Cambiar</button>       
    </form>        
</main>

        <aside class="sidebar"></aside>

    </body>

</html>


