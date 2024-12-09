<main class="max-w-2xl w-5/6 border border-y-0 border-gray-300 dark:border-gray-700">
    <aside>
        <div class="flex">
            <div class="flex-1 mx-2">
                <h2 class="p-4 text-xl font-semibold">Home</h2>
            </div>
        </div>
        <hr class="border-gray-300 dark:border-gray-700" />

        <!--Create new post-->
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
                        autocomplete="off" name="text_post" id="textArea" cols="50" rows="3"
                        placeholder="What's happening?" style="overflow: hidden;"></textarea>
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
                                <input type="file" name="file_post" id="uploadpost1" onchange="previewFilesWithIcons(1)"
                                    multiple accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx" />
                                <label for="uploadpost1" href="#"
                                    class="w-[160px] mt-1 ml-11 group flex items-center text-blue-400 px-6 py-2 text-base leading-6 font-medium rounded-full hover:bg-indigo-700 hover:text-blue-300">
                                    <div class="flex flex-row space-x-2 justify-center">
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
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
                                    name="save">
                                    Share post
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--End Buttons for Create new post-->
        <hr class="border-gray-300 dark:border-gray-700" />
    </aside>

    <!-- Creat new post modal -->
    <?php include 'create_new_post2.php' ?>
    <ul class="list-none">
        <!-- List of posts -->
        <?php
        require 'config.php';
        $query = mysqli_query($conn, "SELECT * FROM `userposts` ORDER BY post_id DESC") or die(mysqli_error($conn));
        while ($fetch = mysqli_fetch_array($query)) {
            $postID = $fetch['post_id']; // Retrieve the post ID
            $userID = $fetch['user_id']; // Retrieve the user ID
            ?>
            <!-- Post -->
            <?php
            // Retrieve the post's user ID using the provided post_id
            $postId = $fetch['post_id'];
            $sqlPost = "SELECT user_id FROM userposts WHERE post_id = $postId";
            $resultPost = mysqli_query($conn, $sqlPost) or die("Post query unsuccessful");

            $pictureToShow = $defaultProfilePicture; // Set a default value
        
            if ($resultPost) {
                $postRow = mysqli_fetch_assoc($resultPost);
                $postUserId = $postRow['user_id'];

                // Retrieve profile picture for the user who owns the post
                $sqlUser = "SELECT profile_picture FROM users WHERE user_id = $postUserId";
                $resultUser = mysqli_query($conn, $sqlUser) or die("User query unsuccessful");

                if ($resultUser) {
                    $userRow = mysqli_fetch_assoc($resultUser);
                    $profilePictureUrl = $userRow['profile_picture'];

                    if (!empty($profilePictureUrl)) {
                        $pictureToShow = $profilePictureUrl;
                    }
                }
            }
            ?>

            <!-- Popover php-->
            <?php include 'popover.php' ?>

            <div>
                <article class="hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                    <div class="flex flex-shrink-0 p-4 pb-0">
                        <a href="profile.php?view_user_id=<?php echo $userID; ?>" class="flex-shrink-0 group block">
                            <div class="flex items-center">
                                <div>
                                    <!-- Profile picture -->
                                    <div class="profile-picture"
                                        data-popover-target="popover-user-profile<?php echo $postId ?>">
                                        <img class="inline-block h-10 w-10 rounded-full" src="<?php echo $pictureToShow ?>"
                                            alt="#" />
                                    </div>
                                </div>
                                <div class="flex ml-3 items-center">
                                    <p class="text-base leading-5 font-medium text-gray-900 dark:text-white">
                                        <?php
                                        // Displays user profile User Name and User Email
                                        $sql = "SELECT * FROM users WHERE user_id = $userID";
                                        $result = mysqli_query($conn, $sql) or die("query unsuccessful");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $emailParts = explode('@', $row['iUserEmail']);
                                                $username = $emailParts[0]; // Extract the username part before '@'
                                                echo $row['ifirstname'] . ' ' . $row['ilastname'] . ' ';
                                                echo '<span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@' . $username . '</span>';
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="flex items-center">
                            <a href="" class="">
                                <span
                                    class="ml-1 text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
                                    <?php
                                    $postCreated = strtotime($fetch['post_created']); // Convert to timestamp
                                    echo date('F j, Y', $postCreated); // Display in desired format 
                                    ?>
                                    <?php
                                    $timePosted = strtotime($fetch['time_posted']); // Convert to timestamp
                                    echo date('g:i A', $timePosted); // Display in desired format
                                    ?>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="pl-16 overflow-none">
                        <p
                            class="text-base width-auto font-medium text-gray-900 dark:text-white flex-shrink mx-2 fit-content break-words">
                            <?php echo $fetch['text_post']; ?>
                        </p>

                        <?php
                        // Check if a file is uploaded
                        if (!empty($fetch['file_post'])) {
                            $file_url = $fetch['file_post'];
                            $file_extension = pathinfo($file_url, PATHINFO_EXTENSION);

                            // If it's a PDF, show a preview or link
                            if (strtolower($file_extension) == 'pdf') {
                                echo "<a href='$file_url' target='_blank' class='text-blue-500 hover:text-blue-700'>View PDF</a>";
                            }
                            // If it's an image, show an image preview
                            elseif (in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo "<img src='$file_url' alt='Image' class='max-w-full h-auto'>";
                            }
                            // If it's a document file, show a download link
                            elseif (in_array(strtolower($file_extension), ['doc', 'docx', 'xls', 'xlsx', 'txt'])) {
                                echo "<a href='$file_url' target='_blank' class='text-blue-500 hover:text-blue-700'>Download File</a>";
                            } else {
                                // Default handling for unknown file types
                                echo "<a href='$file_url' target='_blank' class='text-blue-500 hover:text-blue-700'>Download File</a>";
                            }
                        }
                        ?>

                        <div class="flex items-center justify-center py-4">
                            <?php if ($isCurrentUserPost) { ?>
                                <!-- Display user-specific buttons for their own posts -->
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">add_comment</span> 12.3 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">reply</span> 14 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">favorite</span> 14 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                    <span class="absolute material-symbols-rounded">upload</span>
                                </button>
                            <?php } else { ?>
                                <!-- Display buttons for other users' posts -->
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">add_comment</span> 12.3 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">reply</span> 14 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                    <span class="material-symbols-rounded">favorite</span> 14 k
                                </button>
                                <button
                                    class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                    <span class="absolute material-symbols-rounded">upload</span>
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                    <hr class="border-gray-300 dark:border-gray-700" />
                </article>
            </div>
            <!-- End of Post -->
            <?php
        }
        ?>
        <!-- End of list of Posts -->
    </ul>
</main>