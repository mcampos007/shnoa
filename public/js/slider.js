// const slider = document.querySelector("#slider");
// const childsSlider = [...slider.querySelectorAll("figure")];
// const nextButton = document.querySelector("[data-button='next']");
// const prevButton = document.querySelector("[data-button='prev']");

// const lengthImages = childsSlider.length;

// childsSlider.forEach((child, index) => {
//   child.dataset.idSlider = index;
// });

// nextButton.addEventListener("click", function (e) {
//   const currentImage = getcurrentImage();
//   let currentActiveIndex = currentImage.dataset.idSlider;

//   let nextImage = currentImage.nextElementSibling;
//   currentActiveIndex++;

//   if (currentActiveIndex >= lengthImages) {
//     currentActiveIndex = 0;
//   }

//   const newActiveElement = childsSlider[currentActiveIndex];
//   removeActiveElement();
//   addActiveElement(newActiveElement);
// });

// prevButton.addEventListener("click", function (e) {
//   const currentImage = getcurrentImage();
//   let currentActiveIndex = currentImage.dataset.idSlider;

//   let nextImage = currentImage.nextElementSibling;
//   currentActiveIndex--;

//   if (currentActiveIndex < 0) {
//     currentActiveIndex = lengthImages - 1;
//   }

//   const newActiveElement = childsSlider[currentActiveIndex];
//   removeActiveElement();
//   addActiveElement(newActiveElement);
// });

// function getcurrentImage() {
//   const currentImage = slider.querySelector("[data-active]");

//   return currentImage;
// }

// function removeActiveElement() {
//   const currentImage = getcurrentImage();
//   currentImage.removeAttribute("data-active");
// }

// function addActiveElement(element) {
//   element.setAttribute("data-active", "");
// }

const slider = document.querySelector("#slider");
const slides = [...slider.querySelectorAll("figure")];
const nextButton = document.querySelector("[data-button='next']");
const prevButton = document.querySelector("[data-button='prev']");

let currentIndex = 0;
const totalSlides = slides.length;

// Actualiza las clases de las imágenes para mostrar la actual y ocultar las demás
function updateSlides() {
  slides.forEach((slide, index) => {
    if (index === currentIndex) {
      slide.setAttribute("data-active", "true");
      slide.classList.add("block");
      slide.classList.remove("hidden");
    } else {
      slide.removeAttribute("data-active");
      slide.classList.add("hidden");
      slide.classList.remove("block");
    }
  });
}

// Avanza al siguiente slide
function nextSlide() {
  currentIndex = (currentIndex + 1) % totalSlides;
  updateSlides();
}

// Retrocede al slide anterior
function prevSlide() {
  currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
  updateSlides();
}

// Configura el intervalo automático para cambiar slides
let autoSlideInterval = setInterval(nextSlide, 5000); // Cambia cada 5 segundos

// Pausa el slider cuando el usuario lo está viendo (mouseover)
slider.addEventListener("mouseover", () => {
  clearInterval(autoSlideInterval);
});

// Reanuda el slider cuando el usuario deja de interactuar con él (mouseout)
slider.addEventListener("mouseout", () => {
  autoSlideInterval = setInterval(nextSlide, 3000);
});

// Agrega eventos a los botones de navegación
nextButton.addEventListener("click", nextSlide);
prevButton.addEventListener("click", prevSlide);

// Inicializa el slider
updateSlides();
