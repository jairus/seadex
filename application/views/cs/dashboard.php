<?php
@session_start();
?>
	<style>
	th{
		background:#0E202E;
		color: #ffffff;
		border-bottom:0px !important;
	}
	table th.start{
		border-radius: 5px 0px 0px 0px !important; 
		-moz-border-radius: 5px 0px 0px 0px !important; 
		-webkit-border-radius: 5px 0px 0px 0px !important; 
	}
	table th.end{
		border-radius: 0px 5px 0px 0px !important; 
		-moz-border-radius: 0px 5px 0px 0px !important; 
		-webkit-border-radius: 0px 5px 0px 0px !important; 
	}
	table th.startend{
		border-radius: 5px 5px 0px 0px !important; 
		-moz-border-radius: 5px 5px 0px 0px !important; 
		-webkit-border-radius: 5px 5px 0px 0px !important; 
	}
	.menu{
		/*cursor:pointer;*/
	}
	.menu a{
		/*color: #2A5C80;*/
	}
	</style>
	<script>
		function getPorts(idx, country_code, port){
			if(country_code){
				jQuery.ajax({
				  type: "POST",
				  url: "<?php echo site_url("rfq/getPorts"); ?>/"+escape(country_code),
				  data: "",
				  success: function(msg){
					jQuery("#"+idx).html(msg);
					if(port){
						jQuery("#"+idx).val(port);
					}
				  },
				  //dataType: dataType
				});
			}
		}
	</script>
	  <h2 style='text-align:right'>Active Listings</h2>
	  <div class="table-responsive">
		<div class="row">
		<div class="col-md-3">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend" >My Profile</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>
				  <!--
				  <div class="menu">Freight Request – for FREE</div>
				  <div class="menu">Offer Listings</div>
				  -->
				  <div class="menu"><a href="<?php echo site_url("cs"); ?>">Active Listings</a></div>
				  <!--
				  <div class="menu">Completed Listings </div>
				  <div class="menu">Expired Listings </div>
				  <div class="menu">Change Password</div>
				  <div class="menu">Delete profile</div>
				  -->
				  </td>
				</tr>
			  </tbody>
			</table>
		</div>
		<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="start">#</th>
				  <th width="22.5%">Origin</th>
				  <th width="22.5%">Destination</th>
				  <th width="13.3%">Bids</th>
				  <th width="13.3%">Lowest Bid (USD)</th>
				  <th width="13.3%">Date Added</th>
				  <th class="end" width="13%"></th>
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
						  echo count($rfqs[$i]['bids']);
						?>
					  </td>
					  <td>
						<?php
						  echo "USD ".number_format($rfqs[$i]['bids'][0]['total_bid_usd'],2,".", ",");
						?>
					  </td>
					   <td>
						<?php
						  echo date("M d, Y", strtotime($rfqs[$i]['dateadded']));
						?>
					  </td>
					  <td>
						<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cs/rfq")."/".$rfqs[$i]['id']."/bids";; ?>'" value="Bids" />
						<!--<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("cd/rfq")."/".$rfqs[$i]['id']."/delete"; ?>'" value="Del" />-->
						<!--<input type="button" class="btn btn-sm" value="Bid" />-->
					  </td>
					</tr>
					<?php
				}
				?>
			  </tbody>
			</table>
		  </div>
		 </div>
	  </div>
