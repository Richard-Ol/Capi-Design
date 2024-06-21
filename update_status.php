<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->status)) {
    $id = $data->id;
    $status = $data->status;

    $sql = "UPDATE citas SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $status, $id);

    if ($stmt->execute()) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Datos insuficientes.";
}

$conn->close();
?>
