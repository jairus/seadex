<script>
function submitRegistration(){
		data = jQuery("#registerform").serialize();
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("lp/register"); ?>",
		  data: data,
		  success: function(msg){
			jQuery("#ninjadiv").html(msg)
		  },
		  //dataType: dataType
		});
}
</script>
<div id="ninjadiv" style="display:none">
</div>
<div class="row">
	<div class="col-md-12">
		<strong>Register</strong><br /><br />
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" action="<?php echo site_url("lp/register")."/"; ?>" method="post" style="width:400px; margin:auto" id="registerform" >
		<input type="hidden" name="register" value="1">
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="col-sm-3 control-label">Company Name</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name='company_name'>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-3 control-label">E-mail</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name='email'>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-3 control-label">Password</label>
				<div class="col-sm-9">
				  <input type="password" class="form-control" name='password'>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-3 control-label">Confirm Password</label>
				<div class="col-sm-9">
				  <input type="password" class="form-control" name='repassword'>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
				  <input type="button" class="btn btn-default" onclick="submitRegistration()" value="Register">
				</div>
			  </div>
			</div>
		</div>
		</form>
	</div><br />&nbsp;
</div>