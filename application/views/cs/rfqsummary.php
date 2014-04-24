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
function bid(){
	self.location="<?php echo site_url("lp/rfq")."/".$rfq['id']."/bid"; ?>";
}
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
	<div class="row">
		<div class="col-md-6">
			<h2>RFQ # <?php echo $rfq['id'] ?></h2>
		</div>
		<div class="col-md-6 text-right">
			<h2><a href="<?php echo site_url("cs") ?>">Back to Dashboard</a></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-left">
			<table class="table table-bordered">
				<tr>
					<th colspan=2 class="text-center" style="background:#f0f0f0">
					Bids
					</th>
				</tr>
				<tr>
					<td colspan=2>
						<?php
						$t = count($bids);
						if($t){
							?>
							<table class="table table-bordered">
								<tr>
									<th width="30%">Company</th>
									<th width="30%">Total Bid</th>
									<th width="30%">
									<div class="row">
										<div class="col-sm-3">Total Bid in</div>
										<div class="col-sm-9">
											<?php include_once(dirname(__FILE__)."/currency_form.php"); ?>
										</div>
									</div>
									</th>
									<th width="10%"></th>
								</tr>
								<?php
								
								for($i=0; $i<$t; $i++){
									?>
									<tr>
										<td>
											<?php 
											//echo "<a href='".site_url("cs")."/rfq/".$rfq['id']."/bid?bid_id=".$bids[$i]['id']."'>".$bids[$i]['company_name']."</a>" ; 
											echo $bids[$i]['company_name'];
											if($rfq['bid_id']==$bids[$i]['id']){
												echo "&nbsp;&nbsp;<a style='color:green'>( Accepted Bid )</a>";
											}
											?>
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
											if($_POST['total_bid_currency']){
												$currency2 = explode(" ", $_POST['total_bid_currency'], 2);
												$currency_short2 = $currency2[0];
												$currency_long2 = $currency2[1];
												$exchange_rate = @file_get_contents("http://rate-exchange.appspot.com/currency?from=".$currency_short."&to=".$currency_short2);
												$exchange_rate = @json_decode($exchange_rate);
												if(isset($exchange_rate->rate)){
													$bid_equiv = $exchange_rate->rate * $bids[$i]['total_bid'];
													echo $currency_short2." ";
													echo number_format($bid_equiv, 2, ".", ","); 
													echo " (".$currency_long2.")";
												}
											}
											else{
			
												$currency_short = "USD";
												$currency_long = "United States Dollars";
												$bid_equiv = $bids[$i]['total_bid_usd'];
												echo $currency_short." ";
												echo number_format($bid_equiv, 2, ".", ","); 
												echo " (".$currency_long.")";
											}
											?>
										</td>
										<td>
											<?php echo "<a href='".site_url("cs")."/rfq/".$rfq['id']."/bid?bid_id=".$bids[$i]['id']."'>View Bid</a>" ; ?>
										</td>
									</tr>
									<?php
								}
								?>
							</table>
							<?php
						}
						else{
							echo "<div class='text-center' style='padding:30px;'>There are no bids in this listing.</div>";
						}
						?>
					</td>
				</tr>
				<?php
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
								<!--
								<tr>
									<td width="50%"><?php echo $rfq['shipping_info']['origin']['time_zone']; ?> GMT</td>
									<td width="50%"><?php echo $rfq['shipping_info']['destination']['time_zone']; ?>  GMT</td>
								</tr>
								-->
							</table>
						</td>
					</tr>
					<?php
				}
				$t = count($rfq['cargo']);
				if($t){
					?>
					<tr>
						<th colspan=2 class="text-center" style="background:#f0f0f0">
						Cargo
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
					<tr>
						<td colspan=2 class="text-center">
							
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