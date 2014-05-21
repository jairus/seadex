<?php
//echo "<pre>";
//print_r($rate);
?>
<style>
#container {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 5px;
    box-shadow: 0 4px 18px #C8C8C8;
    margin: auto;
	margin-top:10px;
}
body{
	background:#f0f0f0;
}
</style>
<script>
function setPort(idx){
	
	if(idx=="origin_port"){
		jQuery("#"+idx).val("<?php echo SDEncrypt($rate['origin_port_id'])."--".$rate['origin_port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rate['origin_port_id'])."--".$rate['origin_port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rate['origin_port_id'])."--".$rate['origin_port']; ?>");
		}
	}
	else{
		jQuery("#"+idx).val("<?php echo SDEncrypt($rate['destination_port_id'])."--".$rate['destination_port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rate['destination_port_id'])."--".$rate['destination_port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rate['destination_port_id'])."--".$rate['destination_port']; ?>");
		}
	}
	//alert(idx)
	//alert(jQuery("#"+idx).val());
}
function getPorts(idx, country_code, init){
	if(country_code){
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("rfq/getPorts"); ?>/"+escape(country_code),
		  data: "",
		  success: function(msg){
			jQuery("#"+idx).html(msg);
			if(init){
				setPort(idx);
			}
			else{
				calcDate();
			}
		  },
		  //dataType: dataType
		});
	}
}
function validDecimal(obj){
	if(obj.val() && isNaN(obj.val())){
		//alert("Please enter a valid number for your total bid price. e.g. 1000.00")
		//obj.val("0.00");
		//obj[0].focus();
	}
}
function moreAttachments(){
	jQuery("#attachments_container").append('<div style="padding-bottom:5px;"><input type="file" name="attachments[]" /></div>');
}
</script>
<?php 


