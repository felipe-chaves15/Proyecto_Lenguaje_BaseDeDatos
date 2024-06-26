<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Cliente</title>
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
        <h1>CRUD Cliente</h1>

        <?php
        if (isset($_POST["successMessage"])) {
            echo '<script>alert("' . $_POST["successMessage"] . '");</script>';
        }
        ?>

        <!-- Formulario de inserción -->
        <h2>Insertar Cliente</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>
            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="direccion" required></textarea>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Cliente</h2>
        <form method="post">
            <label for="id">ID del Cliente a actualizar:</label>
            <input type="number" id="id" name="id" required><label for="nuevo-nombre">Nuevo Nombre:</label>
            <input type="text" id="nuevo-nombre" name="nuevo-nombre" required>
            <label for="nuevo-apellido">Nuevo Apellido:</label>
            <input type="text" id="nuevo-apellido" name="nuevo-apellido" required>
            <label for="nuevo-correo">Nuevo Correo:</label>
            <input type="email" id="nuevo-correo" name="nuevo-correo" required>
            <label for="nuevo-telefono">Nuevo Teléfono:</label>
            <input type="tel" id="nuevo-telefono" name="nuevo-telefono" required>
            <label for="nueva-direccion">Nueva Dirección:</label>
            <textarea id="nueva-direccion" name="nueva-direccion" required></textarea>
            <label for="nueva-contrasena">Nueva Contraseña:</label>
            <input type="password" id="nueva-contrasena" name="nueva-contrasena" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Cliente</h2>
        <form method="post">
            <label for="id-eliminar">ID del Cliente a eliminar:</label>
            <input type="number" id="id-eliminar" name="id-eliminar" required>
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

// Function to insert a new client
function insertClient($conn, $nombre, $apellido, $correo, $telefono, $direccion, $password)
{
    $stid = oci_parse($conn, 'BEGIN paquete_clientes.insertar_cliente(:nombre, :apellido, :correo, :telefono, :direccion, :password); END;');
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':apellido', $apellido);
    oci_bind_by_name($stid, ':correo', $correo);
    oci_bind_by_name($stid, ':telefono', $telefono);
    oci_bind_by_name($stid, ':direccion', $direccion);
    oci_bind_by_name($stid, ':password', $password);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la inserción
    $_POST["successMessage"] = "Se añadieron exitosamente sus pedidos al carrito de compras";
}

// Function to update a client
function updateClient($conn, $id, $nombre, $apellido, $correo, $telefono, $direccion, $password)
{
    $stid = oci_parse($conn, 'BEGIN paquete_clientes.actualizar_cliente(:id, :nombre, :apellido, :correo, :telefono, :direccion, :password); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':apellido', $apellido);
    oci_bind_by_name($stid, ':correo', $correo);
    oci_bind_by_name($stid, ':telefono', $telefono);
    oci_bind_by_name($stid, ':direccion', $direccion);
    oci_bind_by_name($stid, ':password', $password);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la actualización
    $_POST["successMessage"] = "Cliente actualizado correctamente";
}

// Function to delete a client
function deleteClient($conn, $id)
{
    $stid = oci_parse($conn, 'BEGIN paquete_clientes.eliminar_cliente(:id); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la eliminación
    $_POST["successMessage"] = "Cliente eliminado correctamente";
}

// Handle form submissions
if (isset($_POST['insertar'])) {
    insertClient($conn, $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['telefono'], $_POST['direccion'], $_POST['password']);
}

if (isset($_POST['actualizar'])) {
    updateClient($conn, $_POST['id'], $_POST['nuevo-nombre'], $_POST['nuevo-apellido'], $_POST['nuevo-correo'], $_POST['nuevo-telefono'], $_POST['nueva-direccion'], $_POST['nueva-contrasena']);
}

if (isset($_POST['eliminar'])) {
    deleteClient($conn, $_POST['id-eliminar']);
}

oci_close($conn);

?>