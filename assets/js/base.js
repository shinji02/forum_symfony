/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/base.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 const $ = require('jquery');
require('bootstrap');



var path = window.location.pathname;

if(path === "/register")
{
  $("#checkRobot").click(function (event) {
   event.preventDefault();
   grecaptcha.ready(function() {
    grecaptcha.execute('6LfuUIEUAAAAACix21Wvv8mJSxYBuK8wuYUpUi27', {action: 'homepage'}).then(function(token) {
      $("#googleToken").val(token);
    });
   });
  });
}
