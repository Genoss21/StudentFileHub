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

// Fetch user data from the database
$res = mysqli_query($conn, "SELECT * FROM users WHERE iUserEmail = '$Email'");
$row = mysqli_fetch_array($res);

$fname = $row['ifirstname'];
$lname = $row['ilastname'];

// Test function for debugging file upload with file extension fallback
function testFileUpload($fileTmpPath)
{
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $fileInfo->file($fileTmpPath);

    // Debugging: Log the file type and file extension (commented out)
    // error_log("Detected MIME type: " . $fileType);

    return $fileType;
}

// Handle the file upload if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id']; // Get the logged-in user ID

        // Create a folder name using the user's first and last name (sanitize to avoid issues)
        $userFolderName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname . $lastname)); // Sanitize folder name
        $userDir = 'uploads/' . $userFolderName . '/';

        // Create the user-specific directory if it doesn't exist
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true); // Create the directory with write permissions
        }

        // Check if files are uploaded
        if (isset($_FILES['file_post']) && !empty($_FILES['file_post']['name'][0])) {
            // Check if the number of files exceeds 10
            if (count($_FILES['file_post']['name']) > 10) {
                $_SESSION['message'] = "You can only upload up to 10 files.";
            } else {
                $filePaths = []; // Array to store file paths
                // Loop through each uploaded file
                foreach ($_FILES['file_post']['tmp_name'] as $index => $tmpFile) {
                    // Debugging: Check if file is set
                    if ($_FILES['file_post']['error'][$index] != UPLOAD_ERR_OK) {
                        $_SESSION['message'] = "Error with file upload: " . $_FILES['file_post']['error'][$index];
                        break;
                    }

                    $fileTmpPath = $_FILES['file_post']['tmp_name'][$index];
                    $fileName = basename($_FILES['file_post']['name'][$index]);
                    $fileSize = $_FILES['file_post']['size'][$index];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    // Get MIME type for further validation
                    $fileType = testFileUpload($fileTmpPath);

                    // Debugging: Check file details (commented out)
                    // error_log("Uploading file: $fileName, Type: $fileType, Size: $fileSize, Extension: $fileExtension");

                    // Create the destination file path
                    $destFilePath = $userDir . $fileName;

                    // Define allowed file types (including .pptx)
                    $allowedFileTypes = [
                        'image/jpeg', // JPEG images
                        'image/png',  // PNG images
                        'application/pdf', // PDF files
                        'application/msword', // Word documents (.doc)
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Word documents (.docx)
                        'application/vnd.ms-powerpoint', // PowerPoint presentations (.ppt)
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation', // PowerPoint presentations (.pptx)
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Excel files (.xlsx)
                    ];

                    // Check if the file extension matches and MIME type is allowed
                    if (($fileExtension === 'pptx' || $fileExtension === 'xlsx') || in_array($fileType, $allowedFileTypes)) {
                        // Try moving the uploaded file to the user's directory
                        if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                            // Add the file path to the array
                            $filePaths[] = $destFilePath;
                        } else {
                            $_SESSION['message'] = "There was an error moving one of the uploaded files!";
                        }
                    } else {
                        $_SESSION['message'] = "File type not allowed! Only images, PDF, Word documents, PowerPoint presentations, and Excel files are allowed.";
                    }
                }

                // If files were successfully uploaded, insert them into the database
                if (!empty($filePaths)) {
                    $postText = mysqli_real_escape_string($conn, $_POST['text_post']);
                    $filePathsStr = mysqli_real_escape_string($conn, implode(',', $filePaths)); // Join file paths into a comma-separated string

                    // Prepare and execute query to insert data
                    $query = "INSERT INTO userposts (user_id, text_post, file_post, post_created, time_posted) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'iss', $loggedInUserId, $postText, $filePathsStr);

                    if (mysqli_stmt_execute($stmt)) {
                        $_SESSION['message'] = "Upload successfully!";
                    } else {
                        $_SESSION['message'] = "Error inserting post into the database!";
                    }

                    mysqli_stmt_close($stmt);
                }
            }
        } else if (!empty($_POST['text_post'])) {
            // Handle text-only post
            $postText = mysqli_real_escape_string($conn, $_POST['text_post']);
            $query = "INSERT INTO userposts (user_id, text_post, file_post, post_created, time_posted) VALUES (?, ?, '', CURRENT_DATE, CURRENT_TIME)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'is', $loggedInUserId, $postText);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Post created successfully!";
            } else {
                $_SESSION['message'] = "Error inserting text-only post into the database!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = "No files uploaded or an error occurred!";
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
        setTimeout(function () {
            window.location.href = "index.php";
        }, 100); // Delay after alert
    </script>
    <?php unset($_SESSION['message']); // Clear the message ?>
<?php endif; ?>

<!-- HTML Form for file uploads -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="text_post" placeholder="Enter some text..." required><br>
    <input type="file" name="file_post[]" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .ppt, .pptx, .xlsx"
        multiple><br>
    <button type="submit">Upload Files</button>
</form>