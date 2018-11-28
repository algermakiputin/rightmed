<?php
class MY_Controller extends CI_Controller
{
    protected $usertype;
    protected $data = array();
    protected $nav = array();
    public function __construct($Vqs1ck1ykvxi, $usertype = null)
    {
        parent::__construct();
        $this->data = array();
        if ($usertype) {
            $this->data['user'] = $usertype;
            if (!($this->usertype = $this->session->usertype)) {
                redirect(base_url());
            } else if ($this->usertype != $usertype) {
                redirect(base_url() . $this->$usertype);
            }
        } else {
            if ($usertype = $this->session->usertype) {
                $usertype = str_replace(' ', '', $usertype);
                redirect(base_url() . $usertype);
            }
        }
        foreach ($Vqs1ck1ykvxi as $nav) {
            array_push($this->nav, $nav);
        }
    }
    
    
    
    public function _remap($Vkpd1oowvxty, $Vqwrzxe3uddh = array())
    {
        if (in_array($Vkpd1oowvxty, $this->nav)) {
            if (method_exists($this, $Vkpd1oowvxty))
                call_user_func_array(array(
                    $this,
                    $Vkpd1oowvxty
                ), $Vqwrzxe3uddh);
            $this->data['usertype'] = $this->usertype;
            
            if ($Vkpd1oowvxty == 'index')
                $Vkpd1oowvxty = 'home';
            $this->show_section($Vkpd1oowvxty);
            return;
        }
        
        else if (method_exists($this, $Vkpd1oowvxty))
            return call_user_func_array(array(
                $this,
                $Vkpd1oowvxty
            ), $Vqwrzxe3uddh);
        
        show_404();
    }
    public function show_section($Vnyqmc101het = 'home')
    {
        if ($this->usertype) {
            $this->load->view('templates/user_header', $this->data);
            $this->load->view("$this->usertype/nav");
            $this->load->view('templates/nav');
            $this->load->view("$this->usertype/$Vnyqmc101het", $this->data);
            $this->load->view('templates/user_footer');
        } else {
            $this->load->view('templates/header', $this->data);
            $this->load->view("$Vnyqmc101het");
            $this->load->view('templates/footer');
        }
    }
}