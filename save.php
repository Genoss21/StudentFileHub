<?php
include('config.php');
session_start();

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

// Function to detect file MIME type for validation
function testFileUpload($fileTmpPath)
{
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    return $fileInfo->file($fileTmpPath);
}

// Handle the file upload if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id'];

        // Create a sanitized folder name for the user
        $userFolderName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname . $lastname));
        $userDir = 'uploads/' . $userFolderName . '/';

        // Ensure the user-specific directory exists
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true); // Create directory with permissions
        }

        // Check if post text is empty
        $postText = mysqli_real_escape_string($conn, $_POST['text_post']);
        if (empty($postText)) {
            $_SESSION['message'] = "Please make a post before submitting.";
        } else {
            if (isset($_FILES['file_post']) && !empty($_FILES['file_post']['name'][0])) {
                // Check file count limit
                if (count($_FILES['file_post']['name']) > 10) {
                    $_SESSION['message'] = "You can only upload up to 10 files.";
                } else {
                    $filePaths = [];
                    foreach ($_FILES['file_post']['tmp_name'] as $index => $tmpFile) {
                        if ($_FILES['file_post']['error'][$index] != UPLOAD_ERR_OK) {
                            $_SESSION['message'] = "Error with file upload: " . $_FILES['file_post']['error'][$index];
                            break;
                        }

                        $fileTmpPath = $_FILES['file_post']['tmp_name'][$index];
                        $fileName = basename($_FILES['file_post']['name'][$index]);
                        $fileSize = $_FILES['file_post']['size'][$index];
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $fileType = testFileUpload($fileTmpPath);
                        $destFilePath = $userDir . $fileName;

                        // Allowed MIME types
                        $allowedFileTypes = [
                            'image/jpeg',
                            'image/png',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ];

                        if (($fileExtension === 'pptx' || $fileExtension === 'xlsx') || in_array($fileType, $allowedFileTypes)) {
                            if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                                $filePaths[] = $destFilePath;

                                try {
                                    // Configure and send email
                                    $mail = new PHPMailer(true);
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'aurieljames11@gmail.com';
                                    $mail->Password = 'crloyenfawqakccu';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                    $mail->Port = 465;

                                    $mail->setFrom('noreply@gmail.com', 'StudentHub');
                                    $mail->addAddress('jerome123.tobes@gmail.com', 'Fritz');
                                    $mail->Subject = 'New File Upload Notification';
                                    $mail->Body = "User {$firstname} {$lastname} has uploaded a new file.";
                                    $mail->isHTML(true);
                                    $mail->send();
                                } catch (Exception $e) {
                                    $_SESSION['message'] = 'Mailer Error: ' . $mail->ErrorInfo;
                                }
                            } else {
                                $_SESSION['message'] = "Error moving uploaded file.";
                            }
                        } else {
                            $_SESSION['message'] = "File type not allowed!";
                        }
                    }

                    if (!empty($filePaths)) {
                        $filePathsStr = mysqli_real_escape_string($conn, implode(',', $filePaths));

                        $query = "INSERT INTO userposts (user_id, text_post, file_post, post_created, time_posted) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME)";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, 'iss', $loggedInUserId, $postText, $filePathsStr);

                        if (mysqli_stmt_execute($stmt)) {
                            $_SESSION['message'] = "Upload successful!";
                        } else {
                            $_SESSION['message'] = "Error inserting post.";
                        }

                        mysqli_stmt_close($stmt);
                    }
                }
            }
        }
    }
}
?>

<!-- HTML code to display notifications -->
<?php if (isset($_SESSION['message'])): ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['message']; ?>");
        setTimeout(function () {
            window.location.href = "index.php";
        }, 100);
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!-- File upload form -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="text_post" placeholder="Enter text..." required><br>
    <input type="file" name="file_post[]" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.ppt,.pptx,.xlsx" multiple><br>
    <button type="submit">Upload Files</button>
</form>