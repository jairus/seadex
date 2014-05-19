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
  <h2 style='text-align:right'>My Rates
  
  <input type="button" class="btn btn-default" style="margin:20px;" value="Add Rate Details" onclick="self.location='<?php echo site_url("lp/myrates")."/add"; ?>'">
  </h2>
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
			  <th class="start">Rate&nbsp;#</th>
			  <th width="22.5%">Origin</th>
			  <th width="22.5%">Destination</th>
			  <th width="20%">Rate</th>
			  <th width="20%">Date Added</th>
			  <th class="end" width="13%"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			$t = count($rates);
			if($t){
				for($i=0; $i<$t; $i++){
					?>
					<tr>
					  <td>
						  <?php
						  echo $rates[$i]['id'];
						  ?>
					  </td>
					  <td>
						 <?php
						  $city = "";
						  if(trim($rates[$i]['origin_city'])){
							$city = $rates[$i]['origin_city'].", ";
						  }
						  echo $rates[$i]['origin_port']." - ".$city.$rates[$i]['origin_country'];
						  ?>
					  </td>
					  <td>
						 <?php
						  $city = "";
						  if(trim($rates[$i]['destination_city'])){
							$city = $rates[$i]['destination_city'].", ";
						  }
						  echo $rates[$i]['destination_port']." - ".$city.$rates[$i]['destination_country'];
						  ?>
					  </td>
					  <td>
						<?php
						  if(isset($rates[$i]['sales_rate'])){
							$currency = explode(" ", $rates[$i]['sales_rate_currency'], 2);
							$currency_short = $currency[0];
							$currency_long = $currency[1];
							echo $currency_short." ".number_format($rates[$i]['sales_rate'],2,".", ",");
						  }
						  else{
							echo "-";
						  }
						?>
					  </td>
					   <td>
						<?php
						  echo date("M d, Y", strtotime($rates[$i]['dateadded']));
						?>
					  </td>
					  <td>
						<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("lp/myrates/rate")."/".$rates[$i]['id']; ?>'" value="More" />
					  </td>
					</tr>
					<?php
				}
			}
			else{
				?>
				<tr>
					<td colspan=10 class='text-center'>
					0 rates found.
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
