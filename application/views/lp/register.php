<script>
function submitRegistration(){
		if(jQuery("#sa")[0].checked){
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
		else{
			
			if(!jQuery("#sa")[0].checked){
				alert("You must accept the Sales Agreement and Terms and Conditions before you proceed.");
			}
			else if(!jQuery("#tor")[0].checked){
				alert("You must accept the Terms and Conditions before you proceed.");
			}
		}
}
function salesAgreement(){
	co_name = jQuery("#company_name").val();
	co_rep = jQuery("#name").val();
	if(co_name&&co_rep){
		jQuery("#company_namex").val(co_name);
		jQuery("#company_repx").val(co_rep);
		jQuery("#saform")[0].submit();
	}
	else{
		if(!co_name){
			alert("Please input your company name!");
		}
		else if(!co_rep){
			alert("Please input your name!");
		}
	}
	
}
function alertX(msg){
	jQuery("#errormessage").html(msg);
	jQuery("#errormessage").hide();
	jQuery("#errormessage").fadeIn(300);
	$('html, body').animate({scrollTop : 0},800);
}
</script>
<div id="ninjadiv" style="display:none">
</div>
<div class="row">
	<div class="col-md-12">
		<h2>Sign up as a Logistics Service Provider</h2>
	</div>
</div>
<form style="display:none" target="_blank" action="<?php echo site_url("lp/sa")."/"; ?>" method="post" id="saform" >
	<input type="input" id="company_namex" name="company_name" />
	<input type="input" id="company_repx" name="company_rep" />
</form>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" action="<?php echo site_url("lp/register")."/"; ?>" method="post" style="width:400px; margin:auto" id="registerform" >
		<input type="hidden" name="register" value="1">
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<div class="col-sm-12 text-center" style="color:red" id="errormessage" >
				</div>
			  </div>
			  <?php
			  if(trim($_SESSION['lpmessage'])){
					?>
					 <div class="form-group">
						<div class="col-sm-12 text-center" style="color:green" >
						<?php echo $_SESSION['lpmessage']; ?>
						</div>
					  </div>
					<?php
				}
			  ?>
			  <div class="form-group">
				<label class="col-sm-3 control-label">Company Name</label>
				<div class="col-sm-9">
                                <input<?php echo (empty($companies) ? '' : ' list="companies"' )?> type="text" class="form-control" name='company_name' id="company_name">
                                  
                                <?php
                                if(! empty($companies)) {

                                    ?>
                                    <datalist id="companies">
                                        <?php
                                        foreach($companies as $company) {
                                            ?><option value="<?php echo $company->name?>"><?php
                                        }
                                        unset($company);
                                    ?>
                                    </datalist>
                                    <?php
                                }
                                ?>
				</div>
			  </div>
			   <div class="form-group">
				<label class="col-sm-3 control-label">Your Name</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name='name' id='name'>
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
				  <input type="password" class="form-control" placeholder="" name='password'><div><i>Must contain at least 1 capital letter, 1 small letter and a number</i></div>
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
					<input type="checkbox" id="sa" name="sa" value="yes" /> &nbsp;&nbsp;&nbsp;I accept the <a href="#" onclick="salesAgreement(); return false; " style="text-decoration:underline">Sales Agreement</a> and 
					<a target="_blank" href="<?php echo site_url("lp/tor");?>" style="text-decoration:underline">Terms and Conditions</a>
				</div>
			  </div>
			  <!--
			  <div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
					<input type="checkbox" id="tor" name="tor" value="yes" /> &nbsp;&nbsp;&nbsp;I accept the <a target="_blank" href="<?php echo site_url("lp/tor");?>">Terms and Conditions</a>
				</div>
			  </div>
			  -->
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