<aside class="w-2/5 h-12 position-relative">
    <div class="max-width-[400px]">
        <div class="overflow-y-auto fixed h-screen">
            <!--Search bar-->
            <div class="relative text-gray-900 dark:text-white w-100 p-5 drop-shadow-lg">
                <form method="GET" action="search_files.php">
                    <button type="submit" class="absolute ml-4 mt-3 mr-4">
                        <span class="absolute material-symbols-rounded -mt-1">search</span>
                    </button>
                    <input type="search" name="query" placeholder="Search Files"
                        class="bg-gray-200 dark:bg-gray-700 h-10 px-10 pr-5 w-full rounded-full text-sm font-medium dark:text-gray-100 focus:outline-none bg-purple-white shadow border-0" />
                </form>
            </div>


            <!--Top post-->
            <div class="max-w-md rounded-lg bg-dim-700 overflow-hidden drop-shadow-lg m-4 bg-gray-200 dark:bg-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex-1 m-2">
                        <h2 class="w-full px-4 py-2 text-xl w-52 font-bold tracking-tight">
                            Number of Documents
                        </h2>
                    </div>

                    <div class="flex px-2 py-2 mr-6 text-center">
                        <a href=""
                            class="text-2xl rounded-full text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-sky-400 to-emerald-200">
                            <span class="material-symbols-rounded">
                                home_storage
                            </span>
                        </a>
                    </div>
                </div>

                <!--Document Counter-->
                <?php
                // Check if session variables are set, otherwise set them to empty strings or a default value
                $firstname = isset($_SESSION['ifirstname']) ? $_SESSION['ifirstname'] : '';
                $lastname = isset($_SESSION['ilastname']) ? $_SESSION['ilastname'] : '';

                // Path to user directory
                $userFolderName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname . $lastname));
                $userDir = 'uploads/' . $userFolderName . '/';

                // Initialize file counts
                $docxFileCount = 0;
                $pdfFileCount = 0;
                $xlsxFileCount = 0;
                $pptxFileCount = 0;

                // Check if the user directory exists and get file counts for each type
                if (is_dir($userDir)) {
                    // Get all files with specific extensions
                    $docxFiles = glob($userDir . '*.docx');
                    $pdfFiles = glob($userDir . '*.pdf');

                    // Use case-insensitive matching for .xlsx and .pptx files
                    $xlsxFiles = glob($userDir . '*.xlsx') ?: glob($userDir . '*.XLSX');
                    $pptxFiles = glob($userDir . '*.pptx') ?: glob($userDir . '*.PPTX');

                    // Count each file type
                    $docxFileCount = count($docxFiles);
                    $pdfFileCount = count($pdfFiles);
                    $xlsxFileCount = count($xlsxFiles);
                    $pptxFileCount = count($pptxFiles);
                }

                // If the AJAX request is made, return the updated counts
                if (isset($_GET['action']) && $_GET['action'] == 'getFileCounts') {
                    echo json_encode([
                        'docxCount' => $docxFileCount,
                        'pdfCount' => $pdfFileCount,
                        'xlsxCount' => $xlsxFileCount,
                        'pptxCount' => $pptxFileCount,
                    ]);
                    exit;
                }
                ?>

                <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                    <div class="flex-1 flex items-center justify-center">
                        <h2 class="px-4 ml-2 w-48 font-bold text-left">
                            Downloadable .docx Files
                        </h2>
                    </div>
                    <div class="flex-1 px-4 py-2 m-2">
                        <div
                            class="h-10 w-10 font-bold text-base dark:text-white rounded-full flex items-center justify-center font-mono border-2 border-white float-right bg-blue-500">
                            <span id="docx-count"><?php echo $docxFileCount; ?></span>
                        </div>
                    </div>
                </div>

                <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                    <div class="flex-1 flex items-center justify-center">
                        <h2 class="px-4 ml-2 w-48 font-bold text-left">
                            Downloadable .pdf Files
                        </h2>
                    </div>
                    <div class="flex-1 px-4 py-2 m-2">
                        <div
                            class="h-10 w-10 font-bold text-base dark:text-white rounded-full flex items-center justify-center font-mono border-2 border-white float-right bg-red-500">
                            <span id="pdf-count"><?php echo $pdfFileCount; ?></span>
                        </div>
                    </div>
                </div>

                <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                    <div class="flex-1 flex items-center justify-center">
                        <h2 class="px-4 ml-2 w-48 font-bold text-left">
                            Downloadable .xlsx Files
                        </h2>
                    </div>
                    <div class="flex-1 px-4 py-2 m-2">
                        <div
                            class="h-10 w-10 font-bold text-base dark:text-white rounded-full flex items-center justify-center font-mono border-2 border-white float-right bg-green-500">
                            <span id="xlsx-count"><?php echo $xlsxFileCount; ?></span>
                        </div>
                    </div>
                </div>

                <div class="flex hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-350 ease-in-out">
                    <div class="flex-1 flex items-center justify-center">
                        <h2 class="px-4 ml-2 w-48 font-bold text-left">
                            Downloadable .pptx Files
                        </h2>
                    </div>
                    <div class="flex-1 px-4 py-2 m-2">
                        <div
                            class="h-10 w-10 font-bold text-base dark:text-white rounded-full flex items-center justify-center font-mono border-2 border-white float-right bg-orange-500">
                            <span id="pptx-count"><?php echo $pptxFileCount; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--End  of top post-->

            <!--Ewan-->
            <div class="max-w-md rounded-lg bg-dim-700 overflow-hidden drop-shadow-lg m-4 bg-gray-200 dark:bg-gray-700">
                <div class="flex">
                    <div class="flex-1 m-2">
                        <h2 class="w-full px-4 py-2 text-xl w-48 font-bold">
                            Additional Content
                        </h2>
                    </div>
                </div>

                <!--Suggestion 1-->
                <div class="flex flex-shrink-0">
                    <div class="w-52 h-52"></div>
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
                    <p class="text-sm leading-6 font-medium text-gray-600 tracking-tighter">
                        © 2024 Online Document Management System(ODMS) Inc.
                    </p>
                </div>
            </div>
        </div>
    </div>
</aside>