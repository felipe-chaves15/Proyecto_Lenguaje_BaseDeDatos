<?php
    include_once('global.php');
    #echo PATH;
    #echo VIEWS_PATH;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Proyectos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Styles/index.css">
        <link rel="stylesheet" href="Styles/prueba.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>

#navbar ul {
    position: fixed;
    top: 12%; 
    left: 0; 
    width: 200px; 
    z-index: 100; 
}


            .button-nav {
                float: left; 
                margin-right: 20px;
                margin-top: 25px; 
                background-color: rgb(3,3,36);
                font-family: "Montserrat","Helvetica","Sans-serif";
                font-size: 1.2rem; 
                min-height:100%; 
                color: white; 
                padding: 10px 20px; 
                border: none; 
                border-radius: 5px; 
                cursor: pointer;
                text-decoration: none;
        }


            .button-nav:hover {
                background-color: grey; 
            }

            
            

           
        </style>

        
    </head>
    <body class="grid-container">
        <header class="header">
        <nav>
            <?php 
            if(!isset($_SESSION["loggedIn"]))
            {
                echo '<a href="index.php" class="login-button">Cerrar Sesion</a>';
            }
            else
            {
                //Aqui vamos a incluir el Nombre de la persoan que este logueada en ese momento.
                include VIEWS_PATH . '/session.php';
            }
            ?>
        </nav>
        <button class="menu-button" id="toggle-menu">&#9776;</button>
        </header>
        
        <navbar class="navbar" id="navbar">
        <form id="menu-form" method="post" >
        <br>
            <ul>
            <li><button class="button-nav" type="submit" href="#" id="Inicio" name="Inicio">Inicio</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Perfil" name="Perfil">Perfil</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Categoria" name="Categoria">Categoria</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Marcas" name="Marcas">Marcas</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Productos" name="Productos">Productos</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Carrito" name="Carrito">Carrito</button></li>
                <li><button class="button-nav" type="submit" href="#" id="reporte" name="Factura">Factura</button></li>
                <li><button class="button-nav" type="submit" href="#" id="Pedido" name="Pedido">Pedido</button></li>
            </ul>  
        </form>
        </navbar>
        <main class="main">
            <?php
                 
                 if(isset($_POST["user"]))
                 {
                     include VIEWS_PATH . '/adminUsuario.php';
                 }
                 elseif(isset($_POST["empleado"]))
                 {
                     include VIEWS_PATH . '/adminEmpleados.php';
                    }
                elseif(isset($_POST["tarea"]))
                 {
                     include VIEWS_PATH . '/adminTasks.php';
                     
                 }
                 elseif(isset($_POST["proyecto"]))
                    
                 {
                     include VIEWS_PATH . '/adminProyectos.php';
                 }
                 elseif(isset($_POST["reporte"]))
                 {
                     include VIEWS_PATH . '/adminReportes.php';
                 }
                 else{
                    
                     // Mensaje de bienvenida
                     echo"<br><br>";
                     echo "<h1>Bienvenido a la aplicación</h1>";
                     echo "<p>Seleccione una opción del menú de la izquierda para Visualizar la información.</p>";
                     echo "<br>";

                     


                 }
            ?>   
        </main>
        <aside class="sidebar"></aside>
        <footer class="footer"></footer>
            </body>
        

        <script>
        // Script para mostrar/ocultar el menú al hacer clic en el botón de hamburguesa
        document.getElementById('toggle-menu').addEventListener('click', function () {
            var navbar = document.getElementById('navbar');
            if (navbar.style.display === 'block') {
                navbar.style.display = 'none';
            } else {
                navbar.style.display = 'block';
            }
        });
    </script>

    </body>
</html>
