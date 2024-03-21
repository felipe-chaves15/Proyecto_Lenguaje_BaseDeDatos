alter session set "_ORACLE_SCRIPT" = TRUE;


CREATE USER LENGDB_ADM IDENTIFIED BY "1234";

SELECT username, account_status, expiry_date
FROM dba_users
ORDER BY USERNAME DESC;


SELECT user, account_status from dba_users where user = 'LENGDB_ADM';


CREATE TABLE PRODUCTOS (ID_PRODUCTO NUMBER(20)PRIMARY KEY NOT NULL,NOMBRE VARCHAR2 (50),DESCRIPCION VARCHAR2 (100),CANTIDAD NUMBER (10),PRECIO NUMBER (10));

CREATE TABLE CATEGORIAS (ID_CATEGORIA NUMBER(20)PRIMARY KEY NOT NULL,NOMBRE VARCHAR2 (50));

CREATE TABLE MARCAS (ID_MARCA NUMBER(20)PRIMARY KEY NOT NULL,NOMBRE VARCHAR2 (50));

CREATE TABLE CLIENTES (ID_CLIENTE NUMBER(20)PRIMARY KEY NOT NULL,NOMBRE VARCHAR2 (50),APELLIDO VARCHAR2 (50),CORREO VARCHAR2(100), TELEFONO VARCHAR2(20), DIRECCION VARCHAR2(35));

INSERT INTO CLIENTES (ID_CLIENTE,NOMBRE,APELLIDO,CORREO, TELEFONO, DIRECCION) VALUES (1,'Maria','Salas','m.salas',645689,'heredia');

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

ALTER TABLE PRODUCTOS ADD ID_CATEGORIA NUMBER(20);

ALTER TABLE PRODUCTOS ADD ID_MARCA NUMBER(20);

ALTER TABLE DETALLE_PEDIDO ADD ID_PEDIDO NUMBER;

ALTER TABLE DETALLE_PEDIDO ADD ID_PRODUCTO NUMBER(20);

ALTER TABLE PEDIDOS ADD ID_CLIENTE NUMBER(20);

ALTER TABLE FACTURAS ADD ID_PEDIDO NUMBER;

ALTER TABLE ADMIN_TIENDA ADD ID_FACTURA NUMBER;

ALTER TABLE ADMIN_TIENDA ADD ID_PEDIDO NUMBER;

ALTER TABLE ADMIN_TIENDA ADD ID_PRODUCTO NUMBER(20);

ALTER TABLE ADMIN_TIENDA ADD ID_MARCA NUMBER(20) ;

ALTER TABLE ADMIN_TIENDA ADD ID_CATEGORIA NUMBER(20);


ALTER TABLE PRODUCTOS
ADD CONSTRAINT FK_CATEGORIA
FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIAS (ID_CATEGORIA);

ALTER TABLE PRODUCTOS
ADD CONSTRAINT FK_MARCA
FOREIGN KEY (ID_MARCA) REFERENCES MARCAS (ID_MARCA);

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


ALTER TABLE ADMIN_TIENDA
ADD CONSTRAINT FACTURA_FK
FOREIGN KEY (ID_FACTURA) REFERENCES FACTURAS (ID_FACTURA);

ALTER TABLE ADMIN_TIENDA
ADD CONSTRAINT PEDIDOFK
FOREIGN KEY (ID_PEDIDO) REFERENCES PEDIDOS (ID_PEDIDO);

ALTER TABLE ADMIN_TIENDA
ADD CONSTRAINT PRODUCTOFK
FOREIGN KEY (ID_PRODUCTO) REFERENCES PRODUCTOS (ID_PRODUCTO);

ALTER TABLE ADMIN_TIENDA
ADD CONSTRAINT MARCAFK
FOREIGN KEY (ID_MARCA) REFERENCES MARCAS (ID_MARCA);

ALTER TABLE ADMIN_TIENDA
ADD CONSTRAINT CATEGORIAFK
FOREIGN KEY (ID_CATEGORIA) REFERENCES CATEGORIAS (ID_CATEGORIA);


--ALTER TABLE PRODUCTOS DROP CONSTRAINT FK_MARCA;




SET SERVEROUTPUT ON;

--STORE PROCEDURES
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



--CLIENTE
CREATE OR REPLACE PROCEDURE InsertarCliente (
    p_id_cliente IN NUMBER,
    p_nombre IN VARCHAR2,
    p_apellido IN VARCHAR2,
    p_correo IN VARCHAR2,
    p_telefono IN VARCHAR2,
    p_direccion IN VARCHAR2
)
AS
BEGIN
    INSERT INTO Clientes (ID_CLIENTE, Nombre, Apellido, Correo, Telefono, Direccion)
    VALUES (p_id_cliente, p_nombre, p_apellido, p_correo, p_telefono, p_direccion);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡Registro insertado correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar el registro: ');
END InsertarCliente;

CREATE OR REPLACE PROCEDURE actualizar_cliente (
    p_id_cliente IN NUMBER,
    p_nuevo_nombre IN VARCHAR2,
    p_nuevo_apellido IN VARCHAR2,
     p_nuevo_correo IN VARCHAR2,
      p_nuevo_telefono IN VARCHAR2,
       p_nuevo_direccion IN VARCHAR2
)
IS
BEGIN
    UPDATE clientes
    SET nombre = p_nuevo_nombre,
        apellido = p_nuevo_apellido,
        correo = p_nuevo_correo,
        telefono = p_nuevo_telefono,
        direccion = p_nuevo_direccion
    WHERE id_cliente = p_id_cliente;
    
    --COMMIT;
END actualizar_cliente;

