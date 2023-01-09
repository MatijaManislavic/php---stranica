<?php

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the form data
if (empty($email) || empty($password)) {
  echo "Please fill out all fields.";
  exit;
}

// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database');

if ($db->connect_error) {
  echo "Error connecting to database.";
  exit;
}

// Check if the email and password match a row in the users table
$stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  // Login successful
  echo "Login successful!";
} else {
  // Login failed
  echo "Incorrect email or password.";
}

$stmt->close();

?>
