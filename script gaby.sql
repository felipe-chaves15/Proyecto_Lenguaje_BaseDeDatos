CREATE TABLE DETALLE_PEDIDO (
    ID_DETALLE_PEDIDO NUMBER PRIMARY KEY NOT NULL,
    CANTIDAD NUMBER (20),
    PRECIO NUMBER (10)
    );

CREATE TABLE PEDIDOS (
    ID_PEDIDO NUMBER PRIMARY KEY NOT NULL,
    FECHA_PEDIDO DATE, 
    FECHA_ENTREGA DATE, 
    TOTAL NUMBER (10),
    ESTADO_PEDIDO VARCHAR(30)
    );
    
CREATE TABLE FACTURAS (
    ID_FACTURA NUMBER PRIMARY KEY NOT NULL,
    FECHA_FACTURA DATE, 
    TOTAL NUMBER (10),
    PRECIO NUMBER (10)
    );
    
CREATE TABLE ADMIN_TIENDA (
    id_Admin_TIENDA  NUMBER PRIMARY KEY NOT NULL,
    nombre VARCHAR2(50), 
    apellido VARCHAR2(50), 
    correo VARCHAR2(100),
    telefono VARCHAR2(20)
    );
	
ALTER TABLE DETALLE_PEDIDO ADD ID_PEDIDO NUMBER;

ALTER TABLE DETALLE_PEDIDO ADD ID_PRODUCTO NUMBER(20);

ALTER TABLE PEDIDOS ADD ID_CLIENTE NUMBER(20);

ALTER TABLE FACTURAS ADD ID_PEDIDO NUMBER;

ALTER TABLE ADMIN_TIENDA ADD ID_FACTURA NUMBER;

ALTER TABLE ADMIN_TIENDA ADD ID_PEDIDO NUMBER;


ALTER TABLE DETALLE_PEDIDO
ADD CONSTRAINT FK_PEDIDO
FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDOS (ID_PEDIDO);

ALTER TABLE DETALLE_PEDIDO
ADD CONSTRAINT FK_PRODUCTO
FOREIGN KEY (ID_PRODUCTO) REFERENCES PRODUCTOS (ID_PRODUCTO);

ALTER TABLE PEDIDOS
ADD CONSTRAINT FK_CLIENTE
FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTES (ID_CLIENTE);

ALTER TABLE FACTURAS
ADD CONSTRAINT PEDIDO_FK
FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDOS (ID_PEDIDO);

CREATE OR REPLACE PROCEDURE InsertarADMIN_TIENDA (
    id_Admin_TIENDA IN NUMBER,
    Nombre IN VARCHAR2,
    Apellido IN VARCHAR2,
    Correo IN VARCHAR2,
    telefono IN VARCHAR2
)
AS
BEGIN

    INSERT INTO ADMIN_TIENDA (id_Admin_TIENDA, nombre, apellido, correo, telefono)
    VALUES (id_Admin_TIENDA, Nombre, Apellido, Correo, Telefono);
    
    COMMIT;
END;

CREATE OR REPLACE PROCEDURE update_ADMIN_TIENDA (
    id_Admin IN NUMBER, 
    Correo IN VARCHAR2,
    telef IN VARCHAR2
)
AS
BEGIN
    UPDATE ADMIN_TIENDA
    SET correo = Correo, telefono = telef
    WHERE id_Admin_TIENDA = id_Admin;
    
   -- COMMIT; 
END;

CREATE OR REPLACE PROCEDURE Delete_ADMIN_TIENDA (
    Admin_id IN NUMBER
)
AS
BEGIN
    DELETE FROM ADMIN_TIENDA
    WHERE id_Admin_TIENDA = Admin_Id;
    
    --COMMIT; 
END;

CREATE OR REPLACE PROCEDURE Insertar_DETALLE_PEDIDO ( 
    p_id_detalle_pedido IN NUMBER,
    p_cantidad IN NUMBER,
    P_precio IN NUMBER
) AS
BEGIN
    INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO,CANTIDAD,PRECIO)
    VALUES (p_id_detalle_pedido, p_cantidad,P_precio );
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡Detalle pedido insertado correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar detalle de pedido!');
        
