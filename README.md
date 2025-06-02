
# 📋 Lifestyle Survey App

A simple PHP & MySQL web application that collects and analyzes survey responses on people's lifestyle and food preferences.

---

## 🚀 Features

- ✅ Input form for name, surname, age, and date (with validation)
- ✅ Multiple choice for favorite foods (checkboxes)
- ✅ Ratings for lifestyle habits (radio buttons, scale of 1–5)
- ✅ Data storage in a MySQL database
- ✅ Real-time analytics:
  - Total number of surveys
  - Average, oldest, and youngest age
  - % who like pizza
  - Average rating for “eating out”

---

## 🖼 Screenshots

- **Survey Form Page**
- **Survey Results Page**
> _(Include screenshots if you'd like)_

---

## 💻 Tech Stack

- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL
- **Local Server**: XAMPP

---

## 🛠 Project Setup

### 1. Clone the Repo

```bash
git clone https://github.com/YOUR_USERNAME/survey-app.git
cd survey-app
```

### 2. Set Up XAMPP

- Start **Apache** and **MySQL**
- Import the database:

```sql
-- In MySQL Workbench or phpMyAdmin:
CREATE DATABASE survey_db;

USE survey_db;

CREATE TABLE survey_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    date DATE NOT NULL,
    favorite_food TEXT NOT NULL,
    eat_out_rating INT NOT NULL,
    watch_movies_rating INT NOT NULL,
    watch_tv_rating INT NOT NULL,
    listen_radio_rating INT NOT NULL
);
```

### 3. Run the App

- Open your browser and go to:  
  `http://localhost/survey-app/index.php`

---

## 📁 File Structure

```
survey-app/
├── db.php               # Database connection
├── index.php            # Survey form page
├── process_form.php     # Handles form submissions
├── results.php          # Displays analysis/results
└── style.css            # Basic styling
```

