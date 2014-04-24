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
  <h2 style='text-align:right'>My Bids</h2>
  <div class="table-responsive">
	<div class="row">
		<div class="col-md-3">
		<?php
		include_once(dirname(__FILE__)."/dash_menu.php");
		?>
		</div>
		<div class="col-md-9">
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th class="start">Bid&nbsp;#</th>
			  <th width="13.3%">RFQ&nbsp;#</th>
			  <th width="22.5%">Origin</th>
			  <th width="22.5%">Destination</th>
			  <th width="13.3%">My Bid (USD)</th>
			  <th width="13.3%">Date Added</th>
			  <th class="end" width="13%"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$t = count($bids);
			if($t){
				for($i=0; $i<$t; $i++){
					?>
					<tr>
					  <td>
						  <?php
						  echo $bids[$i]['id'];
						  ?>
					  </td>
					  <td>
						   <?php
						  echo $bids[$i]['rfq_id'];
						  ?>
					  </td>
					  <td>
						 <?php
						  $city = "";
						  if(trim($bids[$i]['origin_city'])){
							$city = $bids[$i]['origin_city'].", ";
						  }
						  echo $bids[$i]['origin_port']." - ".$city.$bids[$i]['origin_country'];
						  ?>
					  </td>
					  <td>
						 <?php
						  $city = "";
						  if(trim($bids[$i]['destination_city'])){
							$city = $bids[$i]['destination_city'].", ";
						  }
						  echo $bids[$i]['destination_port']." - ".$city.$bids[$i]['destination_country'];
						  ?>
					  </td>
					  <td>
						<?php
						  if(isset($bids[$i]['total_bid_usd'])){
							echo "USD ".number_format($bids[$i]['total_bid_usd'],2,".", ",");
						  }
						  else{
							echo "-";
						  }
						?>
					  </td>
					   <td>
						<?php
						  echo date("M d, Y", strtotime($bids[$i]['dateadded']));
						?>
					  </td>
					  <td>
						<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("lp/rfq")."/".$bids[$i]['rfq_id']."/bid?bid_id=".$bids[$i]['id']; ?>'" value="More" />
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
				<?
			}
			?>
		  </tbody>
		 </table>
		</div>
	</div>
</div>
