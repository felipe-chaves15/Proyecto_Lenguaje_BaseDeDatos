--PL/SQL
SET SERVEROUTPUT ON;


--Paquete marcas

CREATE OR REPLACE PACKAGE paquete_marcas AS
  -- Procedimiento para actualizar una marca
  PROCEDURE actualizar_marca(p_id_marca IN NUMBER, p_nombre_marca IN VARCHAR2);

  -- Procedimiento para eliminar una marca
  PROCEDURE eliminar_marca(p_id_marca IN NUMBER);

  -- Procedimiento para insertar una nueva marca
  PROCEDURE insertar_marca(p_nombre_marca IN VARCHAR2);
END paquete_marcas;


CREATE OR REPLACE PACKAGE BODY paquete_marcas AS
  -- Procedimiento para actualizar una marca
  PROCEDURE actualizar_marca(p_id_marca IN NUMBER, p_nombre_marca IN VARCHAR2) AS
  BEGIN
    UPDATE marcas
    SET nombre = p_nombre_marca
    WHERE id_marca = p_id_marca;
  END actualizar_marca;

  -- Procedimiento para eliminar una marca
  PROCEDURE eliminar_marca(p_id_marca IN NUMBER) AS
  BEGIN
    DELETE FROM marcas
    WHERE id_marca = p_id_marca;
  END eliminar_marca;

  -- Procedimiento para insertar una nueva marca
  PROCEDURE insertar_marca(p_nombre_marca IN VARCHAR2) AS
  BEGIN
    INSERT INTO marcas (nombre)
    VALUES (p_nombre_marca);
  END insertar_marca;
END paquete_marcas;

------------------------------------------
--paquete pedidos

CREATE OR REPLACE PACKAGE paquete_pedidos AS
  -- Procedimiento para actualizar un pedido
  PROCEDURE actualizar_pedido(p_id_pedido IN NUMBER, p_fecha_entrega IN DATE, p_total IN NUMBER, p_estado_pedido IN VARCHAR2);

  -- Procedimiento para eliminar un pedido
  PROCEDURE eliminar_pedido(p_id_pedido IN NUMBER);

  -- Procedimiento para insertar un nuevo pedido
  PROCEDURE insertar_pedido(p_fecha_pedido IN DATE, p_fecha_entrega IN DATE, p_total IN NUMBER, p_estado_pedido IN VARCHAR2, p_id_cliente IN NUMBER);
END paquete_pedidos;



CREATE OR REPLACE PACKAGE BODY paquete_pedidos AS
  -- Procedimiento para actualizar un pedido
  PROCEDURE actualizar_pedido(p_id_pedido IN NUMBER, p_fecha_entrega IN DATE, p_total IN NUMBER, p_estado_pedido IN VARCHAR2) AS
  BEGIN
    UPDATE pedidos
    SET fecha_entrega = p_fecha_entrega,
        total = p_total,
        estado_pedido = p_estado_pedido
    WHERE id_pedido = p_id_pedido;
  END actualizar_pedido;

  -- Procedimiento para eliminar un pedido
  PROCEDURE eliminar_pedido(p_id_pedido IN NUMBER) AS
  BEGIN
    DELETE FROM pedidos
    WHERE id_pedido = p_id_pedido;
  END eliminar_pedido;

  -- Procedimiento para insertar un nuevo pedido
  PROCEDURE insertar_pedido(p_fecha_pedido IN DATE, p_fecha_entrega IN DATE, p_total IN NUMBER, p_estado_pedido IN VARCHAR2, p_id_cliente IN NUMBER) AS
  BEGIN
    INSERT INTO pedidos (fecha_pedido, fecha_entrega, total, estado_pedido, id_cliente)
    VALUES (p_fecha_pedido, p_fecha_entrega, p_total, p_estado_pedido, p_id_cliente);
  END insertar_pedido;
END paquete_pedidos;

--------------------------------
--paquete clientes

CREATE OR REPLACE PACKAGE paquete_clientes AS
  -- Procedimiento para actualizar un cliente
  PROCEDURE actualizar_cliente(p_id_cliente IN NUMBER, p_nombre IN VARCHAR2, p_apellido IN VARCHAR2, p_correo IN VARCHAR2, p_telefono IN VARCHAR2, p_direccion IN VARCHAR2);

  -- Procedimiento para eliminar un cliente
  PROCEDURE eliminar_cliente(p_id_cliente IN NUMBER);

  -- Procedimiento para insertar un nuevo cliente
  PROCEDURE insertar_cliente(p_nombre IN VARCHAR2, p_apellido IN VARCHAR2, p_correo IN VARCHAR2, p_telefono IN VARCHAR2, p_direccion IN VARCHAR2);
