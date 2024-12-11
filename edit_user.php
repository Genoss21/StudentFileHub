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

        header("Location: dashboard.php"); // Redirect to dashboard.php after editing
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        .cancel-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn:hover,
        button:hover {
            opacity: 0.9;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Edit User</h1>

        <form method="POST">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>" />

            <label for="ifirstname">First Name</label>
            <input type="text" name="ifirstname" value="<?= $user['ifirstname'] ?>" required /><br>

            <label for="ilastname">Last Name</label>
            <input type="text" name="ilastname" value="<?= $user['ilastname'] ?>" required /><br>

            <label for="iUserEmail">Email</label>
            <input type="email" name="iUserEmail" value="<?= $user['iUserEmail'] ?>" required /><br>

            <label for="role">Role</label>
            <input type="text" name="role" value="<?= $user['role'] ?>" required /><br>

            <button type="submit">Save Changes</button>
            <a href="dashboard.php"><button type="button" class="cancel-btn">Cancel</button></a>
        </form>
    </div>

</body>

</html>