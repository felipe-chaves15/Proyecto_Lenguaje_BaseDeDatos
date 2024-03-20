<?php
 
include_once('global.php');
 
include_once(CONTROLLERS_PATH . '/userController.php');
 
if (isset($_POST["errorMessage"]))
{
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}
 
$idTarea = isset($_GET['id_tarea']) ? $_GET['id_tarea'] : '';
$tituloTarea = isset($_GET['tituloTarea']) ? $_GET['tituloTarea'] : '';
$descripTarea = isset($_GET['descripTarea']) ? $_GET['descripTarea'] : '';

 
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
        <h4>Editar Tareas</h4>
        <p>
            <label for="tareaId">Tarea Id</label>
            <input class="controls" type="text" id="tareaId" name="tareaId" placeholder="Indique el id de la tarea" value="<?php echo htmlspecialchars($idTarea); ?>"/>
        </p>
        <p>
            <label for="new_tituloTarea">Titulo Tarea</label>
            <input class="controls" type="text" id="new_tituloTarea" name="new_tituloTarea" placeholder="Titulo de la tarea" value="<?php echo htmlspecialchars($tituloTarea); ?>"/>
        </p>
        <p>
            <label for="new_descripTarea">Descripcion de la tarea</label>
            <input class="controls" type="text" id="new_descripTarea" name="new_descripTarea" placeholder="Descripcion de la tarea" value="<?php echo htmlspecialchars($descripTarea); ?>"/>
        </p>
        <button class="boton-login" type="submit" id="editTarea" name="editTarea">Cambiar</button>      
    </form>        
</main>
 
        <aside class="sidebar"></aside>
 
    </body>
 
</html>