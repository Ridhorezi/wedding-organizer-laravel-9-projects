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

const emailRegExp = /^\w+([-]?\w+)*@\w+([-]?\w+)*(\.\w{2,3})+$/;

import {initModal} from "./modal";

async function sendForm(form) {
    let handler = form.getAttribute('action');
    if (handler !== '' && handler !== '#') {
        const response = await fetch(
            handler,
            {
                method: 'POST',
                body: new FormData(form)
            }
        );
        if(response.ok) {
            form.reset();
        }
    }
}

export function validateForm(target, fieldSelector = '.field') {
    const form = document.querySelector(target);
    const inputsArr = document.querySelectorAll(`${target} ${fieldSelector}`);

    let notificationText = '';

    const valid = elem => !elem.classList.contains('error');

    if (form) {
        form.addEventListener('submit', () => {
            for (let i = 0; i < inputsArr.length; i++) {
                const el = inputsArr[i];
                const value = el.value;
                if (el.classList.contains('required') && value === '') {
                    el.classList.add('error');
                } else if (el.dataset.type === 'email' && !emailRegExp.test(value)) {
                    el.classList.add('error');
                } else if (el.dataset.type === 'tel' && isNaN(+value)) {
                    el.classList.add('error');
                }

                el.addEventListener('input', () => {
                    el.classList.remove('error');
                });
            }

            if (Array.from(inputsArr).every(valid)) {
                inputsArr.forEach(el => {
                    el.classList.remove('error');
                })
                if (form.dataset.type === 'searchForm' || form.dataset.type === 'searchProducts' || form.dataset.type === 'searchPosts') {
                    notificationText = 'Nothing found.';
                } else if (form.dataset.type === 'newsletter') {
                    notificationText = 'Subscription confirmation has been sent to your Email.';
                } else if (form.dataset.type === 'feedback') {
                    notificationText = 'Your message has been sent. We\'ll reply you as soon as possible.';
                } else if (form.dataset.type === 'userComment' || form.dataset.type === 'postReply') {
                    notificationText = 'Your comment is awaiting moderation.';
                }

                let notification = {
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    html: `<p class="main">${notificationText}</p>`,
                    customClass: {
                        popup: 'alert_popup',
                        title: 'alert_popup-title',
                        htmlContainer: 'alert_popup-content',
                        closeButton: 'alert_popup-close',
                        container: 'alert_popup-container'
                    }
                };
                sendForm(form);
                initModal(notification);
            }
        })
    }
}

export function validate() {
    validateForm('[data-type="searchForm"]');
    validateForm('[data-type="searchProducts"]');
    validateForm('[data-type="searchPosts"]');
    validateForm('[data-type="newsletter"]');
    validateForm('[data-type="userComment"]');
    validateForm('[data-type="postReply"]');
    validateForm('[data-type="feedback"]');
}