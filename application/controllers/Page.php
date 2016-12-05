
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('Login_model', '', TRUE);
    }

    public function index()
    {
        
    }
    public function login()
    {
         // Helpers
         $this->load->helper(array('form','url'));

         
         $this->load->view('public_pages/login');
    }
    public function signup()
    {
         // Helpers
         $this->load->helper(array('form','url'));

         $this->load->view('public_pages/signup');
    }
    public function signup_process()
    {

        // Helpers
         $this->load->helper(array('form','url'));

         // Libraries
         $this->load->library(array('form_validation'));
         
        // Validation rules 
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password','Password','required');
        
        if ($this->form_validation->run() == TRUE) {
            echo "ok";
        } else {
            echo "false";
        }
        
         

    }   
    public function login_authentication()
    {
         
         

    }       



}

/* End of file Login.php */

