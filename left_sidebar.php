<aside class="py-4">
    <!--Left sidebar-->
    <div class="w-[300px] bg-indigo-700">
        <div class="w-[300px] overflow-y-auto fixed h-screen">
            <!--Logo-->
            <div class="ml-7">
                <a class="" href="index.php"><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-extrabold text-xl text-left tracking-tighter">Online
                        Document Management System(ODMS)</span></a>
            </div>
            <!--Nav-->
            <ul class="space-y-2 my-5">
                <li>
                    <a href="index.php"
                        class="flex py-3 px-6 rounded-2xl text-base font-semibold transform hover:bg-indigo-700 duration-200 hover:text-white"><span
                            class="material-symbols-rounded mr-2"> home </span>Home</a>
                </li>
                <li>
                    <a href=""
                        class="flex py-3 px-6 rounded-2xl text-base font-semibold transform hover:bg-indigo-700 duration-200 hover:text-white"><span
                            class="material-symbols-rounded mr-2">
                            notifications </span>Notifications</a>
                </li>
                <li>
                    <a href="profile.php"
                        class="flex py-3 px-6 rounded-2xl text-base font-semibold transform hover:bg-indigo-700 duration-200 hover:text-white">
                        <span class="material-symbols-rounded mr-2"> person </span>Profile
                    </a>
                </li>
                <li>
                    <div class="relative">
                        <button
                            class="w-[300px] py-3 px-6 mr-2 rounded-2xl text-base text-left transform hover:bg-indigo-700 hover:text-gray-100 duration-200 "
                            id="morebutton" data-dropdown-toggle="dropdown">
                            <span class="material-symbols-rounded absolute">
                                more_horiz
                            </span>
                            <span class="ml-8 font-semibold">More</span>
                        </button>
                    </div>
                </li>
            </ul>
            <div class="w-[300px] rounded-2xl text-base text-left z-10 hidden" id="dropdown">
                <ul class="absolute bottom-full mb-16 bg-white dark:bg-gray-700 rounded-2xl shadow-lg">
                    <li class="w-[250px] py-[6px] px-2 mx-2 my-1 rounded-2xl transform">
                        <div class="flex flex-row justify-between toggle">
                            <label for="dark-toggle" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" name="dark-mode" id="dark-toggle" class="checkbox hidden" />
                                    <div
                                        class="block border-[1px] dark:border-white border-gray-300 w-12 h-7 rounded-2xl">
                                    </div>
                                    <div
                                        class="dot absolute left-1 top-1 dark:bg-white bg-gray-800 w-5 h-5 rounded-2xl transition">
                                    </div>
                                </div>
                                <div class="ml-3 dark:text-white text-gray-900 font-medium">
                                    Dark Mode
                                </div>
                            </label>
                        </div>
                    </li>

                </ul>
            </div>

            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button"
                class="w-[300px] py-3 px-6 rounded-2xl text-base transform text-white dark:text-gray-900 bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 duration-200 font-bold">
                <div class="flex flex-row space-x-2 justify-center">
                    <svg class="w-6 h-6 text-base transform text-white dark:text-gray-900" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>Add Post</p>
                </div>
            </button>

            <!--Logout Modal-->
            <div class="w-[300px] rounded-2xl text-base text-left z-10 hidden" id="dropdown_logout">
                <ul class="absolute bottom-full h-14 mb-24 bg-white dark:bg-gray-700 rounded-2xl shadow-lg">
                    <li class="my-1">
                        <a href="logout.php"><button
                                class="w-[250px] py-2 px-4 mx-2 my-1 text-left rounded-2xl transform hover:bg-indigo-700 duration-200"><span
                                    class="absolute material-symbols-rounded">
                                    logout
                                </span>
                                <span class="ml-8">Logout</span>
                                <button></a>
                    </li>
                </ul>
            </div>

            <!--User Menu-->
            <div class="absolute bottom-8">
                <button id="morebutton" data-dropdown-toggle="dropdown_logout"
                    class="flex-shrink-0 flex hover:bg-gray-200 dark:hover:bg-gray-900 rounded-2xl px-6 py-3 mt-12 mr-2">
                    <a href="#" class="flex-shrink-0 group block">
                        <div class="flex items-center">

                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $userId = $_SESSION['user_id'];

                                // Query the database to get the user's profile picture
                                $getProfilePictureQuery = "SELECT profile_picture FROM users WHERE user_id = '$userId'";
                                $profilePictureResult = mysqli_query($conn, $getProfilePictureQuery);

                                if ($profilePictureResult) {
                                    $profilePictureData = mysqli_fetch_assoc($profilePictureResult);

                                    if ($profilePictureData && isset($profilePictureData['profile_picture']) && !empty($profilePictureData['profile_picture'])) {
                                        // User has a profile picture set, use it
                                        $profilePicture = $profilePictureData['profile_picture'];
                                    } else {
                                        // User has no profile picture set, show the default picture
                                        $profilePicture = 'Images/user1.jpg';
                                    }
                                } else {
                                    // Error occurred while querying the database
                                    // Handle the error as needed
                                }
                            }
                            ?>

                            <div>
                                <img class="inline-block h-10 w-10 rounded-2xl" src="<?php echo $profilePicture; ?>"
                                    alt="#" />
                            </div>

                            <div class="ml-3 text-left">
                                <p class="text-base leading-6 font-medium">
                                    <?php
                                    if (isset($_SESSION['Email']) && $_SESSION['Email'] === $fetch['Email']) {
                                        echo $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];
                                        $isCurrentUserPost = true;
                                    } else {
                                        echo $row['ifirstname'] . ' ' . $row['ilastname']; // Display username for other users' posts
                                        $isCurrentUserPost = false;
                                    }
                                    ?>
                                </p>
                                <p
                                    class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-500 transition ease-in-out duration-150">
                                    <?php $email = $_SESSION['iUserEmail'];
                                    $userName = substr($email, 0, strpos($email, '@'));
                                    echo '@' . $userName; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </button>
            </div>
        </div>
    </div>
</aside>