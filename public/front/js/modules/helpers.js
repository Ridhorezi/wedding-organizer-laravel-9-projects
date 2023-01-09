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

export function preventDefault() {
    const forms = document.querySelectorAll('form');

    document.addEventListener('click', function(e){
        if((e.target.tagName === 'a' && e.target.getAttribute('href') === '#') ||( e.target.closest('a') !== null && e.target.closest('a').getAttribute('href') === '#')){
            e.preventDefault();
        }
    });

    forms.forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
        })
    })
}

export function inViewport(el) {
    let rect = el.getBoundingClientRect();
    return rect.bottom < 0 || rect.right < 0 || rect.left > window.innerWidth || rect.top > window.innerHeight;
}


export function setPadding(target, side = 'both') {
    const targetEl = document.querySelector(target);
    const containerEL = document.querySelector('.container');

    let offset = parseFloat(window.getComputedStyle(containerEL).marginLeft) + parseFloat(window.getComputedStyle(containerEL).paddingLeft);

    if (targetEl) {
        if (side === 'both') {
            targetEl.style.paddingLeft = `${offset}px`;
            targetEl.style.paddingRight = `${offset}px`;
        } else if (side === 'left') {
            targetEl.style.paddingLeft = `${offset}px`;
        } else if (side === 'right') {
            targetEl.style.paddingRight = `${offset}px`;
        }
    }

}

export function toggleActiveState() {
    document.addEventListener('click', e => {
        if (e.target.dataset.role !== null && e.target.dataset.role === 'wishlist') {
            e.target.classList.toggle('active');
        } else if (e.target.closest('a') !== null && e.target.closest('a').dataset.role !== null && e.target.closest('a').dataset.role === 'wishlist' ) {
            e.target.closest('a').classList.toggle('active');
        }
    })
}

export function changeRating() {
    const ratingStars = [...document.querySelectorAll('[data-type="changeable"] .star')];

    function executeRating(stars) {
        const starClassActive = "icon-star_fill star active";
        const starClassInactive = "icon-star_fill star";
        const starsLength = stars.length;
        let i;
        stars.map((star) => {

            function setActiveStarState() {
                i = stars.indexOf(star);

                if (star.className === starClassInactive) {
                    for (i; i >= 0; --i) stars[i].className = starClassActive;
                } else {
                    for (i; i < starsLength; ++i) stars[i].className = starClassInactive;
                }
            }

            star.addEventListener('click', setActiveStarState);
        });
    }

    executeRating(ratingStars);
}

export function changeQty() {
    const qtyMinusBtns = document.querySelectorAll('.qty_minus');
    const qtyPlusBtns = document.querySelectorAll('.qty_plus');
    const qtyAmountInputs = document.querySelectorAll('.qty_amount');

    if (qtyAmountInputs) {
        qtyAmountInputs.forEach((input, i) => {

            let qtyValue = input.value;

            qtyPlusBtns[i].addEventListener('click', () => {
                qtyMinusBtns[i].classList.remove('disabled');
                if (qtyValue <= 99) {
                    qtyValue++;
                    qtyPlusBtns[i].classList.remove('disabled');
                } else {
                    qtyPlusBtns[i].classList.add('disabled');
                }
                input.value = qtyValue;
            })

            qtyMinusBtns[i].addEventListener('click', () => {

            })

            input.addEventListener('input', () => {
                if (qtyValue === 1) {
                    qtyMinusBtns[i].classList.add('disabled');
                } else if (qtyValue >= 99) {
                    qtyPlusBtns[i].classList.add('disabled');
                }
            })

        })
    }

}

export function generateNumericPagination(parent) {
    const paginationElems = document.querySelectorAll(`${parent} .swiper-pagination-bullet`);

    paginationElems.forEach((el, i) => {
        if (i < 10) {
            el.textContent = `0${i + 1}`;
        } else {
            el.textContent = `${i + 1}`;
        }
    })
}

export function ignoreDuplicates() {
    // get rid of duplicated images caused by swiper

    const galleryLinks = document.querySelectorAll('[data-role="gallery"]');

    if (galleryLinks.length !== 0) {
        galleryLinks.forEach(el => {
            if (el.parentElement.classList.contains('swiper-slide-duplicate') && el.parentElement.classList.contains('swiper-slide-prev') || el.parentElement.classList.contains('swiper-slide-duplicate-active')) {
                el.classList.add('ignored');
            }
        })
    }
}

export function setCurrentYear() {
    const container = document.getElementById('currentYear');

    if (container) {
        container.textContent = String(new Date().getFullYear());
    }
}