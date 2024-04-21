<?php 
    include_once MODELS_PATH . '/database.php';

// Conexión a la base de datos Oracle
$conn = oci_connect("LENGDB_ADM", "1234", "localhost/XE");

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Funciones para Administrador de Tienda
function insertarAdminTienda($id_Admin_TIENDA, $nombre, $apellido, $correo, $telefono) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN InsertarADMIN_TIENDA(:id_Admin_TIENDA, :nombre, :apellido, :correo, :telefono); END;");
    oci_bind_by_name($stmt, ':id_Admin_TIENDA', $id_Admin_TIENDA);
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':apellido', $apellido);
    oci_bind_by_name($stmt, ':correo', $correo);
    oci_bind_by_name($stmt, ':telefono', $telefono);
    oci_execute($stmt);
}

function actualizarAdminTienda($id_Admin, $correo, $telefono) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN update_ADMIN_TIENDA(:id_Admin, :correo, :telefono); END;");
    oci_bind_by_name($stmt, ':id_Admin', $id_Admin);
    oci_bind_by_name($stmt, ':correo', $correo);
    oci_bind_by_name($stmt, ':telefono', $telefono);
    oci_execute($stmt);
}

function eliminarAdminTienda($Admin_id) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN Delete_ADMIN_TIENDA(:Admin_id); END;");
    oci_bind_by_name($stmt, ':Admin_id', $Admin_id);
    oci_execute($stmt);
}

function insertarCliente($id_cliente, $nombre, $apellido, $correo, $telefono, $direccion, $contraseña, $rol) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN InsertarCliente(:id_cliente, :nombre, :apellido, :correo, :telefono, :direccion, :contrasena, :rol); END;");
    oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':apellido', $apellido);
    oci_bind_by_name($stmt, ':correo', $correo);
    oci_bind_by_name($stmt, ':telefono', $telefono);
    oci_bind_by_name($stmt, ':direccion', $direccion);
    oci_bind_by_name($stmt, ':contrasena', $contrasena);
    oci_bind_by_name($stmt, ':rol', $rol);
    oci_execute($stmt);
}

function actualizarCliente($id_cliente, $nuevo_nombre, $nuevo_apellido, $nuevo_correo, $nuevo_telefono, $nuevo_direccion, $nueva_contrasena, $nuevo_rol) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN actualizar_cliente(:id_cliente, :nuevo_nombre, :nuevo_apellido, :nuevo_correo, :nuevo_telefono, :nuevo_direccion, :nueva_contrasena, :nuevo_rol); END;");
    oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
    oci_bind_by_name($stmt, ':nuevo_nombre', $nuevo_nombre);
    oci_bind_by_name($stmt, ':nuevo_apellido', $nuevo_apellido);
    oci_bind_by_name($stmt, ':nuevo_correo', $nuevo_correo);
    oci_bind_by_name($stmt, ':nuevo_telefono', $nuevo_telefono);
    oci_bind_by_name($stmt, ':nuevo_direccion', $nuevo_direccion);
    oci_bind_by_name($stmt, ':nueva_contrasena', $nueva_contrasena);
    oci_bind_by_name($stmt, ':nuevo_rol', $nuevo_rol);
    oci_execute($stmt);
}

function eliminarCliente($cliente_id) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN Delete_cliente(:cliente_id); END;");
    oci_bind_by_name($stmt, ':cliente_id', $cliente_id);
    oci_execute($stmt);
}


// Funciones para Productos
function insertarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN InsertarProductos(:id_producto, :nombre, :descripcion, :cantidad, :precio); END;");
    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':cantidad', $cantidad);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_execute($stmt);
}

function actualizarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN actualizar_productos(:id_producto, :nombre, :descripcion, :cantidad, :precio); END;");
    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':cantidad', $cantidad);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_execute($stmt);
}

function eliminarProducto($producto_ID) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN Delete_Productos(:producto_ID); END;");
    oci_bind_by_name($stmt, ':producto_ID', $producto_ID);
    oci_execute($stmt);
}

// Funciones para Categorías
function insertarCategoria($id_categoria, $nombre_categoria) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN InsertarCategoria(:id_categoria, :nombre_categoria); END;");
    oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
    oci_bind_by_name($stmt, ':nombre_categoria', $nombre_categoria);
    oci_execute($stmt);
}

function actualizarCategoria($id_categoria, $nombre_categoria) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN actualizar_categoria(:id_categoria, :nombre_categoria); END;");
    oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
    oci_bind_by_name($stmt, ':nombre_categoria', $nombre_categoria);
    oci_execute($stmt);
}

function eliminarCategoria($id_categoria) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN Delete_categoria(:id_categoria); END;");
    oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
    oci_execute($stmt);
}

// Funciones para Marcas
function insertarMarca($id_marca, $nombre_marca) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN InsertarMarca(:id_marca, :nombre_marca); END;");
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':nombre_marca', $nombre_marca);
    oci_execute($stmt);
}

function actualizarMarca($id_marca, $nombre_marca) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN actualizar_marca(:id_marca, :nombre_marca); END;");
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':nombre_marca', $nombre_marca);
    oci_execute($stmt);
}

function eliminarMarca($id_marca) {
    global $conn;
    $stmt = oci_parse($conn, "BEGIN Delete_marcas(:id_marca); END;");
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_execute($stmt);
}

// Cerrar conexión a la base de datos
oci_close($conn);
?>
