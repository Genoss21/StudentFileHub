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
        // Fetch user data based on the ID
        $userId = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update user data
        $userId = $_POST['user_id'];
        $firstName = $_POST['ifirstname'];
        $lastName = $_POST['ilastname'];
        $email = $_POST['iUserEmail'];
        $role = $_POST['role'];

        $updateStmt = $pdo->prepare("UPDATE users SET ifirstname = :ifirstname, ilastname = :ilastname, iUserEmail = :iUserEmail, role = :role WHERE user_id = :user_id");
        $updateStmt->bindParam(':ifirstname', $firstName);
        $updateStmt->bindParam(':ilastname', $lastName);
        $updateStmt->bindParam(':iUserEmail', $email);
        $updateStmt->bindParam(':role', $role);
        $updateStmt->bindParam(':user_id', $userId);
        $updateStmt->execute();

        header("Location: Admin_user_dashboard.php"); // Redirect to dashboard.php after editing
        exit; // Ensure no further code execution after redirection
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
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="form-container flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">Edit User</h1>

        <form method="POST" class="max-w-xs w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>" />

            <div class="mb-5">
                <label for="ifirstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                    Name</label>
                <input type="text" name="ifirstname" value="<?= $user['ifirstname'] ?>" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="ilastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                    Name</label>
                <input type="text" name="ilastname" value="<?= $user['ilastname'] ?>" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="iUserEmail"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="iUserEmail" value="<?= $user['iUserEmail'] ?>" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <input type="text" name="role" value="<?= $user['role'] ?>" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Save Changes
                </button>
                <a href="Admin_user_dashboard.php">
                    <button type="button"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Cancel
                    </button>
                </a>
            </div>
        </form>
    </div>

</body>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</html>