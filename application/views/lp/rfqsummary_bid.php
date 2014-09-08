<?php
//echo "<pre>";
//print_r($rfq);
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
/*
tr.contact_info { display: none }
*/
</style>
<script>
function setPort(idx){
	
	if(idx=="origin_port"){
		jQuery("#"+idx).val("<?php echo SDEncrypt($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rfq['shipping_info']['origin']['port_id'])."--".$rfq['shipping_info']['origin']['port']; ?>");
		}
	}
	else{
		jQuery("#"+idx).val("<?php echo SDEncrypt($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>");
		if(jQuery("#"+idx).val()!="<?php echo SDEncrypt($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>"){
			jQuery("#"+idx).val("<?php echo ($rfq['shipping_info']['destination']['port_id'])."--".$rfq['shipping_info']['destination']['port']; ?>");
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

jQuery(function() {
    jQuery('#contact_info_trigger').click(function() {
		<?php
		if($credits>0){
			?>
			if(confirm("Viewing this contact will cost <?php echo $credits; ?> SeaDex Credits. Are you sure you want to view the contact details?")){
				self.location='?view';
			}
			<?php
		}
		else{
			?>
			self.location='?view';
			<?php
		}
		?>
        /*
		var ctr = 0; var trigger = jQuery(this);
        jQuery('tr.contact_info').toggle(400, function() {
            ctr++;
            if(ctr == 1) { // Perform only once.
                if(jQuery('tr.contact_info :first').is(':hidden')) trigger.removeClass('btn-primary');
                else {
                    trigger.addClass('btn-primary');
                    app.view();
                }
            }
        });
		*/
    });
    
    var app = {
        
        // Logs the view activity in the DBase.
        view : function() {
            jQuery.ajax({
                type : 'POST',
                data : {
                    rfq_id : '<?php echo $rfq['id']?>',
                    t : (new Date).getTime()
                },
                url : '<?php echo site_url('activity/async_contact_views')?>'
            });
        }
    };
	
	<?php
	if(isset($view)){
		?>
		app.view();
		<?php
	}
	?>
}); // @end.
</script>
<?php 
//echo "<pre>";
//print_r($rfq);
//echo "</pre>";
$_SESSION['for_bidding']['rfq_id'] = $rfq['id'];

if($rfq['userprofile']['firstname']){
	$rfq['userprofile']['first_name'] = $rfq['userprofile']['firstname'];
}
if($rfq['userprofile']['first_name']){
	$rfq['userprofile']['firstname'] = $rfq['userprofile']['first_name'];
}

if($rfq['userprofile']['lastname']){
	$rfq['userprofile']['last_name'] = $rfq['userprofile']['lastname'];
}
if($rfq['userprofile']['last_name']){
	$rfq['userprofile']['lastname'] = $rfq['userprofile']['last_name'];
}

if($rfq['userprofile']['contactnumber']){
	$rfq['userprofile']['contact_number'] = $rfq['userprofile']['contactnumber'];
}
if($rfq['userprofile']['contact_number']){
	$rfq['userprofile']['contactnumber'] = $rfq['userprofile']['contact_number'];
}

if($rfq['userprofile']['type']){
	$rfq['userprofile']['customer_type'] = $rfq['userprofile']['type'];
}
if($rfq['userprofile']['customer_type']){
	$rfq['userprofile']['type'] = $rfq['userprofile']['customer_type'];
}


?>
<div class="container-fluid" id="container" style="max-width:90%">
	<?php include_once(dirname(__FILE__)."/credits.php"); ?>
	<iframe name="ninjaframe" style="display:none ; width:500px; height:200px;"  ></iframe>
	<form action="<?php echo site_url("lp/submit_bid"); ?>" method="post" enctype="multipart/form-data" target="ninjaframe">
	<div class="row">
		<div class="col-md-4">

		</div>
		<div class="col-md-8 text-right">
                        <input type="button" class="btn btn-default" style="margin:20px;  margin-top:0px;" value="Back to Dashboard" onclick="self.location='<?php echo site_url("lp") ?>'">
			<?php
			if($rfqprevid){
				?><input type="button" class="btn btn-default" style="margin:20px;  margin-top:0px;" value="Previous RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqprevid ?>'"><?php
			}
			if($rfqnextid){
				?><input type="button" class="btn btn-default" style="margin:20px;  margin-top:0px;" value="Next RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqnextid ?>'"><?php
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-left">
			<table class="table table-bordered">
				<tr>
					<th colspan=2 class="text-center"  style="background:#f0f0f0">
						RFQ # <?php echo $rfq['id'] ?>
					</th>
				</tr>
                <?php
				if($message){
					?>
					<tr><td colspan="2" style="text-align: center; color:green">
					<?php 
					echo $message;
					?>
					</td></tr>
					<?php
				}
				if($error){
					?>
					<tr><td colspan="2" style="text-align: center; color:red">
					<?php 
					echo $error;
					?>
					</td></tr>
					<?php
				}
				if(!isset($view)){
					?>
					<tr><td colspan="2" style="text-align: center">
					<input type="button" class="btn btn-default" style="margin:20px;" value="<?php echo $viewcontact; ?>" id="contact_info_trigger" />
					</td></tr>
					<?php
				}
				?>
				
				<?php
				if(isset($view)){
					?>
					<tr>
						<th colspan=2 class="text-center"  style="background:#f0f0f0">
						Customer Contact Information
						</th>
					</tr>
					<tr class="contact_info">
						<th width="50%">Customer Type</th>
						<td width="50%"><?php echo ucfirst($rfq['customer_type']); ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">E-mail</th>
						<td width="50%"><?php echo $rfq['userprofile']['email']; ?></td>
					</tr>
					<?php
					if($rfq['userprofile']['company_name']){
						?>
						<tr class="contact_info">
							<th width="50%">Company Name</th>
							<td width="50%"><?php echo $rfq['userprofile']['company_name']; ?></td>
						</tr>
						<?php
					}
					?>
					<tr class="contact_info">
						<th width="50%">First Name</th>
						<td width="50%"><?php echo $rfq['userprofile']['firstname']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Last Name</th>
						<td width="50%"><?php echo $rfq['userprofile']['lastname']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Country</th>
						<td width="50%"><?php echo $rfq['userprofile']['country']; ?></td>
					</tr>
					<tr class="contact_info">
						<th width="50%">Contact Number</th>
						<td width="50%"><?php echo $rfq['userprofile']['contactnumber']; ?></td>
					</tr>
					<?php
					if(isset($rfq['shipping_info']['type_of_company_to_quote'])){
						?>
						<tr class="contact_info">
							<th width="50%">RFQ for</th>
							<td width="50%">
							<?php echo $rfq['shipping_info']['type_of_company_to_quote']; ?>
							</td>
						</tr>
						<?php
					}
				}
				if(isset($rfq['shipping_info'])){
					?>
					<tr>
						<th colspan=2 class="text-center"  style="background:#f0f0f0">
						Shipping Information
						</th>
					</tr>
					<tr>
						<td colspan=2  style="background:#fafafa">
							<table class="table table-bordered">
								<tr>
									<th width="25%">Origin</th>
									<th width="25%">Proposed Origin and Pickup Date</th>
									<th width="25%">Destination</th>
									<th width="25%">Proposed Destination and Delivery Date</th>
								</tr>
								<tr>
									<td width="25%"><b>Country:</b> <?php echo $rfq['shipping_info']['origin']['country']; ?></td>
									<td width="25%">
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
									<td width="25%"><b>Country:</b> <?php echo $rfq['shipping_info']['destination']['country']; ?></td>
									<td width="25%">
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
									<td width="25%"><b>City:</b> <?php echo $rfq['shipping_info']['origin']['city']; ?></td>
									<td width="25%"><input type="text" class="form-control" name='origin[city]' placeholder="City" value="<?php echo htmlentitiesX($rfq['shipping_info']['origin']['city']); ?>"></td>
									<td width="25%"><b>City:</b> <?php echo $rfq['shipping_info']['destination']['city']; ?></td>
									<td width="25%"> <input type="text" class="form-control" name='destination[city]' placeholder="City" value="<?php echo htmlentitiesX($rfq['shipping_info']['destination']['city']); ?>"></td>
								</tr>
								<tr>
									<td width="25%"><b>Port:</b> <?php echo $rfq['shipping_info']['origin']['port']; ?></td>
									<td width="25%">
									<select class="form-control" name='origin[port]' id="origin_port"></select>
									</td>
									<td width="25%"><b>Port:</b> <?php echo $rfq['shipping_info']['destination']['port']; ?></td>
									<td width="25%">
									<select class="form-control" name='destination[port]' id="destination_port"></select>
									</td>
								</tr>
								<tr>
									<td width="25%"><b>Pickup Date (m/d/y):</b> <?php echo $rfq['shipping_info']['origin']['date']; ?></td>
									<td width="25%">
									<div style="position:relative">
									<input value="<?php echo $rfq['shipping_info']['origin']['date']; ?>" type="text" class="form-control" name='origin[date]' id="origin_date" readonly>
									<span class="glyphicon glyphicon-calendar" style="position:absolute; top:11px; cursor:pointer; right:20px"onclick="pickup.show()"></span>
									</div>
									</td>
									<td width="25%"><b>Delivery Date (m/d/y):</b> <?php echo $rfq['shipping_info']['destination']['date']; ?></td>
									<td width="25%">
									<div style="position:relative">
									<input value="<?php echo $rfq['shipping_info']['destination']['date']; ?>" type="text" class="form-control" name='destination[date]' id="destination_date" readonly>
									<span class="glyphicon glyphicon-calendar" style="position:absolute; top:11px; cursor:pointer; right:20px"onclick="delivery.show()"></span>
									</div>
									</td>
								</tr>
								<tr>
									<td width="25%"><b>Alternate Pickup Date:</b> <?php echo $rfq['shipping_info']['origin']['alternate_date']; ?></td>
									<td width="25%"></td>
									<td width="25%"><b>Alternate Delivery Date:</b> <?php echo $rfq['shipping_info']['destination']['alternate_date']; ?></td>
									<td width="25%"></td>
								</tr>
								<!--
								<tr>
									<td width="50%"><?php echo $rfq['shipping_info']['origin']['time_zone']; ?> GMT</td>
									<td width="50%"><?php echo $rfq['shipping_info']['destination']['time_zone']; ?>  GMT</td>
								</tr>
								-->
							</table>
							<script>
							jQuery("#origin_country").val("<?php echo $rfq['shipping_info']['origin']['country_code']." - ".$rfq['shipping_info']['origin']['country']; ?>");
							getPorts("origin_port", "<?php echo $rfq['shipping_info']['origin']['country_code']." - ".$rfq['shipping_info']['origin']['country']; ?>", true);
							jQuery("#destination_country").val("<?php echo $rfq['shipping_info']['destination']['country_code']." - ".$rfq['shipping_info']['destination']['country']; ?>");
							getPorts("destination_port", "<?php echo $rfq['shipping_info']['destination']['country_code']." - ".$rfq['shipping_info']['destination']['country']; ?>", true);
							
							</script>
							
							<style>
								#map-canvas {
								width: 500px;
								height:300px;
								margin: auto;
								padding: 0px
							  }
							</style>
							<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
							<script>
							function initialize() {
							  var myLatlng = new google.maps.LatLng(<?php echo $rfq['shipping_info']['origin']['port_coords']['lat']; ?>,<?php echo $rfq['shipping_info']['origin']['port_coords']['lon']; ?>);
							  
							  
							  
							  var mapOptions = {
								zoom: 2,
								center: myLatlng
							  }
							  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

							  
							  var marker = new google.maps.Marker({
								  position: myLatlng,
								  map: map,
								  title: "<?php echo htmlentitiesX($rfq['shipping_info']['origin']['port_coords']['name']); ?>"
							  });
							  
							  var myLatlng2 = new google.maps.LatLng(<?php echo $rfq['shipping_info']['destination']['port_coords']['lat']; ?>,<?php echo $rfq['shipping_info']['destination']['port_coords']['lon']; ?>);
							  var marker2 = new google.maps.Marker({
								  position: myLatlng2,
								  map: map,
								  title: "<?php echo htmlentitiesX($rfq['shipping_info']['destination']['port_coords']['name']); ?>"
							  });
							 
							}

							google.maps.event.addDomListener(window, 'load', initialize);
							</script>
							<div id="map-canvas" ></div>
							
							
						</td>
					</tr>
					
					<?php
				}
				$t = count($rfq['cargo']);
				if($t){
					?>
					<tr>
						<th colspan=2 class="text-center" style="background:#f0f0f0">
						Cargo Details
						</th>
					</tr>
					<tr>
						<td colspan=2 style="background:#fafafa">
							
							<?php
							foreach($rfq['cargo'] as $i => $cargo){
								?>
								<table class="table table-bordered">
								<tr>
									<th width="50%">Cargo Type</th>
									<td width="50%">
									<?php echo $cargo['what_to_move']; ?>&nbsp;
									</td>
								</tr>
								<tr>
									<th colspan=2>Cargo Details</th>
								</tr>
								<tr>
									<td colspan=2>
										<?php 
											if(!$cargo['details']){
												echo "<center><strong>...</strong></center>";
											}
											else{
												//echo "<pre>";
												//print_r($cargo['details']);
												//echo "</pre>";
												if($cargo['details']['cargo_details']=="household"){
													?>
													
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">What to Move</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_move'];
														?></td>
													</tr>
													<?php
													if($cargo['details']['type_of_move']=="Full house/home move"){
														?>
														<tr>
															<th>House Size</th>
															<td>
															<?php
															echo $cargo['details']['fullhouse_size'];
															?></td>
														</tr>
														<?php
													}
													else if($cargo['details']['type_of_move']=="Pieces of Furniture"){
														?>
														<tr>
															<th>In Container</th>
															<td>
															<?php
															echo $cargo['details']['in_container'];
															?></td>
														</tr>
														<?php
														if($cargo['details']['in_container']=="Yes"){
															?>
															<tr>
																<th>Container Size</th>
																<td>
																<?php
																echo $cargo['details']['container_size'];
																?></td>
															</tr>
															<?php
														}
														else{
															$t = count($cargo['details']['packing']['name']);
															for($i=0; $i<$t; $i++){
																?>
																<tr>
																	<th colspan=2>
																	Packing - <?php echo $cargo['details']['packing']['name'][$i];
																	if(trim($cargo['details']['packing']['specify'][$i])){
																		echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																	}
																	?>
																	</th>
																</tr>
																<tr>
																	<td colspan=2>
																	<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																	?>
																	<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]+0; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?>
																	</i><br />
																	<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																	</td>
																</tr>
																<?php
															}
														}
													}
													else if($cargo['details']['type_of_move']=="Other"){
														?>
														<tr>
															<td colspan=2>
															<?php
															echo htmlentities($cargo['details']['other_specify']);
															?></td>
														</tr>
														<?php
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
												else if($cargo['details']['cargo_details']=="goods"){
													?>
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">Category</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_goods'];
														?></td>
													</tr>
													<?php
													if(trim($cargo['details']['description'])){
														?>
														<tr>
															<th width="50%">Description</th>
															<td width="50%">
															<?php
															echo $cargo['details']['description'];
															?></td>
														</tr>
														<?php
													}
													if(trim($cargo['details']['imo_code'])){
														?>
														<tr>
															<th width="50%">IMO CODE</th>
															<td width="50%">
															<?php
															echo $cargo['details']['imo_code'];
															?></td>
														</tr>
														<?php
													}
													if($cargo['details']['in_container']=="Yes"){
														?>
														<tr>
															<th>Container Size</th>
															<td>
															<?php
															echo $cargo['details']['container_size'];
															?></td>
														</tr>
														<?php
													}
													else{
														if($cargo['details']['item_in']){
															?>
															<tr>
																<th>Item In</th>
																<td>
																<?php
																echo $cargo['details']['item_in'];
																?></td>
															</tr>
															<tr>
																<th>Item number</th>
																<td>
																<?php
																echo $cargo['details']['item_number'];
																?></td>
															</tr>
															<?php
														}
														$t = count($cargo['details']['packing']['name']);
														for($i=0; $i<$t; $i++){
															?>
															<tr>
																<th colspan=2>
																Packing - <?php echo $cargo['details']['packing']['name'][$i];
																if(trim($cargo['details']['packing']['specify'][$i])){
																	echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																}
																?>
																</th>
															</tr>
															<tr>
																<td colspan=2>
																<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																?>
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?>
																	</i><br />
																	<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																</td>
															</tr>
															<?php
														}
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
												else if($cargo['details']['cargo_details']=="vehicle"){
													?>
													<table class="table table-bordered dotted">
													<tr>
														<th width="50%">Type of Vehicle</th>
														<td width="50%">
														<?php
														echo $cargo['details']['type_of_vehicle'];
														?></td>
													</tr>
													<?php
													if($cargo['details']['in_container']=="Yes"){
														?>
														<tr>
															<th>Container Size</th>
															<td>
															<?php
															echo $cargo['details']['container_size'];
															?></td>
														</tr>
														<?php
													}
													else{
														
														$t = count($cargo['details']['packing']['name']);
														for($i=0; $i<$t; $i++){
															?>
															<tr>
																<th colspan=2>
																Packing - <?php echo $cargo['details']['packing']['name'][$i];
																if(trim($cargo['details']['packing']['specify'][$i])){
																	echo " ( ".htmlentities($cargo['details']['packing']['specify'][$i])." )";
																}
																?>
																</th>
															</tr>
															<tr>
																<td colspan=2>
																<?php
																	if($cargo['details']['packing']['qty'][$i]==0){
																		$cargo['details']['packing']['qty'][$i]= 1;
																	}
																?>
																<span>Quantity:</span> <i><?php echo $cargo['details']['packing']['qty'][$i]; ?></i><br />
																	<span>Length:</span> <i><?php echo ($cargo['details']['packing']['length'][$i]+0)." ".$cargo['details']['packing']['length_unit'][$i]; ?></i><br />
																	<span>Width:</span> <i><?php echo ($cargo['details']['packing']['width'][$i]+0)." ".$cargo['details']['packing']['width_unit'][$i]; ?></i><br />
																	<span>Height:</span> <i><?php echo ($cargo['details']['packing']['height'][$i]+0)." ".$cargo['details']['packing']['height_unit'][$i]; ?></i><br />
																	<span>Total Volume:</span> <i><?php 
																	
																	$volume = ($cargo['details']['packing']['height'][$i]+0)*($cargo['details']['packing']['width'][$i]+0)*($cargo['details']['packing']['length'][$i]+0); 
																	$totalvolume = ($cargo['details']['packing']['qty'][$i]+0)*$volume;
																	$print = $totalvolume." cu ".$cargo['details']['packing']['height_unit'][$i];
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="cm"){
																		$totalvolume = $totalvolume/1000000;
																		$print = $totalvolume." cu m";
																	}
																	
																	if($cargo['details']['packing']['height_unit'][$i]=="in"){
																		$totalvolume = $totalvolume * 0.00057870;
																		$print = $totalvolume." cu ft";
																	}
																	
																	
																	echo $print; 
																	
																	?>
																	</i><br />
																<span>Weight:</span> <i><?php echo ($cargo['details']['packing']['weight'][$i]+0)." ".$cargo['details']['packing']['weight_unit'][$i]; ?></i>
																</td>
															</tr>
															<?php
														}
													}
													if(trim($cargo['details']['additional_info'])){
														?>
														<tr>
															<td colspan=2>
															<b>Additional Information:</b><br />
															<?php
															echo nl2br(strip_tags($cargo['details']['additional_info']));
															?></td>
														</tr>
														<?php
													}
													echo "</table>";
												}
											}
										?>
									</td>
								</tr>
								</table>
								<?php
							}
							?>
							
						</td>
					</tr>
					<tr>
						<th colspan="2" class="text-center"  style="background:#f0f0f0">
						Your Bid
						</th>
					</tr>
					<tr>
						<th>
						Total Bid Price and Attachments
						</th>
						<th>
						Additional Notes
						</th>
					</tr>
					<tr>
						<td>
						<div class="row">
							<div class="col-md-12" style="padding-top:10px;">
							<b>Total Bid Price</b>
							</div>
							<div class="col-md-6">
								<select name="total_bid_currency" class="form-control">
								<option selected="selected" value="USD United States Dollars">
									USD United States Dollars
								</option>
								<option>
									EUR Euro
								</option>
								<option value="CAD Canada Dollars">
									CAD Canada Dollars
								</option>
								<option>
									GBP United Kingdom Pounds
								</option>
								<option>
									DEM Germany Deutsche Marks
								</option>
								<option>
									FRF France Francs
								</option>
								<option>
									JPY Japan Yen
								</option>
								<option>
									NLG Netherlands Guilders
								</option>
								<option>
									ITL Italy Lira
								</option>
								<option>
									CHF Switzerland Francs
								</option>
								<option>
									DZD Algeria Dinars
								</option>
								<option>
									ARP Argentina Pesos
								</option>
								<option>
									AUD Australia Dollars
								</option>
								<option>
									ATS Austria Schillings
								</option>
								<option>
									BSD Bahamas Dollars
								</option>
								<option>
									BBD Barbados Dollars
								</option>
								<option>
									BEF Belgium Francs
								</option>
								<option>
									BMD Bermuda Dollars
								</option>
								<option>
									BRR Brazil Real
								</option>
								<option>
									BGL Bulgaria Lev
								</option>
								<option>
									CAD Canada Dollars
								</option>
								<option>
									CLP Chile Pesos
								</option>
								<option>
									CNY China Yuan Renmimbi
								</option>
								<option>
									CYP Cyprus Pounds
								</option>
								<option>
									CSK Czech Republic Koruna
								</option>
								<option>
									DKK Denmark Kroner
								</option>
								<option>
									NLG Dutch Guilders
								</option>
								<option>
									XCD Eastern Caribbean Dollars
								</option>
								<option>
									EGP Egypt Pounds
								</option>
								<option>
									EUR Euro
								</option>
								<option>
									FJD Fiji Dollars
								</option>
								<option>
									FIM Finland Markka
								</option>
								<option>
									FRF France Francs
								</option>
								<option>
									DEM Germany Deutsche Marks
								</option>
								<option>
									XAU Gold Ounces
								</option>
								<option>
									GRD Greece Drachmas
								</option>
								<option>
									HKD Hong Kong Dollars
								</option>
								<option>
									HUF Hungary Forint
								</option>
								<option>
									ISK Iceland Krona
								</option>
								<option>
									INR India Rupees
								</option>
								<option>
									IDR Indonesia Rupiah
								</option>
								<option>
									IEP Ireland Punt
								</option>
								<option>
									ILS Israel New Shekels
								</option>
								<option>
									ITL Italy Lira
								</option>
								<option>
									JMD Jamaica Dollars
								</option>
								<option>
									JPY Japan Yen
								</option>
								<option>
									JOD Jordan Dinar
								</option>
								<option>
									KRW Korea (South) Won
								</option>
								<option>
									LBP Lebanon Pounds
								</option>
								<option>
									LUF Luxembourg Francs
								</option>
								<option>
									MYR Malaysia Ringgit
								</option>
								<option>
									MXP Mexico Pesos
								</option>
								<option>
									NLG Netherlands Guilders
								</option>
								<option>
									NZD New Zealand Dollars
								</option>
								<option>
									NOK Norway Kroner
								</option>
								<option>
									PKR Pakistan Rupees
								</option>
								<option>
									XPD Palladium Ounces
								</option>
								<option>
									PHP Philippines Pesos
								</option>
								<option>
									XPT Platinum Ounces
								</option>
								<option>
									PLZ Poland Zloty
								</option>
								<option>
									PTE Portugal Escudo
								</option>
								<option>
									ROL Romania Leu
								</option>
								<option>
									RUR Russia Rubles
								</option>
								<option>
									SAR Saudi Arabia Riyal
								</option>
								<option>
									XAG Silver Ounces
								</option>
								<option>
									SGD Singapore Dollars
								</option>
								<option>
									SKK Slovakia Koruna
								</option>
								<option>
									ZAR South Africa Rand
								</option>
								<option>
									KRW South Korea Won
								</option>
								<option>
									ESP Spain Pesetas
								</option>
								<option>
									XDR Special Drawing Right (IMF)
								</option>
								<option>
									SDD Sudan Dinar
								</option>
								<option>
									SEK Sweden Krona
								</option>
								<option>
									CHF Switzerland Francs
								</option>
								<option>
									TWD Taiwan Dollars
								</option>
								<option>
									THB Thailand Baht
								</option>
								<option>
									TTD Trinidad and Tobago Dollars
								</option>
								<option>
									TRL Turkey Lira
								</option>
								<option>
									GBP United Kingdom Pounds
								</option>
								<option>
									USD United States Dollars
								</option>
								<option>
									VEB Venezuela Bolivar
								</option>
								<option>
									ZMK Zambia Kwacha
								</option>
								<option>
									EUR Euro
								</option>
								<option>
									XCD Eastern Caribbean Dollars
								</option>
								<option>
									XDR Special Drawing Right (IMF)
								</option>
								<option>
									XAG Silver Ounces
								</option>
								<option>
									XAU Gold Ounces
								</option>
								<option>
									XPD Palladium Ounces
								</option>
								<option>
									XPT Platinum Ounces
								</option>
								</select>
							</div>
							<div class="col-md-6">
								<input type="text" name="total_bid" id="total_bid" class="form-control" placeholder="e.g. 1000.00" value="0.00" onblur="validDecimal(jQuery(this))" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="padding-top:10px;">
							<b>Attachments</b>&nbsp;&nbsp;<i>(Your company's formal quotation file/s)</i>
							</div>
							<div class="col-md-12">
								<div id="attachments_container" style="padding:10px"><div style="padding-bottom:5px;"><input type="file" name="attachments[]" /></div></div>
								<a href="javascript:moreAttachments()">Add More Attachments</a>
							</div>
						</div>
						</td>
						<td>
							<textarea name="additional_notes" class="form-control" placeholder="Additional Notes" style="height:100%"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan=2 class="text-center">
							<script>
							function validateBid(){
								if(jQuery("#total_bid").val()>0){
									if(confirm('Are you sure you want to submit this bid?')){
										return true;
									}
								}
								else{
									alert("Please input a valid bid value!");
									return false;
								}
							}
							</script>
							<input type="submit" class="btn btn-primary btn-default" style="margin:20px;" value="Submit Your Bid" onclick="return validateBid();" >
							<input type="button" class="btn btn-default" style="margin:20px;" value="Cancel" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfq['id']; ?>'">
							<?php
							if($rfqprevid){
								?><input type="button" class="btn btn-default" style="margin:20px;" value="Previous RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqprevid ?>'"><?php
							}
							if($rfqnextid){
								?><input type="button" class="btn btn-default" style="margin:20px;" value="Next RFQ" onclick="self.location='<?php echo site_url("lp/rfq")."/".$rfqnextid ?>'"><?php
							}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
			<?php
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			?>
		</div>
	</div>
</form>
</div>