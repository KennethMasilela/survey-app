
<?php
// database.php
$host = 'localhost';
$dbname = 'survey_db'; // use your actual DB name
$username = 'root';
$password = 'K3nneth36812!'; // use your actual DB password

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
?>
