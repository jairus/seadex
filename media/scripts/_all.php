/*
 * Shortcut for managing many files. Please don't use this file on a live site due to performance implications.
 * Instead merge the files below to a single JavaScript file manually or using your backend technology.
 */
(function() {
    'use strict';
    var paths = [
        '<?php echo $_GET['url']."/"; ?>scripts/polyfills.js',  // Mostly IE8 support, skip or remove if targeting IE9+.
        '<?php echo $_GET['url']."/"; ?>scripts/libs/jquery.js',

        // Put own scripts here.
        'https://maps.googleapis.com/maps/api/js?sensor=false',
        '<?php echo $_GET['url']."/"; ?>scripts/maplace.js',
        '<?php echo $_GET['url']."/"; ?>scripts/maps_infobox.js',
        '<?php echo $_GET['url']."/"; ?>scripts/libs/projekktor.js',
        '<?php echo $_GET['url']."/"; ?>scripts/libs/fastclick.js',
        '<?php echo $_GET['url']."/"; ?>scripts/libs/bootstrap.js',
        '<?php echo $_GET['url']."/"; ?>scripts/libs/bootstrap-datepicker.js',
        '<?php echo $_GET['url']."/"; ?>scripts/libs/bootstrap-select.js',
        '<?php echo $_GET['url']."/"; ?>scripts/carousel.js',
        '<?php echo $_GET['url']."/"; ?>scripts/site.js?_='+(new Date()).getTime()
    ];

    document.write('<script src="' + paths.join('"></script>\n<script src="') + '"></script>');
})();
