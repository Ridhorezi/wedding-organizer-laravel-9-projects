/**
 * Herbalist
 * Herbalist – is a website template created for selling the cannabis, medical marijuana and CBD products, cannabis blogging and others
 * Exclusively on https://1.envato.market/herbalist-html
 *
 * @encoding        UTF-8
 * @version         1.0.4
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Lamber Lilit (winter.rituel@gmail.com)
 * @support         help@merkulov.design
 **/
'use strict';

import Swiper, {Navigation, Pagination, Autoplay, EffectFade, Thumbs} from 'swiper';

Swiper.use([Navigation, Pagination, Autoplay, EffectFade, Thumbs]);

// basic swiper initialization
export function initSwiperSlider(container, options) {
    const containerEL = document.querySelector(container);
    if (containerEL) {
        const swiper = new Swiper(container, {
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
            keyboard: {
                enabled: true,
                onlyInViewport: false,
            },
            navigation: true,
            ...options
        });
    }
}

export function initInstagramSwiper(container = '.instagram_slider') {

    initSwiperSlider(container, {
        autoplay: true,
        speed: 1500,
        slidesPerView: 1,
        loop: true,
        breakpoints: {
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
            1200: {
                slidesPerView: 5,
            }
        }
    })
}

export function initProductSlider(main = '.about_main-slider--single', thumbs = '.about_main-slider--thumbs') {
    const mainContainerEL = document.querySelector(main);

    let thumbsSlider;

    const commonOptions = {
        spaceBetween: 15,
        speed: 700,
        slidesPerView: 2,
        freeMode: true,
        loop: true,
        watchSlidesProgress: true,
    }

    const modalBreakpoints = {
        breakpoints: {
            768: {
                spaceBetween: 30,
            },
        }
    };

    const productBreakpoints = {
        breakpoints: {
            768: {
                spaceBetween: 30,
            },
            992: {
                spaceBetween: 15,
            },
            1200: {
                spaceBetween: 40,
            }
        }
    };

    if (mainContainerEL) {
        if (mainContainerEL.dataset.modal === "true") {
            thumbsSlider = new Swiper(thumbs, {
                ...commonOptions,
                ...modalBreakpoints
            });
        } else {
            thumbsSlider = new Swiper(thumbs, {
                ...commonOptions,
                ...productBreakpoints
            });
        }
        const mainSlider = new Swiper(main, {
            spaceBetween: 30,
            slidesPerView: 1,
            speed: 700,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbsSlider,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    }

}

export function switchSliderToGallery(container = '.about_main-slider--destroy') {
    const containerEl = document.querySelector(container);

    let swiperInstance = {};
    let init = false;

    function swiperMode() {
        let mobile = window.matchMedia('(max-width: 767.98px)');
        let tablet = window.matchMedia('(min-width: 768px)');

        if (containerEl) {
            if (mobile.matches) {
                if (!init) {
                    init = true;
                    swiperInstance = new Swiper(container, {
                        slidesPerView: 1,
                        loop: true,
                        spaceBetween: 30,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                }

            } else if (tablet.matches && Object.keys(swiperInstance).length !== 0) {
                swiperInstance.destroy(true, true);
                init = false;
            }
        }

    }

    window.addEventListener('load', swiperMode);
    window.addEventListener('resize', swiperMode);
}
