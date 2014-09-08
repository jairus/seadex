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
					<li><a href="<?php echo site_url("lp")."/rfqs"; ?>">Customer RFQs</a></li>
					<!--
					<li><a href="<?php echo site_url("lp")."/account"; ?>">Account Settings</a></li>
					-->
					<li><a href="<?php echo site_url("lp")."/logout"; ?>">Logout</a></li>
                  <!--
				  <li><a href="about.html">About</a></li>
                  <li><a href="situation.html">Situation</a></li>
                  <li><a href="consumers.html">Consumers</a></li>
                  <li><a href="service_providers.html">Service providers</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li>
                    <button type="button" class="btn btn-primary navbar-btn" id="show-login">Login</button>
                  </li>
				  -->
                </ul>
              </div>
            </div><!--/.nav-collapse -->

            <div class="login-popup" id="login-popup">
              <form role="form">
                <div class="form-group">
                  <input type="text" class="form-control" id="login" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
              <button type="button" class="popup-close close">&times;</button>
            </div>
          </div>
        </div>