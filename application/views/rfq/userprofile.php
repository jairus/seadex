<style>
.dependents{
	display:none;
}
</style>
<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
?>
<script>
function submitProfile(){
		data = jQuery("#userform").serialize();
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("rfq/userprofile"); ?>",
		  data: data,
		  success: function(msg){
			jQuery("#ninjadiv").html(msg)
		  },
		  //dataType: dataType
		});
}
</script>
<div id="ninjadiv" style="display:">
</div>
<div class="row">
	<div class="col-md-12">
		<h2>Your Profile</h2>
	</div>
</div>
<div class="row">
	<form class="form-horizontal" method="post" id='userform' action="<?php echo site_url("rfq/userprofile"); ?>">
		<input type="hidden" name="userprofile" value="1" />
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-sm-3 control-label">Your E-mail Address</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="userprofile[email]" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">First Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="userprofile[firstname]" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Last Name</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="userprofile[lastname]" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Contact Number</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="userprofile[contactnumber]" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Country</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="userprofile[country]" />
				</div>
			</div>
		</div>
		<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4"); ?>'">Back</button>
			<?php
			if($skipbutton){
				?><button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button><?php
			}
			?>
			<button type="button" class="btn btn-default" onclick="submitProfile()" >Submit RFQ</button>
		</div>
	</form>
</div>