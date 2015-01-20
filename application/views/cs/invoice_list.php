<?php
$method = $this->router->fetch_method();
$class = $this->router->fetch_class();

if($class=='cs_lp'){
	?><div class="col-md-10"><?php
}
else{
	?><div class="col-md-9"><?php
}
?>
	<table class="table table-striped">
	  <thead>
		<tr>
		  <th class="start">Invoice #</th>
		  <th>USD Amount</th>
		  <th>Local Charged Amount</th>
		  <th>Invoice URL</th>
		  <th>Payment For</th>
		  <th class="end" width="19%">Date</th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		$t = count($invoices);
		if($t){
			for($i=0; $i<$t; $i++){
				$invoices[$i]['data'] = json_decode($invoices[$i]['data']);
				?>
				<tr>
				  <td>
					  <?php
					  
					  echo $invoices[$i]['data']->referenceNumber;
					  ?>
				  </td>
				  <td>
					  <?php
					  echo "USD ".number_format($invoices[$i]['amount_usd'], 2);
					  ?>
				  </td>
				  <td>
					  <?php
					  echo $invoices[$i]['data']->invoiceLocalCurrency." ".$invoices[$i]['data']->invoiceLocalAmount;
					  ?>
				  </td>
				  <td>
					  <?php
					  echo "<a href='".$invoices[$i]['data']->invoiceURL."' target='_blank'>Click here</a>";;
					  ?>
				  </td>
				  <td>
					<?php
					echo "<a href='".site_url().$class."/rfq/".$invoices[$i]['rfq_id']."/bid?bid_id=".$invoices[$i]['bid_id']."'>Bid #".$invoices[$i]['bid_id']." Click here</a>";
					?>
				  </td>
				  <td>
					  <?php
					  echo date("M d, Y", strtotime($invoices[$i]['dateadded']));
					  ?>
				  </td>
				</tr>
				<?php
			}
		}
		else{
			?>
			<tr>
				<td colspan=10 class='text-center'>
				0 invoices found.
				</td>
			</tr>
			<?php
		}
		?>
	  </tbody>
	</table>
  </div>