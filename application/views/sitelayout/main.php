<?php
@session_start();
//echo "<pre>";
//print_r($_SESSION);
?>
		<script>
		<?php
		if($_SESSION['customer']['type']=='professional'){
			?>
			custtype = "prof";
			<?php
		}
		else{
			?>
			custtype = "priv";
			<?php
		}
		?>
		function gotoRFQ(){
			self.location="<?php echo site_url(); ?>rfq/"+custtype+"/1";
		}
		function gotoBids(){
			self.location="<?php echo site_url(); ?>lp/dashboard";
		}
		</script>
		<div class="sub-header sub-header-homepage">
          <div class="container theme-showcase" >
              <h1>Get <span>the best freight rates</span> FOR YOUR SHIPMENT !</h1>
              <h2><span>Save up to 50%</span> or more by choosing the right service provider!</h2>
              <hr style="margin:40px 0px">
              <?php
			  
			  if(!$_SESSION['customer']){
				  ?>
				  <h3>Please select what type of consumer you are:</h3>
				  <p data-toggle="buttons" class="consumer-type">
					<label class="btn btn-transculent btn-lg btn-tick" onclick="custtype='priv'">
					  <input type="radio" name="options" id="option2" value="priv" > I am an Individual
					</label>
					<label class="btn btn-transculent btn-lg btn-tick" onclick="custtype='prof'">
					  <input type="radio" name="options" id="option1" value="prof"> I am a Company
					</label>
				  </p>
				  <?php
			  }
			  ?>
              <p>
                <a class="btn btn-success btn-lg" role="button" onclick="gotoRFQ()">Get free quotes now !</a>
              </p>
			  <p>
                <a class="btn btn-success btn-lg" role="button" onclick="gotoBids()">Bid on RFQ’s now</a>
              </p>

          </div> <!-- /container -->
        </div>

        <div class="homepage" role="main">
          <section class="container">

            <div class="row text-center">
              <div class="col-md-12 bottom">
                <h2 class="section-title">How does seadex work ?</h2>
              </div>

              <div class="col-md-12">

                <div class="row gap">
                  <div class="col-sm-3 icon icon-mail">
                    <h3>Fill in the request</h3>
                    <p>Fill in all the details about your shipment in the request form</p>
                  </div>

                  <div class="col-sm-3 icon icon-connection">
                    <h3>Seadex connects with our logistic partners</h3>
                    <p>Seadex selects the best options for your cargo and preferences</p>
                  </div>

                  <div class="col-sm-3 icon icon-list">
                    <h3>Compare the offers</h3>
                    <p>Without any cost or obligations, you can compare the received offers and bids from our partners</p>
                  </div>

                  <div class="col-sm-3 icon icon-search">
                    <h3>Select the service provider</h3>
                    <p>Select the service provider that suits you best in terms of prices,transit times and other preferences as offered.</p>
                  </div>
                </div>

              </div>

            </div>
          </section>

          <section class="video text-center">

            <div class="container">
              <div class="col-md-12 bottom">
                <h2 class="section-title">Demo video</h2>
              </div>

              <div class="col-md-12 video-wrapper">
                <video width="800" height="450" style="width: 100%; height: 100%;" poster="media/intro.png" controls="controls" preload="none">
                  <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                  <source src="<?php echo site_url("media/media/seadex03.mp4")?>" />
                  <!--
				  <source src="<?php echo site_url("media/media/intro.webm")?>" />
                  <source src="<?php echo site_url("media/media/intro.ogv")?>" />
                  -->
			    </video>
              </div>

            </div>

          </section>

          <section class="container">

            <div class="row text-center">
              <div class="col-md-12 bottom">
                <h2 class="section-title">Why use seadex ?</h2>
              </div>

              <div class="col-md-12 gap">

                <div class="row">
                  <div class="col-sm-4 icon-side icon-gear">
                    <p>Seadex is <strong>free to use</strong>, a no obligation service</p>
                  </div>

                  <div class="col-sm-4 icon-side icon-wallet">
                    <p>Save money with competetive quotes and <b>choose the best rates</b></p>
                  </div>

                  <div class="col-sm-4 icon-side icon-clock">
                    <p><strong>Save time</strong>; service providers come to you</p>
                  </div>

                </div>

                <div class="row">

                  <div class="col-sm-4 icon-side icon-chart">
                    <p>Choose organized and quality certified <strong>logistic partners world wide</strong> such as ISO compliant vendors.</p>
                  </div>

                  <div class="col-sm-4 icon-side icon-port">
                    <p><strong>Over 6000 Ports</strong> to choose from</p>
                  </div>

                  <div class="col-sm-4 icon-side icon-thumb">
                    <p>Over <strong>1,000,000 historical voyages</strong> in the Database</p>
                  </div>

                </div>

                <div class="row">

                  <div class="col-sm-4 icon-side icon-server">
                    <p>Over <strong>5000 Container Vessels in the Database</strong> with Details and sailing schedules</p>
                  </div>

                  <div class="col-sm-4 icon-side icon-tree">
                    <p><strong>Reduce your carbon foot print</strong></p>
                  </div>

                </div>
				<!--
                <div class="row">
                  <div class="col-sm-12">
                    <ul class="carousel" id="home-carousel">
                      <li>
                        <img src="<?php echo site_url("media/images/placeholders/carousel_logo_135x45.jpg")?>" alt="">
                        <p>Choose organized and qualitycertified logistic partners world wide such as ISO compliant vendors.</p>
                      </li>
                      <li>
                        <img src="<?php echo site_url("media/images/placeholders/carousel_logo_135x45.jpg")?>" alt="">
                        <p>Choose organized and qualitycertified logistic partners world wide such as ISO compliant vendors.</p>
                      </li>
                      <li>
                        <img src="<?php echo site_url("media/images/placeholders/carousel_logo_135x45.jpg")?>" alt="">
                        <p>Choose organized and qualitycertified logistic partners world wide such as ISO compliant vendors.</p>
                      </li>
                      <li>
                        <img src="<?php echo site_url("media/images/placeholders/carousel_logo_135x45.jpg")?>" alt="">
                        <p>Choose organized and qualitycertified logistic partners world wide such as ISO compliant vendors.</p>
                      </li>
                      <li>
                        <img src="<?php echo site_url("media/images/placeholders/carousel_logo_135x45.jpg")?>" alt="">
                        <p>Choose organized and qualitycertified logistic partners world wide such as ISO compliant vendors.</p>
                      </li>
                    </ul>
                  </div>
                </div>

              </div>
            </div>
			-->

          </section>

        </div>