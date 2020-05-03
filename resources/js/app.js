require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {
    $('.results').hide();
    $('.address-input').val('');
    $('#address').val('');
    $('#address-lat').val('');
    $('#address-long').val('');
    

    $(document).on('click', 'body', function () {
        $('.results').hide();
    });


    $('.address-input').on('keyup', function () {
        clearResults();
        if ($('.address-input').val().length >= 4) {
            search();
            $('.results').show();
        } else {
            $('.results').hide();
        }
    });


    $(document).on('click', '.entry-result', function () {
        clearInput();

        var address = $(this).find('p').html();
        var lat = $(this).find('.lat').val();
        var long = $(this).find('.long').val();

        $('#address').val(address);
        $('#address-lat').val(lat);
        $('#address-long').val(long);
        $('#address-up').val(address);
        $('#address-lat-up').val(lat);
        $('#address-long-up').val(long);

        $('.results').hide();
        clearResults();

    });
    
    function clearInput() {
        $('#address-lat').val('');
        $('#address-long').val('');
    }

    function clearResults() {
        $('.results').html('');
    }

    function search() {

        var source = document.getElementById("entry-template").innerHTML;
        var template = Handlebars.compile(source);

        var query = $('.address-input').val();

        if (query.length >= 4) {

        }

        $.ajax({
            url: 'https://api.tomtom.com/search/2/geocode/' + query + '.json?typeahead=true&limit=3&key=jmSHc4P5sMLTeiGeWWoRL81YcCxYxqGp',
            method: 'GET',
            success: function (data) {
                var results = data.results;
                for (var i = 0; i < data.results.length; i++) {
                    var context = {
                        address: results[i].address.freeformAddress,
                        latitude: results[i].position.lat,
                        longitude: results[i].position.lon,
                    };
                    var html = template(context);
                    $(".results").append(html);
                }

            },
            error: function (request, state, errors) {
            }
        });

    }

});
