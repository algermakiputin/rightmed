<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdtech extends CI_model {
    
    function __construct() {
            
        parent::__construct();

    }

    function insert_medical($appointment_id, $medtech_id, $medinfo) {

        $appointment = array(
            'medtech_id' => $medtech_id,
            'medinfo' => $medinfo
        );

        $this->db->where('id', $appointment_id);
        $this->db->update('tblappointment', $appointment);

    }

}