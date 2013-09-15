// Main config settings for RequireJS
require.config({
    paths: {
        // jQuery (local) - can't use CDN if we want to use requirejs to manage
        // jquery dependencies; and we do, so...
        jquery: 'vendor/jquery',

        // jQueryUI (local) - see jQuery above
        'jquery-ui': 'vendor/jquery-ui',

        // foundation responsive front-end framework
        foundation: 'foundation/foundation',

        // Lazy Load Plugin for jQuery
        lazyload: 'vendor/jquery.lazyload',

        // Masonry grid layout library
        masonry: 'vendor/masonry',

        // custom AJAX spinner
        spinner: 'vendor/jquery.spin'
    },
    shim: {
        'jquery-ui': {
            deps: [ 'jquery' ],
            exports: '$'
        },
        foundation: {
            deps: [ 'jquery' ],
            exports: 'Foundation'
        },
        lazyload: {
            deps: [ 'jquery' ],
            exports: '$'
        },
        masonry: {
            exports: 'Masonry'
        },
        spinner: {
            exports: 'Spinner'
        }
    }
});

// Modernizr custom shim to allow use within requirejs modules
define('modernizr', [], window.Modernizr);

// single-entry app dependencies
require([
    'jquery',
    'foundation',
    'vendor/spin',
    'lazyload'

    /*
    * optional Foundation JS widgets
    */
    // 'foundation/foundation.abide',
    // 'foundation/foundation.alerts',
    // 'foundation/foundation.clearing',
    // 'foundation/foundation.cookie',
    // 'foundation/foundation.dropdown',
    // 'foundation/foundation.forms',
    // 'foundation/foundation.interchange',
    // 'foundation/foundation.joyride',
    // 'foundation/foundation.magellan',
    // 'foundation/foundation.orbit',
    // 'foundation/foundation.placeholder',
    // 'foundation/foundation.reveal',
    // 'foundation/foundation.section',
    // 'foundation/foundation.tooltips',
    // 'foundation/foundation.topbar'

], function( $, Foundation, Spinner ) {

    // init foundation
    // $(document).foundation();

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
        top: '100px', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    });


    $('.search-button').click(function(e) {
        e.preventDefault();

        // get the photos container
        var $photos = $('.photos');

        // empty the container
        $photos.empty();

        spinner.spin( $photos[0] );

        // get new photos
        $.getJSON('/search', $('.search-form').serialize(), function( photos ) {

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