?>
<div class="container-fluid" id="container" style="max-width:90%">
	<iframe name="ninjaframe" style="display:none ; width:500px; height:200px;"  ></iframe>
	<form action="<?php echo site_url("lp/myrates/add")."/".$rate['id']; ?>" method="post" enctype="multipart/form-data" target="">
	<div class="row">
		<div class="col-md-4">
			<?php
			if($rate['id']){
				?><h2>RATE <?php echo $rate['id'] ?></h2>
				<?php
			}
			else{
				?><h2>ADD RATE</h2><?php
			}
			?>
		</div>
		<div class="col-md-8 text-right">
			<input type="button" class="btn btn-default" style="margin:20px;" value="Back to My Rates" onclick="self.location='<?php echo site_url("lp") ?>/myrates'">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-left">
			<table class="table table-bordered">
				<tr>
					<td colspan=4>
						<table class="table table-bordered">
						<tr>
							<th width="50%">Port Loading</th>
							<th width="50%">Port Discharge</th>
						</tr>
						<tr>
							<td width="50%">
							Country:
							<select class="form-control" name='origin[country]' id="origin_country" onchange="getPorts('origin_port', this.value)">
							<option value="AL - Albania">Albania</option>
							<option value="DZ - Algeria">Algeria</option>
							<option value="AO - Angola">Angola</option>
							<option value="AR - Argentina">Argentina</option>
							<option value="AW - Aruba">Aruba</option>
							<option value="AU - Australia">Australia</option>
							<option value="BS - Bahamas">Bahamas</option>
							<option value="BH - Bahrain">Bahrain</option>
							<option value="BD - Bangladesh">Bangladesh</option>
							<option value="BE - Belgium">Belgium</option>
							<option value="BZ - Belize">Belize</option>
							<option value="BJ - Benin">Benin</option>
							<option value="BR - Brazil">Brazil</option>
							<option value="VG - British Virgin Islands">British Virgin Islands</option>
							<option value="BN - Brunei">Brunei</option>
							<option value="BG - Bulgaria">Bulgaria</option>
							<option value="KH - Cambodia">Cambodia</option>
							<option value="CM - Cameroon">Cameroon</option>
							<option value="CA - Canada">Canada</option>
							<option value="CV - Cape Verde">Cape Verde</option>
							<option value="CL - Chile">Chile</option>
							<option value="CN - China">China</option>
							<option value="CO - Colombia">Colombia</option>
							<option value="KM - Comoros">Comoros</option>
							<option value="CR - Costa Rica">Costa Rica</option>
							<option value="HR - Croatia">Croatia</option>
							<option value="CU - Cuba">Cuba</option>
							<option value="CY - Cyprus">Cyprus</option>
							<option value="CD - Democratic Republic of the Congo">Democratic Republic of the Congo</option>
							<option value="DK - Denmark">Denmark</option>
							<option value="DJ - Djibouti">Djibouti</option>
							<option value="DO - Dominican Republic">Dominican Republic</option>
							<option value="EC - Ecuador">Ecuador</option>
							<option value="EG - Egypt">Egypt</option>
							<option value="SV - El Salvador">El Salvador</option>
							<option value="GQ - Equatorial Guinea">Equatorial Guinea</option>
							<option value="ER - Eritrea">Eritrea</option>
							<option value="EE - Estonia">Estonia</option>
							<option value="FO - Faroe Islands">Faroe Islands</option>
							<option value="FJ - Fiji">Fiji</option>
							<option value="FI - Finland">Finland</option>
							<option value="FR - France">France</option>
							<option value="GF - French Guiana">French Guiana</option>
							<option value="GA - Gabon">Gabon</option>
							<option value="GM - Gambia">Gambia</option>
							<option value="GE - Georgia">Georgia</option>
							<option value="DE - Germany">Germany</option>
							<option value="GH - Ghana">Ghana</option>
							<option value="GI - Gibraltar">Gibraltar</option>
							<option value="GR - Greece">Greece</option>
							<option value="GL - Greenland">Greenland</option>
							<option value="GP - Guadeloupe">Guadeloupe</option>
							<option value="GT - Guatemala">Guatemala</option>
							<option value="GN - Guinea">Guinea</option>
							<option value="GW - Guinea-Bissau">Guinea-Bissau</option>
							<option value="GY - Guyana">Guyana</option>
							<option value="HT - Haiti">Haiti</option>
							<option value="HN - Honduras">Honduras</option>
							<option value="HK - Hong Kong">Hong Kong</option>
							<option value="IS - Iceland">Iceland</option>
							<option value="IN - India">India</option>
							<option value="ID - Indonesia">Indonesia</option>
							<option value="IR - Iran">Iran</option>
							<option value="IQ - Iraq">Iraq</option>
							<option value="IE - Ireland">Ireland</option>
							<option value="IM - Isle of Man">Isle of Man</option>
							<option value="IL - Israel">Israel</option>
							<option value="IT - Italy">Italy</option>
							<option value="JM - Jamaica">Jamaica</option>
							<option value="JP - Japan">Japan</option>
							<option value="JO - Jordan">Jordan</option>
							<option value="KE - Kenya">Kenya</option>
							<option value="KW - Kuwait">Kuwait</option>
							<option value="LV - Latvia">Latvia</option>
							<option value="LB - Lebanon">Lebanon</option>
							<option value="LR - Liberia">Liberia</option>
							<option value="LY - Libya">Libya</option>
							<option value="LT - Lithuania">Lithuania</option>
							<option value="MO - Macao">Macao</option>
							<option value="MG - Madagascar">Madagascar</option>
							<option value="MY - Malaysia">Malaysia</option>
							<option value="MV - Maldives">Maldives</option>
							<option value="MT - Malta">Malta</option>
							<option value="MQ - Martinique">Martinique</option>
							<option value="MR - Mauritania">Mauritania</option>
							<option value="MU - Mauritius">Mauritius</option>
							<option value="MX - Mexico">Mexico</option>
							<option value="MA - Morocco">Morocco</option>
							<option value="MZ - Mozambique">Mozambique</option>
							<option value="NA - Namibia">Namibia</option>
							<option value="NL - Netherlands">Netherlands</option>
							<option value="NC - New Caledonia">New Caledonia</option>
							<option value="NZ - New Zealand">New Zealand</option>
							<option value="NI - Nicaragua">Nicaragua</option>
							<option value="NG - Nigeria">Nigeria</option>
							<option value="KP - North Korea">North Korea</option>
							<option value="NO - Norway">Norway</option>
							<option value="OM - Oman">Oman</option>
							<option value="PK - Pakistan">Pakistan</option>
							<option value="PA - Panama">Panama</option>
							<option value="PG - Papua New Guinea">Papua New Guinea</option>
							<option value="PY - Paraguay">Paraguay</option>
							<option value="PE - Peru">Peru</option>
							<option value="PH - Philippines">Philippines</option>
							<option value="PL - Poland">Poland</option>
							<option value="PT - Portugal">Portugal</option>
							<option value="PR - Puerto Rico">Puerto Rico</option>
							<option value="QA - Qatar">Qatar</option>
							<option value="CG - Republic of the Congo">Republic of the Congo</option>
							<option value="RO - Romania">Romania</option>
							<option value="RU - Russia">Russia</option>
							<option value="WS - Samoa">Samoa</option>
							<option value="ST - Sao Tome and Principe">Sao Tome and Principe</option>
							<option value="SA - Saudi Arabia">Saudi Arabia</option>
							<option value="SN - Senegal">Senegal</option>
							<option value="SC - Seychelles">Seychelles</option>
							<option value="SL - Sierra Leone">Sierra Leone</option>
							<option value="SG - Singapore">Singapore</option>
							<option value="SB - Solomon Islands">Solomon Islands</option>
							<option value="SO - Somalia">Somalia</option>
							<option value="ZA - South Africa">South Africa</option>
							<option value="GS - South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
							<option value="KR - South Korea">South Korea</option>
							<option value="ES - Spain">Spain</option>
							<option value="LK - Sri Lanka">Sri Lanka</option>
							<option value="SD - Sudan">Sudan</option>
							<option value="SR - Suriname">Suriname</option>
							<option value="SE - Sweden">Sweden</option>
							<option value="SY - Syria">Syria</option>
							<option value="TW - Taiwan">Taiwan</option>
							<option value="TZ - Tanzania">Tanzania</option>
							<option value="TH - Thailand">Thailand</option>
							<option value="TG - Togo">Togo</option>
							<option value="TN - Tunisia">Tunisia</option>
							<option value="TR - Turkey">Turkey</option>
							<option value="TC - Turks and Caicos Islands">Turks and Caicos Islands</option>
							<option value="TV - Tuvalu">Tuvalu</option>
							<option value="UA - Ukraine">Ukraine</option>
							<option value="AE - United Arab Emirates">United Arab Emirates</option>
							<option value="GB - United Kingdom">United Kingdom</option>
							<option value="US - United States">United States</option>
							<option value="UY - Uruguay">Uruguay</option>
							<option value="VI - U.S. Virgin Islands">U.S. Virgin Islands</option>
							<option value="VU - Vanuatu">Vanuatu</option>
							<option value="VE - Venezuela">Venezuela</option>
							<option value="VN - Vietnam">Vietnam</option>
							<option value="YE - Yemen">Yemen</option>
							</select>
							</td>
							<td width="50%">
							Country:
							<select id="destination_country" class="form-control" name='destination[country]' onchange="getPorts('destination_port', this.value)">
							<option value="AL - Albania">Albania</option>
							<option value="DZ - Algeria">Algeria</option>
							<option value="AO - Angola">Angola</option>
							<option value="AR - Argentina">Argentina</option>
							<option value="AW - Aruba">Aruba</option>
							<option value="AU - Australia">Australia</option>
							<option value="BS - Bahamas">Bahamas</option>
							<option value="BH - Bahrain">Bahrain</option>
							<option value="BD - Bangladesh">Bangladesh</option>
							<option value="BE - Belgium">Belgium</option>
							<option value="BZ - Belize">Belize</option>
							<option value="BJ - Benin">Benin</option>
							<option value="BR - Brazil">Brazil</option>
							<option value="VG - British Virgin Islands">British Virgin Islands</option>
							<option value="BN - Brunei">Brunei</option>
							<option value="BG - Bulgaria">Bulgaria</option>
							<option value="KH - Cambodia">Cambodia</option>
							<option value="CM - Cameroon">Cameroon</option>
							<option value="CA - Canada">Canada</option>
							<option value="CV - Cape Verde">Cape Verde</option>
							<option value="CL - Chile">Chile</option>
							<option value="CN - China">China</option>
							<option value="CO - Colombia">Colombia</option>
							<option value="KM - Comoros">Comoros</option>
							<option value="CR - Costa Rica">Costa Rica</option>
							<option value="HR - Croatia">Croatia</option>
							<option value="CU - Cuba">Cuba</option>
							<option value="CY - Cyprus">Cyprus</option>
							<option value="CD - Democratic Republic of the Congo">Democratic Republic of the Congo</option>
							<option value="DK - Denmark">Denmark</option>
							<option value="DJ - Djibouti">Djibouti</option>
							<option value="DO - Dominican Republic">Dominican Republic</option>
							<option value="EC - Ecuador">Ecuador</option>
							<option value="EG - Egypt">Egypt</option>
							<option value="SV - El Salvador">El Salvador</option>
							<option value="GQ - Equatorial Guinea">Equatorial Guinea</option>
							<option value="ER - Eritrea">Eritrea</option>
							<option value="EE - Estonia">Estonia</option>
							<option value="FO - Faroe Islands">Faroe Islands</option>
							<option value="FJ - Fiji">Fiji</option>
							<option value="FI - Finland">Finland</option>
							<option value="FR - France">France</option>
							<option value="GF - French Guiana">French Guiana</option>
							<option value="GA - Gabon">Gabon</option>
							<option value="GM - Gambia">Gambia</option>
							<option value="GE - Georgia">Georgia</option>
							<option value="DE - Germany">Germany</option>
							<option value="GH - Ghana">Ghana</option>
							<option value="GI - Gibraltar">Gibraltar</option>
							<option value="GR - Greece">Greece</option>
							<option value="GL - Greenland">Greenland</option>
							<option value="GP - Guadeloupe">Guadeloupe</option>
							<option value="GT - Guatemala">Guatemala</option>
							<option value="GN - Guinea">Guinea</option>
							<option value="GW - Guinea-Bissau">Guinea-Bissau</option>
							<option value="GY - Guyana">Guyana</option>
							<option value="HT - Haiti">Haiti</option>
							<option value="HN - Honduras">Honduras</option>
							<option value="HK - Hong Kong">Hong Kong</option>
							<option value="IS - Iceland">Iceland</option>
							<option value="IN - India">India</option>
							<option value="ID - Indonesia">Indonesia</option>
							<option value="IR - Iran">Iran</option>
							<option value="IQ - Iraq">Iraq</option>
							<option value="IE - Ireland">Ireland</option>
							<option value="IM - Isle of Man">Isle of Man</option>
							<option value="IL - Israel">Israel</option>
							<option value="IT - Italy">Italy</option>
							<option value="JM - Jamaica">Jamaica</option>
							<option value="JP - Japan">Japan</option>
							<option value="JO - Jordan">Jordan</option>
							<option value="KE - Kenya">Kenya</option>
							<option value="KW - Kuwait">Kuwait</option>
							<option value="LV - Latvia">Latvia</option>
							<option value="LB - Lebanon">Lebanon</option>
							<option value="LR - Liberia">Liberia</option>
							<option value="LY - Libya">Libya</option>
							<option value="LT - Lithuania">Lithuania</option>
							<option value="MO - Macao">Macao</option>
							<option value="MG - Madagascar">Madagascar</option>
							<option value="MY - Malaysia">Malaysia</option>
							<option value="MV - Maldives">Maldives</option>
							<option value="MT - Malta">Malta</option>
							<option value="MQ - Martinique">Martinique</option>
							<option value="MR - Mauritania">Mauritania</option>
							<option value="MU - Mauritius">Mauritius</option>
							<option value="MX - Mexico">Mexico</option>
							<option value="MA - Morocco">Morocco</option>
							<option value="MZ - Mozambique">Mozambique</option>
							<option value="NA - Namibia">Namibia</option>
							<option value="NL - Netherlands">Netherlands</option>
							<option value="NC - New Caledonia">New Caledonia</option>
							<option value="NZ - New Zealand">New Zealand</option>
							<option value="NI - Nicaragua">Nicaragua</option>
							<option value="NG - Nigeria">Nigeria</option>
							<option value="KP - North Korea">North Korea</option>
							<option value="NO - Norway">Norway</option>
							<option value="OM - Oman">Oman</option>
							<option value="PK - Pakistan">Pakistan</option>
							<option value="PA - Panama">Panama</option>
							<option value="PG - Papua New Guinea">Papua New Guinea</option>
							<option value="PY - Paraguay">Paraguay</option>
							<option value="PE - Peru">Peru</option>
							<option value="PH - Philippines">Philippines</option>
							<option value="PL - Poland">Poland</option>
							<option value="PT - Portugal">Portugal</option>
							<option value="PR - Puerto Rico">Puerto Rico</option>
							<option value="QA - Qatar">Qatar</option>
							<option value="CG - Republic of the Congo">Republic of the Congo</option>
							<option value="RO - Romania">Romania</option>
							<option value="RU - Russia">Russia</option>
							<option value="WS - Samoa">Samoa</option>
							<option value="ST - Sao Tome and Principe">Sao Tome and Principe</option>
							<option value="SA - Saudi Arabia">Saudi Arabia</option>
							<option value="SN - Senegal">Senegal</option>
							<option value="SC - Seychelles">Seychelles</option>
							<option value="SL - Sierra Leone">Sierra Leone</option>
							<option value="SG - Singapore">Singapore</option>
							<option value="SB - Solomon Islands">Solomon Islands</option>
							<option value="SO - Somalia">Somalia</option>
							<option value="ZA - South Africa">South Africa</option>
							<option value="GS - South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
							<option value="KR - South Korea">South Korea</option>
							<option value="ES - Spain">Spain</option>
							<option value="LK - Sri Lanka">Sri Lanka</option>
							<option value="SD - Sudan">Sudan</option>
							<option value="SR - Suriname">Suriname</option>
							<option value="SE - Sweden">Sweden</option>
							<option value="SY - Syria">Syria</option>
							<option value="TW - Taiwan">Taiwan</option>
							<option value="TZ - Tanzania">Tanzania</option>
							<option value="TH - Thailand">Thailand</option>
							<option value="TG - Togo">Togo</option>
							<option value="TN - Tunisia">Tunisia</option>
							<option value="TR - Turkey">Turkey</option>
							<option value="TC - Turks and Caicos Islands">Turks and Caicos Islands</option>
							<option value="TV - Tuvalu">Tuvalu</option>
							<option value="UA - Ukraine">Ukraine</option>
							<option value="AE - United Arab Emirates">United Arab Emirates</option>
							<option value="GB - United Kingdom">United Kingdom</option>
							<option value="US - United States">United States</option>
							<option value="UY - Uruguay">Uruguay</option>
							<option value="VI - U.S. Virgin Islands">U.S. Virgin Islands</option>
							<option value="VU - Vanuatu">Vanuatu</option>
							<option value="VE - Venezuela">Venezuela</option>
							<option value="VN - Vietnam">Vietnam</option>
							<option value="YE - Yemen">Yemen</option>
							</select>
							</td>
						</tr>
						<tr>
							<td width="50%">
							Port:<select class="form-control" name='origin[port]' id="origin_port"></select>
							</td>
							<td width="50%">
							Port:<select class="form-control" name='destination[port]' id="destination_port"></select>
							</td>
						</tr>
						</table>
						<script>
						jQuery("#origin_country").val("<?php echo $rate['origin_country_code']." - ".$rate['origin_country']; ?>");
						getPorts("origin_port", "<?php echo $rate['origin_country_code']." - ".$rate['origin_country']; ?>", true);
						jQuery("#destination_country").val("<?php echo $rate['destination_country_code']." - ".$rate['destination_country']; ?>");
						getPorts("destination_port", "<?php echo $rate['destination_country_code']." - ".$rate['destination_country']; ?>", true);
						
						</script>
					
					
					</td>
				</tr>
				<tr>
					<td colspan=4>
					<b>Validity Dates:</b>
						<table class="table table-bordered">
							<tr>
								<td width="25%">
								From:
								</td>
								<td width="25%">
								<div style="position:relative">
								<input value="<?php echo $rate['validity_date_from']; ?>" type="text" class="form-control" name='validity_date_from' id="validity_date_from" readonly>
								<span class="glyphicon glyphicon-calendar" style="position:absolute; top:11px; cursor:pointer; right:20px" onclick="validity_date_from.show()"></span>
								</div>
								</td>
								<td width="25%">
								To:
								</td>
								<td width="25%">
								<div style="position:relative">
								<input value="<?php echo $rate['validity_date_to']; ?>" name="validity_date_to" type="text" class="form-control" readonly>
								<span class="glyphicon glyphicon-calendar" style="position:absolute; top:11px; cursor:pointer; right:20px" onclick="validity_date_to.show()"></span>
								</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan=4>
						<div class="row" style="width:100%">
							<div class="col-md-3"><b>Container Type:</b></div>
							<div class="col-md-3">
								<select name="container_type" id="container_type" class="form-control">
									<option value="20’ST">20’ST</option>
									<option value="40’ST">40’ST</option>
									<option value="20’HQ">20’HQ</option>
									<option value="40’HQ">40’HQ</option>
									<option value="20’REF">20’REF</option>
									<option value="40’REF">40’REF</option>
									<option value="20’BULK">20’BULK</option>
									<option value="20’TANK">20’TANK</option>
									<option value="EXP">EXP</option>
									<option value="IMP">IMP</option>
									<option value="TRAN">TRAN</option>
								</select>
								<script>
									jQuery("#container_type").val("<?php echo $rate['container_type']; ?>");
								</script>
							</div>
							<div class="col-md-3"><b>Line Terms:</b></div>
							<div class="col-md-3">
								<select name="line_terms" id="line_terms" class="form-control">
									<option value="FIOS">Free in/out (loading/discharging is at consigner's cost)</option>
									<option value="FIFO">Free in/Free out (vide FIOS)</option>
									<option value="FILO">Free in/Liner out (loading is at consigner's cost, discharging is at liner cost)</option>
									<option value="LIFO">Liner in/Free out (loading is at liner cost, discharging is at consigner's cost)</option>
									<option value="LILO">Liner in/out (loading and discharging is at liner cost)</option>
								</select>
								<script>
									jQuery("#line_terms").val("<?php echo $rate['line_terms']; ?>");
								</script>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan=4>
						<div class="row" style="width:100%">
							<div class="col-md-3">
								<b>Max Weight:</b>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" name="max_weight" id="max_weight" />
							</div>
							<div class="col-md-3">
								<select name="max_weight_unit" id="max_weight_unit" class="form-control">
									<option value="kg">kg</option>
									<option value="lb">lb</option>
								</select>
							</div>
						</div>
						<script>
							jQuery("#max_weight").val("<?php echo $rate['max_weight']; ?>");
							jQuery("#max_weight_unit").val("<?php echo $rate['max_weight_unit']; ?>");
						</script>
					</td>
				</tr>
				<tr>
					<td colspan=4>
						<div class="row" style="width:100%">
							<div class="col-md-3">
								<b>Valid For:</b>
							</div>
							<div class="col-md-3">
								<select name="valid_for" id="valid_for" class="form-control">
									<option value="30">30 days</option>
									<option value="45">45 days</option>
									<option value="60">60 days</option>
								</select>
							</div>
						</div>
						<script>
							jQuery("#valid_for").val("<?php echo $rate['valid_for']; ?>");
						</script>
					</td>
				</tr>
				<tr>
					<td colspan=4>
						<div class="row" style="width:100%">
							<div class="col-md-3">
								<b>Sales rate:</b>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" name="sales_rate" id="sales_rate" />
							</div>
							<div class="col-md-3">
								<?php 
								$currency_name = "sales_rate_currency";
								include_once(dirname(__FILE__)."/currency_form.php"); 
								?>
								<script>
									jQuery("#currency").val("<?php echo $rate['sales_rate_currency']; ?>");
								</script>
							</div>
						</div>
						<script>
							jQuery("#sales_rate").val("<?php echo number_format($rate['sales_rate'], 2, ".", ""); ?>");
						</script>
					</td>
				</tr>
				
				<tr>
					<td colspan=4 class="text-center">
						<script>
						function validateRate(){
							if(jQuery("#sales_rate").val()>0){
									return true;
							}
							else{
								alert("Please input a valid sales rate value!");
								return false;
							}
						}
						function deleteRate(){
							if(confirm("Are you sure you want to delete this rate detail?")){
									self.location="<?php echo site_url("lp")."/myrates/delete/".$rate['id']; ?>";
									return true;
							}
						}
						</script>
						<input type="submit" class="btn btn-primary btn-default" style="margin:20px;" value="Save" onclick="return validateRate();" >
						<?php
						if($rate['id']){
							?>
							<input type="button" class="btn btn-primary btn-danger" style="margin:20px;" value="Delete" onclick="return deleteRate();" >
							<?php
						}
						?>
					</td>
				</tr>
				
			</table>
			
			<?php
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			?>
		</div>
	</div>
</form>
</div><br />