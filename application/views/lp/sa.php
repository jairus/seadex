<?php
$company_name = $_POST['company_name'];
$company_rep = $_POST['company_rep'];
$date = date("M d, Y");
?>
<div class="row">
	<div class="col-md-12">
<br /><center>
<b>Agreement between Seadex AS and <?php echo $company_name; ?></b>
<br /><br />
</center>
<p>
The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and any or all Agreements: "Client", "You" and "Your" refers to <?php echo $company_name; ?>, <?php echo $company_name; ?> accessing the Seadex Portal and accepting Seadex's terms and conditions. "The Company", "Ourselves", "We" and "Us", refers to Seadex AS. "Party", "Parties", or "Us", refers to both the Client and ourselves, or either the Client or ourselves. 
Insert date from the form that was filled out
</p>
<p>
<b>Overall</b>
<br />
This agreement does not include any payment for any party. The Client gets a trial license for the pilot phase up to and including ("6 months", <?php echo $date; ?>) After the trial period both parties will agree on a new contract with new terms and conditions.
</p>
<p>
We agree to receive and reply by e-mail Request For Quotation's sent from Seadex's email: <a href="mailto:client@seadex.com">client@seadex.com</a>. We agree to Seadex AS contacting us by email and sending postal and electronic communications. 
</p>
<p>
Date: <?php echo $date; ?>
<br />
For Seadex AS:    
<br />            
Morten Nordenson - CEO
<br /><br />
For <?php echo $company_name; ?>:
<br />
<?php echo $company_rep; ?>
<br /><br /><br />

	</div>
</div>