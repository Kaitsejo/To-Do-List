<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestionnaire de Tâches</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <h1>Gestionnaire de Tâches</h1>
     <!-- Message d'erreur -->
     <p id="error-message" class="error-message"></p>
    <form id="add-task-form" action="add_task.php" method="post">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="due_date">Date d'échéance</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="reminder_date">Date de rappel</label>
        <input type="date" id="reminder_date" name="reminder_date">

        <label for="priority">Priorité</label>
        <select id="priority" name="priority">
            <option value="Basse">Basse</option>
            <option value="Moyenne">Moyenne</option>
            <option value="Haute">Haute</option>
        </select>

        <label for="category">Catégorie</label>
        <input type="text" id="category" name="category">

        <button type="submit">Ajouter Tâche</button>
    </form>
    
    
    <h2>Liste des tâches</h2>
    <ul id="task-list">
        <!-- Les tâches seront chargées ici -->
    </ul>
</body>
</html>
