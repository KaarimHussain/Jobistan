var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        // when window width is <= 1024px
        1024: {
            slidesPerView: 3,
        },
        // when window width is <= 992px
        992: {
            slidesPerView: 2,
        },
        // when window width is <= 768px
        768: {
            slidesPerView: 2,
        },
        // when window width is <= 480px
        480: {
            slidesPerView: 1,
            spaceBetween: 5
        },
        1: {
            slidesPerView: 1,
            spaceBetween: 5
        }
    },
});
