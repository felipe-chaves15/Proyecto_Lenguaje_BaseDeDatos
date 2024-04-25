<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito</title>
    <style>
        .container {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Aquí puedes agregar la lógica para añadir los pedidos al carrito de compras
            
            // Mostrar el mensaje de éxito
            echo "<script>alert('Se añadieron exitosamente sus pedidos al carrito de compras');</script>";
        }
        ?>
        <h1>¡Éxito!</h1>
        <p>Se añadieron exitosamente sus pedidos al carrito de compras.</p>
        <p><a href="principal.php">Volver a la página principal</a></p>
    </div>
</body>
</html>
