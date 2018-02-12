
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
    $('button[name="deleteSelectedRows').on('click', function () {
        let result = []
        let table = $(this).attr('data-id-table')

        $('table').find('input:checked').each(function (e, input) {
            // Collect selected ids
            result.push($(input).prop('name'))
        })

        if (result.length <= 0) {
            alert('You must select at least one element to delete')
            return
        }

        $.ajax({
            url: baseUrl + '/' + table + '/0',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                list: result
            }
        }).done(function (response) {
            window.location = baseUrl + '/' + response
        });
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
