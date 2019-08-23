/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../../node_modules/select2/dist/css/select2.css');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

var $ = require('jquery');
require('select2');

$("select").select2();

$("#contacterAgence").on("click",function (event) {
    $(this).slideUp();
    $("#contact_div").slideDown();
});
