<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lp_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    /* @start: Get all rates from Users of the same Company.
     * 
     * @return  array
     * */
    public function getRates() {
        
        $response = array();
        
        $this->load->model('global_model', '', true);
        $user_ids = $this->global_model->getCompanyUserIDs('logistic_provider', true);

        $sql = "SELECT * FROM `rates` WHERE " .
            "`logistic_provider_id` IN(" . $user_ids . ") " .
            "ORDER BY `id` DESC";
        
        $query = $this->db->query($sql);
        if($query->num_rows()) { $response = $query->result_array(); }
        
        return $response;
    }
    
    /* @start: Update User account.
     * 
     * @return  [none]
     * */
    public function doAccountUpdate($user_id, $data) {
        
        if(empty($data) || ! $user_id) return;
        
        array_walk($data, function(&$value, &$key) {
            $value = trim($value);
        }); extract($data);
        
        $sql = "UPDATE `logistic_providers` SET `name`=?,`homepage`=?,`contact`=?,`services`=?,`others`=? WHERE `id`=?";
        $this->db->query($sql, array($name, $homepage, $contact, $services, $others, $user_id));
	
        $orig_value = $_SESSION['logistic_provider'];
        
        // Reset session values due to any changes.
        $_SESSION['logistic_provider'] = array_merge($orig_value, $data);        
    }
}

/* End of file lp_model.php */
/* Location: /application/models/lp_model.php */