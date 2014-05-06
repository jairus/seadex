<?php
@session_start();
?>
<!-- Fixed navbar -->
        <div class="navbar navbar-default top-nav" id="top-nav" role="navigation">
          <div class="container">

            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <img src="<?php echo site_url("media/images/logo.png"); ?>" data-small="<?php echo site_url("media/images/logo-small.png"); ?>" alt="Seadex">
              </a>
            </div>

            <div class="navbar-collapse collapse">
              <div class="navbar-right">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo site_url("rfq")."/"; ?>">Request for quotation</a></li>
				  <li><a href="<?php echo site_url("about")."/"; ?>">About</a></li>
                  <li><a href="<?php echo site_url("situation")."/"; ?>">Situation</a></li>
                  <li><a href="<?php echo site_url("consumers")."/"; ?>">Consumers</a></li>
                  <li><a href="<?php echo site_url("service_providers")."/"; ?>">Service providers</a></li>
                  <li><a href="<?php echo site_url("contact")."/"; ?>">Contact</a></li>
				  <?php
				  if($_SESSION['customer']['id']){
					?>
					<li><a href="<?php echo site_url("cs")."/logout"; ?>">Logout</a></li>
					<?php
				  }
				  else if($_SESSION['logistic_provider']['id']){
					?>
					<li><a href="<?php echo site_url("lp")."/logout"; ?>">Logout</a></li>
					<?php
				  }
				  else{
					  ?>
					  <li>
						<button type="button" class="btn btn-primary navbar-btn" id="show-login">Login</button>
					  </li>
					  <?php
				  }
				  ?>
				</ul>
              </div>

            </div><!--/.nav-collapse -->
			<script>
				function loginForm(idx){
					jQuery(".loginforms").hide();
					jQuery("#"+idx).show();
				}
			</script>
            <div class="login-popup" id="login-popup">
              <div class="row" style='padding-bottom:10px;'>
                  <div class="col-md-6" style='font-size:12px'>
					<input type="radio" name="loginx" checked onclick='loginForm("lp_form")' /> Service Provider &nbsp;
				  </div>
				  <div class="col-md-6" style='font-size:12px' >
					<input type="radio" name="loginx" onclick='loginForm("cs_form")' /> Consumer
				  </div>
              </div>
			  <form id='lp_form' class='loginforms' role="form" action="<?php echo site_url("lp/login")."/"; ?>" method="post">
			    <div class="form-group">
                  <input type="text" class="form-control" id="login" placeholder="Service Provider E-mail" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
				<div class="row">
				  <div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Login</button>
				  </div>
				</div>
				<div class="row" style="padding-top:10px;">
				  <div class="col-md-6">
					<a href="<?php echo site_url("lp/forgotpass")."/"; ?>">Forgot Password</a>
				  </div>
				  <div class="col-md-6">
					
					<a href="<?php echo site_url("lp/register")."/"; ?>">Sign-up for Free</a>
				  </div>
				</div>
                
              </form>
			  <form id='cs_form' class='loginforms' role="form" action="<?php echo site_url("cs/login")."/"; ?>" method="post" style='display:none'>
				<div class="form-group">
                  <input type="text" class="form-control" id="login" placeholder="Consumer E-mail" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
				<div class="row">
				  <div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Login</button>
				  </div>
				</div>
				<div class="row" style="padding-top:10px;">
				  <div class="col-md-6">
					<a href="<?php echo site_url("cs/forgotpass")."/"; ?>">Forgot Password</a>
				  </div>
				  <div class="col-md-6">
					
					<a href="<?php echo site_url("cs/register")."/"; ?>">Sign-up for Free</a>
				  </div>
				</div>
                
              </form>
              <button type="button" class="popup-close close">&times;</button>
			  
            </div>
          </div>
        </div>