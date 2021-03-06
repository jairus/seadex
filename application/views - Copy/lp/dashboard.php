<?php
@session_start();
?>
	  <h2 class="sub-header">RFQs</h2>
	  <div class="table-responsive">
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th>#</th>
			  <th width="22.5%">Origin</th>
			  <th width="22.5%">Destination</th>
			  <th width="20%">Pickup Date</th>
			  <th width="20%">Delivery Date</th>
			  <th width="13%"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$t = count($rfqs);
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
					  echo date("M d, Y", $rfqs[$i]['origin_timestamp_utc']);
					?>
				  </td>
				  <td>
					<?php
					  echo date("M d, Y", $rfqs[$i]['destination_timestamp_utc']);
					?>
				  </td>
				  <td>
					<input type="button" class="btn btn-default btn-sm" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']; ?>'" value="More Details" />
					<input type="button" class="btn btn-default btn-sm" value="Bid" />
				  </td>
				</tr>
				<?php
			}
			?>
		  </tbody>
		</table>
	  </div>
