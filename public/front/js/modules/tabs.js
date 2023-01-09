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

function drawTabs() {
    const triggerTabList = document.querySelectorAll('[role="tablist"] .nav-link');
    const tabPanes = document.querySelectorAll('.tab-content .tab-pane');

    triggerTabList.forEach((triggerEl, i) => {
        if (i === 0) {
            triggerTabList[i].click();
            tabPanes[i].classList.add('show', 'active');
        }

        triggerEl.addEventListener('click', e => {
            e.preventDefault()
            for (let i = 0; i < triggerTabList.length; i++) {
                triggerTabList[i].classList.remove('active');
                tabPanes[i].classList.remove('show', 'active');
            }
            triggerEl.classList.add('active');
            tabPanes[i].classList.add('show', 'active');
        })
    })
}

export default drawTabs;