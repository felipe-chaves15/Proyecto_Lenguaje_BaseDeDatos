--TRIGGERS 
SET SERVEROUTPUT ON; 

--Trigger de pedido 
CREATE OR REPLACE TRIGGER trg_insert_pedido
AFTER INSERT ON pedidos
FOR EACH ROW
DECLARE
BEGIN
    -- Opcional almacenar en tabla registro los pedidos insertados 
    DBMS_OUTPUT.PUT_LINE('Se ha insertado un nuevo pedido con ID: ' || :NEW.id_pedido);

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
    --Inserta en la tabla registro la accion que se realizò con el respectivo admin_id
    INSERT INTO registro_admin_tienda (accion, id_admin_tienda, fecha)
    VALUES ('Inserción', :NEW.id_admin_tienda, SYSDATE);
END;

--Trigger al eliminar un admin tienda 

CREATE OR REPLACE TRIGGER trg_eliminar_admin
BEFORE DELETE ON admin_tienda
FOR EACH ROW
DECLARE
BEGIN
    --Registra en la tabla registro la acción realizada con el respectivo admin_Id
    INSERT INTO registro_admin_tienda (accion, id_admin_tienda, fecha)
    VALUES ('Eliminación', :OLD.id_admin_tienda, SYSDATE);
END;


--Trigger para la actualizacion de datos de cliente 
--Crear esta tabla antes para hacer el registro de las transacciones 
CREATE TABLE registro_clientes (
    accion VARCHAR2(50),
    id_cliente NUMBER,
    fecha DATE
);

--Trigger para actualizar datos de cliente 
CREATE OR REPLACE TRIGGER trg_update_cli
AFTER UPDATE ON CLIENTES
FOR EACH ROW
DECLARE
BEGIN
    INSERT INTO registro_clientes (accion, id_cliente, fecha)
    VALUES ('Actualización', :NEW.id_cliente, SYSDATE);
END;

--Trigger para actualizar inventario, con cursor 

CREATE OR REPLACE TRIGGER trg_update_inventario
AFTER INSERT ON pedidos
FOR EACH ROW
DECLARE
    v_stock_actual NUMBER;
    CURSOR c_detalle_pedido IS
        SELECT id_producto, cantidad
        FROM detalle_pedido
        WHERE id_pedido = :NEW.id_pedido;
BEGIN
    -- Recorre la información del producto y actualiza la cantidad
    FOR prod IN c_detalle_pedido LOOP
        -- Obtiene el stock actual del producto
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