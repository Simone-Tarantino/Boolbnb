require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {
    $(document).on('click', '#filter-button', function(){
        $('.house').removeClass('d-none');
        var extras = [];
        $.each($("input[name='extra']:checked"), function () {
            extras.push($(this).val());
        });
        console.log('Extra checkbox', extras);
        var extraCheckString = extras.toString()
        extraCheckString = extraCheckString.replace(',', ' ');
        console.log(extraCheckString);
        $.each($('.house'), function(){
            var extrasHouseString = $(this).find('.extras').html();
            extrasHouseString = extrasHouseString.trim();
            extrasHouseString = extrasHouseString.replace(/ /g, '');
            extrasHouseString = extrasHouseString.replace(/\n/g, " ");
            console.log(extrasHouseString);
            // var houseExtrasArray = extrasString.split(' ');
            var result = extrasHouseString.includes(extraCheckString);
            console.log(result);
            if (result == false) {
               $(this).addClass('d-none');
            }
        });
    });
    
    $(document).on('click', '#remove-filters', function(){
        $('.house').removeClass('d-none');
        $('.checkbox-filter').prop('checked', false);
    });
});

