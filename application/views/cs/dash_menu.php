<style>
.menu{
	padding-left:15px;
}
.menu a:hover{
	text-decoration:none;
}
.active{
	border-radius: 3px;
	background: #3BA7E4;
	color: white;
}
.active a{
	color: white;
	font-weight: bold;
}
</style>
<?php
$method = $this->router->fetch_method();
$class = $this->router->fetch_class();
if($class=="cs"){
	?>
	<div class="col-md-3">
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th class="startend" >My Profile</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>
				<div class="menu <?php if($method=="index"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>">Active Listings</a></div>
				<div class="menu <?php if($method=="completed_listings"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>/completed_listings">Completed Listings</a></div>
				<div class="menu <?php if($method=="expired_listings"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>/expired_listings">Expired Listings</a></div>
				<div class="menu <?php if($method=="cancelled_listings"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>/cancelled_listings">Cancelled Listings</a></div>
				<div class="menu <?php if($method=="invoices"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>/invoices">Invoices</a></div>
				<div class="menu <?php if($method=="changepass"){ echo "active"; }?>"><a href="<?php echo site_url($class); ?>/changepass">Change Password</a></div>
			  </td>
			</tr>
		  </tbody>
		</table>
	</div>
	<?php
}
else{
	?>
	<div class="col-md-2">
	<table class="table table-striped">
	  <thead>
		<tr>
		  <th class="startend">Menu</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <td>
			<div class="menu <?php if(($method=="rfqs" || $method=="index" || $method=="dashboard")&&$class=='lp'){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/rfqs">Customer RFQs</a></div>
			<div class="menu <?php if($method=="mybids"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/mybids">My Bids</a></div>
			<div class="menu <?php if($method=="cobids"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/cobids">Company Bids</a></div>
			<div class="menu <?php if($method=="myrates"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/myrates">My Rates</a></div>
			<div class="menu <?php if($method=="acceptedbids"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/acceptedbids">Accepted Bids</a></div>
			<div class="menu <?php if($method=="changepass"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/changepass">Change Password</a></div>
			<div class="menu <?php if($method=="account"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/account">Edit My Profile</a></div>
			<div class="menu <?php if($method=="mycompany"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/mycompany">My Company</a></div>		
			<div class="menu <?php if($method=="buycredits" || $method=="freecredits"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/buycredits">Credits</a></div>
					<?php /*if($_SESSION['logistic_provider']['main']) {?><div class="menu <?php if($method=="colleagues"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/colleagues">Colleagues</a></div><?php }*/?>
		  </td>
		</tr>
		<tr>
		  <td>
			<div class="menu"><a href="<?php echo site_url("rfq")."/"; ?>">Add an RFQ Listings</a></div>
			<div class="menu <?php if($method=="index"&&$class=='cs_lp'){ echo "active"; }?>"><a href="<?php echo site_url("cs_lp"); ?>">My RFQ Listings</a></div>
			<div class="menu <?php if($method=="completed_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs_lp"); ?>/completed_listings">Completed RFQ Listings</a></div>
			<div class="menu <?php if($method=="expired_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs_lp"); ?>/expired_listings">Expired RFQ Listings</a></div>
			<div class="menu <?php if($method=="cancelled_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs_lp"); ?>/cancelled_listings">Cancelled RFQ Listings</a></div>
			<div class="menu <?php if($method=="invoices"){ echo "active"; }?>"><a href="<?php echo site_url("cs_lp"); ?>/invoices">Invoices</a></div>
		  </td>
		</tr>
	  </tbody>
	</table>
	</div>
	<?php
}