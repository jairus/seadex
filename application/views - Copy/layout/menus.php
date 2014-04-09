<?php
$controller = $this->router->class;
$method = $this->router->method;
?>
<ul class='menu'>
	<li <?php if($controller=="users"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("users");?>"'>
		<a href='<?php echo site_url("users");?>'>Admin Users</a>
	</li>
	
</ul>