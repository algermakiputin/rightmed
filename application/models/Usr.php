<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usr extends CI_model {
    
    function __construct() {
            
        parent::__construct();

    }

    function select_users($username, $password) {

        $this->db->select('id, username, password, usertype');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('tblaccount');

        return $query;

    }

}