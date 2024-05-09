<?php

// Database connection 

$servername = "localhost";
$username = "akul";
$password = "Hariom@339";
$dbname = "todo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
