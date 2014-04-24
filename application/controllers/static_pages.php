<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
date_default_timezone_set ("UTC");
class static_pages extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function about(){
		$data['title_tag'] = "About SeaDex";
		$this->load->view('sitelayout/header.php', $data);
		$this->load->view('sitelayout/nav.php');
		$this->load->view('static_pages/about.php', $data);
		$this->load->view('sitelayout/footer.php');
		unset($_SESSION['rfq']);
	}

	public function situation(){
		$data['title_tag'] = "The Situation";
		$this->load->view('sitelayout/header.php', $data);
		$this->load->view('sitelayout/nav.php');
		$this->load->view('static_pages/situation.php', $data);
		$this->load->view('sitelayout/footer.php');
		unset($_SESSION['rfq']);
	}
	
	public function consumers(){
		if(!$_SESSION['customer']['id']){
			$data['title_tag'] = "Consumer";
			$this->load->view('sitelayout/header.php', $data);
			$this->load->view('sitelayout/nav.php');
			$this->load->view('static_pages/consumers.php', $data);
			$this->load->view('sitelayout/footer.php');
			unset($_SESSION['rfq']);
		}
		else{
			?>
			<script>
				self.location = "<?php echo site_url("cs"); ?>";
			</script>
			<?php
		}
	}
	public function service_providers(){
		if(!$_SESSION['logistic_provider']['id']){
			$data['title_tag'] = "Consumer";
			$this->load->view('sitelayout/header.php', $data);
			$this->load->view('sitelayout/nav.php');
			$this->load->view('static_pages/service_providers.php', $data);
			$this->load->view('sitelayout/footer.php');
			unset($_SESSION['rfq']);
		}
		else{
			?>
			<script>
				self.location = "<?php echo site_url("lp"); ?>";
			</script>
			<?php
		}
	}
	public function contact(){
		$data['title_tag'] = "Consumer";
		$this->load->view('sitelayout/header.php', $data);
		$this->load->view('sitelayout/nav.php');
		//$this->load->view('static_pages/contact.php', $data);
		$this->load->view('static_pages/contact_.php', $data);
		$this->load->view('sitelayout/footer.php');
		unset($_SESSION['rfq']);
	}
	
}
