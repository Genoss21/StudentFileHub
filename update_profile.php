<?php
session_start(); // Start the session
include "config.php"; // Include your database connection file

$bio = isset($_POST['bio']) ? $_POST['bio'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';
$website = isset($_POST['website']) ? $_POST['website'] : '';
$ibirth_month = isset($_POST['ibirth_month']) ? $_POST['ibirth_month'] : '';
$ibirth_day = isset($_POST['ibirth_day']) ? $_POST['ibirth_day'] : '';
$ibirth_year = isset($_POST['ibirth_year']) ? $_POST['ibirth_year'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user's first name and last name from the form
    $ifirstname = isset($_POST['ifirstname']) ? $_POST['ifirstname'] : '';
    $ilastname = isset($_POST['ilastname']) ? $_POST['ilastname'] : '';

    // Retrieve user_id from the session
    $loggedInUserId = $_SESSION['user_id'];

    // Create a folder for the user's profile pictures
    $profilePictureDirectory = "profile_pictures/{$ifirstname}_{$ilastname}/";

    // Create the folder if it doesn't exist
    if (!file_exists($profilePictureDirectory)) {
        mkdir($profilePictureDirectory, 0755, true);
    }

    // Handle profile picture update
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profilePictureName = $_FILES['profile_picture']['name'];
        $profilePictureTemp = $_FILES['profile_picture']['tmp_name'];

        // Move the uploaded profile picture to the user's folder
        move_uploaded_file($profilePictureTemp, $profilePictureDirectory . $profilePictureName);

        // Update the profile picture URL in the database
        $profilePictureUrl = $profilePictureDirectory . $profilePictureName;
        $sql = "UPDATE users SET profile_picture=? WHERE user_id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $profilePictureUrl, $loggedInUserId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Create a folder for the user's background pictures
    $backgroundPictureDirectory = "background_pictures/{$ifirstname}_{$ilastname}/";

    // Create the folder if it doesn't exist
    if (!file_exists($backgroundPictureDirectory)) {
        mkdir($backgroundPictureDirectory, 0755, true);
    }

    // Handle background picture update
    if (isset($_FILES['background_picture']) && $_FILES['background_picture']['error'] === UPLOAD_ERR_OK) {
        $backgroundPictureName = $_FILES['background_picture']['name'];
        $backgroundPictureTemp = $_FILES['background_picture']['tmp_name'];

        // Move the uploaded background picture to the user's folder
        move_uploaded_file($backgroundPictureTemp, $backgroundPictureDirectory . $backgroundPictureName);

        // Update the background picture URL in the database
        $backgroundPictureUrl = $backgroundPictureDirectory . $backgroundPictureName;
        $sql = "UPDATE users SET background_picture=? WHERE user_id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $backgroundPictureUrl, $loggedInUserId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Update user profile in the database using prepared statements
    $sql = "UPDATE users SET ifirstname=?, ilastname=?, bio=?, location=?, website=?, ibirth_month=?, ibirth_day=?, ibirth_year=? WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssssi", $ifirstname, $ilastname, $bio, $location, $website, $ibirth_month, $ibirth_day, $ibirth_year, $loggedInUserId);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            $_SESSION['ifirstname'] = $ifirstname; // Update session data if needed
            $_SESSION['ilastname'] = $ilastname;
            $_SESSION['bio'] = $bio;
            $_SESSION['location'] = $location;
            $_SESSION['website'] = $website;

            header("location: profile.php"); // Redirect to the desired page
            exit();
        } else {
            // Error in updating
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the statement
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>