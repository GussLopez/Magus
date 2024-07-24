let slideIndex = 0;
showSlides(); // Muestra el primer slide al cargar la página

function moveSlide(n) {
    showSlides(slideIndex += n); // Mueve al siguiente o anterior slide
}

function showSlides(n) {
    let slides = document.querySelectorAll('.slides img');
    if (n >= slides.length) { slideIndex = 0; } // Vuelve al primer slide si se supera el número de slides
    if (n < 0) { slideIndex = slides.length - 1; } // Va al último slide si se baja de cero
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; // Oculta todos los slides
    }
    slides[slideIndex].style.display = "block"; // Muestra el slide actual
}

// Opcional: Añadir un intervalo automático para el slider
setInterval(() => {
    moveSlide(1); // Cambia al siguiente slide cada 5 segundos
}, 5000); // Tiempo en milisegundos (5000 ms = 5 s)
