<div class="row">
	<div class="col-md-12">
		<h2>Add an additional cargo?</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<form action="<?php echo site_url("rfq/".$type."/2"); ?>?new=1" method="post" >
			<button type="submit" class="btn btn-default btn-lg" name="more" value="1" >Yes</button>
			<button type="button" class="btn btn-default btn-lg" onclick="self.location='<?php echo site_url("rfq/userprofile"); ?>'">No</button>
		</form>
	</div>
</div>
<div class="row">
	<?php
	if(isset($backbutton)){
		?>
		<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/3"); ?>'">Back</button>
		</div>
		<?php
	}
	?>	
</div>