<?php
//echo "<pre>";
//print_r($rfq);
?>
<style>
#container {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 5px;
    box-shadow: 0 4px 18px #C8C8C8;
    margin: auto;
	margin-top:10px;
}
body{
	background:#f0f0f0;
}
/*
tr.contact_info { display: none }
*/
</style>
<script>
function bid(){
	self.location="<?php echo site_url("lp/rfq")."/".$rfq['id']."/bid"; ?>";
}

/* @start:  Toggle contact information.
 * @author: tuso@programmerspride.com
 * */
jQuery(function() {
    jQuery('#contact_info_trigger').click(function() {
		<?php
		if($credits>0){
			?>
			if(confirm("Viewing this contact will deduct <?php echo $credits; ?> SeaDex Credits. Are you sure you want to view the contact details?")){
				self.location='?view';
			}
			<?php
		}
		else{
			?>
			self.location='?view';
			<?php
		}
		?>
        /*
		var ctr = 0; var trigger = jQuery(this);
        jQuery('tr.contact_info').toggle(400, function() {
            ctr++;
            if(ctr == 1) { // Perform only once.
                if(jQuery('tr.contact_info :first').is(':hidden')) trigger.removeClass('btn-primary');
                else {
                    trigger.addClass('btn-primary');
                    app.view();
                }
            }
        });
		*/
    });
    
    var app = {
        
        // Logs the view activity in the DBase.
        view : function() {
            jQuery.ajax({
                type : 'POST',
                data : {
                    rfq_id : '<?php echo $rfq['id']?>',
                    t : (new Date).getTime()
                },
                url : '<?php echo site_url('activity/async_contact_views')?>'
            });
        }
    };
	
	<?php
	if(isset($view)){
		?>
		app.view();
		<?php
	}
	?>
}); // @end.
</script>

<?php 
//echo "<pre>";
//print_r($rfq);
//echo "</pre>";
if($rfq['userprofile']['firstname']){
	$rfq['userprofile']['first_name'] = $rfq['userprofile']['firstname'];
}
if($rfq['userprofile']['first_name']){
	$rfq['userprofile']['firstname'] = $rfq['userprofile']['first_name'];
}

if($rfq['userprofile']['lastname']){
	$rfq['userprofile']['last_name'] = $rfq['userprofile']['lastname'];
}
if($rfq['userprofile']['last_name']){
	$rfq['userprofile']['lastname'] = $rfq['userprofile']['last_name'];
}

