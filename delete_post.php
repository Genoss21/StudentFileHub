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
        // Delete post based on the ID
        $postId = $_GET['id'];
        $deleteStmt = $pdo->prepare("DELETE FROM userposts WHERE post_id = :post_id");
        $deleteStmt->bindParam(':post_id', $postId);
        $deleteStmt->execute();

        header("Location: index.php"); // Redirect to the main page
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>