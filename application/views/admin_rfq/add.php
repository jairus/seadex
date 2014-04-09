<?php
@session_start();
$sid = session_id()."_".time();
?>
<script>
function saveRecord(approve){	
	extra = "";
	jQuery("#savebutton").val("Saving...");
	formdata = jQuery("#record_form").serialize();
	jQuery("#record_form *").attr("disabled", true);
	jQuery.ajax({
		<?php
		if($record['id']){
			?>url: "<?php  echo site_url(); echo $controller ?>/ajax_edit"+extra,<?php
		}
		else{
			?>url: "<?php echo site_url(); echo $controller ?>/ajax_add"+extra,<?php
		}
		?>
		type: "POST",
		data: formdata,
		dataType: "script",
		success: function(data){
			//alert(data);
		}
	});	
	
}
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
</script>

<input type='hidden' id='tempcreatelabel' />
<form id='record_form'>

<?php
if($record['id']){
	?>
	<input type='hidden' name='id' id='co_id'  value="" />
	<?php
}
else{
	?>
	<input type='hidden' name='sid' value="<?php echo sanitizeX($sid); ?>">
	<?php
}


?>
<table width="100%" cellpadding="10px">
<?php
if(!$record['id']){
	?>
	<tr>
	<td class='font18 bold'>Add a New Record</td>
	<td></td>
	</tr>
	<?php
}
else{
	?>
	<tr>
	<td class='font18 bold'>Edit Record</td>
	<td></td>
	</tr>
	<?php
}

?>
<tr>
<td width='50%'> 
	<table width="100%">
		<!--
		<tr class="even required">
		  <td>* Name:</td>
		  <td><input type="text" name="name" size="40"></td>
		</tr>
		-->
		<tr class="even required"><td>* Origin Country:</td><td><input type="text" name="origin_country" size="40"></td></tr>
<tr class="even required"><td>* Origin City:</td><td><input type="text" name="origin_city" size="40"></td></tr>
<tr class="even required"><td>* Origin Port:</td><td><input type="text" name="origin_port" size="40"></td></tr>
<tr class="even required"><td>* Pickup Date:</td><td><input type="text" name="origin_date" size="40"></td></tr>
<tr class="even required"><td>* Origin Timezone:</td><td><input type="text" name="origin_time_zone" size="40"></td></tr>
<tr class="even required"><td>* Origin Timestamp UTC:</td><td><input type="text" name="origin_timestamp_utc" size="40"></td></tr>
<tr class="even required"><td>* Origin Date UTC:</td><td><input type="text" name="origin_date_utc" size="40"></td></tr>
<tr class="even required"><td>* Destination Country:</td><td><input type="text" name="destination_country" size="40"></td></tr>
<tr class="even required"><td>* Destination City:</td><td><input type="text" name="destination_city" size="40"></td></tr>
<tr class="even required"><td>* Destination Port:</td><td><input type="text" name="destination_port" size="40"></td></tr>
<tr class="even required"><td>* Delivery Date:</td><td><input type="text" name="destination_date" size="40"></td></tr>
<tr class="even required"><td>* Destination Timezone:</td><td><input type="text" name="destination_time_zone" size="40"></td></tr>
<tr class="even required"><td>* Destination Timestamp UTC:</td><td><input type="text" name="destination_timestamp_utc" size="40"></td></tr>
<tr class="even required"><td>* Destination Date UTC:</td><td><input type="text" name="destination_date_utc" size="40"></td></tr>
<tr class="even required"><td>* Data:</td><td><input type="text" name="data" size="40"></td></tr>
<tr class="even required"><td>* Date Added:</td><td><input type="text" name="dateadded" size="40"></td></tr>

	</table>
</td>
<td width='50%'>
	&nbsp;
</td>
</tr>

<tr>
	<td colspan="2" class='center'>
		<table width='100%'>
		<tr>
			<td width=100%>
				<input type="button" id='savebutton' value="Save" onclick="saveRecord()" />
			</td>
			<?php 
			if($record['id']){
				?><td><input type="button" style='background:red; color:white' value="Delete" onclick="deleteRecord('<?php echo $record['id']; ?>')" /></td><?php
			}
			?>
		</tr>
		</table>
	</td>
</tr>
</td>
</table>
</form>

<script>
<?php

if(is_array($pictures)){
	?>
	html = "";
	<?php
}
if($record){
	foreach($record as $key=>$value){	
		if(trim($value)||1){
			?>
			jQuery('[name="<?php echo $key; ?>"]').val("<?php echo sanitizeX($value); ?>");
			<?php
		}		
	}
}
?>
</script>
