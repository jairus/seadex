<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
date_default_timezone_set ("UTC");
class cs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function index(){
		if(!$_SESSION['customer']['id']){
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('cs/index.php', '', true);
			$data['content'] = $content;
			$this->load->view('sitelayout/container_cs.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else{
			$this->dashboard();
		}
		unset($_SESSION['rfq']);
	}
	
	public function tor(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('cs/nav.php');
		$content = $this->load->view('cs/tor.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function account(){
		if(!$_SESSION['logistic_provider']['id']){
			echo "<script>self.location='".site_url("lp")."/'</script>";
		}
		$this->load->view('sitelayout/header.php');
		$this->load->view('cs/nav.php');
		$data['account'] = $_SESSION['logistic_provider'];
		$content = $this->load->view('cs/account.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
		
	}
	
	
	public function rfqs(){
		$this->dashboard();
	}
	
	public function dashboard(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$data['rfqs'] = $rfqs;
		$data['count'] = $count;
		$content = $this->load->view('cs/dashboard.php', $data, true);
		$data['content'] = $content;
		$content = $this->load->view('cs/content.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	
	public function logout(){
		unset($_SESSION['customer']);
		echo "<script>self.location='".site_url("consumers")."/'</script>";
	}
	public function login(){
		if($_POST){
			$sql = "select * from `customers` where 
			`email` = '".mysql_real_escape_string($_POST['email'])."' and 
			`password` = '".mysql_real_escape_string(md5(trim($_POST['password'])))."'
			";
			$q = $this->db->query($sql);
			$r = $q->result_array();
			if(!$r[0]['id']){
				$_SESSION['customer']['email'] = $_POST['email'];
				echo "<script>self.location='".site_url("cs/?message=Invalid Login")."'</script>";
				return 0;
			}
			else{
				$_SESSION['customer'] = $r[0];
				echo "<script>self.location='".site_url("cs")."/'</script>";
				return 0;
			}
		}
	}
	public function register(){
		if($_POST['register']){
			$user = $_POST['userprofile'];
			$error = false;
			if(!checkEmail($user['email'])){
				?>
				<script>
					alertX("Invalid Email!");
				</script>
				<?php
				$error = true;
			}
			else{
				$sql = "select * from `customers` where `email`='".mysql_real_escape_string(trim($user['email']))."'";
				$q = $this->db->query($sql);
				$customer = $q->result_array();
				if($customer[0]['id']){
					?>
					<script>
						alertX("The specified E-mail address is already registered!");
					</script>
					<?php
					$error = true;
				}
			}
			if(!$error){
				if(!trim($user['password'])){
					?>
					<script>
						alertX("Invalid Password!");
					</script>
					<?php
					$error = true;
				}
				else if(trim($user['password'])!=trim($user['confirm_password'])){
					?>
					<script>
						alertX("Password and Confirm Password don't match!");
					</script>
					<?php
					$error = true;
				}
				else if($user['type']=="professional"&&!trim($user['company_name'])){
					?>
					<script>
						alertX("Invalid Company Name!");
					</script>
					<?php
					$error = true;
				}
				else if(!trim($user['first_name'])){
					?>
					<script>
						alertX("Invalid First Name!");
					</script>
					<?php
					$error = true;
				}
				else if(!trim($user['last_name'])){
					?>
					<script>
						alertX("Invalid Last Name!");
					</script>
					<?php
					$error = true;
				}
				else if(!trim($user['contact_number'])){
					?>
					<script>
						alertX("Invalid Contact Number!");
					</script>
					<?php
					$error = true;
				}
				else if(!trim($user['country'])){
					?>
					<script>
						alertX("Invalid Country!");
					</script>
					<?php
					$error = true;
				}
			}
			if(!$error){
				//insert user profile
				$sql = "insert into `customers` set
				`email` = '".mysql_real_escape_string(trim($user['email']))."',
				`password` = '".mysql_real_escape_string(md5(trim($user['password'])))."',
				`first_name` = '".mysql_real_escape_string(trim($user['first_name']))."',
				`last_name` = '".mysql_real_escape_string(trim($user['last_name']))."',
				`type` = '".mysql_real_escape_string(trim($user['type']))."',
				`company_name` = '".mysql_real_escape_string(trim($user['company_name']))."',
				`country` = '".mysql_real_escape_string(trim($user['country']))."',
				`contact_number` = '".mysql_real_escape_string(trim($user['contact_number']))."'
				";
				$q = $this->db->query($sql);
				$emailtos = array();
				$email = array();
				$email['name'] = $_POST['first_name'];
				$email['email'] = $_POST['email'];
				$emailtos[] = $email;
				//$this->sendWelcome($emailtos);
				
				echo "<script>self.location='".site_url("cs/thankyou")."'</script>";
			}
		}
		else{
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$content = $this->load->view('cs/register.php', '', true);
			$data['content'] = $content;
			$data['page'] = "Sign-up";
			$this->load->view('sitelayout/container_cs.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
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

	
	
}
