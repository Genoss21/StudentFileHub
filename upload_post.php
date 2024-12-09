<?php
// This is the PHP script where the file is uploaded and inserted into the database.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['file_post']) && $_FILES['file_post']['error'] == 0) {
        $fileTmpPath = $_FILES['file_post']['tmp_name'];
        $fileName = $_FILES['file_post']['name'];
        $fileSize = $_FILES['file_post']['size'];
        $fileType = $_FILES['file_post']['type'];

        // Set the upload directory
        $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
        $destFilePath = $uploadDir . basename($fileName);

        // Check if the file type is allowed
        $allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'text/plain'];
        if (in_array($fileType, $allowedFileTypes)) {
            // Move the file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                // File upload successful, insert data into the database
                require 'config.php'; // Database connection file

                $userId = 1; // Use the actual user ID (e.g., from session)
                $postText = $_POST['post_text']; // Get post text from form input

                // Insert post data into the database
                $query = "INSERT INTO userposts (user_id, text_post, file_post) VALUES ('$userId', '$postText', '$destFilePath')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Redirect to the main page or show success message
                    echo "Post created successfully!";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error inserting post into the database!";
                }
            } else {
                echo "There was an error moving the uploaded file!";
            }
        } else {
            echo "File type not allowed!";
        }
    } else {
        echo "No file uploaded or an error occurred!";
    }
}
?>