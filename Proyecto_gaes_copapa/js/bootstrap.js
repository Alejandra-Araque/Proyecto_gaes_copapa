// BOOTSTRAP.JS PARA COPAPA

// Función para activar el modo de navegación móvil
document.addEventListener("DOMContentLoaded", function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('is-active');
        });
    }
});

// Función para el scroll suave en enlaces
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Función para el botón "Back to Top"
document.addEventListener("scroll", function() {
    const backToTopButton = document.querySelector('.back-to-top');
    if (window.scrollY > 300) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
});

if (document.querySelector('.back-to-top')) {
    document.querySelector('.back-to-top').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Función para la activación de animaciones al hacer scroll
document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('.fade-in');

    function checkPosition() {
        elements.forEach(element => {
            const position = element.getBoundingClientRect().top;

            if (position - window.innerHeight <= 0) {
                element.classList.add('in-view');
            }
        });
    }

    window.addEventListener('scroll', checkPosition);
    checkPosition(); // Ejecutar la función al cargar la página
});

// Función para manejar formularios y mostrar mensajes de éxito/error
document.addEventListener('submit', function(e) {
    const form = e.target;
    if (form.classList.contains('form-ajax')) {
        e.preventDefault();

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.reset();
                alert("Formulario enviado con éxito");
            } else {
                alert("Hubo un error en el envío");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Hubo un problema con el envío");
        });
    }
});

// Función para manejar el modo oscuro
const toggleDarkMode = document.querySelector('.toggle-dark-mode');

if (toggleDarkMode) {
    toggleDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

// Función para la carga diferida de imágenes (Lazy Loading)
document.addEventListener("DOMContentLoaded", function() {
    const lazyImages = document.querySelectorAll('img.lazy');

    const lazyLoad = function() {
        lazyImages.forEach(img => {
            if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !== "none") {
                img.src = img.dataset.src;
                img.classList.remove('lazy');
            }
        });

        if (lazyImages.length == 0) {
            document.removeEventListener("scroll", lazyLoad);
        }
    };

    document.addEventListener("scroll", lazyLoad);
    lazyLoad(); // Cargar imágenes visibles al inicio
});

// Función para activar tooltips
document.addEventListener("DOMContentLoaded", function() {
    const tooltips = document.querySelectorAll('[data-tooltip]');

    tooltips.forEach(tooltip => {
        tooltip.addEventListener('mouseenter', function() {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltipElement = document.createElement('span');
            tooltipElement.classList.add('tooltip');
            tooltipElement.textContent = tooltipText;
            document.body.appendChild(tooltipElement);

            const rect = this.getBoundingClientRect();
            tooltipElement.style.left = `${rect.left + rect.width / 2 - tooltipElement.offsetWidth / 2}px`;
            tooltipElement.style.top = `${rect.top - tooltipElement.offsetHeight - 10}px`;

            this.addEventListener('mouseleave', () => {
                tooltipElement.remove();
            });
        });
    });
});
