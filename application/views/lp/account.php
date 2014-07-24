<?php
@session_start();
?>
	<style>
	th{
		background:#0E202E;
		color: #ffffff;
		border-bottom:0px !important;
	}
	table th.start{
		border-radius: 5px 0px 0px 0px !important; 
		-moz-border-radius: 5px 0px 0px 0px !important; 
		-webkit-border-radius: 5px 0px 0px 0px !important; 
	}
	table th.end{
		border-radius: 0px 5px 0px 0px !important; 
		-moz-border-radius: 0px 5px 0px 0px !important; 
		-webkit-border-radius: 0px 5px 0px 0px !important; 
	}
	table th.startend{
		border-radius: 5px 5px 0px 0px !important; 
		-moz-border-radius: 5px 5px 0px 0px !important; 
		-webkit-border-radius: 5px 5px 0px 0px !important; 
	}
	.menu{
		/*cursor:pointer;*/
	}
	.menu a{
		/*color: #2A5C80;*/
	}
	</style>
	  <h2 style='text-align:right'>My Profile</h2>
	  <div class="table-responsive">
		<div class="row">
			<div class="col-md-3">
			<?php
			include_once(dirname(__FILE__)."/dash_menu.php");
			?>
			</div>
			<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">My Profile</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td>
						
						<form class="form-horizontal" action="<?php echo site_url("lp/account")."/"; ?>" method="post" style="max-width:700px; margin:auto" >
						<?php
						if(trim($_GET['message'])){
							?>
							<div class="row">
								<div class="col-md-12">
								  <a style="color:red"><?php echo $_GET['message']; ?></a><br /><br />
								</div>
							</div>
							<?php
						}
						?>
						<div class="row">
							<div class="col-md-12">
							  <?php
							   if(trim($_SESSION['account']['success'])){
								?>
								<div class="text-center" style="padding-bottom:15px; color:green"><?php echo $_SESSION['account']['success']; ?></div>
								<?php
							  }
							  if(trim($_SESSION['account']['error'])){
								?>
								<div class="text-center" style="padding-bottom:15px; color:red"><?php echo $_SESSION['account']['error']; ?></div>
								<?php
							  }
							  ?>
							   <div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
								  <?php echo $_SESSION['logistic_provider']['email']; ?>
								</div>
							  </div>							 
							  <div class="form-group">
								<label class="col-sm-3 control-label">Your Name</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name='name' value="<?php echo htmlentitiesX($_SESSION['logistic_provider']['name']); ?>" />
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-3 control-label">Homepage</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name='homepage' value="<?php echo htmlentitiesX($_SESSION['logistic_provider']['homepage']); ?>" />
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-3 control-label">Contact</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name='contact' value="<?php echo htmlentitiesX($_SESSION['logistic_provider']['contact']); ?>" />
								</div>
							  </div>
							   <div class="form-group">
								<label class="col-sm-3 control-label">Services Provided (comma separated)</label>
								<div class="col-sm-9">
								  <textarea class="form-control" name='services' id="services"></textarea>
								  <script>
								  <?php
								  $svs = $_SESSION['logistic_provider']['services'];
								  $svs = str_replace("\n", "", $svs);
								  $svs = str_replace("\r", "", $svs);
								  ?>
								  jQuery("#services").val("<?php echo htmlentitiesX($svs); ?>");
								  </script>
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-3 control-label">Others(e.g. ISO Certification, TUV)</label>
								<div class="col-sm-9">
								  <textarea class="form-control" name='others' id="services"><?php echo stripslashes($_SESSION['logistic_provider']['others']); ?></textarea>
								</div>
							  </div>
							 
							 
							  <div class="form-group">
								<div class="col-sm-12 text-center">
								  <input type="submit" class="btn btn-default" name='' value="Save">
								</div>
							  </div>
							  <?php
							 unset($_SESSION['account']);
							 ?>
							</div>
						</div>
						</form>
						
						
					</td>
				</tr>
			  </tbody>
			 </table>
			</div>
		</div>
	</div>
