		<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="start">#</th>
				  <th width="18%">Origin</th>
				  <th width="18%">Destination</th>
				  <th width="14.3%">Bids</th>
				  <th width="14.3%">Lowest Bid (USD)</th>
				  <th width="14.3%">Date Added</th>
				  <th class="end" width="19%"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$t = count($rfqs);
				if($t){
					for($i=0; $i<$t; $i++){
						?>
						<tr>
						  <td>
							  <?php
							  echo $rfqs[$i]['id'];
							  ?>
						  </td>
						  <td>
							  <?php
							  $city = "";
							  if(trim($rfqs[$i]['origin_city'])){
								$city = $rfqs[$i]['origin_city'].", ";
							  }
							  echo $rfqs[$i]['origin_port']." - ".$city.$rfqs[$i]['origin_country'];
							  ?>
						  </td>
						  <td>
							  <?php
							  $city = "";
							  if(trim($rfqs[$i]['destination_city'])){
								$city = $rfqs[$i]['destination_city'].", ";
							  }
							  echo $rfqs[$i]['destination_port']." - ".$city.$rfqs[$i]['destination_country'];
							  ?>
						  </td>
						  <td>
							<?php
							  echo count($rfqs[$i]['bids']);
							  if($rfqs[$i]['bid_id']>0){
								?>
								<a style="color:green">- Accepted a Bid </a>
								<?php
							  }
							?>
						  </td>
						  <td>
							<?php
							  if(isset($rfqs[$i]['bids'][0]['total_bid_usd'])){
								echo "USD ".number_format($rfqs[$i]['bids'][0]['total_bid_usd'],2,".", ",");
							  }
							  else{
								echo "-";
							  }
							?>
						  </td>
						   <td>
							<?php
							  echo date("M d, Y", strtotime($rfqs[$i]['dateadded']));
							?>
						  </td>
						  <td>
							<?php
							if($rfqs[$i]['bid_id']==-1){ //if cancelled listing
								?>
								<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/bids";; ?>'" value="Cancelled: <?php echo date("M d,Y", strtotime($rfqs[$i]['datecancelled']));?>" />
								
								<?php
							}
							else if($rfqs[$i]['bid_id']==0){
								?>
								<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/bids";; ?>'" value="Bids" />
								<input type="button" class="btn btn-sm" style="background:red; color: white" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/cancel";; ?>'" value="Cancel RFQ" />
								<?php
							}
							else{
								?>
								<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/bids";; ?>'" value="Bids" />
								<?php
							}
							?>
						  </td>
						</tr>
						<?php
					}
				}
				else{
					?>
					<tr>
						<td colspan=10 class='text-center'>
						0 listings found.
						</td>
					</tr>
					<?php
				}
				?>
			  </tbody>
			</table>
		  </div>