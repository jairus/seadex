		<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="start">#</th>
				  <th width="18%">Origin</th>
				  <th width="18%">Destination</th>
				  <th width="16.3%">Bids</th>
				  <th width="16.3%">Lowest Bid (USD)</th>
				  <th width="16.3%">Date Added</th>
				  <th class="end" width="13%"></th>
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
							  if($rfqs[$i]['bid_id']){
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
							<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/bids";; ?>'" value="Bids" />
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