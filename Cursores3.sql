--Procedimiento que genera reporte de clientes con más compras  
CREATE OR REPLACE PROCEDURE clientes_con_mas_compras IS
    CURSOR c_clientes IS
        SELECT c.nombre, c.apellido, SUM(dp.cantidad * pr.precio) AS total_gastado 
        --Esto suma el total comprado por el cliente 
        FROM clientes c
        JOIN pedidos p ON c.id_cliente = p.id_cliente
        JOIN detalle_pedido dp ON p.id_pedido = dp.id_pedido
        JOIN productos pr ON dp.id_producto = pr.id_producto
        GROUP BY c.nombre, c.apellido
        ORDER BY total_gastado DESC;
        --Lo ordenamos en orden descendente para que nos salga primero el cliente con más compras 
BEGIN
    FOR cliente_rec IN c_clientes LOOP
        DBMS_OUTPUT.PUT_LINE('Cliente: ' || cliente_rec.nombre || ' ' || cliente_rec.apellido || ', Total Gastado: ' || cliente_rec.total_gastado);
        --Acá nos muestra un mensaje con los datos del cliente y su total en compras 
    END LOOP;
END clientes_con_mas_compras;

--OBTENER FECHA ENTREGA ESTIMADA DE PEDIDO 
create or replace NONEDITIONABLE PROCEDURE obtener_fecha_entrega_pedido(
    p_id_pedido IN NUMBER,
    p_fecha_entrega OUT DATE
) AS
    -- Declaración del cursor
    CURSOR c_fecha_estimada IS
        SELECT FECHA_ENTREGA
        FROM PEDIDOS
        WHERE ID_PEDIDO = p_id_pedido;

    v_fecha_entrega PEDIDOS.FECHA_ENTREGA%TYPE;
BEGIN
    -- Obtener la fecha de entrega estimada por medio del cursor 
    OPEN c_fecha_estimada;
    FETCH c_fecha_estimada INTO v_fecha_entrega;
    CLOSE c_fecha_estimada;

    -- Asignar el valor de la fecha de entrega estimada a la variable que vamos a utilizar como resultado 
    p_fecha_entrega := v_fecha_entrega;
END obtener_fecha_entrega_pedido;


--PROCEDIMIENTO CON CURSOR PARA CREAR UNA FACTURA  
CREATE OR REPLACE PROCEDURE generar_factura (
    p_id_pedido IN pedidos.ID_PEDIDO%TYPE
)
IS
    -- Variables para almacenar los datos del pedido y detalles del pedido
    v_id_cliente pedidos.ID_CLIENTE%TYPE;
    v_fecha_pedido pedidos.FECHA_PEDIDO%TYPE;
    v_total NUMBER := 0;

    -- Cursor para obtener los detalles del pedido
    CURSOR c_detalles_pedido IS
        SELECT d.ID_PRODUCTO, d.CANTIDAD, p.PRECIO
        FROM detalle_pedido d
        JOIN productos p ON d.ID_PRODUCTO = p.ID_PRODUCTO
        WHERE d.ID_PEDIDO = p_id_pedido;

BEGIN
    -- Obtener información del pedido
    SELECT ID_CLIENTE, FECHA_PEDIDO
    INTO v_id_cliente, v_fecha_pedido
    FROM pedidos
    WHERE ID_PEDIDO = p_id_pedido;

    -- Iniciar la factura
    INSERT INTO facturas (ID_PEDIDO, FECHA_FACTURA)
    VALUES (p_id_pedido, SYSDATE)
    RETURNING TOTAL INTO v_total;

    -- Recorrer los detalles del pedido y calcular el total de la factura
    FOR detalle IN c_detalles_pedido LOOP
        v_total := v_total + detalle.CANTIDAD * detalle.PRECIO;
    END LOOP;

    -- Actualizar el total de la factura
    UPDATE facturas
    SET TOTAL = v_total
    WHERE ID_PEDIDO = p_id_pedido;

    -- Mostrar mensaje de confirmación o de error según sea el caso 
    DBMS_OUTPUT.PUT_LINE('Factura generada correctamente para el pedido ' || p_id_pedido || ' del cliente ' || v_id_cliente);
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró el pedido especificado.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Ocurrió un error al generar la factura.');
END generar_factura;


--PROCEDIMIENTO CON CURSOR PARA ACTUALIZAR UN CLIENTE 
CREATE OR REPLACE PROCEDURE update_cliente (
    p_id_cliente IN NUMBER,
    p_nuevo_nombre IN VARCHAR2,
    p_nuevo_apellido IN VARCHAR2,
    p_nuevo_correo IN VARCHAR2,
    p_nuevo_telefono IN VARCHAR2,
    p_nuevo_direccion IN VARCHAR2
)
IS
    CURSOR c_cliente IS
        SELECT *
        FROM clientes
        WHERE id_cliente = p_id_cliente;
BEGIN
    FOR cliente_rec IN c_cliente LOOP
        UPDATE clientes
        SET nombre = p_nuevo_nombre,
            apellido = p_nuevo_apellido,
            correo = p_nuevo_correo,
            telefono = p_nuevo_telefono,
            direccion = p_nuevo_direccion
        WHERE id_cliente = p_id_cliente;
    END LOOP;

    -- COMMIT;
END update_cliente;