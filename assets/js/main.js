// Main config settings for RequireJS
require.config({
    paths: {
        // jQuery (local) - can't use CDN if we want to use requirejs to manage
        // jquery dependencies; and we do, so...
        jquery: 'vendor/jquery',

        // jQueryUI (local) - see jQuery above
        'jquery-ui': 'vendor/jquery-ui',

        // foundation responsive front-end framework
        'foundation': 'foundation/foundation'
    },
    shim: {
        'jquery-ui': {
            deps: [ 'jquery' ],
            exports: '$'
        },
        foundation: {
            deps: [ 'jquery' ],
            exports: 'Foundation'
        }
    }
});

// Modernizr custom shim to allow use within requirejs modules
define('modernizr', [], window.Modernizr);

// single-entry app dependencies
require([
    'jquery',
    'foundation',

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

], function( $, Foundation ) {

    // init foundation
    // $(document).foundation();

    $('#search-button').click(function() {
        $.getJSON('/search', $('#search-form').serialize(), function( results ) {
            console.log(results);
        });
    });

});