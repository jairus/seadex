/*
 * Shortcut for managing many files. Please don't use this file on a live site due to performance implications.
 * Instead merge the files below to a single JavaScript file manually or using your backend technology.
 */
(function() {
    'use strict';

    var paths = [
        'scripts/polyfills.js',  // Mostly IE8 support, skip or remove if targeting IE9+.
        'scripts/libs/jquery.js',

        // Put own scripts here.
        'https://maps.googleapis.com/maps/api/js?sensor=false',
        'scripts/maplace.js',
        'scripts/maps_infobox.js',
        'scripts/libs/projekktor.js',
        'scripts/libs/fastclick.js',
        'scripts/libs/bootstrap.js',
        'scripts/libs/bootstrap-datepicker.js',
        'scripts/libs/bootstrap-select.js',
        'scripts/carousel.js',
        'scripts/site.js'
    ];

    document.write('<script src="' + paths.join('"></script>\n<script src="') + '"></script>');
})();
