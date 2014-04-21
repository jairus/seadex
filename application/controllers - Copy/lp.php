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
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('lp/index.php', '', true);
			$data['content'] = $content;
			$this->load->view('sitelayout/container_lp.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else{
			$this->dashboard();
		}
		unset($_SESSION['rfq']);
	}
	
	
	public function tor(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('lp/nav.php');
		$content = $this->load->view('lp/tor.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function account(){
		if(!$_SESSION['logistic_provider']['id']){
			echo "<script>self.location='".site_url("lp")."/'</script>";
		}
		$this->load->view('sitelayout/header.php');
		$this->load->view('lp/nav.php');
		$data['account'] = $_SESSION['logistic_provider'];
		$content = $this->load->view('lp/account.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('lp/content.php', $data);
		$this->load->view('sitelayout/footer.php');
		
	}
	
	public function rfq($id, $bid=false){
		if(!$_SESSION['logistic_provider']['id']){
			echo "<script>self.location='".site_url("lp")."/'</script>";
		}
		$sql = "select * from `rfq` where `id`='".mysql_real_escape_string($id)."'";
		$q = $this->db->query($sql);
		$rfq = $q->result_array();
		$rfqdata = unserialize(base64_decode($rfq[0]['data']));
		$rfqdata['id'] = $rfq[0]['id'];
		$this->load->view('sitelayout/header.php');
		$this->load->view('lp/nav.php');
		$data['rfq'] = $rfqdata;
		if($bid){
			$this->load->view('lp/rfqsummary_bid.php', $data);
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
			$this->index();
		}
		else{
			//$sql = "select * from `rfq` where `destination_timestamp_utc`>=".time()." order by `destination_timestamp_utc`, `destination_country` asc limit 50";
			//$sql = "select * from `rfq` where 1 order by `destination_timestamp_utc` desc, `destination_country` asc limit 50";
			$sql = "select * from `rfq` where 1 order by `id` desc limit 50";
			$q = $this->db->query($sql);
			$rfqs = $q->result_array();
			
			$this->load->view('sitelayout/header.php');
			$this->load->view('lp/nav.php');
			$data['rfqs'] = $rfqs;
			$content = $this->load->view('lp/dashboard.php', $data, true);
			$data['content'] = $content;
			$content = $this->load->view('lp/content.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
	}
	
	public function logout(){
		unset($_SESSION['logistic_provider']);
		echo "<script>self.location='".site_url("lp")."/'</script>";
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
			
			if(!$error){
				$sql = "insert into `logistic_providers` set
				`company_name` = '".mysql_real_escape_string($_POST['company_name'])."',
				`name` = '".mysql_real_escape_string($_POST['name'])."',
				`email` = '".mysql_real_escape_string($_POST['email'])."',
				`password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."',
				`dateadded` = NOW()
				";
				$q = $this->db->query($sql);
				echo "<script>self.location='".site_url("lp/thankyou")."'</script>";
			}
			else{
				echo "<script>alert(\"".htmlentitiesX($errormsg)."\");</script>";
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
			$this->index();
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
		
		$port1 = explode("-", urldecode($bid['origin']['port']));
		$port1_id = trim($port1[0]);
		$port1 = trim($port1[1]);
		$bid['origin']['port_id'] = $port1_id;
		$bid['origin']['port'] = $port1;
		$port2 = explode("-", urldecode($bid['destination']['port']));
		$port2_id = trim($port2[0]);
		$port2 = trim($port2[1]);
		$bid['destination']['port_id'] = $port2_id;
		$bid['destination']['port'] = $port2;
		if($_FILES){
			$bid['files'] = $_FILES;
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
			`dateadded` = NOW()
		";
		$this->db->db_debug = FALSE; //disable debugging for queries
		$q = $this->db->query($sql);
		if(!$this->db->_error_message()){
			$insert_id = $this->db->insert_id();
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

	
	
}