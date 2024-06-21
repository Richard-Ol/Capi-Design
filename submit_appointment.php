<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = $_POST['client_name'];
    $appointment_time = $_POST['appointment_time'];

    if (!empty($client_name) && !empty($appointment_time)) {
        $sql = "INSERT INTO citas (client_name, appointment_time, status) VALUES (?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $client_name, $appointment_time);

        if ($stmt->execute()) {
            echo "Cita agendada exitosamente";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>

