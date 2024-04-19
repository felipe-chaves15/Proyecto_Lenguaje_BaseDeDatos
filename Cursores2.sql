--CURSORES FALTANTES 
/*1-Este cursor reemplaza el procedimiento Delete_ADMIN_TIENDA existente */ 
CREATE OR REPLACE PROCEDURE Delete_ADMIN_TIENDA2 (
    Admin_id IN NUMBER
)
AS
    CURSOR c_admin IS
        SELECT id_Admin_TIENDA
        FROM ADMIN_TIENDA
        WHERE id_Admin_TIENDA = Admin_id;
        
    admin_rec c_admin%ROWTYPE; 
BEGIN
    OPEN c_admin;
    LOOP
        FETCH c_admin INTO admin_rec;
        EXIT WHEN c_admin%NOTFOUND;
        
        DELETE FROM ADMIN_TIENDA
        WHERE id_Admin_TIENDA = admin_rec.id_Admin_TIENDA;
        
        DBMS_OUTPUT.PUT_LINE('El usuario administrador de tienda fué eliminado correctamente');
        
    END LOOP;
    CLOSE c_admin;
    --COMMIT; 
END;

--2-CURSOR PARA CONTAR CUANTO DE UN PRODUCTO HAY 
CREATE OR REPLACE PROCEDURE contar_productos IS
    CURSOR c_productos IS
        SELECT NOMBRE, COUNT(*) AS cantidad
        FROM PRODUCTOS
        GROUP BY NOMBRE;
        
    v_nombre_producto PRODUCTOS.NOMBRE%TYPE;
    v_cantidad NUMBER;
BEGIN
    OPEN c_productos;
    LOOP
        FETCH c_productos INTO v_nombre_producto, v_cantidad;
        EXIT WHEN c_productos%NOTFOUND;
        
        DBMS_OUTPUT.PUT_LINE('Producto: ' || v_nombre_producto || ' - Cantidad: ' || v_cantidad);
       IF v_cantidad <= 5 THEN
            DBMS_OUTPUT.PUT_LINE('¡Atención! No tenemos suficientes unidades de este producto, es momento de hacer pedido');
            ELSE
               DBMS_OUTPUT.PUT_LINE('La cantidad de unidades de este producto son suficientes');
        END IF;
    END LOOP;
    CLOSE c_productos;
END contar_productos;

----3-CURSOR PARA CREAR UN LISTADO DE LOS PEDIDOS CON ESTADO PENDIENTE 
CREATE OR REPLACE PROCEDURE mostrar_pedidos_pendientes IS
    CURSOR c_pedidos IS
        SELECT ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA, TOTAL, ESTADO_PEDIDO, ID_CLIENTE
        FROM PEDIDOS
        WHERE ESTADO_PEDIDO = 'Pendiente';
        
    v_id_pedido pedidos.ID_PEDIDO%TYPE;
    v_fecha_pedido pedidos.FECHA_PEDIDO%TYPE;
    v_fecha_entrega pedidos.FECHA_ENTREGA%TYPE;
    v_total pedidos.TOTAL%TYPE;
    v_estado_pedido pedidos.ESTADO_PEDIDO%TYPE;
    v_id_cliente pedidos.ID_CLIENTE%TYPE;
BEGIN
    OPEN c_pedidos;
    LOOP
        FETCH c_pedidos INTO v_id_pedido, v_fecha_pedido, v_fecha_entrega, v_total, v_estado_pedido, v_id_cliente;
        EXIT WHEN c_pedidos%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE('Los siguientes pedidos se encuentran en estado pendiente');
        DBMS_OUTPUT.PUT_LINE('ID Pedido: ' || v_id_pedido);
        DBMS_OUTPUT.PUT_LINE('Fecha Pedido: ' || v_fecha_pedido);
        DBMS_OUTPUT.PUT_LINE('Fecha Entrega: ' || v_fecha_entrega);
        DBMS_OUTPUT.PUT_LINE('Total: ' || v_total);
        DBMS_OUTPUT.PUT_LINE('Estado Pedido: ' || v_estado_pedido);
        DBMS_OUTPUT.PUT_LINE('ID Cliente: ' || v_id_cliente);
        DBMS_OUTPUT.PUT_LINE('------------------------------');
    END LOOP;
    CLOSE c_pedidos;
END mostrar_pedidos_pendientes;

