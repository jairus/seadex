<div class='step'>
	<script>
	function validateStep1(){
		origin_country = jQuery("#origin_country").val();
		origin_port = jQuery("#origin_port").val();
		origin_date = jQuery("#origin_date").val();
		destination_country = jQuery("#destination_country").val();
		destination_date = jQuery("#destination_date").val();
		destination_port = jQuery("#destination_port").val();
                
                var receiving_co = jQuery("select[name='type_of_company_to_quote']");
                
		if(!jQuery.trim(origin_country)){
			alert("Please input the country of origin.");
			return false;
		}
		else if(!jQuery.trim(origin_port)){
			alert("Please input the port of origin.");
			return false;
		}
		else if(!jQuery.trim(origin_date)){
			alert("Please input a pickup date.");
			return false;
		}
		else if(!jQuery.trim(destination_country)){
			alert("Please input the country of destination.");
			return false;
		}
		else if(!jQuery.trim(destination_port)){
			alert("Please input the port of destination.");
			return false;
		}
		else if(!jQuery.trim(destination_date)){
			alert("Please input a delivery date.");
			return false;
		}
                /* @start :
                 * Added checking for the receiving company.
                 * 
                 * @author tuso@programmerspride.com
                 * */
		else if(! jQuery.trim(receiving_co.val())) {
                        alert("Please choose a receiving company.");
                        receiving_co.focus(); // At least focus it to the subject.
			return false;
                } // @end.
	}
	function getPorts(idx, country_code){
            
                /* @start :
                 * Always clear so that it will be dependent on the value of Country.
                 * When Country is blank, it should be blank also and won't carry
                 * the previous selection's value/s.
                 * 
                 * @edit    tuso@programmerspride.com
                 * @date    6/20/2014
                 * */
                jQuery("#"+ idx).html(''); // @end.
                
		if(country_code){
			jQuery.ajax({
			  type: "POST",
			  url: "<?php echo site_url("rfq/getPorts"); ?>/"+escape(country_code),
			  data: "",
			  success: function(msg){
                              
                                /* @start :
                                 * Include "Please select" option.
                                 * 
                                 * @edit    tuso@programmerspride.com
                                 * @date    6/20/2014
                                 * */
                                
				jQuery("#"+ idx).html('<option value="">Please select</option>' + msg); // @end.
				calcDate();
			  }
			});
		}
	}
	function calcDate(){
		port1 = escape(jQuery("#origin_port").val());
		port2 = escape(jQuery("#destination_port").val());
		jQuery("#transit_time_container").hide();
		if(port1 && port2){
			jQuery.ajax({
			  type: "POST",
			  url: "<?php echo site_url("rfq/portToPort"); ?>/"+port1+"/"+port2,
			  data: "",
			  success: function(msg){
				//alert(msg)
				distance = msg.split("|");
				days = distance[1];
				distance = distance[0]*1;
				//alert(distance);
				//alert(msg);
				
				jQuery("#estimated_days").val(days);
				var someDate = new Date();
				var numberOfDaysToAdd = 1;
				someDate.setDate(someDate.getDate() + numberOfDaysToAdd); 
				var dd = someDate.getDate();
				var mm = someDate.getMonth() + 1;
				var y = someDate.getFullYear();
				var someFormattedDate = mm + '/'+ dd + '/'+ y;
				jQuery("#origin_date").val(someFormattedDate)
				
				pickup.setValue(someDate);
				
				var someDate = new Date();
				var numberOfDaysToAdd = (days*1)+1;
				someDate.setDate(someDate.getDate() + numberOfDaysToAdd); 
				var dd = someDate.getDate();
				var mm = someDate.getMonth() + 1;
				var y = someDate.getFullYear();
				var someFormattedDate = mm + '/'+ dd + '/'+ y;
				jQuery("#destination_date").val(someFormattedDate)
				delivery.setValue(someDate);
				
				if(days*1==1){
					jQuery("#transit_time").html("Distance: "+distance+" km, Estimated Days: "+days+" day");
				}
				else{
					jQuery("#transit_time").html("Distance: "+distance+" km, Estimated Days: "+days+" days");
				}
				jQuery("#transit_time_container").show();
			  },
			  //dataType: dataType
			});
		}
	}
	</script>
	<div class='formcontainer'>
		<form class="form-horizontal" action="<?php echo site_url("rfq/".$type."/2"); if($skip){ echo "?skip=true"; } ?>" method="post"  >
			<input type="hidden" name="shipping_info" value="true">
			<input type="hidden" name="estimated_days" id="estimated_days" value="">
			<div class="row">
				<div class="col-md-6">
					  <div class="form-group">
						<label class="col-sm-12"><h2>Origin of the Cargo</h2></label>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Country</label>
						<div class="col-sm-9">
							<select id="origin_country" class="form-control" name='origin[country]' onchange="getPorts('origin_port', this.value)">
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
					  <div class="form-group">
						<label class="col-sm-3 control-label">City</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" name='origin[city]' placeholder="City" value="">
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Port</label>
						<div class="col-sm-9">
						  <select class="form-control" name='origin[port]' id="origin_port" onchange="calcDate()"></select>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Pickup Date</label>
						<div class="col-sm-9" style="position:relative">
						  <input type="text" class="form-control" name='origin[date]' id="origin_date" readonly>
						  <span class="glyphicon glyphicon-calendar" style="position:absolute; top:12px; cursor:pointer; right:20px"onclick="pickup.show()"></span>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Alternative Pickup Date</label>
						<div class="col-sm-9" style="position:relative">
						  <select name="origin[alternate_date]" class="form-control">
                                                  <option value="">Please select</option>
						  <option value="">None</option>
						  <option value="1 week from selected date">1 week from selected date </option>
						  <option value="2 weeks from selected date">2 weeks from selected date</option>
						  <option value="3 weeks from selected date">3 weeks from selected date</option>
						  <option value="1 month from selected date">1 month from selected date</option>
						  <option value="2 months from selected date">2 months from selected date</option>
						  <option value="Over 3 months from the selected date">Over 3 months from the selected date</option>
						  </select>
						</div>
					  </div>
					  <div class="form-group"  style="display:none">
						<label class="col-sm-3 control-label">Pickup Timezone</label>
						<div class="col-sm-9">
						  <select name="origin[time_zone]" class="form-control">
							  <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
							  <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
							  <option value="-10.0">(GMT -10:00) Hawaii</option>
							  <option value="-9.0">(GMT -9:00) Alaska</option>
							  <option value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
							  <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
							  <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
							  <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
							  <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
							  <option value="-3.5">(GMT -3:30) Newfoundland</option>
							  <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
							  <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
							  <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
							  <option value="0.0" selected>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
							  <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
							  <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
							  <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
							  <option value="3.5">(GMT +3:30) Tehran</option>
							  <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
							  <option value="4.5">(GMT +4:30) Kabul</option>
							  <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
							  <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
							  <option value="5.75">(GMT +5:45) Kathmandu</option>
							  <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
							  <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
							  <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
							  <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
							  <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
							  <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
							  <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
							  <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
						</select>
						</div>
					  </div>
				</div>
				<div class="col-md-6">
					  <div class="form-group">
						<label class="col-sm-12"><h2>Destination of the Cargo</h2></label>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Country</label>
						<div class="col-sm-9">
						  <select class="form-control" id="destination_country" name='destination[country]' onchange="getPorts('destination_port', this.value)">
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
					  <div class="form-group">
						<label class="col-sm-3 control-label">City</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" name='destination[city]' placeholder="City" value="">
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Port</label>
						<div class="col-sm-9">
						  <select class="form-control" name='destination[port]' id="destination_port" onchange="calcDate()"></select>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Delivery Date</label>
						<div class="col-sm-9"style="position:relative">
						  <input type="text" class="form-control" id="destination_date" name='destination[date]' readonly>
						  <span class="glyphicon glyphicon-calendar" style="position:absolute; top:11px; cursor:pointer; right:20px"onclick="delivery.show()"></span>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-3 control-label">Alternative Delivery Date</label>
						<div class="col-sm-9" style="position:relative">
						  <select name="destination[alternate_date]" class="form-control">
                                                  <option value="">Please select</option>
						  <option value="">None</option>
						  <option value="1 week from selected date">1 week from selected date </option>
						  <option value="2 weeks from selected date">2 weeks from selected date</option>
						  <option value="3 weeks from selected date">3 weeks from selected date</option>
						  <option value="1 month from selected date">1 month from selected date</option>
						  <option value="2 months from selected date">2 months from selected date</option>
						  <option value="Over 3 months from the selected date">Over 3 months from the selected date</option>
						  </select>
						</div>
					  </div>
					  <div class="form-group" style="display:none">
						<label class="col-sm-3 control-label">Delivery Timezone</label>
						<div class="col-sm-9">
						  <select name="destination[time_zone]" class="form-control">
							  <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
							  <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
							  <option value="-10.0">(GMT -10:00) Hawaii</option>
							  <option value="-9.0">(GMT -9:00) Alaska</option>
							  <option value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
							  <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
							  <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
							  <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
							  <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
							  <option value="-3.5">(GMT -3:30) Newfoundland</option>
							  <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
							  <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
							  <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
							  <option value="0.0" selected>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
							  <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
							  <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
							  <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
							  <option value="3.5">(GMT +3:30) Tehran</option>
							  <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
							  <option value="4.5">(GMT +4:30) Kabul</option>
							  <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
							  <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
							  <option value="5.75">(GMT +5:45) Kathmandu</option>
							  <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
							  <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
							  <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
							  <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
							  <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
							  <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
							  <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
							  <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
						</select>
						</div>
					  </div>
				</div>
			</div>
			<div class="row" id="transit_time_container" style="display:none">
				<div class="col-md-12">
					<div class="form-group">
						<label class="col-sm-12 text-center">Estimated Distance and Transit Time</label>
						<div class="col-sm-12 text-center" id="transit_time">
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="col-sm-12 text-center">Type of company you want to receive quotes from</label>
						<div class="col-sm-12">
						  <select type="text" class="form-control" name='type_of_company_to_quote' >
                                                        <option value="">Please select</option>
							<option value='Professional Movers'>Professional Movers (Packing, Filling the Container, Pickup and Delivery)</option>
							<option value='Freight Forwarders'>Freight Forwarders (Pickup and Delivery)</option>
							<option value='Professional Movers & Freight Forwarders'>Both</option>
						  </select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<button type="button" class="btn btn-default" onclick="self.location='<?php echo site_url("rfq")."/"; ?>'">Back</button>
					<button type="submit" class="btn btn-primary btn-lg" onclick="return validateStep1();">Continue</button>
				</div>
			</div>
		</form>
	</div>
</div>
