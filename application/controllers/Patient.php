<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

    private $doctor_id, $patient_id, $schedule_id, $type;

    public function __construct() {
        
        parent::__construct(array('index', 'my_records'), 'Patient');
        $this->load->model('stf');

    }

    public function index() {
        
        $this->data['doctors'] = $this->stf->select_users('Doctor');
        $this->data['patients'] = $this->stf->select_users('Patient', 'tblpatient');
        $this->data['schedules'] = $this->stf->select_doctor_schedules($this->data['doctors'][0]->id, true);

        $patient_id = $this->stf->select_users('', 'tblpatient', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->stf->select_appointments('', '<> "Cancelled" AND state <> "Declined" AND state <> "Archived"', '', $patient_id);

    }

    public function get_appointment_input() {

        $inputs = array('doctor', 'schedule', 'type');
        
        $inc = 0;
        foreach ($inputs as $input) {

            if ($this->input->post($inputs[$inc]) == '')
            return false;

            $inc++;

        }

        $this->doctor_id = $this->input->post("doctor");
        $this->patient_id = $this->stf->select_users('', 'tblpatient', '', $this->session->userid)[0]->id;
        $this->schedule_id = $this->input->post("schedule");
        $this->type = $this->input->post("type");

        return true;

    }

    public function add_appointment() {

        if ($this->get_appointment_input())
            $this->stf->insert_appointment($this->doctor_id, $this->patient_id, $this->schedule_id, $this->type);

        redirect(base_url() . $this->data['user']);

    }

    public function edit_appointment() {

        $id = $this->input->post("id");

        $this->doctor_id = $this->input->post("doctor");
        $this->patient_id = $this->stf->select_users('', 'tblpatient', '', $this->session->userid)[0]->id;
        $this->schedule_id = $this->input->post("schedule");
        $this->type = $this->input->post("type");
        
        $this->stf->update_appointment($id, $this->doctor_id, $this->patient_id, $this->schedule_id, $this->type);
        
            redirect(base_url() . $this->data['user']);

    }

    public function remove_appointment() {

        $id = $this->input->post("id2");
        
        $this->stf->delete_appointment($id);
        redirect(base_url() . $this->data['user']);

    }

    public function edit_status($id, $state) {

        $prev_url = $this->input->get('prev_url');

        $this->load->model("dctr");

        $this->dctr->update_appointment_status($id, $state);

        redirect($prev_url);
    }

    public function load_appointments() {
        
        $doctor_id = $this->input->get('doctor_id');

        $schedules = $this->stf->select_doctor_schedules($doctor_id, true);
        
        foreach ($schedules as $schedule) {
            echo '<label><input type="radio" name="schedule" value="' . $schedule->id . '"> ';        
                echo $schedule->date . ' ' . 
                date('h:i a', strtotime($schedule->start)) . ' ' .
                date('h:i a', strtotime($schedule->end));
            echo '</label>';
        }
    }

    public function my_records() {

        $this->load->model("stf");
        $patient_id = $this->stf->select_users('', 'tblpatient', '', $this->session->userid)[0]->id;

        $this->data['appointments'] = $this->stf->select_appointments('', '!= "Pending"', '', $patient_id);

    }

    public function logout() {

        session_destroy();
        redirect();

    }

}