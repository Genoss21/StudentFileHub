<div id="ViewpostModal<?php echo $postId ?>" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-0rem)] max-h-full backdrop-blur-sm bg-white/10">
    <div class="p-relative w-[1300px]">
        <!-- Close button in the upper left corner -->
        <div class="absolute top-0 left-0 m-4">
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="ViewpostModal<?php echo $postId ?>">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!--Image post-->
        <div class="grid grid-cols-3 gap-2">
            <div class="col-start-1 col-end-3">
                <div class="w-auto max-h-[calc(80vh-0px)]">
                    <div class="">
                        <?php if ($fetch['image_post']) { ?>
                            <div id="uploaded_image<?php echo $postId ?>" data-modal-target="ViewpostModal"
                                data-modal-toggle="ViewpostModal" class="md:flex-shrink cursor-pointer">

                                <div class="backdrop-blur-md rounded-lg">
                                    <div class="grid justify-center items-center h-[80vh]">

                                        <img class="w-[1200px] max-h-[calc(80vh-0px)] md:w-auto rounded-lg"
                                            src="<?php echo $fetch['image_post'] ?>" alt="" />

                                    </div>
                                </div>
                                <div class="flex items-center justify-center my-3 mx-[200px]">
                                    <?php if ($isCurrentUserPost) { ?>
                                        <!-- Display user-specific buttons for their own posts -->
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">add_comment</span>
                                            12.3 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">reply</span>
                                            14 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">favorite</span>
                                            14 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">upload</span>
                                        </button>
                                    <?php } else { ?>
                                        <!-- Display buttons for other users' posts -->
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">add_comment</span>
                                            12.3 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">reply</span>
                                            14 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">favorite</span>
                                            14 k
                                        </button>
                                        <button
                                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                            <span class="material-symbols-rounded">upload</span>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!--Comment section-->
            <div class="col-start-3 col-end-4">
                <div id="commentSection" class="bg-gray-100 dark:bg-[#28282B] rounded-lg h-[80vh]">
                    <div class="flex flex-shrink-0 p-4 pb-0">
                        <a href="profile.php?view_user_id=<?php echo $userID; ?>" class="flex-shrink-0 group block">
                            <div class="flex items-center">
                                <div>
                                    <!--Profile picture-->
                                    <div class="profile-picture" data-popover-target="popover-user-profile">
                                        <img class="inline-block h-10 w-10 rounded-full"
                                            src="<?php echo $pictureToShow ?>" alt="#" />
                                    </div>
                                </div>
                                <div class="ml-3 items-center">
                                    <?php
                                    // Displays user profile User Name and User Email
                                    $sql = "SELECT * FROM users WHERE user_id = $userID";
                                    $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $emailParts = explode('@', $row['iUserEmail']);
                                            $username = $emailParts[0]; // Extract the username part before '@'
                                            ?>
                                            <p class="text-base leading-5 font-medium text-gray-900 dark:text-white">
                                                <?php echo $viewpostuser['ifirstname']; ?>
                                                <?php echo $viewpostuser['ilastname']; ?>
                                            </p>
                                            <p
                                                class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
                                                <?php echo '@' . $username; ?>
                                            </p>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="flex">
                        <p
                            class="text-base width-auto font-medium text-gray-900 dark:text-white flex-shrink m-4 fit-content break-words">
                            <?php echo $fetch['text_post'] ?>
                        </p>
                    </div>

                    <div class="flex items-center mx-4">
                        <a href="" class="">
                            <span
                                class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
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
                    <hr class="border-gray-300 dark:border-gray-700 my-3" />
                    <!--View post buttons-->
                    <div class="flex items-center justify-center">
                        <?php if ($isCurrentUserPost) { ?>
                            <!-- Display user-specific buttons for their own posts -->
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">add_comment</span>
                                12.3 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">reply</span>
                                14 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">favorite</span>
                                14 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">upload</span>
                            </button>
                        <?php } else { ?>
                            <!-- Display buttons for other users' posts -->
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">add_comment</span>
                                12.3 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">reply</span>
                                14 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">favorite</span>
                                14 k
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">upload</span>
                            </button>
                        <?php } ?>
                    </div>

                    <hr class="border-gray-300 dark:border-gray-700 my-3" />

                    <div class="p-4 overflow-y-auto max-h-[calc(57vh)]">
                        <div class="">
                            <div class="flex flex-shrink-0">
                                <a href="profile.php?view_user_id=<?php echo $userID; ?>"
                                    class="flex-shrink-0 group block">
                                    <div class="flex items-center">
                                        <div>
                                            <!--Profile picture-->
                                            <div class="profile-picture" data-popover-target="popover-user-profile">
                                                <img class="inline-block h-10 w-10 rounded-full"
                                                    src="<?php echo $pictureToShow ?>" alt="#" />
                                            </div>
                                        </div>
                                        <div class="ml-3 items-center">
                                            <?php
                                            // Displays user profile User Name and User Email
                                            $sql = "SELECT * FROM users WHERE user_id = $userID";
                                            $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $emailParts = explode('@', $row['iUserEmail']);
                                                    $username = $emailParts[0]; // Extract the username part before '@'
                                                    ?>
                                                    <p class="text-base leading-5 font-medium text-gray-900 dark:text-white">
                                                        <?php echo $row['ifirstname'] . ' ' . $row['ilastname']; ?>
                                                    </p>
                                                    <p
                                                        class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
                                                        <?php echo '@' . $username; ?>
                                                    </p>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex">
                                <p
                                    class="text-base width-auto font-medium text-gray-900 dark:text-white flex-shrink my-4 fit-content break-words">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero non quae
                                    placeat
                                    praesentium amet odio eveniet, mollitia earum accusamus cum vero,
                                    consectetur fuga,

                                </p>
                            </div>
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
                            <!--Comment buttons-->
                            <div class="flex items-center justify-center my-3">
                                <?php if ($isCurrentUserPost) { ?>
                                    <!-- Display user-specific buttons for their own posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } else { ?>
                                    <!-- Display buttons for other users' posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } ?>
                            </div>

                            <hr class="border-gray-300 dark:border-gray-700 my-3" />

                        </div>
                        <div class="">
                            <div class="flex flex-shrink-0">
                                <a href="profile.php?view_user_id=<?php echo $userID; ?>"
                                    class="flex-shrink-0 group block">
                                    <div class="flex items-center">
                                        <div>
                                            <!--Profile picture-->
                                            <div class="profile-picture" data-popover-target="popover-user-profile">
                                                <img class="inline-block h-10 w-10 rounded-full"
                                                    src="<?php echo $pictureToShow ?>" alt="#" />
                                            </div>
                                        </div>
                                        <div class="ml-3 items-center">
                                            <?php
                                            // Displays user profile User Name and User Email
                                            $sql = "SELECT * FROM users WHERE user_id = $userID";
                                            $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $emailParts = explode('@', $row['iUserEmail']);
                                                    $username = $emailParts[0]; // Extract the username part before '@'
                                                    ?>
                                                    <p class="text-base leading-5 font-medium text-gray-900 dark:text-white">
                                                        <?php echo $row['ifirstname'] . ' ' . $row['ilastname']; ?>
                                                    </p>
                                                    <p
                                                        class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
                                                        <?php echo '@' . $username; ?>
                                                    </p>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex">
                                <p
                                    class="text-base width-auto font-medium text-gray-900 dark:text-white flex-shrink my-4 fit-content break-words">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero non quae
                                    placeat
                                    praesentium amet odio eveniet, mollitia earum accusamus cum vero,
                                    consectetur fuga,

                                </p>
                            </div>
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
                            <!--Comment buttons-->
                            <div class="flex items-center justify-center my-3">
                                <?php if ($isCurrentUserPost) { ?>
                                    <!-- Display user-specific buttons for their own posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } else { ?>
                                    <!-- Display buttons for other users' posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } ?>
                            </div>

                            <hr class="border-gray-300 dark:border-gray-700 my-3" />

                        </div>
                        <div class="">
                            <div class="flex flex-shrink-0">
                                <a href="profile.php?view_user_id=<?php echo $userID; ?>"
                                    class="flex-shrink-0 group block">
                                    <div class="flex items-center">
                                        <div>
                                            <!--Profile picture-->
                                            <div class="profile-picture" data-popover-target="popover-user-profile">
                                                <img class="inline-block h-10 w-10 rounded-full"
                                                    src="<?php echo $pictureToShow ?>" alt="#" />
                                            </div>
                                        </div>
                                        <div class="ml-3 items-center">
                                            <?php
                                            // Displays user profile User Name and User Email
                                            $sql = "SELECT * FROM users WHERE user_id = $userID";
                                            $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $emailParts = explode('@', $row['iUserEmail']);
                                                    $username = $emailParts[0]; // Extract the username part before '@'
                                                    ?>
                                                    <p class="text-base leading-5 font-medium text-gray-900 dark:text-white">
                                                        <?php echo $row['ifirstname'] . ' ' . $row['ilastname']; ?>
                                                    </p>
                                                    <p
                                                        class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">
                                                        <?php echo '@' . $username; ?>
                                                    </p>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex">
                                <p
                                    class="text-base width-auto font-medium text-gray-900 dark:text-white flex-shrink my-4 fit-content break-words">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero non quae
                                    placeat
                                    praesentium amet odio eveniet, mollitia earum accusamus cum vero,
                                    consectetur fuga,

                                </p>
                            </div>
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
                            <!--Comment buttons-->
                            <div class="flex items-center justify-center my-3">
                                <?php if ($isCurrentUserPost) { ?>
                                    <!-- Display user-specific buttons for their own posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } else { ?>
                                    <!-- Display buttons for other users' posts -->
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">add_comment</span>
                                        12.3 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">reply</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">favorite</span>
                                        14 k
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                        <span class="material-symbols-rounded">upload</span>
                                    </button>
                                <?php } ?>
                            </div>

                            <hr class="border-gray-300 dark:border-gray-700 my-3" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>