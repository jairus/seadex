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
	  <h2 style='text-align:right'>Completed Listings</h2>
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
				  
				  <div class="menu"><a href="<?php echo site_url("cs"); ?>/completed_listings">Completed Listings</a></div>
				  <!--
				  <div class="menu">Expired Listings </div>
				  <div class="menu">Change Password</div>
				  <div class="menu">Delete profile</div>
				  -->
				  </td>
				</tr>
			  </tbody>
			</table>
		</div>
		<?php
		include_once(dirname(__FILE__)."/rfq_list.php");
		?>
		</div>
	</div>
