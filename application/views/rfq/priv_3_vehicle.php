<style>
.dependents{
	display:none;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>Vehicle Details</h2>

	</div>
</div>
<div class="row">
	
	<?php
	$this->load->view("rfq/_packing_vehicle.php")
	?>
	<form class="form-horizontal" method="post" action="<?php echo site_url("rfq/".$type."/4"); ?>">
		<input type="hidden" name="cargo_details" value="vehicle">
		<div class="col-md-12">
			<script>
			function vehicleType(val){
				if(val!="Other"){
					jQuery("#specify_vehicle").hide();
				}
				else{
					jQuery("#specify_vehicle").show();
				}
			}
			</script>
			<div class="form-group">
				<label class="col-sm-3 control-label">Type of Vehicle/Boat</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='type_of_vehicle' onchange="vehicleType(this.value)">
                                                <option value="">Please select</option>
						<optgroup label="Land Vehicle">
							<option value="Personal Car">Personal Car</option>
							<option value="Truck">Truck</option>
							<option value="Van">Van</option>
							<option value="Motorcycle">Motorcycle</option>
							<option value="Agricultural or specialized Vehicles">Agricultural or specialized Vehicles</option>
							<option value="Car - Other">Other</option>
						</optgroup>
						<optgroup label="Boat">
							<option value="Sailboat">Sailboat</option>
							<option value="Powerboat">Powerboat</option>
							<option value="Dinghy">Dinghy</option>
							<option value="Yacht">Yacht</option>
						</optgroup>
						<option value="Other">Other</option>
					</select>
					<input type="text" class="form-control" id="specify_vehicle" name="specify_vehicle" style="display:none" placeholder="Please specify vehicle type">
				</div>
			</div>
			<script>
			function inContainer(val){
				jQuery(".in_container").hide()
				jQuery(".in_container .form-control").attr("disabled", true);
				if(val=="Yes"){
					jQuery("#container_size").show();
					jQuery("#container_size .form-control").attr("disabled", false);
					jQuery("#container_count").show();
					jQuery("#container_count .form-control").attr("disabled", false);
					jQuery("#container_type").show();
					jQuery("#container_type .form-control").attr("disabled", false);
				}
				else{
					jQuery("#packing").show();
					jQuery("#packing .form-control").attr("disabled", false)
					jQuery("#packing_more").show();
					jQuery("#packing_more .form-control").attr("disabled", false)
				}
			}
			</script>
			<div class="form-group" id="in_container">
				<label class="col-sm-3 control-label">Vehicle already in container?</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='in_container' onchange="inContainer(this.value)" >
						<option value="">Please select</option>
                                                <option value='Yes'>Yes</option>
						<option value='No'>No</option>
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
                        <option value="">Please select</option>
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
			<div class="form-group dependents in_container" id="container_type" >
				<label class="col-sm-3 control-label">Type of Container</label>
				<div class="col-sm-9">
					<select type="text" class="form-control" name='container_type' >
						<option value="">Please select</option>
						<option value='Platforms'>Platforms</option>
						<option value='Ventilated Containers'>Ventilated Containers</option>
						<option value='Insulated'>Insulated</option>
						<option value='Refrigerated'>Refrigerated</option>
						<option value='Bulk Containers'>Bulk Containers</option>
						<option value='Tank Containers'>Tank Containers</option>
					</select>
				</div>
			</div>
			<div class="form-group dependents in_container" id="container_count" >
				<label class="col-sm-3 control-label">Number of containers?</label>
				<div class="col-sm-9">
					<input id="number_of_containers" class="form-control" type="text" value="1">
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
			inContainer("No");
		</script>
		<script>
			populatePacking();
			function validateStep3(){
                            
                            /* @start :
                             * Include checking on fields.
                             * 
                             * @author tuso@programmerspride.com
                             * */
                            var type_of_vehicle = jQuery("select[name='type_of_vehicle']");
                            var in_container = jQuery("select[name='in_container']");
                            var container_size_select = jQuery('#container_size_select');
                            
                            if(! jQuery.trim(type_of_vehicle.val())) {
                                
                                alert("Please select type of vehicle.");
                                type_of_vehicle.focus();
                                return false;
                            } else if(! jQuery.trim(in_container.val())) {
                                
                                alert("Please select when goods already in container?");
                                in_container.focus();
                                return false;
                            } else if(jQuery.trim(in_container.val().toLowerCase()) === 'yes') {
                                
                                if(! jQuery.trim(container_size_select.val())) {
                                    
                                    alert("Please select container size.");
                                    container_size_select.focus();
                                    return false;
                                }
                            } // @end.
                            
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