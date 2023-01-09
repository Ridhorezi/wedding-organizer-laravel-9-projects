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

import AOS from 'aos';
import svg4everybody from "svg4everybody";
import LazyLoad from "vanilla-lazyload";
import customSelect from "custom-select/src";
import {Collapse, Tab, Offcanvas} from "bootstrap";

import drawNav from "./modules/nav";
import {preventDefault, toggleActiveState, changeQty, setPadding, setCurrentYear} from "./modules/helpers";
import {initInstagramSwiper} from "./modules/slider";
import {triggerQuickView, addToCompare, triggerSearchForm} from "./modules/modal";
import animateNumber from "./modules/counter";
import timer from "./modules/timer";
import createRangeInput from "./modules/range";
import drawTabs from "./modules/tabs";
import {validate} from "./modules/forms";

document.addEventListener('DOMContentLoaded', () => {
    drawNav();
    setPadding('.header_nav', 'both');
    preventDefault();
    toggleActiveState();
    svg4everybody();
    customSelect('select');
    AOS.init({
        offset: 30, // offset (in px) from the original trigger point
        delay: 0, // values from 0 to 3000, with step 50ms
        duration: 600, // values from 0 to 3000, with step 50ms
        easing: 'ease', // default easing for AOS animations
        once: true, // animation repeat
    });
    const lazyload = new LazyLoad();
    animateNumber();
    timer('.timer', '2022-06-24');
    createRangeInput(4, 1020, '#priceMin', '#priceMax');
    changeQty();
    triggerQuickView();
    addToCompare();
    initInstagramSwiper();
    drawTabs();
    triggerSearchForm();
    validate();
    setCurrentYear();
})


