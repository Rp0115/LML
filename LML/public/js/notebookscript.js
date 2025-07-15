const tabContainer = document.getElementById("units");
const tabButtons = tabContainer.querySelectorAll(".tab-btn");
const notepads = document.querySelectorAll(".notepad");

const activeClasses = ["bg-blue-600", "text-white", "shadow-md"];
const inactiveClasses = [
    "bg-white",
    "dark:bg-gray-700",
    "text-gray-700",
    "dark:text-gray-300",
    "hover:bg-gray-200",
    "dark:hover:bg-gray-600",
];

function switchTab(clickedButton) {
    if (!clickedButton) return;

    const targetId = clickedButton.dataset.target;
    const targetNotepad = document.getElementById(targetId);

    tabButtons.forEach((btn) => {
        btn.classList.remove(...activeClasses);
        btn.classList.add(...inactiveClasses);
    });
    clickedButton.classList.remove(...inactiveClasses);
    clickedButton.classList.add(...activeClasses);

    notepads.forEach((pad) => pad.classList.remove("active"));
    if (targetNotepad) {
        targetNotepad.classList.add("active");
    }
}

tabContainer.addEventListener("click", (e) => {
    const clickedButton = e.target.closest(".tab-btn");
    switchTab(clickedButton);
});

const firstButton = tabContainer.querySelector(".tab-btn");
switchTab(firstButton);
document.getElementById("unit1").classList.add("active");
