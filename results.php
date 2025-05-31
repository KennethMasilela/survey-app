<?php
require 'db.php';

// Count total surveys
$result = $conn->query("SELECT COUNT(*) as total FROM survey_responses");
$total = $result->fetch_assoc()['total'];

if ($total == 0) {
    echo "<h3>No Surveys Available.</h3>";
    echo "<a href='index.php'>Back to Survey</a>";
    exit;
}

// Average age
$avgAge = $conn->query("SELECT AVG(age) as avg_age FROM survey_responses")->fetch_assoc()['avg_age'];

// Oldest and youngest
$maxAge = $conn->query("SELECT MAX(age) as max_age FROM survey_responses")->fetch_assoc()['max_age'];
$minAge = $conn->query("SELECT MIN(age) as min_age FROM survey_responses")->fetch_assoc()['min_age'];

// Percentage who like Pizza
$pizzaCount = $conn->query("SELECT COUNT(*) as count FROM survey_responses WHERE favorite_food LIKE '%Pizza%'")->fetch_assoc()['count'];
$pizzaPercent = round(($pizzaCount / $total) * 100, 1);

// Average 'eat out' rating
$eatOutAvg = $conn->query("SELECT AVG(eat_out_rating) as avg FROM survey_responses")->fetch_assoc()['avg'];
$eatOutAvg = round($eatOutAvg, 1);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Survey Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Survey Results</h2>
  <ul>
    <li><strong>Total Surveys:</strong> <?= $total ?></li>
    <li><strong>Average Age:</strong> <?= round($avgAge, 1) ?></li>
    <li><strong>Oldest Person:</strong> <?= $maxAge ?></li>
    <li><strong>Youngest Person:</strong> <?= $minAge ?></li>
    <li><strong>% Who Like Pizza:</strong> <?= $pizzaPercent ?>%</li>
    <li><strong>Average 'Eat Out' Rating:</strong> <?= $eatOutAvg ?>/5</li>
  </ul>

  <a href="filloutform.php">Back to Survey</a>
</body>
</html>
