<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller {

    private $usern, $passw, $usert, $fname, $mname, $lname, $birthdate, $address, $contact, $email, $gender, $marital_status;
    private $user_id, $date, $start, $end;
    private $doctor_id, $patient_id, $schedule_id, $type;

    public function __construct() {
        
        parent::__construct(array('index', 'patients', 'doctor_schedule', 'appointments', 'archives', 'archives_details'), 'Staff');
        $this->load->model("stf");

    }

    public function index() {

        $this->data['users'] = $this->stf->select_users();
    }

    private function get_user_input() {


        
        $this->usern = $this->input->post("usern");
        $this->passw = $this->input->post("passw");
        $this->usert = $this->input->post("usertype");
        $this->fname = $this->input->post("fname");
		$this->mname = $this->input->post("mname");
        $this->lname = $this->input->post("lname");
        $this->birthdate = date('Y-m-d', strtotime($this->input->post("birthdate")));
		$this->age = $this->input->post("age");
        $this->address = $this->input->post("address");
        $this->contact = $this->input->post("contact");
        $this->email = $this->input->post("email");

    }


    public function add_user() {

        $this->get_user_input();

        $this->stf->insert_user($this->usern, $this->passw, $this->usert, $this->fname, $this->mname, $this->lname, $this->birthdate, $this->age, $this->address, $this->contact, $this->email);
        redirect(base_url() . $this->data['user']);

    }

    public function edit_user() {

        $id = $this->input->post("id");
        $this->get_user_input();

        $this->stf->update_user($id, $this->usern, $this->passw, $this->usert, $this->fname, $this->mname, $this->lname, $this->birthdate, $this->age, $this->address, $this->contact, $this->email);
        redirect(base_url() . $this->data['user']);

    }

    public function remove_user() {

        $id = $this->input->post("id2");

        $this->stf->delete_user($id);
        redirect(base_url() . $this->data['user'] . '/users');

    }

    public function patients() {   

        $search = $this->input->get('search');
        $this->data['patients'] = $this->stf->select_users('Patient', 'tblpatient', '', '', $search);

    }

    private function get_patient_input() {

        $this->usern = $this->input->post("usern");
        $this->passw = $this->input->post("passw");
        $this->usert = $this->input->post("usertype");
        $this->fname = $this->input->post("fname");
		$this->mname = $this->input->post("mname");
        $this->lname = $this->input->post("lname");
        $this->birthdate = date('Y-m-d', strtotime($this->input->post("birthdate")));
        $this->age = $this->input->post("age");
		$this->address = $this->input->post("address");
        $this->contact = $this->input->post("contact");
        $this->email = $this->input->post("email");
        $this->gender = $this->input->post("gender");
        $this->marital_status = $this->input->post("marital_status");

    }

    public function add_patient() {

        $this->get_patient_input();

        $this->stf->insert_patient($this->usern, $this->passw, $this->fname, $this->mname, $this->lname, $this->birthdate, $this->age, $this->address, $this->contact, $this->email, $this->gender, $this->marital_status);
        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function edit_patient() {

        $id = $this->input->post("id");
        
        $this->get_patient_input();

        $this->stf->update_patient($id, $this->usern, $this->passw, $this->fname, $this->mname, $this->lname, $this->birthdate, $this->age, $this->address, $this->contact, $this->email, $this->gender, $this->marital_status);
        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function remove_patient() {

        $id = $this->input->post("id2");

        $this->stf->delete_patient($id);
        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function doctor_schedule() {

        $this->data['doctors'] = $this->stf->select_users('Doctor');

        $schedules = array(array());

        $inc = 0;
        foreach ($this->data['doctors'] as $doctor) {
            $doctor_schedules = $this->stf->select_doctor_schedules($doctor->id);
            
            if (!empty($doctor_schedules)) {
                foreach ($doctor_schedules as $doctor_schedule) {
                    array_push($schedules[$inc], $doctor_schedule);
                    array_push($schedules, array());
                }
            }
            else
                array_push($schedules, array());

            $inc++;
        }

        $this->data['schedules'] = $schedules;

    }

    public function get_schedule_input() {

        $this->user_id = $this->input->post("doctor");
        $this->date = $this->input->post("date");
        $this->start = $this->input->post("start");
        $this->end = $this->input->post("end");

    }

    public function add_schedule() {

        $this->get_schedule_input();
        
        if (!$this->stf->insert_schedule($this->user_id, $this->date, $this->start, $this->end))
            redirect(base_url() . $this->data['user'] . '/doctor_schedule?error=1');
        else
            redirect(base_url() . $this->data['user'] . '/doctor_schedule');
    }

    public function edit_schedule() {

        $id = $this->input->post("id");
        $this->get_schedule_input();
        
        $this->stf->update_schedule($id, $this->user_id, $this->date, $this->start, $this->end);
        redirect(base_url() . $this->data['user'] . '/doctor_schedule');

    }

    public function remove_schedule() {

        $id = $this->input->post("id2");
        
        $this->stf->delete_schedule($id);
        redirect(base_url() . $this->data['user'] . '/doctor_schedule');

    }

    public function appointments() {
        
        $this->data['doctors'] = $this->stf->select_users('Doctor');
        $this->data['patients'] = $this->stf->select_users('Patient', 'tblpatient');
        $this->data['schedules'] = $this->stf->select_doctor_schedules($this->data['doctors'][0]->id, true);
        $this->data['appointments'] = $this->stf->select_appointments('', '<> "Cancelled" AND state <> "Declined" AND state <> "Archived"');

    }

    public function get_appointment_input() {

        $inputs = array('doctor', 'patient', 'schedule', 'type');
        
        $inc = 0;
        foreach ($inputs as $input) {

            if ($this->input->post($inputs[$inc]) == '')
            return false;

            $inc++;

        }

        $this->doctor_id = $this->input->post("doctor");
        $this->patient_id = $this->input->post("patient");
        $this->schedule_id = $this->input->post("schedule");
        $this->type = $this->input->post("type");

        return true;

    }

    public function add_appointment() {

        if ($this->get_appointment_input())
            $this->stf->insert_appointment($this->doctor_id, $this->patient_id, $this->schedule_id, $this->type);

        redirect(base_url() . $this->data['user'] . '/appointments');

    }

    public function edit_appointment() {

        $id = $this->input->post("id");

        $this->doctor_id = $this->input->post("doctor");
        $this->patient_id = $this->input->post("patient");
        $this->schedule_id = $this->input->post("schedule");
        $this->type = $this->input->post("type");
        
        $this->stf->update_appointment($id, $this->doctor_id, $this->patient_id, $this->schedule_id, $this->type);
        
            redirect(base_url() . $this->data['user'] . '/appointments');

    }

    public function remove_appointment() {

        $id = $this->input->post("id2");
        
        $this->stf->delete_appointment($id);
        redirect(base_url() . $this->data['user'] . '/appointments');

    }

    public function add_checkup() {

        $patient_id = $this->input->post('id');
		$height = $this->input->post('height');
        $weight = $this->input->post('weight');
        $temper = $this->input->post('temper');
        $bloodpres = $this->input->post('bloodpres');
		$symptoms = $this->input->post('symptoms');
        $prevmed = $this->input->post('prevmed');

        $checkup_id = $this->stf->select_checkup_id($patient_id);

        if ($checkup_id != '0')
            $this->stf->update_checkup($checkup_id, $height, $weight, $temper, $bloodpres, $symptoms, $prevmed);
        else {
            $this->stf->insert_checkup($height, $weight, $temper, $bloodpres, $symptoms, $prevmed, $patient_id);
        }

        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function archives() {

        $this->load->model("dctr");
        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->dctr->select_archives();

    }

    public function archives_details($patient_id) {

        $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
        $this->data['appointments'] = $this->stf->select_appointments('', '!= "Pending"', '', $patient_id);
        $this->data['patient_id'] = $patient_id;
        $this->data['patientfname'] = $this->data['appointments'][0]->patientfname;
		$this->data['patientmname'] = $this->data['appointments'][0]->patientmname;
        $this->data['patientlname'] = $this->data['appointments'][0]->patientlname;

    }

    public function edit_status($id, $state) {

        $prev_url = $this->input->get('prev_url');

        $this->load->model("dctr");

        $this->dctr->update_appointment_status($id, $state);

        redirect($prev_url);
    }

    public function medcert($id) {

        $this->load->model("stf");
        $this->data['appointments'] = $this->stf->select_appointments('', '', '', '', $id);

        $this->load->view('Doctor/medcert', $this->data);
        
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

    public function load_patientnames($search) {
        $patientnames = $this->stf->select_patientnames($search);
        
        foreach ($patientnames as $patientname) {
            echo "<option value='$patientname->id'>" . ucfirst($patientname->lname) . ',' . ucfirst($patientname->fname) . ' ' . ucfirst($patientname->mname) .'</option>';
        }
    }

    public function logout() {

        session_destroy();
        redirect();

    }

}