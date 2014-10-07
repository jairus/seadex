 <?php
@session_start();
if($_SESSION['logistic_provider']['id']){
	?> 
	<style>
	#container h2{
		margin-top:0px;
	}
	</style>
	<div style="padding:10px; text-align:right;">
	<?php
	$sql = "select * from `logistic_providers` where `id`='".$_SESSION['logistic_provider']['id']."'";
	$q = $this->db->query($sql);
	$lp = $q->result_array();
	?>
	Your SeaDex Credits: <a href='<?php echo site_url("lp/buycredits"); ?>'><?php echo $lp[0]['credits']; ?></a>
	</div>
	<?php
}
?>