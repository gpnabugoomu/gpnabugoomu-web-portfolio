document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            const isOpen = mainNav.getAttribute('data-nav-open') === 'true';
            mainNav.setAttribute('data-nav-open', !isOpen);
            
            // Optionally toggle a class on the body to prevent scrolling
            document.body.setAttribute('data-nav-open', !isOpen);
        });
    }
});