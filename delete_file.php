<?php
if (isset($_POST['file_url'])) {
    $file_url = $_POST['file_url'];
    $base_directory = 'C:/xampp/htdocs/Student File management'; // Adjust this to your base directory
    $file_path = $base_directory . '/' . ltrim($file_url, '/');

    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            echo 'success';
        } else {
            echo 'Error deleting the file.';
        }
    } else {
        echo 'File does not exist.';
    }
} else {
    echo 'No file specified.';
}
?>