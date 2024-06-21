<?php
session_start();
require 'config.php';

// Aquí se establece la ID del usuario actual para la demostración
// En un entorno real, esta debería ser establecida al iniciar sesión
// $_SESSION['user_id'] = 1; // Esta línea es solo para propósitos de demostración

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $current_user_id = intval($_SESSION['user_id']);

    // Verificar que solo el usuario con id=1 puede eliminar
    if ($current_user_id !== 1) {
        echo json_encode(["status" => "error", "message" => "No tiene permisos para eliminar entrenadores"]);
        exit;
    }

    // Evitar que el usuario con id=1 sea eliminado
    if ($delete_id === 1) {
        echo json_encode(["status" => "error", "message" => "No se puede eliminar el usuario con ID 1"]);
        exit;
    }

    $sql = "DELETE FROM entrenadores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete record"]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

$sql = "SELECT * FROM entrenadores";
$result = $conn->query($sql);

$entrenadores = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $entrenadores[] = $row;
    }
} else {
    $entrenadores[] = array("mensaje" => "No se encontraron entrenadores");
}

echo json_encode($entrenadores);

$conn->close();
?>

