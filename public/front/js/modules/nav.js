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

import Headroom from "headroom.js";

function drawNav() {
    const header = document.querySelector('.header');
    const menu = document.querySelector('.header_nav');
    const menuTrigger = document.querySelector('.header_trigger');


    menuTrigger.addEventListener('click', () => {
        menuTrigger.classList.toggle('active');
        menu.classList.toggle('active');
        header.classList.add('sticky', 'opened');
        document.documentElement.classList.toggle('fixed');
    })

    function closeMenu() {
        menuTrigger.classList.remove('active');
        menu.classList.remove('active');
        header.classList.remove('opened');
        document.documentElement.classList.remove('fixed');
    }


    initHeadroom(header);
    setActivePageClass(header);
    setDropdownMenu();

    window.addEventListener('scroll', () => makeNavSticky(header, menuTrigger));
    window.addEventListener('resize', closeMenu);
    window.addEventListener('resize', setDropdownMenu);
}

// hide header on scroll
function initHeadroom(headerEl) {
    const headroom = new Headroom(headerEl, {
        offset: 500,
        classes: {
            pinned: "header--pinned",
            unpinned: "header--unpinned",
        }
    });
    headroom.init();
}

// set activity class for the current page
function setActivePageClass(headerEl) {
    const menuListItems = document.querySelectorAll('.nav-item');

    menuListItems.forEach(item => {
        if (item.dataset.page === headerEl.dataset.page) {
            item.classList.add('active');
        }
    })

}

// change header on scroll

// dropdown menus (mobile/desktop)
function setDropdownMenu() {
    const dropdownElems = document.querySelectorAll('.dropdown');
    const triggers = document.querySelectorAll('.dropdown-toggle');
    const menuLists = document.querySelectorAll('.dropdown-menu');

    triggers.forEach((el, i) => {

        function closeMenu() {
            el.classList.remove('active');
            menuLists[i].classList.remove('active');
        }

        if (window.innerWidth < 1200) {
            el.style.pointerEvents = 'unset';
            el.dataset.bsToggle = 'collapse';
            menuLists[i].classList.add('collapse');
            el.addEventListener('click', () => {
                el.classList.toggle('active');
                menuLists[i].classList.toggle('active');
            })
            window.addEventListener('resize', closeMenu)
        } else {
            el.dataset.bsToggle = 'dropdown';
            el.style.pointerEvents = 'none';
            menuLists[i].classList.remove('collapse');
            window.addEventListener('resize', closeMenu);
            window.addEventListener('scroll', closeMenu)
        }

    })


    dropdownElems.forEach(el => {

        el.addEventListener('mouseover', function (e) {
            let trigger = this.querySelector('a[data-bs-toggle]');
            let menu = trigger.nextElementSibling;
            trigger.classList.add('active');
            menu.classList.add('active');
        });

        el.addEventListener('mouseleave', function (e) {
            let trigger = this.querySelector('a[data-bs-toggle]');
            let menu = trigger.nextElementSibling;
            trigger.classList.remove('active');
            menu.classList.remove('active');
        })
    })

}

function makeNavSticky(headerEl, triggerEL) {
    const nextEl = headerEl.nextElementSibling;

    if (window.pageYOffset > 0 || triggerEL.classList.contains('active')) {
        headerEl.classList.add('sticky');

        if (headerEl.dataset.overlay !== 'true' && headerEl.classList.contains('sticky')) {
            if (window.innerWidth < 1200) {
                nextEl.style.paddingTop = '60px';
            } else {
                nextEl.style.paddingTop = '140px';
                if (headerEl.classList.contains('sticky')) {
                    nextEl.style.paddingTop = '90px';
                }
            }
        }

    } else if (!triggerEL.classList.contains('active')) {
        headerEl.classList.remove('sticky');
        nextEl.style.paddingTop = '0px';
    }
}

export default drawNav;