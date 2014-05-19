<script>
	function packingType(val, title){
		if(val=="Other"){
			id=title.split("-");
			id = "packing_specify-"+id[1];
			jQuery("[title='"+id+"']").fadeIn(200);
		}
		else{
			id=title.split("-");
			id = "packing_specify-"+id[1];
			jQuery("[title='"+id+"']").hide();
		}
	}
	function sameify(objx, val){
		arr = objx.parent().parent().find(".form-control");
		for(i=0; i<arr.length; i++){
			if(arr[i].name!="packing[weight_unit][]"){
				arr[i].value = val;
			}
		}
	}
</script>

<div style="display:none" id="packing_details">
	<table class="table table-bordered" id="packing_table" style="display:none">
		<tr>
			<th width="100%" colspan="4">
			<div class="col-md-6">
				<select type="text" class="form-control" id="packing_type" name="packing[name][]" onchange="packingType(this.value, this.title)">
					<option value='Wooden crates'>Wooden crates</option>
					<option value='Wooden boxes'>Wooden boxes</option>
					<option value='Cardboard boxes'>Cardboard boxes</option>
					<option value='Pallets'>Pallets</option>
					<option value='Bags'>Bags</option>
					<option value='Other'>Other</option>
				</select>
				<input type="text" name="packing[specify][]" class="form-control" style="display:inline" id="packing_detail_name_specify" placeholder="Please specify...">
			</div>
			<div class="col-md-1">
			Qty:
			</div>
			<div class="col-md-3">
				
				<select type="text" class="form-control" name="packing[qty][]" style="width:80px; display:inline">
					<?php
					for($i=1; $i<=100; $i++){
						?><option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<a class="removepacking" onclick="if(jQuery('#packing_more_details').children().length>1){ this.parentElement.parentElement.parentElement.parentElement.parentElement.outerHTML=''; if(jQuery('#packing_more_details').children().length<=1){ jQuery('.removepacking').hide() } }" >Remove</a>
			</div>
			</th>
		</tr>	
		<tr>
			<th width="25%">
			Length
			<select class="form-control" onchange="sameify(jQuery(this),this.value)"  style="width:80px; display:inline" type="text" name="packing[length_unit][]" >
				<option value='m'>m</option>
				<option value='ft'>ft</option>
			</select>
			</th>
			<th width="25%">
			Width
			<select class="form-control" onchange="sameify(jQuery(this),this.value)"  style="width:80px; display:inline" type="text" name="packing[width_unit][]" >
				<option value='m'>m</option>
				<option value='ft'>ft</option>
			</select>
			</th>
			<th width="25%">
			Height
			<select class="form-control" onchange="sameify(jQuery(this),this.value)"  style="width:80px; display:inline" type="text" name="packing[height_unit][]" >
				<option value='m'>m</option>
				<option value='ft'>ft</option>
			</select>
			</th>
			<th width="25%">
			Weight
			<select class="form-control"  style="width:80px; display:inline" type="text" name="packing[weight_unit][]" >
				<option value='kg'>kg</option>
				<option value='lbs'>lbs</option>
			</select>
			</th>
		</tr>
		<tr>
			<td width="25%">
				<input class="form-control" type="text" name="packing[length][]">
			</td>
			<td width="25%">
				<input class="form-control" type="text" name="packing[width][]">
			</td>
			<td width="25%">
				<input class="form-control" type="text" name="packing[height][]">
			</td>
			<td width="25%">
				<input class="form-control" type="text" name="packing[weight][]">
			</td>
			
		</tr>
		
	</table>
</div>
