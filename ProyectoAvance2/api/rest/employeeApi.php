<?php
include_once('../../global.php');
include_once MODELS_PATH . '/userModel.php';
session_start();

ob_start();

if (isset($_POST['deleteE'])) {
    $email = $_POST['email'];

    $result = DeleteE($email);

    if ($result) {
        $response = json_encode(['success' => true]);
    } else {
        $response = json_encode(['success' => false, 'errorMessage' => 'No se pudo eliminar el usuario']);
    }
} else {
    $response = json_encode(['success' => false, 'errorMessage' => 'Solicitud inválida']);
}

ob_end_clean();
echo $response;

?>