<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<?php


include_once('global.php');
include_once (MODELS_PATH . '/userModel.php');

function authorizeUser($email)
{
    $_SESSION["loggedIn"] = true;
    $_SESSION["email"] = $email;

    header('Location: http://localhost:80/PROYECTOAVANCE/principal.php');
    
}


if(isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
 
        if (validateUser($email, $password))
        {
            authorizeUser($email);
        }
        else{
            $_POST["errorMessage"] = "La combinacion de usuario y contraseña no es valida.";
 
        }
    }

    if (isset($_POST["register"]))
    {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $password = $_POST['register_password'];
        $confirmPassword = $_POST['confirm_password'];
        $rol = $_POST['rol'];

        if ($password !== $confirmPassword)
        {
            $_POST["errorMessage"] = 'Las contraseñas deben de ser exactamente iguales';
        }
        else
        {
            if (!registerUser($email,$password,$nombre,$apellidos,$rol))
            {
                $_POST["errorMessage"] = 'El usuario no pudo ser registrado';
            }
            else
            {
                authorizeUser($email);
            }

        }
    }

    if (isset($_POST["registerEmployee"]))
    {
        $nombre = $_POST['nombreEmpleado'];
        $apellidos = $_POST['apellidosEmpleado'];
        $email = $_POST['emailEmpleado'];
        $password = $_POST['register_passwordEmpleado'];
        $confirmPassword = $_POST['confirm_passwordEmpleado'];

            if (!registerEmployee($email,$password,$nombre,$apellidos))
            {
                $_POST["errorMessage"] = 'El empleado no pudo ser registrado';
            }
            else
            {
                authorizeUser($email);
            }

        }

        if (isset($_POST["registerProject"]))
        {
            $titulo = $_POST['titulo'];
            $proyectoId = $_POST['proyectoId'];
            $tareas = $_POST['tareas'];
    
                if (!registerProject($proyectoId, $titulo, $tareas))
                {
                    $_POST["errorMessage"] = 'El proyecto no pudo ser registrado';
                }
                else
                {
                    authorizeUser($proyectoId);
                }
        }


        if (isset($_POST["addTask"]))
        {
            $proyectoId = $_POST['proyectoId'];
            $tituloProyecto = $_POST['tituloProyecto'];
            $tituloTarea = $_POST['tituloTarea'];
            $descripcion = $_POST['descripcion'];
    
                if (!registerTask($proyectoId, $tituloProyecto, $tituloTarea, $descripcion))
                {
                    $_POST["errorMessage"] = 'La tarea no pudo ser registrada';
                }
                else
                {
                    authorizeUser($proyectoId);
                }
        }

    if (isset($_POST["password_Change"]))
    {
        $email = $_POST['email'];
        $password = $_POST['password_New'];
        $confirmPassword = $_POST['password_Confirm'];

        if ($password !== $confirmPassword)
        {
            $_POST["errorMessage"] = 'Las contraseñas deben de ser exactamente iguales';
        }
        else
        {
            if (changePassword($email,$password))
            {
                authorizeUser($email);
            }
            else
            {
                $_POST["errorMessage"] = 'La contraseña no puede ser cambiada';
            }

        }
    }
//---------------------------------------------------------------------------------------------------
          #LISTAS DE TODO
