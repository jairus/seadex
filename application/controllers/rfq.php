<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class rfq extends CI_Controller {
	var $table;
	var $controller;
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function index(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		$content = $this->load->view('rfq/index.php', '', true);
		$data['content'] = $content;
		$this->load->view('sitelayout/container.php', $data);
		$this->load->view('sitelayout/footer.php');
		unset($_SESSION['rfq']);
	}	
	
	public function priv($step=1){
		$_SESSION['rfq']['customer_type'] = "private";
		$this->flow($step, "priv");
	}
	
	public function prof($step=1){
		$_SESSION['rfq']['customer_type'] = "professional";
		$this->flow($step, "prof");
	}
	
	private function flow($step=1, $type){
		$data['type'] = $type;
		if($step==1){
			if($_GET['change']){
				$data['skip'] = true;
			}
			else{
				$_SESSION['rfq']['cargo_index'] = 0;
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$data['content'] = $this->load->view('rfq/priv_1.php', $data, true);
			$data['step'] = $step;
			$this->load->view('rfq/priv.php', $data);
			$this->load->view('sitelayout/footer.php');
			
		}
		else if($step==2){
			if($_POST['shipping_info']){
				$_SESSION['rfq']['shipping_info'] = $_POST;
				
				//print_r($_POST);
				
				$country  = $_SESSION['rfq']['shipping_info']['origin']['country'];
				list($country_code, $country) = explode("-", urldecode($country));
				$_SESSION['rfq']['shipping_info']['origin']['country'] = trim($country);
				$_SESSION['rfq']['shipping_info']['origin']['country_code'] = trim($country_code);
				
				$country  = $_SESSION['rfq']['shipping_info']['destination']['country'];
				list($country_code, $country) = explode("-", urldecode($country));
				$_SESSION['rfq']['shipping_info']['destination']['country'] = trim($country);
				$_SESSION['rfq']['shipping_info']['destination']['country_code'] = trim($country_code);
				
				$port  = $_SESSION['rfq']['shipping_info']['origin']['port'];
				list($port_id, $port) = explode("--", urldecode($port));
				$_SESSION['rfq']['shipping_info']['origin']['port_id'] = trim(SDDecrypt($port_id));
				$_SESSION['rfq']['shipping_info']['origin']['port'] = trim($port);
				
				$port  = $_SESSION['rfq']['shipping_info']['destination']['port'];
				list($port_id, $port) = explode("--", urldecode($port));
				$_SESSION['rfq']['shipping_info']['destination']['port_id'] = trim(SDDecrypt($port_id));
				$_SESSION['rfq']['shipping_info']['destination']['port'] = trim($port);
				
				$data['backbutton'] = true;
			}
			if($_GET['skip']){
				$data['skip'] = true;
			}
			if($_GET['new']){
				$data['new'] = true;
				$_SESSION['rfq']['cargo_index'] += 1;
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$data['content'] = $this->load->view('rfq/priv_2.php', $data, true);
			$data['step'] = $step;
			$this->load->view('rfq/priv.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else if($step==3){
			if($_POST){
				if(!is_array($_SESSION['rfq']['cargo'])){
					$_SESSION['rfq']['cargo'] = array();
				}
				$cargo = array();
				$cargo['what_to_move'] = $_POST['what_to_move'];
				$_SESSION['rfq']['cargo'][$_SESSION['rfq']['cargo_index']] = $cargo;
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			if($_POST['what_to_move']=="Goods"){
				$data['content'] = $this->load->view('rfq/priv_3_goods.php', $data, true);
			}
			else if($_POST['what_to_move']=="Vehicle or Boat"){
				$data['content'] = $this->load->view('rfq/priv_3_vehicle.php', $data, true);
			}
			else if($_POST['what_to_move']=="Household"){
				$data['content'] = $this->load->view('rfq/priv_3_household.php', $data, true);
			}
			$data['step'] = $step;
			$this->load->view('rfq/priv.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
		else if($step==4){
			if($_POST){
				if(!is_array($_SESSION['rfq']['cargo'])){
					$_SESSION['rfq']['cargo'] = array();
				}
				$cargo = array();
				$cargo = $_POST;
				$_SESSION['rfq']['cargo'][$_SESSION['rfq']['cargo_index']]['details'] = $cargo;
				//$data['backbutton'] = true;
			}
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$data['content'] = $this->load->view('rfq/priv_4.php', $data, true);
			$data['step'] = $step;
			$this->load->view('rfq/priv.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
	}
	
	public function userprofile(){
		if($_POST['userprofile']){
			//Array ( [userprofile] => Array ( [email] => [firstname] => [lastname] => [contactnumber] => [country] => ) ) 
			$user = $_POST['userprofile'];
			$error = false;
			if(!checkEmail($user['email'])){
				?>
				<script>
					alert("Invalid Email!");
				</script>
				<?php
				$error = true;
			}
			else if(!trim($user['firstname'])){
				?>
				<script>
					alert("Invalid First Name!");
				</script>
				<?php
				$error = true;
			}
			else if(!trim($user['lastname'])){
				?>
				<script>
					alert("Invalid Last Name!");
				</script>
				<?php
				$error = true;
			}
			else if(!trim($user['contactnumber'])){
				?>
				<script>
					alert("Invalid Contact Number!");
				</script>
				<?php
				$error = true;
			}
			else if(!trim($user['country'])){
				?>
				<script>
					alert("Invalid Country!");
				</script>
				<?php
				$error = true;
			}
			if(!$error){
				print_r($_SESSION['rfq']);
				$_SESSION['rfq']['userprofile'] = $_POST['userprofile'];
				
				
				$rfq_shipping_info = $_SESSION['rfq']['shipping_info'];
				$data = base64_encode(serialize($_SESSION['rfq']));
				$sql = "
				INSERT INTO `rfq` set 
				`data` = '".mysql_real_escape_string($data)."',
				`origin_country` = '".mysql_real_escape_string($rfq_shipping_info['origin']['country'])."',
				`origin_city` = '".mysql_real_escape_string($rfq_shipping_info['origin']['city'])."',
				`origin_port` = '".mysql_real_escape_string($rfq_shipping_info['origin']['port'])."',
				`origin_date` = '".mysql_real_escape_string($rfq_shipping_info['origin']['date'])."',
				`destination_country` = '".mysql_real_escape_string($rfq_shipping_info['destination']['country'])."',
				`destination_city` = '".mysql_real_escape_string($rfq_shipping_info['destination']['city'])."',
				`destination_port` = '".mysql_real_escape_string($rfq_shipping_info['destination']['port'])."',
				`destination_date` = '".mysql_real_escape_string($rfq_shipping_info['destination']['date'])."',
				`dateadded` = NOW()
				";
				$q = $this->db->query($sql);
				$_SESSION['rfq_complete'] = true;
				?>
				<script>
					window.parent.location = "<?php echo site_url("rfq/thankyou"); ?>";
				</script>
				<?php
			}
		}
		else{
			$this->load->view('sitelayout/header.php');
			$this->load->view('sitelayout/nav.php');
			$data['content'] = $this->load->view('rfq/userprofile.php', $data, true);
			$this->load->view('rfq/userprofile_container.php', $data);
			$this->load->view('sitelayout/footer.php');
		}
	}
	
	public function thankyou(){
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		//$data['content'] = $this->load->view('rfq/thankyou.php', $data, true);
		$this->load->view('rfq/thankyou.php', $data);
		$this->load->view('sitelayout/footer.php');
	}
	public function removecargo($index){
		if(trim($index)!=""){
			unset($_SESSION['rfq']['cargo'][$index]);
		}
		if($_SESSION['rfq']['customer_type']=="private"){
			if(count($_SESSION['rfq']['cargo'])>=1){
				redirect(site_url("rfq/priv/2?skip=1"), "refresh");
			}
			else{
				redirect(site_url("rfq/priv/2"), "refresh");
			}
		}
		else{
			if(count($_SESSION['rfq']['cargo'])>=1){
				redirect(site_url("rfq/prof/2?skip=1"), "refresh");
			}
			else{
				redirect(site_url("rfq/prof/2"), "refresh");
			}
		}
	}
	public function portToPort($port1, $port2){
		list($port_id1, $port_name1) = explode("--", urldecode($port1));
		list($port_id2, $port_name2) = explode("--", urldecode($port2));
		$port_id1 = SDDecrypt($port_id1);
		$port_id2 = SDDecrypt($port_id2);
		
		$sql = "select * from `distances` where `port1`='".mysql_real_escape_string($port_id1)."' and `port2`='".mysql_real_escape_string($port_id2)."'";
		
		$q = $this->db->query($sql);
		$distance = $q->result_array();
		
		if(count($distance)){
			$data = json_decode(base64_decode($distance[0]['data']));
		}
		else{
			//http://sirius.searates.com/port/port-to-port
			//port_a=12110&port_b=11409
			$url = 'http://sirius.searates.com/port/port-to-port';
			$fields = array(
						'port_a' => urlencode($port_id1),
						'port_b' => urlencode($port_id2)
				);
			//url-ify the data for the POST
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			//open connection
			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			//execute post
			$result = curl_exec($ch);
			$sql = "insert into `distances` set
			`port1`='".mysql_real_escape_string($port_id1)."',
			`port2`='".mysql_real_escape_string($port_id2)."',
			`data`='".mysql_real_escape_string(base64_encode($result))."'
			";
			$q = $this->db->query($sql);
			
			$data = json_decode($result);
			//close connection
			curl_close($ch);
		}
		
		$distance = $data->dist;
		$speed = (1.852 * 24); //24 knots
		$hours = $distance / $speed;
		$days = ceil($hours/24);
		echo $distance."|".$days;
	}
	
	public function getPorts($country){
		$country = explode("-", urldecode($country));
		$country = trim($country[0]);
		$sql = "select * from `ports` where `country_code`='".mysql_real_escape_string($country)."'";
		$q = $this->db->query($sql);
		$ports = $q->result_array();
		$t = count($ports);
		for($i=0; $i<$t; $i++){
			$port = SDEncrypt($ports[$i]['port_id'])."--".$ports[$i]['name'];
			echo "<option value=\"".$port."\">".$ports[$i]['name']."</option>";
		}
	}

}
?>