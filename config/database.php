<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'admin');
  define('DB_PASS', 'admin');
  define('DB_NAME', 'student_registration');

  // Create Connectino
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  // Check connection
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
?>