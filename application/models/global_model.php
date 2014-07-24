<?php defined('BASEPATH') or exit('No direct script access allowed');

class Global_model extends CI_Model {
    
    function __construct() {

        parent::__construct();        
    }
    
    public function getCompanies($fields = '*') {
        
        $response = array();
        $fields = trim($fields);
        if(! $fields) $fields = '*';
        
        $sql = "SELECT " . $fields . " FROM `companies`";
        $query = $this->db->query($sql);
        if($query->num_rows()) { $response = $query->result(); }
        
        return $response;
    }
    
    public function getCompanyByName($name, $fields = '*') {
        
        $response = array();
        
        $name = trim($name);
        if(! $name) return $response;
        
        $fields = trim($fields);
        if(! $fields) $fields = '*';
        
        $sql = "SELECT " . $fields . " FROM `companies` WHERE name=?";
        $query = $this->db->query($sql, array($name));
        if($query->num_rows()) { $response = $query->row(); }
        
        return $response;
    }
    
    public function getCompanyOfUser($user_type, $user_id) {
        
        $response = array();
        
        // Get the company details as well for this User.
        $sql = "SELECT c.* FROM `company_users` AS cu LEFT JOIN companies AS c ON cu.company_id=c.id WHERE cu.user_type=? AND cu.`user_id`=?";
        $query = $this->db->query($sql, array($user_type, $user_id));
        if($query->num_rows()) {

            $response = $query->row_array();
            unset($response['created']);
        }
        
        return $response;
    }
    
    public function doCompanySave($name) {
        
        $company = $this->getCompanyByName($name, 'id'); // Check if exists.
        if(! empty($company)) return $company->id; // Returns company id.
        
        $sql = "INSERT INTO `companies` SET name=?";
        $this->db->query($sql, array($name));
        
        return $this->db->insert_id(); // Returns company id.
    }
    
    /* @start: Get if User is under the specified Company.
     * 
     * @return boolean
     * */
    public function getCompanyUser($company_id, $user_id) {
        
        $sql = "SELECT id FROM `company_users` WHERE company_id=? AND user_id=?";
        $query = $this->db->query($sql, array($company_id, $user_id));
        
        return (($query->num_rows() > 0) ? true : false);
    }
    
    /* @start: Add User under the specified Company.
     * 
     * @return int
     * */
    public function doCompanyUserSave($company_id, $user_id, $user_type) {
        
        $sql = "INSERT INTO `company_users` SET company_id=?,user_id=?,user_type=?,created=NOW()";
        $this->db->query($sql, array($company_id, $user_id, $user_type));
        
        return $this->db->insert_id();
    }
    
    /* @start: Get all User IDs of the same Company by the currently logged User.
     * 
     * @return array
     * */
    public function getCompanyUserIDs($type, $implode = false) {
        
        $response = array();
        $company_id = (int) $_SESSION[$type]['company']['id'];
        
        if($company_id) {
            
            $sql = "SELECT user_id FROM company_users WHERE user_type=? AND company_id=?";
            $query = $this->db->query($sql, array($type, $company_id));
            if($query->num_rows()) {
                // Collect all Users under this Company.
                foreach($query->result() as $row) { $response[] = $row->user_id; }
            }
            
            // Worst case, but $user_ids will always contain the currently logged User's ID.
            if(empty($user_ids)) $response[] = $_SESSION[$type]['id'];
            
            if($implode) $response = implode(',', $response); 
        }
        
        return $response;
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
            
            if(in_array($type, $clp)) {
                
                $company = $this->getCompanyOfUser($type, $user['id']);
                if(! empty($company)) { $user = array_merge($user, array('company' => $company)); }
            }
            
            $response = $user;
        }
        
	return $response;
    }
    
    
}

/* End of file global_model.php */
/* Location: /application/models/global_model.php */