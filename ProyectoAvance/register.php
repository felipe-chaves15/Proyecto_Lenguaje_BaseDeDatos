<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

if (isset($_POST["errorMessage"])) {
    echo '<div class="alert">' . $_POST["errorMessage"] . '</div>';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Usuario</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Styles\register.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            .form-login {
            width: 400px;
            height: 1010px;
            background: rgb(36, 33, 33);
            padding: 30px;
            margin: auto;
            margin-top: 100px;
            border-radius: 4px;
            font-family: 'calibri';
            color: white;
            box-shadow: 7px 13px 37px #000;
            }
        </style>

    </head>
    <body class="grid-container">
        <header class="header">
          
        </header>
        <navbar class="navbar"></navbar>
        <main class="main">
        <form class="form-login" id="registerForm" name="registerForm" method="post" autocomplete="off"  >
    <fieldset>
        <h4>Formulario de Registro</h4>
        <p>
            <label for="nombre">Nombre</label>
            <input class="controls" type="text" id="nombre" name="nombre" placeholder="Escriba su Nombre" />
        </p>
        <p>
            <label for="nombre">Apellidos</label>
            <input class="controls" type="text" id="apellidos" name="apellidos" placeholder="Escriba sus apellidos" />
        </p>
        <p>
            <label for="email">Email</label>
            <input class="controls" type="email" id="email" name="email" placeholder="Correo Electrónico" />
        </p>
        <p>
            <label for="nombre">Teléfono</label>
            <input class="controls" type="telefono" id="telefono" name="telefono" placeholder="Escriba su Teléfono" />
        </p>
        <p>
            <label for="nombre">Dirección</label>
            <input class="controls" type="direccion" id="direccion" name="direccion" placeholder="Escriba su Dirección" />
        </p>
        <p>
            <label for="register_password">Password</label>
            <input class="controls" type="password" id="register_password" name="register_password" placeholder="Contraseña" />
        </p>
      
        <button  class="boton-login" type="submit" id="register" name="register">Register</button>
    </fieldset>
</form>
        </main>
        <aside class="sidebar"></aside>

    </body>
</html>


<script type="text/javascript">
    $(document).ready(function() {
        $("#registerForm").validate();
        rules: {
                email: {
                    required: true;
                };
                register_password: {
                    required: true;
                    minlength: 6;
                    maxlength: 12
                };
            };
            //JSON anotacion para describir objetos
            messages: {
                email: {
                    required: "El correo electronico es obligatorio."
                };
                password: {
                    required: "La clave es obligatoria.";
                    minlength: "La clave debe de tener al menos 6 caracteres";
                    maxlength: "La clave ni debe de exceder los 12 caracteres"
                };
            }
    });
</script>


<?php

include_once('global.php');
include_once(CONTROLLERS_PATH . '/userController.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $contrasena = $_POST['register_password'];

    // Realizar la conexión a la base de datos Oracle
    $conn = oci_connect('LENGDB_ADM', '1234', 'localhost/XE');

    // Verificar la conexión
    if (!$conn) {
        $errorMessage = oci_error();
        echo '<div class="alert">Error de conexión: ' . $errorMessage['message'] . '</div>';
    } else {
        // Preparar la consulta SQL de inserción
        $sql = "INSERT INTO CLIENTES (ID_CLIENTE, NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION, CONTRASENA) 
                VALUES (clientes_id_cliente_seq.NEXTVAL, :nombre, :apellido, :correo, :telefono, :direccion, :contrasena)";

        $stmt = oci_parse($conn, $sql);

        // Vincular los parámetros
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':apellido', $apellido);
        oci_bind_by_name($stmt, ':correo', $correo);
        oci_bind_by_name($stmt, ':telefono', $telefono);
        oci_bind_by_name($stmt, ':direccion', $direccion);
        oci_bind_by_name($stmt, ':contrasena', $contrasena);

        // Ejecutar la consulta
        $result = oci_execute($stmt);

        if ($result) {
            echo '<div class="alert">Cliente registrado exitosamente.</div>';
        } else {
            $errorMessage = oci_error($stmt);
            echo '<div class="alert">Error al registrar cliente: ' . $errorMessage['message'] . '</div>';
        }

        // Liberar recursos
        oci_free_statement($stmt);
        oci_close($conn);
    }
}

?>
