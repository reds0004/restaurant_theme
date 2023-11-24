jQuery(document).ready(function($) {
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000, // Transition speed: 0.5 seconds
        autoplayTimeout: 6000, // Display duration: 6 seconds
        autoplayHoverPause: true,
        nav: true,
        navText: ['<', '>'],
        dots: true,
        fade: true,
    });
});