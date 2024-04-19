CURSORES 
--CURSOR 1 
create or replace NONEDITIONABLE PROCEDURE Actualizar_Admin_Tienda (
    p_id_admin ADMIN_TIENDA.ID_ADMIN_TIENDA%TYPE,
    p_nombre ADMIN_TIENDA.NOMBRE%TYPE,
    p_apellido ADMIN_TIENDA.APELLIDO%TYPE,
    p_correo ADMIN_TIENDA.CORREO%TYPE,
    p_telefono ADMIN_TIENDA.TELEFONO%TYPE 
) AS
    CURSOR c_admin_tienda IS
        SELECT id_Admin_TIENDA
        FROM ADMIN_TIENDA
        WHERE id_Admin_TIENDA = p_id_admin;

    v_id_admin ADMIN_TIENDA.id_Admin_TIENDA%TYPE;
BEGIN
    OPEN c_admin_tienda;

    FETCH c_admin_tienda INTO v_id_admin;
    IF c_admin_tienda%FOUND THEN
        -- El administrador de tienda existe, proceder con la actualización
        UPDATE ADMIN_TIENDA
        SET nombre = p_nombre,
            apellido = p_apellido,
            correo = p_correo,
            telefono = p_telefono
        WHERE id_Admin_TIENDA = p_id_admin;

        COMMIT;
        DBMS_OUTPUT.PUT_LINE('Información del administrador de tienda actualizados correctamente.');
    ELSE
        -- El administrador de tienda no existe, mostrar mensaje de error
        DBMS_OUTPUT.PUT_LINE('El administrador de tienda con ID ' || p_id_admin || ' no existe.');
    END IF;

    CLOSE c_admin_tienda;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Error al actualizar detalles del administrador de tienda');
END Actualizar_Admin_Tienda;

--CURSOR 2 
create or replace NONEDITIONABLE PROCEDURE Actualizar_Cantidad_Producto (
    p_id_producto IN NUMBER, 
    p_nueva_cantidad IN NUMBER
) IS
    CURSOR c_producto IS
        SELECT NOMBRE, DESCRIPCION
        FROM PRODUCTOS
        WHERE ID_PRODUCTO = p_id_producto;

    v_nombre_producto PRODUCTOS.NOMBRE%TYPE;
    v_descripcion_producto PRODUCTOS.DESCRIPCION%TYPE;
BEGIN

    OPEN c_producto;
    FETCH c_producto INTO v_nombre_producto, v_descripcion_producto;
    CLOSE c_producto;

    -- Actualizar la cantidad del producto
    UPDATE PRODUCTOS
    SET CANTIDAD = p_nueva_cantidad
    WHERE ID_PRODUCTO = p_id_producto;

    -- Confirmar la transacción
    COMMIT;

    -- Mostrar mensaje de éxito
    DBMS_OUTPUT.PUT_LINE('Cantidad del producto ' || v_nombre_producto || ' actualizada correctamente.');
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró ningún producto con el ID especificado.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Se produjo un error al actualizar la cantidad del producto: ' || SQLERRM);
END Actualizar_Cantidad_Producto;Ç

--CURSOR 3 
create or replace NONEDITIONABLE PROCEDURE Buscar_Producto_Por_Nombre (p_nombre IN VARCHAR2) IS
    CURSOR c_producto IS
        SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO
        FROM PRODUCTOS
        WHERE UPPER(NOMBRE) = UPPER(p_nombre);
    v_encontrado BOOLEAN := FALSE;
BEGIN
    FOR producto IN c_producto LOOP
        v_encontrado := TRUE;
        DBMS_OUTPUT.PUT_LINE('ID: ' || producto.ID_PRODUCTO || ', Nombre: ' || producto.NOMBRE ||
                             ', Descripción: ' || producto.DESCRIPCION || ', Cantidad: ' || producto.CANTIDAD ||
                             ', Precio: ' || producto.PRECIO);
    END LOOP;

    IF NOT v_encontrado THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró ningún producto con el nombre especificado.');
    END IF;
END Buscar_Producto_Por_Nombre;

--CURSOR 4 
create or replace NONEDITIONABLE PROCEDURE Mostrar_Productos IS
    CURSOR c_productos IS
        SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO
        FROM PRODUCTOS;
BEGIN
    FOR producto IN c_productos LOOP
        DBMS_OUTPUT.PUT_LINE('ID: ' || producto.ID_PRODUCTO || ', Nombre: ' || producto.NOMBRE ||
                             ', Descripción: ' || producto.DESCRIPCION || ', Cantidad: ' || producto.CANTIDAD ||
                             ', Precio: ' || producto.PRECIO);
    END LOOP;
END Mostrar_Productos;

--CURSOR 5 
create or replace NONEDITIONABLE PROCEDURE Calc_descuento IS 
    CURSOR SALE IS
        SELECT ID_FACTURA,FECHA_FACTURA,TOTAL,PRECIO
        FROM FACTURAS
        WHERE TOTAL > 200000; --Esto para sacar las facturas que tengan un monto alto

    v_id_fac FACTURAS.ID_FACTURA%TYPE;
    v_fecha_fac FACTURAS.FECHA_FACTURA%TYPE;
    v_total_fac FACTURAS.TOTAL%TYPE; 
    v_precio_fac FACTURAS.PRECIO%TYPE; 
    v_desc NUMBER; 
BEGIN
    OPEN SALE;

    LOOP
        FETCH SALE INTO v_id_fac, v_fecha_fac, v_total_fac, v_precio_fac;

        EXIT WHEN SALE%NOTFOUND;

        -- Calculamos el descuento para las facturas altas 
        v_desc := v_total_fac * 0.10; 

        -- Imprimimos el precio nuevo con descuento 
        DBMS_OUTPUT.PUT_LINE('El precio nuevo con descuento sería: ' || (v_total_fac - v_desc));
    END LOOP;

    CLOSE SALE;
END;