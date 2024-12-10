<?php
include('config.php');
session_start();

$Email = $_SESSION['iUserEmail'];
$user_id = $_SESSION["user_id"];
$firstname = $_SESSION["ifirstname"];
$lastname = $_SESSION["ilastname"];
$birth_month = $_SESSION["ibirth_month"];
$birth_day = $_SESSION["ibirth_day"];
$birth_year = $_SESSION["ibirth_year"];
$bio = $_SESSION["bio"];
$location = $_SESSION["location"];
$website = $_SESSION["website"];

$res = mysqli_query($conn, "SELECT * FROM users WHERE iUserEmail ='$Email'");
$row = mysqli_fetch_array($res);

// Declare variables based on fetched data
$fname = $row['ifirstname'];
$lname = $row['ilastname'];
$bm = $row['ibirth_month'];
$bd = $row['ibirth_day'];
$by = $row['ibirth_year'];
$uemail = $row['iUserEmail'];

// Will check if the user is logged in
if (empty($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect user to login page
  exit();
}

// Fetch the post data if edit is triggered
if (isset($_GET['edit_post_id'])) {
  $postId = intval($_GET['edit_post_id']);
  $query = "SELECT * FROM userposts WHERE post_id = $postId";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $editPostData = mysqli_fetch_assoc($result);
  } else {
    echo "Error: Post not found.";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    input:checked~.dot {
      transform: translateX(100%);
      /* background-color: #132b50; */
    }
  </style>
  <title>ツイッター</title>
</head>

<body class="text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-[#28282B]">
  <div class="p-relative h-screen">
    <div class="flex justify-center">
      <!--Left sidebar-->
      <?php include 'left_sidebar.php' ?>
      <!--Contents in the center-->
      <aside>
        <main role="main" class="">
          <div class="flex w-[1010px] mx-2">
            <section class="max-w-2xl w-5/6 border border-y-0 border-gray-300 dark:border-gray-700">
              <aside>

                <!-- Nav back-->
                <div>
                  <div class="flex justify-start">
                    <div class="px-4 py-3 mx-3">
                      <a href="index.php"
                        class="text-2xl font-medium rounded-full text-blue-400 hover:bg-indigo-800 hover:text-blue-300 float-right">
                        <span class="p-2 material-symbols-rounded">
                          arrow_back
                        </span>
                      </a>
                    </div>
                    <div class="m-2">
                      <h2 class="mb-0 text-xl font-bold">
                        <?php
                        if (isset($_GET['view_user_id'])) {
                          // Check if the view_user_id parameter is set in the URL
                          $viewingUserId = $_GET['view_user_id'];

                          // Display user name for the user being viewed
                          $sql = "SELECT iUserEmail FROM users WHERE user_id = $viewingUserId LIMIT 1";
                          $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                          // Display the name and username of the user that being view 
                          if ($row = mysqli_fetch_assoc($result)) {
                            $email = $row['iUserEmail'];
                            $userName = substr($email, 0, strpos($email, '@'));
                            echo '@' . $userName;
                          }
                        } else {
                          $email = $_SESSION['iUserEmail']; // Display the name and username of user that currently logged in
                          $userName = substr($email, 0, strpos($email, '@'));
                          echo '@' . $userName;
                        }
                        ?>

                      </h2>
                      <p class="mb-0 w-48 text-xs text-gray-400">9,416 Tweets</p>
                    </div>
                  </div>

                  <hr class="border-gray-300 dark:border-gray-700" />
                </div>

                <!-- User card-->
                <div class="text-gray-900 dark:text-gray-100">
                  <div class="">
                    <!-- Background Image -->
                    <?php
                    $loggedInUserId = isset($_GET['view_user_id']) ? $_GET['view_user_id'] : $_SESSION['user_id'];
                    $sql = "SELECT profile_picture, background_picture FROM users WHERE user_id = $loggedInUserId";
                    $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                    $row = mysqli_fetch_assoc($result);

                    $profilePictureUrl = $row['profile_picture'];
                    // Check if the user already have a background picture or set to the default one "Images/tokyo.jpg"
                    $backgroundPictureUrl = !empty($row['background_picture']) ? $row['background_picture'] : "Images/tokyo.jpg";

                    function displayProfileWithBackground($profilePictureUrl, $backgroundPictureUrl, $isDefaultPicture)
                    {
                      echo '<div class="w-full bg-cover bg-no-repeat bg-center" style="height: 250px; background-image: url(\'' . $backgroundPictureUrl . '\');">';
                      if (!$isDefaultPicture && !empty($profilePictureUrl)) {
                        echo '<img src="' . $profilePictureUrl . '" alt="" class="opacity-0 w-full h-full" />';
                      }
                      echo '</div>';
                    }

                    displayProfileWithBackground($profilePictureUrl, $backgroundPictureUrl, empty($row['background_picture']));
                    ?>

                  </div>

                  <div class="p4">
                    <div class="relative flex w-full">
                      <!--Profile picture-->
                      <div class="flex flex-1">
                        <div class="-mt-[70px] ml-4">
                          <div class="h-36 w-36 md rounded-full relative Profile picture">
                            <?php
                            // Set the default profile picture
                            $defaultProfilePicture = 'Images/user1.jpg';

                            if (isset($_GET['view_user_id'])) {
                              // User is viewing another user's profile
                              $viewingUserId = $_GET['view_user_id'];
                            } else {
                              // User is viewing their own profile
                              $loggedInUserId = $_SESSION['user_id']; // Change to the appropriate session variable
                            
                              if (isset($loggedInUserId)) {
                                $viewingUserId = $loggedInUserId;
                              } else {
                                // Handle the case when the user is not logged in or $_SESSION['user_id'] is not set
                                // You may want to set a default user ID or take appropriate action here
                              }
                            }

                            // Retrieve profile picture URL for the viewing user
                            $sql = "SELECT profile_picture FROM users WHERE user_id = $viewingUserId";
                            $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                            if ($row = mysqli_fetch_assoc($result)) {
                              // User has a profile picture, display it
                              $profilePictureUrl = $row['profile_picture'];
                            } else {
                              // User doesn't have a profile picture, use the default
                              $profilePictureUrl = $defaultProfilePicture;
                            }

                            // If $profilePictureUrl is empty, set it to the default
                            if (empty($profilePictureUrl)) {
                              $profilePictureUrl = $defaultProfilePicture;
                            }

                            // Display the profile picture
                            echo '<img src="' . $profilePictureUrl . '" alt="" class="h-36 w-36 md rounded-full relative border-4 border-gray-300" />';
                            ?>
                            <div class="absolute"></div>
                          </div>

                        </div>
                      </div>
                      <!-- Edit Profile button -->
                    </div>

                    <!-- Profile info -->
                    <div class="space-y-1 justify-center w-full mt-3 ml-3">
                      <!--Basic Information-->
                      <h2 class="text-xl leading-6 font-bold">
                        <?php
                        $defaultName = $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];

                        if (isset($_GET['view_user_id'])) {
                          $viewingUserId = $_GET['view_user_id'];

                          // Retrieve and display username for the user being viewed
                          $sql = "SELECT * FROM users WHERE user_id = $viewingUserId";
                          $result = mysqli_query($conn, $sql) or die("query unsuccessful");
                          if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo $row['ifirstname'] . ' ' . $row['ilastname'];
                          } else {
                            echo $defaultName; // Display default name if user not found
                          }
                          $isCurrentUserPost = false;
                        } else {
                          echo $defaultName;
                          $isCurrentUserPost = true;
                        }
                        ?>
                      </h2>
                      <p class="text-sm leading-5 font-medium text-gray-600">
                        <?php
                        if (isset($_GET['view_user_id'])) {
                          // Extract the username from the email for the user being viewed
                          $email = $row['iUserEmail'];
                        } else {
                          $email = $_SESSION['iUserEmail'];
                        }

                        // Extract the part before the "@" and prepend "@"
                        $username = explode('@', $email)[0];
                        echo '@' . $username;
                        ?>
                      </p>

                      <!-- Description and others -->
                      <div class="mt-3">
                        <p class="leading-tight mb-2 mr-5">
                          <?php
                          if (isset($_GET['view_user_id'])) {
                            // Retrieve and display the bio for the user being viewed
                            $viewingUserId = $_GET['view_user_id'];
                            $sql = "SELECT bio FROM users WHERE user_id = $viewingUserId";
                            $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                            if (mysqli_num_rows($result) > 0) {
                              $row = mysqli_fetch_assoc($result);
                              echo $row['bio'];
                            } else {
                              echo "Bio not available"; // Display a default message if user not found
                            }
                          } else {
                            // Display the bio of the currently logged-in user
                            echo $_SESSION['bio'];
                          }
                          ?>
                        </p>
                        <div class="text-gray-600 flex">
                          <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                              <g>
                                <path
                                  d="M11.96 14.945c-.067 0-.136-.01-.203-.027-1.13-.318-2.097-.986-2.795-1.932-.832-1.125-1.176-2.508-.968-3.893s.942-2.605 2.068-3.438l3.53-2.608c2.322-1.716 5.61-1.224 7.33 1.1.83 1.127 1.175 2.51.967 3.895s-.943 2.605-2.07 3.438l-1.48 1.094c-.333.246-.804.175-1.05-.158-.246-.334-.176-.804.158-1.05l1.48-1.095c.803-.592 1.327-1.463 1.476-2.45.148-.988-.098-1.975-.69-2.778-1.225-1.656-3.572-2.01-5.23-.784l-3.53 2.608c-.802.593-1.326 1.464-1.475 2.45-.15.99.097 1.975.69 2.778.498.675 1.187 1.15 1.992 1.377.4.114.633.528.52.928-.092.33-.394.547-.722.547z">
                                </path>
                                <path
                                  d="M7.27 22.054c-1.61 0-3.197-.735-4.225-2.125-.832-1.127-1.176-2.51-.968-3.894s.943-2.605 2.07-3.438l1.478-1.094c.334-.245.805-.175 1.05.158s.177.804-.157 1.05l-1.48 1.095c-.803.593-1.326 1.464-1.475 2.45-.148.99.097 1.975.69 2.778 1.225 1.657 3.57 2.01 5.23.785l3.528-2.608c1.658-1.225 2.01-3.57.785-5.23-.498-.674-1.187-1.15-1.992-1.376-.4-.113-.633-.527-.52-.927.112-.4.528-.63.926-.522 1.13.318 2.096.986 2.794 1.932 1.717 2.324 1.224 5.612-1.1 7.33l-3.53 2.608c-.933.693-2.023 1.026-3.105 1.026z">
                                </path>
                              </g>
                            </svg>
                            <a href="https://www.facebook.com/FrtzRome/" target="#"
                              class="leading-5 ml-1 text-blue-400">
                              <?php
                              if (isset($_GET['view_user_id'])) {
                                // Retrieve and display the website for the user being viewed
                                $viewingUserId = $_GET['view_user_id'];
                                $sql = "SELECT website FROM users WHERE user_id = $viewingUserId";
                                $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                                if (mysqli_num_rows($result) > 0) {
                                  $row = mysqli_fetch_assoc($result);
                                  echo $row['website'];
                                } else {
                                  echo "Website not available"; // Display a default message if user not found
                                }
                              } else {
                                // Display the website of the currently logged-in user
                                echo $_SESSION['website'];
                              }
                              ?>
                            </a></span>
                          <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                              <g>
                                <path
                                  d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z">
                                </path>
                                <circle cx="7.032" cy="8.75" r="1.285"></circle>
                                <circle cx="7.032" cy="13.156" r="1.285"></circle>
                                <circle cx="16.968" cy="8.75" r="1.285"></circle>
                                <circle cx="16.968" cy="13.156" r="1.285"></circle>
                                <circle cx="12" cy="8.75" r="1.285"></circle>
                                <circle cx="12" cy="13.156" r="1.285"></circle>
                                <circle cx="7.032" cy="17.486" r="1.285"></circle>
                                <circle cx="12" cy="17.486" r="1.285"></circle>
                              </g>
                            </svg>
                            <span class="leading-5 ml-1">
                              <?php
                              $dateCreated = $_SESSION['date_created'];

                              // Convert the date to a format like "August 26, 2023"
                              $formattedDate = date("F j, Y", strtotime($dateCreated));

                              // Output the formatted date
                              echo $formattedDate; ?>
                            </span></span>
                        </div>
                        <div class="">
                          <span class="absolute -mt-1 text-xl material-symbols-rounded text-center">
                            location_on
                          </span>
                          <p class="leading-tight ml-6 mb-2">
                            <?php
                            if (isset($_GET['view_user_id'])) {
                              // Retrieve and display the location for the user being viewed
                              $viewingUserId = $_GET['view_user_id'];
                              $sql = "SELECT location FROM users WHERE user_id = $viewingUserId";
                              $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                              if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['location'];
                              } else {
                                echo "Location not available"; // Display a default message if user not found
                              }
                            } else {
                              // Display the location of the currently logged-in user
                              echo $_SESSION['location'];
                            }
                            ?>
                          </p>
                        </div>
                      </div>
                      <div class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
                        <div class="text-center pr-3">
                          <span class="font-bold text-gray-100">520</span><span class="text-gray-600"> Following</span>
                        </div>
                        <div class="text-center px-3">
                          <span class="font-bold text-gray-100">23,4m </span><span class="text-gray-600">
                            Followers</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="relative">
                  <div class="flex h-14 text-center justify-center items-center">
                    <div class="flex-1 relative">
                      <button class="h-14 w-full hover:bg-gray-200 dark:hover:bg-gray-800">Posts</button>
                      <div class="absolute bottom-0 rounded left-1/2 transform -translate-x-1/2 h-1 w-10 bg-blue-500">
                      </div>
                    </div>
                    <div class="flex-1 relative">
                      <button class="h-14 w-full hover:bg-gray-200 dark:hover:bg-gray-800">Replies</button>
                    </div>
                    <div class="flex-1 relative">
                      <button class="h-14 w-full hover:bg-gray-200 dark:hover:bg-gray-800">Highlights</button>
                    </div>
                    <div class="flex-1 relative">
                      <button class="h-14 w-full hover:bg-gray-200 dark:hover:bg-gray-800">Media</button>
                    </div>
                    <div class="flex-1 relative">
                      <button class="h-14 w-full hover:bg-gray-200 dark:hover:bg-gray-800">Likes</button>
                    </div>
                  </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-700" />

              </aside>

              <!-- Creat new post modal -->
              <?php include 'create_new_post2.php' ?>

              <!-- Edit Post Form -->
              <div id="editprofileform" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:-inset-0 h-[calc(100%-0rem)] max-h-full backdrop-blur-sm bg-white/10">
                <div class="relative w-full max-w-2xl max-h-full">
                  <!-- Modal Content -->
                  <div class="relative rounded-lg shadow bg-gray-100 dark:bg-[#28282B]">

                    <!-- Modal Header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-700">
                      <h3
                        class="text-xl font-semibold hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200">
                        Edit Post
                      </h3>
                      <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-gray-100"
                        data-modal-hide="editprofileform">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>

                    <!-- Edit Post Form -->

                    <div>
                      <article
                        class="hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-350 ease-in-out rounded-lg">
                        <!-- User Details -->
                        <div class="grid p-4 pb-0">
                          <div class="flex items-center">
                            <!-- Profile Picture -->
                            <div>
                              <?php
                              $defaultProfilePicture = 'Images/user1.jpg';
                              $viewingUserId = $_GET['view_user_id'] ?? $_SESSION['user_id'] ?? null;

                              if ($viewingUserId) {
                                $sql = "SELECT profile_picture FROM users WHERE user_id = $viewingUserId";
                                $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                                $row = mysqli_fetch_assoc($result);
                                $profilePictureUrl = !empty($row['profile_picture']) ? $row['profile_picture'] : $defaultProfilePicture;
                              } else {
                                $profilePictureUrl = $defaultProfilePicture;
                              }

                              echo '<img src="' . $profilePictureUrl . '" alt="Profile Picture" class="inline-block h-10 w-10 rounded-full" />';
                              ?>
                            </div>

                            <!-- User Name and Details -->
                            <div class="ml-3">
                              <p class="w-[500px] text-base leading-6 font-medium text-gray-900 dark:text-gray-100">
                                <?php
                                if ($viewingUserId) {
                                  $sql = "SELECT * FROM users WHERE user_id = $viewingUserId";
                                  $result = mysqli_query($conn, $sql) or die("Query unsuccessful");
                                  if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $emailParts = explode('@', $row['iUserEmail']);
                                    $username = $emailParts[0];
                                    echo $row['ifirstname'] . ' ' . $row['ilastname'];
                                    echo ' <span class="text-sm leading-5 font-medium text-gray-400">@' . $username . '</span>';
                                    echo ' <span class="text-sm leading-5 font-medium text-gray-400">' . date('F j, Y g:i A') . '</span>';
                                  }
                                } else {
                                  $emailParts = explode('@', $_SESSION['iUserEmail']);
                                  $username = $emailParts[0];
                                  echo $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];
                                  echo ' <span class="text-sm leading-5 font-medium text-gray-400">@' . $username . '</span>';
                                  echo ' <span class="text-sm leading-5 font-medium text-gray-400">' . date('F j, Y g:i A') . '</span>';
                                }
                                ?>
                              </p>
                            </div>
                          </div>
                        </div>

                        <!-- Post Content -->
                        <?php
                        require 'config.php';

                        // $_SESSION["iUserEmail"] contains the email of the logged-in user or the user being visited
                        $userEmail = $_SESSION["iUserEmail"];

                        // Retrieve user ID based on the user's email
                        $userQuery = mysqli_query($conn, "SELECT user_id FROM `users` WHERE iUserEmail = '$userEmail'");
                        $userData = mysqli_fetch_assoc($userQuery);
                        $userId = $userData['user_id'];

                        // Determine whose profile is being viewed
                        $viewingUserId = null;
                        if (isset($_GET['view_user_id'])) {
                          $viewingUserId = $_GET['view_user_id'];
                        }

                        // Construct the query based on the viewing user
                        if ($viewingUserId !== null) {
                          // Viewing a specific user's profile
                          $query = mysqli_query($conn, "SELECT * FROM `userposts` WHERE user_id = '$viewingUserId' ORDER BY post_id DESC");
                        } else {
                          // Viewing own profile
                          $query = mysqli_query($conn, "SELECT * FROM `userposts` WHERE user_id = '$userId' ORDER BY post_id DESC");
                        }

                        // Check if any post is retrieved
                        while ($post = mysqli_fetch_assoc($query)) {
                          $postContent = !empty($post['post_content']) ? $post['post_content'] : 'No content available.';
                          $documentUrl = !empty($post['document_url']) ? $post['document_url'] : null;
                          $postId = $post['post_id'];

                          // Display Post Content
                          echo '<p class="text-base font-medium text-gray-900 dark:text-gray-100 break-words">';
                          echo htmlspecialchars($postContent);
                          echo '</p>';

                          // Display Uploaded Document (if any)
                          if ($documentUrl) {
                            echo '<div class="pt-3">';
                            echo '<p>Uploaded Document: ';
                            echo '<a href="uploads/' . htmlspecialchars($documentUrl) . '" target="_blank">' . basename($documentUrl) . '</a>';
                            echo '</p>';
                            echo '</div>';
                          } else {
                            echo '<p>No document uploaded.</p>';
                          }
                        }
                        ?>

                        <!-- Display Post Content -->
                        <p class="text-base font-medium text-gray-900 dark:text-gray-100 break-words">
                          <?php echo htmlspecialchars($postContent); ?>
                        </p>

                        <!-- Display Uploaded Document -->
                        <?php if ($documentUrl): ?>
                          <div class="pt-3">
                            <p>Uploaded Document:
                              <a href="uploads/<?php echo htmlspecialchars($documentUrl); ?>"
                                target="_blank"><?php echo basename($documentUrl); ?></a>
                            </p>
                          </div>
                        <?php else: ?>
                          <p>No document uploaded.</p>
                        <?php endif; ?>


                        <!-- Action Buttons (if needed) -->
                        <div class="flex items-center justify-center py-4">
                          <button
                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                            <span class="material-symbols-rounded">add_comment</span> 12.3k
                          </button>
                          <button
                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                            <span class="material-symbols-rounded">reply</span> 14k
                          </button>
                          <button
                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                            <span class="material-symbols-rounded">favorite</span> 14k
                          </button>
                          <button
                            class="flex-1 flex items-center justify-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                            <span class="material-symbols-rounded">upload</span>
                          </button>
                        </div>


                      </article>
                    </div>
                  </div>
                </div>
              </div>

              <!--End of edit post-->

              <!--List of post-->
              <ul class="list-none">
                <?php
                require 'config.php';

                // $_SESSION["iUserEmail"] contains the email of the logged-in user or the user being visited
                $userEmail = $_SESSION["iUserEmail"];

                // Retrieve user ID based on the user's email
                $userQuery = mysqli_query($conn, "SELECT user_id FROM `users` WHERE iUserEmail = '$userEmail'");
                $userData = mysqli_fetch_assoc($userQuery);
                $userId = $userData['user_id'];

                // Determine whose profile is being viewed
                $viewingUserId = null;
                if (isset($_GET['view_user_id'])) {
                  $viewingUserId = $_GET['view_user_id'];
                }

                // Construct the query based on the viewing user
                if ($viewingUserId !== null) {
                  // Viewing a specific user's profile
                  $query = mysqli_query($conn, "SELECT * FROM `userposts` WHERE user_id = '$viewingUserId' ORDER BY post_id DESC");
                } else {
                  // Viewing own profile
                  $query = mysqli_query($conn, "SELECT * FROM `userposts` WHERE user_id = '$userId' ORDER BY post_id DESC");
                }

                while ($fetch = mysqli_fetch_array($query)) {
                  // Determine whether the user is viewing their own post
                  $isCurrentUserPost = ($viewingUserId === $userId);
                  ?>

                  <!--Post-->
                  <div>
                    <article class="hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class="grid p-4 pb-0">
                        <div class="flex items-center">
                          <!--Profile picture-->
                          <div>
                            <?php
                            $defaultProfilePicture = 'Images/user1.jpg';

                            if (isset($_GET['view_user_id'])) {
                              $viewingUserId = $_GET['view_user_id'];
                            } else if (isset($_SESSION['user_id'])) {
                              $viewingUserId = $_SESSION['user_id'];
                            } else {
                              $viewingUserId = null;
                            }

                            $sql = "SELECT profile_picture FROM users WHERE user_id = $viewingUserId";
                            $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                            $row = mysqli_fetch_assoc($result);
                            $profilePictureUrl = ($row && !empty($row['profile_picture'])) ? $row['profile_picture'] : $defaultProfilePicture;

                            echo '<img src="' . $profilePictureUrl . '" alt="" class="inline-block h-10 w-10 rounded-full" />';
                            ?>
                          </div>

                          <div class="ml-3">
                            <p class="w-[500px] text-base leading-6 font-medium text-gray-900 dark:text-gray-100">
                              <?php
                              // Displaying user details
                              $emailParts = explode('@', $_SESSION['iUserEmail']);
                              $username = $emailParts[0];

                              echo $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];

                              echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@';
                              echo $username;
                              echo '</span>';

                              $postCreated = strtotime($fetch['post_created']); // Convert to timestamp
                              $timePosted = strtotime($fetch['time_posted']); // Convert to timestamp
                              echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">';
                              echo date('F j, Y', $postCreated) . ' ' . date('g:i A', $timePosted);
                              echo '</span>';
                              ?>
                            </p>
                          </div>

                          <!-- Edit post button -->

                          <?php
                          require 'config.php';

                          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_post'])) {
                            $post_id = $_POST['edit_post_id']; // Use a hidden input to pass the post ID
                            $text_post = mysqli_real_escape_string($conn, $_POST['text_post']);

                            // Update the post in the database
                            $query = "UPDATE userposts SET text_post = '$text_post' WHERE post_id = '$post_id'";

                            if (mysqli_query($conn, $query)) {
                              header('Location: profile.php?post_updated=true');
                              exit;
                            } else {
                              $error_message = "Error updating post: " . mysqli_error($conn);
                            }
                          }
                          ?>

                          <div class="flex ml-auto justify-end">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                              $loggedInUserId = $_SESSION['user_id'];
                              $viewUserId = isset($_GET['view_user_id']) ? $_GET['view_user_id'] : $loggedInUserId;

                              if ($loggedInUserId == $viewUserId) {
                                ?>
                                <button type="button" data-modal-target="editprofileform" data-modal-toggle="editprofileform">
                                  <span class="material-symbols-rounded">more_vert</span>
                                </button>
                                <?php
                              } else {
                                ?>
                                <button type="button" data-modal-target="reportpost" data-modal-toggle="reportpost">
                                  <span class="material-symbols-rounded">more_vert</span>
                                </button>
                                <?php
                              }
                            }
                            ?>
                          </div>
                        </div>

                      </div>

                      <!--Display all post of the user -->

                      <div class="px-16 overflow-none">
                        <p
                          class="text-base width-auto font-medium text-gray-900 dark:text-gray-100 flex-shrink mx-2 mb-2 fit-content break-words">
                          <?php echo $fetch['text_post']; ?>
                        </p>

                        <!-- Display images or files attached to the post -->
                        <?php
                        if (!empty($fetch['file_post'])) {
                          // Split file URLs and process them into an array
                          $files = explode(',', $fetch['file_post']); // Split file URLs
                          $imageFiles = [];
                          $otherFiles = [];

                          // Debugging: Check the contents of the $files array
                          // echo "<pre>";
                          // var_dump($files); // Output the array after splitting
                          // echo "</pre>";
                      
                          // Separate image files and other files
                          foreach ($files as $file_url) {
                            $file_url = trim($file_url);
                            $file_extension = strtolower(pathinfo($file_url, PATHINFO_EXTENSION));

                            // Debugging: Check the file extension and URL for each file
                            // echo "<pre>";
                            // var_dump($file_url); // Output the file URL being processed
                            // var_dump($file_extension); // Output the file extension being checked
                            // echo "</pre>";
                      
                            // Check if the file is an image or another type
                            if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                              $imageFiles[] = $file_url;
                            } else {
                              $otherFiles[] = $file_url;
                            }
                          }

                          // Debugging: Check the categorized image and other files
                          // echo "<pre>";
                          // echo "Image Files: ";
                          // var_dump($imageFiles);
                          // echo "Other Files: ";
                          // var_dump($otherFiles);
                          // echo "</pre>";
                      
                          // Display images first (only if there are image files)
                          if (!empty($imageFiles)) {
                            echo "<div class='images'>";
                            foreach ($imageFiles as $image_url) {
                              echo "<img src='$image_url' alt='Image' class='max-w-full h-auto mb-2 rounded shadow'><br>";
                            }
                            echo "</div>";
                          }

                          // Display other file types (only if there are non-image files)
                          if (!empty($otherFiles)) {
                            echo "<div class='files mb-6'>";
                            foreach ($otherFiles as $file_url) {
                              $file_name = basename($file_url); // Extract the file name from the URL
                              echo "<div class='file-item mb-2 flex items-center justify-between'>";
                              echo "<a href='$file_url' target='_blank' class='text-blue-500 hover:text-blue-700'>$file_name</a>";

                              // Container for buttons aligned to the right
                              echo "<div class='flex ml-auto'>";

                              // Rename Button
                              echo "<button class='rename-btn text-xs text-gray-500 hover:text-blue-400 mr-2' data-file-url='$file_url' data-file-name='$file_name'>Rename</button>";

                              // Delete Button
                              echo "<button class='delete-btn text-xs text-gray-500 hover:text-red-500' data-file-url='$file_url' data-file-name='$file_name'>Delete</button>";

                              echo "</div>"; // Close the button container
                              echo "</div>"; // Close file item container
                            }
                            echo "</div>"; // Close files div
                          }
                        }
                        ?>
                      </div>


                      <hr class="border-gray-300 dark:border-gray-400" />
                    </article>
                  </div>
                  <!--End of Post-->
                </ul>
              <?php } ?>

              <!--End of list of Post-->
            </section>

            <!--Right sidebar-->
            <?php include 'profile_right_sidebar.php' ?>
            <!--End of right sidebar-->
          </div>
        </main>
      </aside>
    </div>
  </div>
  <!--Darkmode-->
  <script>
    tailwind.config = {
      darkMode: "class",
    };
  </script>
  <script>
    // Check if the user preference is stored in Local Storage
    const storedPreference = localStorage.getItem("darkMode");

    // Set the initial mode based on stored preference or default to system setting
    if (storedPreference === "dark") {
      document.querySelector("html").classList.add("dark");
      document.querySelector("#dark-toggle").checked = true;
    } else if (storedPreference === "light") {
      document.querySelector("html").classList.remove("dark");
      document.querySelector("#dark-toggle").checked = false;
    } else {
      const systemPreference = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
      if (systemPreference === "dark") {
        document.querySelector("html").classList.add("dark");
        document.querySelector("#dark-toggle").checked = true;
      }
    }

    // Toggle dark mode and save preference to Local Storage
    function darkModeListener() {
      const htmlElement = document.querySelector("html");
      htmlElement.classList.toggle("dark");

      const modePreference = htmlElement.classList.contains("dark") ? "dark" : "light";
      localStorage.setItem("darkMode", modePreference);
    }

    document
      .querySelector("input[type='checkbox']#dark-toggle")
      .addEventListener("click", darkModeListener);
  </script>
  <!--End Darkmode-->

  <!--Important-->
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

  <!--File preview-->
  <script>
    function previewFile(formIndex) {
      const fileInput = document.getElementById(`uploadpost${formIndex}`);
      const previewImage = document.getElementById(`preview-image${formIndex}`);
      const imagePreviewDiv = document.getElementById(`image-preview${formIndex}`);

      if (fileInput && previewImage && imagePreviewDiv && fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          previewImage.setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(fileInput.files[0]);
        imagePreviewDiv.style.display = "block";
      }
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const renameButtons = document.querySelectorAll('.rename-btn');
      const deleteButtons = document.querySelectorAll('.delete-btn');  // Target delete buttons

      // Handle rename button click
      renameButtons.forEach(button => {
        button.addEventListener('click', function () {
          const fileUrl = this.getAttribute('data-file-url');
          const fileName = this.getAttribute('data-file-name');

          // Create the rename input field with styles
          const inputField = document.createElement('input');
          inputField.type = 'text';
          inputField.value = fileName;
          inputField.classList.add('bg-transparent', 'font-medium', 'text-lg', 'w-full', 'text-ellipsis',
            'border-0', 'focus:outline-none', 'form-control', 'text-gray-800', 'dark:text-gray-100', 'focus:ring-0',
            'h-12', 'mr-2'); // Input field styling

          // Create a save button
          const saveButton = document.createElement('button');
          saveButton.textContent = 'Save';
          saveButton.classList.add('text-xs', 'text-blue-500', 'hover:text-blue-700', 'focus:outline-none', 'focus:ring-0', 'mr-2');

          // Container for input and button
          const inputContainer = document.createElement('div');
          inputContainer.classList.add('flex', 'items-center');

          // Append input and button to container
          inputContainer.appendChild(inputField);
          inputContainer.appendChild(saveButton);

          // Replace the rename button with input and save button
          this.parentElement.replaceChild(inputContainer, this);

          // Handle save button click
          saveButton.addEventListener('click', function () {
            const newName = inputField.value;
            if (newName && newName !== fileName) {
              const xhr = new XMLHttpRequest();
              xhr.open('POST', 'rename_file.php', true);
              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                  if (xhr.responseText === 'success') {
                    alert('File renamed successfully!');
                    location.reload(); // Reload page to show new name
                  } else {
                    alert('Error renaming file: ' + xhr.responseText);
                  }
                }
              };
              xhr.send('file_url=' + encodeURIComponent(fileUrl) + '&new_name=' + encodeURIComponent(newName));
            }
          });
        });
      });

      // Handle delete button click
      deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
          const fileUrl = this.getAttribute('data-file-url');
          const fileName = this.getAttribute('data-file-name');

          // Confirm delete action
          if (confirm(`Are you sure you want to delete the file: ${fileName}?`)) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_file.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText === 'success') {
                  alert('File deleted successfully!');
                  location.reload(); // Reload page to remove the file from the list
                } else {
                  alert('Error deleting file: ' + xhr.responseText);
                }
              }
            };
            xhr.send('file_url=' + encodeURIComponent(fileUrl));
          }
        });
      });
    });
  </script>



  <!--Disable scroll bar default-->
  <style>
    .overflow-y-auto::-webkit-scrollbar,
    s .overflow-y-scroll::-webkit-scrollbar,
    .overflow-x-auto::-webkit-scrollbar,
    .overflow-x::-webkit-scrollbar,
    .overflow-x-scroll::-webkit-scrollbar,
    .overflow-y::-webkit-scrollbar,
    body::-webkit-scrollbar {
      display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .overflow-y-auto,
    .overflow-y-scroll,
    .overflow-x-auto,
    .overflow-x,
    .overflow-x-scroll,
    .overflow-y,
    body {
      -ms-overflow-style: none;
      /* IE and Edge */
      scrollbar-width: none;
      /* Firefox */
    }

    svg.paint-icon {
      fill: currentcolor;
    }
  </style>
</body>

</html>