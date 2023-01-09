<?php

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate the form data
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
  echo "Please fill out all fields.";
  exit;
}

if ($password != $confirm_password) {
  echo "Passwords do not match.";
  exit;
}

// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database');

if ($db->connect_error) {
  echo "Error connecting to database.";
  exit;
}

// Insert the data into the users table
$stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();
$stmt->close();

echo "Registration successful!";

?>