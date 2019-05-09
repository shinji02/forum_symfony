
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/admin.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');
const Swal = require('sweetalert2');
require('bootstrap-colorpicker');
require('picke')
$("#categorie_form_Color").colorpicker();
$("#categorie_form_Color").on('colorpickerChange colorpickerCreate', function (e) {
    $("#categorie_form_Color").val(e.color.toString());
});




