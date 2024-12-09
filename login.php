<?php

session_start();
include 'config.php';

$promtMessage = '';

if (isset($_POST['signin'])) {

  $iUserEmail = $_POST['iUserEmail'];
  $iUserPassword = $_POST['iUserPassword'];

  $select = mysqli_query($conn, "SELECT * FROM users WHERE iUserEmail ='$iUserEmail' AND iUserPassword ='$iUserPassword'");
  $row = mysqli_fetch_array($select);

  if (is_array($row)) {
    $_SESSION["iUserEmail"] = $row['iUserEmail'];
    $_SESSION["iUserPassword"] = $row['iUserPassword'];
    //Data below a are need to use to other pages
    $_SESSION["user_id"] = $row['user_id'];
    $_SESSION["ifirstname"] = $row['ifirstname'];
    $_SESSION["ilastname"] = $row['ilastname'];
    $_SESSION["ibirth_month"] = $row['ibirth_month'];
    $_SESSION["ibirth_day"] = $row['ibirth_day'];
    $_SESSION["ibirth_year"] = $row['ibirth_year'];
    $_SESSION["date_created"] = $row['date_created'];
    $_SESSION["profile_picture"] = $row['profile_picture'];
    $_SESSION["background_picture"] = $row['background_picture'];
    $_SESSION["default_background_picture"] = $row['default_background_picture'];
    $_SESSION["bio"] = $row['bio'];
    $_SESSION["location"] = $row['location'];
    $_SESSION["website"] = $row['website'];

  } else {
    $promtMessage = '<div
  id="alert-5"
  class="flex items-center p-4 rounded-lg bg-red-200 mb-5"
  role="alert"
>
  <span class="material-symbols-rounded text-red-500"> priority_high </span>
  <div class="mx-3 text-sm font-medium text-red-500">
    Incorect Username or password.
  </div>
  <button
    type="button"
    class="ml-auto -mx-1.5 -my-1.5 bg-indigo-200 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800  dark:hover:bg-gray-700 dark:hover:text-white"
    data-dismiss-target="#alert-5"
    aria-label="Close"
  >
    <span class="sr-only">Dismiss</span>
    <svg
      class="w-3 h-3"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 14 14"
    >
      <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
      />
    </svg>
  </button>
</div>';
  }
}

if (isset($_SESSION["iUserEmail"])) {
  header("location: index.php"); // Redirect user to the home page
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
  <title>ツイッター</title>
</head>

<body>
  <div class="relative h-screen flex">
    <div
      class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
    </div>
    <!--Background Image-->
    <div
      class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto items-center justify-center p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover fixed"
      style="
          background-image: url(https://images.hdqwalls.com/wallpapers/the-tokyo-street-taxi-4k-g9.jpg);
        ">
      <div class="absolute bg-gradient-to-b from-indigo-600 to-blue-500 opacity-75 inset-0 z-0"></div>
      <div class="w-full max-w-md z-10">
        <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">
          ツイッター
        </div>
        <div id="quote-container" class="sm:text-sm xl:text-md text-gray-200 font-normal"></div>
      </div>
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <!--Welcome-->
    <div
      class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
      <div class="max-w-md w-full space-y-8">
        <div class="text-center">
          <h2
            class="mt-6 text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-bold text-gray-900">
            Welcome!</h2>
          <p class="mt-2 text-sm text-gray-500">
            Please sign in to your account
          </p>
        </div>
        <?php if (!empty($promtMessage)): ?>
          <?php echo $promtMessage ?>
        <?php endif; ?>
        <form class="mt-8 space-y-6" action="login.php" method="post">

          <input type="hidden" name="remember" />
          <div class="relative">
            <div class="absolute right-3 mt-4"></div>
            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
            <input name="iUserEmail" required=""
              class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
              type="text" placeholder="Username@gmail.com" />
          </div>
          <div class="mt-8 content-center">
            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
              Password
            </label>
            <input name="iUserPassword" required=""
              class="form-control w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
              type="password" placeholder="Enter your password" />
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember_me" name="remember_me" type="checkbox"
                class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded" />
              <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                Remember me
              </label>
            </div>
            <div class="text-sm">
              <a href="#" class="text-indigo-400 hover:text-blue-500">
                Forgot your password?
              </a>
            </div>
          </div>
          <div>
            <button name="signin" type="submit"
              class="w-full flex justify-center bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
              Sign in
            </button>
          </div>
          <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
            <span>Don't have an account?</span>
            <a href="signup.php"
              class="text-indigo-400 hover:text-blue-500 no-underline hover:underline cursor-pointer transition ease-in duration-300">Sign
              up</a>
          </p>
        </form>
      </div>
    </div>
  </div>
  <script>
    const quotes = [
      "Join our community and unleash your creativity – post, share, and save your inspiring moments!",
      "Discover a space where your ideas are celebrated. Share, comment, and connect with like-minded individuals.",
      "Be part of a thriving community where your voice matters. Post, react, and engage with others!",
      "Share your stories, connect with new friends, and save memories for a lifetime.",
      "Join us to post, share, and connect with a diverse community of passionate individuals.",
      "Experience the joy of sharing your thoughts with others. Join now to post and save your favorite content!",
      "Join a community that values your opinions – post, share, and interact in a safe and welcoming environment.",
      "Start your journey with us today – post your ideas, share experiences, and save memorable moments.",
      "Be part of a community where every post sparks conversation. Join now to comment and connect!",
      "Embrace a platform where your stories find a home. Post, share, and engage with a supportive community.",
    ];

    let currentIndex = 0;
    const quoteContainer = document.getElementById("quote-container");

    function displayQuote() {
      quoteContainer.textContent = quotes[currentIndex];
      currentIndex = (currentIndex + 1) % quotes.length;
    }

    displayQuote();
    setInterval(displayQuote, 7000); // Change quote every 10 seconds
  </script>
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>