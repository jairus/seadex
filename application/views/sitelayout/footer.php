		<div id="footer">
          <div class="container">
            <div class="row">

              <div class="col-sm-12 col-md-6">
                <ul class="nav">
                  <li><a href="#">About</a></li>
                  <li><a href="#">Situation</a></li>
                  <li><a href="#">Consumers</a></li>
                  <li><a href="#">Service providers</a></li>
                </ul>

                <div class="social-links">
                  <a target="_blank" href="http://www.linkedin.com/company/5015878?trk=prof-exp-company-name" class="social-icon linkedin">LinkedIn</a>
                  <!--<a href="#" class="social-icon facebook">Facebook</a>-->
                </div>

                <p class="copyright">Copyright 2014 Seadex AS.</p>
              </div>

              <div class="col-xs-6 col-md-3">
                  <ul class="list-group">
                    <li class="list-group-item list-group-title">SEADEX AS HQ</li>
                    <li class="list-group-item">DRONNING MAUDS GATE 11</li>
                    <li class="list-group-item">0250 OSLO</li>
                    <li class="list-group-item">NORWAY</li>
                    <li class="list-group-item">EMAIL: <a href="mailto:info@seadex.com">INFO@SEADEX.COM</a></li>
                  </ul>
              </div>

              <div class="col-xs-6 col-md-3">
                <ul class="list-group">
                  <li class="list-group-item list-group-title">SEADEX SINGAPORE OFFICE</li>
                  <li class="list-group-item">MARINA VIEW ASIA</li>
                  <li class="list-group-item">POWER 1018960</li>
                  <li class="list-group-item">SINGAPORE</li>
                  <li class="list-group-item">EMAIL: <a href="mailto:info@seadex.com">INFO@SEADEX.COM</a></li>
                </ul>
              </div>

            </div>

          </div>

        </div>	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo site_url("media/js/bootstrap.min.js"); ?>"></script>
	<script src="<?php echo site_url("media/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
	<script>
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		var pickup = jQuery('[name="origin[date]"]').datepicker({
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			if (ev.date.valueOf() > delivery.date.valueOf()) {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
				delivery.setValue(newDate);
			}
			pickup.hide();
		}).data('datepicker');
		var delivery = jQuery('[name="destination[date]"]').datepicker({
			onRender: function(date) {
				return date.valueOf() <= pickup.date.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			delivery.hide();
		}).data('datepicker');
		
		
		
		var validity_date_from = jQuery('[name="validity_date_from"]').datepicker({
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			if (ev.date.valueOf() > validity_date_to.date.valueOf()) {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
				delivery.setValue(newDate);
			}
			validity_date_from.hide();
		}).data('datepicker');
		
		var validity_date_to = jQuery('[name="validity_date_to"]').datepicker({
			onRender: function(date) {
				return date.valueOf() <= validity_date_from.date.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			validity_date_to.hide();
		}).data('datepicker');
	</script>
	<script src="<?php echo site_url("media/scripts/_all.php?url=".urlencode(site_url("media")))?>"></script>
	<!--
	
	<script src='<?php echo site_url("media/scripts/polyfills.js")?>'></script> 
	<script src='<?php echo site_url("media/scripts/libs/jquery.js")?>'></script>
	<?php
	if($this->router->class=="static_pages"&&$this->router->method=="contact"){
		?>
		<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
		<script src='<?php echo site_url("media/scripts/maplace.js")?>'></script>
		<script src='<?php echo site_url("media/scripts/maps_infobox.js")?>'></script>
		<?php
	}
	?>
	<script src='<?php echo site_url("media/scripts/libs/projekktor.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/libs/fastclick.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/libs/bootstrap.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/libs/bootstrap-datepicker.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/libs/bootstrap-select.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/carousel.js")?>'></script>
	<script src='<?php echo site_url("media/scripts/site.js")?>'></script>
	-->
		<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?2QKpXTDJgN5vLyVJfFRe9DoJYaPQ2Hs8';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script>
	<!--End of Zopim Live Chat Script-->
  </body>
</html>