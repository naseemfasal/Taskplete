
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
        
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
        
        // Calling Models 
        $this->load->model('Login_model', '', TRUE);

        if ($this->form_validation->run() == TRUE) {
            
            if($this->Login_model->add_user()){

                $response=array('status'=>'SUCCESS');
                echo json_encode($response);
            }
            else{

                $response=array('status'=>'DB_SERV_ERROR');
                echo json_encode($response);
            }

        } else {

                $response=array('status'=>'VALIDATION_ERROR');
                echo json_encode($response);            
        }
        
         

    }   
    public function login_authentication()
    {
         
        // Helpers
        $this->load->helper(array('form','url'));

        // Libraries
        $this->load->library(array('form_validation'));

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');   
        if ($this->form_validation->run() == FALSE) {

            $status = array('status'=>'TRUE');
            echo json_encode($status);
        }
        else{
            $status = array('status'=>'FALSE');
            echo json_encode($status);            
        }

            

    }       

    function check_database() {
        //Field validation succeeded.  Validate against database
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //query the database
        $this->load->model('Login_model');
        $result = $this->Login_model->check_user($email, $password);


        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'user_id' => $row['user_id'],
                    'email' => $row['email'],
                    'is_active' => $row['is_active'],
                    'profile_id'=> $row['profile_id']
                );

                //$this->session->set_userdata('logged_in', $sess_array);
            }

            $this->session->set_userdata('logged_in', $sess_array);

            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid email or password');
            return false;
        }
    }


}

/* End of file Login.php */

