import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

$(document).ready(function () {
    console.log('jQuery is working!');
});


import 'laravel-datatables-vite';
