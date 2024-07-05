<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $reminder_date = $_POST['reminder_date'];
    $priority = $_POST['priority'];
    $category = $_POST['category'];

    // Vérification si la date de rappel est antérieure à la date d'échéance
    if ($reminder_date >= $due_date) {
        echo "La date de rappel doit être antérieure à la date d'échéance.";
        exit; // Arrêter l'exécution du script si la validation échoue
    }

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, due_date, reminder_date, priority, category) VALUES (:title, :description, :due_date, :reminder_date, :priority, :category)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':reminder_date', $reminder_date);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':category', $category);

    if ($stmt->execute()) {
        echo "Task added successfully.";
    } else {
        echo "Error adding task.";
    }

    header("Location: index.php");
}
?>
