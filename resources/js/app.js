require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");

$(document).ready(function () {
    $('.address-input').val('');
    $('#address').val('');
    $('#address-lat').val('');
    $('#address-long').val('');
    $('.search').click(function () {
        clearResults();
        search();
    });

    $(".address-input").keydown(function () {
        if (event.which == 13 || event.keyCode == 13) {
            clearResults();
            search();
        }
    });

    $('.address-input').on('keyup', function () {
        clearResults();
        if ($('.address-input').val().length >= 5) {
            search();
        }
    });


    $(document).on('click', '.entry-result', function () {
        clearInput();
        $(this).find('.indirizzo').toggleClass("active");
        // $(this).find('.coord').val();
        var address = $(this).find('p').html();
        var lat = $(this).find('.lat').val();
        var long = $(this).find('.long').val();
        $('#address').val(address);
        $('#address-lat').val(lat);
        $('#address-long').val(long);
        clearResults();
    });

    function clearInput() {
        $('.address-input').val('');
        $('#address').val('');
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
            url: 'https://api.tomtom.com/search/2/geocode/' + query + '.json?typeahead=true&key=jmSHc4P5sMLTeiGeWWoRL81YcCxYxqGp',
            method: 'GET',
            success: function (data) {
                var results = data.results;
                for (var i = 0; i < data.results.length; i++) {
                    console.log(data.results[i]);
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