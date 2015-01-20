<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seadex</title>

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
  </head>
  <body>