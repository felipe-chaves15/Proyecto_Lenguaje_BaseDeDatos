<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Producto</title>
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
        <h1>CRUD Producto</h1>

        <?php
        if (isset($_POST["successMessage"])) {
            echo '<script>alert("' . $_POST["successMessage"] . '");</script>';
        }
        ?>

        <!-- Formulario de inserción -->
        <h2>Insertar Producto</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>
            <label for="id_categoria">Categoría:</label>
            <input type="number" id="id_categoria" name="id_categoria" required>
            <label for="id_marca">Marca:</label>
            <input type="number" id="id_marca" name="id_marca" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Producto</h2>
        <form method="post">
            <label for="id">ID del Producto a actualizar:</label>
            <input type="number" id="id" name="id" required><label for="nuevo-nombre">Nuevo Nombre:</label>
            <input type="text" id="nuevo-nombre" name="nuevo-nombre" required>
            <label for="nuevo-descripcion">Nueva Descripción:</label>
            <input type="text" id="nuevo-descripcion" name="nuevo-descripcion" required>
            <label for="nuevo-cantidad">Nueva Cantidad:</label>
            <input type="number" id="nuevo-cantidad" name="nuevo-cantidad" required>
            <label for="nuevo-precio">Nuevo Precio:</label>
            <input type="number" id="nuevo-precio" name="nuevo-precio" required>
            <label for="nuevo-id_categoria">Nueva Categoría:</label>
            <input type="number" id="nuevo-id_categoria" name="nuevo-id_categoria" required>
            <label for="nuevo-id_marca">Nueva Marca:</label>
            <input type="number" id="nuevo-id_marca" name="nuevo-id_marca" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Producto</h2>
        <form method="post">
            <label for="id-eliminar">ID del Producto a eliminar:</label>
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

// Function to insert a new product
function insertProduct($conn, $nombre, $descripcion, $cantidad, $precio, $id_categoria, $id_marca)
{
    $stid = oci_parse($conn, 'BEGIN paquete_productos.insertar_producto(:nombre, :descripcion, :cantidad, :precio, :id_categoria, :id_marca); END;');
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':descripcion', $descripcion);
    oci_bind_by_name($stid, ':cantidad', $cantidad);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':id_categoria', $id_categoria);
    oci_bind_by_name($stid, ':id_marca', $id_marca);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la inserción
    $_POST["successMessage"] = "Se añadieron exitosamente sus pedidos al carrito de compras";
}

// Function to update a product
function updateProduct($conn, $id, $nombre, $descripcion, $cantidad, $precio, $id_categoria, $id_marca)
{
    $stid = oci_parse($conn, 'BEGIN paquete_productos.actualizar_producto(:id, :nombre, :descripcion, :cantidad, :precio, :id_categoria, :id_marca); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':descripcion', $descripcion);
    oci_bind_by_name($stid, ':cantidad', $cantidad);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':id_categoria', $id_categoria);
    oci_bind_by_name($stid, ':id_marca', $id_marca);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la actualización
    $_POST["successMessage"] = "Producto actualizado correctamente";
}

// Function to delete a product
function deleteProduct($conn, $id)
{
    $stid = oci_parse($conn, 'BEGIN paquete_productos.eliminar_producto(:id); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);

    // Enviar mensaje de éxito después de la eliminación
    $_POST["successMessage"] = "Producto eliminado correctamente";
}

// Handle form submissions
if (isset($_POST['insertar'])) {
    insertProduct($conn, $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio'], $_POST['id_categoria'], $_POST['id_marca']);
}

if (isset($_POST['actualizar'])) {
    updateProduct($conn, $_POST['id'], $_POST['nuevo-nombre'], $_POST['nuevo-descripcion'], $_POST['nuevo-cantidad'], $_POST['nuevo-precio'], $_POST['nuevo-id_categoria'], $_POST['nuevo-id_marca']);
}

if (isset($_POST['eliminar'])) {
    deleteProduct($conn, $_POST['id-eliminar']);
}

oci_close($conn);

?>