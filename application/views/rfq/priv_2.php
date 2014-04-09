<div class="row">
	<div class="col-md-12">
		<h2>What type of cargo do you want to move?</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<form action="<?php echo site_url("rfq/".$type."/3"); ?>" method="post" >
			<?php
			if($type=='priv'){
				?><button type="submit" class="btn btn-default btn-lg" name="what_to_move" value="Household" >Household</button><?php
			}
			?>
			<button type="submit" class="btn btn-default btn-lg" name="what_to_move" value="Goods" >Goods</button>
			<button type="submit" class="btn btn-default btn-lg" name="what_to_move" value="Vehicle or Boat" >Vehicle or Boat</button>
		</form>
	</div>
</div>
<div class="row">
	<?php
	if(isset($backbutton)){
		?>
		<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type.""); ?>'">Back</button>
			<?php
			if(isset($skip)||isset($new)){
				?>
					<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button>
				<?php
			}
			?>
		</div>
		<?php
	}
	else{
		?>
		<div class="col-md-12 backbutton text-center">
			<?php
			if(isset($skip)||isset($new)){
				?>
					<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button>
				<?php
			}
			?>
		</div>
		<?php
	}
	
	?>	
</div>