<?php
require 'db.php';

// Sanitize inputs
$name = trim($_POST['name']);
$surname = trim($_POST['surname']); // You can include this in your form if needed
$email = trim($_POST['email']);
$contact = trim($_POST['contact']);
$date = $_POST['date'];
$food = isset($_POST['food']) ? implode(", ", $_POST['food']) : "";

// Validation
$errors = [];

if (empty($name) || empty($email) || empty($contact) || empty($date)) {
    $errors[] = "Please fill in all personal details.";
}

if (!preg_match('/^\d{10,15}$/', $contact)) {
    $errors[] = "Contact number must be 10 to 15 digits.";
}

// Calculate age from date of birth
try {
    $dob = new DateTime($date);
    $today = new DateTime();
    $age = $today->diff($dob)->y;

    if ($age < 5 || $age > 120) {
        $errors[] = "Your age (based on date of birth) must be between 5 and 120.";
    }
} catch (Exception $e) {
    $errors[] = "Invalid date of birth.";
}

// Validate radio inputs
if (
    !isset($_POST['eat_out']) ||
    !isset($_POST['watch_movies']) ||
    !isset($_POST['watch_tv']) ||
    !isset($_POST['listen_radio'])
) {
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

// Ratings
$eat_out = intval($_POST['eat_out']);
$watch_movies = intval($_POST['watch_movies']);
$watch_tv = intval($_POST['watch_tv']);
$listen_radio = intval($_POST['listen_radio']);

// Insert into database using PDO
try {
    $stmt = $pdo->prepare("
        INSERT INTO survey_responses 
        (name, email, contact_number, age, date, favorite_food, eat_out_rating, watch_movies_rating, watch_tv_rating, listen_radio_rating)
        VALUES (:name, :email, :contact, :age, :date, :food, :eat_out, :watch_movies, :watch_tv, :listen_radio)
    ");

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':contact' => $contact,
        ':age' => $age,
        ':date' => $date,
        ':food' => $food,
        ':eat_out' => $eat_out,
        ':watch_movies' => $watch_movies,
        ':watch_tv' => $watch_tv,
        ':listen_radio' => $listen_radio
    ]);

    echo "<h3 style='color: green;'>✅ Survey submitted successfully!</h3>
          <a href='filloutform.php'>Submit another</a> | 
          <a href='results.php'>View Results</a>";

} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage();
}
?>
