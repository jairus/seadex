<div class="sub-header">

  <div class="breadcrumbs-wrapper">
	<div class="container">
	   <ol class="breadcrumb">
		<li><a href="home.html">Home</a></li>
		<li class="active">Consumers</li>
	  </ol>
	</div>
  </div>
</div>

<div class="subpage" role="main">
  <section class="container">

	<div class="row">
	  <div class="col-sm-8">
		<h1>Consumers</h1>

		<p>Seadex is taking the mystery out of shipping goods by containers; we provide transparency in terms of competitive advantages from the Agent, Freight Forwarder, and the Container Ship to the final price of the shipment in a favorable manner for both the vendor and the consumer. This is done by guiding YOU through expectations, processes and comparison matrixes covering the logistic company’s quality profile, transit times and prices.</p>
		
		
		
		<div class="row">
		<div class="col-md-12">
			<h2>Consumer Login</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="<?php echo site_url("cs/login")."/"; ?>" method="post" style="max-width:400px; margin:auto" >
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
					<label class="col-sm-6 control-label">E-mail Address</label>
					<div class="col-sm-6">
					  <input type="text" class="form-control" name='email' value="<?php echo htmlentitiesX($_SESSION['customer']['email']); ?>">
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-6 control-label">Password</label>
					<div class="col-sm-6">
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
				  <!--<a href="<?php echo site_url("cs/forgotpassword")."/"; ?>">Forgot Password</a>&nbsp;&nbsp;&nbsp;-->
				  <a href="<?php echo site_url("cs/register")."/"; ?>">Sign-up for Free</a>
				</div>
			</div>
			</form>
		</div><br />&nbsp;
	</div>
	
	  
	  </div>
	  

	  <aside class="col-sm-4">
		<p class="side-image">
		  <img src="<?php echo site_url("media/images"); ?>/consumers.jpg" class="rounded" alt="">
		</p>
	  </aside>
	</div>

	

  </section>

</div>
