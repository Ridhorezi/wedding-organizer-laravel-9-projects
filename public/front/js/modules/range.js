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

import noUiSlider from 'nouislider';

function createRangeInput(min, max, minOutput, maxOutput) {
    const rangeInput = document.querySelector('.range-slider');
    const rangeMinOutput = document.querySelector(minOutput);
    const rangeMaxOutput = document.querySelector(maxOutput);
    const outputArr = [rangeMinOutput, rangeMaxOutput];

    if (rangeInput) {
        noUiSlider.create(rangeInput, {
            start: [min, max],
            connect: true,
            range: {
                'min': min,
                'max': max
            }
        });

        rangeInput.noUiSlider.on('update', function (values, handle) {

            let value = values[handle];

            outputArr[handle].value = `${Math.round(value)}$`;
        })
    }

}

export default createRangeInput;