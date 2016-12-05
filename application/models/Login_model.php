
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        $this->load->helper('string');
        
    }

    public function add_user()
    {
        $username = $this->input->post('email');
        $password = md5($this->input->post('password'));
        
        $activation_code = md5(random_string('alnum', 20));
        $forgotten_password_code = md5(random_string('alnum', 20));
        //$forgotten_password_time = date('Y-m-d H:i:s');
        $created_on = date('Y-m-d H:i:s');
        $is_active = 0;

        $data = array('email'=>$username,'password'=>$password,'activation_code'=>$activation_code,'forgotten_password_code'=>$forgotten_password_code,'created_on'=>$created_on,'is_active'=>$is_active);
        
        $flag = $this->db->insert('tb_users', $data);

        if($flag){
            return TRUE;
        }
        else {
            return FALSE;
        }
        
    }
    public function update_user()
    {
        //$username = $this->input->post('email');
        $password = md5($this->input->post('password'));
        
        //$activation_code = md5(rand(20));
        //$forgotten_password_code = md5(rand(20));
        //$forgotten_password_time = date('Y-m-d H:i:s');
        //$created_on = date('Y-m-d H:i:s');
        //$is_active = 1;

        $data = array('email'=>$username,'password'=>$password,'activation_code'=>$activation_code,'forgotten_password_code'=>$forgotten_password_code,'created_on'=>$created_on,'is_active'=>$is_active);
        
        $flag = $this->db->insert('tb_users', $data);

        if($flag){
            return TRUE;
        }
        else {
            return FALSE;
        }
        
    }
    
    public function activate_email()
    {
        
        $email = $this->input->post('email');
        $activation_code = $this->input->post('activation_code');

        
        $this->db->select('*');
        
        $this->db->where('email', $email);
        $this->db->where('activation_code', $activation_code);
        
        $this->db->limit('1');
        
        $result = $this->db->get('tb_users');
        
        $count = $result->num_rows();
        
        if($count > 0)
        {
            $data = array('is_active'=>'1','activation_code'=>'');
            
            $this->db->where('email', $email);
            
            $flag = $this->db->update('tb_users', $data);
            if($flag){
                return TRUE;
            }
            else{
                return FALSE;
            }
            
        }
        else{
            return FALSE;
        }
        
    }

    public function check_user($username,$password)
    {
        
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        
        $this->db->limit('1');
        
        $result = $this->db->get();

        
        if($result->num_rows() > 0)
        {
            return $result;
        }
        else{
            return FALSE;
        }
    }

    public function get_reset_code()
    {
        $email = $this->input->post('email');
        
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('email', $email);
        $result = $this->db->get();

        $forgotten_password_code = date('Y-m-d H:i:s');
        $data = array('forgotten_password_time'=>$forgotten_password_time);
        
        $this->db->where('email', $email);
        
        $this->db->update('tb_users', $data);

        return  $result;
    }
    
    public function reset_password()
    {
        
        $forgotten_password_code = $this->input->post('forgotten_password_code');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('email', $username);
        $this->db->where('forgotten_password_code', $forgotten_password_code);
        
        $this->db->limit('1');
        
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            $forgotten_password_code = md5(random_string('alnum', 20));            
            $data = array('password'=>$password,'forgotten_password_code'=>$forgotten_password_code);
            $forgotten_password_code = md5(rand(20));            
            $data = array('password'=>$password,'forgotten_password_code' => $forgotten_password_code);
            $forgotten_password_code = md5(random_string('alnum', 16));            
            $data = array('password'=>$password,'forgotten_password_code'=>$forgotten_password_code);
            $this->db->where('email', $email);
            $this->db->update('tb_users', $data);
            return TRUE;
        }
        else{
            return FALSE;
        }
        
    }



}

/* End of file Login_Model.php */
