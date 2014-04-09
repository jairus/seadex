<?php
//echo "<pre>";
//print_r($_SESSION['rfq']);
?>
<div class="starter-template">
	<div class="center-block img-rounded" id="rfq-summary">
		<div class="row">
			<div class="col-md-12">
				<strong>RFQ Summary</strong><br /><br />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-left">
				<table class="table table-bordered">
					<tr>
						<th width="50%">Customer Type</th>
						<td width="50%"><?php echo ucfirst($_SESSION['rfq']['customer_type']); ?></td>
					</tr>
					<?php
					if(isset($_SESSION['rfq']['shipping_info']['type_of_company_to_quote'])){
						?>
						<tr>
							<th width="50%">RFQ for</th>
							<td width="50%">
							<?php echo $_SESSION['rfq']['shipping_info']['type_of_company_to_quote']; ?>
							<button type="button" class="btn btn-default btn-xs" onclick="self.location='<?php echo site_url("rfq/".$type."/1?change=true"); ?>'">Change</button>
							</td>
						</tr>
						<?php
					}
					if(isset($_SESSION['rfq']['shipping_info'])){
						?>
						<tr>
							<th colspan=2 class="text-center"  style="background:#f0f0f0">
							Shipping Information
							<button type="button" class="btn btn-default btn-xs" onclick="self.location='<?php echo site_url("rfq/".$type."/1?change=true"); ?>'">Change</button>
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
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['origin']['country']; ?></td>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['destination']['country']; ?></td>
									</tr>
									<tr>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['origin']['city']; ?></td>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['destination']['city']; ?></td>
									</tr>
									<tr>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['origin']['port']; ?></td>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['destination']['port']; ?></td>
									</tr>
									<tr>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['origin']['date']; ?></td>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['destination']['date']; ?></td>
									</tr>
									<!--
									<tr>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['origin']['time_zone']; ?> GMT</td>
										<td width="50%"><?php echo $_SESSION['rfq']['shipping_info']['destination']['time_zone']; ?>  GMT</td>
									</tr>
									-->
								</table>
							</td>
						</tr>
						<?php
					}
					$t = count($_SESSION['rfq']['cargo']);
					if($t){
						?>
						<tr>
							<th colspan=2 class="text-center" style="background:#f0f0f0">
							Cargo
							<button type="button" class="btn btn-default btn-xs" onclick="self.location='<?php echo site_url("rfq/".$type."/2?new=1"); ?>'">Add</button>
							</th>
						</tr>
						<tr>
							<td colspan=2 style="background:#fafafa">
								
								<?php
								foreach($_SESSION['rfq']['cargo'] as $i => $cargo){
									?>
									<table class="table table-bordered">
									<tr>
										<th width="50%">Cargo Type</th>
										<td width="50%">
										<?php echo $cargo['what_to_move']; ?>&nbsp;
										<button type="button" class="btn btn-default btn-xs" onclick="if(confirm('Are you sure you want to remove this cargo from the RFQ?')){ self.location='<?php echo site_url("rfq/removecargo/".$i); ?>'; }">Remove</button>
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
																		<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i>, 
																		<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i>, 
																		<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i>, 
																		<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i>
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
																	<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i>, 
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i>, 
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i>, 
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i>
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
																	<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i>, 
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i>, 
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i>, 
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i>
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
</div>