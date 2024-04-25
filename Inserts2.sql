--INSERTS DE ADMIN TIENDA  
INSERT INTO ADMIN_TIENDA (ID_ADMIN_TIENDA, NOMBRE, APELLIDO, CORREO, TELEFONO, ID_FACTURA, ID_PEDIDO, ID_PRODUCTO, ID_MARCA, ID_CATEGORIA)
VALUES (01,'FELIPE ','CHAVES', 'FELI@UIFIDE.COM', '88741235', 01, 01, 01,01,01);

INSERT INTO ADMIN_TIENDA (ID_ADMIN_TIENDA, NOMBRE, APELLIDO, CORREO, TELEFONO, ID_FACTURA, ID_PEDIDO, ID_PRODUCTO, ID_MARCA, ID_CATEGORIA)
VALUES (02,'GABRIELA' ,'IMENEZ', 'GABY@UIFIDE.COM', '88741235', 01, 01, 01,01,01);

INSERT INTO ADMIN_TIENDA (ID_ADMIN_TIENDA, NOMBRE, APELLIDO, CORREO, TELEFONO, ID_FACTURA, ID_PEDIDO, ID_PRODUCTO, ID_MARCA, ID_CATEGORIA)
VALUES (03, 'TATIANA' ,'OBREGON', 'TATI@UIFIDE.COM', '88542210', 01, 01, 01,01,01);

INSERT INTO ADMIN_TIENDA (ID_ADMIN_TIENDA, NOMBRE, APELLIDO, CORREO, TELEFONO, ID_FACTURA, ID_PEDIDO, ID_PRODUCTO, ID_MARCA, ID_CATEGORIA)
VALUES (04, 'ADRIAN' ,'BONILLA', 'ADRIB@UIFIDE.COM', '70102543', 01, 01, 01,01,01);

INSERT INTO ADMIN_TIENDA (ID_ADMIN_TIENDA, NOMBRE, APELLIDO, CORREO, TELEFONO, ID_FACTURA, ID_PEDIDO, ID_PRODUCTO, ID_MARCA, ID_CATEGORIA)
VALUES (05,'LUCIA' ,'ARIAS', 'LUCI@UIFIDE.COM', '60401326', 01, 01, 01,01,01);

--INSERTS DE CATEGORIAS 
INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (01, 'PALETAS DE SOMBRAS');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (02, 'LABIALES');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (03, 'RUBORES');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (04, 'MÁSCARA DE PESTAÑAS');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (05, 'DELINEADORES');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (06, 'BROCHAS');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (07, 'POLVOS COMPACTOS');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (08, 'PRIMER');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (09, 'CONTORNOS');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (10, 'ILUMINADORES');

INSERT INTO CATEGORIAS (ID_CATEGORIA, NOMBRE)
VALUES (11, 'CORRECTORES');

--INSERTS DE CLIENTES 

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (01, 'PEDRO', 'CALVO','PEDROC@GMAIL.COM' , '88546301', 'TRINIDAD DE MORAVIA');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (02, 'ADRIANA', 'DURAN','ADRI02@GMAIL.COM' , '85246384', 'BARRIO MÉXICO');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (03, 'VALERIA', 'CASCANTE','VALCA@GMAIL.COM' , '82659212', 'SAN MIGUEL');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (04, 'RANDALL', 'QUESADA','QUESADA@GMAIL.COM' , '85129624', 'DESAMPARADOS');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (05, 'ISABEL', 'ESPINOZA','ISAE@GMAIL.COM' , '89457218', 'SABANA NORTE');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (06, 'JUAN CARLOS', 'JIMENEZ','JUANJ@GMAIL.COM' , '40251001', 'TREJOS MONTE ALEGRE');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (07, 'KENDALL', 'WASTON','KENW@GMAIL.COM' , '80129854', 'TIBAS');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (08, 'SHARON', 'SEGURA','SHAS@GMAIL.COM' , '70146329', 'ALAJUELITA');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (08, 'MARITZA', 'ARIAS','MARY76@GMAIL.COM' , '70206298', 'MERCEDES NORTE');

INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION)
VALUES (08, 'JOSHUA', 'FERNANDEZ','JOSHF01@GMAIL.COM' , '60257085', 'ALAJUELA');

--INSERTS DETALLE PEDIDO 
INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO, ID_PEDIDO, ID_PRODUCTO)
VALUES (01, 3, 7500, 01, 04);

INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO, ID_PEDIDO, ID_PRODUCTO)
VALUES (02, 2, 16000, 02, 01); 

INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO, ID_PEDIDO, ID_PRODUCTO)
VALUES (03, 5,12500, 03 , 07);

INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO, ID_PEDIDO, ID_PRODUCTO)
VALUES (04, 1, 7500, 04, 09);

INSERT INTO DETALLE_PEDIDO (ID_DETALLE_PEDIDO, CANTIDAD, PRECIO, ID_PEDIDO, ID_PRODUCTO)
VALUES (05, 3, 9000, 05, 08); 

--INSERT DE FACTURAS 
INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO)
VALUES (01, '2024-04-23',7500,x,01);

INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO)
VALUES (02, '2024-04-15',16000,x,02);

INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO)
VALUES (03, '2024-04-10',12500,x,03);

INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO)
VALUES (04, '2024-04-23',7500,x, 04);

INSERT INTO FACTURAS (ID_FACTURA, FECHA_FACTURA, TOTAL, PRECIO, ID_PEDIDO)
VALUES (05, '2024-04-23',9000,x, 05);

--INSERTS DE MARCAS
INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (01, 'BEAU VISAGE');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (02, 'BEAUTY CREATIONS');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (03, 'AMUSE');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (04, 'TRENDY COSMETICS');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (05, 'DOLCE BELLA');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (06, 'AMOR US');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (07, 'ITALIA DELUXE');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (08, 'MOIRA');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (09, 'BEBELLA');

INSERT INTO MARCAS (ID_MARCA, NOMBRE)
VALUES (09, 'RUDE COSMETICS');


--INSESRTS DE PEDIDOS 
INSERT INTO MARCAS (ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA , TOTAL, ESTADO_PEDIDO, ID_CLIENTE)
VALUES (01, '2024-04-23', '2024-05-01',7500, 'PENDIENTE', 01);

INSERT INTO MARCAS (ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA , TOTAL, ESTADO_PEDIDO, ID_CLIENTE)
VALUES (02, '2024-04-15', '2024-04-18',16000, 'ENTREGADO', 05);

INSERT INTO MARCAS (ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA , TOTAL, ESTADO_PEDIDO, ID_CLIENTE)
VALUES (03, '2024-04-10', '2024-04-13',12500, 'ENTREGADO', 04);

INSERT INTO MARCAS (ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA , TOTAL, ESTADO_PEDIDO, ID_CLIENTE)
VALUES (04, '2024-04-23', '2024-04-26',7500, 'PENDIENTE', 03);

INSERT INTO MARCAS (ID_PEDIDO, FECHA_PEDIDO, FECHA_ENTREGA , TOTAL, ESTADO_PEDIDO, ID_CLIENTE)
VALUES (05, '2024-04-23', '2024-04-28',9000, 'PENDIENTE', 07);

--INSERTS DE PRODUCTOS 
INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (01, 'PALETA CAKE POP', 'PALETA DE SOMBRAS DE 32 TONOS', 10,8000, 01, 06);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (02, 'PALETA TEASE ME', 'PALETA DE SOMBRAS DE 18 TONOS TIERRA', 10,12000, 01, 02);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (03, 'PALETA LOTUS LOVE', 'PALETA DE SOMBRAS DE 16 TONOS', 7 ,8000, 01, 09);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (04, 'LIP GLOSS CALIFORNIA', 'LIP GLOSS TONO 2', 5 ,2500, 02, 01);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (05, 'LABIAL LIPSY', 'LABIAL EN BARRA CON DELINEADOR',5,2900, 02, 01);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (06, 'LABIAL NUDE X', 'LABIAL EN BARRA NUDE', 5,3800, 01, 02);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (07, 'BLUSH', 'RUBOR EN POLVO REDONDO', 10 ,2500, 03, 07);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (08, 'BLUSH EN BARRA', 'RUBOR CREMOSO EN BARRA', 5 ,3000, 03, 05);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (09, 'SET DE BROCHAS', 'SET CON 8 BROCHAS SURTIDAS',10 ,7500, 06, 02);

INSERT INTO PRODUCTOS (ID_PRODUCTO, NOMBRE, DESCRIPCION, CANTIDAD, PRECIO, ID_CATEGORIA, ID_MARCA)
VALUES (10, 'ILUMINADOR SO PERFECT', 'ILUMINADOR EN POLVO', 10,3900, 10, 01);