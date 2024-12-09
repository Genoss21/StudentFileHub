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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <main role="main">
          <div class="flex w-[1010px] mx-2">
            <!--All users post-->
            <?php include 'main_content.php' ?>

            <!--Right sidebar-->
            <?php include 'right_sidebar.php' ?>
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

  <!--File upload preview-->
  <script>
    function previewFilesWithIcons(formIndex) {
      const fileInput = document.getElementById(`uploadpost${formIndex}`);
      const filePreviewDiv = document.getElementById(`file-preview${formIndex}`);

      // Clear previous previews for the corresponding preview container
      filePreviewDiv.innerHTML = '';

      if (fileInput && fileInput.files.length > 0) {
        let isValid = true;
        let errorMessage = '';

        // Loop through selected files to validate type and size
        Array.from(fileInput.files).forEach((file) => {
          // Check if the file type is valid
          const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
          if (!validTypes.includes(file.type)) {
            isValid = false;
            errorMessage = 'Invalid file type. Please upload an image, PDF, or Word/Excel document.';
          }

          // Check if the file size is less than 10MB
          if (file.size > 10 * 1024 * 1024) { // 10MB in bytes
            isValid = false;
            errorMessage = 'File size exceeds 10MB. Please upload a smaller file.';
          }

          if (!isValid) {
            alert(errorMessage);
            return;
          }

          const reader = new FileReader();

          reader.onload = function () {
            // Create a container for each file preview
            const fileContainer = document.createElement('div');
            fileContainer.style.display = 'flex';
            fileContainer.style.alignItems = 'center';
            fileContainer.style.marginRight = '15px';
            fileContainer.style.marginBottom = '10px';

            // Add the file type (e.g., Image, PDF, Word)
            const fileTypeText = document.createElement('span');
            fileTypeText.textContent = getFileType(file.type);
            fileTypeText.style.marginRight = '8px';
            fileTypeText.style.fontWeight = 'bold';

            // Add the file name as a clickable link
            const fileLink = document.createElement('a');
            fileLink.href = reader.result;
            fileLink.target = '_blank';
            fileLink.textContent = file.name;
            fileLink.style.textDecoration = 'none';

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.classList.add('text-red-500', 'ml-4', 'hover:underline');
            removeButton.onclick = function () {
              fileContainer.remove(); // Remove the file container from preview
              // Optionally, remove the file from the input (deselect it)
              const fileList = Array.from(fileInput.files);
              const fileIndex = fileList.indexOf(file);
              if (fileIndex > -1) {
                const newFileList = [...fileList.slice(0, fileIndex), ...fileList.slice(fileIndex + 1)];
                fileInput.files = new FileListItems(newFileList); // Update the input with remaining files
              }
            };

            // Append the file type, link, and remove button to the container
            fileContainer.appendChild(fileTypeText);
            fileContainer.appendChild(fileLink);
            fileContainer.appendChild(removeButton);

            // Append the container to the preview div
            filePreviewDiv.appendChild(fileContainer);
          };

          reader.readAsDataURL(file);
        });
      }
    }

    // Function to get a readable file type
    function getFileType(fileType) {
      if (fileType.includes('image')) return 'Image'; // Label for image files
      if (fileType === 'application/pdf') return 'PDF'; // Label for PDFs
      if (fileType === 'application/msword' || fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') return 'Word'; // Label for Word files
      if (fileType === 'application/vnd.ms-excel' || fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') return 'Excel'; // Label for Excel files
      return 'File'; // Default label for other files
    }

    // Custom FileListItems function to reset file input with updated file list
    function FileListItems(files) {
      const b = new ClipboardEvent('').clipboardData || new DataTransfer();
      files.forEach(f => b.items.add(f));
      return b.files;
    }
  </script>

  <!--For modals just incase -->
  <script>
    const openModalButtons = document.querySelectorAll('[data-modal-toggle]');
    const closeModalButtons = document.querySelectorAll('[data-modal-hide]');
    const modalBackgrounds = document.querySelectorAll('.modal-background');

    // Function to open a specific modal
    function openModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.classList.remove('hidden');
    }

    // Function to close a specific modal
    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.classList.add('hidden');
    }

    // Add click event listeners to open modal buttons
    openModalButtons.forEach(button => {
      button.addEventListener('click', () => {
        const targetModal = button.getAttribute('data-modal-target');
        openModal(targetModal);
      });
    });

    // Add click event listeners to close modal buttons and backgrounds
    closeModalButtons.forEach(button => {
      button.addEventListener('click', () => {
        const targetModal = button.getAttribute('data-modal-hide');
        closeModal(targetModal);
      });
    });

    modalBackgrounds.forEach(background => {
      background.addEventListener('click', () => {
        const targetModal = background.getAttribute('data-modal-hide');
        closeModal(targetModal);
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