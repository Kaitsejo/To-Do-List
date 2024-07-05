
<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("UPDATE tasks SET status = 'done' WHERE id = :id");
$stmt->bindParam(':id', $id);

$stmt->execute();

echo json_encode(['status' => 'success']);
?>
