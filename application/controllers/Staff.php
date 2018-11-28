<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller {

    private $usern, $passw, $usert, $fname, $mname, $lname, $birthdate, $address, $contact, $email, $gender, $marital_status;
    private $user_id, $date, $start, $end;
    private $doctor_id, $patient_id, $schedule_id, $type;

    public function __construct() {
        require FCPATH.'/vendor/autoload.php';
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

    public function getCheckup() {

        $patient = $this->db->where('id', $this->input->post('id'))->get('tblpatient')->row()->checkup_id;
        $checkup = $this->db->where('id', $patient)->get('tblcheckup')->row();
        echo json_encode($checkup);

    }

    public function patientsDataTable() {
        
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $limit = $this->input->post('limit');
        $search = $this->input->post('search[value]');
        $gender = $this->input->post('columns[0][search][value]');
        $ageStart = $this->input->post('columns[1][search][value]');
        $ageEnd = $this->input->post('columns[2][search][value]');
        $address = $this->input->post('columns[3][search][value]');
        $measures = $this->input->post('columns[4][search][value]');
        $diagnoses = $this->input->post('columns[5][search][value]');
        if ($diagnoses){
            $patients = $this->db->select("*")
                                ->from('tblpatient')
                                ->join('tblappointment', 'tblappointment.patient_id = tblpatient.id')
                                ->like('findings', $diagnoses, 'BOTH')
                                ->get()
                                ->result();

          

        }else if ($measures) {
            $measures = json_decode(stripslashes($measures));
     
            $patients = $this->db->select('*')
                                    ->from('tblcheckup')
                                    ->join('tblpatient', 'tblpatient.checkup_id = tblcheckup.id')
                                    ->where('tblcheckup.height >=', (float)$measures->height->start)
                                    ->where('tblcheckup.height <=', (float)$measures->height->end)
                                    ->where('tblcheckup.weight >=', (float)$measures->weight->start)
                                    ->where('tblcheckup.weight <=', (float)$measures->weight->end)
                                    ->where('tblcheckup.temperature >=', (float)$measures->temperature->start)
                                    ->where('tblcheckup.temperature <=', (float)$measures->temperature->end)
                                    ->get()
                                    ->result();
             
        }
        else if ($search) {

            $patients = $this->db->select('*')
                                    ->from('tblpatient')
                                    ->join('tblperson', 'tblperson.id = tblpatient.person_id')
                                    ->like('CONCAT(tblperson.fname, " ", tblperson.lname)', $search, 'BOTH')
                                    ->get()
                                    ->result();

        }else if ($gender) {
            $patients = $this->db->where('gender', ucfirst($gender))
                                    ->get('tblpatient', $start, $limit)
                                    ->result();
        }else if($address){
            $patients = $this->db->select('*')
                                    ->from('tblpatient')
                                    ->join('tblperson', 'tblperson.id = tblpatient.person_id')
                                    ->like('tblperson.address', $address, 'BOTH')
                                    ->get()
                                    ->result();
        }else if ($ageStart && $ageEnd){
            $patients = $this->db->select('*')
                                    ->from('tblpatient')
                                    ->join('tblperson', 'tblperson.id = tblpatient.person_id')
                                    ->where('tblperson.age <=', $ageEnd)
                                    ->where('tblperson.age >=', $ageStart)
                                    ->get()
                                    ->result();

        }else 
            $patients = $this->db->get('tblpatient', $start, $limit)->result();
        
        $recordsTotal = count($patients);
        $datasets = [];
        foreach ($patients as $key => $patient) {
            $account = $this->db->where('id', $patient->account_id)->get('tblaccount')->row();
            $person = $this->db->where('id', $patient->person_id)->get('tblperson')->row();

            $datasets[] = [
                    $account->username,
                    $person->fname,
                    $person->mname,
                    $person->lname,
                    $person->contact,
                    $person->email,
                    '<div class="no-print">
                     <a class="checkup" href="#" data-row="'.$key.'" data-id="'.$patient->id.'" data-toggle="modal" data-target="#checkupmodal"> 
                            <i class="menu-icon fa fa-search"></i> Check up
                    </a>

                    <br />
                    <a class="edit" href="#" data-row="'.$key.'" data-id="'.$patient->id.'" data-toggle="modal" data-target="#addeditmodal"> 
                        <i class="menu-icon fa fa-edit"></i> Edit 
                    </a>

                    <br />
                    <a class="remove" href="#" data-row="'.$key.'" data-id="'.$patient->id.'" data-toggle="modal" data-target="#removemodal"> 
                        <i class="menu-icon fa fa-minus"></i> Remove 
                    </a>
                    </div>
                    ',
                    $person->birthdate
                ];

            
        }

        $data = [
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal,
                'data' => $datasets

            ];

        echo json_encode($data);
    }

    public function getPatientInfo() {
        $id = $this->input->post('id');
        $patient = $this->db->where('id', $id)->get('tblpatient')->row();
        $account = $this->db->where('id', $id)->get('tblaccount')->row();
        $person = $this->db->where('id', $id)->get('tblperson')->row();
        $data = [
                'username' => $account->username,
                'password' => $account->password,
                'fname' => $person->fname,
                'mname' => $person->mname,
                'lname' => $person->lname,
                'age' => $person->age,
                'address' => $person->age,
                'contact' => $person->contact,
                'email' => $person->email,
                'birthdate' => $person->birthdate,
                'marital_status' => $patient->marital_status,
                'gender' => $patient->gender
            ];

        echo json_encode($data);
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
        $account = [
                'username' => $this->input->post("usern"),
                'password' => $this->input->post("passw")
            ];
        $person = [
                'fname' => $this->input->post("fname"),
                'mname' => $this->input->post("mname"),
                'lname' => $this->input->post("lname"), 
                'birthdate' => date('Y-m-d', strtotime($this->input->post("birthdate"))),
                'age'   => $this->input->post("age"),
                'address'   =>  $this->input->post("address"),
                'contact'   => $this->input->post("contact"),
                'email' => $this->input->post("email")
            ];
        
        $patient = [
                'gender'    =>  $this->input->post("gender"),
                'marital_status'    =>  $this->input->post("marital_status"),
            ];
   
        
        $patient = $this->db->where('id', $this->input->post('edit-patient-id'))->get('tblpatient')->row();
       

        $this->db->where('id', $patient->account_id)->update('tblaccount', $account);
        $this->db->where('id', $patient->id)->update('tblpatient', $patient);
        $this->db->where('id', $patient->person_id)->update('tblperson', $person);

        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function remove_patient() {
       
        $id = $this->input->post("id-remove");
       
        $this->stf->delete_patient($id);
        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function doctor_schedule() {

        $this->data['doctors'] = $this->stf->select_users('Doctor');

        $schedules = [];

        $inc = 0;
        foreach ($this->data['doctors'] as $doctor) {
           
            $min = $this->db->select_min('id')
                                ->where('user_id', $doctor->id)
                                ->where('DATE_FORMAT(date, "%Y-%m-%d") = ', date('Y-m-') . ((int)date('d') + 1))
                                ->get('tblschedule')
                                ->row();
            $max = $this->db->select_max('id')
                                ->where('user_id', $doctor->id)
                                ->where('DATE_FORMAT(date, "%Y-%m-%d") = ', date('Y-m-') . ((int)date('d') + 1))
                                ->get('tblschedule')
                                ->row();

            $start = $this->db->where('id', $min->id)->get('tblschedule')->row();
            $end = $this->db->where('id', $max->id)->get('tblschedule')->row();
 
            $schedules[] = [
                    'fname' => $doctor->fname ?? '',
                    'lname' => $doctor->lname ?? '',
                    'mname' => $doctor->mname ?? '',
                    'id' => $doctor->id ?? '',
                    'date' =>   $start->date ?? '',
                    'start' => $start->start ?? '',
                    'end' => $end->end ?? ''
                ];
            
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
        
        $doctor_id = $this->input->post('doctor');
        $date = $this->input->post('date');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        
        $scheduleExist = $this->db->where('user_id', $doctor_id)
                                    ->where('date', $date)
                                    ->delete('tblschedule');
                                


        $start = Carbon\Carbon::parse($start);
        $end = Carbon\Carbon::parse($end);
        $datasets = [];
        for ($i = $start; $i->lessThan($end); $i->addMinutes(20)) {
            $time = $i;

            $startTime = $time->format('h:i a');
            $datasets[] = [
                'user_id' => $doctor_id,
                'date' => $date,
                'start' => $startTime,
                'end' => Carbon\Carbon::parse($startTime)->addMinutes(20)->format('h:i a')
            ];
     
        }
        
        $this->db->insert_batch('tblschedule', $datasets);
        redirect(base_url() . $this->data['user'] . '/doctor_schedule');
    }

    public function edit_schedule() {
       

        $doctor_id = $this->input->post('id');
        $date = $this->input->post('date');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $this->db->where('user_id', $doctor_id)
                    ->where('date', $date)
                    ->delete('tblschedule');
         
        $start = Carbon\Carbon::parse($start);
        $end = Carbon\Carbon::parse($end);
        $datasets = [];
        for ($i = $start; $i->lessThan($end); $i->addMinutes(20)) {
            $time = $i;

            $startTime = $time->format('h:i a');
            $datasets[] = [
                'user_id' => $doctor_id,
                'date' => $date,
                'start' => $startTime,
                'end' => Carbon\Carbon::parse($startTime)->addMinutes(20)->format('h:i a')
            ];
     
        }
        
        $this->db->insert_batch('tblschedule', $datasets);

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

    public function getDoctorSchedule() {
        $date = date('Y-m-d');
        $appointments = $this->db->select("schedule_id")
                                ->from('tblappointment')
                                ->where('doctor_id', $this->input->post('id'))
                                ->where('DATE_FORMAT(tblappointment.created_at, "%Y-%m-%d") =', $date)
                                ->get()
                                ->result();

        $datasets = [];
     
        $schedule = $this->db->where('date', $date)
                            ->where('user_id', $this->input->post('id'))
          
                            ->order_by('id', 'DESC')
                            ->get('tblschedule')
                            ->result();
        $currentTime = Carbon\Carbon::parse(Date('h:i a'));

        foreach($schedule as $key => $sched) {

            if ($currentTime->gt(Carbon\Carbon::parse($sched->start))) {
                unset($schedule[$key]);
                continue;
            }
            if (count($appointments)) {

                foreach($appointments as $appointment) {
                    if ($appointment->schedule_id == $sched->id) {
                        unset($schedule[$key]);
                        continue;
                    } 

                }
            }
            continue;
            
        
        }
        echo json_encode($schedule);
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

        $patient_id = $this->input->post('patient');
		$height = (float)$this->input->post('height');
        $weight = (float)$this->input->post('weight');
        $temper = (float)$this->input->post('temper');
        $bloodpres = $this->input->post('bloodpres');
		$symptoms = $this->input->post('symptoms');
        $prevmed = $this->input->post('prevmed');
      
        $checkup_id = $this->db->where('id', $patient_id)->get('tblpatient')->row()->checkup_id;
 
        if ($checkup_id != 0)
            $this->stf->update_checkup($checkup_id, $height, $weight, $temper, $bloodpres, $symptoms, $prevmed);
        else {
            $this->stf->insert_checkup($height, $weight, $temper, $bloodpres, $symptoms, $prevmed, $patient_id);
        }

        redirect(base_url() . $this->data['user'] . '/patients');

    }

    public function archives() {

        $this->load->model("dctr");
        // $doctor_id = $this->stf->select_users('', 'tbluser', '', $this->session->userid)[0]->id;
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