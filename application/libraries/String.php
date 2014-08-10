<?php
/*
 * Title        : STRING Library Class
 * Author       : Armande Bayanes (tuso@programmerspride.com)
 * Description  : String formatting and Input validation functions.
 **/

Class String {
    
    public function is_email($string) {
        
        $string = trim($string);
        return preg_match("/^([a-zA-Z0-9\-\._]+)@(([a-zA-Z0-9\-_]+\.)+)([a-z]{2,3})$/", $string);
    }
}

/* End of file String.php */
/* Location: ./application/libraries/String.php */