<?php
$servername = "localhost";
$username = "root";
$password = "kenneth37";
$dbname = "id3848797_hughescraft";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>