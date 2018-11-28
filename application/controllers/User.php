<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    private $usern, $passw, $usert, $fname, $lname, $birthdate, $address, $contact, $email, $gender, $marital_status;

     public function __construct() {
        
        parent::__construct(array('index', 'login', 'register'));

    }
	
    public function index() {

        $this->data['home'] = 'active';
        $this->data['login'] = '';
        $this->data['register'] = '';

    }

    public function services() {
        $this->load->view('templates/header');
        $this->load->view('services');
        $this->load->view('templates/footer');
    }

    public function mission_vision() {
        $this->load->view('templates/header');
        $this->load->view('about');
        $this->load->view('templates/footer');
    }

    public function login() {

		$this->data['home'] = '';
        $this->data['login'] = 'active';
        $this->data['register'] = '';
    
    }

    public function register() {

		$this->data['home'] = '';
        $this->data['login'] = '';
        $this->data['register'] = 'active';
    
    }

    public function login_check() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $prev_url = $this->input->get('prev');

        if ( $username == NULL || $password == NULL ) 
            redirect($prev_url);

        $this->load->model('usr');
        $user = $this->usr->select_users($username, $password);
        
        if ( $user->num_rows() ) {

            $userid = $user->row()->id;
            $usertype = $user->row()->usertype;

            $this->session->set_userdata('userid', $userid);
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('usertype', $usertype);
            redirect(base_url() . $usertype);

        }
        else  {
            redirect($prev_url);
        }

    }

    private function get_patient_input() {

        $this->usern = $this->input->post("username");
        $this->passw = $this->input->post("password");
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

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }
    
    public function register_check() {

        $this->get_patient_input();

        $this->load->model('stf');
        $this->stf->insert_patient($this->usern, $this->passw, $this->fname, $this->mname, $this->lname, $this->birthdate, $this->age, $this->address, $this->contact, $this->email, $this->gender, $this->marital_status);
        redirect(base_url() . 'login');

    }

}
