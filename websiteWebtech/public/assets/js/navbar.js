document.addEventListener("DOMContentLoaded", function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');

    hamburgerMenu.addEventListener('click', function () {
        this.classList.toggle('clicked');
    });

    // When width is more than 1024px, remove clicked class
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            hamburgerMenu.classList.remove('clicked');
        }
    });
});