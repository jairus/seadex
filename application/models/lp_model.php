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
        
        $user_ids = $this->getCompanyUserIDs(true);

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
    
    /* @start: Get all Accepted bids for Users under the Same company.
     * 
     * $type
     *      my  = My Bids
     *      co  = Company Bids
     *      a   = Accepted Bids
     * 
     * @return  array
     * */
    public function getBids($type) {
        
        $response = array();
        
        $types = array('my', 'co', 'a');
        if(! in_array($type, $types)) return $response;
        
        if($type != 'my') {
            
            $company_users = $this->getCompanyUserIDs(true);
        }
        
        // Default value for $sql_append when 'co'.
        $sql_append = "WHERE `logistic_provider_id` IN(" . $company_users . ") ";
        
        if($type == 'my') {
            
            // Replace $sql_append when 'my'.
            $sql_append = "WHERE `logistic_provider_id`=" . $this->user_id . " ";
            
        } elseif($type == 'a') {
            
            // Append to $sql_append when 'a'.
            $sql_append .= "AND `id` IN(SELECT `bid_id` FROM `rfq` WHERE `logistic_provider_id` IN(" . $company_users . ")) ";
        }
        
        $sql =
        "SELECT " . 
            "`id`," .
            "`rfq_id`," .
            "`total_bid_currency`," .
            "`total_bid`," .
            "`origin_country`," .
            "`origin_city`," .
            "`origin_port`," .
            "`destination_country`," .
            "`destination_city`," .
            "`destination_port`," .
            "`total_bid_usd`," .
            "`dateadded`" .
        "FROM `bids` " .
        $sql_append .
	"ORDER BY `id` " .
        "DESC";
        
        $query = $this->db->query($sql);
        if($query->num_rows()) $response = $query->result_array();
        
        return $response;
    }
    
    /* @start: Get all Users for a specific company.
     * 
     * @return  array
     * */
    public function getCompanyUsers($company_id) {
        
        $response = array();

        $sql = "SELECT lp.id,lp.name,lp.email,cu.approved FROM logistic_providers AS lp LEFT JOIN company_users AS cu ON lp.id=cu.user_id WHERE cu.company_id=? AND cu.user_id!=?";
        $query = $this->db->query($sql, array($company_id, $this->user_id));
        
        if($query->num_rows()) $response = $query->result();
        
        return $response;
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
        if($query->num_rows()) $response = $query->row();
        
        return $response;
    }
    
    public function getCompanyOfUser($user_id) {
        
        $response = array();
        
        // Get the company details as well for this User.
        $sql = "SELECT c.*,cu.approved FROM `company_users` AS cu LEFT JOIN companies AS c ON cu.company_id=c.id WHERE cu.`user_id`=?";
        $query = $this->db->query($sql, array($user_id));
        if($query->num_rows()) {

            $response = $query->row_array();
            unset($response['created']);
        }
        
        return $response;
    }
    
    public function doCompanySave($user_id, $name, $main_account = false) {
        
        $new = false;
        
        $company = $this->getCompanyByName($name, 'id,user_id'); // Check if exists.
        if(! empty($company)) {
            
            if($main_account) { // If main User account then can update the Company details.
                
                $details = $this->input->post();
                extract($details); // Create variables from POST.
                
                if($switch == 0) { // If not just switching to a Company.
                    $sql = "UPDATE `companies` SET name=?,website=?,address=?,telephone=?,fax=? WHERE id=?";
                    $this->db->query($sql, array($name, $website, $address, $telephone, $fax, $company->id));
                }
            }
            
            $id = $company->id; // Returns company id.
            $created_by = $company->user_id;
            
            // Special case, when User the creator of the Company.
            if($created_by == $user_id) {
                $new = true;
            }
            
        } else {
            
            $new = true;
            $sql = "INSERT INTO `companies` SET name=?,user_id=?,created=NOW()";
            $this->db->query($sql, array($name, $user_id));
            
            $id = $this->db->insert_id();
            $created_by = $user_id;
        }
        
        if($new) {
            
            // Sets User as the main account for this new Company he / she just added.
            $this->db->query("UPDATE `logistic_providers` SET main=1 WHERE id=?", array($user_id));
            // Update session as well.
            $_SESSION['logistic_provider']['main'] = 1;
        }

        return array($id, $created_by); // Returns company id and creator id.
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
    
    public function doCompanyUserAdd($data) {
        
        if(empty($data)) return;
        extract($data);
        
        $response = array();
        
        $user = $this->getIfEmail($user_email, 'id,name');
        $company_id = (int) $_SESSION['logistic_provider']['company']['id'];
        
        if(empty($user)) {
            
            $sql = "INSERT INTO `logistic_providers` " .
                "SET `name`=?," .
                    "`email`=?," .
                    "`password`=?," .
                    "`dateadded`=NOW()";
            $this->db->query($sql, array($user_name, $user_email, md5($user_password)));
            if(($id = $this->db->insert_id()) > 0) {
                
                $sql = "INSERT INTO `company_users` SET company_id=?,user_id=?,approved=1,created=NOW()";
                $this->db->query($sql, array($company_id, $id));
            }
            
        } else {
            
            if($this->getCompanyUser($company_id, $user->id)) {
                
                $response['error'] = 'This User already added to this Company.';
                
            } else {
            
                $len = strlen($user->name);
                if($len > 3) {

                    $newname = substr($user->name, 0, ($len - 3)) . '***';
                }

                $response['error_type'] = 'confirmation';
                $response['error'] = 'This email already exists for <b>' . $newname . '</b>.<br />Are you sure this is the person you want to add?';
                $response['user_id'] = $user->id;
            }
        }
        
        return $response;
    }
    
    public function doCompanyUserApprove($user_id) {
        
        $user_id = (int) $user_id;
        if(! $user_id) return;
        
        $company_id = (int) $_SESSION['logistic_provider']['company']['id'];
        
        $sql = "UPDATE company_users SET approved=1 WHERE company_id=? AND user_id=?";
        $this->db->query($sql, array($company_id, $user_id));        
    }
    
    public function doCompanyUserConfirm($user_id) {
        
        $user_id = (int) trim($user_id);
        if(! $user_id) return;
        
        $company_id = (int) $_SESSION['logistic_provider']['company']['id'];
        
        if(! $this->getCompanyUser($company_id, $user_id)) {
            
            $sql = "INSERT INTO company_users SET company_id=?,user_id=?,approved=1,created=NOW()";
            $this->db->query($sql, array($company_id, $user_id));
        }
    }
    
    /* @start: Add User under the specified Company.
     * 
     * @return int
     * */
    public function doCompanyUserSave($company_detail, $user_id, $main_account = false) {
        
        list($company_id, $created_by) = $company_detail;
        
        // If User was set to a Company before.
        $sql = "SELECT id,company_id FROM `company_users` WHERE user_id=?";
        $query = $this->db->query($sql, array($user_id));
        
        $approved = (int) ($created_by == $user_id);
        
        // When currently logged-in.
        if(isset($_SESSION['logistic_provider']) && ! empty($_SESSION['logistic_provider'])) {
            $_SESSION['logistic_provider']['company']['approved'] = $approved;
        }
        
        if($query->num_rows()) { // Then, just Update.
            
            $id = $query->row()->id;
            
            $sql = "UPDATE `company_users` SET company_id=?,approved=? WHERE id=?";
            $this->db->query($sql, array($company_id, $approved, $id));
            
            // @start: Loose from being a main account every time assigned to a new Company (if and only if he/she's not the creator of that Company).
            if($main_account && $created_by != $user_id) {

                $this->db->query("UPDATE `logistic_providers` SET main=0 WHERE id=?", array($user_id));
                // Update session as well.
                $_SESSION['logistic_provider']['main'] = 0;
            
            } // @end.
            
        } else { // Else, insert.
            
            $sql = "INSERT INTO `company_users` SET company_id=?,user_id=?,approved=?,created=NOW()";
            $this->db->query($sql, array($company_id, $user_id, $approved));
            $id = $this->db->insert_id();
        }
        
        return $id;
    }
    
    public function doCompanyOfUserUpdate($company_id) {
        
        // Update the company details in the User session.
        $sql = "SELECT * FROM companies WHERE id=?";
        $query = $this->db->query($sql, array($company_id));
        if($query->num_rows()) {
            
            $co = $query->row_array();
            unset($co['created']);
            $_SESSION['logistic_provider']['company'] = array_merge($_SESSION['logistic_provider']['company'], $co);
            
        } else {
            
            // Worst case because $query will always have a value.            
            unset($_SESSION['logistic_provider']['company']);
        }
    }
    
    /* @start: Get all User IDs of the same Company by the currently logged User.
     * 
     * @return array
     * */
    public function getCompanyUserIDs($implode = false) {
        
        $response = array();
        $company_id = (int) $_SESSION['logistic_provider']['company']['id'];
        $approved = (int) $_SESSION['logistic_provider']['company']['approved'];
        
        if($company_id && $approved) { // If User approved to be in this Company.
            
            $sql = "SELECT user_id FROM company_users WHERE company_id=?";
            $query = $this->db->query($sql, array($company_id));
            if($query->num_rows()) {
                // Collect all Users under this Company.
                foreach($query->result() as $row) { $response[] = $row->user_id; }
            }            
        }
        
        // Will always contain the currently logged User's ID.
        if(! in_array($_SESSION['logistic_provider']['id'], $response)) {
            
            $response[] = $_SESSION['logistic_provider']['id'];
        }
        
        if($implode) $response = implode(',', $response); 
        
        return $response;
    }
    
    public function getIfEmail($email, $fields = '*') {
        
        $fields = trim($fields);
        if(! $fields) $fields = 'id';
        
        $response = array();
        
        $sql = "SELECT " . $fields . " FROM `logistic_providers` WHERE email=?";
        $query = $this->db->query($sql, array($email));
        
        if($query->num_rows()) $response = $query->row();
        
        return $response;
    }
}

/* End of file lp_model.php */
/* Location: /application/models/lp_model.php */