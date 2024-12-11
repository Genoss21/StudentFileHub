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

    // Fetch data from `userposts` table
    $postsQuery = $pdo->query("SELECT * FROM userposts");
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
    <div class="flex flex-row h-screen">
        <!-- Left Navbar -->
        <div class="basis-1/6 "><?php include 'sidebar.php' ?></div>

        <div class="basis-5/6">
            <!-- Navbar for the Dashboard -->
            <?php include 'admin_navbar.php' ?>

            <h1>Users Table</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">User ID</th>
                            <th scope="col" class="px-6 py-3">First Name</th>
                            <th scope="col" class="px-6 py-3">Last Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Date Created</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersData as $user): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4"><?= htmlspecialchars($user['user_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['ifirstname']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['ilastname']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['iUserEmail']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['date_created']) ?></td>
                                <td class="px-6 py-4">
                                    <a href="edit_user.php?id=<?= $user['user_id'] ?>" class="text-blue-500">Edit</a> |
                                    <a href="delete_user.php?id=<?= $user['user_id'] ?>" class="text-red-500">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h1>User Posts Table</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Post ID</th>
                            <th scope="col" class="px-6 py-3">Date Created</th>
                            <th scope="col" class="px-6 py-3">Time Posted</th>
                            <th scope="col" class="px-6 py-3">File Post</th>
                            <th scope="col" class="px-6 py-3">Text Post</th>
                            <th scope="col" class="px-6 py-3">User ID</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($postsData as $post): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4"><?= htmlspecialchars($post['post_id']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['post_created']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['time_posted']) ?></td>
                                <td class="px-6 py-4">
                                    <!-- Display the list of files (documents) from the file_post column -->
                                    <ul class="list-disc pl-6">
                                        <?php
                                        // Assuming 'file_post' contains a comma-separated list of file names
                                        $fileNames = explode(',', $post['file_post']); // Split the string into an array
                                    
                                        // Loop through the file names and display them
                                        foreach ($fileNames as $fileName) {
                                            $fileName = trim($fileName); // Remove any extra spaces
                                    
                                            // Extract the file name from the path using basename
                                            $displayFileName = basename($fileName);

                                            // Display the file name as a clickable link
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
                                    <!-- Truncate the text post to 50 characters or adjust as needed -->
                                    <?= htmlspecialchars(strlen($post['text_post']) > 50 ? substr($post['text_post'], 0, 50) . '...' : $post['text_post']) ?>
                                </td>
                                <td class="px-6 py-4"><?= htmlspecialchars($post['user_id']) ?></td>
                                <td class="px-6 py-4">
                                    <a href="edit_post.php?id=<?= $post['post_id'] ?>" class="text-blue-500">Edit</a> |
                                    <a href="delete_post.php?id=<?= $post['post_id'] ?>" class="text-red-500">Delete</a>
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

</html>