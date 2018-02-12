
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
$(document).ready(function () {
    $('.table').DataTable({
        paging: false,
        info: false,
    });
    $('tr').on('click', function () {
        if ($(this).hasClass('selected')) {
            $(this).find('input[type="checkbox"]').prop('checked', false)
            $(this).removeClass('selected')
            $('button[name="deleteSelectedRows').hide()
        } else {
            $(this).find('input[type="checkbox"]').prop('checked', true)
            $(this).addClass('selected')
            $('button[name="deleteSelectedRows').show()
        }
    });
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