//---------------------------------------------------------------------------------------------------

        function bindUsers() {
            $recordset = listUsers();
            if (is_null($recordset) || mysqli_num_rows($recordset) == 0) {
                $_POST['actionMessage'] = "No se han encontrado Usuarios.";
                return;
            }
        
            // Inicio de la tabla con clases de Bootstrap para tablas
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead class='thead-dark'><tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Activo</th><th>Rol</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($record = mysqli_fetch_assoc($recordset)) {
                echo "<tr>
                    <td>" . htmlspecialchars($record["nombre"]) . "</td>
                    <td>" . htmlspecialchars($record["apellido"]) . "</td>
                    <td>" . htmlspecialchars($record["email"]) . "</td>
                    <td>" . htmlspecialchars($record["activo"]) . "</td>
                    <td>" . htmlspecialchars($record["rol"]) . "</td>
                    <td>
                    <a class='btn btn-success btn-sm' href='" .  ROOT . "/updateUser.php?user_id=" . urlencode($record['email']) . "&nombre=" . urlencode($record['nombre']) . "&apellido=" . urlencode($record['apellido']) . "&rol=" . urlencode($record['rol']) . "'>Editar</a>
                        <button class='btn btn-danger   btn-sm' type='button' onclick='Delete(\"" . $record["email"] . "\")'> Eliminar </button>
                        
                    </td>
                    </tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";            
}    




function bindEmployee() {
    $recordset = listEmployee();
    if (is_null($recordset) || mysqli_num_rows($recordset) == 0) {
        $_POST['actionMessage'] = "No se han encontrado Empleados.";
        return;
    }

    // Inicio de la tabla con clases de Bootstrap para tablas
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='thead-dark'><tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Activo</th><th>Tareas en Proyecto</th><th>Acciones</th></tr></thead>";
    echo "<tbody>";
    while ($record = mysqli_fetch_assoc($recordset)) {
        echo "<tr>
            <td>" . htmlspecialchars($record["nombre"]) . "</td>
            <td>" . htmlspecialchars($record["apellido"]) . "</td>
            <td>" . htmlspecialchars($record["email"]) . "</td>
            <td>" . htmlspecialchars($record["activo"]) . "</td>
            <td>" . htmlspecialchars($record["tarea_proyecto"]) . "</td>
            <td>
            <a class='btn btn-success btn-sm' href='" .  ROOT . "/updateEmployee.php?employee_id=" . urlencode($record['email']) . "&nombre=" . urlencode($record['nombre']) . "&apellido=" . urlencode($record['apellido']) . "&tarea_proyecto=" . urlencode($record['tarea_proyecto']) . "'>Editar</a>
            <button class='btn btn-danger   btn-sm' type='button' onclick='DeleteE(\"" . $record["email"] . "\")'> Eliminar </button>


            </td>
            </tr>";

            
    }
    echo "</tbody>";
    echo "</table>";      
    echo "</div>";        
}    



function bindProject() {
    $recordset = listProject();
    if (is_null($recordset) || mysqli_num_rows($recordset) == 0) {
        $_POST['actionMessage'] = "No se han encontrado proyectos.";
        return;
    }

    // Inicio de la tabla con clases de Bootstrap para tablas
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='thead-dark'><tr><th>Proyecto ID</th><th>Titulo</th><th>Activo</th><th>Tiempo Trabajado</th><th>Acciones</th></tr></thead>";
    echo "<tbody>";
    while ($record = mysqli_fetch_assoc($recordset)) {
        echo "<tr>
            <td>" . htmlspecialchars($record["proyectoId"]) . "</td>
            <td>" . htmlspecialchars($record["titulo"]) . "</td>
            <td>" . htmlspecialchars($record["activo"]) . "</td>
            <td>" . htmlspecialchars($record["tiempoTrabajado"]) . "</td>
            <td>
                <!--<a class='btn btn-success  btn-sm' href='" .  ROOT . "#?user_id=" . urlencode($record['proyectoId']) . "'> Editar</a>-->
                <a class='btn btn-success btn-sm' href='" .  ROOT . "/updateProject.php?project_id=" . urlencode($record['proyectoId']) . "&titulo=" . urlencode($record['titulo']) .  "&horasTrabajadas=" . urlencode($record['tiempoTrabajado']) . "'>Editar</a>
                <button class='btn btn-danger   btn-sm' type='button' onclick='DeleteP(\"" . $record["proyectoId"] . "\")'> Eliminar </button>
                <a class='btn btn-info btn-sm' href='" .  ROOT . "/registerTask.php?project_id=" . urlencode($record['proyectoId']) . "&titulo=" . urlencode($record['titulo']) . "'>Agregar Tarea</a>
                
            </td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";   
    echo "</div>";           
} 


function bindTasks() {
    $recordsetTasks = listTask();
    $recordsetEmployees = listEmployee();
   
    if (is_null($recordsetTasks) || mysqli_num_rows($recordsetTasks) == 0) {
        $_POST['actionMessage'] = "No se han encontrado Tareas.";
        return;
    }
   
    // Asumiendo que 'listEmployee()' devuelve un array de empleados
    $employees = array();
    while ($employee = mysqli_fetch_assoc($recordsetEmployees)) {
        $employees[] = $employee;
    }
 
    // Inicio de la tabla con clases de Bootstrap para tablas
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='thead-dark'><tr><th>Tarea ID</th><th>Proyecto ID</th><th>Titulo de Proyecto</th><th>Titulo de Tarea</th><th>Descripción</th><th>Asignado a</th><th>Activo</th><th>Acciones</th></tr></thead>";
    echo "<tbody>";
    while ($record = mysqli_fetch_assoc($recordsetTasks)) {
        echo "<tr>
            <td>" . htmlspecialchars($record["id_tarea"]) . "</td>
            <td>" . htmlspecialchars($record["proyectoId"]) . "</td>
            <td>" . htmlspecialchars($record["tituloProyecto"]) . "</td>
            <td>" . htmlspecialchars($record["tituloTarea"]) . "</td>
            <td>" . htmlspecialchars($record["descripTarea"]) . "</td>
            <td>
                <select class='form-control form-control-sm' name='employeeId'>";
                    foreach ($employees as $employee) {
                        echo "<option value='" . htmlspecialchars($employee['email']) . "'>" . htmlspecialchars($employee['email']) . "</option>";
                    }
                echo "</select>
            </td>
            <td>" . htmlspecialchars($record["activo"]) . "</td>
            <td>
                <a class='btn btn-success btn-sm' href='" .  ROOT . "/updateTasks.php?id_tarea=" . urlencode($record['id_tarea']) . "&proyectoId=" . urlencode($record['proyectoId']) .  "&titutloProyecto=" . urlencode($record['tituloProyecto']) .
                "&titutloTarea=" . urlencode($record['tituloTarea']) . "&descripTarea=" . urlencode($record['descripTarea']) . "'>Editar</a>
                <button class='btn btn-danger   btn-sm' type='button' style='margin-right: 40px; onclick='DeleteT(\"" . $record["id_tarea"] . "\")'> Eliminar </button>
                <a class='btn btn-info btn-sm' style='margin-left: 200px; margin-top: -60px' href='" .  ROOT . "/asignarTask.php?id_tarea=" . urlencode($record['id_tarea']) . "&proyectoId=" . urlencode($record['proyectoId']) .  "&titutloProyecto=" . urlencode($record['tituloProyecto']) .
                "&titutloTarea=" . urlencode($record['tituloTarea']) . "&descripTarea=" . urlencode($record['descripTarea']) . "'>Asignar Tarea</a>
 
                 
            </td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";  
    echo "</div>";            
}





        //---------------------------------------------------------------------------------------------------
          #EDITAR USUARIO
        //---------------------------------------------------------------------------------------------------
        if (isset($_POST["editUsuario"]))
        {
            $email = $_POST['email'];
            $nombre = $_POST['new_nombreUser'];
            $apellido = $_POST['new_apellidoUser'];
            $rol = $_POST['new_rol'];

        if (editUser($email, $nombre, $apellido,$rol))
        {
            authorizeUser($email);
        }
        else
        {
            $_POST["errorMessage"] = 'No pudo actualizar la informacion';
        }

    }

     //---------------------------------------------------------------------------------------------------
          #EDITAR EMPLEADO
    //---------------------------------------------------------------------------------------------------
        if (isset($_POST["editEmpleado"]))
        {
            $email = $_POST['email'];
            $nombre = $_POST['new_nombre'];
            $apellido = $_POST['new_apellido'];
            $tarea_proyecto = $_POST['new_tarea_proyecto'];

                if (editEmployee($email, $nombre, $apellido,$tarea_proyecto))
                {
                    authorizeUser($email);
                }
                else
                {
                    $_POST["errorMessage"] = 'No pudo actualizar la informacion';
                }

    }

    //---------------------------------------------------------------------------------------------------
    #EDITAR PROYECTOS
//---------------------------------------------------------------------------------------------------
          
if (isset($_POST["editProyecto"]))
          {
              $proyectoId = $_POST['proyectoId'];
              $titulo = $_POST['new_titulo'];
              $tareas = $_POST['new_tareas'];
              $tiempoTrabajado = $_POST['new_horasTrabajadas'];

                  if (editProject($proyectoId, $titulo, $tareas, $tiempoTrabajado))
                  {
                      authorizeUser($proyectoId);
                  }
                  else
                  {
                      $_POST["errorMessage"] = 'No pudo actualizar la informacion';
                  }

              }

//---------------------------------------------------------------------------------------------------
    #EDITAR TAREAS
//---------------------------------------------------------------------------------------------------
 /*        
if (isset($_POST["editTarea"]))
{
    $tareaId = $_POST['tareaId'];
    $titulo = $_POST['new_tituloTarea'];
    $descripTareas = $_POST['new_descripTarea'];
 
        if (editTask($tareaId, $titulo, $descripTareas))
        {
            authorizeUser($tareaId);
        }
        else
        {
            $_POST["errorMessage"] = 'No pudo actualizar la informacion';
        }
 
    }



    $userCount = CountUsers();

    $projectCount = CountActiveProjects();

    $employeeCount = CountActiveEmployee();
    

*/
?>
        



