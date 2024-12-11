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
        // Fetch post data based on the ID
        $postId = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM userposts WHERE post_id = :post_id");
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update post data
        $postId = $_POST['post_id'];
        $textPost = $_POST['text_post'];
        $filePost = $_POST['file_post'];

        $updateStmt = $pdo->prepare("UPDATE userposts SET text_post = :text_post, file_post = :file_post WHERE post_id = :post_id");
        $updateStmt->bindParam(':text_post', $textPost);
        $updateStmt->bindParam(':file_post', $filePost);
        $updateStmt->bindParam(':post_id', $postId);
        $updateStmt->execute();

        // Redirect to dashboard.php after editing the post
        header("Location: dashboard.php"); // Change here to redirect to dashboard
        exit; // Don't forget to call exit() after header redirection
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        form {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
        }

        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h1>Edit Post</h1>

    <form method="POST">
        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>" />

        <label for="text_post">Text Post</label>
        <textarea name="text_post" rows="6" cols="60" required><?= $post['text_post'] ?></textarea><br>

        <label for="file_post">File Post</label>
        <textarea name="file_post" rows="6" cols="60" required><?= $post['file_post'] ?></textarea><br>

        <button type="submit">Save Changes</button>
        <a href="dashboard.php"><button type="button" class="cancel-btn">Cancel</button></a>
    </form>

</body>

</html>