# Lifestyle Survey Web App

This is a simple PHP and MySQL-based web application that allows users to fill out a lifestyle survey and view aggregate results. It captures personal information, food preferences, and opinion ratings using custom checkboxes and radio buttons with a clean, styled interface.

## 📋 Features

- Personal details form (Full Name, Email, Date of Birth, Contact Number)
- Food preference checkboxes (Pizza, Pasta, Pap and Wors, Other)
- Opinion rating table using styled radio buttons (1 to 5 scale)
- Real-time age validation calculated from Date of Birth
- Client-side and server-side validation
- Form success message fades after 3 seconds (AJAX-based)
- Survey results:
  - Total number of surveys completed
  - Average, oldest, and youngest participant age
  - Percentage of food preferences
  - Average opinion ratings
  - Fallback message if no surveys are available

## 🛠 Technologies Used

- PHP (with PDO for database interaction)
- MySQL (for storing responses)
- HTML5 & CSS3 (custom styling)
- JavaScript (for AJAX and message fading)
- XAMPP (for local development environment)

## ⚙️ Setup Instructions

1. **Clone or copy the project folder** into your XAMPP `htdocs` directory.
  Download the XAMPP installer from [Apache Friends](https://www.apachefriends.org/index.html) and install it.
    If you have Git installed, you can clone the repository:
    ```bash
    git clone https://github.com/YOUR_USERNAME/survey-app.git
    ```
    or download the ZIP file and extract it.

2. **Start Apache and MySQL** using XAMPP Control Panel.
 
3. **Create the database**:

   ```sql
   CREATE DATABASE survey_db;
   ```

   USE survey_db;

   CREATE TABLE survey_responses (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100),
     email VARCHAR(100),
     contact_number VARCHAR(15),
     age INT,
     date DATE,
     favorite_food TEXT,
     eat_out_rating INT,
     watch_movies_rating INT,
     watch_tv_rating INT,
     listen_radio_rating INT
   );
## 🛠️ Database Setup

1. Open **MySQL Workbench** or **phpMyAdmin**.
2. Create a new database called `survey_db`.
3. Import the SQL schema from the `survey_db.sql` file (if included).
4. Make sure your MySQL user (default is `root`) has access to the database.

## 🔑 Configure Database Connection

Edit the `db.php` file and enter your local MySQL credentials:

```php
<?php
$host = 'localhost';
$db   = 'survey_db';
$user = 'root'; // Change if your MySQL user is different
$pass = '';     // Add your MySQL password here