END paquete_clientes;


-- Cuerpo del paquete
CREATE OR REPLACE PACKAGE BODY paquete_clientes AS
  -- Procedimiento para actualizar un cliente
  PROCEDURE actualizar_cliente(p_id_cliente IN NUMBER, p_nombre IN VARCHAR2, p_apellido IN VARCHAR2, p_correo IN VARCHAR2, p_telefono IN VARCHAR2, p_direccion IN VARCHAR2) AS
  BEGIN
    UPDATE clientes
    SET nombre = p_nombre,
        apellido = p_apellido,
        correo = p_correo,
        telefono = p_telefono,
        direccion = p_direccion
    WHERE id_cliente = p_id_cliente;
  END actualizar_cliente;

  -- Procedimiento para eliminar un cliente
  PROCEDURE eliminar_cliente(p_id_cliente IN NUMBER) AS
  BEGIN
    DELETE FROM clientes
    WHERE id_cliente = p_id_cliente;
  END eliminar_cliente;

  -- Procedimiento para insertar un nuevo cliente
  PROCEDURE insertar_cliente(p_nombre IN VARCHAR2, p_apellido IN VARCHAR2, p_correo IN VARCHAR2, p_telefono IN VARCHAR2, p_direccion IN VARCHAR2) AS
  BEGIN
    INSERT INTO clientes (nombre, apellido, correo, telefono, direccion)
    VALUES (p_nombre, p_apellido, p_correo, p_telefono, p_direccion);
  END insertar_cliente;
END paquete_clientes;

-------------------------
--paquete productos

CREATE OR REPLACE PACKAGE paquete_productos AS
  -- Procedimiento para actualizar un producto
  PROCEDURE actualizar_producto(p_id_producto IN NUMBER, p_nombre IN VARCHAR2, p_descripcion IN VARCHAR2, p_cantidad IN NUMBER, p_precio IN NUMBER, p_id_categoria IN NUMBER, p_id_marca IN NUMBER);

  -- Procedimiento para eliminar un producto
  PROCEDURE eliminar_producto(p_id_producto IN NUMBER);

  -- Procedimiento para insertar un nuevo producto
  PROCEDURE insertar_producto(p_nombre IN VARCHAR2, p_descripcion IN VARCHAR2, p_cantidad IN NUMBER, p_precio IN NUMBER, p_id_categoria IN NUMBER, p_id_marca IN NUMBER);
END paquete_productos;


-- Cuerpo del paquete
CREATE OR REPLACE PACKAGE BODY paquete_productos AS
  -- Procedimiento para actualizar un producto
  PROCEDURE actualizar_producto(p_id_producto IN NUMBER, p_nombre IN VARCHAR2, p_descripcion IN VARCHAR2, p_cantidad IN NUMBER, p_precio IN NUMBER, p_id_categoria IN NUMBER, p_id_marca IN NUMBER) AS
  BEGIN
    UPDATE productos
    SET nombre = p_nombre,
        descripcion = p_descripcion,
        cantidad = p_cantidad,
        precio = p_precio,
        id_categoria = p_id_categoria,
        id_marca = p_id_marca
    WHERE id_producto = p_id_producto;
  END actualizar_producto;

  -- Procedimiento para eliminar un producto
  PROCEDURE eliminar_producto(p_id_producto IN NUMBER) AS
  BEGIN
    DELETE FROM productos
    WHERE id_producto = p_id_producto;
  END eliminar_producto;

  -- Procedimiento para insertar un nuevo producto
  PROCEDURE insertar_producto(p_nombre IN VARCHAR2, p_descripcion IN VARCHAR2, p_cantidad IN NUMBER, p_precio IN NUMBER, p_id_categoria IN NUMBER, p_id_marca IN NUMBER) AS
  BEGIN
    INSERT INTO productos (nombre, descripcion, cantidad, precio, id_categoria, id_marca)
    VALUES (p_nombre, p_descripcion, p_cantidad, p_precio, p_id_categoria, p_id_marca);
  END insertar_producto;
END paquete_productos;




