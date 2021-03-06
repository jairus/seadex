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
		function saveFilter(){
			jQuery(".savefilter").val(1);
		}
	</script>
	  <h2 class="text-right">Customer RFQs</h2>
	  <div class="table-responsive">
		<div class="row">
		<div class="col-md-2">
			
			<?php
			if($_SESSION['logistic_provider']['id']){
				include_once(dirname(__FILE__)."/dash_menu.php");
			}
			?>
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">RFQ Search Filter</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>
				  <?php
				  $t = count($saved_search_filters);
				  
				  if($t){
					  ?>
					  <div class="row" style="padding-bottom:20px;">
						<div class="col-md-12" style="padding-bottom:5px;">Saved Search Filters</div>
						<?php
						for($i=0; $i<$t; $i++){
							?>
							<form style="margin:0px;" method="post">
							<div class="row" style="margin:4px;">
								<?php
								if($_SESSION['saved_search_filter_id']==$saved_search_filters[$i]['id']){
									?>
									<div class="col-md-10"><button type="submit" class="btn btn-active btn-xs" name="saved_search_filter_id" value="<?php echo $saved_search_filters[$i]['id']; ?>" style="width:100%; text-align:left"><?php echo strip_tags($saved_search_filters[$i]['filter_name']); ?></button></div>
									<?php
								}
								else{
									?>
									<div class="col-md-10"><button type="submit" class="btn btn-default btn-xs" name="saved_search_filter_id" value="<?php echo $saved_search_filters[$i]['id']; ?>" style="width:100%; text-align:left"><?php echo strip_tags($saved_search_filters[$i]['filter_name']); ?></button></div>
									<?php
								}
								?>
								<div class="col-md-2"><button type="submit" class="btn btn-default btn-xs" name="delete_saved_search_filter_id" value="<?php echo $saved_search_filters[$i]['id']; ?>" style="width:100%;">x</button></div>
							</div>
							</form>
							<?php
						}
						?>
					  </div>
					  <?php
				  }
				  ?>
				  
				  <select name="searchfilter" id="searchfilter" class="form-control">
				    <option value="Custom Search">Custom Search</option>
					<option value="Route Search">Route Search</option>
					<option value="Country Search">Country Search</option>
					<option value="Search by Keywords">Search by Keywords</option>
					<option value="Categories">Categories</option>
					<option value="Container">Container</option>
					<option value="Any" selected>Any</option>
				  </select>
				  <script>
						function setupSF(val){
							jQuery(".searchfil").hide();
							if(val=="Custom Search"){
								jQuery("#s0").show();
							}
							else if(val=="Route Search"){
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
							else if(val=="Container"){
								jQuery("#s6").show();
							}
							else{
								jQuery("#s5").show();
							}
							<?php
		
							if(!$_SESSION['logistic_provider']['id']){
								?>
								jQuery(".savefilterx").hide();
								<?php
							}
							
							?>
						}
						jQuery("#searchfilter").change(function(){
							setupSF(jQuery("#searchfilter").val());
						});
						jQuery(".savefilter").val("");
						
					</script>
				  <div id="s0" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
					<input type="hidden" name="type" value="Custom Search">
					Country:
					<br />
					<input type="radio" name="tofrom" value="origin" <?php if($_SESSION['searchfilter']['tofrom']=="origin") echo "checked"; ?> > Origin
					<br />
					<input type="radio" name="tofrom" value="destination" <?php if($_SESSION['searchfilter']['tofrom']=="destination") echo "checked"; ?>> Destination
					<br />
					<input type="radio" name="tofrom" value="both" <?php if($_SESSION['searchfilter']['tofrom']=="both" || $_SESSION['searchfilter']['tofrom']=="") echo "checked"; ?>> Both
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
					<div style="padding-top:5px">
						<!--
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="FCL" /> FCL</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="LCL" /> LCL</div>
						-->
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="General" />General</div>
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
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername0').show()" />
					<div style="position:relative; display:none" id="filtername0">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername0').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
					</form>
				  </div>
				  <div id="s1" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
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
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername1').show()" />
					<div style="position:relative; display:none" id="filtername1">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername1').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
					</form>
				  </div>
				  <div id="s2" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
					<input type="hidden" name="type" value="Country Search">
					Country:
					<br />
					<input type="radio" name="tofrom" value="origin" <?php if($_SESSION['searchfilter']['tofrom']=="origin") echo "checked"; ?> > Origin
					<br />
					<input type="radio" name="tofrom" value="destination" <?php if($_SESSION['searchfilter']['tofrom']=="destination") echo "checked"; ?>> Destination
					<br />
					<input type="radio" name="tofrom" value="both" <?php if($_SESSION['searchfilter']['tofrom']=="both" || $_SESSION['searchfilter']['tofrom']=="") echo "checked"; ?>> Both
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
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername2').show()" />
					<div style="position:relative; display:none" id="filtername2">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername2').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
					</form>
				  </div>
				  <div id="s6" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
					<input type="hidden" name="type" value="Container">
					Container Size:
					<br />
					<select type="text" class="form-control" name='container_size' id="container_size" >
                        <option value="">Please select</option>
						<option value='20 ft'>20 ft / 6 m</option>
						<option value='40 ft'>40 ft / 12 m</option>
						<option value='45 ft'>45 ft / 13.7 m</option>
						<option value='Open top 20 ft'>Open top 20 ft / 6 m</option>
						<option value='Open top 40 ft'>Open top 40 ft / 12 m</option>
						<option value='Open top 45 ft'>Open top 45 ft / 13.7 m</option>
						<option value='Flatrack 20 ft'>Flatrack 20 ft / 6 m</option>
						<option value='Flatrack 40 ft'>Flatrack 40 ft / 12 m</option>
						<option value='Other'>Other (specify)</option>
					</select>
					Container Type:
					<br />
					<select type="text" class="form-control" name='container_type' id='container_type' >
						<option value="">Please select</option>
						<option value='Platforms'>Platforms</option>
						<option value='Ventilated Containers'>Ventilated Containers</option>
						<option value='Insulated'>Insulated</option>
						<option value='Refrigerated'>Refrigerated</option>
						<option value='Bulk Containers'>Bulk Containers</option>
						<option value='Tank Containers'>Tank Containers</option>
					</select>
					<script>
						<?php
						if($_SESSION['searchfilter']['container_size']){
							?>
							jQuery("#container_size").val("<?php echo $_SESSION['searchfilter']['container_size']; ?>");
							<?php
						}
						if($_SESSION['searchfilter']['container_type']){
							?>
							jQuery("#container_type").val("<?php echo $_SESSION['searchfilter']['container_type']; ?>");
							<?php
						}
						?>
					</script>
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; " />
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername2').show()" />
					<div style="position:relative; display:none" id="filtername2">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername2').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
					</form>
				  </div>
				  <div id="s3" style="padding-top:10px; display:none" class="searchfil">
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
					<input type="hidden" name="type" value="Search by Keywords">
					Keyword:
					<input type="text" class="form-control" name="keyword" value="<?php echo htmlentitiesX($_SESSION['searchfilter']['keyword'])?>"  />
					<input type="submit" class="btn btn-default" value="Search" style="margin-top:10px; "  />
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername3').show()" />
					<div style="position:relative; display:none" id="filtername3">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername3').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
					</form>
				  </div>
				  <div id="s4" style="padding-top:10px; display:none" class="searchfil">
					<style>
						.imo{
							font-size:10px;
						}
					</style>
					<form method="post">
					<input type="hidden" name="savefilter" class="savefilter">
					<input type="hidden" name="type" value="Categories">
					<div>
						<!--
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="FCL" /> FCL</div>
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="LCL" /> LCL</div>
						-->
						<div class="category"><input type="checkbox" name="categories[]" class="categories" value="General" />General</div>
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
					<input type="button" class="btn btn-default savefilterx" value="Save Search Filter" style="margin-top:10px;" onclick="jQuery('#filtername4').show()" />
					<div style="position:relative; display:none" id="filtername4">
						<div style="top:-100px; left:100px; position:absolute; background:#f0f0f0; padding:10px; text-align:center; vertical-align:middle">
							<div class="text-left">Filter Name:</div>
							<div class="row" style="padding-top:3px;">
								<div class="col-md-12"><input type="text" name="filtername" class="form-control" style="margin-bottom:5px;"></div>
								<div class="col-md-12 text-left">
								<input type="button" class="btn-default btn-xs" value="Cancel" onclick="jQuery('#filtername4').hide()">&nbsp;
								<input type="submit" class="btn-default btn-xs savefilterx" value="Save" onclick="saveFilter()"></div>
							</div>
						</div>
					</div>
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
		<div class="col-md-10">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="start">RFQ&nbsp;#</th>
				  <th width="10">FCL</th>
				  <th width="17%">Origin</th>
				  <th width="17%">Destination</th>
				  <th width="10%">Pickup Date</th>
				  <th width="10%">Delivery Date</th>
				  <!--
				  <th width="2.5%">Views</th>
				  <th width="2.5%">Bids</th>
				  -->
				  <th width="15%">Date Added</th>
				  <th class="end" width="19%"></th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$t = count($rfqs);
				for($i=0; $i<$t; $i++){
					if(strtotime($rfqs[$i]['destination_date'])==0){
						continue;
					}
					if(!trim($rfqs[$i]['origin_port'])){
						//continue;
					}
					?>
					<tr>
					  <td>
						  <?php
						  echo $rfqs[$i]['id'];
						  ?>
					  </td>
					  <td>
						<?php
							
						  if($_GET['all']||1){
							//echo "<pre>";
							
							$sql = "select `data` from `rfq` where `id`='".$rfqs[$i]['id']."' limit 1";
							$q = $this->db->query($sql);
							$rfqx = $q->result_array();
							
							$rfqdata = unserialize(base64_decode($rfqx[0]['data']));
							$rfqdata['id'] = $rfqx[0]['id'];
							$rfqdata['bid_id'] = $rfqx[0]['bid_id'];
							$rfqdata['logistic_provider_id'] = $rfqx[0]['logistic_provider_id'];
							$rfqdata['views'] = $rfqx[0]['views'];
							$rfqdata['dateaccepted'] = $rfqx[0]['dateaccepted'];
							//print_r($rfqdata);
							$cargo = $rfqdata['cargo'];
							$k = count($cargo);
							$container = array();
							for($j=0; $j<$k; $j++){
								if(trim(strtolower($cargo[$j]['details']['in_container']))=='yes'){
									$container[] = $cargo[$j]['details']['container_size'];
								}
							}
							if(count($container)){
								echo implode($container, ",");
							}
							else{
								echo "-";
							}
						  }
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
						  $ts = strtotime($rfqs[$i]['origin_date']);
						  echo date("M d, Y", $ts);
						  if(time()>$ts+(24*60*60)){
							echo " <a style='padding:2px; border:1px solid #2D6289; color:#2D6289'>PICK&#8209;UP&nbsp;ASAP</a>";
						  }
						?>
					  </td>
					  <td>
						<?php
						  $ts = strtotime($rfqs[$i]['destination_date']);
						  echo date("M d, Y", $ts);
						  if(time()+(24*60*60)>$ts){
							echo " <a class='' style='padding:2px; border:1px solid #2D6289; color:#2D6289'>Check&nbsp;Availability</a>";
						  }
						?>
					  </td>
					  <?php
					  /*
					  <td>
						<?php
						   echo $rfqs[$i]['views'];
						?>
					  </td>
					  <td>
						<?php
						   echo count($rfqs[$i]['bids']);
						?>
					  </td>
					  */
					  ?>
					  <td>
					  <?php
						  echo date("M d, Y", strtotime($rfqs[$i]['dateadded']));
					  ?>
					  </td>
					  <td>
						<input type="button" class="btn btn-sm btn-primary" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']; ?>'" value="More" />
						<?php
						if($rfqs[$i]['bidded']){
							?>
							<input type="button" style='background: green' class="btn btn-sm btn-primary" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']."/bid"; ?>'" value="Bid ON" />
							<?php
						}
						else{
							?>
							<input type="button" class="btn btn-sm btn-primary" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqs[$i]['id']."/bid"; ?>'" value="Bid" />
							<!--<input type="button" class="btn btn-sm" value="Bid" />-->
							<?php
						}
						?>
					  </td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=20 class="text-center">
						<?php
						$t = ceil($count/100);
						if($t){
						
							if($startl>0){
								?>
								<input type="button" class="prev" value="< Previous" />
								<?php
							}
							?>
							<input type="button" class="next" value="Next >" />&nbsp;&nbsp;&nbsp;
							Jump to page: <select class="paging">
								<?php
								
								for($m=0; $m<$t; $m++){
									if($startl==($m*100)){
										?>
										<option value='<?php echo $m*100; ?>' selected><?php echo $m+1; ?></option>
										<?php
									}
									else{
										?>
										<option value='<?php echo $m*100; ?>'><?php echo $m+1; ?></option>
										<?php
									}
								}
								?>
							</select>
							<?php
						}
						?>
					</td>
				</tr>
			  </tbody>
			</table>
		  </div>
		 </div>
	  </div>
	  <script>
		<?php
		
		if(!$_SESSION['logistic_provider']['id']){
			?>
			jQuery(".savefilterx").hide();
			<?php
		}
		
		?>
		jQuery(".prev").click(function(){
			self.location="<?php echo site_url("lp"); ?>/dashboard/<?php echo $startl-100; ?>";
		});
		jQuery(".next").click(function(){
			self.location="<?php echo site_url("lp"); ?>/dashboard/<?php echo $startl+100; ?>";
		});
		jQuery(".paging").change(function(){
			self.location="<?php echo site_url("lp"); ?>/dashboard/"+jQuery(this).val();
		
		});
	  </script>
