<?php

include_once('global.php');

include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"]))
{
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

$proyectoId = isset($_GET['proyectoId']) ? $_GET['proyectoId'] : '';
$tituloP = isset($_GET['tituloProyecto']) ? $_GET['tituloProyecto'] : '';
$tituloTarea = isset($_GET['tituloTarea']) ? $_GET['tituloTarea'] : '';
$descripTarea = isset($_GET['descripTarea']) ? $_GET['descripTarea'] : '';

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="Styles\changePass.css">
    <title>Agregar Tarea</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            .form-login {
    width: 400px;
    height: 750px;
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
        <h4>Agregar Tarea</h4>
        <p>
            <label for="proyectoId">ID del Proyecto</label>
            <input class="controls" type="text" id="proyectoId" name="proyectoId" placeholder="Indique el id de proyecto" value="<?php echo htmlspecialchars($proyectoId); ?>" readonly/>
        </p>
        <p>
            <label for="new_titulo">Titulo de Proyecto</label>
            <input class="controls" type="text" id="tituloProyecto" name="tituloProyecto" placeholder="Titulo del Proyecto" value="<?php echo htmlspecialchars($tituloP); ?>" readonly/>
        </p>
        <p>
            <label for="nombre">Titulo de Tarea</label>
            <input class="controls" type="text" id="tituloTarea" name="tituloTarea" placeholder="Escriba el titulo de la tarea" />
        </p>
        <p>
            <label for="nombre">Descripcion de Tarea</label>
            <input class="controls" type="text" id="descripcion" name="descripcion" placeholder="Especifique los requerimientos de la tarea" />
        </p>
        <button class="boton-login" type="submit" id="addTask" name="addTask">Agregar Tarea</button>       
    </form>        
</main>

        <aside class="sidebar"></aside>

    </body>

</html>