"use strict";
document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    // Save page URL to localStorage and handle navigation clearing
    const savePageURL = document.querySelectorAll(".save-page-url");

    savePageURL.forEach((elm) => {
        elm.addEventListener("click", function (event) {
            event.preventDefault();
            // Save current page URL to localStorage
            const currentUrl = window.location.href;
            localStorage.setItem("homeStayURL", currentUrl);
            console.log("Saved URL to localStorage:", currentUrl);

            // Redirect to the login page
            window.location.href = elm.getAttribute("href");
        });
    });
});
