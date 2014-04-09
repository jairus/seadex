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
	</script>
  </body>
</html>