if($rfq['userprofile']['contactnumber']){
	$rfq['userprofile']['contact_number'] = $rfq['userprofile']['contactnumber'];
}
if($rfq['userprofile']['contact_number']){
	$rfq['userprofile']['contactnumber'] = $rfq['userprofile']['contact_number'];
}
?>
<div class="container-fluid" id="container" style="max-width:90%">
	<?php include_once(dirname(__FILE__)."/credits.php"); ?>
	<div class="row">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-8 text-right">
                        <input type="button" class="btn btn-default" style="margin:20px; margin-top:0px;" value="Back to Dashboard" onclick="self.location='<?php echo site_url("lp") ?>'">
			<input type="button" class="btn btn-primary btn-default" style="margin:20px; margin-top:0px;" value="Bid on this RFQ" onclick="bid()">
			<?php
			if($rfqprevid){
				?><input type="button" class="btn btn-default" style="margin:20px; margin-top:0px;" value="Previous RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqprevid ?>'"><?php
			}
			if($rfqnextid){
				?><input type="button" class="btn btn-default" style="margin:20px; margin-top:0px;" value="Next RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqnextid ?>'"><?php
			}
			?>
		</div>
	</div>
	<style>
	.contact_info{
		display:auto;
	}
	</style>
	<div class="row">
		<div class="col-md-12 text-left">
			<table class="table table-bordered">
				<tr>
					<th colspan=2 class="text-center"  style="background:#0E202E; color: white;">
						RFQ # <?php echo $rfq['id'] ?>
					</th>
				</tr>
				<?php
				$t = count($rfq['cargo']);
				if($t){
					?>
					<!--
					<tr>
						<th colspan=2 class="text-center" style="background:#f0f0f0">
						Cargo
						</th>
					</tr>
					-->
					<tr>
						<td colspan=2 style="background:#fafafa">
							
							<?php
							foreach($rfq['cargo'] as $i => $cargo){
								?>
								<table class="table table-bordered">
								<tr>
									<th width="50%">Cargo Type</th>
									<td width="50%">
									<?php echo $cargo['what_to_move']; ?>&nbsp;
									</td>
								</tr>
								<tr>
									<th colspan=2>Cargo Details</th>
								</tr>
								<tr>
									<td colspan=2>
										<?php 
											if(!$cargo['details']){
												echo "<center><strong>...</strong></center>";
											}
											else{
												//echo "<pre>";
												//print_r($cargo['details']);
												//echo "</pre>";
												if($cargo['details']['cargo_details']=="household"){
													?>
													
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">What to Move</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_move'];
														?></td>
													</tr>
													<?php
													if($cargo['details']['type_of_move']=="Full house/home move"){
														?>
														<tr>
															<th>House Size</th>
															<td>
															<?php
															echo $cargo['details']['fullhouse_size'];
															?></td>
														</tr>
														<?php
													}
													else if($cargo['details']['type_of_move']=="Pieces of Furniture"){
														?>
														<tr>
															<th>In Container</th>
															<td>
															<?php
															echo $cargo['details']['in_container'];
															?></td>
														</tr>
														<?php
														if($cargo['details']['in_container']=="Yes"){
															?>
															<tr>
																<th>Container Size</th>
																<td>
																<?php
																echo $cargo['details']['container_size'];
																?></td>
															</tr>
															<?php
															if(trim($cargo['details']['container_type'])){
																?>
																<tr>
																	<th>Container Type</th>
																	<td>
																	<?php
																	echo $cargo['details']['container_type'];
																	?></td>
																</tr>
																<?php
																}
															?>
															<tr>
																<th>Number of Containers</th>
																<td>
																<?php
																if(!trim($cargo['details']['number_of_containers'])){
																	echo "1";
																}
																else{
																	echo $cargo['details']['number_of_containers'];
																}
																?></td>
															</tr>
															<?php
														}
														else{
															$t = count($cargo['details']['packing']['name']);
															for($i=0; $i<$t; $i++){
																?>
																<tr>
																	<th colspan=2>
																	Packing - <?php echo $cargo['details']['packing']['name'][$i];
																	if(trim($cargo['details']['packing']['specify'][$i])){
																		echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																	}
																	?>
																	</th>
																</tr>
																<tr>
																	<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																	?>
																	<td colspan=2>
																	<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?></i><br />
																	<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																	</td>
																</tr>
																<?php
															}
														}
													}
													else if($cargo['details']['type_of_move']=="Other"){
														?>
														<tr>
															<td colspan=2>
															<?php
															echo htmlentities($cargo['details']['other_specify']);
															?></td>
														</tr>
														<?php
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
												else if($cargo['details']['cargo_details']=="goods"){
													?>
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">Category</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_goods'];
														?></td>
													</tr>
													<?php
													if(trim($cargo['details']['description'])){
														?>
														<tr>
															<th width="50%">Description</th>
															<td width="50%">
															<?php
															echo $cargo['details']['description'];
															?></td>
														</tr>
														<?php
													}
													if(trim($cargo['details']['imo_code'])){
														?>
														<tr>
															<th width="50%">IMO CODE</th>
															<td width="50%">
															<?php
															echo $cargo['details']['imo_code'];
															?></td>
														</tr>
														<?php
													}
													if($cargo['details']['in_container']=="Yes"){
														?>
														<tr>
															<th>Container Size</th>
															<td>
															<?php
															echo $cargo['details']['container_size'];
															?></td>
														</tr>
														<?php
														if(trim($cargo['details']['container_type'])){
															?>
															<tr>
																<th>Container Type</th>
																<td>
																<?php
																echo $cargo['details']['container_type'];
																?></td>
															</tr>
															<?php
															}
														?>
														<tr>
															<th>Number of Containers</th>
															<td>
															<?php
															if(!trim($cargo['details']['number_of_containers'])){
																echo "1";
															}
															else{
																echo $cargo['details']['number_of_containers'];
															}
															?></td>
														</tr>
														<?php
													}
													else{
														if($cargo['details']['item_in']){
															?>
															<tr>
																<th>Item In</th>
																<td>
																<?php
																echo $cargo['details']['item_in'];
																?></td>
															</tr>
															<tr>
																<th>Item number</th>
																<td>
																<?php
																echo $cargo['details']['item_number'];
																?></td>
															</tr>
															<?php
														}
														$t = count($cargo['details']['packing']['name']);
														for($i=0; $i<$t; $i++){
															?>
															<tr>
																<th colspan=2>
																Packing - <?php echo $cargo['details']['packing']['name'][$i];
																if(trim($cargo['details']['packing']['specify'][$i])){
																	echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																}
																?>
																</th>
															</tr>
															<tr>
																<td colspan=2>
																<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																?>
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?>
																	</i><br />
																	<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																</td>
															</tr>
															<?php
														}
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
												else if($cargo['details']['cargo_details']=="vehicle"){
													?>
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">Type of Vehicle</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_vehicle'];
														?></td>
													</tr>
													<?php
													if($cargo['details']['in_container']=="Yes"){
														?>
														<tr>
															<th>Container Size</th>
															<td>
															<?php
															echo $cargo['details']['container_size'];
															?></td>
														</tr>
														<?php
														if(trim($cargo['details']['container_type'])){
															?>
															<tr>
																<th>Container Type</th>
																<td>
																<?php
																echo $cargo['details']['container_type'];
																?></td>
															</tr>
															<?php
															}
														?>
														<tr>
															<th>Number of Containers</th>
															<td>
															<?php
															if(!trim($cargo['details']['number_of_containers'])){
																echo "1";
															}
															else{
																echo $cargo['details']['number_of_containers'];
															}
															?></td>
														</tr>
														<?php
													}
													else{
														
														$t = count($cargo['details']['packing']['name']);
														for($i=0; $i<$t; $i++){
															?>
															<tr>
																<th colspan=2>
																Packing - <?php echo $cargo['details']['packing']['name'][$i];
																if(trim($cargo['details']['packing']['specify'][$i])){
																	echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																}
																?>
																</th>
															</tr>
															<tr>
																<td colspan=2>
																<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																?>
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?>
																	</i><br />
																<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																</td>
															</tr>
															<?php
														}
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
											}
										?>
									</td>
								</tr>
								</table>
								<?php
							}
							?>
							
						</td>
					</tr>
					
					<?php
				}
				
				if(isset($rfq['shipping_info'])){
					?>
					<tr>
						<th colspan=2 class="text-center"  style="background:#0E202E; color: white;">
						Shipping Information
						</th>
					</tr>
					<tr>
						<td colspan=2  style="background:#fafafa">
							<table class="table table-bordered">
								<tr>
									<th width="50%">Origin</th>
									<th width="50%">Destination</th>
								</tr>
								<tr>
									<td width="50%"><b>Country:</b> <?php echo $rfq['shipping_info']['origin']['country']; ?></td>
									<td width="50%"><b>Country:</b> <?php echo $rfq['shipping_info']['destination']['country']; ?></td>
								</tr>
								<tr>
									<td width="50%"><b>City:</b> <?php echo $rfq['shipping_info']['origin']['city']; ?></td>
									<td width="50%"><b>City:</b> <?php echo $rfq['shipping_info']['destination']['city']; ?></td>
								</tr>
								<tr>
									<td width="50%"><b>Port:</b> <?php echo $rfq['shipping_info']['origin']['port']; ?></td>
									<td width="50%"><b>Port:</b> <?php echo $rfq['shipping_info']['destination']['port']; ?></td>
								</tr>
								<tr>
									<td width="50%"><b>Pickup Date (m/d/y):</b> <?php echo $rfq['shipping_info']['origin']['date']; ?></td>
									<td width="50%"><b>Delivery Date (m/d/y):</b> <?php echo $rfq['shipping_info']['destination']['date']; ?></td>
								</tr>
								<tr>
									<td width="50%"><b>Alternate Pickup Date:</b> <?php echo $rfq['shipping_info']['origin']['alternate_date']; ?></td>
									<td width="50%"><b>Alternate Delivery Date:</b> <?php echo $rfq['shipping_info']['destination']['alternate_date']; ?></td>
								</tr>
								<!--
								<tr>
									<td width="50%"><?php echo $rfq['shipping_info']['origin']['time_zone']; ?> GMT</td>
									<td width="50%"><?php echo $rfq['shipping_info']['destination']['time_zone']; ?>  GMT</td>
								</tr>
								-->
							</table>
							<style>
								#map-canvas {
								width: 500px;
								height:300px;
								margin: auto;
								padding: 0px
							  }
							</style>
							<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
							<script>
							function initialize() {
							  var myLatlng = new google.maps.LatLng(<?php echo $rfq['shipping_info']['origin']['port_coords']['lat']; ?>,<?php echo $rfq['shipping_info']['origin']['port_coords']['lon']; ?>);
							  
							  //var myLatlngX = new google.maps.LatLng(<?php echo $rfq['shipping_info']['origin']['port_coords']['lat']-$rfq['shipping_info']['destination']['port_coords']['lat']; ?>,<?php echo $rfq['shipping_info']['origin']['port_coords']['lon']-$rfq['shipping_info']['destination']['port_coords']['lon']; ?>);
							  
							  var mapOptions = {
								zoom: 2,
								center: myLatlng
							  }
							  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

							  
							  var marker = new google.maps.Marker({
								  position: myLatlng,
								  map: map,
								  title: "<?php echo htmlentitiesX($rfq['shipping_info']['origin']['port_coords']['name']); ?>"
							  });
							  
							  var myLatlng2 = new google.maps.LatLng(<?php echo $rfq['shipping_info']['destination']['port_coords']['lat']; ?>,<?php echo $rfq['shipping_info']['destination']['port_coords']['lon']; ?>);
							  var marker2 = new google.maps.Marker({
								  position: myLatlng2,
								  map: map,
								  title: "<?php echo htmlentitiesX($rfq['shipping_info']['destination']['port_coords']['name']); ?>"
							  });
							 
							}

							google.maps.event.addDomListener(window, 'load', initialize);
							</script>
							<div id="map-canvas" ></div>
							
							
						</td>
					</tr>
					<?php
				}
				
				if($message){
					?>
					<tr><td colspan="2" style="text-align: center; color:green">
					<?php 
					echo $message;
					?>
					</td></tr>
					<?php
				}
				if($error){
					?>
					<tr><td colspan="2" style="text-align: center; color:red">
					<?php 
					echo $error;
					?>
					</td></tr>
					<?php
				}
				if(!isset($view)){
					?>
					<tr><td colspan="2" style="text-align: center">
					<input type="button" class="btn btn-default" style="margin:20px;" value="<?php echo $viewcontact; ?>" id="contact_info_trigger" />
					<?php
					if(isset($buy)){
						echo "<div style='padding-bottom:20px'>".$buy."</div>";
					}
					?>
					</td></tr>
					<?php
				}
				?>
				
				<?php
				if(isset($view)){
					?>
					<tr>
						<th colspan=2 class="text-center"  style="background:#0E202E; color: white;">
						Customer Contact Information
						</th>
					</tr>
					<tr class="contact_info">
						<th width="50%">Customer Type</th>
						<td width="50%"><?php echo ucfirst($rfq['customer_type']); ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">E-mail</th>
						<td width="50%"><?php echo $rfq['userprofile']['email']; ?></td>
					</tr>
					<?php
					if($rfq['userprofile']['company_name']){
						?>
						<tr class="contact_info">
							<th width="50%">Company Name</th>
							<td width="50%"><?php echo $rfq['userprofile']['company_name']; ?></td>
						</tr>
						<?php
					}
					?>
					<tr class="contact_info">
						<th width="50%">First Name</th>
						<td width="50%"><?php echo $rfq['userprofile']['firstname']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Last Name</th>
						<td width="50%"><?php echo $rfq['userprofile']['lastname']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Country</th>
						<td width="50%"><?php echo $rfq['userprofile']['country']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Contact Number</th>
						<td width="50%"><?php echo $rfq['userprofile']['contactnumber']; ?></td>
					</tr>
					<?php
					if(isset($rfq['shipping_info']['type_of_company_to_quote'])){
						?>
						<tr class="contact_info">
							<th width="50%">RFQ for</th>
							<td width="50%">
							<?php echo $rfq['shipping_info']['type_of_company_to_quote']; ?>
							</td>
						</tr>
						<?php
					}
				}
				
				?>
				<tr>
					<td colspan=2 class="text-center">
						<input type="button" class="btn btn-default" style="margin:20px;" value="Back to Dashboard" onclick="self.location='<?php echo site_url("lp") ?>'">
						<input type="button" class="btn btn-primary btn-default" style="margin:20px;" value="Bid on this RFQ" onclick="bid()">
						<?php
						if($rfqprevid){
							?><input type="button" class="btn btn-default" style="margin:20px;" value="Previous RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqprevid ?>'"><?php
						}
						if($rfqnextid){
							?><input type="button" class="btn btn-default" style="margin:20px;" value="Next RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqnextid ?>'"><?php
						}
						?>
					</td>
				</tr>
			</table>
			<?php
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			?>
		</div>
	</div>

</div>