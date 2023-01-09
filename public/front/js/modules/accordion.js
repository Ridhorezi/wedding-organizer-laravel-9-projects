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

function drawAccordion() {
    const triggers = document.querySelectorAll('.accordion_component-item_header');
    const icons = document.querySelectorAll('.accordion_component-item_header .icon');
    const panels = document.querySelectorAll('[data-scroll="true"] .collapse');

    triggers.forEach((el, i) => {
        el.addEventListener('click', e => {
            e.preventDefault();
            for (let k = 0; k < icons.length; k++) {
                icons[k].classList.remove('transform');
            }
            if (!e.target.classList.contains('collapsed')) {
                icons[i].classList.add('transform');

            } else {
                icons[i].classList.remove('transform');
            }
        })

        if (panels.length !== 0) {
            panels[i].addEventListener('shown.bs.collapse', e => {
                let height = parseFloat(window.getComputedStyle(panels[i]).height);
                if (window.pageYOffset > 500) {
                    window.scrollTo(0, window.pageYOffset - (height - 200))
                }
            })
        }

    })

}

export default drawAccordion;