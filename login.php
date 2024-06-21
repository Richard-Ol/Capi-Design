<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    // Consulta para verificar si el nombre del entrenador existe en la base de datos
    $sql = "SELECT * FROM entrenadores WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login exitoso
        echo "Bienvenido, " . htmlspecialchars($nombre) . "!";
        header('Location: menu_citas.html');
    } else {
        // El nombre no está en la base de datos
        echo "El nombre del entrenador no está registrado.";
    }

    $stmt->close();
    $conn->close();
}
?>