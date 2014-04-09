<div class="row">
	<div class="col-md-12">
		<strong>Add an additional cargo?</strong><br /><br />
	</div>
</div>
<div class="row">
	<div class="col-md-12">
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
		<div class="col-md-12 backbutton">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/3"); ?>'">Back</button>
		</div>
		<?php
	}
	?>	
</div>