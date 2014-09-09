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
	.menu{
		/*cursor:pointer;*/
	}
	.menu a{
		/*color: #2A5C80;*/
	}
	</style>
	  <h2 style='text-align:right'>Credits</h2>
	  <div class="table-responsive">
		<div class="row">
			<div class="col-md-3">
			<?php
			include_once(dirname(__FILE__)."/dash_menu.php");
			?>
			</div>
			<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">My Credits</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td class="text-center">
						<?php echo $credits+0; ?> SeaDex Credits<br />
						<?php
						if(isset($_GET['success'])){
							echo "If credit amount was not updated please refresh this page.";
						}
						else if(isset($_GET['cancel'])){
							echo "<font color=red>Credit purchase failed.</font>";
						}
						?>
					</td>
				</tr>
			  </tbody>
			 </table>
			</div>
			<div class="col-md-9">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th class="startend">Buy Credits</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td>
						<?php
						if($amount==100){
							?>
							<form class="form-horizontal" style="max-width:700px; margin:auto" name="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_self" >
								<input type="hidden" value="_xclick" name="cmd">
								<input type="hidden" value="carlos@seadex.com" name="business">
								<input type="hidden" name="notify_url" value="http://seadex.com/lp/ipn?f=<?php echo $buyattemptid; ?>">
								<input type="hidden" value="100 SeaDex Credits" name="item_name">
								<input type="hidden" value="99.00" name="amount" id="amount_id">
								<input type="hidden" value="http://seadex.com/lp/buycredits?success" name="return" id="paypal-return-url">
								<input type="hidden" value="http://seadex.com/lp/buycredits?cancel" name="cancel_return">
								<input type="hidden" value="USD" name="currency_code">
								<input type="hidden" value="US" name="lc">
								 <div class="form-group">
									<div class="col-sm-12 text-center">
									  <a href="<?php echo site_url("lp/buycredits/100"); ?>"><img src="<?php echo site_url("media/seadex_credits_100.jpg"); ?>" /></a>
									</div>
								  </div>
								<div class="form-group">
									<div class="col-sm-12 text-center">
									  <input type='checkbox' id='torx'> I accept SeaDex' all <a href="#" onClick="window.showModalDialog('http://seadex.com/lp/tor',0, 'dialogWidth:600px; dialogHeight:400px; center:yes; resizable: no; status: no');">Terms and Conditions</a><br>
										<br>
										<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="if(0&&!jQuery('#torx').attr('checked')){ alert('Please check the Terms and Conditions before proceeding.'); return false; }">
										<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</div>
								  </div>			
								
							</form>
							<?php
						}
						else if($amount==50){
							?>
							<form class="form-horizontal" style="max-width:700px; margin:auto" name="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_self" >
								<input type="hidden" value="_xclick" name="cmd">
								<input type="hidden" value="carlos@seadex.com" name="business">
								<input type="hidden" name="notify_url" value="http://seadex.com/lp/ipn?f=<?php echo $buyattemptid; ?>">
								<input type="hidden" value="50 SeaDex Credits" name="item_name">
								<input type="hidden" value="49.00" name="amount" id="amount_id">
								<input type="hidden" value="http://seadex.com/lp/buycredits?success" name="return" id="paypal-return-url">
								<input type="hidden" value="http://seadex.com/lp/buycredits?cancel" name="cancel_return">
								<input type="hidden" value="USD" name="currency_code">
								<input type="hidden" value="US" name="lc">
								 <div class="form-group">
									<div class="col-sm-12 text-center">
									  <a href="<?php echo site_url("lp/buycredits/50"); ?>"><img src="<?php echo site_url("media/seadex_credits_50.jpg"); ?>" /></a>
									</div>
								  </div>
								<div class="form-group">
									<div class="col-sm-12 text-center">
									  <input type='checkbox' id='torx'> I accept SeaDex' all <a href="#" onClick="window.showModalDialog('http://seadex.com/lp/tor',0, 'dialogWidth:600px; dialogHeight:400px; center:yes; resizable: no; status: no');">Terms and Conditions</a><br>
										<br>
										<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="if(0&&!jQuery('#torx').attr('checked')){ alert('Please check the Terms and Conditions before proceeding.'); return false; }">
										<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</div>
								  </div>			
								
							</form>
							<?php
						}
						else{
							?>
							<div class="text-center" style="padding:40px; padding-top:20px">
							<a href="<?php echo site_url("lp/buycredits/50"); ?>"><img src="<?php echo site_url("media/seadex_credits_50.jpg"); ?>" /></a>
							</div>
							<div class="text-center" style="padding:40px; padding-top:0px">
							<a href="<?php echo site_url("lp/buycredits/100"); ?>"><img src="<?php echo site_url("media/seadex_credits_100.jpg"); ?>" /></a>
							</div>
							
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
