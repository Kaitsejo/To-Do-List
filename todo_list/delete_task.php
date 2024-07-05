<?php
include 'db.php';

header('Content-Type: application/json'); // Assurez-vous que le type de contenu est JSON

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete task"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID not set"]);
}
?>
