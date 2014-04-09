<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class front extends CI_Controller {
	public function index(){
		//redirect(site_url("rfq")."/", "refresh");
		//$this->load->view('front/index.php');
		
		
		$this->load->view('sitelayout/header.php');
		$this->load->view('sitelayout/nav.php');
		//$content = $this->load->view('sitelayout/main.php', '', true);
		//$data['content'] = $content;
		//$this->load->view('sitelayout/container.php', $data);
		$this->load->view('sitelayout/main.php');
		$this->load->view('sitelayout/footer.php');
		//unset($_SESSION['rfq']);
		
		
	}
}
