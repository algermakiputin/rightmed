<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stf extends CI_model {
    
    function __construct() {
            
        parent::__construct();

    }

    function select_account_id($user_id, $table='tbluser') {
        $this->db->select('account_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get($table);

        return $query->row()->account_id;
    }

    function select_person_id($user_id, $table='tbluser') {
        $this->db->select('person_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get($table);

        return $query->row()->person_id;
    }

    function select_checkup_id($patient_id) {
        $this->db->select('checkup_id');
        $this->db->where('id', $patient_id);
        $query = $this->db->get('tblpatient');

        return $query->row()->checkup_id;
    }

    function select_users($usertype='', $table='tbluser', $id='', $account_id='', $search = '') {
        $query =  $table . '.id, username, usertype, fname, mname, lname, contact, email, password, birthdate, age, address';

        if ($table != 'tbluser') {
            $query .= ', gender, marital_status, height, weight, temperature, blood_pressure, symptoms, prevmed';
        }

        $this->db->select($query);        
        $this->db->order_by('usertype');
        $this->db->order_by('username');
        $this->db->from($table);
        $this->db->join('tblaccount', 'tblaccount.id = ' . $table . '.account_id');
        $this->db->join('tblperson', 'tblperson.id = ' . $table . '.person_id');

        if ($table != 'tbluser') {
            $this->db->join('tblcheckup', 'tblcheckup.id = ' . $table . '.checkup_id', 'left');
        }

        $this->db->like('usertype', $usertype);

        if ($search != '') {
            $this->db->where("fname LIKE '%" . $search . "%'");
            $this->db->or_where("lname LIKE '%" . $search . "%'");
        }
        
        if ($id != '')
            $this->db->where($table . '.id', $id);

        if ($account_id != '') {
            $this->db->where($table . '.account_id', $account_id);
        }

        $query = $this->db->get();

        return $query->result();

    }

    function insert_account($usern, $passw, $usertype) {

        $account = array(
            'username' => $usern,
            'password' => $passw,
            'usertype' => $usertype
        );

        return $this->db->insert('tblaccount', $account);

    }

    function insert_person($fname, $mname, $lname, $birthdate, $age, $address, $contact, $email) {

        $person = array(
            'fname' => $fname,
			'mname' => $mname,
            'lname' => $lname,
            'birthdate' => $birthdate,
			'age'=> $age,
            'address' => $address,
            'contact' => $contact,
            'email' => $email
        );

        return $this->db->insert('tblperson', $person);

    }

    function insert_user($usern, $passw, $usertype, $fname, $mname, $lname, $birthdate, $age, $address, $contact, $email) {

        $this->db->trans_start();

        $this->insert_account($usern, $passw, $usertype);
        $account_id = $this->db->insert_id();

        $this->insert_person($fname, $mname, $lname, $birthdate, $age, $address, $contact, $email);
        $person_id = $this->db->insert_id();

        $user = array(
            'account_id' => $account_id,
            'person_id' => $person_id
        );

        $this->db->insert('tbluser', $user);

        $this->db->trans_complete();

    }

    function update_user($id, $usern, $passw, $usertype, $fname, $mname, $lname, $birthdate, $age, $address, $contact, $email) {

        $account = array(
            'id' => $this->select_account_id($id),
            'username' => $usern,
            'password' => $passw,
            'usertype' => $usertype
        );
        
        $this->db->replace('tblaccount', $account);

        $person = array(
            'id' => $this->select_person_id($id),
            'fname' => $fname,
			'mname' => $mname,
            'lname' => $lname,
            'birthdate' => $birthdate,
			'age'=> $age,
            'address' => $address,
            'contact' => $contact,
            'email' => $email
        );
        
        $this->db->replace('tblperson', $person);
    }

    function delete_user($id) {

        $this->db->trans_start();

        $this->db->delete('tblaccount', array('id' => $this->select_account_id($id)));
        $this->db->delete('tblperson', array('id' => $this->select_person_id($id)));
        $this->db->delete('tbluser', array('id' => $id));

        $this->db->trans_complete();

    }

    function insert_patient($usern, $passw, $fname, $mname, $lname, $birthdate, $age, $address, $contact, $email, $gender, $marital_status) {

        $this->db->trans_start();

        $this->insert_account($usern, $passw, 'Patient');
        $account_id = $this->db->insert_id();

        $this->insert_person($fname, $mname, $lname, $birthdate, $age, $address, $contact, $email);
        
        $person_id = $this->db->insert_id();

        $patient = array(
            'account_id' => $account_id,
            'person_id' => $person_id,
            'gender' => $gender,
            'marital_status' => $marital_status
        );

        $this->db->insert('tblpatient', $patient);

        $this->db->trans_complete();

    }

    function update_patient($id, $usern, $passw, $fname, $mname, $lname, $birthdate, $age, $address, $contact, $email, $gender, $marital_status) {

        $account = array(
            'id' => $this->select_account_id($id, 'tblpatient'),
            'username' => $usern,
            'password' => $passw,
            'usertype' => 'Patient'
        );
        
        $this->db->replace('tblaccount', $account);

        $person = array(
            'id' => $this->select_person_id($id, 'tblpatient'),
            'fname' => $fname,
			'mname'=> $mname,
            'lname' => $lname,
            'birthdate' => $birthdate,
            'address' => $address,
			'age' => $age,
            'contact' => $contact,
            'email' => $email
        );
        
        $this->db->replace('tblperson', $person);

        $patient = array(
            'id' => $id,
            'account_id' => $this->select_account_id($id, 'tblpatient'),
            'person_id' => $this->select_person_id($id, 'tblpatient'),
            'gender' => $gender,
            'marital_status' => $marital_status
        ); 

        $this->db->replace('tblpatient', $patient);
    }

    function delete_patient($id) {

        $this->db->trans_start();
        $this->db->delete('tblaccount', array('id' => $this->select_account_id($id, 'tblpatient')));
        $this->db->delete('tblperson', array('id' => $this->select_person_id($id, 'tblpatient')));
        $this->db->delete('tblpatient', array('id' => $this->select_account_id($id, 'tblpatient')));

        $this->db->trans_complete();

    }

    function select_doctor_schedules($user_id='', $unavailable = false) {

        $this->db->select('id, date, start, end');
        $this->db->order_by('date');
        $this->db->order_by('start');
        $this->db->from('tblschedule as schedules');

        if ($user_id != '')
            $this->db->where('user_id', $user_id);

        $this->db->where("UNIX_TIMESTAMP(CONCAT(date, ' ', start)) >= UNIX_TIMESTAMP('" . date('Y-m-d') . " " . date('H:i') . "')");


        if ($unavailable) {
            $this->db->where('id NOT IN(SELECT schedule_id FROM tblappointment)');
        }

        $query = $this->db->get();

        return $query->result();

    }

    function insert_schedule($user_id, $date, $start, $end) {

        $schedule = array(
            'user_id' => $user_id,
            'date' => $date,
            'start' => $start,
            'end' => $end
        );

        if (!$this->db->insert('tblschedule', $schedule))
            return false;
        else
            return true;

    }

    function update_schedule($id, $user_id, $date, $start, $end) {

        $schedule = array(
            'id' => $id,
            'user_id' => $user_id,
            'date' => $date,
            'start' => $start,
            'end' => $end
        );

        $this->db->replace('tblschedule', $schedule);

    }

    function delete_schedule($id) {

        $this->db->delete('tblschedule', array('id' => $id));

    }

    function select_appointments($userid = '', $state = '', $req_medical = '', $patient_id = '', $id = '', $type=true) {

        $this->db->select('tblappointment.id, doctor_id, patient_id, schedule_id, state, req_medical, medinfo, findings, type,
            (SELECT fname FROM tblperson JOIN tbluser ON tbluser.person_id = tblperson.id WHERE tbluser.id = doctor_id) as doctorfname,
			            (SELECT mname FROM tblperson JOIN tbluser ON tbluser.person_id = tblperson.id WHERE tbluser.id = doctor_id) as doctormname,
            (SELECT lname FROM tblperson JOIN tbluser ON tbluser.person_id = tblperson.id WHERE tbluser.id = doctor_id) as doctorlname,
            (SELECT fname FROM tblperson JOIN tblpatient ON tblpatient.person_id = tblperson.id WHERE tblpatient.id = patient_id) as patientfname,
			            (SELECT mname FROM tblperson JOIN tblpatient ON tblpatient.person_id = tblperson.id WHERE tblpatient.id = patient_id) as patientmname,
            (SELECT lname FROM tblperson JOIN tblpatient ON tblpatient.person_id = tblperson.id WHERE tblpatient.id = patient_id)  as patientlname,
            (SELECT date FROM tblschedule WHERE tblschedule.id = schedule_id) as date,
            (SELECT start FROM tblschedule WHERE tblschedule.id = schedule_id) as start,
            (SELECT end FROM tblschedule WHERE tblschedule.id = schedule_id) as end
        ');
        $this->db->from('tblappointment');
        $this->db->join('tblschedule', 'tblschedule.id = tblappointment.schedule_id');
        
        if ($state != '') 
            $this->db->where('state ' . $state);

        $this->db->like('req_medical', $req_medical);
        
        if ($userid != '') 
            $this->db->where('doctor_id', $userid);

        if ($patient_id != '') 
            $this->db->where('patient_id', $patient_id);

        if ($id != '') 
            $this->db->where('tblappointment.id', $id);

        if ($type) 
            $this->db->order_by('type', 'DESC');

        $this->db->order_by('tblschedule.date');
        $this->db->order_by('tblschedule.start');

        $query = $this->db->get();

        return $query->result();

    }

    function insert_appointment($doctor_id, $patient_id, $schedule_id, $type) {

        $appointment = array(
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'schedule_id' => $schedule_id,
            'type' => $type,
            'state' => 'Pending',
            'req_medical' => '0'
        );

        $this->db->insert('tblappointment', $appointment);

    }

    function update_appointment($id, $doctor_id, $patient_id, $schedule_id, $type) {

        if ($schedule_id != '')
            $appointment = array(
                'doctor_id' => $doctor_id,
                'patient_id' => $patient_id,
                'schedule_id' => $schedule_id,
                'type' => $type
            );
        else
            $appointment = array(
                'doctor_id' => $doctor_id,
                'patient_id' => $patient_id,
                'type' => $type
            );

        $this->db->where('id', $id);
        $this->db->update('tblappointment', $appointment);

    }

    function delete_appointment($id) {

        $this->db->delete('tblappointment', array('id' => $id));

    }

    function insert_checkup($height, $weight, $temper, $bloodpres, $symptoms, $prevmed, $patient_id) {

        $checkup = array(
            'height' => $height,
            'weight' => $weight,
            'temperature' => $temper,
            'blood_pressure' => $bloodpres,
			'symptoms' => $symptoms,
            'prevmed' => $prevmed
        );

        $this->db->insert('tblcheckup', $checkup);

        $checkup_id = $this->db->insert_id();

        $patient = array(
            'checkup_id' => $checkup_id
        );

        $this->db->where('id', $patient_id);
        $this->db->update('tblpatient', $patient);

    }

    function update_checkup($checkup_id, $height, $weight, $temper, $bloodpres, $symptoms, $prevmed) {

        $checkup = array(
            'id' => $checkup_id,
            'height' => $height,
            'weight' => $weight,
            'temperature' => $temper,
            'blood_pressure' => $bloodpres,
			'symptoms' => $symptoms,
            'prevmed' => $prevmed
        );

        $this->db->replace('tblcheckup', $checkup);

    }

    function select_patientnames($search) {

        $this->db->select('tblpatient.id, fname, mname, lname');
        $this->db->from('tblperson');
        $this->db->join('tblpatient', 'tblpatient.person_id = tblperson.id');
        $this->db->join('tblaccount', 'tblaccount.id = tblpatient.account_id');
        $this->db->where('usertype', 'Patient');
        $this->db->where("fname LIKE '%" . $search . "%'");
        $this->db->or_where("lname LIKE '%" . $search . "%'");
        $this->db->order_by('lname');

        $query = $this->db->get();

        return $query->result();

    }



}