<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"])) {
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

$conn = oci_connect('LENGDB_ADM', '1234', 'localhost/XE', 'UTF8', OCI_DEFAULT);

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
function OracleDateFormat($date)
{
    return date('d-m-Y', strtotime($date));
}
function insertOrder($conn, $fecha_pedido, $fecha_entrega, $total, $estado_pedido, $id_cliente)
{
    $fecha_pedido_formatted = OracleDateFormat($fecha_pedido);
    $fecha_entrega_formatted = OracleDateFormat($fecha_entrega);

    $stid = oci_parse($conn, 'BEGIN paquete_pedidos.insertar_pedido(TO_DATE(:fecha_pedido, \'DD-MM-RRRR\'), TO_DATE(:fecha_entrega, \'DD-MM-RRRR\'), :total, :estado_pedido, :id_cliente); END;');
    oci_bind_by_name($stid, ':fecha_pedido', $fecha_pedido_formatted);
    oci_bind_by_name($stid, ':fecha_entrega', $fecha_entrega_formatted);
    oci_bind_by_name($stid, ':total', (int)$total);
    oci_bind_by_name($stid, ':estado_pedido', $estado_pedido);
    oci_bind_by_name($stid, ':id_cliente', (int)$id_cliente);
    oci_execute($stid);
}

function updateOrder($conn, $id, $fecha_pedido, $fecha_entrega, $total, $estado_pedido)
{
    $fecha_pedido_formatted = OracleDateFormat($fecha_pedido);
    $fecha_entrega_formatted = OracleDateFormat($fecha_entrega);

    $stid = oci_parse($conn, 'BEGIN paquete_pedidos.actualizar_pedido(:id, TO_DATE(:fecha_pedido, \'DD-MM-RRRR\'), TO_DATE(:fecha_entrega, \'DD-MM-RRRR\'), :total, :estado_pedido); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_bind_by_name($stid, ':fecha_pedido', $fecha_pedido_formatted);
    oci_bind_by_name($stid, ':fecha_entrega', $fecha_entrega_formatted);
    oci_bind_by_name($stid, ':total', $total);
    oci_bind_by_name($stid, ':estado_pedido', $estado_pedido);
    oci_execute($stid);
}

function deleteOrder($conn, $id)
{
    $stid = oci_parse($conn, 'BEGIN paquete_pedidos.eliminar_pedido(:id); END;');
    oci_bind_by_name($stid, ':id', $id);
    oci_execute($stid);
}

//Handle form submissions
if (isset($_POST['insertar'])) {
    insertOrder($conn, $_POST['fecha_pedido'], $_POST['fecha_entrega'], $_POST['total'], $_POST['estado_pedido'], $_POST['id_cliente']);
}

if (isset($_POST['actualizar'])) {
    updateOrder($conn, $_POST['id'], $_POST['fecha_pedido'], $_POST['fecha_entrega'], $_POST['total'], $_POST['estado_pedido']);
}

if (isset($_POST['eliminar'])){
    deleteOrder($conn, $_POST['id']);
}

oci_close($conn);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pedidos</title>
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
        <h1>CRUD Pedidos</h1>

        <!-- Formulario de inserción -->
        <h2>Insertar Pedido</h2>
        <form method="post">
           <label for="fecha_pedido">Fecha Pedido:</label>
            <input type="date" id="fecha_pedido" name="fecha_pedido" required>
            <label for="fecha_entrega">Fecha Entrega:</label>
            <input type="date" id="fecha_entrega" name="fecha_entrega" required>
            <label for="total">Total:</label>
            <input type="number" id="total" name="total" step="0.01" required>
            <label for="estado_pedido">Estado Pedido:</label>
            <input type="text" id="estado_pedido" name="estado_pedido" required>
            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" required>
            <button type="submit" name="insertar">Insertar</button>
        </form>
        
        <!-- Formulario de actualización -->
        <h2>Actualizar Pedido</h2>
        <form method="post">
            <label for="id">ID del Pedido a actualizar:</label>
            <input type="number" id="id" name="id" required>
            <label for="nuevo-fecha_pedido">Nueva Fecha Pedido:</label>
           <input type="date" id="nuevo-fecha_pedido" name="fecha_pedido" required>
            <label for="nuevo-fecha_entrega">Nueva Fecha Entrega:</label>
            <input type="date" id="nuevo-fecha_entrega" name="fecha_entrega" required>
            <label for="nuevo-total">Nuevo Total:</label>
            <input type="number" id="nuevo-total" name="total" step="0.01" required>
            <label for="nuevo-estado_pedido">Nuevo Estado Pedido:</label>
            <input type="text" id="nuevo-estado_pedido" name="estado_pedido" required>
            <button type="submit" name="actualizar">Actualizar</button>
        </form>
        
        <!-- Formulario de eliminación -->
        <h2>Eliminar Pedido</h2>
        <form method="post">
            <label for="id-eliminar">ID del Pedido a eliminar:</label>
            <input type="number" id="id-eliminar" name="id" required>
            <button type="submit" name="eliminar">Eliminar</button>
        </form>

    </div>
</body>
</html>