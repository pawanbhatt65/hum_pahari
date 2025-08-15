"use strict";

document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".star-rating li");
    // console.log("stars: ", stars);

    if (stars) {
        stars.forEach((star, index1) => {
            star.addEventListener("click", event=>{
                event.stopImmediatePropagation();
                console.log(event.target);
                stars.forEach((star, index2)=> {
                    const i = star.querySelector("i");
                    if (index1 >= index2) {
                        i.classList.replace("fa-regular", "fa-solid");
                    } else {
                        i.classList.replace("fa-solid", "fa-regular");
                    }
                })
            })
        })
    }
})
