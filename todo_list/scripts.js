document.addEventListener('DOMContentLoaded', () => {
    loadTasks();

    document.getElementById('add-task-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const dueDateInput = document.getElementById('due_date');
        const reminderDateInput = document.getElementById('reminder_date');

        const dueDate = new Date(dueDateInput.value);
        const reminderDate = new Date(reminderDateInput.value);

        if (reminderDate >= dueDate) {
            displayErrorMessage('La date de rappel doit être antérieure à la date d\'échéance.');
            return;
        }

        const formData = new FormData(this);

        fetch('add_task.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            loadTasks();
            this.reset();
        })
        .catch(error => console.error('Error adding task:', error));
    });

    document.getElementById('task-list').addEventListener('click', (e) => {
        if (e.target.classList.contains('mark-done')) {
            markTaskDone(e.target.dataset.id);
        } else if (e.target.classList.contains('delete-task')) {
            deleteTask(e.target.dataset.id);
        }
    });
});

function loadTasks() {
    fetch('load_tasks.php')
        .then(response => response.json())
        .then(tasks => {
            console.log('Tasks loaded:', tasks); // Ajoutez cette ligne pour vérifier les tâches récupérées
            if (tasks.error) {
                console.error('Error:', tasks.error);
            } else {
                const taskList = document.getElementById('task-list');
                taskList.innerHTML = '';
                tasks.forEach(task => {
                    const li = document.createElement('li');
                    li.className = task.status === 'done' ? 'done' : '';
                    li.innerHTML = `
                        <strong>${task.title}</strong>
                        <p>${task.description}</p>
                        <p>Échéance: ${task.due_date}</p>
                        <p>Rappel: ${task.reminder_date}</p>
                        <p>Priorité: ${task.priority}</p>
                        <p>Catégorie: ${task.category}</p>
                        <button class="mark-done" data-id="${task.id}">Marquer comme fait</button>
                        <button class="delete-task" data-id="${task.id}">Supprimer</button>
                    `;
                    taskList.appendChild(li);
                });
            }
        })
        .catch(error => console.error('Error fetching tasks:', error));
}
   

function markTaskDone(taskId) {
    fetch(`mark_done.php?id=${taskId}`)
    .then(response => response.text())
    .then(result => {
        console.log(result);
        loadTasks();
    })
    .catch(error => console.error('Error marking task as done:', error));
}

function deleteTask(taskId) {
    fetch(`delete_task.php?id=${taskId}`, {
        method: 'DELETE'
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        loadTasks();
    })
    .catch(error => console.error('Error deleting task:', error));
}

function displayErrorMessage(message) {
    const errorMessageElement = document.getElementById('error-message');
    errorMessageElement.textContent = message;
    errorMessageElement.style.display = 'block';

    // Masquer le message après 5 secondes
    setTimeout(() => {
        errorMessageElement.style.display = 'none';
    }, 5000); // 5000 millisecondes = 5 secondes
}
