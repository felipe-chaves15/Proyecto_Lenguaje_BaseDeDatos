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

// Function to insert a new invoice
function insertInvoice($conn, $fecha_factura, $total, $precio, $id_pedido)
{
    $stid = oci_parse($conn, 'INSERT INTO FACTURAS (FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO) VALUES (TO_DATE(:fecha_factura, \'YYYY-MM-DD\'), :total, :precio, :id_pedido)');
    oci_bind_by_name($stid, ':fecha_factura', $fecha_factura);
    oci_bind_by_name($stid, ':total', $total);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':id_pedido', $id_pedido);
    oci_execute($stid);
}

// Function to delete an invoice
function deleteInvoice($conn, $id)
{
    $stid = oci_parse($conn, 'DELETE FROM FACTURAS WHERE ID_FACTURA = :id');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);
}

// Function to update an invoice
function updateInvoice($conn, $id, $fecha_factura,$total, $precio, $id_pedido)
{
    $stid = oci_parse($conn, 'UPDATE FACTURAS SET FECHA_FACTURA = TO_DATE(:fecha_factura, \'YYYY-MM-DD\'), TOTAL = :total, PRECIO = :precio, ID_PEDIDO = :id_pedido WHERE ID_FACTURA = :id');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':fecha_factura', $fecha_factura);
    oci_bind_by_name($stid, ':total', $total);
    oci_bind_by_name($stid, ':precio', $precio);
    oci_bind_by_name($stid, ':id_pedido', $id_pedido);
    oci_execute($stid);
}

//Handle form submissions
if (isset($_POST['insertar'])) {
    insertInvoice($conn, $_POST['fecha_factura'], $_POST['total'], $_POST['precio'], $_POST['id_pedido']);
}

if (isset($_POST['actualizar'])) {
    updateInvoice($conn, $_POST['id'], $_POST['fecha_factura'], $_POST['total'], $_POST['precio'], $_POST['id_pedido']);
}

if (isset($_POST['eliminar'])) {
    deleteInvoice($conn, $_POST['id']);
}

oci_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Factura</title>
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

        input[type="text"], input[type="number"], input[type="date"], button {
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
        <h1>CRUD Factura</h1>

        <!-- Formulario de inserción -->
        <h2>Insertar Factura</h2>
        <form method="post">
            <label for="fecha_factura">Fecha:</label>
            <input type="date" id="fecha_factura" name="fecha_factura" required>
            <label for="total">Total:</label>
            <input type="number" id="total" name="total" step="0.01" required>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
            <label for="id_pedido">ID Pedido:</label>
            <input type="number" id="id_pedido" name="id_pedido" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Factura</h2>
        <form method="post">
            <label for="id">ID de la Factura a actualizar:</label>
            <input type="number" id="id" name="id" required>
            <label for="nuevo-fecha_factura">Nueva Fecha:</label>
            <input type="date" id="nuevo-fecha_factura" name="fecha_factura" required>
            <label for="nuevo-total">Nuevo Total:</label>
            <input type="number" id="nuevo-total" name="total" step="0.01" required>
            <label for="nuevo-precio">Nuevo Precio:</label>
            <input type="number" id="nuevo-precio" name="precio" step="0.01" required>
            <label for="nuevo-id_pedido">Nuevo ID Pedido:</label>
            <input type="number" id="nuevo-id_pedido" name="id_pedido" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Factura</h2>
        <form method="post">
            <label for="id-eliminar">ID de la Factura a eliminar:</label>
            <input type="number" id="id-eliminar" name="id" required>
            <button type="submit" name="eliminar">Eliminar</button>
        </form>

    </div>
</body>
</html>