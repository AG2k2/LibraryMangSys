import './bootstrap';

import Alpine from 'alpinejs'

Alpine.start()

// If you want Alpine's instance to be available everywhere.
window.Alpine = Alpine

const userType = document.getElementById("borrower-type");
const guestInfo = document.getElementById("guest-info");
const flashMessage = document.getElementById("flash-message");
const dropdownTrigger = document.getElementById("dropdown-trigger");
const dropdownItems = document.getElementById("dropdown-items");

userType?.addEventListener("change", () => {
    if(userType.value === "guest") {
        guestInfo.classList.remove("hidden");
    } else if (userType.value === "enrolled") {
        guestInfo.classList.add("hidden");
    }
});

setTimeout(() => {
    flashMessage?.classList.add("hidden");
}, 5000);

dropdownTrigger?.addEventListener("click", () => {
    let hidden = dropdownItems?.classList.contains("hidden");
    if(hidden){
        dropdownItems?.classList.remove("hidden");
    } else {
        dropdownItems?.classList.add("hidden");
    }
});
