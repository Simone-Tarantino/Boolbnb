require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {
    clear();
   

    $(document).on('click', '#filter-button', function(){
        $('.house').show();

        var beds = $('#beds').val();
        var bathrooms = $('#bathrooms').val();
        var room_number = $('#room_number').val();


        $.each($('.house'), function () {
            var houseBed = parseInt($(this).find('.bed').text());
            var houseBathroom = parseInt($(this).find('.bathroom').text());
            var houseRoom = parseInt($(this).find('.room_number').text());
            if(room_number <= houseRoom && beds <= houseBed && bathrooms <= houseBathroom) {
                $(this).show();
            } else {
                $(this).hide();
            }          
        });

        // sezione extra
        var extras = [];
        $.each($("input[name='extra']:checked"), function () {
            extras.push($(this).val());
        });
        var extraCheckString = extras.toString()
        extraCheckString = extraCheckString.replace(',', ' ');
        $.each($('.house'), function(){
            var extrasHouseString = $(this).find('.extras').html();
            extrasHouseString = extrasHouseString.trim();
            extrasHouseString = extrasHouseString.replace(/ /g, '');
            extrasHouseString = extrasHouseString.replace(/\n/g, " ");
            console.log(extrasHouseString);
            var result = extrasHouseString.includes(extraCheckString);
            if (result == false) {
               $(this).hide();
            }
        });
    });
    
    $(document).on('click', '#remove-filters', function(){
        clear();
    });

    function clear () {
        $('.house').show();
        $('.checkbox-filter').prop('checked', false);
        $('#beds').val('');
        $('#bathrooms').val('');
        $('#room_number').val('');
    }
});

