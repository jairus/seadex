<?php
@session_start();
/*
Array
(
    [id] => 1
    [email] => jairus@e27.co
    [company_name] => NMG
    [password] => 5f4dcc3b5aa765d61d8327deb882cf99
    [active] => 1
    [dateadded] => 0000-00-00 00:00:00
)
*/
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
<div class="container-fluid" id="container" style="max-width:90%">
  <?php include_once(dirname(__FILE__)."/credits.php"); ?>
  <div class="row">
	<div class="col-md-12 main">
	  
	  <?php echo $content; ?>
	</div>
  </div>
</div>
