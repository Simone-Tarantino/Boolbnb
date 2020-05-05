require('./bootstrap');
const $ = require("jquery");
const Handlebars = require("handlebars");


$(document).ready(function () {

    // All'entrata della pagina tutti i valori sono vuoti e la distanza di default è 20km
    $('.results').hide();
    $('.address-input').val('');
    $('#address').val('');
    $('#address-lat').val('');
    $('#address-long').val('');
    $('#distance').val('20');
    disappear();

    // Digitando l'indirizzo vengono fuori risultati suggerimento indirizzo

    $('.address-input').on('keyup', function () {
        clearResults();
        if ($('.address-input').val().length >= 4) {
            search();
            $('.results').show();
        } else {
            $('.results').hide();
        }
    });
    
    $(document).on('click', 'body', function () {
        $('.results').hide();
    });

    // Click sul risultato del suggerimento per compilare latitudine e longitudine

    $(document).on('click', '.entry-result', function () {
        clearInput();

        $(this).find('.indirizzo').toggleClass("active");
        var address = $(this).find('p').html();
        var lat = $(this).find('.lat').val();
        var long = $(this).find('.long').val();

        $('#address').val(address);
        $('#address-lat').val(lat);
        $('#address-long').val(long);

        $('.results').hide();
        clearResults();

    });

    // Click su cerca per visualizzare gli appartamenti per lat long e distanza

    $(document).on('click', '#search', function () {
        var latitude = $('#address-lat').val();
        var longitude = $('#address-long').val();
        var distance = $('#distance').val();
        clearHouses();
        latLonSearch(latitude, longitude, distance);
    });


    // funzione pulizia valore input lat long per nuova ricerca

    function clearInput() {
        $('#address-lat').val('');
        $('#address-long').val('');
    }

    // funzione pulizia suggerimento ricerca indirizzo

    function clearResults() {
        $('.results').html('');
    }

    // funzione pulizia div risultati case

    function clearHouses() {
        $('.house-results').html('');
    }

    // FUNZIONI CHIAMATA API

    // funzione suggerimento ricerca indirizzo e geocode automatico

    function search() {

        var source = document.getElementById("entry-template").innerHTML;
        var template = Handlebars.compile(source);

        var query = $('.address-input').val();

        if (query.length >= 4) {
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
                error: function (request, state, errors) {}
            });
        }
    }

    // funzione per ricerca case tramite lat long e distanza dal punto di partenza

    function latLonSearch(latitude, longitude, distance) {

        var source = document.getElementById("search-template").innerHTML;
        var template = Handlebars.compile(source);

        $.ajax({
            url: 'http://127.0.0.1:8000/api/filter',
            method: 'GET',
            data: {
                'latitude': latitude,
                'longitude': longitude,
                'distance': distance
            },
            success: function (data) {
                var results = JSON.parse(data);
                for (var i = 0; i < results.length; i++) {
                    var context = {
                        address: results[i].address,
                        bathroom: results[i].bathroom,
                        bed: results[i].bed,
                        img_path: results[i].img_path,
                        id: results[i].id,
                        mq: results[i].mq,
                        room_number: results[i].room_number,
                    };
                    for (var x = 0; x < results[i].extras.length; x++) {
                        if (context.hasOwnProperty('extras'))
                            context.extras += results[i].extras[x].name + ' ';
                        else {
                            context.extras = results[i].extras[x].name + ' ';
                        }
                    }
                    var html = template(context);
                    $(".house-results").append(html);
                }
            },
            error: function (request, state, errors) {}
        });
    }

    function disappear() {
        setTimeout(fade_out, 3000);

        function fade_out() {
            $("#noResults").fadeOut().empty();
        }
    };


});