--4-CURSOR PARA MOSTRAR REPORTE DE PEDIDOS DEL MES ACTUAL 
CREATE OR REPLACE PROCEDURE mostrar_pedidos_mes_actual IS
    CURSOR c_pedidos_mes IS
        SELECT p.ID_PEDIDO, p.FECHA_PEDIDO, p.FECHA_ENTREGA, p.ESTADO_PEDIDO, d.ID_PRODUCTO, d.CANTIDAD
        FROM pedidos p
        JOIN detalle_pedido d ON p.ID_PEDIDO = d.ID_PEDIDO
        WHERE TRUNC(p.FECHA_PEDIDO, 'MM') = TRUNC(SYSDATE, 'MM');
        
    v_id_pedido pedidos.ID_PEDIDO%TYPE;
    v_fecha_pedido pedidos.FECHA_PEDIDO%TYPE;
    v_fecha_entrega pedidos.FECHA_ENTREGA%TYPE;
    v_estado_pedido pedidos.ESTADO_PEDIDO%TYPE;
    v_id_producto detalle_pedido.ID_PRODUCTO%TYPE;
    v_cantidad detalle_pedido.CANTIDAD%TYPE;
BEGIN
    -- Mostrar título del reporte
    DBMS_OUTPUT.PUT_LINE('PEDIDOS REALIZADOS EN EL MES ACTUAL');
    DBMS_OUTPUT.PUT_LINE('------------------------------------');
    
    OPEN c_pedidos_mes;
    LOOP
        FETCH c_pedidos_mes INTO v_id_pedido, v_fecha_pedido, v_fecha_entrega, v_estado_pedido, v_id_producto, v_cantidad;
        EXIT WHEN c_pedidos_mes%NOTFOUND;
        
        -- Mostrar detalles del pedido
        DBMS_OUTPUT.PUT_LINE('ID Pedido: ' || v_id_pedido);
        DBMS_OUTPUT.PUT_LINE('Fecha Pedido: ' || v_fecha_pedido);
        DBMS_OUTPUT.PUT_LINE('Fecha Entrega: ' || v_fecha_entrega);
        DBMS_OUTPUT.PUT_LINE('Estado Pedido: ' || v_estado_pedido);
        DBMS_OUTPUT.PUT_LINE('ID Producto: ' || v_id_producto);
        DBMS_OUTPUT.PUT_LINE('Cantidad: ' || v_cantidad);
        DBMS_OUTPUT.PUT_LINE('------------------------------');
    END LOOP;
    CLOSE c_pedidos_mes;
END mostrar_pedidos_mes_actual;

--5-CURSOR PARA GENERAR REPORTE DE VENTAS POR CLIENTE 
CREATE OR REPLACE PROCEDURE calcular_total_ventas_por_cliente IS
    CURSOR c_ventas_por_cliente IS
        SELECT p.ID_CLIENTE, c.NOMBRE, SUM(d.PRECIO * d.CANTIDAD) AS TOTAL_VENTAS
        FROM pedidos p
        JOIN detalle_pedido d ON p.ID_PEDIDO = d.ID_PEDIDO
        JOIN clientes c ON p.ID_CLIENTE = c.ID_CLIENTE
        GROUP BY p.ID_CLIENTE, c.NOMBRE;
        
    v_id_cliente pedidos.ID_CLIENTE%TYPE;
    v_nombre_cliente clientes.NOMBRE%TYPE;
    v_total_ventas NUMBER;
BEGIN
    -- Mostrar título del reporte
    DBMS_OUTPUT.PUT_LINE('TOTAL DE VENTAS POR CLIENTE');
    DBMS_OUTPUT.PUT_LINE('------------------------------------');
    
    OPEN c_ventas_por_cliente;
    LOOP
        FETCH c_ventas_por_cliente INTO v_id_cliente, v_nombre_cliente, v_total_ventas;
        EXIT WHEN c_ventas_por_cliente%NOTFOUND;
        
        -- Mostrar detalles de ventas por cliente
        DBMS_OUTPUT.PUT_LINE('ID Cliente: ' || v_id_cliente);
        DBMS_OUTPUT.PUT_LINE('Nombre Cliente: ' || v_nombre_cliente);
        DBMS_OUTPUT.PUT_LINE('Total de Ventas: ' || v_total_ventas);
        DBMS_OUTPUT.PUT_LINE('------------------------------');
    END LOOP;
    CLOSE c_ventas_por_cliente;
END calcular_total_ventas_por_cliente;

--6-PROCEDIMIENTO PARA CREAR FACTURA 
/*DA ERROR 
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

    -- Mostrar mensaje de confirmación
    DBMS_OUTPUT.PUT_LINE('Factura generada correctamente para el pedido ' || p_id_pedido || ' del cliente ' || v_id_cliente);
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró el pedido especificado.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Ocurrió un error al generar la factura.');
END generar_factura;
*/