<?php
// Database connection settings
$host = '127.0.0.1';
$dbname = 'odms_database';
$username = 'root';
$password = '';

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        // Delete user based on the ID
        $userId = $_GET['id'];
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE user_id = :user_id");
        $deleteStmt->bindParam(':user_id', $userId);
        $deleteStmt->execute();

        header("Location: index.php"); // Redirect to the main page
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>