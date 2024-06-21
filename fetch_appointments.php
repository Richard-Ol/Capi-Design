<?php
require 'config.php';

$sql = "SELECT * FROM citas";
$result = $conn->query($sql);

$appointments = array();
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);

$conn->close();
?>
