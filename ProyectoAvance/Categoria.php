<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"])) {
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

$conn = oci_connect('LENGDB_ADM', '1234', 'localhost/XE');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Function to insert a new category
function insertCategory($conn, $nombre)
{
    $stid = oci_parse($conn, 'INSERT INTO CATEGORIAS (NOMBRE) VALUES (:nombre)');
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_execute($stid);
}

// Function to delete a category
function deleteCategory($conn, $id)
{
    $stid = oci_parse($conn, 'DELETE FROM CATEGORIAS WHERE ID_CATEGORIA = :id');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);
}

// Function to update a category
function updateCategory($conn, $id, $nombre)
{
    $stid = oci_parse($conn, 'UPDATE CATEGORIAS SET NOMBRE = :nombre WHERE ID_CATEGORIA = :id');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_execute($stid);
}

//Handle form submissions
if (isset($_POST['insertar'])) {
    insertCategory($conn, $_POST['nombre']);
}

if (isset($_POST['actualizar'])) {
    updateCategory($conn, $_POST['id'], $_POST['nombre']);
}

if (isset($_POST['eliminar'])) {
    deleteCategory($conn, $_POST['id']);
}


oci_close($conn);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Categoría</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"], input[type="number"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            color: #4caf50;
        }

        .error-message {
            text-align: center;
            margin-bottom: 20px;
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CRUD Categoría</h1>

        <!-- Formulario de inserción -->
        <h2>Insertar Categoría</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Categoría</h2>
        <form method="post">
            <label for="id">ID de la Categoría a actualizar:</label>
            <input type="number" id="id" name="id" required>
            <label for="nuevo-nombre">Nuevo Nombre:</label>
            <input type="text" id="nuevo-nombre" name="nombre" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Categoría</h2>
        <form method="post">
            <label for="id-eliminar">ID de la Categoría a eliminar:</label>
            <input type="number" id="id-eliminar" name="id" required>
            <button type="submit" name="eliminar">Eliminar</button>
        </form>

    </div>
</body>
</html>
