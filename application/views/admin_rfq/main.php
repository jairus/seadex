<script>
function deleteRecord(co_id){
	if(confirm("Are you sure you want to delete this record?")){
		formdata = "id="+co_id;
		jQuery.ajax({
			url: "<?php echo site_url(); echo $controller ?>/ajax_delete/"+co_id,
			type: "POST",
			data: formdata,
			dataType: "script",
			success: function(){
				jQuery("#tr"+co_id).fadeOut(200);
				self.location = "<?php echo site_url(); echo $controller ?>";
			}
		});
		
	}
}

function serachRecord(){
	self.location = "<?php echo site_url(); ?><?php echo $controller; ?>/search/?search="+jQuery("#search").val()+"&filter="+jQuery("#sfilter").val();
}
function addRecord(){
	self.location = "<?php echo site_url(); echo $controller; ?>/add";
}
</script>
<center>
<div class='pad10' >
<form action="<?php echo site_url(); ?><?php echo $controller; ?>/search/" class='inline' >
	Filter: <select name='filter' id='sfilter'>
	<!--
	<option value="name">Name</option>
	<option value="id">ID</option>	
	-->
	<option value="origin_country">Origin Country</option>	
<option value="origin_city">Origin City</option>	
<option value="origin_port">Origin Port</option>	
<option value="origin_date">Pickup Date</option>	
<option value="destination_country">Destination Country</option>	
<option value="destination_city">Destination City</option>	
<option value="destination_port">Destination Port</option>	
<option value="destination_date">Delivery Date</option>	
<option value="dateadded">Date Added</option>	

	</select>
	Search: <input type='text' id='search' value="<?php echo sanitizeX($search); ?>" name='search' />
	<input type='button' class='button normal' value='search' onclick='serachRecord()'>
	<input type='button' class='button normal' value='add' onclick='addRecord()'>
</form>
<?php
if(trim($filter)){
	?>
	<script>
	jQuery("#sfilter").val("<?php echo sanitizeX($filter); ?>")
	</script>
	<?php
}
$t = count($records);
?>
</center>
<div class='list'>
<table>
	<tr>
		<th style="width:20px"></th>
		<th>ID</th>
		<!--
		<th>Name</th>
		-->
		<th>Origin Country</th>
<th>Origin City</th>
<th>Origin Port</th>
<th>Pickup Date</th>
<th>Destination Country</th>
<th>Destination City</th>
<th>Destination Port</th>
<th>Delivery Date</th>
<th>Date Added</th>

		<th></th>
	</tr>
	<?php
	
	for($i=0; $i<$t; $i++){
		?>
		<tr id="tr<?php echo htmlentitiesX($records[$i]['id']); ?>" class="row" >
			
			<td><?php echo $start+$i+1; ?></td>
			<td><a href="<?php echo site_url(); ?><?php echo $controller; ?>/edit/<?php echo $records[$i]['id']?>" ><?php echo htmlentitiesX($records[$i]['id']); ?></a></td>			
			<!--<td><?php //echo $records[$i]['name'];?></td>-->		
			<td><?php echo $records[$i]['origin_country'];?></td>
<td><?php echo $records[$i]['origin_city'];?></td>
<td><?php echo $records[$i]['origin_port'];?></td>
<td><?php echo $records[$i]['origin_date'];?></td>
<td><?php echo $records[$i]['destination_country'];?></td>
<td><?php echo $records[$i]['destination_city'];?></td>
<td><?php echo $records[$i]['destination_port'];?></td>
<td><?php echo $records[$i]['destination_date'];?></td>
<td><?php echo $records[$i]['dateadded'];?></td>

			<td width='300px'>
			[ <a href="<?php echo site_url(); ?><?php echo $controller; ?>/edit/<?php echo $records[$i]['id']?>" >Edit</a> ] 
			[ <a style='color: red; cursor:pointer; text-decoration: underline' onclick='deleteRecord("<?php echo htmlentitiesX($records[$i]['id']) ?>"); ' >Delete</a> ]
			
			</td>
		</tr>
		<?php
	}
	if($pages>0){
		?>
		<tr>
			<td colspan="50" class='center font12' >
				There is a total of <?php echo $cnt; ?> <?php if($cnt>1) { echo "records"; } else{ echo "record"; }?> in the database. 
				Go to Page:
				<?php
				if($search){
					?>
					<select onchange='self.location="?search=<?php echo sanitizeX($search); ?>&filter=<?php echo sanitizeX($filter); ?>&start="+this.value'>
					<?php

				}
				else{
					?>
					<select onchange='self.location="?start="+this.value'>
					<?php
				}
				for($i=0; $i<$pages; $i++){
					if(($i*$limit)==$start){
						?><option value="<?php echo $i*$limit?>" selected="selected"><?php echo $i+1; ?></option><?php
					}
					else{
						?><option value="<?php echo $i*$limit?>"><?php echo $i+1; ?></option><?php
					}
				}
				?>
				</select>
			</td>
		</tr>
		<?php
	}
	?>
</table>
</div>
