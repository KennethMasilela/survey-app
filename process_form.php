<?php
require 'db.php';
header('Content-Type: application/json');

$errors = [];

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Get inputs
$name = sanitize($_POST['name'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$contact = sanitize($_POST['contact'] ?? '');
$dateOfBirth = $_POST['date'] ?? '';
$food = isset($_POST['food']) ? implode(", ", $_POST['food']) : '';

// Validate presence
if (empty($name) || empty($email) || empty($contact) || empty($dateOfBirth)) {
    $errors[] = "Please fill in all personal details.";
}

// Validate contact number (10–15 digits)
if (!preg_match('/^\d{10,15}$/', $contact)) {
    $errors[] = "Contact number must be 10 to 15 digits.";
}

// Calculate age
try {
    $dob = new DateTime($dateOfBirth);
    $today = new DateTime();
    $age = $today->diff($dob)->y;

    if ($age < 5 || $age > 120) {
        $errors[] = "Your age must be between 5 and 120.";
    }
} catch (Exception $e) {
    $errors[] = "Invalid date format.";
}

// Validate rating selections
$eat_out = intval($_POST['eat_out'] ?? 0);
$watch_movies = intval($_POST['watch_movies'] ?? 0);
$watch_tv = intval($_POST['watch_tv'] ?? 0);
$listen_radio = intval($_POST['listen_radio'] ?? 0);

if (!$eat_out || !$watch_movies || !$watch_tv || !$listen_radio) {
    $errors[] = "Please select a rating for all activities.";
}

// Return errors if any
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(" ", $errors)
    ]);
    exit;
}

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
        ':date' => $dateOfBirth,
        ':food' => $food,
        ':eat_out' => $eat_out,
        ':watch_movies' => $watch_movies,
        ':watch_tv' => $watch_tv,
        ':listen_radio' => $listen_radio
    ]);

    echo json_encode([
        'success' => true,
        'message' => "✅ Survey submitted successfully!"
    ]);
    exit;

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => "❌ Database error: " . $e->getMessage()
    ]);
    exit;
}
?>