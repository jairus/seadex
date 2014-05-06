<div class="sub-header">

  <div class="breadcrumbs-wrapper">
	<div class="container">
	   <ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>">Home</a></li>
		<li class="active">Freight Service Providers</li>
	  </ol>
	</div>
  </div>
</div>

<div class="subpage" role="main">
  <section class="container">

	<div class="row">
	  <div class="col-sm-12">
		<h1>Freight Service Providers</h1>
</div>
	</div>
	<div class="row">
	  <div class="col-sm-12"></div>
	</div>
	<div class="row">
		<div class="col-md-12"></div>
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
				  <p><a href="<?php echo site_url("lp/forgotpass")."/"; ?>">Forgot Password</a>&nbsp;&nbsp;
			      <a href="<?php echo site_url("lp/register")."/"; ?>">Sign-up for Free</a></p>
				</div>
			</div></form></div>
	  <div class="row">
          <div class="col-sm-12">
            <p>SeaDex provides immediate and actionable value to all service providers by connecting consumers with vendors online without compromising any individual rates or individual company identities. For vendors our business model immediately optimizes and enables:</p>
        </div>
      
        <div class="item-grid">
          <div class="row">
            <div class="col-sm-4 icon-side icon-receipt">
              <p>Benchmarking the business on subscribed routes</p>
            </div>
            <div class="col-sm-4 icon-side icon-coins">
              <p>For every dollar spent, one or more leads are generated</p>
            </div>
            <div class="col-sm-4 icon-side icon-mail">
              <p>Marketing is “free” until a client makes contact</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 icon-side icon-paper">
              <p>One realization of a lead per month justifies the cost of the license</p>
            </div>
            <div class="col-sm-4 icon-side icon-comm">
              <p>Maximize the LCL profit in Seadex Market (Launch Q2 – 2014)</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <p> <a href="<?php echo site_url("contact"); ?>">Contact us</a> for a demonstration of how we can get your company more business based on your competitive edge. </p>
          </div>
        </div>
	</div>

  </section>

</div>
