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
        <title>Administrar Usuarios</title>
        <meta charset="utf-8">

        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    </head>
    
    <body class="grid-container">
        
            <main class="main">
            <div class="container mt-4">
                <div class="d-flex justify-content-end mb-3">
                    <!-- Botón para agregar un nuevo usuario -->
                    <a class="btn btn-primary" href="<?= ROOT ?>/register.php">Nuevo Usuario</a>
                </div>
                <?php 
                
                bindUsers();
                if(isset($_POST["actionMessage"])) {
                    echo '<div class="alert alert-info">' . $_POST["actionMessage"] . '</div>';
                }
                ?>
            </div>  
        </main>

<script>
//Javascript para cargar valores al Modal



//JAvascript para Borrar valores
//Se puede ingresar usando un $ o usando JQuery
    function Delete(email) {
    $.ajax({
        url: "<?php echo ROOT; ?> /api/rest/userApi.php", 
        method: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: "delete=1&email=" + encodeURIComponent(email) 
    }).done(function(response) {
        const result = JSON.parse(response);
        if (result.success) {
            toastr.success("El usuario ha sido eliminado exitosamente.");
            setTimeout(function() {
                location.reload();
            }, 1000); // Retraso de 2 segundos antes de recargar
        } else {
            toastr.error(result.errorMessage);
        }
    });
    }

    </script>



    </body>
</html>





