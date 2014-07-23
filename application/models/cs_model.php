<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cs_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    public function getRFQs() {
        
        /* $sql = "select * from `rfq` where 
		`customer_id`='".$_SESSION['customer']['id']."' 
		and `bid_id`=0
		and UNIX_TIMESTAMP(STR_TO_DATE(`destination_date`,'%m/%d/%Y'))> ".(time()+(2*60*60*24))."
		order by id desc";
         */
        
        $sql = "SELECT * FROM `rfq` WHERE `customer_id`='".$_SESSION['customer']['id']."' 
        and `bid_id`=0
        and UNIX_TIMESTAMP(STR_TO_DATE(`destination_date`,'%m/%d/%Y'))> ".(time()+(2*60*60*24))."
        order by id desc";
        $q = $this->db->query($sql);
        $rfqs = $q->result_array();
    }
    
    public function doLogin($email, $password) {
        
        $response = array();
        
        $sql = "SELECT * FROM `customers` WHERE `email`=? AND `password`=?";
        $query = $this->db->query($sql, array($email, md5($password)));
        
        if($query->num_rows()) {
            
            $user = $query->row_array();
            
            // Get the company id as well for this User.
            $sql = "SELECT c.* FROM `company_users` AS cu LEFT JOIN companies AS c ON cu.company_id=c.id WHERE cu.user_type='consumer' AND cu.`user_id`=?";
            $query = $this->db->query($sql, array($user['id']));
            if($query->num_rows()) {
                
                $company = $query->row_array();
                unset($company['created']);
                $user = array_merge($user, array('company' => $company));
            }
            
            $response = $user;
        }
        
	return $response;
    }
}

/* End of file cs_model.php */
/* Location: /application/models/cs_model.php */