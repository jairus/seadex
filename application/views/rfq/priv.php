<style>
.dotted tbody tr td{
	/*border-style:dashed;*/
}
.dotted tbody tr th{
	/*border-style:dashed;*/
}
.dotted{
	border-style:dashed;
}
.removepacking{
	cursor:pointer;
	font-weight:normal;
	text-transform:none !important;
}
</style>
<div class="subpage" role="main">
	<div class="sub-header">
	  <div class="breadcrumbs-wrapper">
		<div class="container">
		   <ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>">Home</a></li>
			<li><a href="<?php echo site_url("rfq"); ?>">Request for quotation</a></li>
			<li class="active" href="<?php echo site_url("rfq"); ?>">Step <?php echo $step+1; ?></li>
		  </ol>
		</div>
	  </div>
	</div>
	<section class="container"  style="padding-bottom:50px;">
		<div class="row">
			<div class="col-sm-6">
				<h1>Get the best freight rates !</h1>
				<p>Fill in the form to receive individual quotation for your delivery!<br />
				Add additional cargo at the end of the filling form.
				</p>
			</div>
			<div class="col-sm-6">
				<ul class="nav nav-steps">
				  <li><span>Step:</span></li>
				  <?php
				  for($i=0; $i<4; $i++){
					if($step==$i){
						?><li class="active"><a class="btn"><?php echo $i+1; ?></a></li><?php
					}
					else{
						if($i<$step){
							if($i==0){
								?><li class="done"><a class="btn" href="<?php echo site_url("rfq"); ?>" ><?php echo $i+1; ?></a></li><?php
							}
							else{
								?><li class="done"><a class="btn" href="<?php echo site_url("rfq/".$type."/".($step-1)); ?>" ><?php echo $i+1; ?></a></li><?php
							}
						}
						else{
							?><li><a class="btn"><?php echo $i+1; ?></a></li><?php
						}
					}
				  }
				  ?>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-frame">
					<?php
					echo $content;
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-frame">
					<?php
					include_once(dirname(__FILE__)."/rfqsummary.php");
					?>
				</div>
			</div>
		</div>
	</section>
</div>