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
?>
<table class="table table-striped">
  <thead>
	<tr>
	  <th class="startend">Menu</th>
	</tr>
  </thead>
  <tbody>
	<tr>
	  <td>
		<div class="menu <?php if($method=="rfqs" || $method=="index" || $method=="dashboard"){ echo "active"; }?>"><a href="<?php echo site_url("lp"); ?>/rfqs">Customer RFQs</a></div>
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
  </tbody>
</table>