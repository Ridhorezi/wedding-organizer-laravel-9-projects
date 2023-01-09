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

import Swal from 'sweetalert2/dist/sweetalert2.js'
import {initProductSlider} from "./slider";

export function initModal(settings, customPopupClass) {
    Swal.fire({
        showClass: {
            popup: 'fadeIn'
        },
        hideClass: {
            popup: 'fadeOut'
        },
        showConfirmButton: false,
        showCloseButton: true,
        closeButtonHtml: `
                <i class="icon-close"></i>
            `,
        customClass: {
            container: 'modal',
            popup: customPopupClass ? `modal_popup ${customPopupClass}` : 'modal_popup',
            closeButton: 'modal_popup-close',
            htmlContainer: 'modal_popup-content',
        },
        ...settings
    })

    function close() {
        if (customPopupClass === 'modal_popup--search') {
            if (window.innerWidth > 767) {
                Swal.close();
            }
        }
    }

    window.addEventListener('resize', close);
}

export function addToCompare() {
    document.addEventListener('click', e => {
        if ((e.target.dataset.trigger !== null && e.target.dataset.trigger === 'compare') || e.target.classList.contains('icon-compare')) {
            initModal({
                html: `
                    <h2 class="title">Product Added to Compare</h2>
                    <div class="content d-sm-flex">
                        <div class="content_media">
                            <picture>
                                <source srcset="img/placeholder.jpg" type="image/webp">
                                <img src="img/placeholder.jpg" alt="media">
                            </picture>
                        </div>
                        <div class="content_main d-flex flex-column align-items-center align-items-sm-start">
                            <h4 class="content_main-title">Pure Sun CBD Oil 1:10</h4>
                            <span class="content_main-price">$16.90</span>
                            <a class="content_main-btn btn--underline" href="#">Remove</a>
                        </div>
                    </div>
                `
            }, 'modal_popup--compare')
        }
    })
}

export function triggerQuickView() {
    const viewTriggers = document.querySelectorAll('[data-trigger="view"]');

    viewTriggers.forEach(el => {
        el.addEventListener('click', () => {
            initModal({
                html: `
                     <div class="about_main d-lg-flex flex-nowrap">
                         <span class="underlay">
                            <span class="underlay_circle underlay_circle--accent"></span>
                            <span class="underlay_circle underlay_circle--green"></span>
                        </span>
                        <div class="about_main-slider">
                            <div class="about_main-slider--single" data-modal="true">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                </div>
                                <div class="swiper-controls d-flex align-items-center justify-content-between">
                                    <a class="swiper-button-prev d-inline-flex align-items-center justify-content-center" href="#">
                                        <i class="icon-caret_left icon"></i>
                                    </a>
                                    <a class="swiper-button-next d-inline-flex align-items-center justify-content-center" href="#">
                                        <i class="icon-caret_right icon"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="about_main-slider--thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="img/placeholder.jpg"
                                                    srcset="img/placeholder.jpg"
                                                    type="image/webp">
                                            <img class="lazy"
                                                 data-src="img/placeholder.jpg"
                                                 src="img/placeholder.jpg"
                                                 alt="media">
                                        </picture>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about_main-info">
                            <div class="about_main-info_product d-sm-flex align-items-center justify-content-between">
                                <h2 class="title">Purple Suver Haze</h2>
                            </div>
                            <div class="about_main-info_rating d-flex flex-column flex-sm-row align-items-sm-center">
                                <ul class="stars d-flex align-items-center accent">
                                    <li class="stars_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="stars_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="stars_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="stars_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="stars_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <a class="reviews-amount" href="#">(2 customer reviews)</a>
                            </div>
                            <p class="about_main-info_description">
                                Elementum eu facilisis sed odio morbi quis commodo odio. Mauris rhoncus aenean vel elit
                                scelerisque mauris pellentesque. Arcu felis bibendum ut tristique et egestas. Id semper risus in
                                hendrerit gravida rutrum. Eu mi bibendum neque egestas congue
                            </p>
                            <div class="about_main-info_block d-flex flex-column flex-sm-row align-items-sm-center">
                                <h5 class="title">Weight</h5>
                                <ul class="weight-list list d-flex flex-wrap">
                                    <li class="list-item">
                                        <input type="radio" id="modalWeight1" name="modalWeight">
                                        <label for="modalWeight1">1g</label>
                                    </li>
                                    <li class="list-item">
                                        <input type="radio" id="modalWeight2" name="modalWeight">
                                        <label for="modalWeight2">3.5g</label>
                                    </li>
                                    <li class="list-item">
                                        <input type="radio" id="modalWeight3" name="modalWeight">
                                        <label for="modalWeight3">5g</label>
                                    </li>
                                    <li class="list-item">
                                        <input type="radio" id="modalWeight4" name="modalWeight">
                                        <label for="modalWeight4">7g</label>
                                    </li>
                                    <li class="list-item">
                                        <input type="radio" id="modalWeight5" name="modalWeight">
                                        <label for="modalWeight5">14g</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="about_main-info_block d-flex flex-column flex-sm-row align-items-sm-center">
                                <h5 class="title">Quantity</h5>
                                <div class="qty d-flex align-items-center justify-content-between">
                                        <span class="qty_minus control disabled d-flex align-items-center">
                                            <i class="icon-minus"></i>
                                        </span>
                                    <input class="qty_amount" type="number" readonly value="1" min="1" max="99">
                                    <span class="qty_plus control d-flex align-items-center">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="about_main-info_action d-flex flex-column flex-sm-row align-items-sm-center">
                                <span class="about_main-info_price">$34.78</span>
                                <a class="btn" href="#">Add to Cart</a>
                                <div class="action d-flex">
                                    <a class="action_link d-flex align-items-center justify-content-center" href="#" data-role="wishlist">
                                        <i class="icon-heart"></i>
                                    </a>
                                    <a class="action_link d-flex align-items-center justify-content-center" href="#" data-trigger="compare">
                                        <i class="icon-compare"></i>
                                    </a>
                                </div>
                            </div>
                            <a class="btn--underline" href="product.html">View Details</a>
                        </div>
                    </div> 
                `
            }, 'modal_popup--view');
            initProductSlider();
        })
    })
}

export function triggerSearchForm() {
    const searchTriggers = document.querySelectorAll('[data-trigger="search"]');

    function check() {

        let callback = function (e) {
            e.preventDefault();
            if (window.innerWidth <= 767) {
                initModal({
                    html:
                        `
                    <form class="form" method="get" action="#">
                        <input class="field required" type="text" placeholder="Search...">
                        <button class="btn" type="submit">Search</button>
                    <form>
                    `,
                }, 'modal_popup--search')
            }
        }

        if (window.innerWidth <= 767) {
            searchTriggers.forEach(el => {
                el.addEventListener('click', callback);
            })
        } else {
            searchTriggers.forEach(el => {
                el.removeEventListener('click', callback);
            })
        }

    }

    window.addEventListener('load', check);
    window.addEventListener('resize', check);
}