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
</style>
<script>
function setPort(idx){
	
	if(idx=="origin_port"){
		jQuery("#"+idx).val("<?php echo SDEncrypt($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>");
		}
	}
	else{
		jQuery("#"+idx).val("<?php echo SDEncrypt($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>");
		}
	}
	//alert(idx)
	//alert(jQuery("#"+idx).val());
}
function getPorts(idx, country_code, init){
	if(country_code){
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("rfq/getPorts"); ?>/"+escape(country_code),
		  data: "",
		  success: function(msg){
			jQuery("#"+idx).html(msg);
			if(init){
				setPort(idx);
			}
			else{
				calcDate();
			}
		  },
		  //dataType: dataType
		});
	}
}
function validDecimal(obj){
	if(obj.val() && isNaN(obj.val())){
		//alert("Please enter a valid number for your total bid price. e.g. 1000.00")
		//obj.val("0.00");
		//obj[0].focus();
	}
}
function moreAttachments(){
	jQuery("#attachments_container").append('<div style="padding-bottom:5px;"><input type="file" name="attachments[]" /></div>');
}
</script>
<?php 
//echo "<pre>";
//print_r($rfq);
//echo "</pre>";
$_SESSION['for_bidding']['rfq_id'] = $rfq['id'];

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

if($rfq['userprofile']['type']){
	$rfq['userprofile']['customer_type'] = $rfq['userprofile']['type'];
}
if($rfq['userprofile']['customer_type']){
	$rfq['userprofile']['type'] = $rfq['userprofile']['customer_type'];
}

$bid_data = unserialize(base64_decode($bids[0]['data']));


