<script>
function submitProfile(){
		data = jQuery("#userform").serialize();
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("cs/register"); ?>",
		  data: data,
		  success: function(msg){
			jQuery("#ninjadiv").html(msg)
		  },
		  //dataType: dataType
		});
}
function custType(type){
	jQuery("#company_name").hide();
	if(type=="professional"){
		jQuery("#company_name").show();
	}
}
function alertX(msg){
	jQuery("#errormessage").html(msg);
	jQuery("#errormessage").hide();
	jQuery("#errormessage").fadeIn(300);
	$('html, body').animate({scrollTop : 0},800);
}

</script>
<div id="ninjadiv" style="display:">
</div>
<div class="row">
	<div class="col-md-12">
		<h2>Sign up as a Consumer</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" method="post" id='userform' action="<?php echo site_url("rfq/userprofile"); ?>" style="width:70%">
			<input type="hidden" name="register" value="1" />
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-sm-12 text-center" style="color:red" id="errormessage" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Customer Type</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('private')" value="private" checked />
					</div>
					<div class="col-sm-2">
						Private
					</div>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('professional')" value="professional" /> 
					</div>
					<div class="col-sm-2">
						Professional
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Your E-mail Address</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[email]" placeholder="This will be your login name" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="userprofile[password]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Confirm Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="userprofile[confirm_password]" />
					</div>
				</div>
				<div class="form-group" id="company_name" style="display:none">
					<label class="col-sm-3 control-label">Company Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[company_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">First Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[first_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Last Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[last_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Contact Number</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[contact_number]" />
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
				<button type="button" class="btn btn-default" onclick="submitProfile()" >Submit</button>
			</div>
		</form>
	</div><br />&nbsp;
</div>