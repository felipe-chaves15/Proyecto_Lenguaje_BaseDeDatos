<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<?php


include_once('global.php');
include_once (MODELS_PATH . '/userModel.php');



class UserController {
    // Métodos para Administrador de Tienda
    public function insertarAdminTienda($id_Admin_TIENDA, $nombre, $apellido, $correo, $telefono) {
        insertarAdminTienda($id_Admin_TIENDA, $nombre, $apellido, $correo, $telefono);
    }

    public function actualizarAdminTienda($id_Admin, $correo, $telefono) {
        actualizarAdminTienda($id_Admin, $correo, $telefono);
    }

    public function eliminarAdminTienda($Admin_id) {
        eliminarAdminTienda($Admin_id);
    }

// Métodos para Cliente
public function insertarCliente($id_cliente, $nombre, $apellido, $correo, $telefono, $direccion, $contrasena, $rol) {
    // Llama a la función insertarCliente y pasa los parámetros adecuados
    insertarCliente($id_cliente, $nombre, $apellido, $correo, $telefono, $direccion, $contrasena, $rol);
}

public function actualizarCliente($id_cliente, $nuevo_nombre, $nuevo_apellido, $nuevo_correo, $nuevo_telefono, $nuevo_direccion, $nueva_contrasena, $nuevo_rol) {
    // Llama a la función actualizarCliente y pasa los parámetros adecuados
    actualizarCliente($id_cliente, $nuevo_nombre, $nuevo_apellido, $nuevo_correo, $nuevo_telefono, $nuevo_direccion, $nueva_contrasena, $nuevo_rol);
}

public function eliminarCliente($cliente_id) {
    // Llama a la función eliminarCliente y pasa el parámetro adecuado
    eliminarCliente($cliente_id);
}


    // Métodos para Producto
    public function insertarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio) {
        insertarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio);
    }

    public function actualizarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio) {
        actualizarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio);
    }

    public function eliminarProducto($producto_ID) {
        eliminarProducto($producto_ID);
    }

    // Métodos para Categoría
    public function insertarCategoria($id_categoria, $nombre_categoria) {
        insertarCategoria($id_categoria, $nombre_categoria);
    }

    public function actualizarCategoria($id_categoria, $nombre_categoria) {
        actualizarCategoria($id_categoria, $nombre_categoria);
    }

    public function eliminarCategoria($id_categoria) {
        eliminarCategoria($id_categoria);
    }

    // Métodos para Marca
    public function insertarMarca($id_marca, $nombre_marca) {
        insertarMarca($id_marca, $nombre_marca);
    }

    public function actualizarMarca($id_marca, $nombre_marca) {
        actualizarMarca($id_marca, $nombre_marca);
    }

    public function eliminarMarca($id_marca) {
        eliminarMarca($id_marca);
    }
}

// Ejemplo de uso del controlador de usuario
//$userController = new UserController();
//$userController->insertarCliente(1, 'John', 'Doe', 'john@example.com', '123456789', '123 Main St');
//$userController->actualizarAdminTienda(1, 'admin@example.com', '987654321');
//$userController->eliminarProducto(101);
//?>



