<div class="row">
	<div class="col-sm-6">
		<h1>Get the best freight rates !</h1>
		<p>Fill in the form to receive individual quotation for your delivery!</p>
	</div>
	<div class="col-sm-6">
		<ul class="nav nav-steps">
		  <li><span>Step:</span></li>
		  <li class="active"><a href="<?php echo site_url("rfq"); ?>" class="btn">1</a></li>
		  <li><a class="btn">2</a></li>
		  <li><a class="btn">3</a></li>
		  <li><a class="btn">4</a></li>
		</ul>
	</div>
</div>
<div class="row">
  <div class="col-sm-12 text-center question">
	<h2 class="question-title">What type of customer are you ?</h2>
	<p data-toggle="buttons" class="consumer-type">
	  <label class="btn btn-transculent btn-lg" onclick='self.location="<?php echo site_url("rfq/priv"); ?>"' >
		<input type="radio" name="options" id="option2" > Private Consumer
	  </label>
	  <label class="btn btn-transculent btn-lg" onclick='self.location="<?php echo site_url("rfq/prof"); ?>"'>
		<input type="radio" name="options" id="option1"> Professional Consumer
	  </label>
	</p>
  </div>
</div>