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

import {initSwiperSlider, initProductSlider, switchSliderToGallery} from "./modules/slider";
import drawAccordion from "./modules/accordion";
import {changeRating, ignoreDuplicates} from "./modules/helpers";
import initGallery from "./modules/gallery";
import hcSticky from 'hc-sticky';

document.addEventListener('DOMContentLoaded', () => {
    initSwiperSlider('.sale_swiper', {
        slidesPerView: 1,
        loop: true,
        autoplay: true,
        speed: 1500,
        spaceBetween: 30,
        breakpoints: {
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 40,
            }
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    })
    initSwiperSlider('.related_slider', {
        slidesPerView: 1,
        spaceBetween: 15,
        autoplay: true,
        speed: 1500,
        loop: true,
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 40,
            }
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    })
    initProductSlider();
    switchSliderToGallery();
    ignoreDuplicates();
    drawAccordion();
    changeRating();
    initGallery('.about_main-slider', {ignoreClass: 'ignored'});
    initMultipleGalleryInstances();
    const Sticky = new hcSticky('.about_wrapper[data-sticky="true"]', {
        stickTo: '.about_main',
        followScroll: false
    });
})


function initMultipleGalleryInstances(selector = '.review_media') {
    const targetElems = document.querySelectorAll(selector);

    if (targetElems.length !== 0) {
        targetElems.forEach(el => {
            initGallery(selector);
        })
    }
}
