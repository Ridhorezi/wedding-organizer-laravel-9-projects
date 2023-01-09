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

import {initSwiperSlider} from "./modules/slider";
import {setPadding, generateNumericPagination} from "./modules/helpers";
import drawAccordion from "./modules/accordion";

document.addEventListener('DOMContentLoaded', () => {

    window.addEventListener('resize', setPromoPadding);
    setPromoPadding();

    initSwiperSlider('.hero_slider', {
        slidesPerView: 1,
        loop: true,
        autoplay: true,
        speed: 800,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: '.hero-pagination',
            clickable: true
        },
    })

    generateNumericPagination('.hero-pagination');

    initSwiperSlider('.reviews_slider', {
        slidesPerView: 1,
        loop: true,
        autoplay: true,
        grabCursor: true,
        speed: 1500,
        spaceBetween: 30,
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 3,
            },
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    })

    initSwiperSlider('.partners_list', {
            slidesPerView: 1,
            loop: true,
            autoplay: true,
            speed: 1000,
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
                    autoplay: false
                },
            }
        })

    initSwiperSlider('.popular_slider', {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 30,
        autoplay: true,
        speed: 1000,
        breakpoints: {
            576: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1200: {
                slidesPerView: 4,
            },
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    })

    drawAccordion();
})


function setPromoPadding() {
    if (window.innerWidth >= 1400) {
        setPadding('.promo_fluid', 'left');
    } else {
        setPadding('.promo_fluid', 'both');
    }
}