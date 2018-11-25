<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medtech extends MY_Controller {

    public function __construct() {
        
        parent::__construct(array('index', 'pending_requests'), 'Medtech');
        $this->load->model("mdtech");

    }

    public function index() {

        $this->load->model("stf");
        $this->data['appointments'] = $this->stf->select_appointments('', '<> "Cancelled" AND state <> "Declined" AND state <> "Done"', '1');

    }

    public function add_medical($id) {

        $appointment_id = $id;
        $medinfo = "Medtech Accepted";

        $this->mdtech->insert_medical($appointment_id, $this->session->userid, $medinfo);
        redirect(base_url() . $this->usertype);

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
			
			<p>Age ' . $patient[0]->age . '</p>
        
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