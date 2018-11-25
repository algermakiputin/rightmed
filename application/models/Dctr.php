<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dctr extends CI_model {
    
    function __construct() {
            
        parent::__construct();

    }

    function update_appointment_status($id, $state) {

        $appointment = array(
            'state' => $state
        );

        $this->db->where('id', $id);
        $this->db->update('tblappointment', $appointment);

    }

    function update_appointment_reqmedical($id) {

        $appointment = array(
            'req_medical' => '1'
        );

        $this->db->where('id', $id);
        $this->db->update('tblappointment', $appointment);

    }

    function insert_findings($appointment_id, $findings) {

        $appointment = array(
            'findings' => $findings
        );

        $this->db->where('id', $appointment_id);
        $this->db->update('tblappointment', $appointment);

    }

    function select_archives() {

        $this->db->select('tblpatient.id, fname, mname, lname, date, state');
        $this->db->from('tblpatient');
        $this->db->join('tblperson', 'tblperson.id = tblpatient.person_id');
        $this->db->join('(SELECT patient_id, doctor_id, max(date) as date, state FROM tblschedule JOIN tblappointment ON tblappointment.schedule_id = tblschedule.id AND tblappointment.state != "Pending" GROUP BY patient_id) c2', 'c2.patient_id = tblpatient.id');

        $this->db->order_by('date', 'desc');

        $query = $this->db->get();

        return $query->result();

    }

}