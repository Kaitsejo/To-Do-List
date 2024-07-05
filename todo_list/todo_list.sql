CREATE DATABASE todo_list;

USE todo_list;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('in_progress', 'done') DEFAULT 'in_progress',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    due_date DATE,
    reminder_date DATE,
    priority ENUM('Basse', 'Moyenne', 'Haute') DEFAULT 'Moyenne',
    category VARCHAR(100)
);
