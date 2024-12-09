<?php
// Create connection 
include 'config.php';

$promtMessage = '';

// Add User 
if (isset($_POST['submit'])) {
  if (
    isset($_POST['ifirstname']) && isset($_POST['ilastname']) &&
    isset($_POST['ibirth_month']) && isset($_POST['ibirth_day']) &&
    isset($_POST['ibirth_year']) && isset($_POST['iUserEmail']) &&
    isset($_POST['iUserPassword'])
  ) {
    $ifirstname = $_POST['ifirstname'];
    $ilastname = $_POST['ilastname'];
    $ibirth_month = $_POST['ibirth_month'];
    $ibirth_day = $_POST['ibirth_day'];
    $ibirth_year = $_POST['ibirth_year'];
    $iUserEmail = $_POST['iUserEmail'];
    $iUserPassword = $_POST['iUserPassword'];

    // Check if the iUserEmail already exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE iUserEmail = '$iUserEmail'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
      $promtMessage = '<div
  id="alert-5"
  class="flex items-center p-4 rounded-lg bg-gray-300 mb-5"
  role="alert"
>
  <span class="material-symbols-rounded"> error </span>
  <div class="ml-3 text-sm font-medium text-gray-800 ">
    Someone already has that username. Try another?
  </div>
  <button
    type="button"
    class="ml-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800  dark:hover:bg-gray-700 dark:hover:text-white"
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
    } else {
      $date_created = date("Y-m-d H:i:s"); // Current date and time
      $sql = "INSERT INTO users(ifirstname, ilastname, ibirth_month, ibirth_day, ibirth_year, iUserEmail, iUserPassword, date_created) 
            VALUES('$ifirstname', '$ilastname', '$ibirth_month', '$ibirth_day', '$ibirth_year', '$iUserEmail', '$iUserPassword', '$date_created')";
      $result = mysqli_query($conn, $sql) or die("query unsuccessful");

      // Set a default profile picture for the new user
      $user_id = mysqli_insert_id($conn); // Get the ID of the newly inserted user
      $defaultProfilePicture = 'Images/user1.jpg';
      $updateProfilePictureQuery = "UPDATE users SET profile_picture = '$defaultProfilePicture' WHERE user_id = $user_id ";
      mysqli_query($conn, $updateProfilePictureQuery);

      $promtMessage = '<div
  id="alert-3"
  class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 mb-5"
  role="alert"
>
  <span class="material-symbols-rounded"> check_circle </span>
  <div class="ml-3 text-sm font-medium">
    Account successfully created
  </div>
  <button
    type="button"
    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
    data-dismiss-target="#alert-3"
    aria-label="Close"
  >
    <span class="sr-only">Close</span>
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
  } else {
    // Handle missing information case
    $promtMessage = '<div
  id="alert-5"
  class="flex items-center p-4 rounded-lg bg-indigo-200 mb-5"
  role="alert"
>
  <span class="material-symbols-rounded"> priority_high </span>
  <div class="ml-3 text-sm font-medium text-indigo-800 ">
    All information is required
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
} else {
  $ifirstname = '';
  $ilastname = '';
  $ibirth_month = '';
  $ibirth_day = '';
  $ibirth_year = '';
  $iUserEmail = '';
  $iUserPassword = '';
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
    <div
      class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
      <div class="max-w-md w-full space-y-8">
        <div class="text-center">
          <h2
            class="mt-6 text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 font-bold text-gray-900">
            Welcome!</h2>
          <p class="mt-2 text-sm text-gray-500">Create new account</p>

        </div>

        <form class="mt-8 space-y-6" action="signup.php" method="post">
          <input class="form-control" type="hidden" name="remember" />
          <div class="mt-8 content-center">
            <?php if (!empty($promtMessage)): ?>
              <?php echo $promtMessage ?>
            <?php endif; ?>
            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">First Name</label>
            <label class="ml-[150px] text-sm font-bold text-gray-700 tracking-wide">Last Name</label>
            <div class="flex">
              <input
                class="form-control flex-col w-3/6 text-base px-4 py-2 mr-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                type="text" placeholder="Fritz Jerome" name="ifirstname" />

              <input
                class="form-control flex-col w-3/6 text-base px-4 py-2 ml-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                type="text" placeholder="Tobes" name="ilastname" />
            </div>
          </div>
          <div class="mt-8 content-center">
            <div class="grid grid-cols-3">
              <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Birthday</label>
            </div>
            <div class="flex">
              <select
                class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                id="grid-state" type="text" name="ibirth_month">
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
                class="form-control w-full text-base px-4 py-2 mx-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                id="grid-state" type="number" name="ibirth_day">
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
                class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                id="grid-state" type="number" name="ibirth_year">
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

          <div class="mt-8 content-center">
            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
            <input
              class="form-control w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
              type="" placeholder="Username@gmail.com" name="iUserEmail" />
          </div>

          <div class="mt-8 content-center">
            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
              Password
            </label>
            <input
              class="form-control w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
              type="password" placeholder="Enter your password" name="iUserPassword" />
          </div>

          <div>

            <button type="submit" name="submit"
              class="w-full flex justify-center bg-indigo-500 hover:bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
              Create account
            </button>

          </div>
          <p class="text-sm text-center">
            By signing up, you agree to the
            <span class="text-blue-500"><a href="#">Terms of Service</a></span>
            and
            <span class="text-blue-500"><a href="#">Privacy Policy</a></span>, including
            <span class="text-blue-500"><a href="#">Cookie Use</a></span>.
          </p>
          <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
            <span>Already have an account?</span>
            <a href="login.php"
              class="text-indigo-400 hover:text-blue-500 no-underline hover:underline cursor-pointer transition ease-in duration-300 mb-10">Sign
              in</a>
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