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

        // Fetch post to get file names before deleting
        $selectStmt = $pdo->prepare("SELECT file_post FROM userposts WHERE post_id = :post_id");
        $selectStmt->bindParam(':post_id', $postId);
        $selectStmt->execute();
        $post = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($post) {
            // Delete files associated with the post
            $fileNames = explode(',', $post['file_post']);
            foreach ($fileNames as $fileName) {
                $filePath = 'uploads/' . trim($fileName);
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete file
                }
            }

            // Delete post
            $deleteStmt = $pdo->prepare("DELETE FROM userposts WHERE post_id = :post_id");
            $deleteStmt->bindParam(':post_id', $postId);
            $deleteStmt->execute();

            header("Location: index.php"); // Redirect to the main page
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>