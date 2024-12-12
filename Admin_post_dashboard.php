<?php
// Database connection settings
$host = '127.0.0.1';
$dbname = 'odms_database';
$username = 'root'; // Replace with your database username
$password = '';     // Replace with your database password

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data from `users` table
    $usersQuery = $pdo->query("SELECT * FROM users");
    $usersData = $usersQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data from `userposts` table along with owner's first name and last name
    $postsQuery = $pdo->query("
        SELECT userposts.*, users.ifirstname, users.ilastname 
        FROM userposts 
        JOIN users ON userposts.user_id = users.user_id
    ");
    $postsData = $postsQuery->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="font-inter" id="home">
    <div class="h-full w-full">

        <!-- Navbar for the Dashboard -->
        <?php include 'admin_navbar.php' ?>

        <div class="mx-3 py-3">
            <div class="h-[803px] relative overflow-y-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">User ID
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Poest Owner
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Post ID
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Date
                                Created</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Time
                                Posted</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">File Post
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Text Post
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($postsData as $post): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4"><?= htmlspecialchars($post['user_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['ifirstname']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['post_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['post_created']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['time_posted']) ?></td>
                                <td class="px-6 py-4">
                                    <ul class="list-disc pl-6">
                                        <?php
                                        // Assuming 'file_post' contains a comma-separated list of file names
                                        $fileNames = explode(',', $post['file_post']); // Split the string into an array
                                        foreach ($fileNames as $fileName) {
                                            $fileName = trim($fileName); // Remove any extra spaces
                                            $displayFileName = basename($fileName);
                                            if (file_exists("uploads/$fileName")) {
                                                echo "<li><a href='uploads/$fileName' class='text-blue-500' target='_blank'>" . htmlspecialchars($displayFileName) . "</a></li>";
                                            } else {
                                                echo "<li>" . htmlspecialchars($displayFileName) . " (File not found)</li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    <?= htmlspecialchars(strlen($post['text_post']) > 50 ? substr($post['text_post'], 0, 50) . '...' : $post['text_post']) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="edit_post.php?id=<?= $post['post_id'] ?>"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                    <a href="delete_post.php?id=<?= $post['post_id'] ?>"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="return confirmDelete()">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black sticky bottom-0">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-[#d1dded] sm:text-center">© 2024
                <a href="https://flowbite.com/" class="hover:underline">Ewanko™</a>. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-[#d1dded] sm:mt-0 transition">
                <li><a href="#" class="hover:underline me-4 md:me-6">About</a></li>
                <li><a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a></li>
                <li><a href="#" class="hover:underline me-4 md:me-6">Licensing</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
            </ul>
        </div>
    </footer>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

<script src="../JS/dropdown_toggling.js"></script>
<script src="../JS/content_loaded.js"></script>
<script> function confirmDelete() { return confirm("Are you sure you want to delete this post?"); } </script>

</html>