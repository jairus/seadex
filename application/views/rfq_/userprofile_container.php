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
<section class="container"  style="padding-bottom:50px;">
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