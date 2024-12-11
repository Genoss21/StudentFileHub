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
    <div class="h-full w-full">

        <!-- Navbar for the Dashboard -->
        <?php include 'admin_navbar.php' ?>
        <div class="mx-3 py-3">

            <div class="h-[803px] relative overflow-y-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">User ID</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">First Name
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Last Name</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Email</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Role</th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Date Created
                            </th>
                            <th scope="col" class="px-6 py-3 sticky top-0 bg-white dark:bg-gray-800 z-10">Action</th>
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
                                    <a href="edit_user.php?id=<?= $user['user_id'] ?>"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                    <a href="delete_user.php?id=<?= $user['user_id'] ?>"
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
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>

</html>