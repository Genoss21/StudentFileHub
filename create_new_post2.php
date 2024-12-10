<?php
// Handle file upload and database insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if files are uploaded
    if (isset($_FILES['file_post']) && !empty($_FILES['file_post']['name'][0])) {
        $filePaths = []; // Array to store file paths

        // Loop through each uploaded file
        foreach ($_FILES['file_post']['tmp_name'] as $index => $tmpFile) {
            // Get the details of the uploaded file
            $fileTmpPath = $_FILES['file_post']['tmp_name'][$index];
            $fileName = $_FILES['file_post']['name'][$index];
            $fileSize = $_FILES['file_post']['size'][$index];
            $fileType = mime_content_type($fileTmpPath);

            // Set the upload directory
            $uploadDir = 'uploads/';
            $destFilePath = $uploadDir . basename($fileName);

            // Check if the file type is allowed
            $allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'text/plain'];
            if (in_array($fileType, $allowedFileTypes)) {
                // Move the file to the uploads directory
                if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                    // Add the file path to the array
                    $filePaths[] = $destFilePath;
                } else {
                    echo "There was an error moving the uploaded file!";
                }
            } else {
                echo "File type not allowed!";
            }
        }

        // If files were uploaded, insert the data into the database
        if (!empty($filePaths)) {
            require 'config.php'; // Database connection file

            $userId = $_SESSION['user_id']; // Use the actual user ID from session
            $postText = $_POST['text_post']; // Get post text from form input
            $filePathsStr = implode(',', $filePaths); // Convert the array of file paths to a string

            // Insert post data into the database
            $query = "INSERT INTO userposts (user_id, text_post, file_post) VALUES ('$userId', '$postText', '$filePathsStr')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "Post created successfully!";
                header("Location: index.php"); // Redirect after successful post
                exit();
            } else {
                echo "Error inserting post into the database!";
            }
        }
    } else {
        echo "No file uploaded or an error occurred!";
    }
}
?>


<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:-inset-0 h-[calc(100%-0rem)] max-h-full backdrop-blur-sm bg-white/10">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow bg-gray-100 dark:bg-[#28282B]">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-700">
                <h3
                    class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-extrabold">
                    Create new Post
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="form2" method="POST" action="save.php" enctype="multipart/form-data">
                <div class="flex">
                    <div class="m-2 w-10 py-1">
                        <?php
                        $defaultProfilePicture = 'Images/user1.jpg'; // Set the default picture URL
                        
                        // Check if the user is logged in
                        if (isset($_SESSION['user_id'])) {
                            $loggedInUserId = $_SESSION['user_id']; // Change this to the appropriate session variable for storing user ID
                        
                            // Retrieve profile picture for the logged-in user
                            $sql = "SELECT profile_picture FROM users WHERE user_id = $loggedInUserId";
                            $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                            $row = mysqli_fetch_assoc($result);

                            // Get the user's profile picture URL, or use the default if empty or not found
                            $profilePictureUrl = !empty($row['profile_picture']) ? $row['profile_picture'] : $defaultProfilePicture;

                            echo '<img class="inline-block h-10 w-10 rounded-full" src="' . $profilePictureUrl . '" alt="#" />'; // Display the user's profile picture or default picture
                        } else {
                            // Display the default picture for non-logged-in users
                            echo '<img class="inline-block h-10 w-10 rounded-full" src="' . $defaultProfilePicture . '" alt="#" />';
                        }
                        ?>
                    </div>

                    <!--Text Area-->
                    <div class="flex-1 px-2 pt-2 mt-2">
                        <textarea
                            class="bg-transparent font-medium text-lg w-full text-ellipsis border-0 focus:outline-none form-control text-gray-800 dark:text-gray-100 focus:ring-0 h-50"
                            autocomplete="off" name="text_post" id="textArea" cols="50" rows="3"
                            placeholder="What's happening?" style="overflow: hidden;"></textarea>
                        <!-- File Previews -->
                        <div id="file-preview2" class="flex flex-row flex-wrap gap-4 justify-center items-center">
                            <!-- File previews will be inserted here -->
                        </div>
                    </div>
                </div>
                <!-- Buttons for creating new post modal -->
                <div class="flex justify-between border-t dark:border-gray-700">
                    <div class="w-full">
                        <div class="px-2">
                            <div class="flex items-center">
                                <div class="flex flex-row flex-1 text-center p-1 m-2 order-1 space-y-2">
                                    <input type="file" name="file_post[]" id="uploadpost2"
                                        onchange="previewFilesWithIcons(2)" multiple
                                        accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx" />
                                    <label for="uploadpost2" href="#"
                                        class="w-[160px] mt-1 ml-11 group flex items-center text-blue-400 px-6 py-2 text-base leading-6 font-medium rounded-full hover:bg-indigo-700 hover:text-blue-300">
                                        <div class="flex flex-row space-x-2 justify-center">
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                                            </svg>
                                            <p>Upload file</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="flex text-center p-1 my-2 order-last justify-end">
                                    <button
                                        class="text-white dark:text-gray-900 bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-bold py-2 px-8 rounded-full"
                                        name="save">
                                        Share post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>