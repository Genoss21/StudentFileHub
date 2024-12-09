<?php

include('config.php');
session_start();

// Check if the user is logged in
if (empty($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user details from the session or database
$user_id = $_SESSION["user_id"];
$firstname = $_SESSION["ifirstname"];
$lastname = $_SESSION["ilastname"];
$Email = $_SESSION['iUserEmail'];

// Fetch user data from the database (if needed)
$res = mysqli_query($conn, "SELECT * FROM users WHERE iUserEmail ='$Email'");
$row = mysqli_fetch_array($res);

$fname = $row['ifirstname'];
$lname = $row['ilastname'];

// Handle the file upload if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the user ID is valid
    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id']; // Get the logged-in user ID

        // Create a folder name using the user's first and last name (sanitize to avoid issues)
        $userFolderName = strtolower($firstname . $lastname); // Ensure folder name is lowercase
        $userDir = 'uploads/' . $userFolderName . '/';

        // Create the user-specific directory if it doesn't exist
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true); // Create the directory with write permissions
        }

        // Check if any files are uploaded
        if (isset($_FILES['file_post']) && $_FILES['file_post']['error'] == 0) {
            $fileTmpPath = $_FILES['file_post']['tmp_name'];
            $fileName = $_FILES['file_post']['name'];
            $fileSize = $_FILES['file_post']['size'];
            $fileType = $_FILES['file_post']['type'];

            // Create the destination file path
            $destFilePath = $userDir . basename($fileName);

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
                    // Insert the file path and post text into the database
                    $postText = $_POST['text_post']; // Get the text post from the form

                    // Sanitize inputs to prevent SQL injection
                    $postText = mysqli_real_escape_string($conn, $postText);
                    $filePath = mysqli_real_escape_string($conn, $destFilePath);

                    // Insert the post into the database
                    $query = "INSERT INTO userposts (user_id, text_post, file_post) VALUES ('$loggedInUserId', '$postText', '$filePath')";
                    $result = mysqli_query($conn, $query);

                    // Store the success or error message in a session variable
                    if ($result) {
                        $_SESSION['message'] = "Upload successfully!";
                    } else {
                        $_SESSION['message'] = "Error inserting post into the database!";
                    }
                } else {
                    $_SESSION['message'] = "There was an error moving the uploaded file!";
                }
            } else {
                $_SESSION['message'] = "File type not allowed! Only image, PDF, and Word documents are allowed.";
            }
        } else {
            $_SESSION['message'] = "No file uploaded or an error occurred!";
        }
    } else {
        $_SESSION['message'] = "User not logged in!";
    }
}

?>

<!-- HTML code to display the popup message on index.php -->

<?php if (isset($_SESSION['message'])): ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['message']; ?>");

        // Redirect to index.php after the alert is closed
        setTimeout(function () {
            window.location.href = "index.php";
        }, 100); // Delay of 100ms after alert (you can adjust the delay time)
    </script>
    <?php unset($_SESSION['message']); // Clear the message after it's displayed ?>
<?php endif; ?>