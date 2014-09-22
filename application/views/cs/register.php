<script>
function submitProfile(){
		data = jQuery("#userform").serialize();
		jQuery.ajax({
		  type: "POST",
		  url: "<?php echo site_url("cs/register"); ?>",
		  data: data,
		  success: function(msg){
			jQuery("#ninjadiv").html(msg)
		  },
		  //dataType: dataType
		});
}
function custType(type){
	jQuery("#company_name").hide();
	if(type=="professional"){
		jQuery("#company_name").show();
	}
}
function alertX(msg){
	jQuery("#errormessage").html(msg);
	jQuery("#errormessage").hide();
	jQuery("#errormessage").fadeIn(300);
	$('html, body').animate({scrollTop : 0},800);
}

</script>
<div id="ninjadiv" style="display:">
</div>
<div class="row">
	<div class="col-md-12">
		<h2>Sign up as a Consumer</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" method="post" id='userform' action="<?php echo site_url("rfq/userprofile"); ?>" style="width:70%">
			<input type="hidden" name="register" value="1" />
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-sm-12 text-center" style="color:red" id="errormessage" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Customer Type</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('private')" value="private" checked />
					</div>
					<div class="col-sm-2">
						Private
					</div>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="userprofile[type]" onclick="custType('professional')" value="professional" /> 
					</div>
					<div class="col-sm-2">
						Professional
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Your E-mail Address</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[email]" placeholder="This will be your login name" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="userprofile[password]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Confirm Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="userprofile[confirm_password]" />
					</div>
				</div>
				<div class="form-group" id="company_name" style="display:none">
					<label class="col-sm-3 control-label">Company Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[company_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">First Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[first_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Last Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[last_name]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Contact Number</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="userprofile[contact_number]" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Country</label>
					<div class="col-sm-9">
						<select class="form-control" name='userprofile[country]'>
							<option value="">Please select</option>
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
					</div>
				</div>
			</div>
			<div class="col-md-12 backbutton text-center">
				<button type="button" class="btn btn-default" onclick="submitProfile()" >Submit</button>
			</div>
		</form>
	</div><br />&nbsp;
</div>