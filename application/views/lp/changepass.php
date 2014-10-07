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
	  <h2 style='text-align:right'>Change Password</h2>
	  <div class="table-responsive">
		<div class="row">
			<div class="col-md-2">
			<?php
			include_once(dirname(__FILE__)."/dash_menu.php");
			?>
			</div>
			<div class="col-md-10">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">Change Password</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td>
						
						<form class="form-horizontal" action="<?php echo site_url("lp/changepass")."/"; ?>" method="post" style="max-width:700px; margin:auto" >
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
							   if(trim($_SESSION['changepass']['success'])){
								?>
								<div class="text-center" style="padding-bottom:15px; color:green"><?php echo $_SESSION['changepass']['success']; ?></div>
								<?php
							  }
							  if(trim($_SESSION['changepass']['error'])){
								?>
								<div class="text-center" style="padding-bottom:15px; color:red"><?php echo $_SESSION['changepass']['error']; ?></div>
								<?php
							  }
							  if(!trim($_SESSION['changepass']['success'])){
								  ?>
								  <div class="text-center" style="padding-bottom:15px">Enter Your New Password</div>
								  <div class="form-group">
									<label class="col-sm-3 control-label">New Password</label>
									<div class="col-sm-9">
									  <input type="password" class="form-control" name='password'>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-sm-3 control-label">Confirm New Password</label>
									<div class="col-sm-9">
									  <input type="password" class="form-control" name='confirm_password'>
									</div>
								  </div>
								  <div class="form-group">
									<div class="col-sm-12 text-center">
									  <input type="submit" class="btn btn-default" name='' value="Submit">
									</div>
								  </div>
								  <?php
							 }
							 unset($_SESSION['changepass']);
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
