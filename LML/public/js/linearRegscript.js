document.addEventListener("DOMContentLoaded", () => {
    const sidebarLinks = document.querySelectorAll(".sidebar a");
    const mainContent = document.querySelector(".main-content");
    const pageTitleDisplay = document.getElementById("page-title-display");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // Defines the content for each sidebar link
    const pageContent = {
        intro: {
            title: "Introduction",
            body: `<p class="formatted-paragraph">
                    Linear regression is a statistical method used to model the relationship between a dependent variable and one or more independent variables by fitting a linear equation to the observed data. It aims to find the "best-fit" line (or hyperplane in higher dimensions) that minimizes the difference between the predicted and actual values.
                   </p>`,
        },
        jupyter: {
            title: "JupyterNotebook",
            body: `<p class="formatted-paragraph">Here is the embedded Jupyter Notebook content. You can run code and see visualizations directly in this section.</p>`,
        },
        flash: {
            title: "Flash Cards",
            body: `<p class="formatted-paragraph">Test your knowledge with these interactive flash cards! Click a card to see the answer.</p>`,
        },
        quiz: {
            title: "Final Quiz",
            body: `<p class="formatted-paragraph">Ready to test your understanding? Take the final quiz to see how much you have learned.</p>`,
        },
        notes: {
            title: "My Notes",
            body: `
                <textarea id="notes-area" placeholder="Start typing your notes here..."></textarea>
                <button id="save-notes-btn">Save Notes</button>
            `,
        },
    };

    // Fetches notes from the database via the API
    async function loadNotes() {
        try {
            // NOTE: Use '/notes/linearReg' if you put the route in web.php
            const response = await fetch("/notes/linearReg");
            const data = await response.json();
            const notesArea = document.getElementById("notes-area");
            if (notesArea) {
                notesArea.value = data.content;
            }
        } catch (error) {
            console.error("Error loading notes:", error);
            alert(
                "Could not load notes. Check the browser console for details."
            );
        }
    }

    // Saves notes to the database via the API
    async function saveNotes() {
        const notesArea = document.getElementById("notes-area");
        if (!notesArea) return;

        const content = notesArea.value;
        try {
            // NOTE: Use '/notes' if you put the route in web.php
            const response = await fetch("/notes", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    id: "linearReg",
                    content: content,
                }),
            });

            const result = await response.json();

            if (response.ok) {
                alert("Notes saved successfully!");
            } else {
                alert(
                    "Error saving notes: " + (result.message || "Unknown error")
                );
            }
        } catch (error) {
            console.error("Error saving notes:", error);
            alert(
                "Could not save notes. Check the browser console and server logs."
            );
        }
    }

    // Main function to update the view based on the clicked link
    function updateView(hash) {
        sidebarLinks.forEach((link) => link.classList.remove("active"));
        const activeLink = document.querySelector(
            `.sidebar a[data-content-id="${hash}"]`
        );

        if (activeLink) {
            activeLink.classList.add("active");
            const content = pageContent[hash];

            mainContent.innerHTML = `
                <h1 class="water-effect">${content.title}</h1>
                ${content.body}
            `;
            pageTitleDisplay.textContent = content.title;

            // If the notes tab is active, load the notes and set up the save button
            if (hash === "notes") {
                loadNotes();
                const saveBtn = document.getElementById("save-notes-btn");
                if (saveBtn) {
                    saveBtn.addEventListener("click", saveNotes);
                }
            }
        }
    }

    // Add click event listeners to all sidebar links
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", (event) => {
            event.preventDefault(); // Stop the link from navigating
            const contentId = event.target.dataset.contentId;
            updateView(contentId);
        });
    });

    // Load the 'Intro' section by default when the page loads
    updateView("intro");
});