?>
<div class="container-fluid" id="container" style="max-width:90%">
	<div class="row">
		<div class="col-md-6">
			<h2>RFQ # <?php echo $rfq['id'] ?></h2>
		</div>
		<div class="col-md-6 text-right">
			<h2><a href="<?php echo site_url("cs")."/rfq/".$rfq['id']."/bids" ?>">Back to Bids</a></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-left">
			<table class="table table-bordered">
			<tr>
					<th colspan=2 class="text-center" style="background:#f0f0f0">
					Bid Summary
					</th>
				</tr>
				<tr>
					<td colspan=2>
						<table class="table table-bordered">
							<tr>
								<th width="33%">Company</th>
								<th width="33%">Total Bid</th>
								<th width="33%">
								<div class="row">
									<div class="col-sm-3">Total Bid in</div>
									<div class="col-sm-9">
										<select name="total_bid_currency" class="form-control" disabled>
											<option selected="selected" value="USD United States Dollars">
												USD United States Dollars
											</option>
											<option>
												EUR Euro
											</option>
											<option value="CAD Canada Dollars">
												CAD Canada Dollars
											</option>
											<option>
												GBP United Kingdom Pounds
											</option>
											<option>
												DEM Germany Deutsche Marks
											</option>
											<option>
												FRF France Francs
											</option>
											<option>
												JPY Japan Yen
											</option>
											<option>
												NLG Netherlands Guilders
											</option>
											<option>
												ITL Italy Lira
											</option>
											<option>
												CHF Switzerland Francs
											</option>
											<option>
												DZD Algeria Dinars
											</option>
											<option>
												ARP Argentina Pesos
											</option>
											<option>
												AUD Australia Dollars
											</option>
											<option>
												ATS Austria Schillings
											</option>
											<option>
												BSD Bahamas Dollars
											</option>
											<option>
												BBD Barbados Dollars
											</option>
											<option>
												BEF Belgium Francs
											</option>
											<option>
												BMD Bermuda Dollars
											</option>
											<option>
												BRR Brazil Real
											</option>
											<option>
												BGL Bulgaria Lev
											</option>
											<option>
												CAD Canada Dollars
											</option>
											<option>
												CLP Chile Pesos
											</option>
											<option>
												CNY China Yuan Renmimbi
											</option>
											<option>
												CYP Cyprus Pounds
											</option>
											<option>
												CSK Czech Republic Koruna
											</option>
											<option>
												DKK Denmark Kroner
											</option>
											<option>
												NLG Dutch Guilders
											</option>
											<option>
												XCD Eastern Caribbean Dollars
											</option>
											<option>
												EGP Egypt Pounds
											</option>
											<option>
												EUR Euro
											</option>
											<option>
												FJD Fiji Dollars
											</option>
											<option>
												FIM Finland Markka
											</option>
											<option>
												FRF France Francs
											</option>
											<option>
												DEM Germany Deutsche Marks
											</option>
											<option>
												XAU Gold Ounces
											</option>
											<option>
												GRD Greece Drachmas
											</option>
											<option>
												HKD Hong Kong Dollars
											</option>
											<option>
												HUF Hungary Forint
											</option>
											<option>
												ISK Iceland Krona
											</option>
											<option>
												INR India Rupees
											</option>
											<option>
												IDR Indonesia Rupiah
											</option>
											<option>
												IEP Ireland Punt
											</option>
											<option>
												ILS Israel New Shekels
											</option>
											<option>
												ITL Italy Lira
											</option>
											<option>
												JMD Jamaica Dollars
											</option>
											<option>
												JPY Japan Yen
											</option>
											<option>
												JOD Jordan Dinar
											</option>
											<option>
												KRW Korea (South) Won
											</option>
											<option>
												LBP Lebanon Pounds
											</option>
											<option>
												LUF Luxembourg Francs
											</option>
											<option>
												MYR Malaysia Ringgit
											</option>
											<option>
												MXP Mexico Pesos
											</option>
											<option>
												NLG Netherlands Guilders
											</option>
											<option>
												NZD New Zealand Dollars
											</option>
											<option>
												NOK Norway Kroner
											</option>
											<option>
												PKR Pakistan Rupees
											</option>
											<option>
												XPD Palladium Ounces
											</option>
											<option>
												PHP Philippines Pesos
											</option>
											<option>
												XPT Platinum Ounces
											</option>
											<option>
												PLZ Poland Zloty
											</option>
											<option>
												PTE Portugal Escudo
											</option>
											<option>
												ROL Romania Leu
											</option>
											<option>
												RUR Russia Rubles
											</option>
											<option>
												SAR Saudi Arabia Riyal
											</option>
											<option>
												XAG Silver Ounces
											</option>
											<option>
												SGD Singapore Dollars
											</option>
											<option>
												SKK Slovakia Koruna
											</option>
											<option>
												ZAR South Africa Rand
											</option>
											<option>
												KRW South Korea Won
											</option>
											<option>
												ESP Spain Pesetas
											</option>
											<option>
												XDR Special Drawing Right (IMF)
											</option>
											<option>
												SDD Sudan Dinar
											</option>
											<option>
												SEK Sweden Krona
											</option>
											<option>
												CHF Switzerland Francs
											</option>
											<option>
												TWD Taiwan Dollars
											</option>
											<option>
												THB Thailand Baht
											</option>
											<option>
												TTD Trinidad and Tobago Dollars
											</option>
											<option>
												TRL Turkey Lira
											</option>
											<option>
												GBP United Kingdom Pounds
											</option>
											<option>
												USD United States Dollars
											</option>
											<option>
												VEB Venezuela Bolivar
											</option>
											<option>
												ZMK Zambia Kwacha
											</option>
											<option>
												EUR Euro
											</option>
											<option>
												XCD Eastern Caribbean Dollars
											</option>
											<option>
												XDR Special Drawing Right (IMF)
											</option>
											<option>
												XAG Silver Ounces
											</option>
											<option>
												XAU Gold Ounces
											</option>
											<option>
												XPD Palladium Ounces
											</option>
											<option>
												XPT Platinum Ounces
											</option>
										</select>
									</div>
								</div>
								</th>
							</tr>
							<?php
							$t = count($bids);
							for($i=0; $i<$t; $i++){
								?>
								<tr>
									<td>
										<?php echo $bids[$i]['company_name'] ; ?>
									</td>
									<td>
										<?php 
										$currency = explode(" ", $bids[$i]['total_bid_currency'], 2);
										$currency_short = $currency[0];
										$currency_long = $currency[1];
										echo $currency_short." ";
										echo number_format($bids[$i]['total_bid'], 2, ".", ","); 
										echo " (".$currency_long.")";
										?>
									</td>
									<td>
										<?php
										$currency_short = "USD";
										$currency_long = "United States Dollars";
										$bid_equiv = $bids[$i]['total_bid_usd'];
										echo $currency_short." ";
										echo number_format($bid_equiv, 2, ".", ","); 
										echo " (".$currency_long.")";
										?>
									</td>
								</tr>
								<?php
							}
							?>
						</table>
						<?php
						$t = count($bid_data['files']['attachments']['name']);
						if(trim($bid_data['files']['attachments']['name'][0])==""){
							$t = 0;
						}
						
						if($t || trim($bid_data['additional_notes'])){
							?>
							<table class="table table-bordered">
								<tr>
									<?php
									if($t){
										?>
										<th style="width:50%">
											Attachments
										</th>
										<?php
									}
									if(trim($bid_data['additional_notes'])){
										?>
										<th style="width:50%">
											Additional Notes
										</th>
										<?php
									}
									?>
								</tr>
								<tr>
									<?php
									if($t){
										?>
										<td>
										<?php
										for($i=0; $i<$t; $i++){
											$url = site_url()."_uploads/bid_".$bids[0]['id']."/".urlencode($bid_data['files']['attachments']['name'][$i]);
											echo "<a href='".$url."' target='_blank'>".$bid_data['files']['attachments']['name'][$i]."</a><br>";
										}
										?>
										</td>
										<?php
									}
									if(trim($bid_data['additional_notes'])){
										?>
										<td>
											<?php
											echo nl2br(strip_tags($bid_data['additional_notes']));
											?>
										</td>
										<?php
									}
									?>
								</tr>
							</table>
							<?php
						}
						if($rfq['bid_id']<1){
							?>
							<script>
							function acceptBid(){
								jQuery("#acceptbutton").hide();
								jQuery("#acceptform").fadeIn(200);
							}
							</script>
							<div class="text-center" style="margin-bottom:30px;">
								<input id="acceptbutton" type="button" class="btn btn-default" value="Accept This Bid and Contact Service Provider" onclick="return acceptBid();" >
								<div id='acceptform' style="display:none; max-width:500px; margin:auto">
									<form class="form-horizontal" action="<?php echo site_url("cs")."/rfq/".$rfq['id']."/acceptbid?bid_id=".$_GET['bid_id']; ?>" method="post">
										<div class="row">Message</div>
										<div class="row"><textarea class="form-control" style="height:100px;" name="message" ><?php
										
										echo "Hello! I would like to inform you that I accepted your bid for my RFQ. Please don't hesitate to contact me on how to proceed from here and for further details.";
										
										?></textarea></div>
										<div class="row" style="margin-top:10px;"><input type="submit" value="Proceed" class="form-control btn btn-default" /></div>
									</form>
								</div>
							</div>
							<?php
						}
						else if($rfq['bid_id']==$bids[0]['id']){
							?>
							<div class="text-center" style="margin-bottom:30px; color:green">Accepted Bid</div>
							<?php
						}
						?>
					</td>
				</tr>
				
				<?php
				if(isset($rfq['shipping_info']['type_of_company_to_quote'])&&0){
					?>
					<tr>
						<th width="50%">RFQ for</th>
						<td width="50%">
						<?php echo $rfq['shipping_info']['type_of_company_to_quote']; ?>
						</td>
					</tr>
					<?php
				}
				if(isset($rfq['shipping_info'])){
					?>
					<tr>
						<th colspan=2 class="text-center"  style="background:#f0f0f0">
						Shipping Information
						</th>
					</tr>
					<tr>
						<td colspan=2  style="background:#fafafa">
							<table class="table table-bordered">
								<tr>
									<th width="25%">Origin</th>
									<th width="25%">Proposed Origin and Pickup Date</th>
									<th width="25%">Destination</th>
									<th width="25%">Proposed Destination and Delivery Date</th>
								</tr>
								<tr>
									<td width="25%"><b>Country:</b> <?php echo $rfq['shipping_info']['origin']['country']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['origin']['country'];
										?>
									</td>
									<td width="25%"><b>Country:</b> <?php echo $rfq['shipping_info']['destination']['country']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['destination']['country'];
										?>
									</td>
								</tr>
								<tr>
									<td width="25%"><b>City:</b> <?php echo $rfq['shipping_info']['origin']['city']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['origin']['city'];
										?>
									</td>
									<td width="25%"><b>City:</b> <?php echo $rfq['shipping_info']['destination']['city']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['destination']['city'];
										?>
									</td>
								</tr>
								<tr>
									<td width="25%"><b>Port:</b> <?php echo $rfq['shipping_info']['origin']['port']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['origin']['port'];
										?>
									</td>
									<td width="25%"><b>Port:</b> <?php echo $rfq['shipping_info']['destination']['port']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['destination']['port'];
										?>
									</td>
								</tr>
								<tr>
									<td width="25%"><b>Pickup Date (m/d/y):</b> <?php echo $rfq['shipping_info']['origin']['date']; ?></td>
									<td width="25%">
									<?php
										echo $bid_data['origin']['date'];
										?>
									</td>
									<td width="25%"><b>Delivery Date (m/d/y):</b> <?php echo $rfq['shipping_info']['destination']['date']; ?></td>
									<td width="25%">
										<?php
										echo $bid_data['destination']['date'];
										?>
									</td>
								</tr>
								<!--
								<tr>
									<td width="50%"><?php echo $rfq['shipping_info']['origin']['time_zone']; ?> GMT</td>
									<td width="50%"><?php echo $rfq['shipping_info']['destination']['time_zone']; ?>  GMT</td>
								</tr>
								-->
							</table>
							<script>
							jQuery("#origin_country").val("<?php echo $rfq['shipping_info']['origin']['country_code']." - ".$rfq['shipping_info']['origin']['country']; ?>");
							getPorts("origin_port", "<?php echo $rfq['shipping_info']['origin']['country_code']." - ".$rfq['shipping_info']['origin']['country']; ?>", true);
							jQuery("#destination_country").val("<?php echo $rfq['shipping_info']['destination']['country_code']." - ".$rfq['shipping_info']['destination']['country']; ?>");
							getPorts("destination_port", "<?php echo $rfq['shipping_info']['destination']['country_code']." - ".$rfq['shipping_info']['destination']['country']; ?>", true);
							
							</script>
						</td>
					</tr>
					
					<?php
				}
				$t = count($rfq['cargo']);
				if($t){
					?>
					<tr>
						<th colspan=2 class="text-center" style="background:#f0f0f0">
						Cargo Details
						</th>
					</tr>
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
																	<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Volume:</span> <i><?php echo ($cargo['details']['packing']['qty'][$i]+0)*($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0)." cu ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
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
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Volume:</span> <i><?php echo ($cargo['details']['packing']['qty'][$i]+0)*($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0)." cu ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																</td>
															</tr>
															<?php
														}
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
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Volume:</span> <i><?php echo ($cargo['details']['packing']['qty'][$i]+0)*($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0)." cu ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																</td>
															</tr>
															<?php
														}
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
				?>
			</table>
			<?php
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			?>
		</div>
	</div>
</div>