document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".mySwiper", {
        // Adding Space Between slides
        slidesPerView: 2,
        spaceBetween: 20,
        // Breakpoints for SlidePerView
        breakpoints: {
            1024: {
                slidesPerView: 2,
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