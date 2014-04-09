<style>
.dotted tbody tr td{
	border-style:dashed;
}
.dotted tbody tr th{
	border-style:dashed;
}
.dotted{
	border-style:dashed;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<div class="starter-template">
				<div class="center-block img-rounded" id="form-quote">
					<?php
					echo $content;
					?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<?php
			include_once(dirname(__FILE__)."/rfqsummary.php");
			?>
		</div>
	</div>
</div>