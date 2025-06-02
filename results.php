<?php
require 'db.php';

// Initialize values
$total = $avgAge = $oldest = $youngest = 0;
$pizzaPct = $pastaPct = $papPct = 0;
$avgEatOut = $avgWatchMovies = $avgWatchTV = $avgRadio = 0;

// Total number of surveys
$stmt = $pdo->query("SELECT COUNT(*) FROM survey_responses");
$total = $stmt->fetchColumn();

// If surveys exist, calculate stats
if ($total > 0) {
    $avgAge = round($pdo->query("SELECT AVG(age) FROM survey_responses")->fetchColumn(), 1);
    $oldest = $pdo->query("SELECT MAX(age) FROM survey_responses")->fetchColumn();
    $youngest = $pdo->query("SELECT MIN(age) FROM survey_responses")->fetchColumn();

    $pizza = $pdo->query("SELECT COUNT(*) FROM survey_responses WHERE favorite_food LIKE '%Pizza%'")->fetchColumn();
    $pasta = $pdo->query("SELECT COUNT(*) FROM survey_responses WHERE favorite_food LIKE '%Pasta%'")->fetchColumn();
    $pap = $pdo->query("SELECT COUNT(*) FROM survey_responses WHERE favorite_food LIKE '%Pap and Wors%'")->fetchColumn();

    $pizzaPct = round(($pizza / $total) * 100, 1);
    $pastaPct = round(($pasta / $total) * 100, 1);
    $papPct = round(($pap / $total) * 100, 1);

    $avgWatchMovies = round($pdo->query("SELECT AVG(watch_movies_rating) FROM survey_responses")->fetchColumn(), 1);
    $avgRadio = round($pdo->query("SELECT AVG(listen_radio_rating) FROM survey_responses")->fetchColumn(), 1);
    $avgEatOut = round($pdo->query("SELECT AVG(eat_out_rating) FROM survey_responses")->fetchColumn(), 1);
    $avgWatchTV = round($pdo->query("SELECT AVG(watch_tv_rating) FROM survey_responses")->fetchColumn(), 1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Survey Results</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .results-wrapper {
      max-width: 900px;
      margin: 0 auto;
      padding: 50px;
    }
    .results-title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 40px;
    }
    .results-grid {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 20px 60px;
      font-size: 16px;
    }
    .results-grid div {
      padding: 4px 0;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
    header h2 {
      margin: 0;
      font-size: 20px;
    }
      nav a {
      margin-left: 25px;
      text-decoration: none;
      font-weight: bold;
      color: #141414; /* default color */
      transition: color 0.3s ease;
    }

    nav a:hover,
    nav a.active {
      color: #2196F3; /* blue on hover or active */
    }

    .no-data {
      text-align: center;
      font-size: 18px;
      color: #777;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="survey-wrapper">
  <header>
    <h2>_Surveys</h2>
    <nav>
      <a href="filloutform.php">FILL OUT SURVEY</a>
      <a href="results.php" class="active">VIEW SURVEY RESULTS</a>
    </nav>
  </header>

  <div class="results-wrapper">
    <div class="results-title">Survey Results</div>

    <?php if ($total == 0): ?>
      <p class="no-data">No Surveys Available.</p>
    <?php else: ?>
      <div class="results-grid">
        <div>Total number of surveys:</div>           <div><?= $total ?></div>
        <div>Average Age:</div>                        <div><?= $avgAge ?></div>
        <div>Oldest person who participated:</div>     <div><?= $oldest ?></div>
        <div>Youngest person who participated:</div>   <div><?= $youngest ?></div>
        <p><p>
        <div>Percentage of people who like Pizza:</div>    <div><?= $pizzaPct ?>%</div>
        <div>Percentage of people who like Pasta:</div>    <div><?= $pastaPct ?>%</div>
        <div>Percentage of people who like Pap and Wors:</div> <div><?= $papPct ?>%</div>
        <p><p>
        <div>People who like to watch movies:</div>    <div><?= $avgWatchMovies ?></div>
        <div>People who like to listen to radio:</div> <div><?= $avgRadio ?></div>
        <div>People who like to eat out:</div>         <div><?= $avgEatOut ?></div>
        <div>People who like to watch TV:</div>        <div><?= $avgWatchTV ?></div>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
