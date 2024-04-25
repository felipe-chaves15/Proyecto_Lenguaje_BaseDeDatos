<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Categorías</title>
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

        input[type="text"], input[type="number"], input[type="email"], input[type="tel"], textarea, button {
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
        <h1>CRUD Categorías</h1>

        <?php
        if (isset($_POST["successMessage"])) {
            echo '<script>alert("' . $_POST["successMessage"] . '");</script>';
        }
        ?>

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
            <label for="id_categoria_update">ID:</label>
            <input type="number" id="id_categoria_update" name="id_categoria_update" required>
            <label for="nuevo_nombre">Nuevo Nombre:</label>
            <input type="text" id="nuevo_nombre" name="nuevo_nombre" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Categoría</h2>
        <form method="post">
            <label for="id_categoria_delete">ID:</label>
            <input type="number" id="id_categoria_delete" name="id_categoria_delete" required>
            <button type="submit" name="eliminar">Eliminar</button>
        </form>

    </div>
</body>
</html>

<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

$conn = oci_connect('LENGDB_ADM', '1234', 'localhost/XE');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Function to insert a new category
function insertCategory($conn, $nombre)
{
    $stid = oci_parse($conn, 'BEGIN paquete_categorias.insertar_categoria(:id_categoria, :nombre); END;');
    oci_bind_by_name($stid, ':id_categoria', $id_categoria);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la inserción
    $_POST["successMessage"] = "Se insertó correctamente la categoría.";
}

// Function to update a category
function updateCategory($conn, $id_categoria, $nombre)
{
    $stid = oci_parse($conn, 'BEGIN paquete_categorias.actualizar_categoria(:id_categoria, :nombre); END;');
    oci_bind_by_name($stid, ':id_categoria', $id_categoria);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la actualización
    $_POST["successMessage"] = "Se actualizó correctamente la categoría.";
}

// Function to delete a category
function deleteCategory($conn, $id_categoria)
{
    $stid = oci_parse($conn, 'BEGIN paquete_categorias.eliminar_categoria(:id_categoria); END;');
    oci_bind_by_name($stid, ':id_categoria', $id_categoria);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la eliminación
    $_POST["successMessage"] = "Se eliminó correctamente la categoría.";
}

// Handle form submissions
if (isset($_POST['insertar'])) {
    insertCategory($conn, $_POST['nombre']);
}

if (isset($_POST['actualizar'])) {
    updateCategory($conn, $_POST['id_categoria_update'], $_POST['nuevo_nombre']);
}

if (isset($_POST['eliminar'])) {
    deleteCategory($conn, $_POST['id_categoria_delete']);
}

oci_close($conn);

?>