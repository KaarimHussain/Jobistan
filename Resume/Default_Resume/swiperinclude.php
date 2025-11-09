<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include ('../../Includes/bootstrapCss.php');
    include ('../../Includes/Icons.php');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>
<style>
    .job-experience {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    .job-experience label {
        font-weight: bold;
    }

    .resume-actions {
        margin-top: 20px;
    }

    .icon {
        display: none;
    }

    .custom-dropdown {
        position: relative;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
        font-size: 18px;
    }

    .selected-option {
        padding: 8px;
        text-align: center;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-top: none;
        width: 100%;
    }

    .option {
        padding: 8px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .option img {
        margin-right: 10px;
        max-width: 50px;
    }

    .swiper-slide img {
        width: 300px;
        height: auto;
        object-fit: cover;
    }

    .option label {
        flex: 1;
    }

    .option:hover {
        background-color: #f9f9f9;
    }

    .swiper {
        width: 80%;
        height: 80%;
    }
</style>

<body>
    <div style="justify-content: center; text-align: center;">
        <button class="primary-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">More Templates</button>
        <!-- <button id="showSwiperButton"
            style="background-color: #4CAF50; border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius: 8px;">More
            Templates</button>
        <button id="hideSwiperButton"
            style="display: none;background-color: #f44336; border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius: 8px;">Hide
            Templates</button> -->
    </div>
    <div class="offcanvas offcanvas-bottom" data-bs-theme="dark" style="height: 70vh;" tabindex="-1"
        id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h1 class="text-center fs-2 py-3">More Templates</h1>
            <div id="swiper-container" style="display:block;">
                <div class="swiper pb-3">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <a href="../Default_Resume/resume1.php" class="swiper-slide"><img
                                src="../images/defoult-template.png" alt=""></a>
                        <a href="../resume02/resume02.php" class="swiper-slide"><img src="../images/template2.png"
                                alt=""></a>
                        <a href="../resume003/resume003.php" class="swiper-slide"><img src="../images/template3.png"
                                alt=""></a>
                        <a href="../resume004/resume2.php" class="swiper-slide"><img src="../images/temlate5.png"
                                alt=""></a>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    // include ('../../Includes/bootstrapJs.php');
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiperContainer = document.getElementById('swiper-container');
            const swiper = new Swiper('.swiper', {
                direction: 'horizontal',
                loop: true,
                slidesPerView: 3,
                spaceBetween: 30,
            });
            // Show Swiper function
            // document.getElementById('showSwiperButton').addEventListener('click', function () {
            //     swiperContainer.style.display = 'block';
            //     document.getElementById('hideSwiperButton').style.display = 'inline-block';
            //     this.style.display = 'none';

            //     // Initialize Swiper if not already initialized
            //     if (!swiperContainer.swiper) {
            //         const swiper = new Swiper('.swiper', {
            //             direction: 'horizontal',
            //             loop: true,
            //             slidesPerView: 3,
            //             spaceBetween: 30,
            //             navigation: {
            //                 nextEl: '.swiper-button-next',
            //                 prevEl: '.swiper-button-prev',
            //             },
            //         });
            //     }
            // });

            // Hide Swiper function
            // document.getElementById('hideSwiperButton').addEventListener('click', function () {
            //     swiperContainer.style.display = 'none';
            //     document.getElementById('showSwiperButton').style.display = 'inline-block';
            //     this.style.display = 'none';

            //     // Optionally destroy Swiper instance to clean up
            //     const swiperInstance = swiperContainer.swiper;
            //     if (swiperInstance) {
            //         swiperInstance.destroy(true, true);
            //     }
            // });
        });
    </script>
</body>

</html>