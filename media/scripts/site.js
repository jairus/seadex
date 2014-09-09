(function($) {

  // Login window
  var showLoginButton = $('#show-login');
  var loginPopup = $('#login-popup');

  showLoginButton.on('click', function(e) {
    loginPopup.show();
    e.preventDefault();
  });

  loginPopup.on('click', '.popup-close', function(e) {
    loginPopup.hide();
    e.preventDefault();
  });


  // Fixed Navbar
  var navbar = $('#top-nav');
  var navbarLogo = $('#top-nav .navbar-brand > img');
  var logo = navbarLogo.attr('src');
  var logoSmall = navbarLogo.data('small');
  function fixedNav() {
    var $window = $(window)
    if ($window.scrollTop() > 220) {
      navbar.addClass('fixed-dynamic');
      // navbarLogo.attr('src', logoSmall);
      $('body').addClass('has-fixed-nav');
    } else if ($window.scrollTop() === 0) {
      navbar.removeClass('fixed-dynamic');
      // navbarLogo.attr('src', logo);
      $('body').removeClass('has-fixed-nav');
    }
  }
  $(window).scroll(fixedNav);
  fixedNav();

  //Carousel
  $("#home-carousel").bxSlider({
    minSlides: 1,
    maxSlides: 2,
    slideWidth: 585,
    moveSlides: 1,
    slideMargin: 10,
    controls: false
  });

  // Datepicker
  $('.date').datepicker({
    todayBtn: "linked",
    autoclose: true
  });

  // Custom select
  //$('select').selectpicker();

  // Tooltips
  $('[data-toggle="tooltip"]').tooltip();

  $(document).ready(function() {

    // Video
    /*
	projekktor('video', {
      playerFlashMP4: 'StrobeMediaPlayback.swf',
      playerFlashMP3: 'StrobeMediaPlayback.swf'
    });
	*/

    var headquarterMap,
    asiaOfficeMap,
    headquarterInfo = $('#headquarter-info'),
    asiaOfficeInfo = $('#asia-office-info');

    var InfoBox = initInfoBox();

    if ($('.map-pane').length > 0) {
      headquarterMap = makeMap('#headquarter-map', 59.913041, 10.728782, headquarterInfo.html());

      $('a[href="#headquarter-map"]').on('click', function(e) {
		if (typeof headquarterMap === 'undefined') {
			alert(1);
          headquarterMap = makeMap('#headquarter-map', 59.913041, 10.728782, headquarterInfo.html());
        }
      });
	  
	  
	   
      $('a[href="#asia-office-map"]').on('click', function(e) {
        if (typeof asiaOfficeMap === 'undefined') {
          asiaOfficeMap = makeMap('#asia-office-map', 1.37384, 103.85442, asiaOfficeInfo.html());
        }
      });
    }

    function makeMap(mapDiv, lat, lon, infoHtml) {
      var map = new Maplace({
        map_div: mapDiv,
        show_markers: true,
        locations: [{
          lat: lat,
          lon: lon,
          zoom: 16,
          icon: '/media/images/map_marker.png'
        }]
      });
      map.Load();
      google.maps.event.addListenerOnce(map.oMap, 'idle', function() {
        var infoWindow = $('<div class="info-window">').html(infoHtml);
        var infoBox = new InfoBox({
          content: infoWindow[0],
          infoBoxClearance: new google.maps.Size(1, 1),
          pixelOffset: new google.maps.Size(-140, -240),
          closeBoxURL: "/media/images/close.png",
          closeBoxMargin: "10px",
          isHidden: false,
          pane: "floatPane",
          enableEventPropagation: false
        });
        google.maps.event.addListener(map.markers[0], 'click', function() {
          infoBox.open(map.oMap, map.markers[0]);
        });
      });

      return map;
    }
  });

})(jQuery);