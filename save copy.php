<?php
session_start();
require 'config.php'; // Include database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id']; // Get the logged-in user ID

        // Fetch the user's first and last name from the database
        $sql = "SELECT ifirstname, ilastname FROM users WHERE user_id = $loggedInUserId";
        $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $firstName = $user['ifirstname'];
            $lastName = $user['ilastname'];

            // Create a folder name using the user's first and last name (sanitize to avoid issues)
            $userFolderName = strtolower($firstName . $lastName); // Ensure folder name is lowercase
            $userDir = 'uploads/' . $userFolderName . '/';

            // Create the user-specific directory if it doesn't exist
            if (!file_exists($userDir)) {
                mkdir($userDir, 0777, true); // Create the directory with write permissions
            }

            // Check if any files are uploaded
            if (isset($_FILES['file_post']) && $_FILES['file_post']['error'] == 0) {
                echo "File uploaded successfully!<br>"; // Debugging output
                $fileTmpPath = $_FILES['file_post']['tmp_name'];
                $fileName = $_FILES['file_post']['name'];
                $fileSize = $_FILES['file_post']['size'];
                $fileType = $_FILES['file_post']['type'];

                // Create the destination file path
                $destFilePath = $userDir . basename($fileName);
                echo "Destination Path: " . $destFilePath . "<br>"; // Debugging output

                // Define allowed file types (including .docx and .pdf)
                $allowedFileTypes = [
                    'image/jpeg',
                    'image/png', // Image file types
                    'application/pdf', // PDF files
                    'application/msword', // Word documents (.doc)
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // Word documents (.docx)
                ];

                // Check if the uploaded file type is allowed
                if (in_array($fileType, $allowedFileTypes)) {
                    // Try moving the uploaded file to the user's directory
                    if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                        echo "File moved successfully!<br>"; // Debugging output

                        // Insert the file path and post text into the database
                        $postText = $_POST['text_post']; // Get the text post from the form

                        // Sanitize inputs to prevent SQL injection
                        $postText = mysqli_real_escape_string($conn, $postText);
                        $filePath = mysqli_real_escape_string($conn, $destFilePath);

                        $query = "INSERT INTO userposts (user_id, text_post, file_post) VALUES ('$loggedInUserId', '$postText', '$filePath')";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo "Post and file uploaded successfully!";
                            header("Location: index.php"); // Redirect to home page after success
                            exit();
                        } else {
                            echo "Error inserting post into the database!";
                        }
                    } else {
                        echo "There was an error moving the uploaded file!<br>";
                    }
                } else {
                    echo "File type not allowed! Only image, PDF, and Word documents are allowed.<br>";
                }
            } else {
                echo "No file uploaded or an error occurred!<br>";
                echo "File Error Code: " . $_FILES['file_post']['error'] . "<br>"; // Debugging output
            }
        } else {
            echo "User not found in the database!";
        }
    } else {
        echo "User not logged in!";
    }
}
?>