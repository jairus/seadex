<?php defined('BASEPATH') or exit('No direct script access allowed');

class Global_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    /* $email       = User's email.
     * $password    = User's password.
     * $type        = Type of User. Consumer / Logistic Provider (consumer | logistic_provider)
     * 
     * @return      array
     * */
    public function doLogin($email, $password, $type) {
        
        $response = array();
        
        $clp = array('customer', 'logistic_provider');
        
        $sql = "SELECT * FROM `" . $type . "s` WHERE `email`=? AND `password`=?";
        if($type == 'logistic_provider') $sql .= " AND `active`=1"; // Special case for this Type of User.
        
        $query = $this->db->query($sql, array($email, md5($password)));
        
        if($query->num_rows()) {
            
            $user = $query->row_array();
            
            if($type == 'logistic_provider') { // Specifically for LPs only.
                
                $this->load->model('lp_model', '', true);
                $company = $this->lp_model->getCompanyOfUser($user['id']);
                
                if(! empty($company)) { $user = array_merge($user, array('company' => $company)); }
            }
            
            $response = $user;
        }
        
	return $response;
    }    
}

/* End of file global_model.php */
/* Location: /application/models/global_model.php */