<style>
.dependents{
	display:none;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>Goods Details</h2>
		Tip: Goods are anything you would like to ship that is not a typical household move or a 

vehicle/boat. Bulk items such as engines, parts, presents, bicycles etc are goods.<br /><br />
	</div>
</div>
<div class="row">
	
	<?php
	$this->load->view("rfq/_packing.php")
	?>
	<form class="form-horizontal" method="post" action="<?php echo site_url("rfq/".$type."/4"); ?>">
		<input type="hidden" name="cargo_details" value="goods">
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-sm-3 control-label">Category</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='type_of_goods'>
						<option value="General">General</option>
						<option value="Electrical Items">Electrical Items</option>
						<option value="Special Care Items">Special Care Items</option>
						<option value="Parcel Delivery">Parcel Delivery</option>
						<option value="Vehicle Parts">Vehicle Parts</option>
						<option value="Other">Other</option>
					</select>
					
					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Describe your goods</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description"></textarea>
				</div>
			</div>
			<script>
			function isDangerous(s){
				jQuery(".dangerous").hide();
				jQuery(".dangerous .form-control").attr("disabled", true);
				if(s=="yes"){
					jQuery(".dangerous").show();
					jQuery(".dangerous .form-control").attr("disabled", false);
				}
			}
			</script>
			<div class="form-group">
				<label class="col-sm-3 control-label">Is Dangerous Goods?</label>
				<div class="col-sm-1">
					<input type="radio" class="form-control" value="Yes" name="dangerous" onclick="isDangerous('yes')" />Yes
				</div>
				<div class="col-sm-1">
					<input type="radio" class="form-control" value="No" name="dangerous" onclick="isDangerous('no')" checked  />No
				</div>
				<div class="col-sm-7"></div>
			</div>
			<div class="form-group dangerous">
				<label class="col-sm-3 control-label">Please specify IMO CODE</label>
				<div class="col-sm-9">
					<!--<input type="text" class="form-control" name="imo_code" placeholder="e.g. Class 3: Flammable liquids" />-->
					<select name="imo_code" class="form-control" id="imo_code">
						<option value="Subclass 1.1: Explosives with a mass explosion hazard">Subclass 1.1: Explosives with a mass explosion hazard</option>
						<option value="Subclass 1.2: Explosives with a severe projection hazard">Subclass 1.2: Explosives with a severe projection hazard</option>
						<option value="Subclass 1.3: Explosives with a fire">Subclass 1.3: Explosives with a fire</option>
						<option value="Subclass 1.4: Minor fire or projection hazard">Subclass 1.4: Minor fire or projection hazard</option>
						<option value="Subclass 1.5: An insensitive substance with a mass explosion hazard">Subclass 1.5: An insensitive substance with a mass explosion hazard</option>
						<option value="Subclass 1.6: Extremely insensitive articles">Subclass 1.6: Extremely insensitive articles</option>
						<option value="Subclass 2.1: Flammable Gas">Subclass 2.1: Flammable Gas</option>
						<option value="Subclass 2.2: Non-Flammable Gases">Subclass 2.2: Non-Flammable Gases</option>
						<option value="Subclass 2.3: Poisonous Gases">Subclass 2.3: Poisonous Gases</option>
						<option value="Class 3:Flammable Liquids">Class 3:Flammable Liquids</option>
						<option value="Subclass 4.1: Flammable solids">Subclass 4.1: Flammable solids</option>
						<option value="Subclass 4.2: Spontaneously combustible solids">Subclass 4.2: Spontaneously combustible solids</option>
						<option value="Subclass 4.3: Dangerous when wet">Subclass 4.3: Dangerous when wet</option>
						<option value="Subclass 5.1: Oxidizing agent">Subclass 5.1: Oxidizing agent</option>
						<option value="Subclass 5.2: Organic peroxide oxidizing agent">Subclass 5.2: Organic peroxide oxidizing agent</option>
						<option value="Subclass 6.1: Poison">Subclass 6.1: Poison</option>
						<option value="Subclass 6.2: Biohazard">Subclass 6.2: Biohazard</option>
						<option value="Class 7:Radioactive substances">Class 7:Radioactive substances</option>
						<option value="Class 8:Corrosive substances">Class 8:Corrosive substances</option>
						<option value="Class 9:Miscellaneous dangerous substances and articles">Class 9:Miscellaneous dangerous substances and articles</option>
					</select>
				</div>
			</div>
			<script>
			isDangerous('no');
			function inContainer(val){
				jQuery(".in_container").hide()
				jQuery(".in_container .form-control").attr("disabled", true);
				if(val=="Yes"){
					jQuery("#container_size").show();
					jQuery("#container_size .form-control").attr("disabled", false)
				}
				else{
					jQuery("#item_in").show();
					jQuery("#item_in .form-control").attr("disabled", false);
					jQuery("#item_number").show();
					jQuery("#item_number .form-control").attr("disabled", false);
					jQuery("#packing").show();
					jQuery("#packing .form-control").attr("disabled", false)
					jQuery("#packing_more").show();
					jQuery("#packing_more .form-control").attr("disabled", false)
				}
			}
			</script>
			<div class="form-group" id="in_container">
				<label class="col-sm-3 control-label">Goods already in container?</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='in_container' onchange="inContainer(this.value)" >
						<option value='Yes'>Yes</option>
						<option value='No'selected>No</option>
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
			<script>
			function itemIn(inx){
				jQuery(".item_number").hide();
				jQuery(".item_number .form-control").attr("disabled", true);
				jQuery("#item_in").show();
				jQuery("#item_in .form-control").attr("disabled", false)
				if(inx!=""){
					jQuery("#item_number").show();
					jQuery("#item_number .form-control").attr("disabled", false)
				}
				else{
					jQuery("#packing").show();
					jQuery("#packing .form-control").attr("disabled", false)
					jQuery("#packing_more").show();
					jQuery("#packing_more .form-control").attr("disabled", false)
				}
				
			}
			</script>
			<div class="form-group dependents in_container" id="item_in">
				<label class="col-sm-3 control-label">Is item listed on</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='item_in' onchange="itemIn(this.value)" >
						<option value="E-bay">E-bay</option>
						<option value="Finn.no">Finn.no</option>
						<option value="Alibaba">Alibaba</option>
						<option value="">Not in any of the sites mentioned</option>
					</select>
				</div>
			</div>
			<div class="form-group dependents in_container item_number" id="item_number">
				<label class="col-sm-3 control-label">Item or Tracking Number:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="item_number" id="the_item_number" />
				</div>
				<!--
				<div class="col-sm-3">
					<input type="button" class="form-control" value="Fetch Item Data" onclick="fetchItemData()" />
				</div>
				-->
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
		</div>
		<script>
			inContainer("No");
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
			<button type="submit" class="btn btn-primary btn-lg" onclick="return validateStep3()">Continue</button>
		</div>
	</form>
</div>