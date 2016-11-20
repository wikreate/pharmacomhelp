<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    public function CheckLogin()
    {
        $login    = clear($_POST['login']);
        $password = md5($_POST['password']);
        
        $sql = $this->db->where('login', $login)->where('password', $password)->limit('1')->get('admin')->row_array();
       
        if (!empty($sql)) {
            $_SESSION['admin_user'] = $sql;
            return TRUE; 
        } else {
            return 'Не правильный логин или пароль';
        }
    }
 
}