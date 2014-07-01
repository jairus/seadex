<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class activity extends CI_Controller {
    
    private $model;
    
    function __construct() {

        parent::__construct();
        
        $this->load->model('activity_model', '', true);
        $this->model = $this->activity_model;
    }
    
    public function async_contact_views() {
        
        $user = $_SESSION['logistic_provider']; // Only this User has this feature.
        $p = $this->input->post();
        
        if(! empty($user) && ! empty($p)) $this->model->save_contact_views($p, $user['id']);

        exit;
    }
}

/* End of file activity.php */
/* Location: ./application/controllers/activity.php */