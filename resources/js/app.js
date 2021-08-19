require('./bootstrap');

require('alpinejs');

import $ from 'jquery';
window.$ = window.jQuery = $;

$(function(){
    console.clear();
    console.log('it is working')

    $('select.ajax-select').on('change', function() {
        let id = parseInt($(this).val()),
            target = $($(this).data('target'));
        
        if(id){
            $.ajax({
                url: $(this).data('url') + '/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    target.val(response.data);
                }
            });
        }
    });

    $('.input').on('input', function(){
        // totalPrice
        var x = document.getElementById('unit_price').value;
        x = parseFloat(x);
        var y = document.getElementById('quantity').value;
        y = parseFloat(y);
        document.getElementById('total_price').value = x * y;
    });


});