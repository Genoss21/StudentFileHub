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
      <header class="py-4">
        <!--Left sidebar-->
        <div class="w-[300px] bg-indigo-700">
          <div class="w-[300px] overflow-y-auto fixed h-screen">
            <!--Logo-->
            <a class=" ml-6" href="index.php"><span
                class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-extrabold text-2xl">ツイッター</span></a>
            <!--Nav-->
            <ul class="space-y-2 my-5">
              <li>
                <a href="index.php"
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2"> home </span>Home</a>
              </li>
              <li>
                <a href=""
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2"> explore </span>Explore</a>
              </li>
              <li>
                <a href=""
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2">
                    notifications </span>Notifications</a>
              </li>
              <li>
                <a href=""
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2">
                    chat_bubble </span>Messages</a>
              </li>
              <li>
                <a href=""
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2">
                    bookmark </span>Bookmarks</a>
              </li>
              <li>
                <a href=""
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"><span
                    class="material-symbols-rounded mr-2">
                    list_alt </span>lists</a>
              </li>
              <li>
                <a href="profile.php"
                  class="flex py-2 px-6 rounded-full text-base font-semibold transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-white">
                  <span class="material-symbols-rounded mr-2"> person </span>Profile
                </a>
              </li>
              <li>
                <div class="relative">
                  <button
                    class="w-[300px] py-2 px-6 mr-2 rounded-full text-base text-left transform hover:-translate-y-1 hover:bg-indigo-700 duration-200 hover:text-gray-100"
                    id="morebutton" data-dropdown-toggle="dropdown">
                    <span class="material-symbols-rounded absolute">
                      more_horiz
                    </span>
                    <span class="ml-8">More</span>
                  </button>
                </div>
              </li>
            </ul>
            <div class="w-[300px] rounded-2xl text-base text-left z-10 hidden" id="dropdown">
              <ul class="absolute bottom-full mb-16 bg-white dark:bg-gray-700 rounded-2xl shadow-lg">
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-2 px-4 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 hover:text-gray-100 duration-200">
                  1
                </li>
                <li
                  class="w-[250px] py-[6px] px-2 mx-2 my-1 rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 duration-200">
                  <div class="flex flex-row justify-between toggle">
                    <label for="dark-toggle" class="flex items-center cursor-pointer">
                      <div class="relative">
                        <input type="checkbox" name="dark-mode" id="dark-toggle" class="checkbox hidden" />
                        <div class="block border-[1px] dark:border-white border-gray-300 w-12 h-7 rounded-full"></div>
                        <div
                          class="dot absolute left-1 top-1 dark:bg-white bg-gray-800 w-5 h-5 rounded-full transition">
                        </div>
                      </div>
                      <div class="ml-3 dark:text-gray-100 text-gray-900 font-medium">
                        Dark Mode
                      </div>
                    </label>
                  </div>
                </li>
              </ul>
            </div>

            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button"
              class="w-[300px] py-3 px-6 rounded-full text-base transform hover:-translate-y-1 text-gray-100 dark:text-gray-900 bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 duration-200 font-bold">
              ツイッター
            </button>

            <!--Logout Modal-->
            <div class="w-[300px] rounded-2xl text-base text-left z-10 hidden" id="dropdown_logout">
              <ul class="absolute bottom-full h-14 mb-24 bg-white dark:bg-gray-700 rounded-2xl shadow-lg">
                <li class="my-1">
                  <a href="logout.php"><button
                      class="w-[250px] py-2 px-4 mx-2 my-1 text-left rounded-full transform hover:-translate-y-1 hover:bg-indigo-700 duration-200"><span
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
                class="flex-shrink-0 flex hover:bg-gray-200 dark:hover:bg-gray-900 rounded-full px-6 py-3 mt-12 mr-2">
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
                      }
                    }
                    ?>

                    <div>
                      <img class="inline-block h-10 w-10 rounded-full" src="<?php echo $profilePicture; ?>" alt="#" />
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
      </header>
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
                      <div class="flex flex-col text-right">
                        <?php
                        // Check if the user is logged in
                        if (isset($_SESSION['user_id'])) {
                          $loggedInUserId = $_SESSION['user_id'];
                          $viewUserId = isset($_GET['view_user_id']) ? $_GET['view_user_id'] : $loggedInUserId;

                          // Show the "Edit Profile" button if it's the logged-in user's profile
                          if ($loggedInUserId == $viewUserId) {
                            ?>
                            <button data-modal-target="profileform" data-modal-toggle="profileform" type="button"
                              class="flex justify-center mt-2 mr-4 max-h-max whitespace-nowrap focus:outline-none focus:ring max-w-max border bg-transparent border-blue-500 text-blue-500 hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 hover:border-blue-800 items-center hover:shadow-lg font-bold py-1 px-3 rounded-full mr-0 ml-auto">
                              Edit Profile
                            </button>
                            <?php
                          } else {
                            ?>
                            <!-- Show the Follow button if it's someone else's profile -->
                            <button data-modal-target="" data-modal-toggle="" type="button"
                              class="flex justify-center mt-2 mr-4 max-h-max whitespace-nowrap focus:outline-none focus:ring max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800 hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 items-center hover:shadow-lg font-bold py-1 px-8 rounded-full mr-0 ml-auto">
                              Follow
                            </button>
                            <?php
                          }
                        }
                        ?>
                      </div>
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
                          // Display email for the user being viewed
                          echo $row['iUserEmail'];
                        } else {
                          echo $_SESSION['iUserEmail'];
                        }
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
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-gray-100"
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
                          <!--Image Prev-->
                          <div id="image-preview2" class="text-center mt-4 mr-4" style="display: none">
                            <img id="preview-image2"
                              class="rounded-lg w-full h-72 mb-2 object-cover border-2 border-indigo-500"
                              alt="Image Preview" />
                          </div>
                        </div>
                      </div>
                      <!-- Buttons for creat new post modal -->
                      <div class="flex justify-between border-t dark:border-gray-700">
                        <div class="w-full">
                          <div class="px-2">
                            <div class="flex items-center">
                              <div class="flex flex-row flex-1 text-center p-1 m-2 order-1 space-y-2">
                                <input id="uploadpost2" type="file" class="form-control" name="photo"
                                  onchange="previewFile(2)" />
                                <!-- Button for uplaod image -->
                                <label for="uploadpost2" href="#"
                                  class="w-10 mt-1 ml-2 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-indigo-700 hover:text-blue-300">
                                  <span class="material-symbols-rounded">
                                    photo
                                  </span>
                                </label>
                              </div>

                              <div class="flex text-center p-1 my-2 order-last justify-end">
                                <button
                                  class="text-gray-100 dark:text-gray-900 bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-bold py-2 px-8 mr-2 rounded-full transform hover:-translate-y-1 duration-200"
                                  name="save">
                                  ツイッター
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

              <!-- Edit profile form -->
              <div id="profileform" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:-inset-0 h-[calc(100%-0rem)] max-h-full backdrop-blur-sm bg-white/10">
                <div class="relative w-full max-w-2xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative rounded-lg shadow bg-gray-100 dark:bg-[#28282B]">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-700">
                      <h3
                        class="text-xl font-semibold hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200">
                        Edit profile
                      </h3>
                      <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-gray-100"
                        data-modal-hide="profileform">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>
                    <!-- Edit profile body -->
                    <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                      <!--Edit user card-->
                      <div class="text-gray-900 dark:text-gray-100">
                        <div class="relative">
                          <div class="brightness-50">
                            <!--Background picture-->
                            <?php

                            $loggedInUserId = $_SESSION['user_id']; // Use the user_id from the session
                            
                            $sql = "SELECT background_picture FROM users WHERE user_id = $loggedInUserId";
                            $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                            $row = mysqli_fetch_assoc($result);
                            // Check if the user already have a background picture or set to the default one ""Images/tokyo.jpg""
                            $backgroundPictureUrl = !empty($row['background_picture']) ? $row['background_picture'] : "Images/tokyo.jpg";

                            function displayBackgroundPicture($backgroundPictureUrl)
                            {
                              echo '<div class="w-full bg-cover bg-no-repeat bg-center" style="height: 250px; background-image: url(\'' . $backgroundPictureUrl . '\');"></div>';
                            }

                            displayBackgroundPicture($backgroundPictureUrl);
                            ?>

                          </div>

                          <!-- Container for the buttons -->
                          <div class="absolute inset-0 flex flex-row justify-center items-center gap-2">
                            <!-- Input for changing background picture -->
                            <div class="flex flex-col justify-center items-center">
                              <input id="uploadBackground" type="file" class="form-control" name="background_picture"
                                onchange="previewBackgroundImage()" />
                              <!-- Button for uploading image -->
                              <label for="uploadBackground"
                                class="group flex items-center text-gray-200 p-3 text-base leading-6 font-medium rounded-full bg-opacity-25 bg-gray-700 hover:bg-opacity-50 hover:bg-gray-400">
                                <span class="material-symbols-rounded">
                                  add_a_photo
                                </span>
                              </label>
                            </div>
                            <!-- Button to remove background picture -->
                            <div class="flex flex-col justify-center items-center">
                              <button id="removeBackground"
                                class="group flex items-center text-gray-200 p-3 text-base leading-6 font-medium rounded-full bg-opacity-25 bg-gray-700 hover:bg-opacity-50 hover:bg-gray-400"
                                onclick="removeBackgroundImage()">
                                <span class="material-symbols-rounded">
                                  close
                                </span>
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="p4">
                          <div class="relative flex w-full">
                            <!--Profile picture-->
                            <div class="flex flex-1">
                              <div class="-mt-[70px] ml-4">
                                <div class="h-36 w-36 md rounded-full relative Profile picture">
                                  <!--Input for change profile picture-->
                                  <div class="absolute z-10 bottom-9 text-center p-1 my-2 mx-10 order-1 space-y-2">
                                    <input id="profile_picture" type="file" class="form-control" name="profile_picture"
                                      onchange="previewFile(2)" />
                                    <!-- Button for uplaod image -->
                                    <label for="profile_picture" href="#"
                                      class="w-auto ml-1 group flex items-center text-gray-200 p-3 text-base leading-6 font-medium rounded-full bg-opacity-25 bg-gray-700 hover:bg-opacity-50 hover:bg-gray-400">
                                      <span class="material-symbols-rounded">
                                        add_a_photo
                                      </span>
                                    </label>
                                  </div>
                                  <!--Profile picture-->
                                  <?php
                                  // Set the default profile picture
                                  $defaultProfilePicture = 'Images/user1.jpg';

                                  if (isset($_SESSION['user_id'])) {
                                    $loggedInUserId = $_SESSION['user_id'];

                                    // Retrieve profile picture URL for the logged-in user
                                    $sql = "SELECT profile_picture FROM users WHERE user_id = $loggedInUserId";
                                    $result = mysqli_query($conn, $sql) or die("query unsuccessful");

                                    if ($row = mysqli_fetch_assoc($result)) {
                                      // User has a profile picture, display it
                                      $profilePictureUrl = $row['profile_picture'];
                                    } else {
                                      // User doesn't have a profile picture, use the default
                                      $profilePictureUrl = $defaultProfilePicture;
                                    }
                                  } else {
                                    // Handle the case when the user is not logged in or $_SESSION['user_id'] is not set
                                    // You may want to set a default user ID or take appropriate action here
                                  }

                                  // If $profilePictureUrl is empty, set it to the default
                                  if (empty($profilePictureUrl)) {
                                    $profilePictureUrl = $defaultProfilePicture;
                                  }

                                  // Display the profile picture
                                  echo '<img src="' . $profilePictureUrl . '" alt="" class="brightness-50 h-36 w-36 md rounded-full relative border-4 border-gray-300" />';
                                  ?>
                                  <div class="absolute"></div>
                                </div>

                              </div>
                            </div>
                            <!-- Save changes button -->
                            <div class="flex flex-col text-right">
                              <button data-modal-target="profileform" data-modal-toggle="profileform" type="submit"
                                name="submit"
                                class="flex justify-center mt-2 mr-4 max-h-max whitespace-nowrap focus:outline-none focus:ring max-w-max border bg-transparent border-blue-500 text-blue-500 hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 hover:border-blue-800 items-center hover:shadow-lg font-bold py-1 px-3 rounded-full mr-0 ml-auto">
                                Save changes
                              </button>
                            </div>
                          </div>

                          <!-- Change profile info -->
                          <div class="space-y-1 justify-center w-full mt-5">
                            <!--Change basic Information-->
                            <div class="grid md:grid-cols-2 md:gap-6 mx-5">
                              <!--First name-->
                              <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="ifirstname" id="ifirstname"
                                  class="block py-2.5 px-0 w-full text-xl font-bold bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " value="<?php echo $_SESSION['ifirstname'] ?>" style="color: inherit;"
                                  required />
                                <label for="ifirstname"
                                  class="absolute text-sm font-bold text-gray-400 -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">First
                                  name</label>
                              </div>

                              <!--Last name-->
                              <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="ilastname" id="ilastname"
                                  class="block py-2.5 px-0 w-full text-xl font-bold bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " value="<?php echo $_SESSION['ilastname'] ?>" style="color: inherit;"
                                  required />
                                <label for="ilastname"
                                  class="absolute text-sm font-bold text-gray-400 -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Last
                                  name</label>
                              </div>
                            </div>

                            <!--Bio-->
                            <div class="mx-5">
                              <div class="relative z-0 w-full mb-6 group">
                                <textarea name="bio" id="bio"
                                  class="block py-2.5 px-0 w-full text-xl font-bold bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " style="color: inherit; overflow: hidden;"
                                  required><?php echo $_SESSION['bio'] ?></textarea>
                                <label for="bio"
                                  class="absolute text-sm font-bold text-gray-400 -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Bio
                                </label>
                              </div>

                              <!--Location-->
                              <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="location" id="location"
                                  class="block py-2.5 px-0 w-full text-xl font-bold bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " value="<?php echo $_SESSION['location'] ?>" style="color: inherit;"
                                  required />
                                <label for="location"
                                  class="absolute text-sm font-bold text-gray-400 -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Location
                                </label>
                              </div>

                              <!--Website-->
                              <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="website" id="website"
                                  class="block py-2.5 px-0 w-full text-xl font-bold bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " value="<?php echo $_SESSION['website'] ?>" style="color: inherit;"
                                  required />
                                <label for="website"
                                  class="absolute text-sm font-bold text-gray-400 -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Website
                                </label>
                              </div>

                              <!--Birthday-->
                              <div class="my-10 -ml-2 content-center">
                                <div class="grid grid-cols-3">
                                  <label
                                    class="absolute scale-75 -mt-8 text-sm font-bold text-gray-400 tracking-wide dark:text-gray-300">Birthday</label>
                                </div>
                                <div class="flex">
                                  <select
                                    class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500 dark:bg-[#28282B] dark:border-gray-600"
                                    id="grid-state" type="text" name="ibirth_month" id="ibirth_month"
                                    value="<?php echo $_SESSION['ibirth_month'] ?>">
                                    <option disabled selected>Month</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                  </select>

                                  <select
                                    class="form-control w-full text-base px-4 py-2 mx-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500 dark:bg-[#28282B] dark:border-gray-600"
                                    id="grid-state" type="number" name="ibirth_day" id="ibirth_day"
                                    value="<?php echo $_SESSION['ibirth_day'] ?>">
                                    <option disabled selected>Day</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                  </select>

                                  <select
                                    class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500 dark:bg-[#28282B] dark:border-gray-600"
                                    id="grid-state" type="number" name="ibirth_year" id="ibirth_year"
                                    value="<?php echo $_SESSION['ibirth_year'] ?>">
                                    <option disabled selected>Year</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                    <option>2018</option>
                                    <option>2017</option>
                                    <option>2016</option>
                                    <option>2015</option>
                                    <option>2014</option>
                                    <option>2013</option>
                                    <option>2012</option>
                                    <option>2011</option>
                                    <option>2010</option>
                                    <option>2009</option>
                                    <option>2008</option>
                                    <option>2007</option>
                                    <option>2006</option>
                                    <option>2005</option>
                                    <option>2004</option>
                                    <option>2003</option>
                                    <option>2002</option>
                                    <option>2001</option>
                                    <option>2000</option>
                                    <option>1999</option>
                                  </select>
                                </div>
                              </div>
                              <div class="h-1"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>


              <!-- Edit post form -->
              <div id="editprofileform" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:-inset-0 h-[calc(100%-0rem)] max-h-full backdrop-blur-sm bg-white/10">
                <div class="relative w-full max-w-2xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative rounded-lg shadow bg-gray-100 dark:bg-[#28282B]">
                    <!-- Modal header -->
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
                    <!-- Edit profile body -->
                    <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                      <div class="">
                        <article
                          class="hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-350 ease-in-out rounded-lg">
                          <div class="grid p-4 pb-0">

                            <div class="flex items-center">
                              <!--Profile pciture-->
                              <div>
                                <?php
                                // Set the default profile picture
                                $defaultProfilePicture = 'Images/user1.jpg';

                                // Determine the viewing user ID
                                if (isset($_GET['view_user_id'])) {
                                  $viewingUserId = $_GET['view_user_id'];
                                } else if (isset($_SESSION['user_id'])) {
                                  $viewingUserId = $_SESSION['user_id'];
                                } else {
                                  // Handle the case when the user is not logged in or $_SESSION['user_id'] is not set
                                  // You may want to set a default user ID or take appropriate action here
                                  $viewingUserId = null; // Set to a default or handle as needed
                                }

                                // Retrieve profile picture URL for the viewing user
                                $sql = "SELECT profile_picture FROM users WHERE user_id = $viewingUserId";
                                $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                                // Fetch the profile picture URL
                                $row = mysqli_fetch_assoc($result);
                                $profilePictureUrl = ($row && !empty($row['profile_picture'])) ? $row['profile_picture'] : $defaultProfilePicture;

                                // Display the profile picture
                                echo '<img src="' . $profilePictureUrl . '" alt="" class="inline-block h-10 w-10 rounded-full" />';
                                ?>

                              </div>

                              <div class="ml-3">
                                <p class="w-[500px] text-base leading-6 font-medium text-gray-900 dark:text-gray-100">
                                  <?php
                                  if (isset($_GET['view_user_id'])) {
                                    $viewingUserId = $_GET['view_user_id'];

                                    $sql = "SELECT * FROM users WHERE user_id = $viewingUserId";
                                    $result = mysqli_query($conn, $sql) or die("query unsuccessful");
                                    if (mysqli_num_rows($result) > 0) {
                                      $row = mysqli_fetch_assoc($result);
                                      $emailParts = explode('@', $row['iUserEmail']);
                                      $username = $emailParts[0]; // Get the username before '@gmail.com'
                                  
                                      echo $row['ifirstname'] . ' ' . $row['ilastname'];

                                      echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@';
                                      echo $username; // Display the username
                                      echo '</span>';


                                      echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">';
                                      echo date('F j, Y', ) . ' ' . date('g:i A', );
                                      echo '</span>';
                                    }
                                  } else {
                                    $emailParts = explode('@', $_SESSION['iUserEmail']);
                                    $username = $emailParts[0]; // Get the username before '@gmail.com'
                                  
                                    echo $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];

                                    // Display the username
                                    echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@';
                                    echo $username;
                                    echo '</span>';


                                    echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">';
                                    echo date('F j, Y', ) . ' ' . date('g:i A', );
                                    echo '</span>';
                                  }
                                  ?>
                                </p>
                              </div>
                            </div>
                          </div>

                          <div class="pl-16 overflow-none">
                            <p
                              class="text-base width-auto font-medium text-gray-900 dark:text-gray-100 flex-shrink mx-2 fit-content break-words">
                              <!-- Sample text content, replace with actual content -->
                              Sample Text Content
                            </p>
                            <!-- Display image if available -->
                            <div id="uploaded_image" class="md:flex-shrink pr-6 pt-3">
                              <div>
                                <!-- Sample image source, replace with actual image source -->
                                <img class="bg-cover bg-no-repeat bg-center rounded-lg opacity-100 w-full h-full"
                                  src="sample_image.jpg" alt="" />
                              </div>
                            </div>
                            <!-- Display action buttons -->
                            <div class="flex items-center py-4">
                              <!-- Sample buttons, replace with actual buttons and counts -->
                              <button
                                class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">add_comment</span>
                                12.3 k
                              </button>
                              <button
                                class="flex-1 flex items-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">reply</span>
                                14 k
                              </button>
                              <button
                                class="flex-1 flex items-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                                <span class="material-symbols-rounded">favorite</span>
                                14 k
                              </button>
                              <button
                                class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                                <span class="absolute material-symbols-rounded">upload</span>
                              </button>
                            </div>
                          </div>


                        </article>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
              <!--End of edit post-->
              <ul class="list-none">

                <!--List of post-->
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
                  // Display's the post here and fetch all the data you want to display
                  // $postID = $fetch['post_id'];
                  // $userID = $fetch['user_id'];
                  ?>

                  <!--Post-->
                  <div>
                    <article class="hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class="grid p-4 pb-0">

                        <div class="flex items-center">

                          <!--Profile pciture-->
                          <div>
                            <?php
                            // Set the default profile picture
                            $defaultProfilePicture = 'Images/user1.jpg';

                            // Determine the viewing user ID
                            if (isset($_GET['view_user_id'])) {
                              $viewingUserId = $_GET['view_user_id'];
                            } else if (isset($_SESSION['user_id'])) {
                              $viewingUserId = $_SESSION['user_id'];
                            } else {
                              // Handle the case when the user is not logged in or $_SESSION['user_id'] is not set
                              // You may want to set a default user ID or take appropriate action here
                              $viewingUserId = null; // Set to a default or handle as needed
                            }

                            // Retrieve profile picture URL for the viewing user
                            $sql = "SELECT profile_picture FROM users WHERE user_id = $viewingUserId";
                            $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

                            // Fetch the profile picture URL
                            $row = mysqli_fetch_assoc($result);
                            $profilePictureUrl = ($row && !empty($row['profile_picture'])) ? $row['profile_picture'] : $defaultProfilePicture;

                            // Display the profile picture
                            echo '<img src="' . $profilePictureUrl . '" alt="" class="inline-block h-10 w-10 rounded-full" />';
                            ?>

                          </div>

                          <div class="ml-3">
                            <p class="w-[500px] text-base leading-6 font-medium text-gray-900 dark:text-gray-100">
                              <?php
                              if (isset($_GET['view_user_id'])) {
                                $viewingUserId = $_GET['view_user_id'];

                                $sql = "SELECT * FROM users WHERE user_id = $viewingUserId";
                                $result = mysqli_query($conn, $sql) or die("query unsuccessful");
                                if (mysqli_num_rows($result) > 0) {
                                  $row = mysqli_fetch_assoc($result);
                                  $emailParts = explode('@', $row['iUserEmail']);
                                  $username = $emailParts[0]; // Get the username before '@gmail.com'
                            
                                  echo $row['ifirstname'] . ' ' . $row['ilastname'];

                                  echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@';
                                  echo $username; // Display the username
                                  echo '</span>';

                                  $postCreated = strtotime($fetch['post_created']); // Convert to timestamp
                                  $timePosted = strtotime($fetch['time_posted']); // Convert to timestamp
                                  echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">';
                                  echo date('F j, Y', $postCreated) . ' ' . date('g:i A', $timePosted);
                                  echo '</span>';
                                }
                              } else {
                                $emailParts = explode('@', $_SESSION['iUserEmail']);
                                $username = $emailParts[0]; // Get the username before '@gmail.com'
                            
                                echo $_SESSION['ifirstname'] . ' ' . $_SESSION['ilastname'];

                                // Display the username
                                echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">@';
                                echo $username;
                                echo '</span>';

                                $postCreated = strtotime($fetch['post_created']); // Convert to timestamp
                                $timePosted = strtotime($fetch['time_posted']); // Convert to timestamp
                                echo ' <span class="text-sm leading-5 font-medium text-gray-400 hover:text-gray-300 transition ease-in-out duration-150">';
                                echo date('F j, Y', $postCreated) . ' ' . date('g:i A', $timePosted);
                                echo '</span>';
                              }
                              ?>
                            </p>
                          </div>
                          <!--Edit post button-->
                          <div class="flex ml-auto justify-end">
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['user_id'])) {
                              $loggedInUserId = $_SESSION['user_id'];
                              $viewUserId = isset($_GET['view_user_id']) ? $_GET['view_user_id'] : $loggedInUserId;

                              // Show the "Edit Profile" button if it's the logged-in user's profile
                              if ($loggedInUserId == $viewUserId) {
                                ?>
                                <button type="button" data-modal-target="editprofileform" data-modal-toggle="editprofileform">
                                  <span class="material-symbols-rounded">
                                    more_vert
                                  </span>
                                </button>
                              <?php } else { ?>
                                <button type="button" data-modal-target="reportpost" data-modal-toggle="reportpost">
                                  <span class="material-symbols-rounded">
                                    more_vert
                                  </span>
                                </button>
                              <?php }
                            } ?>
                          </div>
                        </div>

                      </div>

                      <div class="pl-16 overflow-none">
                        <p
                          class="text-base width-auto font-medium text-gray-900 dark:text-gray-100 flex-shrink mx-2 fit-content break-words">
                          <?php echo $fetch['text_post'] ?>
                        </p>
                        <?php
                        if ($fetch['image_post']) {
                          ?>
                          <div id="uploaded_image" class="md:flex-shrink pr-6 pt-3">
                            <div>
                              <img class="bg-cover bg-no-repeat bg-center rounded-lg opacity-100 w-full h-full"
                                src="<?php echo $fetch['image_post'] ?>" alt="" />
                            </div>
                          </div>
                          <!-- Display user-specific buttons for their own posts -->
                        <?php } ?>
                        <div class="flex items-center py-4">
                          <?php if ($isCurrentUserPost) { ?>

                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                add_comment
                              </span>
                              12.3 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                reply
                              </span>
                              14 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                favorite
                              </span>
                              14 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                              <span class="absolute material-symbols-rounded">
                                upload
                              </span>
                            </button>
                          <?php } else { ?>
                            <!-- Display buttons for other users' posts -->
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                add_comment
                              </span>
                              12.3 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-green-400 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                reply
                              </span>
                              14 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-red-600 transition duration-350 ease-in-out">
                              <span class="material-symbols-rounded">
                                favorite
                              </span>
                              14 k
                            </button>
                            <button
                              class="flex-1 flex items-center text-xs text-gray-400 hover:text-blue-400 transition duration-350 ease-in-out">
                              <span class="absolute material-symbols-rounded">
                                upload
                              </span>
                            </button>
                          <?php } ?>
                        </div>
                      </div>
                      <hr class="border-gray-300 dark:border-gray-400" />
                    </article>
                  </div>
                  <!--End of Post-->
                </ul>
                <?php
                }
                ?>
              <!--End of list of Post-->
            </section>

            <!--Right sidebar-->
            <aside class="w-2/5 h-12 position-relative">
              <div class="max-width-[400px]">
                <div class="overflow-y-auto fixed h-screen">
                  <div class="relative text-gray-900 dark:text-gray-100 w-100 p-5">
                    <button type="submit" class="absolute ml-4 mt-3 mr-4">
                      <span class="absolute material-symbols-rounded -mt-1">search
                      </span>
                    </button>
                    <input type="search" name="search" placeholder="Search Twitter"
                      class="bg-gray-200 dark:bg-gray-700 h-10 px-10 pr-5 w-full rounded-full text-sm font-medium dark:text-gray-100 focus:outline-none bg-purple-white shadow border-0" />
                  </div>
                  <!--Top post-->
                  <div
                    class="max-w-md rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4 bg-gray-200 dark:bg-gray-700">
                    <div class="flex">
                      <div class="flex-1 m-2">
                        <h2 class="px-4 py-2 text-xl w-52 font-bold">
                          Philippines trends
                        </h2>
                      </div>

                      <div class="flex-1 px-4 py-2 m-2">
                        <a href=""
                          class="text-2xl rounded-full text-gray-900 dark:text-gray-50 hover:text-indigo-800 float-right"><span
                            class="material-symbols-rounded">
                            settings
                          </span></a>
                      </div>
                    </div>

                    <!--First top post-->
                    <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class="flex-1">
                        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">
                          1. Trending
                        </p>
                        <h2 class="px-4 ml-2 w-48 font-bold">
                          #Mahalkonapalasya
                        </h2>
                        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">
                          5,466 Tweets
                        </p>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href=""
                          class="text-2xl rounded-full text-gray-400 hover:bg-indigo-800 hover:text-blue-300 float-right">
                          <span class="m-2 h-[20px] w-[22px] material-symbols-rounded text-center">
                            expand_more
                          </span>
                        </a>
                      </div>
                    </div>

                    <!--Second top post-->
                    <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class=" flex-1">
                        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">
                          1. Trending
                        </p>
                        <h2 class="px-4 ml-2 w-48 font-bold">
                          #Mahalkonapalasya
                        </h2>
                        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">
                          5,466 Tweets
                        </p>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href=""
                          class="text-2xl rounded-full text-gray-400 hover:bg-indigo-800 hover:text-blue-300 float-right">
                          <span class="m-2 h-[20px] w-[22px] material-symbols-rounded text-center">
                            expand_more
                          </span>
                        </a>
                      </div>
                    </div>

                    <!--Third top post-->
                    <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class=" flex-1">
                        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">
                          1. Trending
                        </p>
                        <h2 class="px-4 ml-2 w-48 font-bold">
                          #Mahalkonapalasya
                        </h2>
                        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">
                          5,466 Tweets
                        </p>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href=""
                          class="text-2xl rounded-full text-gray-400 hover:bg-indigo-800 hover:text-blue-300 float-right">
                          <span class="m-2 h-[20px] w-[22px] material-symbols-rounded text-center">
                            expand_more
                          </span>
                        </a>
                      </div>
                    </div>

                    <!--Fourth top post-->
                    <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class=" flex-1">
                        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">
                          1. Trending
                        </p>
                        <h2 class="px-4 ml-2 w-48 font-bold">
                          #Mahalkonapalasya
                        </h2>
                        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">
                          5,466 Tweets
                        </p>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href=""
                          class="text-2xl rounded-full text-gray-400 hover:bg-indigo-800 hover:text-blue-300 float-right">
                          <span class="m-2 h-[20px] w-[22px] material-symbols-rounded text-center">
                            expand_more
                          </span>
                        </a>
                      </div>
                    </div>

                    <!--Show more-->
                    <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class=" flex-1 ml-4 p-4">
                        <a href=""
                          class="font-bold text-indigo-500 hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200">Show
                          more</a>
                      </div>
                    </div>
                  </div>
                  <!--End  of top post-->

                  <!--User sugggestion to follow-->
                  <div
                    class="max-w-md rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4 bg-gray-200 dark:bg-gray-700">
                    <div class="flex">
                      <div class="flex-1 m-2">
                        <h2 class="px-4 py-2 text-xl w-48 font-bold">
                          Who to follow
                        </h2>
                      </div>
                    </div>

                    <!--Suggestion 1-->
                    <div
                      class="flex flex-shrink-0 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class=" flex-1">
                        <div class="flex items-center w-48">
                          <div class="">
                            <a href="#" class="">
                              <img class="inline-block object-contain h-10 w-10 ml-4 mt-2 rounded-full"
                                src="Images\3.jpg" alt="" />

                          </div>
                          <div class="ml-3 mt-3">

                            <p class="text-base leading-6 font-medium">
                              <a href="" class="">Mommy</a>
                            </p>
                            <p
                              class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                              @annabel.lucinda
                            </p>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href="" class="float-right">
                          <button
                            class="bg-transparent hover:bg-indigo-800 font-semibold hover:text-gray-100 py-3 px-4 rounded-full">
                            Follow
                          </button>
                        </a>
                      </div>
                    </div>

                    <!--Suggestion 2-->
                    <div
                      class="flex flex-shrink-0 flex-shrink-0 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class="flex-1">
                        <div class="flex items-center w-48">
                          <div class="">
                            <a href="#">
                              <img class="inline-block object-contain h-10 w-10 ml-4 mt-2 rounded-full"
                                src="Images\3.jpg" alt="" />

                          </div>
                          <div class="ml-3 mt-3">

                            <p class="text-base leading-6 font-medium">
                              Mommy
                            </p>
                            <p
                              class="text-sm leading-5 font-medium text-gray-400 hover:text-indigo-800 transition ease-in-out duration-150">
                              @annabel.lucinda
                            </p>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="flex-1 px-4 py-2 m-2">
                        <a href="" class="float-right">
                          <button
                            class="bg-transparent hover:bg-indigo-800 font-semibold hover:text-gray-100 py-3 px-4 rounded-full">
                            Follow
                          </button>
                        </a>
                      </div>
                    </div>

                    <!--Show more-->
                    <div
                      class="flex flex-shrink-0 hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                      <div class="flex-1 ml-4 p-4">
                        <a href=""
                          class="font-bold text-indigo-500 hover:text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200">Show
                          more</a>
                      </div>
                    </div>
                  </div>
                  <!--End suggestion-->

                  <!--Footer-->
                  <div class="flow-root m-6">
                    <div class="flex-1">
                      <a href="#">
                        <p class="text-sm leading-6 font-medium text-gray-500">
                          Terms Privacy Policy Cookies Imprint Ads info
                        </p>
                      </a>
                    </div>
                    <div class="flex-2">
                      <p class="text-sm leading-6 font-medium text-gray-600">
                        © 2020 ツイッター, Inc.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
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

  <!--Image preview-->
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