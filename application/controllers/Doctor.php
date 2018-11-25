<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends MY_Controller {

    public function __construct() {
        
        parent::__construct(array('index', 'my_patients', 'archives', 'archives_details', 'reports'), 'Doctor');
        $this->load->model('dctr');

    }

    public function index() {

        $this->load->model("stf");

        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->stf->select_appointments($doctor_id, '= "Pending"');

    }

    public function edit_status($id, $state) {

        $prev_url = $this->input->get('prev_url');

        $this->dctr->update_appointment_status($id, $state);

        redirect($prev_url);
    }

    public function my_patients() {

        $this->load->model("stf");
        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->stf->select_appointments($doctor_id, '= "Accepted"');

    }

    public function req_medical($id) {

        $prev_url = $this->input->get('prev_url');

        $this->dctr->update_appointment_reqmedical($id);

        redirect($prev_url);
    }

    public function add_findings() {

        $appointment_id = $this->input->post('id');
        $findings = $this->input->post('findings');

        $this->dctr->insert_findings($appointment_id, $findings);
        redirect(base_url() . $this->usertype . '/my_patients');

    }

    public function archives() {

        $this->load->model("stf");
        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->dctr->select_archives();

    }

    public function archives_details($patient_id) {

        $this->load->model("stf");
        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->stf->select_appointments('', '!= "Pending"', '', $patient_id, '', false);
        $this->data['patient_id'] = $patient_id;
        $this->data['patientfname'] = $this->data['appointments'][0]->patientfname;
		$this->data['patientmname'] = $this->data['appointments'][0]->patientmname;
        $this->data['patientlname'] = $this->data['appointments'][0]->patientlname;

    }

    public function medcert($id) {

        $this->load->model("stf");
        $this->data['appointments'] = $this->stf->select_appointments('', '', '', '', $id);

        $this->load->view('Doctor/medcert', $this->data);
        
    }

    public function load_patientinfo($patient_id) {

        $this->load->model("stf");
        $patient = $this->stf->select_users('Patient', 'tblpatient', $patient_id);

        echo '
            <h1>Check-up Info</h1> <br />

            <p>Height: ' . $patient[0]->height . '</p>

            <p>Weight: ' . $patient[0]->weight . '</p>

            <p>Temperature: ' . $patient[0]->temperature . '</p>

            <p>Blood Pressure: ' . $patient[0]->blood_pressure . '</p>

			<p>Symptoms: ' . $patient[0]->symptoms . '</p>

            <p>Patient History: ' . $patient[0]->prevmed . '</p>


            <h1>Basic Info</h1> <br />
        
            <p>First name: ' . ucfirst($patient[0]->fname) . '</p>
			
            <p>Middle name: ' . ucfirst($patient[0]->mname) . '</p>

            <p>Last name: ' . ucfirst($patient[0]->lname) . '</p>
        
            <p>Gender: ' . $patient[0]->gender . '</p>
        
            <p>Birthdate: ' . $patient[0]->birthdate . '</p>
			
			<p>Age: ' . $patient[0]->age . '</p>
        
            <p>Marital Status: ' . $patient[0]->marital_status . '</p>     
        
            <p>Address: ' . $patient[0]->address . '</p>
        
            <p>Contact: ' . $patient[0]->contact . '</p> 
        
            <p>Email Address: ' . $patient[0]->email . '</p>

        ';

    }

    public function logout() {

        session_destroy();
        redirect();

    }

}