CREATE OR REPLACE PROCEDURE Delete_cliente (
    CLIENTE_ID IN NUMBER
)
AS
BEGIN
    DELETE FROM CLIENTES
    WHERE ID_CLIENTE = CLIENTE_ID;
    
    COMMIT; 
END;

--PRODUCTOS
CREATE OR REPLACE PROCEDURE InsertarProductos (
    p_id_producto IN NUMBER,
    p_nombre IN VARCHAR2,
    p_descripcion IN VARCHAR2,
    p_cantidad IN NUMBER,
    p_precio IN NUMBER
)
AS
BEGIN
    INSERT INTO PRODUCTOS (ID_PRODUCTO,NOMBRE,DESCRIPCION,CANTIDAD,PRECIO)
    VALUES (p_id_producto, p_nombre, p_descripcion, p_cantidad, p_precio);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡Producto insertado correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar producto');
END InsertarProductos;

CREATE OR REPLACE PROCEDURE actualizar_productos ( 
    p_id_producto IN NUMBER,
    p_producto_nombre IN VARCHAR2,
    p_descripcion IN VARCHAR2,
     p_cantidad IN NUMBER,
      p_precio IN NUMBER
)
IS
BEGIN
    UPDATE PRODUCTOS
    SET nombre = p_producto_nombre,
        DESCRIPCION = p_descripcion,
        CANTIDAD = p_cantidad,
        PRECIO = p_precio
    WHERE ID_PRODUCTO = p_id_producto;
    
    --COMMIT;
END actualizar_productos;

CREATE OR REPLACE PROCEDURE Delete_Productos (
    producto_ID IN NUMBER
)
AS
BEGIN
    DELETE FROM PRODUCTOS
    WHERE ID_PRODUCTO = producto_ID;
    
    --COMMIT; 
END;

--CATEGORIAS
CREATE OR REPLACE PROCEDURE InsertarCategoria ( 
    p_id_categoria IN NUMBER,
    p_nombre_categoria IN VARCHAR2
) AS
BEGIN
    INSERT INTO CATEGORIAS (ID_CATEGORIA,NOMBRE)
    VALUES (p_id_categoria, p_nombre_categoria);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡categoria insertado correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar categoria');
END InsertarCategoria;

CREATE OR REPLACE PROCEDURE actualizar_categoria ( 
    p_id_categoria IN NUMBER,
    p_categoria_nombre IN VARCHAR2

)
IS
BEGIN
    UPDATE CATEGORIAS
    SET nombre = p_categoria_nombre
        
    WHERE ID_CATEGORIA= p_id_categoria;
    
    --COMMIT;
END actualizar_categoria;

CREATE OR REPLACE PROCEDURE Delete_categoria (
    p_id_categoria IN NUMBER
)
AS
BEGIN
    DELETE FROM CATEGORIAS
    WHERE ID_CATEGORIA = p_id_categoria;
    
    --COMMIT; 
END;

--MARCAS
CREATE OR REPLACE PROCEDURE InsertarMarca ( 
    p_id_marca IN NUMBER,
    p_nombre_marca IN VARCHAR2
) AS
BEGIN
    INSERT INTO MARCAS (ID_MARCA,NOMBRE)
    VALUES (p_id_marca, p_nombre_marca);
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('¡marca insertada correctamente!');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar marca');
END InsertarMarca;

CREATE OR REPLACE PROCEDURE actualizar_marca ( 
    p_id_marca IN NUMBER,
    p_nombre_marca IN VARCHAR2

)
IS
BEGIN
    UPDATE MARCAS
    SET nombre = p_nombre_marca
        
    WHERE ID_MARCA= p_id_marca;
    
    --COMMIT;
END actualizar_marca;

CREATE OR REPLACE PROCEDURE Delete_marcas (
    p_id_marca IN NUMBER
)
AS
BEGIN
    DELETE FROM MARCAS
    WHERE ID_MARCA = p_id_marca;
    
    --COMMIT; 
END;

--DETALLE PEDIDO
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

--PEDIDOS
--alter table pedidos modify total number;

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

--FACTURAS 
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

--VISTAS

CREATE VIEW vista_productos_administracion AS
SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.precio,
       a.id_admin_tienda
FROM productos p
JOIN admin_tienda a ON p.id_producto = a.id_producto;


SELECT * FROM vista_productos_administracion;

CREATE VIEW vista_pedidos_facturas AS
SELECT p.id_pedido, p.fecha_pedido, 
       f.total
FROM pedidos p
JOIN facturas f ON p.id_pedido = f.id_pedido;

SELECT * FROM vista_pedidos_facturas;

CREATE VIEW vista_clientes_pedidos AS
SELECT c.id_cliente, c.nombre, c.apellido,
       p.id_pedido, p.fecha_pedido, p.estado_pedido
FROM clientes c
JOIN pedidos p ON c.id_cliente = p.id_cliente;

SELECT * FROM vista_clientes_pedidos;

CREATE VIEW vista_detalles_pedido AS
SELECT dp.id_detalle_pedido, dp.precio, dp.cantidad,
       p.fecha_entrega, p.fecha_pedido, p.total
FROM detalle_pedido dp
JOIN pedidos p ON dp.id_pedido = p.id_pedido;

SELECT * FROM vista_detalles_pedido;


CREATE VIEW vista_producto_categoria AS
SELECT p.id_producto, p.descripcion, p.precio,
       c.id_categoria, c.nombre
FROM productos p
JOIN categorias c ON p.id_categoria = c.id_categoria;


SELECT * FROM vista_producto_categoria;


CREATE VIEW vista_factura_admin AS
SELECT f.id_factura, f.fecha_factura, f.total,
       a.id_admin_tienda, a.nombre, a.apellido
FROM facturas f
JOIN admin_tienda a ON f.id_factura = a.id_factura;



