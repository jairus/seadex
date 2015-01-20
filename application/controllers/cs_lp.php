<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
date_default_timezone_set ("UTC");
class cs_lp extends CI_Controller {    
	public function __construct(){
		parent::__construct();
                
		$this->load->database();
                $this->load->model('cs_model', '', true);
	}
	
	public function index(){
		if(!$_SESSION['logistic_provider']['id']){
			if(!trim($_SESSION['redirect'])&&trim($_GET['redirect'])){
				$_SESSION['redirect'] = urldecode($_GET['redirect']);
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('cs/index.php', '', true);
			$data['content'] = $content;
			$this->load->view('sitelayout/container_cs.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else{
			unset($_SESSION['redirect']);
			if(trim($_SESSION['redirect'])){
				echo "<!--";
				print_r($_SESSION['redirect']);
				echo "-->";
				//exit();
				?>
				<script>
					self.location = "<?php echo $_SESSION['redirect']; ?>";
				</script>
				<?php
				unset($_SESSION['redirect']);
			}
			else{
				$this->dashboard();
			}
		}
		unset($_SESSION['rfq']);
	}
	public function invoices(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		$sql = "select * from `bluesnap_ipn_returns` where `logistic_provider_cust_id`='".$_SESSION['logistic_provider']['id']."' order by `id` desc";
		//$sql = "select * from `bluesnap_ipn_returns` where `logistic_provider_cust_id`='".$_SESSION['customer']['id']."'";
		$q = $this->db->query($sql);
		$invoices = $q->result_array();
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['invoices'] = $invoices;
		$content = $this->load->view('cs/invoices.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function route(){
		if(strtoupper($_GET['status'])=="VALID"){
			if($_SESSION['logistic_provider']['id']){
				?>
				<script>
				self.location="<?php echo site_url("cs_lp"); ?>/invoices";
				</script>
				<?php
			}
			else{
				?>
				<script>
				self.location="<?php echo site_url("cs"); ?>/invoices";
				</script>
				<?php
			}
		}
		else{
			echo "Invalid Transaction";
		}
		exit();
	}
	public function bluesnap_ipn_receiver92647(){
			$str = print_r($_GET, 1).print_r($_POST, 1);
			file_put_contents(dirname(__FILE__)."/bluesnaplogs/".date("Y-m-d_H:i:s").".txt", $str);
			$bid_id = $_POST['Bid_ID'];
			$lp_name = $_POST['Freight_Forwarder'];
			$amount_usd = $_POST['invoiceAmountUSD'];
			
			//get bid
			$sql = "select * from `bids` where `id`='".mysql_real_escape_string($bid_id)."'";
			$q = $this->db->query($sql);
			$bids = $q->result_array();
			if(isset($bids[0]['id'])){
				$logistic_provider_id = $bids[0]['logistic_provider_id'];
				//get rfq
				$sql = "select * from `rfq` where `id`='".mysql_real_escape_string($bids[0]['rfq_id'])."'";
				$q = $this->db->query($sql);
				$rfqs = $q->result_array();
				if($rfqs[0]['id']){
					$rfq_id = $rfqs[0]['id'];
					$customer_id = $rfqs[0]['customer_id'];
					$logistic_provider_cust_id = $rfqs[0]['logistic_provider_cust_id'];
					
					//insert log
					$sql = "insert into `bluesnap_ipn_returns` set 
						`bid_id`='".mysql_real_escape_string($bid_id)."',
						`rfq_id`='".mysql_real_escape_string($rfq_id)."',
						`customer_id`='".mysql_real_escape_string($customer_id)."',
						`logistic_provider_cust_id`='".mysql_real_escape_string($logistic_provider_cust_id)."',
						`logistic_provider_id`='".mysql_real_escape_string($logistic_provider_id)."',
						`lp_name`='".mysql_real_escape_string($lp_name)."',
						`amount_usd`='".mysql_real_escape_string($amount_usd)."',
						`data`='".mysql_real_escape_string(json_encode($_POST))."',
						`dateadded`=NOW()
					";
					$q = $this->db->query($sql);
					
					//update rfq
					$sql = "update `rfq` set
					`bid_id` = '".$bids[0]['id']."',
					`logistic_provider_id` = '".$bids[0]['logistic_provider_id']."',
					`dateaccepted` = NOW()
					where
					`id`='".$rfqs[0]['id']."'
					and `bid_id` < 1
					;
					";
					$q = $this->db->query($sql);
					$subject = "Bid Accepted and Paid";
					$message = "Your bid had been accepted and paid! Click on the link below to view.";
					$message .= "\n\n--\n\n";
					$bidref = site_url("lp")."/rfq/".$rfq[0]['id']."/bid?bid_id=".$bids[0]['id'];
					$message .= "Bid Reference URL: <a href='".$bidref."'>".$bidref."</a><br />";
					
					//send message
					$sql = "insert into `messages` set
						`from` = 'customer_".$customer[0]['id']."',
						`to` = 'logistic_provider_".$bids[0]['logistic_provider_id']."',
						`subject` = '".mysql_real_escape_string($subject)."',
						`message` = '".mysql_real_escape_string($message)."',
						`rfq_id` = '".mysql_real_escape_string($rfqs[0]['id'])."',
						`dateadded` = NOW()
					";
					$q = $this->db->query($sql);
					
					//send email to logistic provider
					$sql = "select * from `logistic_providers` where `id`='".$bids[0]['logistic_provider_id']."'";
					$q = $this->db->query($sql);
					$lp = $q->result_array();
					$emailtos = array();
					$email = array();
					$email['name'] = $lp[0]['name']." - ".$lp[0]['company_name'];
					$email['email'] = $lp[0]['email'];
					$emailtos[] = $email;
					$this->sendAcceptBid($emailtos, $message);
					
				}
			}
			
	}
	public function rfq($id, $action){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
		$sql = "select * from `rfq` where `id`='".mysql_real_escape_string($id)."' and `logistic_provider_cust_id`='".$_SESSION['logistic_provider']['id']."'";
		$q = $this->db->query($sql);
		$rfq = $q->result_array();
		if($rfq[0]['id']){
			if($rfq[0]['logistic_provider_cust_id']){
				$sql = "select * from `logistic_providers` where `id`='".mysql_real_escape_string($rfq[0]['logistic_provider_cust_id'])."'";
				$q = $this->db->query($sql);
				$customer = $q->result_array();
				
			}
			$rfqdata = unserialize(base64_decode($rfq[0]['data']));
			$rfqdata['id'] = $rfq[0]['id'];
			$rfqdata['bid_id'] = $rfq[0]['bid_id'];
			$rfqdata['logistic_provider_id'] = $rfq[0]['logistic_provider_id'];
			$rfqdata['dateaccepted'] = $rfq[0]['dateaccepted'];
			$rfqdata['datecancelled'] = $rfq[0]['datecancelled'];
			$rfqdata['cancel_reason'] = $rfq[0]['cancel_reason'];
			
			//print_r($rfqdata);
			if($customer[0]['id']){
				$rfqdata['userprofile'] = $customer[0];
			}
			
			
			if($action=="bids"){
				$sql = "select `bids`.`id`, `company_name`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` 
				left join `logistic_providers`
				on (`bids`.`logistic_provider_id` = `logistic_providers`.`id`)
				where `bids`.`rfq_id` = '".$rfq[0]['id']."' order by `bids`.`total_bid_usd` asc";
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				$this->load->view('sitelayout/header.php');
				$this->load->view('sitelayout/nav.php');
				$data['rfq'] = $rfqdata;
				$data['bids'] = $bids;
				$this->load->view('cs/rfqsummary.php', $data);
				$this->load->view('sitelayout/footer.php');
			}
			else if($action=="bid"){
				$sql = "select `bids`.`data`, `bids`.`id`, `company_name`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` 
				left join `logistic_providers`
				on (`bids`.`logistic_provider_id` = `logistic_providers`.`id`)
				where 
				`bids`.`rfq_id` = '".$rfq[0]['id']."' 
				and `bids`.`id`='".$_GET['bid_id']."'
				order by `bids`.`total_bid_usd` asc";
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				$this->load->view('sitelayout/header.php');
				$this->load->view('sitelayout/nav.php');
				$data['rfq'] = $rfqdata;
				$data['bids'] = $bids;
				$this->load->view('cs/rfqsummary_bid.php', $data);
				$this->load->view('sitelayout/footer.php');
			}
			else if($action=="pay" && $rfqdata['bid_id']<1){
				$sql = "select * from `bids` 
				where 
				`bids`.`rfq_id` = '".$rfq[0]['id']."' 
				and `bids`.`id`='".$_GET['bid_id']."'
				order by `bids`.`total_bid_usd` asc";
				
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				if(isset($bids[0]['id'])){
					//echo "<pre>";
					//print_r($bids);
					//echo "</pre>";
					//get lp
					$sql = "select * from `logistic_providers` where `id`='".$bids[0]['logistic_provider_id']."'";
					$q = $this->db->query($sql);
					$lp = $q->result_array();
					
					?>
					<form method="post" action="https://sandbox.bluesnap.com/jsp/buynow.jsp" id="submitform" style="display:none">
					Shipping Price: USD <input type="text" name="overridePrice" value="<?php echo htmlentitiesX($bids[0]['total_bid_usd']); ?>" />
					<input type="hidden" name="contractId" value="2154142" />
					<input type="hidden" name="custom1" value="<?php echo $bids[0]['id']; ?>" />
					<input type="hidden" name="custom2" value="<?php echo htmlentitiesX($lp[0]['company_name']); ?>" />
					<!--<input type="submit" value="Pay Now">-->
					</form>
					<script>
						document.getElementById("submitform").submit();
					</script>
					<?php
					exit();
				}
			}
			else if($action=="acceptbid" && $rfqdata['bid_id']<1){ //$rfqdata['bid_id'] < 1 meaning no bids yet
				$sql = "select `bids`.`id`, `bids`.`logistic_provider_id` from `bids` 
				where 
				`bids`.`rfq_id` = '".$rfq[0]['id']."' 
				and `bids`.`id`='".$_GET['bid_id']."'
				order by `bids`.`total_bid_usd` asc";
				
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				if(isset($bids[0]['id'])){
					$sql = "update `rfq` set
					`bid_id` = '".$bids[0]['id']."',
					`logistic_provider_id` = '".$bids[0]['logistic_provider_id']."',
					`dateaccepted` = NOW()
					where
					`id`='".$rfq[0]['id']."'
					and `bid_id` < 1
					;
					";
					$q = $this->db->query($sql);
					$subject = "Bid Accepted";
					$message = strip_tags(trim($_POST['message']));
					$message .= "\n\n--\n\n";
					$bidref = site_url("lp")."/rfq/".$rfq[0]['id']."/bid?bid_id=".$bids[0]['id'];
					$message .= "Bid Reference URL: <a href='".$bidref."'>".$bidref."</a><br />";
					
					//send message
					$sql = "insert into `messages` set
						`from` = 'customer_".$customer[0]['id']."',
						`to` = 'logistic_provider_".$bids[0]['logistic_provider_id']."',
						`subject` = '".mysql_real_escape_string($subject)."',
						`message` = '".mysql_real_escape_string($message)."',
						`rfq_id` = '".mysql_real_escape_string($rfq[0]['id'])."',
						`dateadded` = NOW()
					";
					$q = $this->db->query($sql);
					
					
					//send email to logistic provider
					$sql = "select * from `logistic_providers` where `id`='".$bids[0]['logistic_provider_id']."'";
					$q = $this->db->query($sql);
					$lp = $q->result_array();
					
					$emailtos = array();
					$email = array();
					$email['name'] = $lp[0]['name']." - ".$lp[0]['company_name'];
					$email['email'] = $lp[0]['email'];
					$emailtos[] = $email;
					
					$this->sendAcceptBid($emailtos, $message);
					?>
					<script>
					self.location="<?php echo site_url("cs_lp"); ?>/acceptbid_success";
					</script>
					<?php
				}
				else{
					?>
					<script>
					self.location="<?php echo site_url("cs_lp"); ?>";
					</script>
					<?php
				}
			}
			else if($action=="cancel"){
				if($_POST){
					$sql = "update `rfq` set
					`bid_id` = '-1',
					`cancel_reason` = '".mysql_real_escape_string($_POST['cancel_reason'])."',
					`datecancelled` = NOW()
					where
					`id`='".$rfq[0]['id']."'
					and `bid_id` < 1
					;
					";
					$q = $this->db->query($sql);
					?>
					<script>
					self.location="<?php echo site_url("cs_lp"); ?>/cancelled_listings";
					</script>
					<?php
					exit();
				}
				$sql = "select `bids`.`id`, `company_name`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` 
				left join `logistic_providers`
				on (`bids`.`logistic_provider_id` = `logistic_providers`.`id`)
				where `bids`.`rfq_id` = '".$rfq[0]['id']."' order by `bids`.`total_bid_usd` asc";
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				$this->load->view('sitelayout/header.php');
				$this->load->view('sitelayout/nav.php');
				$data['rfq'] = $rfqdata;
				$data['bids'] = $bids;
				$data['cancel'] = true;
				$this->load->view('cs/rfqsummary.php', $data);
				$this->load->view('sitelayout/footer.php');
			}
		}
		else{
			//echo "here";
		}
	}
	
	private function sendAcceptBid($emailtos, $moremessage=""){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
		$from = "noreply@seadex.com";
		$fromname = "Seadex";

		$subject = "Your bid had been accepted!";
		$template = array();
		$template['data'] = array();
		$template['data']['name'] = $toname;
		$email_content = "
Hello,

Your bid had been accepted with the following message:

".$moremessage."

Regards,
The SeaDex team";
		$template['data']['content'] = $email_content;
		$template['data']['content'] = nl2br($template['data']['content']);
		$template['slug'] = "seadex"; 
		
		send_email($from, $fromname, $emailtos, $subject, $message, $template);

	}

	
	public function acceptbid_success(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('cs/acceptbid_success.php', '', true);
		$data['content'] = $content;
		$this->load->view('sitelayout/container_cs.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	
	public function rfqs(){
		$this->dashboard();
	}
	
	public function dashboard(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
                
        //$rfqs = $this->cs_model->getRFQs();
          

		$response = array();
        $date = (time() + (2 * 60 * 60 * 24));
        
        $sql = "SELECT * FROM `rfq` " .
            "WHERE `logistic_provider_cust_id`='" . $_SESSION['logistic_provider']['id'] . "'  " .
            "AND `bid_id`=0 " .
            "AND UNIX_TIMESTAMP(STR_TO_DATE(`destination_date`,'%m/%d/%Y'))>" . $date . " " .
            "ORDER BY id DESC";
        $query = $this->db->query($sql);
        $rfqs = $query->result_array();
		
		$t = count($rfqs);
		for($i=0; $i<$t; $i++){
			$sql = "select `id`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` where `rfq_id` = '".$rfqs[$i]['id']."' order by `total_bid_usd` asc";
			$q = $this->db->query($sql);
			$bids = $q->result_array();
			$rfqs[$i]['bids'] = $bids;
		}
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfqs'] = $rfqs;
		$data['count'] = $count;
		$content = $this->load->view('cs/dashboard.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function completed_listings(){
		
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		$sql = "select * from `rfq` where 
		`logistic_provider_cust_id`='".$_SESSION['logistic_provider']['id']."' 
		and bid_id>0 
		order by id desc";
		$q = $this->db->query($sql);
		$rfqs = $q->result_array();
		
		$t = count($rfqs);
		for($i=0; $i<$t; $i++){
			$sql = "select `id`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` where `rfq_id` = '".$rfqs[$i]['id']."' order by `total_bid_usd` asc";
			$q = $this->db->query($sql);
			$bids = $q->result_array();
			//echo "<pre>"; print_r($rfqs[$i]);
			$rfqs[$i]['bids'] = $bids;
		}

		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfqs'] = $rfqs;
		$data['count'] = $count;
		
		
		$content = $this->load->view('cs/completed_listings.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
		
	}
	public function cancelled_listings(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
		$sql = "select * from `rfq` where 
		`logistic_provider_cust_id`='".$_SESSION['logistic_provider']['id']."' 
		and bid_id<0 
		order by id desc";
		$q = $this->db->query($sql);
		$rfqs = $q->result_array();
		
		$t = count($rfqs);
		for($i=0; $i<$t; $i++){
			$sql = "select `id`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` where `rfq_id` = '".$rfqs[$i]['id']."' order by `total_bid_usd` asc";
			$q = $this->db->query($sql);
			$bids = $q->result_array();
			//echo "<pre>"; print_r($rfqs[$i]);
			$rfqs[$i]['bids'] = $bids;
		}
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfqs'] = $rfqs;
		$data['count'] = $count;
		$content = $this->load->view('cs/cancelled_listings.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}

	
	public function expired_listings(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("cs_lp")."/?redirect=".$redirect."'</script>";
		}
		$sql = "select * from `rfq` where 
		`logistic_provider_cust_id`='".$_SESSION['logistic_provider']['id']."' 
		and bid_id<1
		and UNIX_TIMESTAMP(STR_TO_DATE(`destination_date`,'%m/%d/%Y'))< ".(time()+(2*60*60*24))."
		order by id desc";
		$q = $this->db->query($sql);
		$rfqs = $q->result_array();
		
		$t = count($rfqs);
		for($i=0; $i<$t; $i++){
			$sql = "select `id`, `logistic_provider_id`, `total_bid_currency`, `total_bid`, `total_bid_usd` from `bids` where `rfq_id` = '".$rfqs[$i]['id']."' order by `total_bid_usd` asc";
			$q = $this->db->query($sql);
			$bids = $q->result_array();
			$rfqs[$i]['bids'] = $bids;
		}
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfqs'] = $rfqs;
		$data['count'] = $count;
		$content = $this->load->view('cs/completed_listings.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	
	
}
