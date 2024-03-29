/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/web/custom.scss';

// start the Stimulus application
import './bootstrap';

import { ScrollWeb } from './smoothScroll';
import { Parallax } from './parallax';
import { createApp } from 'vue';
import DevisForm from './vue/controllers/DevisForm';
import AOS from 'aos';

// Variables
// -----------------------------------------------
const pageDatas = document.querySelector('body');
const values = {
    damping: pageDatas.dataset.damping,
    scrollImgSpeed: pageDatas.dataset.scrollimg
};

// Instantieur
// -----------------------------------------------
document.addEventListener('DOMContentLoaded', function(){
    AOS.init();
    // scrollWeb();
    parallax();
    createApp({
        components: { DevisForm }
    }).mount('#website');
});

// Smooth Scrollbar
// -----------------------------------------------
function scrollWeb() {
    const scrollWeb = new ScrollWeb(values.damping);
    scrollWeb.init;
    return scrollWeb;
}

// Parallax
// -----------------------------------------------
function parallax() {
    const parallax = new Parallax(values.damping, values.scrollImgSpeed);
    parallax.initParallax();
    return parallax;
}

// Navigation
// -----------------------------------------------

