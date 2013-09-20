define([ 'jquery', 'spinner', 'hogan', 'lazyload', 'typeahead' ], function( $, Spinner, Hogan ) {

    // spinner set-up
    var spinner = new Spinner({
        lines: 17, // The number of lines to draw
        length: 18, // The length of each line
        width: 20, // The line thickness
        radius: 7, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 0.7, // Rounds per second
        trail: 60, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '200px', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    });

    $('#search-location')
        .typeahead({
            name: 'places',
            remote: '/search/places/%QUERY',
            // template: '<p>{{name}}</p>',
            // engine: Hogan
        })
        .on('typeahead:selected typeahead:autocompleted', function(e, datum) {
            $('input[name="location"]').val( datum.reference );
        });

    $('.search-button').click(function(e) {
        e.preventDefault();

        var location = $('input[name="location"]').val(),
            date = $('input[name="date"]').val();

        if ( location.length === 0 ) {
            alert("Location is required.");
            return false;
        } else if ( date.length === 0 ) {
            alert("Date is required.");
            return false;
        }

        // get the photos container
        var $photos = $('.photos');

        // empty the container
        $photos.empty();

        spinner.spin( $photos[0] );

        var data = {
            location: location,
            date: date
        };

        // get new photos
        $.getJSON('/search/photos', data, function( photos ) {

            spinner.stop();

            // if we get photos...
            if ( photos.length ) {

                var $items = [];

                // ...append each to the photos container
                for ( var i in photos ) {
                    $items.push(
                        '<li class="photo-cell">' +
                            '<img data-original="' + photos[i] + '" class="photo lazy">' +
                        '</li>'
                    );
                }

                // append photos
                $photos.append($items);

                // trigger lazyload
                $photos.find('img.lazy')
                       .show()
                       .lazyload();
            } else {
                $photos.empty()
                       .append('<p>No photos found... Sorry about that.</p>');
            }
        });
    });

});