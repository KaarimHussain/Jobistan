document.addEventListener("DOMContentLoaded", function () {
    var swiper1 = new Swiper(".mySwiper1", {
        slidesPerView: 3,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 768px
            768: {
                slidesPerView: 2,
            },
            // when window width is <= 480px
            480: {
                slidesPerView: 1,
            },
        },
    });

    var swiper2 = new Swiper(".mySwiper2", {
        slidesPerView: 3,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 768px
            768: {
                slidesPerView: 2,
            },
            // when window width is <= 480px
            480: {
                slidesPerView: 1,
            },
        },
    });
});
