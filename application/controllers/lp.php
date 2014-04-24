<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
date_default_timezone_set ("UTC");
class lp extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function index(){
		if(!$_SESSION['logistic_provider']['id']){
			if(!trim($_SESSION['redirect'])&&trim($_GET['redirect'])){
				$_SESSION['redirect'] = urldecode($_GET['redirect']);
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('lp/index.php', '', true);
			$data['content'] = $content;
			$this->load->view('sitelayout/container_lp.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else{
			
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
	
	public function sa(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/sa.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function tor(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/tor.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function account(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['account'] = $_SESSION['logistic_provider'];
		$content = $this->load->view('lp/account.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
		
	}
	
	public function rfq($id, $action=''){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		$sql = "select * from `rfq` where `id`='".mysql_real_escape_string($id)."'";
		$q = $this->db->query($sql);
		$rfq = $q->result_array();
		if($rfq[0]['customer_id']){
			$sql = "select * from `customers` where `id`='".mysql_real_escape_string($rfq[0]['customer_id'])."'";
			$q = $this->db->query($sql);
			$customer = $q->result_array();
			
		}
		$rfqdata = unserialize(base64_decode($rfq[0]['data']));
		$rfqdata['id'] = $rfq[0]['id'];
		$rfqdata['id'] = $rfq[0]['id'];
		$rfqdata['bid_id'] = $rfq[0]['bid_id'];
		$rfqdata['logistic_provider_id'] = $rfq[0]['logistic_provider_id'];
		if($customer[0]['id']){
			$rfqdata['userprofile'] = $customer[0];
		}
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfq'] = $rfqdata;
		if($action=='bid'){
			if($_GET['bid_id']){
				$sql = "select * from `bids` where `id`='".mysql_real_escape_string($_GET['bid_id'])."' and `logistic_provider_id`='".$_SESSION['logistic_provider']['id']."'";
				$q = $this->db->query($sql);
				$bids = $q->result_array();
				$data['bids'] = $bids;
				$this->load->view('lp/rfqsummary_bid2.php', $data);
			}
			else{
				$this->load->view('lp/rfqsummary_bid.php', $data);
			}
		}
		else{
			$this->load->view('lp/rfqsummary.php', $data);
		}
		$this->load->view('sitelayout/footer.php');
	}
	
	public function rfqs(){
		$this->dashboard();
	}
	
	public function dashboard(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		else{
			//$sql = "select * from `rfq` where `destination_timestamp_utc`>=".time()." order by `destination_timestamp_utc`, `destination_country` asc limit 50";
			//$sql = "select * from `rfq` where 1 order by `destination_timestamp_utc` desc, `destination_country` asc limit 50";
			
			if($_POST){
				$_SESSION['searchfilter'] = $_POST;
				//redirect(site_url("lp")."?_refresh", "refresh");
				
				?>
				<script>
				self.location = self.location;
				</script>
				<?php
				
				return 0;
			}
			if($_SESSION['searchfilter']['type']){
				if($_SESSION['searchfilter']['type']=="Route Search"){
					$origin_country = explode("-",$_SESSION['searchfilter']['origin']['country']);
					$origin_country = trim($origin_country[1]);
					$origin_port = explode("--",$_SESSION['searchfilter']['origin']['port']);
					$origin_port = trim($origin_port[1]);
					
					$destination_country = explode("-",$_SESSION['searchfilter']['destination']['country']);
					$destination_country = trim($destination_country[1]);
					$destination_port = explode("--",$_SESSION['searchfilter']['destination']['port']);
					$destination_port = trim($destination_port[1]);
					
					$sql_cnt = "select 
					count(`id`) as cnt
					from `rfq` where ";
					
					if(trim($origin_country)){
						$sql_arr[] = " `origin_country` = '".mysql_real_escape_string($origin_country)."' ";
					}
					if(trim($origin_port)){
						$sql_arr[] = " `origin_port` = '".mysql_real_escape_string($origin_port)."' ";
					}
					if(trim($destination_country)){
						$sql_arr[] = " `destination_country` = '".mysql_real_escape_string($destination_country)."' ";
					}
					if(trim($destination_port)){
						$sql_arr[] = " `destination_port` = '".mysql_real_escape_string($destination_port)."' ";
					}
					
					$sql_arr[] = " 1 ";
					
					$sql_ext .= implode($sql_arr, " and ");
					
					$sql_cnt .= $sql_ext." order by `id`";
					
					$sql = "select
					id,
					origin_country,
					origin_city,
					origin_port,
					origin_date,
					origin_time_zone,
					origin_timestamp_utc,
					origin_date_utc,
					destination_country,
					destination_city,
					destination_port,
					destination_date,
					destination_time_zone,
					destination_timestamp_utc,
					destination_date_utc,
					dateadded
					from `rfq` where ";
					
					$sql .= $sql_ext." order by `id` desc limit 100";
				}
				
				else if($_SESSION['searchfilter']['type']=="Country Search"){
					$country = explode("-",$_SESSION['searchfilter']['country']);
					$country = trim($country[1]);
					
					$sql_cnt = "select 
					count(`id`) as cnt
					from `rfq` where 
					`origin_country` = '".mysql_real_escape_string($country)."' or 
					`destination_country` = '".mysql_real_escape_string($country)."'
					order by `id`";
					
					$sql = "select 
					id,
					origin_country,
					origin_city,
					origin_port,
					origin_date,
					origin_time_zone,
					origin_timestamp_utc,
					origin_date_utc,
					destination_country,
					destination_city,
					destination_port,
					destination_date,
					destination_time_zone,
					destination_timestamp_utc,
					destination_date_utc,
					dateadded
					from `rfq` where 
					`origin_country` = '".mysql_real_escape_string($country)."' or 
					`destination_country` = '".mysql_real_escape_string($country)."'
					order by `id` desc limit 100";
				}
				else if($_SESSION['searchfilter']['type']=="Search by Keywords"){
					$keyword = trim($_SESSION['searchfilter']['keyword']);
					
					$sql_cnt = "select 
					count(`id`) as cnt
					from `rfq` where 
					`data_plain` = '%".mysql_real_escape_string(trim($_SESSION['keyword']))."%'
					order by `id`";
					
					$sql = "select
					id,
					origin_country,
					origin_city,
					origin_port,
					origin_date,
					origin_time_zone,
					origin_timestamp_utc,
					origin_date_utc,
					destination_country,
					destination_city,
					destination_port,
					destination_date,
					destination_time_zone,
					destination_timestamp_utc,
					destination_date_utc,
					dateadded
					from `rfq` where 
					lower(`data_plain`) like '%".mysql_real_escape_string(trim($keyword))."%'
					order by `id` desc limit 100";
					
					//echo $sql;
				}
				else if($_SESSION['searchfilter']['type']=="Categories"){
					$categories = array();
					$imos = array();
					if(is_array($_SESSION['searchfilter']['categories'])){
						$categories = $_SESSION['searchfilter']['categories'];
					}
					if(is_array($_SESSION['searchfilter']['imos'])){
						$imos = $_SESSION['searchfilter']['imos'];
					}
					$arr = array_merge($categories, $imos);
					
					if(count($arr)){
						$sql_cnt = "select 
						count(`id`) as cnt
						from `rfq` where ";
						foreach($arr as $value){
							$sql_arr[] = " `data_plain` like '%".mysql_real_escape_string(trim($value))."%' ";
						}
						$sql_cnt .= implode($sql_arr, " or ");
						$sql_cnt .= " order by `id`";
					
						$sql = "select
						id,
						origin_country,
						origin_city,
						origin_port,
						origin_date,
						origin_time_zone,
						origin_timestamp_utc,
						origin_date_utc,
						destination_country,
						destination_city,
						destination_port,
						destination_date,
						destination_time_zone,
						destination_timestamp_utc,
						destination_date_utc,
						dateadded
						from `rfq` where ";
						$sql .= implode($sql_arr, " or ");
						$sql .= " order by `id` desc limit 100";
					}
				}
				else{
					$sql_cnt = "select 
					count(`id`) as cnt
					from `rfq` where 1 order by `id`";
					
					$sql = "select 
					id,
					origin_country,
					origin_city,
					origin_port,
					origin_date,
					origin_time_zone,
					origin_timestamp_utc,
					origin_date_utc,
					destination_country,
					destination_city,
					destination_port,
					destination_date,
					destination_time_zone,
					destination_timestamp_utc,
					destination_date_utc,
					dateadded
					from `rfq` where 1 order by `id` desc limit 100";
				}
			}
			else{
				$sql_cnt = "select 
				count(`id`) as cnt
				from `rfq` where 1 order by `id`";
				
				$sql = "select 
				id,
				origin_country,
				origin_city,
				origin_port,
				origin_date,
				origin_time_zone,
				origin_timestamp_utc,
				origin_date_utc,
				destination_country,
				destination_city,
				destination_port,
				destination_date,
				destination_time_zone,
				destination_timestamp_utc,
				destination_date_utc,
				dateadded
				from `rfq` where 1 order by `id` desc limit 100";
			}
			$q = $this->db->query($sql_cnt);
			$count = $q->result_array();
			$count = $count[0]['cnt'];
			
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
			$content = $this->load->view('lp/dashboard.php', $data, true);
			$data['content'] = $content;
			$content = $this->load->view('lp/content.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
	}
	
	public function logout(){
		unset($_SESSION['customer']);
		unset($_SESSION['logistic_provider']);
		echo "<script>self.location='".site_url()."'</script>";
	}
	public function login(){
		if($_POST){
			$sql = "select * from `logistic_providers` where 
			`email` = '".mysql_real_escape_string($_POST['email'])."' and 
			`password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."' and 
			`active` = 1 
			";
			$q = $this->db->query($sql);
			$r = $q->result_array();
			if(!$r[0]['id']){
				$_SESSION['logistic_provider']['email'] = $_POST['email'];
				echo "<script>self.location='".site_url("lp/?message=Invalid Login")."'</script>";
				return 0;
			}
			else{
				$_SESSION['logistic_provider'] = $r[0];
				echo "<script>self.location='".site_url("lp")."/'</script>";
				return 0;
			}
		}
	}
	public function register(){
		if($_POST['register']){
			foreach($_POST as $key=>$value){
				$_POST[$key] = trim($value);
			}
			if(!trim($_POST['company_name'])){
				$error = true;
				$errormsg = "Invalid Company Name";
			}
			else if(!trim($_POST['name'])){
				$error = true;
				$errormsg = "Invalid Name";
			}
			else if(!checkEmail($_POST['email'], false)){
				$error = true;
				$errormsg = "Invalid E-mail";
			}
			else if(!trim($_POST['password'])){
				$error = true;
				$errormsg = "Invalid Password";
			}
			else if($_POST['password']!=$_POST['repassword']){
				$error = true;
				$errormsg = "Password and Confirm Password don't match";
			}
			else{
				$sql = "select * from `logistic_providers` where `email`='".mysql_real_escape_string($_POST['email'])."'";
				$q = $this->db->query($sql);
				$r = $q->result_array();
				if(count($r)){
					$error = true;
					$errormsg = "E-mail address is already registered. Please input a new one.";
				}
			}
			
			if(!$error){
				$sql = "insert into `logistic_providers` set
				`company_name` = '".mysql_real_escape_string($_POST['company_name'])."',
				`name` = '".mysql_real_escape_string($_POST['name'])."',
				`email` = '".mysql_real_escape_string($_POST['email'])."',
				`password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."',
				`dateadded` = NOW()
				";
				$q = $this->db->query($sql);
				$emailtos = array();
				$email = array();
				$email['name'] = $_POST['name'];
				$email['email'] = $_POST['email'];
				$emailtos[] = $email;
				$this->sendWelcome($emailtos);
				
				echo "<script>self.location='".site_url("lp/thankyou")."'</script>";
			}
			else{
				echo "<script>alertX(\"".htmlentitiesX($errormsg)."\");</script>";
			}
		}
		else{
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('lp/register.php', '', true);
			$data['content'] = $content;
			$data['page'] = "Sign-up";
			$this->load->view('sitelayout/container_lp.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
	}
	public function thankyou_for_bidding(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/bid_thankyou.php', '', true);
		$data['content'] = $content;
		$this->load->view('sitelayout/container_lp.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function thankyou(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/register_thankyou.php', '', true);
		$data['content'] = $content;
		$this->load->view('sitelayout/container_lp.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function forgotpassword(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/forgotpassword.php', '', true);
		$data['content'] = $content;
		$this->load->view('sitelayout/container_lp.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function submit_bid(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		$bid = array();
		$bid = $_POST;
				
		$country = explode("-", urldecode($bid['origin']['country']));
		$country_code = trim($country[0]);
		$country = trim($country[1]);
		$bid['origin']['country'] = $country;
		$bid['origin']['country_code'] = $country_code;
		
		$country = explode("-", urldecode($bid['destination']['country']));
		$country_code = trim($country[0]);
		$country = trim($country[1]);
		$bid['destination']['country'] = $country;
		$bid['destination']['country_code'] = $country_code;
		
		$port1 = explode("--", urldecode($bid['origin']['port']));
		$port1_id = trim($port1[0]);
		$port1 = trim($port1[1]);
		$bid['origin']['port_id'] = $port1_id;
		$bid['origin']['port'] = $port1;
		$port2 = explode("--", urldecode($bid['destination']['port']));
		$port2_id = trim($port2[0]);
		$port2 = trim($port2[1]);
		$bid['destination']['port_id'] = $port2_id;
		$bid['destination']['port'] = $port2;
		if($_FILES){
			$bid['files'] = $_FILES;
		}
		
		//convert to USD
		$currency = explode(" ", $bid['total_bid_currency']);
		$currency = $currency[0];
		$exchange_rate = @file_get_contents("http://rate-exchange.appspot.com/currency?from=".$currency."&to=USD");
		$exchange_rate = @json_decode($exchange_rate);
		
		if(isset($exchange_rate->rate)){
			$bid['total_bid_usd'] = $exchange_rate->rate * $bid['total_bid'];
		}
		
		
		if(!trim($bid['total_bid'])){
			?><script>alert("Please specify your total bid price!");</script><?
			return 0;
		}
		else if(!is_numeric($bid['total_bid'])){
			?>
			<script>
			alert("Please enter a valid number for your total bid price. e.g. 1000.00");
			window.parent.jQuery("#total_bid").focus();
			</script><?
			return 0;
		}
		$sql = "insert into `bids` set 
			`data` = '".base64_encode(serialize($bid))."',
			`rfq_id` = '".mysql_real_escape_string($_SESSION['for_bidding']['rfq_id'])."',
			`logistic_provider_id` = '".mysql_real_escape_string($_SESSION['logistic_provider']['id'])."',
			`origin_country` = '".mysql_real_escape_string($bid['origin']['country'])."',
			`origin_city` = '".mysql_real_escape_string($bid['origin']['city'])."',
			`origin_port` = '".mysql_real_escape_string($bid['origin']['port'])."',
			`origin_date` = '".mysql_real_escape_string($bid['origin']['date'])."',
			`destination_country` = '".mysql_real_escape_string($bid['destination']['country'])."',
			`destination_city` = '".mysql_real_escape_string($bid['destination']['city'])."',
			`destination_port` = '".mysql_real_escape_string($bid['destination']['port'])."',
			`destination_date` = '".mysql_real_escape_string($bid['destination']['date'])."',
			`total_bid_currency` = '".mysql_real_escape_string($bid['total_bid_currency'])."',
			`total_bid` = '".mysql_real_escape_string($bid['total_bid'])."',
			`total_bid_usd` = '".mysql_real_escape_string($bid['total_bid_usd'])."',
			`dateadded` = NOW()
		";
		$this->db->db_debug = FALSE; //disable debugging for queries
		$q = $this->db->query($sql);
		if(!$this->db->_error_message()){
			$insert_id = $this->db->insert_id();
			$bid_id = $insert_id;
			if($insert_id){
				$t = count($_FILES['attachments']['tmp_name']);
				$folder = dirname(__FILE__)."/../../_uploads/bid_".$insert_id;
				@mkdir($folder, 0777);
				for($i=0; $i<$t; $i++){
					$source = $_FILES['attachments']['tmp_name'][$i];
					$destination = $folder."/".urlencode($_FILES['attachments']['name'][$i]);
					move_uploaded_file($source, $destination);
				}
			}
			
			$sql = "select `customer_id` from `rfq` where `id`='".$_SESSION['for_bidding']['rfq_id']."'";
			$q = $this->db->query($sql);
			$customer_id = $q->result_array();
			$customer_id = $customer_id[0]['customer_id'];
			
			if($customer_id){
				$sql = "select * from `customers` where `id`='".$customer_id."'";
				$q = $this->db->query($sql);
				$customer = $q->result_array();
			
				$emailtos = array();
				$email = array();
				$email['name'] = $customer[0]['first_name']." ".$customer[0]['last_name'];
				$email['email'] = $customer[0]['email'];
				$emailtos[] = $email;
				
				$message .= "--\n\n";
				$bidref = site_url("cs")."/rfq/".$_SESSION['for_bidding']['rfq_id']."/bid?bid_id=".$bid_id;
				$message .= "Reference URL: <a href='".$bidref."'>".$bidref."</a><br />";
			
				$this->sendSubmittedBid($emailtos, $message);
			}	
					
			echo "<script>window.parent.location='".site_url("lp/thankyou_for_bidding")."'</script>";
		}
		else{
			?><script>alert("A database error has occured! Please try again.");</script><?
		}
		
		//echo "<pre>";
		//print_r($_SESSION);
		//echo "</pre>";
		/*
		Array
		(
			[logistic_provider] => Array
				(
					[id] => 1
					[email] => jairus@e27.co
					[company_name] => NMG
					[password] => 5f4dcc3b5aa765d61d8327deb882cf99
					[active] => 1
					[dateadded] => 0000-00-00 00:00:00
				)

		)
		*/
		//echo "<pre>";
		//print_r($bid);
		//echo "</pre>";
		/*
		Array
		(
			[origin] => Array
				(
					[country] => Algeria
					[city] => 
					[port] => Algeria Terminal
					[date] => 04/17/2014
					[country_code] => DZ
					[port_id] => 21236
				)

			[destination] => Array
				(
					[country] => Benin
					[city] => 
					[port] => Cotonou Terminal
					[country_code] => BJ
					[port_id] => 20301
				)

			[total_bid_currency] => USD United States Dollars
			[total_bid] => 100
			[additional_notes] => additional notes
		)
		*/
		//echo "<pre>";
		//print_r($_FILES);
		//echo "</pre>";
		/*
		Array
		(
			[attachments] => Array
				(
					[name] => Array
						(
							[0] => eStatement_06122013.pdf
						)

					[type] => Array
						(
							[0] => application/pdf
						)

					[tmp_name] => Array
						(
							[0] => D:\xampp\tmp\php2EA3.tmp
						)

					[error] => Array
						(
							[0] => 0
						)

					[size] => Array
						(
							[0] => 80916
						)

				)

		)

		*/
	}
	
	private function sendSubmittedBid($emailtos, $moremessage=""){
	
		$from = "noreply@seadex.com";
		$fromname = "Seadex";

		$subject = "A new bid had been placed for your RFQ!";
		$template = array();
		$template['data'] = array();
		$template['data']['name'] = $toname;
		$email_content = "
Hello,

A new bid had been placed for you RFQ:

".$moremessage."

Regards,
The SeaDex team";
		$template['data']['content'] = $email_content;
		$template['data']['content'] = nl2br($template['data']['content']);
		$template['slug'] = "seadex"; 
		
		send_email($from, $fromname, $emailtos, $subject, $message, $template);

	}
	
	public function sendWelcome($emailtos){
	
		$from = "noreply@seadex.com";
		$fromname = "Seadex";

		$subject = "Thank you for partnering with SeaDex!";
		$template = array();
		$template['data'] = array();
		$template['data']['name'] = $toname;
		$email_content = "Thank you for partnering with SeaDex!

Your acceptance of the Sales Agreement is registered and we are glad to welcome your company as a part of the SeaDex network.

In the coming months we will provide your company with potential Customers opportunities when we have relevant business for you. 

You get: 

• A free trial period of 6 months
• All potential Customers Leads are Free.
• Provides qualified potential Customers leads 24/7 365 days.
• An email list of potential Customers opportunities is received when we have relevant business for you. 
• Login and Review the Opportunity for each potential Customer.
• Connect with Potential Customers and bid on suitable Opportunities.
• Close the Deal directly with the Customer

The SeaDex advantages for customers: 

• A web portal that allows potential Customers to upload their freight requirements.
• It is intuitive allowing potential Customers to input their data easily and accurately.
• It is Free to use always for potential Customers.
• Any device, any time and anywhere.
• Delivers qualified potential Customers to your company.


We would like to send you a message when new additional features are released on the site. 
Any questions? 
Email us at <a herf='mailto:info@seadex.com'>info@seadex.com</a>

SeaDex is ONLINE and focuses on Digital Channels targeting consumers. We are your Marketing Department additional resources. 


Regards,
The SeaDex team";
		$template['data']['content'] = $email_content;
		$template['data']['content'] = nl2br($template['data']['content']);
		$template['slug'] = "seadex"; 
		
		send_email($from, $fromname, $emailtos, $subject, $message, $template);

	}
	
	public function testmail(){
		$emailtos = array();
		$email = array();
		$email['name'] = "jairus bondoc";
		$email['email'] = "jairus@nmgresources.ph";
		$emailtos[] = $email;

		$from = "noreply@seadex.com";
		$fromname = "Seadex";

		$subject = "Thank you for partnering with SeaDex!";
		$template = array();
		$template['data'] = array();
		$template['data']['name'] = $toname;
		$email_content = "Thank you for partnering with SeaDex!

Your acceptance of the Sales Agreement is registered and we are glad to welcome your company as a part of the SeaDex network.

In the coming months we will provide your company with potential Customers opportunities when we have relevant business for you. 

You get: 

• A free trial period of 6 months
• All potential Customers Leads are Free.
• Provides qualified potential Customers leads 24/7 365 days.
• An email list of potential Customers opportunities is received when we have relevant business for you. 
• Login and Review the Opportunity for each potential Customer.
• Connect with Potential Customers and bid on suitable Opportunities.
• Close the Deal directly with the Customer

The SeaDex advantages for customers: 

• A web portal that allows potential Customers to upload their freight requirements.
• It is intuitive allowing potential Customers to input their data easily and accurately.
• It is Free to use always for potential Customers.
• Any device, any time and anywhere.
• Delivers qualified potential Customers to your company.


We would like to send you a message when new additional features are released on the site. 
Any questions? 
Email us at <a herf='mailto:info@seadex.com'>info@seadex.com</a>

SeaDex is ONLINE and focuses on Digital Channels targeting consumers. We are your Marketing Department additional resources. 


Regards,
The SeaDex team";
		$template['data']['content'] = $email_content;
		$template['data']['content'] = nl2br($template['data']['content']);
		$template['slug'] = "seadex"; 
		
		send_email($from, $fromname, $emailtos, $subject, $message, $template);

	}

	
	public function forgotpass($token=""){
		if(!$token){
			if($_POST){
				$_SESSION['forgotpass']['email'] = $_POST['email'];
				$sql = "select * from `logistic_providers` where lower(`email`) = '".mysql_real_escape_string(strtolower(trim($_POST['email'])))."'";
				$q = $this->db->query($sql);
				$logistic_provider = $q->result_array();
				if($logistic_provider[0]['id']){
					$_SESSION['forgotpass']['success'] = "A reset password e-mail has been sent to ".$_SESSION['forgotpass']['email'].".";
					$token = time();
					$sql = "insert into `forgotpass_tokens` set
						`who_id` = 'logistic_provider_".$logistic_provider[0]['id']."',
						`timestamp` = '".$token."'
					";
					$q = $this->db->query($sql);
					$link = site_url("lp")."/forgotpass/".md5($token);
					
					$emailtos = array();
					$email = array();
					$email['name'] = $logistic_provider[0]['company_name'];
					$email['email'] = $logistic_provider[0]['email'];
					$emailtos[] = $email;
					$this->sendForgotPass($emailtos, $link);
					unset($_SESSION['forgotpass']['email']);
				}
				else{
					$_SESSION['forgotpass']['error'] = "The specified E-mail address is not a registered SeaDex Service Provider.";
				}
				
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('lp/forgotpass.php', '', true);
			$data['content'] = $content;
			$data['page'] = "Forgot Password";
			$this->load->view('sitelayout/container_lp.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else{
			
			$sql = "select * from `forgotpass_tokens` where md5(`timestamp`) = '".mysql_real_escape_string($token)."' and `used`<1";
			$q = $this->db->query($sql);
			$token = $q->result_array();
			
			$who_id = $token[0]['who_id'];
			$who_id_str = $who_id;
			$who_id = explode("_", $who_id);
			if($who_id[0]=="logistic" && $who_id[2]>0&&(time()-$token[0]['timestamp'])<(5*60)){
				$sql = "select * from `logistic_providers` where `id`='".mysql_real_escape_string($who_id[2])."'";
				$q = $this->db->query($sql);
				$logistic_provider = $q->result_array();
				if($logistic_provider[0]['id']){
					if($_POST){
						if(trim($_POST['password'])){
							$sql = "update `logistic_providers` set `password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."' 
							where `id`='".$logistic_provider[0]['id']."'
							";
							$q = $this->db->query($sql);
							$sql = "update `forgotpass_tokens` set `used`=1 where `who_id`='".$who_id_str."'";
							$q = $this->db->query($sql);
							$_SESSION['logistic_provider']['email'] = $logistic_provider[0]['email'];
							$_SESSION['forgotpass']['success'] = "Successfully updated the password for ".$logistic_provider[0]['email'].".
							<a href='".site_url('lp')."'>Click here to login</a>
							"; 
						}
						else{
							$_SESSION['forgotpass']['error'] = "Please enter a valid password."; 
						}
					}
					$_SESSION['forgotpass']['email'] = $logistic_provider[0]['email'];
					$this->load->view('sitelayout/header.php');
					$this->load->view('sitelayout/nav.php');
					$content = $this->load->view('lp/newpass.php', '', true);
					$data['content'] = $content;
					$data['page'] = "Forgot Password";
					$this->load->view('sitelayout/container_lp.php', $data);
					$this->load->view('sitelayout/footer.php');
				}
			}
			else{
				?>
				<script>
				self.location = "<?php echo site_url("lp"); ?>";
				</script>
				<?php
			}
		}
	}
	
	private function sendForgotPass($emailtos, $link){
	
		$from = "noreply@seadex.com";
		$fromname = "Seadex";

		$subject = "Service Provider Login Password Reset!";
		$template = array();
		$template['data'] = array();
		$template['data']['name'] = $toname;
		$email_content = "Hello,

Please visit the link below to reset your password:

<a href='".$link."' target='_blank'>".$link."</a>

Regards,
The SeaDex team";
		$template['data']['content'] = $email_content;
		$template['data']['content'] = nl2br($template['data']['content']);
		$template['slug'] = "seadex"; 
		
		send_email($from, $fromname, $emailtos, $subject, $message, $template);

	}
	
	public function changepass(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		if($_POST){
			if(!trim($_POST['password'])){
				$_SESSION['changepass']['error'] = "Please enter a valid password!";
			}
			else if(trim($_POST['password'])!=trim($_POST['confirm_password'])){
				$_SESSION['changepass']['error'] = "Password and Confirm Password don't match!";
			}
			else{
				$sql = "update `logistic_providers` set
				`password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."'
				where `id`='".$_SESSION['logistic_provider']['id']."'
				";
				$this->db->query($sql);
				$_SESSION['changepass']['success'] = "Successfully changed password!";
			}
			
			
		}
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/changepass.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function mybids(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		$sql = "select 
		`id`, 
		`rfq_id`, 
		`total_bid_usd`,
		`origin_country`,
		`origin_city`,
		`origin_port`,
		`destination_country`,
		`destination_city`,
		`destination_port`,
		`total_bid_usd`,
		`dateadded`
		from `bids` where 
		`logistic_provider_id`='".$_SESSION['logistic_provider']['id']."'
		order by `id` desc
		";
		$q = $this->db->query($sql);
		$bids = $q->result_array();
		$data['bids'] = $bids;
		
		
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/mybids.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function acceptedbids(){
		if(!$_SESSION['logistic_provider']['id']){
			$redirect = urlencode($_SERVER['REQUEST_URI']);
			echo "<script>self.location='".site_url("lp")."/?redirect=".$redirect."'</script>";
		}
		
		$sql = "select 
		`id`, 
		`rfq_id`, 
		`total_bid_usd`,
		`origin_country`,
		`origin_city`,
		`origin_port`,
		`destination_country`,
		`destination_city`,
		`destination_port`,
		`total_bid_usd`,
		`dateadded`
		from `bids` where `logistic_provider_id`='".$_SESSION['logistic_provider']['id']."'
		and `id` in (
			select
			`bid_id`
			from `rfq`
			where 
			`logistic_provider_id` = '".$_SESSION['logistic_provider']['id']."'
		)
		order by `id` desc
		";
		$q = $this->db->query($sql);
		$bids = $q->result_array();
		$data['bids'] = $bids;
		
		
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('lp/acceptedbids.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
}
