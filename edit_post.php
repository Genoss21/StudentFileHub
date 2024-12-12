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
        header("Location: Admin_post_dashboard.php"); // Change here to redirect to dashboard
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form-container flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">Edit Post</h1>

        <form method="POST" class="max-w-3xl w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>" />

            <div class="mb-5">
                <label for="text_post" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Text
                    Post</label>
                <textarea name="text_post" rows="6" cols="20" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= htmlspecialchars($post['text_post']) ?></textarea>
            </div>

            <div class="mb-5">
                <label for="file_post" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File
                    Post</label>
                <textarea id="file_post" name="file_post" rows="6" cols="20" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= htmlspecialchars($post['file_post']) ?></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Save Changes
                </button>
                <a href="Admin_post_dashboard.php">
                    <button type="button"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Cancel
                    </button>
                </a>
            </div>
        </form>
    </div>

    <script>
        // Function to convert comma-separated values to a list format
        function formatFilePost() {
            const textarea = document.getElementById('file_post');
            const values = textarea.value.split(',');
            const formattedValues = values.map(value => value.trim()).join('\n');
            textarea.value = formattedValues;
        }

        // Call the function on page load
        window.onload = formatFilePost;
    </script>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>