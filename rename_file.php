<?php
session_start(); // Start the session to access the file list

if (isset($_POST['file_url']) && isset($_POST['new_name'])) {
    $file_url = $_POST['file_url'];
    $new_name = $_POST['new_name'];

    // Correct base directory for local XAMPP
    $base_directory = 'C:/xampp/htdocs/Student File management'; // Adjust this to your base directory

    // Ensure there's a slash between the base directory and the relative path
    $old_file_path = $base_directory . '/' . ltrim($file_url, '/');

    // Extract file extension
    $file_extension = pathinfo($file_url, PATHINFO_EXTENSION);
    $new_file_name = $new_name . '.' . $file_extension;
    $new_file_path = $base_directory . '/' . dirname(ltrim($file_url, '/')) . '/' . $new_file_name;

    // Check if the file exists
    if (file_exists($old_file_path)) {
        // Rename the file
        if (rename($old_file_path, $new_file_path)) {
            // Update the session files
            $files = $_SESSION['files']; // Get the current list of files from session
            $updated_files = array_map(function ($file) use ($file_url, $new_file_name) {
                return ($file === $file_url) ? str_replace(basename($file), $new_file_name, $file) : $file;
            }, $files);
            $_SESSION['files'] = $updated_files; // Store the updated files list back to session

            // Update the file reference in the database (use your own database logic here)
            $conn = new mysqli('localhost', 'username', 'password', 'database');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE your_table SET file_post = REPLACE(file_post, '$file_url', '$new_file_name') WHERE file_post LIKE '%$file_url%'";
            if ($conn->query($sql) === TRUE) {
                echo 'success';
            } else {
                echo 'Error updating database: ' . $conn->error;
            }

            $conn->close();
        } else {
            echo 'Error renaming the file on the server.';
        }
    } else {
        echo 'File does not exist at: ' . $old_file_path;
    }
} else {
    echo 'Required parameters missing.';
}
?>