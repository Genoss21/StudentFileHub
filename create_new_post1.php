<form id="form1" method="POST" action="save.php" enctype="multipart/form-data">
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
        <!--Toast-->

        <!--Text Area-->
        <div class="flex-1 px-2 pt-2 mt-2">
            <textarea
                class="bg-transparent font-medium text-lg w-full text-ellipsis border-0 focus:outline-none form-control text-gray-800 dark:text-gray-100 focus:ring-0 h-50"
                autocomplete="off" name="text_post" id="textArea" cols="50" rows="3" placeholder="What's happening?"
                style="overflow: hidden;"></textarea>
            <!-- File Previews -->
            <div id="file-preview1" class="flex flex-row flex-wrap gap-4 justify-center items-center">
                <!-- File previews will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Buttons for Create new post -->
    <div class="flex justify-between border-t border-gray-300 dark:border-gray-700">
        <div class="w-full">
            <div class="px-2">
                <div class="flex items-center">
                    <div class="flex-1 text-center p-1 m-2 order-1">
                        <input type="file" name="file_post[]" multiple id="uploadpost1"
                            onchange="previewFilesWithIcons(1)" multiple
                            accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx" />
                        <label for="uploadpost1" href="#"
                            class="w-[160px] mt-1 ml-11 group flex items-center text-blue-400 px-6 py-2 text-base leading-6 font-medium rounded-full hover:bg-indigo-700 hover:text-blue-300">
                            <div class="flex flex-row space-x-2 justify-center">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                                </svg>
                                <p>Upload file</p>
                            </div>
                        </label>
                    </div>

                    <div class="flex text-center p-1 my-2 order-last justify-end">
                        <button
                            class="text-white dark:text-gray-900 bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-bold py-2 px-8 rounded-full"
                            name="save" type="submit">
                            Share post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>