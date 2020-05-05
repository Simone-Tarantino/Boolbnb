const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {
    clear();


    $(document).on('click', '#filter-button', function () {
        $('.house').removeClass('hiding');
        $(".house").css("pointer-events", "auto");
        var beds = $('#beds').val();
        var bathrooms = $('#bathrooms').val();
        var room_number = $('#room_number').val();


        $.each($('.house'), function () {
            var houseBed = parseInt($(this).find('.bed').text());
            var houseBathroom = parseInt($(this).find('.bathroom').text());
            var houseRoom = parseInt($(this).find('.room_number').text());
            if (room_number <= houseRoom && beds <= houseBed && bathrooms <= houseBathroom) {
                $(this).removeClass('hiding');
            } else {
                $(this).addClass('hiding');
                $(".house").css("pointer-events", "none");
            }
        });

        // sezione extra
        var extras = [];
        $.each($("input[name='extra']:checked"), function () {
            extras.push($(this).val());
        });
        var extraCheckString = extras.toString()
        extraCheckString = extraCheckString.replace(',', '');
        $.each($('.house'), function () {
            var extrasHouseString = $(this).find('.extras').html();
            extrasHouseString = extrasHouseString.trim();
            extrasHouseString = extrasHouseString.replace(/\n/g, " ");
            extrasHouseString = extrasHouseString.replace(/ /g, '');
            var result = extrasHouseString.includes(extraCheckString);
            console.log(extrasHouseString);
            console.log(extraCheckString);
            console.log(result);
            if (result == false) {
                $(this).addClass('hiding');
                $(".hiding").css("pointer-events", "none");
            }
        });
    });

    $(document).on('click', '#remove-filters', function () {
        clear();
    });

    function clear() {
        $('.house').removeClass('hiding');
        $(".house").css("pointer-events", "auto");
        $('.checkbox-filter').prop('checked', false);
        $('#beds').val('');
        $('#bathrooms').val('');
        $('#room_number').val('');
    }

});
