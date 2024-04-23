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

// Function to insert a new product
function insertProduct($conn, $nombre, $descripcion, $cantidad, $precio, $idCategoria, $idMarca)
{
    $stid = oci_parse($conn, 'INSERT INTO PRODUCTOS (NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA) VALUES (:nombre, :descripcion, :cantidad, :precio, :idCategoria, :idMarca)');
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':descripcion', $descripcion);
    oci_bind_by_name($stid, ':cantidad', $cantidad);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':idCategoria', $idCategoria);
    oci_bind_by_name($stid, ':idMarca', $idMarca);
    oci_execute($stid);
}

// Function to delete a product
function deleteProduct($conn, $id)
{
    $stid = oci_parse($conn, 'DELETE FROM PRODUCTOS WHEREID_PRODUCTO =:id');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);
}

// Function to update a product
function updateProduct($conn, $id, $nombre, $descripcion, $cantidad, $precio, $idCategoria, $idMarca)
{
    $stid = oci_parse($conn, 'UPDATE PRODUCTOS SET NOMBRE = :nombre, DESCRIPCION = :descripcion, CANTIDAD = :cantidad, PRECIO = :precio, ID_CATEGORIA = :idCategoria, ID_MARCA = :idMarca WHERE ID_PRODUCTO = :id');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':nombre', $nombre);
    oci_bind_by_name($stid, ':descripcion', $descripcion);
    oci_bind_by_name($stid, ':cantidad', $cantidad);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':idCategoria', $idCategoria);
    oci_bind_by_name($stid, ':idMarca', $idMarca);
    oci_execute($stid);
}

//Handle form submissions
if (isset($_POST['insertar'])) {
    insertProduct($conn, $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio'], $_POST['idCategoria'], $_POST['idMarca']);
}

if (isset($_POST['actualizar'])) {
    updateProduct($conn, $_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio'], $_POST['idCategoria'], $_POST['idMarca']);
}

if (isset($_POST['eliminar'])) {
    deleteProduct($conn, $_POST['id']);
}

oci_close($conn);

?>

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

        input[type="text"], input[type="number"], textarea, button {
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

        <!-- Formulario de inserción -->
        <h2>Insertar Producto</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
            <label for="idCategoria">ID Categoría:</label>
            <input type="number" id="idCategoria" name="idCategoria" required>
            <label for="idMarca">ID Marca:</label>
            <input type="number" id="idMarca" name="idMarca" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Producto</h2>
        <form method="post">
            <label for="id">ID del Producto a actualizar:</label>
            <input type="number" id="id" name="id" required>
            <label for="nuevo-nombre">Nuevo Nombre:</label>
            <input type="text" id="nuevo-nombre" name="nombre" required>
            <label for="nuevo-descripcion">Nueva Descripción:</label>
            <textarea id="nuevo-descripcion" name="descripcion" required></textarea>
            <label for="nuevo-cantidad">Nueva Cantidad:</label>
            <input type="number" id="nuevo-cantidad" name="cantidad" required>
            <label for="nuevo-precio">Nuevo Precio:</label>
            <input type="number" id="nuevo-precio" name="precio" step="0.01" required>
            <label for="nuevo-idCategoria">Nuevo ID Categoría:</label>
            <input type="number" id="nuevo-idCategoria" name="idCategoria" required>
            <label for="nuevo-idMarca">Nuevo ID Marca:</label>
            <input type="number" id="nuevo-idMarca" name="idMarca" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Producto</h2>
        <form method="post">
            <label for="id-eliminar">ID del Producto a eliminar:</label>
            <input type="number" id="id-eliminar" name="id" required>
            <button type="submit" name="eliminar">Eliminar</button>
        </form>

    </div>
</body>
</html>