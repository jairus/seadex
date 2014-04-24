<div class="row">
	<div class="col-md-12">
		<h2>FORGOT PASSWORD</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" action="<?php echo site_url("cs/forgotpass")."/"; ?>" method="post" style="max-width:600px; margin:auto" >
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
			   if(trim($_SESSION['forgotpass']['success'])){
				?>
				<div class="text-center" style="padding-bottom:15px; color:green"><?php echo $_SESSION['forgotpass']['success']; ?></div>
				<?php
			  }
			  if(trim($_SESSION['forgotpass']['error'])){
				?>
				<div class="text-center" style="padding-bottom:15px; color:red"><?php echo $_SESSION['forgotpass']['error']; ?></div>
				<?php
			  }
			  if(!trim($_SESSION['forgotpass']['success'])){
				  ?>
				  <div class="text-center" style="padding-bottom:15px">Enter Your E-mail Login</div>
				  <div class="form-group">
					<label class="col-sm-3 control-label">E-mail Address</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" name='email' value="<?php echo htmlentitiesX($_SESSION['forgotpass']['email']); ?>">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-sm-12 text-center">
					  <input type="submit" class="btn btn-default" name='' value="Submit">
					</div>
				  </div>
				  <?php
			 }
			 ?>
			</div>
		</div>
		</form>
	</div><br />&nbsp;
</div>
<?php
unset($_SESSION['forgotpass']);
?>