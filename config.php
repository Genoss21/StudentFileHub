<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "odms_database";

$conn = new mysqli('localhost', 'root', '', 'odms_database');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>