const carousel = document.getElementById("carousel");
const items = carousel.getElementsByClassName("hs-carousel-slide");

// Function to handle class change
function handleClassChange(mutationsList) {
    mutationsList.forEach((mutation) => {
        if (mutation.attributeName === "class") {
            const activeChild = carousel.querySelector(".active");
            if (activeChild === mutation.target) {
                const modalImage = document.getElementById("modalImage");
                const dataImage = activeChild.getAttribute("data-image");
                modalImage.src = dataImage;
            }
        }
    });
}

// Create observer to detect attribute changes
const observer = new MutationObserver(handleClassChange);

// Observer configuration
const config = {
    attributes: true,
    attributeFilter: ["class"],
};

// Apply observer to each item in the carousel
Array.from(items).forEach((item) => {
    observer.observe(item, config);
});
