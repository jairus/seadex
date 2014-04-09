<?php
@session_start();
//print_r($_SESSION);
if($_SESSION['rfq_complete']||1){
	?>
	<!-- Google Code for New RFQ Conversion Page -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 972266148;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "gQ1zCKSA2ggQpLXOzwM";
	var google_remarketing_only = false;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/972266148/?label=gQ1zCKSA2ggQpLXOzwM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	<?php
	unset($_SESSION['rfq_complete']);
}
?>
<div class="subpage" role="main">
<section class="container text-center"  style="padding-bottom:50px; padding-top:60px;">
	<div class="row">
		<div class="col-md-12">
			<strong>Thank you for using SeaDex in finding the best freight rates!<br />
			The best bids, according to your preferences, will be sent to your email. 
			<br />If you have any additional questions, send email to: <a href="mailto:info@seadex.com">info@seadex.com</a></strong><br /><br />
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-default btn-lg" onclick='self.location="<?php echo site_url("rfq")."/"; ?>"'>Request for a new Quote</button>
		</div>
	</div>
</section>
</div>