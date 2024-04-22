CREATE OR REPLACE PACKAGE paquete_categorias AS
  PROCEDURE actualizar_categoria(
    p_id_categoria IN NUMBER,
    p_categoria_nombre IN VARCHAR2);
    
  PROCEDURE eliminar_categoria(p_id_categoria IN NUMBER);

  PROCEDURE insertar_categoria(
    p_id_categoria IN NUMBER,
    p_nombre_categoria IN VARCHAR2);
    
END paquete_categorias;

CREATE OR REPLACE PACKAGE BODY Paquete_Categorias AS
    PROCEDURE actualizar_categoria (
        p_id_categoria IN NUMBER,
        p_categoria_nombre IN VARCHAR2
    )
    IS
    BEGIN
        UPDATE CATEGORIAS
        SET nombre = p_categoria_nombre
        WHERE ID_CATEGORIA = p_id_categoria;
        
        --COMMIT; 
    END actualizar_categoria;
    
    PROCEDURE eliminar_categoria (
        p_id_categoria IN NUMBER
    )
    AS
    BEGIN
        DELETE FROM CATEGORIAS
        WHERE ID_CATEGORIA = p_id_categoria;
        
        --COMMIT; 
    END eliminar_categoria;
    
    PROCEDURE insertar_categoria ( 
        p_id_categoria IN NUMBER,
        p_nombre_categoria IN VARCHAR2
    )
    AS
    BEGIN
        INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
        VALUES (p_id_categoria, p_nombre_categoria);
        
        COMMIT; 
        DBMS_OUTPUT.PUT_LINE('¡Categoria insertada correctamente!');
    EXCEPTION
        WHEN OTHERS THEN
            DBMS_OUTPUT.PUT_LINE('Error al insertar categoria');
    END insertar_categoria;
    
END Paquete_Categorias;

BEGIN
    Paquete_Categorias.insertar_categoria(101, 'Zapatos-Mujer');
END;
 
 


CREATE OR REPLACE PACKAGE Paquete_Detalle_Pedido AS
    PROCEDURE actualizar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER,
        p_cantidad IN NUMBER,
        p_precio IN NUMBER
    );

    PROCEDURE eliminar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER
    );

    PROCEDURE Insertar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER,
        p_cantidad IN NUMBER,
        p_precio IN NUMBER
    );
END Paquete_Detalle_Pedido;


CREATE OR REPLACE PACKAGE BODY Paquete_Detalle_Pedido AS
    PROCEDURE actualizar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER,
        p_cantidad IN NUMBER,
        p_precio IN NUMBER
    )
    IS
    BEGIN
        UPDATE DETALLE_PEDIDO
        SET CANTIDAD = p_cantidad,
            PRECIO = p_precio
        WHERE ID_DETALLE_PEDIDO = p_id_detalle_pedido;
        -- COMMIT;
    END actualizar_DETALLE_PEDIDO;

    PROCEDURE eliminar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER
    )
    AS
    BEGIN
        DELETE FROM DETALLE_PEDIDO
        WHERE ID_DETALLE_PEDIDO = p_id_detalle_pedido;
        -- COMMIT;
    END eliminar_DETALLE_PEDIDO;

    PROCEDURE Insertar_DETALLE_PEDIDO (
        p_id_detalle_pedido IN NUMBER,
        p_cantidad IN NUMBER,
        p_precio IN NUMBER
    )
    AS
    BEGIN
        INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO)
        VALUES (p_id_detalle_pedido, p_cantidad, p_precio);
        COMMIT;
        DBMS_OUTPUT.PUT_LINE('¡Detalle de pedido insertado correctamente!');
    EXCEPTION
        WHEN OTHERS THEN
            DBMS_OUTPUT.PUT_LINE('Error al insertar detalle de pedido!');
    END Insertar_DETALLE_PEDIDO;
END Paquete_Detalle_Pedido;



CREATE OR REPLACE PACKAGE Paquete_Facturas AS
    PROCEDURE actualizar_factura (
        p_id_factura IN NUMBER,
        p_fecha_factura IN DATE,
        p_total IN NUMBER,
        p_precio IN NUMBER
    );

    PROCEDURE eliminar_FACTURA (
        p_id_factura IN NUMBER
    );

    PROCEDURE Insertar_FACTURA (
        p_id_factura IN NUMBER,
        p_fecha_factura IN DATE,
        p_total IN NUMBER,
        p_precio IN NUMBER
    );
END Paquete_Facturas;


CREATE OR REPLACE PACKAGE BODY Paquete_Facturas AS
    PROCEDURE actualizar_factura (
        p_id_factura IN NUMBER,
        p_fecha_factura IN DATE,
        p_total IN NUMBER,
        p_precio IN NUMBER
    )
    IS
    BEGIN
        UPDATE FACTURAS
        SET FECHA_FACTURA = p_fecha_factura,
            TOTAL = p_total,
            PRECIO = p_precio
        WHERE ID_FACTURA = p_id_factura;
        -- COMMIT;
    END actualizar_factura;

    PROCEDURE eliminar_FACTURA (
        p_id_factura IN NUMBER
    )
    AS
    BEGIN
        DELETE FROM FACTURAS
        WHERE ID_FACTURA = p_id_factura;
        -- COMMIT;
    END eliminar_FACTURA;

    PROCEDURE Insertar_FACTURA (
        p_id_factura IN NUMBER,
        p_fecha_factura IN DATE,
        p_total IN NUMBER,
        p_precio IN NUMBER
    )
    AS
    BEGIN
        INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO)
        VALUES (p_id_factura, p_fecha_factura, p_total, p_precio);
        COMMIT;
        DBMS_OUTPUT.PUT_LINE('¡Factura insertada correctamente!');
    EXCEPTION
        WHEN OTHERS THEN
            DBMS_OUTPUT.PUT_LINE('Error al insertar factura!');
    END Insertar_FACTURA;
END Paquete_Facturas; 



CREATE OR REPLACE PACKAGE Paquete_Admin_Tienda AS
    PROCEDURE actualizar_ADMIN_TIENDA (
        id_Admin IN NUMBER, 
        Correo IN VARCHAR2,
        telef IN VARCHAR2
    );

    PROCEDURE eliminar_ADMIN_TIENDA (
        Admin_id IN NUMBER
    );

    PROCEDURE Insertar_ADMIN_TIENDA (
        id_Admin_TIENDA IN NUMBER,
        Nombre IN VARCHAR2,
        Apellido IN VARCHAR2,
        Correo IN VARCHAR2,
        telefono IN VARCHAR2
    );
END Paquete_Admin_Tienda;


CREATE OR REPLACE PACKAGE BODY Paquete_Admin_Tienda AS
    PROCEDURE actualizar_ADMIN_TIENDA (
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
    END actualizar_ADMIN_TIENDA;

    PROCEDURE eliminar_ADMIN_TIENDA (
        Admin_id IN NUMBER
    )
    AS
    BEGIN
        DELETE FROM ADMIN_TIENDA
        WHERE id_Admin_TIENDA = Admin_Id;
        -- COMMIT; 
    END eliminar_ADMIN_TIENDA;

    PROCEDURE Insertar_ADMIN_TIENDA (
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
    END Insertar_ADMIN_TIENDA;
END Paquete_Admin_Tienda;


