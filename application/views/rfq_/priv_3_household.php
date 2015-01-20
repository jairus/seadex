<style>
.dependents{
	display:none;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>Household Details</h2>
	</div>
</div>
<div class="row">
	<script>
	function moveType(type){
		jQuery(".dependents").hide();
		jQuery(".dependents .form-control").attr("disabled", true);
		if(type=="Full house/home move"){
			jQuery("#fullhouse_size").show();
			jQuery("#fullhouse_size .form-control").attr("disabled", false)
		}
		else if(type=="Pieces of Furniture"){
			jQuery("#in_container").show();
			jQuery("#in_container .form-control").attr("disabled", false)
			jQuery("#container_size").show();
			jQuery("#container_size .form-control").attr("disabled", false)
			inContainer("No");
		}
		else{
			jQuery("#other").show();
			jQuery("#other .form-control").attr("disabled", false)
		}
	}
	</script>
	<?php
	$this->load->view("rfq/_packing.php")
	?>
	<form class="form-horizontal" method="post" action="<?php echo site_url("rfq/".$type."/4"); ?>">
		<input type="hidden" name="cargo_details" value="household">
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-sm-3 control-label">Type of move</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='type_of_move' onchange="moveType(this.value)">
						<option value='Full house/home move' >Full house/home move</option>
						<option value='Pieces of Furniture'>Pieces of Furniture</option>
						<option value='Other'>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group dependents" id="fullhouse_size">
				<label class="col-sm-3 control-label">Size</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='fullhouse_size' >
						<option value='Studio Apartment (600 sq ft / 320 cu ft or 56 sq m / 9 cu m)'>Studio Apartment (600 sq ft / 320 cu ft or 56 sq m / 9 cu m)</option>
						<option value='1 Bedroom (800 sq ft / 432 cu ft or 74 sq m / 12 cu m)'>1 Bedroom (800 sq ft / 432 cu ft or 74 sq m / 12 cu m)</option>
						<option value='1-2 Bedroom (1,200 sq ft / 720 cu ft or 111 sq m / 20 cu m)'>1-2 Bedroom (1,200 sq ft / 720 cu ft or 111 sq m / 20 cu m)</option>
						<option value='2-3 Bedroom (1,350 sq ft / 864 cu ft or 125 sq m / 24 cu m)'>2-3 Bedroom (1,350 sq ft / 864 cu ft or 125 sq m / 24 cu m)</option>
						<option value='3 Bedroom (1,650 sq ft / 1,152 cu ft or 153 sq m / 33 cu m)'>3 Bedroom (1,650 sq ft / 1,152 cu ft or 153 sq m / 33 cu m)</option>
						<option value='3 Bedroom Plus (1,900 sq ft / 1,368 cu ft or 177 sq m / 39 cu m)'>3 Bedroom Plus (1,900 sq ft / 1,368 cu ft or 177 sq m / 39 cu m)</option>
						<option value='4 Bedroom (2,100 sq ft / 2,016 cu ft or 195 sq m / 57 cu m)'>4 Bedroom (2,100 sq ft / 2,016 cu ft or 195 sq m / 57 cu m)</option>
						<option value='4 Bedroom Plus (3,000 sq ft / 3,500 cu ft or 279 sq m / 99 cu m)'>4 Bedroom Plus (3,000 sq ft / 3,500 cu ft or 279 sq m / 99 cu m)</option>
					</select>
				</div>
			</div>
			<script>
			function inContainer(val){
				jQuery(".in_container").hide()
				jQuery(".in_container .form-control").attr("disabled", true);
				if(val=="Yes"){
					jQuery("#container_size").show();
					jQuery("#container_size .form-control").attr("disabled", false)
				}
				else{
					jQuery("#packing").show();
					jQuery("#packing .form-control").attr("disabled", false)
					jQuery("#packing_more").show();
					jQuery("#packing_more .form-control").attr("disabled", false)
				}
			}
			</script>
			<div class="form-group dependents" id="in_container">
				<label class="col-sm-3 control-label">Goods already in container?</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='in_container' onchange="inContainer(this.value)" >
						<option value='Yes'>Yes</option>
						<option value='No' selected>No</option>
					</select>
				</div>
			</div>
			<div class="form-group dependents in_container" id="container_size">
				<label class="col-sm-3 control-label">Size of container?</label>
				<div class="col-sm-9">
					<script>
					function containerSize(val){
						if(val=="Other"){
							jQuery("#container_size_select").attr("name", "");
							jQuery("#container_size_text").attr("name", "container_size");
							jQuery("#container_size_text").attr("disabled", false);
							jQuery("#container_size_text").show();
						}
						else{
							jQuery("#container_size_select").attr("name", "container_size");
							jQuery("#container_size_text").attr("name", "");
							jQuery("#container_size_text").attr("disabled", true);
							jQuery("#container_size_text").hide();
						}
					}
					</script>
					<select type="text" class="form-control" name='container_size' id="container_size_select" onchange="containerSize(this.value)" >
						<option value='20 ft'>20 ft / 6 m</option>
						<option value='40 ft'>40 ft / 12 m</option>
						<option value='45 ft'>45 ft / 13.7 m</option>
						<option value='Open top 20 ft'>Open top 20 ft / 6 m</option>
						<option value='Open top 40 ft'>Open top 40 ft / 12 m</option>
						<option value='Open top 45 ft'>Open top 45 ft / 13.7 m</option>
						<option value='Flatrack 20 ft'>Flatrack 20 ft / 6 m</option>
						<option value='Flatrack 40 ft'>Flatrack 40 ft / 12 m</option>
						<option value='Other'>Other (specify)</option>
					</select>
					<input id="container_size_text" class="form-control" type="text" disabled placeholder="Specify e.g. 20 ft , 6 meters" style="display:none">
				</div>
			</div>
			<div class="form-group dependents in_container" id="packing">
				<script>
				packingcount = 0;
				function populatePacking(){
					val = jQuery("#packing_type").val();
					jQuery("#packing_detail_label").html(val);
					jQuery("#packing_detail_name").val(val);
					jQuery("#packing_detail_name_specify").val("");
					jQuery("#packing_detail_name_specify").hide();
					jQuery("#packing_table").attr("title", "packing_table-"+packingcount);
					jQuery("#packing_type").attr("title", "packing-"+packingcount);
					jQuery("#packing_detail_name_specify").attr("title", "packing_specify-"+packingcount);
					html = jQuery("#packing_details").html();
					jQuery("#packing_more_details").append(html);
					jQuery("[title='packing_table-"+packingcount+"']").hide();
					jQuery("[title='packing_table-"+packingcount+"']").fadeIn(500);
					packingcount++;
					if(jQuery('#packing_more_details').children().length<=1){ 
						jQuery('.removepacking').hide()
					}
					else{
						jQuery('.removepacking').show()
					}
				}
				</script>
				<label class="col-sm-3 control-label">How are the goods packed?</label>
				<div class="col-sm-9" id="packing_more_details">
					
				</div>
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9 text-center"><button type="button" class="btn btn-sm" onclick="populatePacking()">Add More</button></div>
			</div>
			<div class="form-group dependents other" id="other">
				<label class="col-sm-12 ">Please specify:</label>
				<div class="col-sm-12" id="other_details">
					<textarea name="other_specify" class="form-control" placeholder="e.g. Dimension: House square ft/m X factor for Cubic needed for shipment"></textarea>
				</div>
			</div>
			<div class="form-group" id="additional_info">
				<label class="col-sm-3 control-label">Additional Information:</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="additional_info"></textarea>
				</div>
				<!--
				<div class="col-sm-3">
					<input type="button" class="form-control" value="Fetch Item Data" onclick="fetchItemData()" />
				</div>
				-->
			</div>
		</div>
		<script>
			
			moveType("Full house/home move");
			populatePacking();
			
			function validateStep3(){
				error= false;
				if(jQuery("#packing_more_details").is(":visible")){
					jQuery("#packing_more_details .packing_measurements").each(function(){
						//alert(this.disabled)
						val = jQuery.trim(jQuery(this).val());
						if(!val){
							error = true;
						}
					});
					if(error){
						alert("Please complete all measurements (length, width, height, weight).");
						return false;
					}
				}
				return true;
			}
		</script>
		<div class="col-md-12 backbutton text-center">
			<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/2"); ?>'">Back</button>
			<?php
			if($skipbutton){
				?><button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq/".$type."/4?skip=true"); ?>'">Skip</button><?php
			}
			?>
			<button type="submit" class="btn btn-primary btn-lg" onclick="return validateStep3(); ">Continue</button>
		</div>
	</form>
</div>