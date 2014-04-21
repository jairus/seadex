<div class="row">
	<div class="col-md-12">
		<h2>Logistic Service Provider Login</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" action="<?php echo site_url("lp/login")."/"; ?>" method="post" style="max-width:400px; margin:auto" >
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
			  <div class="form-group">
				<label class="col-sm-3 control-label">E-mail</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" name='email' value="<?php echo htmlentitiesX($_SESSION['logistic_provider']['email']); ?>">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-3 control-label">Password</label>
				<div class="col-sm-9">
				  <input type="password" class="form-control" name='password'>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-12 text-center">
				  <input type="submit" class="btn btn-default" name='' value="Login">
				</div>
			  </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
			  <!--<a href="<?php echo site_url("lp/forgotpassword")."/"; ?>">Forgot Password</a>&nbsp;&nbsp;&nbsp;-->
			  <a href="<?php echo site_url("lp/register")."/"; ?>">Sign-up for Free</a>
			</div>
		</div>
		</form>
	</div><br />&nbsp;
</div>