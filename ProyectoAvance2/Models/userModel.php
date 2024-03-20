<?php 
    include_once MODELS_PATH . '/database.php';

    function validateUser($email, $password)
    {
        $sql = "SELECT 1 FROM usuarios WHERE email = '$email' AND pass = '$password'";
        
        try{

            $recordset = executeQuery($sql);
            if (mysqli_num_rows($recordset) > 0)
            {
                return true;
            }
        }
        catch(Exception $e)
        {
            //implementacion del codigo que maneja el error 

            // backoffice with jitter => reintentar la ejecucion despues de un tiempo aleatorio
        }
        return false;
    }

    function registerUser($email, $password, $nombre, $apellidos)
    {
        $sql = "INSERT INTO usuarios (email, pass, nombre, apellido, rol) VALUES ('$email', '$password', '$nombre', '$apellidos' );";

        try 
        {
            $result = executeQuery($sql);
            return $result;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return false;
    }

    function registerEmployee($email, $password, $nombre, $apellidos)
    {
        $sql = "INSERT INTO empleado (email, pass, nombre, apellido) VALUES ('$email', '$password', '$nombre', '$apellidos');";

        try 
        {
            $result = executeQuery($sql);
            return $result;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return false;
    }

    //registrar un proyecto
    function registerProject($proyectoId, $titulo, $tareas)
    {
        $sql = "INSERT INTO proyecto (proyectoId, titulo, tareas) VALUES ('$proyectoId', '$titulo', '$tareas');";

        try 
        {
            $result = executeQuery($sql);
            return $result;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return false;
    }

    function registerTask($proyectoId, $tituloProyecto, $tituloTarea, $descripcion)
    {
        $sql = "INSERT INTO tareas (proyectoId, tituloProyecto, tituloTarea, descripTarea) VALUES ('$proyectoId', '$tituloProyecto', '$tituloTarea', '$descripcion');";

        try 
        {
            $result = executeQuery($sql);
            return $result;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return false;
    }


//---------------------------------------------------------------------------------------------------
          #Cambiar Contraseña
//---------------------------------------------------------------------------------------------------

    
    function changePassword($email, $password_New)
    {

        $sql = "UPDATE usuarios SET pass = '$password_New'  WHERE email = '$email'";

        try 
        {
            $result = executeQuery($sql);
            return $result;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return false;
}

//FUNCION PARA LISTAR LOS USUARIOS 
function listUsers()
    {
        $sql = "SELECT nombre, apellido, email, pass, activo, rol FROM usuarios";

        try 
        {
            $recordset = executeQuery($sql);
            return $recordset;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return NULL;
    }


    //FUNCION PARA LISTAR LOS EMPLEADOS
    function listEmployee()
    {
        $sql = "SELECT nombre, apellido, email, pass, activo, tarea_proyecto FROM empleado";

        try 
        {
            $recordset = executeQuery($sql);
            return $recordset;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return NULL;
    }

    //lista Proyecto
    function listProject()
    {
        $sql = "SELECT proyectoId, titulo,  activo, tiempoTrabajado FROM proyecto";

        try 
        {
            $recordset = executeQuery($sql);
            return $recordset;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return NULL;
    }

    //lista Proyecto
    function listTask()
    {
        $sql = "SELECT id_tarea, proyectoId,  tituloProyecto, tituloTarea, descripTarea, asigna, activo FROM tareas";

        try 
        {
            $recordset = executeQuery($sql);
            return $recordset;
        }
        catch(Exception $e)
        {
            //Implementacion del codigo que maneja el error
        }
        return NULL;
    }



//---------------------------------------------------------------------------------------------------
          #Borrar Usuario
//---------------------------------------------------------------------------------------------------


    function Delete($email)
        {
            
            $sql = "UPDATE usuarios SET activo = 0 WHERE email = '$email'";
            try {
                $result = executeQuery($sql);
                return $result;
            } catch (Exception $e) {
                // Implementación del código que maneja el error
            }
   
            return false;
    }


    //---------------------------------------------------------------------------------------------------
          #Borrar Empleado
//---------------------------------------------------------------------------------------------------


function DeleteE($email)
{
    
    $sql = "UPDATE empleado SET activo = 0 WHERE email = '$email'";
    try {
        $result = executeQuery($sql);
        return $result;
    } catch (Exception $e) {
        // Implementación del código que maneja el error
    }

    return false;
}

 //---------------------------------------------------------------------------------------------------
          #Borrar Proyecto
//---------------------------------------------------------------------------------------------------


function DeleteP($proyectoId)
{
    
    $sql = "UPDATE proyecto SET activo = 0 WHERE proyectoId = '$proyectoId'";
    try {
        $result = executeQuery($sql);
        return $result;
    } catch (Exception $e) {
        // Implementación del código que maneja el error
    }

    return false;
}


//---------------------------------------------------------------------------------------------------
          #Borrar Tarea
//---------------------------------------------------------------------------------------------------


function DeleteT($tareaid)
{
    
    $sql = "UPDATE tareas SET activo = 0 WHERE id_tarea = '$tareaid'";
    try {
        $result = executeQuery($sql);
        return $result;
    } catch (Exception $e) {
        
    }

    return false;
}

//---------------------------------------------------------------------------------------------------
          #Borrar Tarea
//---------------------------------------------------------------------------------------------------


function Asignar($tareaid, $email)
{
    
    $sql = "UPDATE tareas SET asigna = '$email' WHERE id_tarea = '$tareaid'";
    try {
        $result = executeQuery($sql);
        return $result;
    } catch (Exception $e) {
        // Implementación del código que maneja el error
    }

    return false;
}



//---------------------------------------------------------------------------------------------------
          #EDITAR Usuario
//---------------------------------------------------------------------------------------------------
function editUser($email, $new_nombreUser, $new_apellidoUser,$new_rol)
{
    // Los valores anteriores
    $currentValues = valoresPreviosUsuarios($email);

    // Verifica si agrega algo nuevo o no. Sino deja lo antiguo
    $nombre = (!empty($new_nombreUser)) ? $new_nombreUser : $currentValues['nombre'];
    $apellido = (!empty($new_apellidoUser)) ? $new_apellidoUser : $currentValues['apellido'];
    $rol = (!empty($new_rol)) ? $new_rol : $currentValues['rol'];

    $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', rol = '$rol' WHERE email = '$email'";

    try 
    {
        $result = executeQuery($sql);
        return $result;
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return false;
}
// Obtener los datos que tienen Empleados (Si ya hay)
function valoresPreviosUsuarios($email)
{
    $sql = "SELECT nombre, apellido, rol FROM usuarios WHERE email = '$email'";
    try{
        $result = executeQuery($sql);
        // Verificar si se obtuvo un resultado
        if ($result && $result->num_rows > 0) {
            // Obtener la primera fila del resultado como un array 
            $row = $result->fetch_assoc();
            return $row;
        } else {
            //Lo devuelve vacio si no hay valores
            return array();
        }
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return array(); // Devolver un array vacío en caso de error
}

//---------------------------------------------------------------------------------------------------
          #EDITAR EMPLEADO
//---------------------------------------------------------------------------------------------------

function editEmployee($email, $new_nombre, $new_apellido,$new_tarea_proyecto)
{
    // Los valores anteriores
    $currentValues = valoresPreviosEmpleados($email);

    // Verifica si agrega algo nuevo o no. Sino deja lo antiguo
    $nombre = (!empty($new_nombre)) ? $new_nombre : $currentValues['nombre'];
    $apellido = (!empty($new_apellido)) ? $new_apellido : $currentValues['apellido'];
    $tarea_proyecto = (!empty($new_tarea_proyecto)) ? $new_tarea_proyecto : $currentValues['tarea_proyecto'];

    $sql = "UPDATE empleado SET nombre = '$nombre', apellido = '$apellido', tarea_proyecto = '$tarea_proyecto' WHERE email = '$email'";

    try 
    {
        $result = executeQuery($sql);
        return $result;
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return false;
}
// Obtener los datos que tienen Empleados (Si ya hay)
function valoresPreviosEmpleados($email)
{
    $sql = "SELECT nombre, apellido, tarea_proyecto FROM empleado WHERE email = '$email'";
    try{
        $result = executeQuery($sql);
        // Verificar si se obtuvo un resultado
        if ($result && $result->num_rows > 0) {
            // Obtener la primera fila del resultado como un array 
            $row = $result->fetch_assoc();
            return $row;
        } else {
            //Lo devuelve vacio si no hay valores
            return array();
        }
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return array(); // Devolver un array vacío en caso de error
}

//---------------------------------------------------------------------------------------------------
          #EDITAR PROYECTOS
//---------------------------------------------------------------------------------------------------
/*
function editProject($proyectoId, $new_titulo, $new_tareas,$new_horasTrabajadas)
{
    // Los valores anteriores
    $currentValues = valoresPreviosProyectos($proyectoId);

    // Verifica si agrega algo nuevo o no. Sino deja lo antiguo
    $titulo = (!empty($new_titulo)) ? $new_titulo : $currentValues['titulo'];
    $tiempoTrabajado = (!empty($new_horasTrabajadas)) ? $new_horasTrabajadas : $currentValues['tiempoTrabajado'];

    $sql = "UPDATE proyecto SET titulo = '$titulo',   tiempoTrabajado = '$tiempoTrabajado' WHERE proyectoId = '$proyectoId'";

    try 
    {
        $result = executeQuery($sql);
        return $result;
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return false;
}
// Obtener los datos que tienen Empleados (Si ya hay)
function valoresPreviosProyectos($proyectoId)
{
    $sql = "SELECT proyectoId, titulo, tareas, tiempoTrabajado FROM proyecto WHERE proyectoId = '$proyectoId'";
    try{
        $result = executeQuery($sql);
        // Verificar si se obtuvo un resultado
        if ($result && $result->num_rows > 0) {
            // Obtener la primera fila del resultado como un array 
            $row = $result->fetch_assoc();
            return $row;
        } else {
            //Lo devuelve vacio si no hay valores
            return array();
        }
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return array(); // Devolver un array vacío en caso de error
}
*/
//----------------------------------------------------------------
    //CONTEOS
//---------------------------------------------------------------
/*
function CountUsers() {
    // Modificamos la consulta SQL para contar solo usuarios activos
    $sql = "SELECT COUNT(*) as userCount FROM usuarios WHERE activo = 1"; 

    try {
        $result = executeQuery($sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['userCount'];
        }
    } catch (Exception $e) {
        
    }
    return 0; 
}
*/
function CountActiveProjects() {
    
    $sql = "SELECT COUNT(*) as projectCount FROM proyecto WHERE activo = 1";

    try {
        $result = executeQuery($sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['projectCount'];
        }
    } catch (Exception $e) {
        
    }
    return 0; 
}


function CountActiveEmployee() {
    
    $sql = "SELECT COUNT(*) as employeeCount FROM empleado WHERE activo = 1";

    try {
        $result = executeQuery($sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['employeeCount'];
        }
    } catch (Exception $e) {
        
    }
    return 0; 
}

//---------------------------------------------------------------------------------------------------
          #EDITAR TAREAS
//---------------------------------------------------------------------------------------------------
 
function editTask($tareaId, $new_tituloTarea, $new_descripTarea)
{
    // Los valores anteriores
    $currentValues = valoresPreviosTareas($tareaId);
 
    // Verifica si agrega algo nuevo o no. Sino deja lo antiguo
    $tituloTarea = (!empty($new_tituloTarea)) ? $new_tituloTarea : $currentValues['tituloTarea'];
    $descripTarea = (!empty($new_descripTarea)) ? $new_descripTarea : $currentValues['descripTarea'];
 
    $sql = "UPDATE tareas SET tituloTarea = '$tituloTarea',   descripTarea = '$descripTarea' WHERE id_tarea = '$tareaId'";
 
    try
    {
        $result = executeQuery($sql);
        return $result;
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return false;
}
// Obtener los datos que tienen Empleados (Si ya hay)
function valoresPreviosTareas($tareaId)
{
    $sql = "SELECT id_tarea, tituloTarea, descripTarea FROM tareas WHERE id_tarea = '$tareaId'";
    try{
        $result = executeQuery($sql);
        // Verificar si se obtuvo un resultado
        if ($result && $result->num_rows > 0) {
            // Obtener la primera fila del resultado como un array
            $row = $result->fetch_assoc();
            return $row;
        } else {
            //Lo devuelve vacio si no hay valores
            return array();
        }
    }
    catch(Exception $e)
    {
        // Implementación del código que maneja el error
    }
    return array(); // Devolver un array vacío en caso de error
}
 




?>