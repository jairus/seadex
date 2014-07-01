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
			  <!--
			  <div class="menu">Freight Request – for FREE</div>
			  <div class="menu">Offer Listings</div>
			  -->
			  <div class="menu <?php if($method=="index"){ echo "active"; }?>"><a href="<?php echo site_url("cs"); ?>">Active Listings</a></div>
			  <div class="menu <?php if($method=="completed_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs"); ?>/completed_listings">Completed Listings</a></div>
			  <div class="menu <?php if($method=="expired_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs"); ?>/expired_listings">Expired Listings</a></div>
			  <div class="menu <?php if($method=="cancelled_listings"){ echo "active"; }?>"><a href="<?php echo site_url("cs"); ?>/cancelled_listings">Cancelled Listings</a></div>
			  <div class="menu <?php if($method=="changepass"){ echo "active"; }?>"><a href="<?php echo site_url("cs"); ?>/changepass">Change Password</a></div>
			  
			  <!--
			  <div class="menu">Expired Listings </div>
			  <div class="menu">Change Password</div>
			  <div class="menu">Delete profile</div>
			  -->
			  </td>
			</tr>
		  </tbody>
		</table>
	</div>