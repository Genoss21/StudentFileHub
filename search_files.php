<?php
include('config.php');
session_start();

// Ensure the user is logged in
if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve logged-in user information
$firstname = $_SESSION["ifirstname"];
$lastname = $_SESSION["ilastname"];
$userFolderName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname . $lastname));
$userDir = 'uploads/' . $userFolderName . '/';

// Get the search query
$query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';

// Array to store search results
$results = [];

if (!empty($query)) {
    // Search in the user-specific folder
    if (is_dir($userDir)) {
        $files = scandir($userDir);

        foreach ($files as $file) {
            if (stripos($file, $query) !== false) {
                $results[] = $userDir . $file; // Full path for the file
            }
        }
    }

    // Search in the database (userposts table)
    $stmt = $conn->prepare("SELECT file_post FROM userposts WHERE user_id = ? AND file_post LIKE ?");
    $likeQuery = '%' . $query . '%';
    $stmt->bind_param("is", $_SESSION['user_id'], $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $dbFiles = explode(',', $row['file_post']);
        foreach ($dbFiles as $filePath) {
            if (stripos($filePath, $query) !== false) {
                $results[] = $filePath;
            }
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5">Search Results for "<?php echo $query; ?>"</h1>
        <?php if (!empty($results)): ?>
            <ul class="list-disc pl-5">
                <?php foreach ($results as $filePath): ?>
                    <li>
                        <a href="<?php echo $filePath; ?>" target="_blank" class="text-blue-500 underline">
                            <?php echo basename($filePath); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">No files found.</p>
        <?php endif; ?>
    </div>
</body>

</html>