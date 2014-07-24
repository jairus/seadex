<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cs_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    public function getRFQs() {
        
        $response = array();
        $date = (time() + (2 * 60 * 60 * 24));
        
        $sql = "SELECT * FROM `rfq` " .
            "WHERE `customer_id`='" . $_SESSION['customer']['id'] . "'  " .
            "AND `bid_id`=0 " .
            "AND UNIX_TIMESTAMP(STR_TO_DATE(`destination_date`,'%m/%d/%Y'))>" . $date . " " .
            "ORDER BY id DESC";
        $query = $this->db->query($sql);
        if($query->num_rows()) $response = $query->result_array();
        
        return $response;        
    }
}

/* End of file cs_model.php */
/* Location: /application/models/cs_model.php */