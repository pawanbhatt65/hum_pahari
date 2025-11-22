"use strict";

document.addEventListener("DOMContentLoaded", () => {
    // body
    const body = document.body;
    // navbar close button
    const navbarCloseToggler_elm = document.querySelector(".mobile-menu-close");
    // navbar open button
    const navbarTogglerButton_elm = document.getElementById(
        "navbarTogglerButton"
    );
    const navbarSupportedContent_elm = document.getElementById(
        "navbarSupportedContent"
    );
    // home banner search form
    const bannerSearchForm_elm = document.bannerSearchForm;
    // home stays row
    const homeStaysImagesRow_elm =
        document.getElementById("homeStaysImagesRow");

        const productRow_elm = document.getElementById("productImagesRow");

    // when click open navbar toggler button
    navbarTogglerButton_elm.addEventListener("click", function (event) {
        navbarSupportedContent_elm.classList.add("show");
        body.classList.add("overflowHidden");
    });
    // navbar close button clicked
    navbarCloseToggler_elm.addEventListener("click", function (event) {
        navbarSupportedContent_elm.classList.remove("show");
        body.classList.remove("overflowHidden");
    });

    // if home stay row exists
    if (homeStaysImagesRow_elm) {
        const singleImage_boxes_elm = homeStaysImagesRow_elm.querySelectorAll(
            ".single-img-box img"
        );

        singleImage_boxes_elm.forEach((elm) => {
            elm.addEventListener("click", (event) => {
                // console.log("event is: ", event.target.src)
                let src = event.target.getAttribute("src");
                const card_more = event.target.closest(".card-more");
                // console.log("Is single img box is: ", card_more)
                if (!card_more) return;
                const is_single_img = card_more.querySelector(".single-img > img");
                is_single_img.src = src;
            });
        });
    }

    // if product row exists
    if (productRow_elm) {
        const singleImage_boxes_elm = productRow_elm.querySelectorAll(
            ".single-img-box img"
        );

        singleImage_boxes_elm.forEach((elm) => {
            elm.addEventListener("click", (event) => {
                // console.log("event is: ", event.target.src)
                let src = event.target.getAttribute("src");
                const card_more = event.target.closest(".card-more");
                // console.log("Is single img box is: ", card_more)
                if (!card_more) return;
                const is_single_img = card_more.querySelector(".single-img > img");
                is_single_img.src = src;
            });
        });
    }
});
