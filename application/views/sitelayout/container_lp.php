<div class="sub-header">
  <div class="breadcrumbs-wrapper">
	<div class="container">
	   <ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("service_providers"); ?>">Service Providers</a></li>
		<?php
		if(strtolower($page)=="sign-up"||strtolower($page)=="login"||strtolower($page)=="forgot password"){
			?>
			<li class="active"><?php echo $page; ?></li>
			<?php
		}
		?>
	  </ol>
	</div>
  </div>
</div>

<div class="subpage" role="main">
		<section class="container"  style="padding-bottom:50px;">
	    <?php
		echo $content;
		?>
	</section>
</div>