<?php
$popover_query = "SELECT * FROM userposts WHERE post_id = $postId";
$popover_queryR = mysqli_query($conn, $popover_query);

if (mysqli_num_rows($popover_queryR)) {
    while ($popovershit = mysqli_fetch_assoc($popover_queryR)) {
        $thisid = $popovershit['user_id'];

        $popover_user_query = "SELECT * FROM users WHERE user_id = $thisid";
        $poq_result = mysqli_query($conn, $popover_user_query);
        if (mysqli_num_rows($poq_result)) {
            while ($popoveruser = mysqli_fetch_assoc($poq_result)) {

                ?>

                <!--Popover-->
                <div data-popover id="popover-user-profile<?php echo $postId ?>" role="tooltip"
                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                    <div class="p-3">
                        <div class="flex items-center justify-between mb-2">
                            <a href="profile.php?view_user_id=<?php echo $userID; ?>">
                                <img class="w-10 h-10 rounded-full" src="<?php echo $pictureToShow ?>" alt="">
                            </a>
                            <p class="text-sm text-neutral-800 font-semibold dark:text-white">
                                <?php echo $popoveruser['ifirstname']; ?>
                                <?php echo $popoveruser['ilastname']; ?>
                            </p>
                            <div>
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
                            </div>
                        </div>
                        <p class="mb-4 text-sm">Open-source contributor. Building <a href="#"
                                class="text-blue-600 dark:text-blue-500 hover:underline">flowbite.com</a>.</p>
                        <ul class="flex text-sm">
                            <li class="mr-2">
                                <a href="#" class="hover:underline">
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        <?php echo $popovershit['user_id']; ?>
                                    </span>
                                    <span>Following</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">
                                    <span class="font-semibold text-gray-900 dark:text-white">3,758</span>
                                    <span>Followers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div data-popper-arrow></div>
                </div>

                <?php

            }
        }
    }
}
?>