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
function loginSubmit(){
	data = jQuery("#loginform").serialize();
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

function proceed(){
	data = jQuery("#proceedform").serialize();
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
function custType(type){
	jQuery("#company_name").hide();
	if(type=="professional"){
		jQuery("#company_name").show();
	}
}
function register(){
	jQuery("#errormessage").html("");
	jQuery("#errormessage").hide();
	jQuery("#errormessage2").html("");
	jQuery("#errormessage2").hide();
	jQuery("#loginform").hide();
	jQuery("#userform").show();
}
function login(){
	jQuery("#errormessage").html("");
	jQuery("#errormessage").hide();
	jQuery("#errormessage2").html("");
	jQuery("#errormessage2").hide();
	jQuery("#loginform").show();
	jQuery("#userform").hide();
}
function logout(){
	self.location = "<?php echo site_url("rfq/logout"); ?>";
}

function alertX(msg){
	jQuery("#errormessage").html(msg);
	jQuery("#errormessage").hide();
	jQuery("#errormessage").fadeIn(300);
	$('html, body').animate({scrollTop : 0},800);
}
function alertX2(msg){
	jQuery("#errormessage2").html(msg);
	jQuery("#errormessage2").hide();
	jQuery("#errormessage2").fadeIn(300);
	$('html, body').animate({scrollTop : 0},800);
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
	<form id="proceedform" class="form-horizontal" method="post" action="<?php echo site_url("rfq/userprofile"); ?>">
		<input type="hidden" name="customer" value="1" />
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-sm-3 control-label">E-mail Address</label>
				<div class="col-sm-9">
					<?php echo $_SESSION['customer']['email']; ?>
				</div>
			</div>
			<?php
			if($_SESSION['customer']['company_name']){
			?>
			<div class="form-group">
				<label class="col-sm-3 control-label">Company Name</label>
				<div class="col-sm-9">
					<?php echo $_SESSION['customer']['company_name']; ?>
				</div>
			</div>
			<?php
			}
			?>
			<div class="form-group">
				<label class="col-sm-3 control-label">First Name</label>
				<div class="col-sm-9">
					<?php echo $_SESSION['customer']['first_name']; ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Last Name</label>
				<div class="col-sm-9">
					<?php echo $_SESSION['customer']['last_name']; ?>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<a href="#" onclick="logout(); return false;" >Click here to use a different Account.</a>
			</div>
			<div class="col-md-12 backbutton text-center">
				<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4"); ?>'">Back</button>
				<?php
				if($skipbutton){
					?><button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button><?php
				}
				?>
				<button type="button" class="btn btn-default" onclick="proceed()" >Submit</button>
			</div>
		</div>
	</form>
	<form style="display:none" class="form-horizontal" method="post" id='loginform' action="<?php echo site_url("rfq/userprofile"); ?>">
		<input type="hidden" name="login" value="1" />
		<div class="col-md-12">
			<div class="form-group">
				<div class="col-sm-12 text-center" >Login to your Account</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-center" style="color:red" id="errormessage2" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">E-mail Address</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="login[email]" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Password</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" name="login[password]" />
				</div>
			</div>
			<div class="col-md-12 text-center">
				<a href="#" onclick="register(); return false;" >Don't have an account yet? Click Here.</a>
			</div>
			<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4"); ?>'">Back</button>
			<?php
			if($skipbutton){
				?><button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button><?php
			}
			?>
			<button type="button" class="btn btn-default" onclick="loginSubmit()" >Submit</button>
			</div>
		</div>
	</form>
	<form class="form-horizontal" method="post" id='userform' action="<?php echo site_url("rfq/userprofile"); ?>" style="display:none">
		<input type="hidden" name="userprofile" value="1" />
		<div class="col-md-12">
			<div class="form-group">
				<div class="col-sm-12 text-center" >Register an Account</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-center" style="color:red" id="errormessage" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Customer Type</label>
				<div class="col-sm-1">
					<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('private')" value="private" <?php
					if($_SESSION['rfq']['customer_type']=="private"){
						echo "checked";
					}
					?> />
				</div>
				<div class="col-sm-2">
					Private
				</div>
				<div class="col-sm-1">
					<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('professional')" value="professional" <?php
					if($_SESSION['rfq']['customer_type']=="professional"){
						echo "checked";
					}
					?> /> 
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
			<div class="form-group" id="company_name">
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
		<div class="col-md-12 text-center">
			<a href="#" onclick="login(); return false;" >Already have an Account? Click Here to Login.</a>
		</div>
		<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4"); ?>'">Back</button>
			<?php
			if($skipbutton){
				?><button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button><?php
			}
			?>
			<button type="button" class="btn btn-default" onclick="submitProfile()" >Submit</button>
		</div>
		<script>
			custType("<?php echo $_SESSION['rfq']['customer_type']; ?>");
		</script>
	</form>
</div>
<script>
	<?php
	if(!$_SESSION['customer']['email']){
		?>
		login();
		jQuery("#proceedform").hide();
		<?php
	}
	?>
</script>