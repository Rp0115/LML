<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notebook</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
      body {
        font-family: monospace;
      }

      .tab-btn.active {
        background-color: pink;
        color: #ffffff;
      }

      .notepad {
        display: none;
      }

      .notepad.active {
        display: block;
      }
    </style>
  </head>
  <body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8 max-w-4xl">
      <header class="text-center mb-8">
        <h1
          class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white"
        >
          Notes
        </h1>
        <p class="text-md text-gray-500 dark:text-gray-400 mt-2"></p>
      </header>

      <div
        id="units"
        class="flex flex-nowrap justify-center gap-2 sm:gap-4 mb-6"
      >
        <button
          data-target="unit1"
          class="tab-btn active w-full sm:w-auto text-lg font-medium py-3 px-6 rounded-lg transition-all duration-200 ease-in-out bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 shadow-sm"
        >
          Linear Regression
        </button>
        <button
          data-target="unit2"
          class="tab-btn w-full sm:w-auto text-lg font-medium py-3 px-6 rounded-lg transition-all duration-200 ease-in-out bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 shadow-sm"
        >
          Logistic Regression
        </button>

        <button
          data-target="unit3"
          class="tab-btn w-full sm:w-auto text-lg font-medium py-3 px-6 rounded-lg transition-all duration-200 ease-in-out bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 shadow-sm"
        >
          Decision Tree
        </button>

        <button
          data-target="unit4"
          class="tab-btn w-full sm:w-auto text-lg font-medium py-3 px-6 rounded-lg transition-all duration-200 ease-in-out bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 shadow-sm"
        >
          Neural Network
        </button>
      </div>
      <form action="/save-notes" method="POST">
        @csrf <!--safety measures-->

      <div
        id="notepad-container"
        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-2"
      >
        <textarea
          name="unit1Notes"
          id="unit1"
          class="notepad active w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none"
          placeholder="Empty"
        >
        </textarea>

        <textarea
          name="unit2Notes"
          id="unit2"
          class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none"
          placeholder="Empty"
        ></textarea>

        <textarea
          name="unit3Notes"
          id="unit3"
          class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none"
          placeholder="Empty"
        ></textarea>

        <textarea
          name="unit4Notes"
          id="unit4"
          class="notepad w-full h-96 p-4 border-none rounded-lg text-gray-800 dark:text-gray-200 bg-transparent focus:ring-2 focus:ring-indigo-500 resize-none"
          placeholder="Empty"
        ></textarea>
      </div>

      <!-- Submit Button -->
      <div class="mt-6 text-center">
        <button
          type ="submit" class="w-full sm:bg-gray-900 hover:bg-pink-500 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 ease-in-out transform hover:-translate-y-1"
        >
          <b>Submit Notes</b>
        </button>
      </div>
    </div>
    </form>

    <script>
      // Get the container for the tab buttons
      const tabContainer = document.getElementById("units");

      // Get all the tab buttons and notepads
      const tabButtons = tabContainer.querySelectorAll(".tab-btn");
      const notepads = document.querySelectorAll(".notepad");

      // Add a click event listener to the tab container using event delegation
      tabContainer.addEventListener("click", (e) => {
        // Check if a tab button was clicked
        const clickedButton = e.target.closest(".tab-btn");
        if (!clickedButton) return;

        // Get the target notepad ID from the data-target attribute
        const targetId = clickedButton.dataset.target;
        const targetNotepad = document.getElementById(targetId);

        // --- Update Button Styles ---
        // Remove 'active' class from all buttons
        tabButtons.forEach((btn) => {
          btn.classList.remove("active");
        });
        // Add 'active' class to the clicked button
        clickedButton.classList.add("active");

        // --- Update Notepad Visibility ---
        // Hide all notepads
        notepads.forEach((pad) => {
          pad.classList.remove("active");
        });

        if (targetNotepad) {
          targetNotepad.classList.add("active");
        }
      });
    </script>
  </body>
</html>
