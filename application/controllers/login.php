<?php 
class Login extends MY_Controller {

    function __construct() { 
        parent::__construct(); 
        $this->load->model('login_model'); 
    } 

    public function do_login() { 

        if ($this->input->is_ajax_request()) { 
            if (isset($_POST)) { 
                if ($this->form_validation->run('login') === TRUE) { 
                    $login = $this->login_model->CheckLogin(); 
                    if ($login === TRUE) { 
                        $data['msg'] = 'Вы вошли в систему'; 
                    } else { 
                        $data['msg']   = "error"; 
                        $data['cause'] = "$login"; 
                    } 
                } else {    
                    $data['msg']   = "error"; 
                    $data['cause'] = validation_errors(); 
                } 
            } 
            echo json_encode($data); 
        } 
    }
 
    public function sign() { 
        if (empty($_SESSION['admin_user'])) {
            $this->load->view('template/login');
        }else{
            redirect(base_url('cp'), 'refresh');
        }  
    }
 
    public function logout() { 
        unset($_SESSION['admin_user']);  
        redirect(base_url('login'), 'refresh'); 
    } 
}