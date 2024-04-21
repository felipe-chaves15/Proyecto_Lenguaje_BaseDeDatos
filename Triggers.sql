--TRIGGERS 
SET SERVEROUTPUT ON; 

--Trigger de pedido 
CREATE OR REPLACE TRIGGER trg_insert_pedido
AFTER INSERT ON pedidos
FOR EACH ROW
DECLARE
BEGIN
    -- Aquí puedes incluir la lógica que deseas realizar cuando se inserta un pedido
    -- Por ejemplo, podrías enviar un correo electrónico de confirmación al cliente, 
    -- o registrar la información en un archivo de registro, etc.
    
    DBMS_OUTPUT.PUT_LINE('Se ha insertado un nuevo pedido con ID: ' || :NEW.id_pedido);
    
    -- Si deseas realizar alguna acción adicional, puedes hacerlo aquí
END;

--CREATE OR REPLACE TRIGGER trg_actualizar_inventario
CREATE OR REPLACE TRIGGER trg_actualizar_inventario
AFTER INSERT ON pedidos
FOR EACH ROW
DECLARE
    v_stock_actual NUMBER;
BEGIN
    -- Recorrer los productos incluidos en el pedido y actualizar el inventario
    FOR prod IN (SELECT id_producto, cantidad FROM DETALLE_PEDIDO WHERE id_pedido = :NEW.id_pedido) LOOP
        -- Obtener el stock actual del producto
        SELECT cantidad INTO v_stock_actual
        FROM productos
        WHERE id_producto = prod.id_producto;

        -- Restar la cantidad vendida del stock actual
        v_stock_actual := v_stock_actual - prod.cantidad;

        -- Actualizar el stock en la tabla productos
        UPDATE productos
        SET cantidad = v_stock_actual
        WHERE id_producto = prod.id_producto;

        DBMS_OUTPUT.PUT_LINE('Se ha actualizado el inventario del producto con ID: ' || prod.id_producto);
    END LOOP;
END;


--Trigger para insertar un admin 
CREATE TABLE registro_admin_tienda (
    accion VARCHAR2(50),
    id_admin_tienda NUMBER,
    fecha DATE
);

CREATE OR REPLACE TRIGGER trg_insertar_admin
AFTER INSERT ON admin_tienda
FOR EACH ROW
DECLARE
BEGIN
    INSERT INTO registro_admin_tienda (accion, id_admin_tienda, fecha)
    VALUES ('Inserción', :NEW.id_admin_tienda, SYSDATE);
END;

--Trigger al eliminar un admin tienda 
CREATE OR REPLACE TRIGGER trg_eliminar_admin
BEFORE DELETE ON admin_tienda
FOR EACH ROW
DECLARE
BEGIN
    INSERT INTO registro_admin_tienda (accion, admin_id, fecha)
    VALUES ('Eliminación', :OLD.admin_id, SYSDATE);
END;

--Trigger para la actualizacion de datos de cliente 
CREATE TABLE registro_clientes (
    accion VARCHAR2(50),
    id_cliente NUMBER,
    fecha DATE
);

CREATE OR REPLACE TRIGGER trg_update_cli
AFTER UPDATE ON CLIENTES
FOR EACH ROW
DECLARE
BEGIN
    INSERT INTO registro_clientes (accion, id_cliente, fecha)
    VALUES ('Actualización', :NEW.id_cliente, SYSDATE);
END;
