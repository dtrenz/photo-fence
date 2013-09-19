define([ 'jquery', 'goog!maps,2,sensor:false' ], function( $ ) {

    var input = document.getElementById('search-location'),
        options = {
            types: ['geocode']
        },
        autocomplete;

    console.log(google, google.maps, google.maps.places);

    autocomplete = new google.maps.places.Autocomplete(input, options);

    console.log(autocomplete);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        console.log(autocomplete.getPlace());
    });
});