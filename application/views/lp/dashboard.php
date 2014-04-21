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
	  <h2 class="text-right">Customer RFQs</h2>
	  <div class="table-responsive">
		<div class="row">
		<div class="col-md-3">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">Search Filter</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>
				  <select name="searchfilter" id="searchfilter" class="form-control">
					<option value="Route Search">Route Search</option>
					<option value="Country Search">Country Search</option>
					<option value="Search by Keywords">Search by Keywords</option>
					<option value="Categories">Categories</option>
					<option value="Any" selected>Any</option>
				  </select>
				  <script>
						function setupSF(val){
							jQuery(".searchfil").hide();
							if(val=="Route Search"){
								jQuery("#s1").show();
							}
							else if(val=="Country Search"){
								jQuery("#s2").show();
							}
							else if(val=="Search by Keywords"){
								jQuery("#s3").show();
							}
							else if(val=="Categories"){
								jQuery("#s4").show();
							}
							else{
								jQuery("#s5").show();
							}
						}
						jQuery("#searchfilter").change(function(){
							setupSF(jQuery("#searchfilter").val());
						});
						
					</script>
				  <div id="s1" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="type" value="Route Search">
					Origin Country:
					<?php
					$data['select_name'] = "origin[country]";
					$data['select_id'] = "origin_country";
					$this->load->view("lp/country_select", $data);
					?>
					Origin Port:
					<select class="form-control" name='origin[port]' id="origin_port"></select>
					<script>
						jQuery("#origin_country").change(function(){
							getPorts("origin_port", jQuery(this).val());
						});
						<?php
						if($_SESSION['searchfilter']['origin']['country']){
							?>
							jQuery("#origin_country").val("<?php echo $_SESSION['searchfilter']['origin']['country']; ?>");
							getPorts("origin_port", jQuery("#origin_country").val(), "<?php echo $_SESSION['searchfilter']['origin']['port']; ?>");
							<?php
						}
						?>
					</script>
					Destination Country:
					<?php
					$data['select_name'] = "destination[country]";
					$data['select_id'] = "destination_country";
					$this->load->view("lp/country_select", $data);
					?>
					Origin Port:
					<select class="form-control" name='destination[port]' id="destination_port"></select>
					<script>
						jQuery("#destination_country").change(function(){
							getPorts("destination_port", jQuery(this).val());
						});
						<?php
						if($_SESSION['searchfilter']['destination']['country']){
							?>
							jQuery("#destination_country").val("<?php echo $_SESSION['searchfilter']['destination']['country']; ?>");
							getPorts("destination_port", jQuery("#destination_country").val(), "<?php echo $_SESSION['searchfilter']['destination']['port']; ?>");
							<?php
						}
						?>
					</script>
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; " />
					</form>
				  </div>
				  <div id="s2" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="type" value="Country Search">
					Country:
					<?php
					$data['select_name'] = "country";
					$data['select_id'] = "country";
					$this->load->view("lp/country_select", $data);
					?>
					<script>
						<?php
						if($_SESSION['searchfilter']['country']){
							?>
							jQuery("#country").val("<?php echo $_SESSION['searchfilter']['country']; ?>");
							<?php
						}
						?>
					</script>
					
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; " />
					</form>
				  </div>
				  <div id="s3" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="type" value="Search by Keywords">
					Keyword:
					<input type="text" class="form-control" name="keyword" value="<?php echo htmlentitiesX($_SESSION['searchfilter']['keyword'])?>"  />
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; "  />
					</form>
				  </div>
				  <div id="s4" style="padding-top:10px; display:none" class="searchfil">
					<style>
						.imo{
							font-size:10px;
						}
					</style>
					<form method="post">
					<input type="hidden" name="type" value="Categories">
					<div>
						<!--
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="FCL" /> FCL</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="LCL" /> LCL</div>
						-->
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Goods" /> Goods</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Vehicle" /> Vehicle</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Household" /> Household</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Electrical Items" /> Electrical Items</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Special Care Items" /> Special Care Items</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Parcel Delivery" /> Parcel Delivery</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="Vehicle Parts" /> Vehicle Parts</div>
						<div>IMO</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.1: Explosives with a mass explosion hazard" /> Subclass 1.1: Explosives with a mass explosion hazard</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.2: Explosives with a severe projection hazard" /> Subclass 1.2: Explosives with a severe projection hazard</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.3: Explosives with a fire" /> Subclass 1.3: Explosives with a fire</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.4: Minor fire or projection hazard" /> Subclass 1.4: Minor fire or projection hazard</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.5: An insensitive substance with a mass explosion hazard" /> Subclass 1.5: An insensitive substance with a mass explosion hazard</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 1.6: Extremely insensitive articles" /> Subclass 1.6: Extremely insensitive articles</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 2.1: Flammable Gas" /> Subclass 2.1: Flammable Gas</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 2.2: Non-Flammable Gases" /> Subclass 2.2: Non-Flammable Gases</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 2.3: Poisonous Gases" /> Subclass 2.3: Poisonous Gases</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Class 3:Flammable Liquids" /> Class 3:Flammable Liquids</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 4.1: Flammable solids" /> Subclass 4.1: Flammable solids</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 4.2: Spontaneously combustible solids" /> Subclass 4.2: Spontaneously combustible solids</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 4.3: Dangerous when wet" /> Subclass 4.3: Dangerous when wet</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 5.1: Oxidizing agent" /> Subclass 5.1: Oxidizing agent</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 5.2: Organic peroxide oxidizing agent" /> Subclass 5.2: Organic peroxide oxidizing agent</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 6.1: Poison" /> Subclass 6.1: Poison</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Subclass 6.2: Biohazard" /> Subclass 6.2: Biohazard</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Class 7:Radioactive substances" /> Class 7:Radioactive substances</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Class 8:Corrosive substances" /> Class 8:Corrosive substances</div>
						<div class="imo"><input type="checkbox" name="imos[]" class="imos" value="Class 9:Miscellaneous dangerous substances and articles" /> Class 9:Miscellaneous dangerous substances and articles</div>
					</div>
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; " />
					</form>
					<script>
						jQuery(".imos").each(function(){
							<?php
							if(is_array($_SESSION['searchfilter']['imos'])){
								foreach($_SESSION['searchfilter']['imos'] as $value){
									?>
									if(jQuery(this).val()=="<?php echo addslashes($value); ?>"){
										jQuery(this).attr("checked", true);
									}
									<?php
								}
							}
							?>
						});
						jQuery(".categories").each(function(){
							<?php
							if(is_array($_SESSION['searchfilter']['categories'])){
								foreach($_SESSION['searchfilter']['categories'] as $value){
									?>
									if(jQuery(this).val()=="<?php echo addslashes($value); ?>"){
										jQuery(this).attr("checked", true);
									}
									<?php
								}
							}
							?>
						});
					</script>
				  </div>
				  <div id="s5" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="type" value="Any">
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; " />
					</form>
				  </div>
				  
				  <script>
				  <?php
					if($_SESSION['searchfilter']['type']){
						?>
						setupSF("<?php echo $_SESSION['searchfilter']['type']; ?>");
						jQuery("#searchfilter").val("<?php echo $_SESSION['searchfilter']['type']; ?>")
						<?php
					}
				  ?>
				  </script>
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
				  <th width="20%">Pickup Date</th>
				  <th width="20%">Delivery Date</th>
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
						  echo date("M d, Y", strtotime($rfqs[$i]['origin_date']));
						?>
					  </td>
					  <td>
						<?php
						  echo date("M d, Y", strtotime($rfqs[$i]['destination_date']));
						?>
					  </td>
					  <td>
						<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']; ?>'" value="More" />
						<input type="button" class="btn btn-sm" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']."/bid"; ?>'" value="Bid" />
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
