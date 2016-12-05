<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Install extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function index()
    {

        // TB Users

        $this->db->query('CREATE TABLE tb_users
        (
        user_id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(user_id),
        name VARCHAR(50),
        email VARCHAR(50),
        password VARCHAR(50),
        activation_code VARCHAR(50),
        forgotten_password_code varchar(40),
        forgotten_password_time DATETIME,
        profile_id INT,
        created_on DATETIME,
        is_active TINYINT
        )');


      echo "Successfully inserted database ";
    }

}

/* End of file Install.php */

// Tb Profile


?>