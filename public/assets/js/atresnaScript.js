// Slider Function
let slideElement = document.getElementById("slider");

let currentSlide = 1;
let totalSlide = slideElement.childElementCount;

function next() {
    if (currentSlide < totalSlide) {
        currentSlide++;
        showSlide();
    } else {
        currentSlide = 1;
        showSlide();
    }
}

function prev() {
    if (currentSlide <= 1) {
        currentSlide = totalSlide;
        showSlide();
    } else {
        currentSlide--;
        showSlide();
    }
}

function showSlide() {
    slides = document.getElementById("slider").getElementsByTagName("li");
    for (let index = 0; index < totalSlide; index++) {
        const element = slides[index];
        if (currentSlide === index + 1) {
            element.classList.remove("hidden");
            element.classList.add("show");
        } else {
            element.classList.add("hidden");
        }
    }
}

// End Slider Function
function changeImage(value, id) {
    var image = (document.getElementById("produkMainImage").src = value);
    var panel = document.getElementById("imagePanel" + id);

    if (image == value) {
        document
            .getElementById("imagePanel" + id)
            .classList.add("border-2", "border-primary-color-mtma");
    }
}
