CREATE OR REPLACE VIEW vista_admin_marcas AS
SELECT A.ID_ADMIN_TIENDA , A.NOMBRE AS NOMBRE_ADMIN, A.CORREO, A.TELEFONO, M.NOMBRE AS NOMBRE_MARCA
FROM ADMIN_TIENDA A
JOIN  MARCAS M ON A.ID_MARCA = M.ID_MARCA;

CREATE OR REPLACE VIEW vista_producto_marcas AS
SELECT P.NOMBRE AS DESCRIPCION_PRODUCTO, P.PRECIO, M.NOMBRE AS NOMBRE_MARCA 
FROM PRODUCTOS P
JOIN MARCAS M ON P.ID_MARCA = M.ID_MARCA;

CREATE OR REPLACE VIEW vista_admin_tienda_pedidos AS
SELECT A.ID_ADMIN_TIENDA AS ADMINISTRADOR_TIENDA, A.CORREO, A.TELEFONO, P.ESTADO_PEDIDO, P.FECHA_PEDIDO 
FROM ADMIN_TIENDA A
JOIN PEDIDOS P ON A.ID_PEDIDO = P.ID_PEDIDO;

CREATE OR REPLACE VIEW vista_facturas_pedidos AS
SELECT f.ID_FACTURA, f.FECHA_FACTURA, f.TOTAL AS TOTAL_FACTURA,
       p.ID_PEDIDo, p.TOTAL AS TOTAL_PEDIDO
FROM FACTURAS f
JOIN PEDIDOS p ON f.ID_FACTURA = p.ID_PEDIDO;

CREATE OR REPLACE FUNCTION calcular_total_ingresos_producto (
    p_id_producto IN NUMBER
) RETURN NUMBER
IS
    v_total_ingresos NUMBER := 0;
BEGIN
    SELECT SUM(dp.CANTIDAD * f.PRECIO) INTO v_total_ingresos
    FROM FACTURAS f
    JOIN PEDIDOS p ON f.ID_PEDIDO = p.ID_PEDIDO
    JOIN DETALLE_PEDIDO dp ON p.ID_PEDIDO = dp.ID_PEDIDO
    WHERE dp.ID_PRODUCTO = p_id_producto;

    RETURN v_total_ingresos;
END;

CREATE OR REPLACE FUNCTION actualizar_precio_producto (
    p_id_producto IN NUMBER,
    p_nuevo_precio IN NUMBER
) RETURN VARCHAR2
IS
BEGIN
    UPDATE PRODUCTOS
    SET PRECIO = p_nuevo_precio
    WHERE ID_PRODUCTO = p_id_producto;

    RETURN 'Precio actualizado correctamente para el producto con ID ' || p_id_producto;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN 'No se encontró ningún producto con el ID especificado.';
    WHEN OTHERS THEN
        RETURN 'Se produjo un error al actualizar el precio del producto.';
END;

CREATE OR REPLACE FUNCTION eliminar_marca (
    p_id_marca IN NUMBER
) RETURN VARCHAR2
IS
BEGIN
    DELETE FROM MARCAS
    WHERE ID_MARCA = p_id_marca;

    RETURN 'Marca eliminada correctamente con ID ' || p_id_marca;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN 'No se encontró ninguna marca con el ID especificado.';
    WHEN OTHERS THEN
        RETURN 'Se produjo un error al eliminar la marca.';
END;

CREATE OR REPLACE FUNCTION calcular_total_compras_cliente (
    p_id_cliente IN NUMBER
) RETURN NUMBER
IS
    v_total_compras NUMBER := 0;
BEGIN
    SELECT SUM(f.total) INTO v_total_compras
    FROM pedidos p
    JOIN facturas f ON p.id_pedido = f.id_pedido
    WHERE p.id_cliente = p_id_cliente;

    RETURN v_total_compras;
END;


CREATE OR REPLACE FUNCTION calcular_total_ventas_periodo (
    p_fecha_inicio IN DATE,
    p_fecha_fin IN DATE
) RETURN NUMBER
IS
    v_total_ventas NUMBER;
BEGIN
    SELECT SUM(total) INTO v_total_ventas
    FROM facturas
    WHERE fecha_factura BETWEEN p_fecha_inicio AND p_fecha_fin;

    RETURN v_total_ventas;
END;


CREATE OR REPLACE FUNCTION obtener_categorias_productos RETURN SYS_REFCURSOR
IS
    v_cursor SYS_REFCURSOR;
BEGIN
    OPEN v_cursor FOR
    SELECT DISTINCT nombre
    FROM categorias;

    RETURN v_cursor;
END;

CREATE OR REPLACE FUNCTION actualizar_descripcion_producto(
    p_id_producto IN NUMBER,
    p_nueva_descripcion_producto IN VARCHAR2
) RETURN VARCHAR2
IS
BEGIN
    UPDATE productos
    SET descripcion = p_nueva_descripcion_producto
    WHERE id_producto = p_id_producto;
    
    RETURN 'Descripción del producto ha sido actualizada correctamente';
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN 'No se encontró ningun producto con el ID especificado.';
    WHEN OTHERS THEN
        RETURN 'Se produjo un error al actualizar la descripción del producto.';
END;



CREATE OR REPLACE FUNCTION actualizar_cantidad_producto_pedido(
    p_id_pedido IN NUMBER,
    p_id_producto IN NUMBER,
    p_nueva_cantidad IN NUMBER
) RETURN VARCHAR2
IS
BEGIN
    UPDATE detalle_pedido
    SET cantidad = p_nueva_cantidad
    WHERE id_pedido = p_id_pedido
    AND id_producto = p_id_producto;
    
    RETURN 'Cantidad del producto en el detalle de  pedido ha sido actualizada correctamente';
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN 'No se encontró ningún detalle de pedido con el ID especificado o el producto no está incluido en el detalle de pedido.';
    WHEN OTHERS THEN
        RETURN 'Se produjo un error al actualizar la cantidad del producto en el detalle pedido.';
END;
