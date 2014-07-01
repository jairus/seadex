<?php defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    public function save_contact_views($input, $viewed_by) {
        
        if(empty($input)) return;
        
        extract($input);
        
        $rfq = $this->getRFQ($rfq_id);
        if(! empty($rfq)) {
            
            $sql = "INSERT INTO contact_views SET user_id=?,viewed_by=?,rfq_id=?,created=NOW()";
            $this->db->query($sql, array($rfq->customer_id, $viewed_by, $rfq_id));
        }
    }
    
    private function getRFQ($rfq_id) {
        
        if(($rfq_id = (int) $rfq_id) == 0) return;
        
        $response = array();
        
        $sql = "SELECT * FROM rfq WHERE id=?";
        $query = $this->db->query($sql, array($rfq_id));
        if($query->num_rows()) $response = $query->row();

        return $response;
    }
}

/* End of file activity_model.php */
/* Location: /application/models/activity_model.php */