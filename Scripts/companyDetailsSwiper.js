document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        // Breakpoints for SlidePerView
        breakpoints: {
            1024: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 2,
            },
            640: {
                slidesPerView: 1,
            },
            320: {
                slidesPerView: 1,
            },
            200: {
                slidesPerView: 1,
            },
            100: {
                slidesPerView: 1,
            },
            50: {
                slidesPerView: 1,
            },
            30: {
                slidesPerView: 1,
            },
        }
    });

})