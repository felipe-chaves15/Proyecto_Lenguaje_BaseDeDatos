<?php
include_once('../../global.php');
include_once MODELS_PATH . '/userModel.php';
session_start();

$response = [];

if (isset($_POST['asignar'])) {
    $tareaid = $_POST['id_tarea'] ?? null;
    $email = $_POST['email'] ?? null;

    
    if ($tareaid && $email) {
        $result = Asignar($tareaid, $email);
        if ($result) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'errorMessage' => 'No se pudo asignar la tarea.'];
        }
    } else {
        $response = ['success' => false, 'errorMessage' => 'Datos incompletos.'];
    }
} else {
    $response = ['success' => false, 'errorMessage' => 'Acción no definida.'];
}

// Especifica el tipo de contenido como JSON.
header('Content-Type: application/json');
echo json_encode($response);
?>
