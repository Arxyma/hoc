// import './bootstrap';

import "preline";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// DARK MODE TOGGLE BUTTON (DESKTOP)
var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
var themeToggleBtn = document.getElementById("theme-toggle");

// DARK MODE TOGGLE BUTTON (MOBILE)
var themeToggleDarkIconMobile = document.getElementById(
    "theme-toggle-dark-icon-mobile"
);
var themeToggleLightIconMobile = document.getElementById(
    "theme-toggle-light-icon-mobile"
);
var themeToggleBtnMobile = document.getElementById("theme-toggle-mobile");

// Initialize theme based on localStorage or system preference
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
    themeToggleLightIcon.classList.remove("hidden");
    themeToggleLightIconMobile.classList.remove("hidden");
} else {
    document.documentElement.classList.remove("dark");
    themeToggleDarkIcon.classList.remove("hidden");
    themeToggleDarkIconMobile.classList.remove("hidden");
}

// Toggle theme (DESKTOP)
themeToggleBtn.addEventListener("click", function () {
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
    }
});

// Toggle theme (MOBILE)
themeToggleBtnMobile.addEventListener("click", function () {
    themeToggleDarkIconMobile.classList.toggle("hidden");
    themeToggleLightIconMobile.classList.toggle("hidden");

    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
    }
});
