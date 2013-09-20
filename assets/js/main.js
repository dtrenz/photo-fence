// Main config settings for RequireJS
require.config({
    waitSeconds : 15,
    paths: {
        // RequireJS async plugin
        async: 'vendor/require.async',

        // RequireJS Google API loader plugin
        goog: 'vendor/require.goog',

        // Just a helper used by some plugins to parse arguments (not a real plugin).
        propertyParser: 'vendor/propertyParser',

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
        spinner: 'vendor/jquery.spin',

        // Twitter jQuery typeahead plugin
        typeahead: 'vendor/jquery.typeahead',

        hogan: 'vendor/hogan'
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
        },
        typeahead: {
            dep: [ 'jquery' ],
            exports: '$'
        },
        hogan: {
            exports: 'Hogan'
        }
    }
});

// Modernizr custom shim to allow use within requirejs modules
define('modernizr', [], window.Modernizr);

// single-entry app dependencies
require([
    'jquery',
    'foundation',
    'app/autocomplete'

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

});