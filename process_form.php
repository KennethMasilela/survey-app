<?php
require 'db.php';

// Sanitize inputs
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$age = intval($_POST['age']);
$date = $_POST['date'];

// Favorite food - array to string
$food = isset($_POST['food']) ? implode(", ", $_POST['food']) : "";

// Ratings
$eat_out = intval($_POST['eat_out']);
$watch_movies = intval($_POST['watch_movies']);
$watch_tv = intval($_POST['watch_tv']);
$listen_radio = intval($_POST['listen_radio']);

// Validation
$errors = [];

if (empty($name) || empty($surname) || empty($age) || empty($date)) {
    $errors[] = "Please fill in all personal details.";
}

if ($age < 5 || $age > 120) {
    $errors[] = "Age must be between 5 and 120.";
}

if (!$eat_out || !$watch_movies || !$watch_tv || !$listen_radio) {
    $errors[] = "Please provide all ratings.";
}

if (!empty($errors)) {
    echo "<h3>Errors:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul><a href='filloutform.php'>Go back</a>";
    exit;
}

// Insert into database
$sql = "INSERT INTO survey_responses 
(name, surname, age, date, favorite_food, eat_out_rating, watch_movies_rating, watch_tv_rating, listen_radio_rating)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissiiii", $name, $surname, $age, $date, $food, $eat_out, $watch_movies, $watch_tv, $listen_radio);

if ($stmt->execute()) {
    echo "<h3>Survey submitted successfully!</h3><a href='index.php'>Submit another</a> | <a href='results.php'>View Results</a>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
