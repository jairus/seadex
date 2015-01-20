<script>
	function packingType(val, title){
		if(val=="Other"){
			id=title.split("-");
			id = "packing_specify-"+id[1];
			jQuery("[title='"+id+"']").fadeIn(200);
			jQuery("[title='"+id+"']").parent().parent().parent().show();
			//alert(jQuery("[title='"+id+"']").parent().parent().parent().html())
			//jQuery("#specifytr"+id[1]).show();
		}
		else{
			id=title.split("-");
			id = "packing_specify-"+id[1];
			jQuery("[title='"+id+"']").hide();
			jQuery("[title='"+id+"']").parent().parent().parent().hide();
			//jQuery("#specifytr"+id[1]).hide();
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
					<optgroup label="Trailer">
						<option value='Trailer - Registered'>Trailer - Registered</option>
						<option value='Trailer - Unregistered'>Trailer - Unregistered</option>
					</optgroup>
					<option value='Cradle'>Cradle</option>
					<option value='On wheels or Similar'>On wheels or Similar</option>
					<option value='Other'>Other / Not Packed</option>
				</select>
				<!--<input type="text" name="packing[specify][]" class="form-control" style="display:inline" id="packing_detail_name_specify" placeholder="Specify Details and or Requirements ...">-->
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
				<a type="button" class="removepacking" onclick="if(jQuery('#packing_more_details').children().length>1){ this.parentElement.parentElement.parentElement.parentElement.parentElement.outerHTML=''; if(jQuery('#packing_more_details').children().length<=1){ jQuery('.removepacking').hide() } }" >Remove</a>
			</div>
			</th>
		</tr>	
		<tr style="display:none">
			<th width="100%" colspan="4">
			<div class="col-md-12">
				<input type="text" name="packing[specify][]" class="form-control" style="display:inline" id="packing_detail_name_specify" placeholder="Specify Details  and/or Special Requirements ...">
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
				<input class="form-control packing_measurements" type="text" name="packing[length][]">
			</td>
			<td width="25%">
				<input class="form-control packing_measurements" type="text" name="packing[width][]">
			</td>
			<td width="25%">
				<input class="form-control packing_measurements" type="text" name="packing[height][]">
			</td>
			<td width="25%">
				<input class="form-control packing_measurements" type="text" name="packing[weight][]">
			</td>
			
		</tr>
		<!--
		<tr>
			<th width="20%">Length</th>
			<td width="50%">
			<input class="form-control" type="text" name="packing[length][]">
			</td>
			<td width="30%">
			<select class="form-control"  type="text" name="packing[length_unit][]" >
				<option value='cm'>cm</option>
				<option value='m'>m</option>
				<option value='ft'>ft</option>
				<option value='in'>in</option>
			</select>
			</td>
		</tr>
		<tr>
			<th width="20%">Width</th>
			<td width="50%">
			<input class="form-control" type="text" name="packing[width][]">
			</td>
			<td width="30%">
			<select class="form-control"  type="text" name="packing[width_unit][]" >
				<option value='cm'>cm</option>
				<option value='m'>m</option>
				<option value='ft'>ft</option>
				<option value='in'>in</option>
			</select>
			</td>
		</tr>
		<tr>
			<th width="20%">Height</th>
			<td width="50%">
			<input class="form-control" type="text" name="packing[height][]">
			</td>
			<td width="30%">
			<select class="form-control"  type="text" name="packing[height_unit][]" >
				<option value='cm'>cm</option>
				<option value='m'>m</option>
				<option value='ft'>ft</option>
				<option value='in'>in</option>
			</select>
			</td>
		</tr>
		-->
	</table>
</div>