END Insertar_DETALLE_PEDIDO;

CREATE OR REPLACE PROCEDURE actualizar_DETALLE_PEDIDO ( 
    p_id_detalle_pedido IN NUMBER,
    p_cantidad IN NUMBER,
    P_precio IN NUMBER

)
IS
BEGIN
    UPDATE DETALLE_PEDIDO
    SET CANTIDAD = p_cantidad,
        PRECIO = P_precio
        
    WHERE ID_DETALLE_PEDIDO= p_id_detalle_pedido;
    
    --COMMIT;
END actualizar_DETALLE_PEDIDO;

CREATE OR REPLACE PROCEDURE Delete_DETALLE_PEDIDO (
    p_id_detalle_pedido IN NUMBER
)
AS
BEGIN
    DELETE FROM DETALLE_PEDIDO
    WHERE ID_DETALLE_PEDIDO = p_id_detalle_pedido;
    
    --COMMIT; 
END;

CREATE OR REPLACE PROCEDURE InsertarPedidos ( 
    p_id_pedido IN NUMBER,
    p_fecha_pedido IN DATE,
    P_fecha_entrega IN DATE,
    p_total IN NUMBER,
    p_estado_pedido IN VARCHAR
) 
AS
BEGIN
    INSERT INTO PEDIDOS (ID_PEDIDO,FECHA_PEDIDO,FECHA_ENTREGA,TOTAL,ESTADO_PEDIDO)
    VALUES (p_id_pedido, p_fecha_pedido,P_fecha_entrega,p_total,p_estado_pedido);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡Pedido insertado correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar pedido');
END InsertarPedidos;

CREATE OR REPLACE PROCEDURE actualizar_pedido ( 
    p_id_pedido IN NUMBER,
    p_fecha_pedido IN DATE,
    P_fecha_entrega IN DATE,
    p_total IN NUMBER,
    p_estado_pedido IN VARCHAR

)
IS
BEGIN
    UPDATE PEDIDOS 
    SET FECHA_PEDIDO = p_fecha_pedido,
        FECHA_ENTREGA = P_fecha_entrega,
        TOTAL = p_total,
        ESTADO_PEDIDO = p_estado_pedido
        
    WHERE ID_PEDIDO= p_id_pedido;
    
    --COMMIT;
END actualizar_pedido;

CREATE OR REPLACE PROCEDURE Delete_pedido (
    p_id_pedido IN NUMBER
)
AS
BEGIN
    DELETE FROM PEDIDOS
    WHERE ID_PEDIDO = p_id_pedido;
    
    --COMMIT; 
END;

CREATE OR REPLACE PROCEDURE Insertar_FACTURAS ( 
    p_id_facturas IN NUMBER,
    p_fecha_factura IN DATE,
    P_total IN NUMBER,
    p_precio IN NUMBER
) AS
BEGIN
    INSERT INTO FACTURAS (ID_FACTURA,FECHA_FACTURA,TOTAL,PRECIO)
    VALUES (p_id_facturas, p_fecha_factura,P_total,p_precio );
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡Factura insertada correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar factura!');
        
END Insertar_FACTURAS;

CREATE OR REPLACE PROCEDURE actualizar_factura ( 
    p_id_facturas IN NUMBER,
    p_fecha_factura IN DATE,
    P_total IN NUMBER,
    p_precio IN NUMBER
)
IS
BEGIN
    UPDATE FACTURAS
    SET FECHA_FACTURA = p_fecha_factura,
        TOTAL = P_total,
        PRECIO = p_precio
        
    WHERE ID_FACTURA= p_id_facturas;
    
    --COMMIT;
END actualizar_factura;

CREATE OR REPLACE PROCEDURE Delete_FACTURAS (
    p_id_facturas IN NUMBER
)
AS
BEGIN
    DELETE FROM FACTURAS
    WHERE ID_FACTURA = p_id_facturas;
    
    --COMMIT; 
END;

