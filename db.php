<?php

// Set database credentials
$host = 'localhost';
$dbname = 'vue_crud';
$username = 'sawhtut';
$password = 'sawhtut';

// Connect to database using PDO
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Could not connect to the database: " . $e->getMessage());
}

?>
