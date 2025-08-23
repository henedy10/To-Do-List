# To-Do List OOP App (PHP + MySQL)

A simple To-Do List application built with **OOP in PHP** and **MySQL**.  
The project demonstrates how to apply Object-Oriented Programming principles in a small web application that includes:
- Task management (Add / View / Delete).
- Password update with validation and hashing.

---

## 🚀 Features
- Add new tasks.
- View all tasks.
- Delete tasks.
- Validate email and password.
- Update user password with `password_hash` encryption.
- Apply OOP concepts (Encapsulation, Dependency Injection, Single Responsibility).

---

## 📦 Requirements
- PHP 8.0+
- MySQL 5.7+
- Web Server (Apache or Nginx)

---

## ⚙️ Installation
1. Clone the repository or download the project:
   ```bash
   git clone https://github.com/henedy10/To_Do_List.git

2.Create the database:
CREATE DATABASE to_do_list;
USE to_do_list;

3.
    - Create the users table:
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        );

    - Create the tasks table:
        CREATE TABLE tasks(
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT ,
            FOREIGN KEY (user_id) REFERENCES users(id),
            title VARCHAR(255) NOT NULL,
            complete bool default 0
        );

4.Update database credentials in DB.php:
$db = new DataBase('localhost', 'username=>?', 'password=>?', 'to_do_list');

5.Open the project in your browser:
http://localhost/To_Do_List/index.php

# Usage

* On the homepage (home.php), you can find:

    * Task Statistics → Displays the total number of tasks, how many are completed, and how many are still pending.

    * Search Functionality → Easily search for any task by typing a keyword.

    * Task Management →

        - Edit existing tasks.

        - Delete tasks you no longer need.

        - Add new tasks directly from the Home Page.

    * User-Friendly Interface → Designed with simplicity and efficiency in mind, so you can manage your work quickly.

# Future Enhancements

- User registration & authentication (login/logout system).
- Edit tasks (update task title).
- Mark tasks as completed.
- Add task deadlines and priorities.
- Separate roles (Admin / User).
- Use Ajax for dynamic task updates without page reload.
- Migrate to Laravel for a more scalable structure.

# Author
Ahmed Faisal
Back-End PHP & Laravel Developer

