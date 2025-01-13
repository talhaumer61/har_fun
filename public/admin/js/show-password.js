"use strict"

// For toggling show/hide password
let togglePasswordVisibility = (button) => {
    // Find the input element related to the clicked button
    let input = button.previousElementSibling;
    if (input && input.type === "password") {
        input.type = "text";
        button.querySelector('i').classList.remove("ri-eye-off-line");
        button.querySelector('i').classList.add("ri-eye-line");
    } else if (input && input.type === "text") {
        input.type = "password";
        button.querySelector('i').classList.remove("ri-eye-line");
        button.querySelector('i').classList.add("ri-eye-off-line");
    }
};