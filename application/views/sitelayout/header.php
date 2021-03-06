<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Get quotes for shipping and container freight from leading providers. Submit one form and Seadex will get your freight or cargo shipped for the lowest price">
	<meta name="keywords" content="freight, cargo, container shipping, shipping prices, freight providers, lcl container, international move, get shipping quotes, get freight quotes">
	<meta name="p:domain_verify" content="e8db88a7076a306c59ee44ae15399371"/>
    <title>Seadex<?php 
	if(trim($title_tag)){
		echo " | ".$title_tag;
	}
	else{
		echo " - Get Container and Freight quotes for any destination.";
	}
	?></title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url("media/css/bootstrap.min.css"); ?>" rel="stylesheet">
	<link href="<?php echo site_url("media/js/datepicker/css/datepicker.css"); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="<?php echo site_url("media/css/custom.css"); ?>">
	<link rel="stylesheet" href="<?php echo site_url("media/styles/_all.css"); ?>">
	<script src="<?php echo site_url("media/js/jquery.min.js"); ?>"></script>
	<script>
		steps = [];
		function selector(step){
			if(jQuery("#"+step)){
				jQuery("#start").hide();
				jQuery(".step").hide();
				jQuery("#"+step).fadeIn(200);
				steps.push(step);
				if(steps.length<2){
					jQuery("#prev").hide();
				}
				else{
					jQuery("#prev").show();
				}
				
				//setting and continues
				jQuery(".settings").show();
				jQuery(".continue").hide();
				//link = "?step="+step
				//history.pushState(null, null, link);
			}
		}
		function prev(){
			step = steps.pop();
			step = steps.pop();
			selector(step);
		}
	</script>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-49266974-1', 'seadex.com');
	ga('send', 'pageview');

	</script>
	<style>
	a:link, a:visited{
		color: #0E202E
	}
	</style>
	<script>(function() {
	  var _fbq = window._fbq || (window._fbq = []);
	  if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
	  }
	  _fbq.push(['addPixelId', '1388988408028903']);
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', 'PixelInitialized', {}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1388988408028903&amp;ev=PixelInitialized" /></noscript>
	<?php
	$method = $this->router->fetch_method();
	$class = $this->router->fetch_class();
	if($class=="cs"&&$method=="thankyou"){
		?>
		<!-- Facebook Conversion Code for SeaDex - Shipper Signup -->
		<script>(function() {
		  var _fbq = window._fbq || (window._fbq = []);
		  if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		  }
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6020825144925', {'value':'0.00','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020825144925&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
		<?php
	}
	else if($class=="lp"&&$method=="thankyou"){
		?>
		<!-- Facebook Conversion Code for SeaDex - FF Signup -->
		<script>(function() {
		  var _fbq = window._fbq || (window._fbq = []);
		  if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		  }
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6020825174325', {'value':'0.00','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020825174325&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
		<?php
	}
	else if($class=="rfq"&&$method=="thankyou"){
		?>
		<!-- Facebook Conversion Code for SeaDex - RFQ Submission -->
		<script>(function() {
		  var _fbq = window._fbq || (window._fbq = []);
		  if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		  }
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6020825186325', {'value':'0.00','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020825186325&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
		<?php
	}
	else if($class=="lp"&&$method=="thankyou_for_bidding"){
		?>
		<!-- Facebook Conversion Code for SeaDex - RFQ Bid -->
		<script>(function() {
		  var _fbq = window._fbq || (window._fbq = []);
		  if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		  }
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6020825196525', {'value':'0.00','currency':'USD'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020825196525&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
		<?php
	}
	
	
	?>

  </head>
  <body class="js">
	<script>
	document.body.className += ' js';
	</script>