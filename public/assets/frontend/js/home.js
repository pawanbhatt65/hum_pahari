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
    // search form element is active
    if (bannerSearchForm_elm) {
        const check_in_elm = bannerSearchForm_elm.querySelector("#check_in");
        const check_out_elm = bannerSearchForm_elm.querySelector("#check_out");

        check_in_elm.addEventListener("change", function (event) {
            let check_in_date = event.target.value;
            if (
                check_out_elm.value !== "" &&
                check_in_date > check_out_elm.value
            ) {
                this.value = "";
                return;
            }
            // console.log("check in date value: ", check_in_date)
        });

        check_out_elm.addEventListener("change", function (event) {
            let check_out_date = event.target.value;
            if (
                check_in_elm.value !== "" &&
                check_out_date < check_in_elm.value
            ) {
                this.value = "";
                return;
            }
            // console.log("check out date value: ", check_out_date)
        });
    }
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
