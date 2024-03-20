<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

// Asumiendo que ya has incluido la función CountUsers en tu código
$userCount = CountUsers();
$projectCount = CountActiveProjects();
$employeeCount = CountActiveEmployee();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/051495746a.js" crossorigin="anonymous"></script>

</head>
<body>



<div class="container mt-3 d-flex flex-column flex-md-row justify-content-around">
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header fa-solid fa-user"></div>
        <div class="card-body">
            <h5 class="card-title">Total de Usuarios Activos</h5>
            <p class="card-text"><?php echo $userCount; ?></p>
        </div>
    </div>

    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header fa-solid fa-book"></div>
        <div class="card-body">
            <h5 class="card-title">Total de Proyectos Activos</h5>
            <p class="card-text"><?php echo $projectCount; ?></p>
        </div>
    </div>

    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header fa-solid fa-handshake"></div>
        <div class="card-body">
            <h5 class="card-title">Total de Empleados Activos</h5>
            <p class="card-text"><?php echo $employeeCount; ?></p>
        </div>
    </div>
</div>



    
</body>
</html>