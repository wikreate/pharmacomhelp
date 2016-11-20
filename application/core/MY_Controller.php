<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
 
        //run session
        @session_start();   

        //check lang
        $this->_check_lang();

        //constants
        $this->_defines(); 

        //settings
        $this->initSetings();
    } 

    public function home($view, $data, $to_parse, $default=false) {  
        $this->load->model('pages_model');
        $url = (!$this->uri->segment(1) ? '/' : $this->uri->segment(1));
        
        /*Хранит данные страницы*/
        $data['pages'] = $this->pages_model->getPage($url);
           
        $data['categories'] = $this->pages_model->getCategories(); 

        /*Хранит мета тэги страницы*/
       // $data['meta'] = $this->pages_model->getMeta();  
  
        /*Массив со всеми страницами на сайте*/
        $data['menu']  = $this->pages_model->getNavMenu(); 
    
        $parse = array( 
            'content' => $this->load->view($view, $data, TRUE) 
        );

        //foreach to_parser if not empty 
        if (!empty($to_parse)) {
            foreach ($to_parse as $item => $value) {
                $parse[$item] = $value;
            }
        }
        
        if ($default==false) {
            $this->parser->parse('template/home_template', $parse);
        }else{
            $this->parser->parse('template/default', $parse);
        } 
    }

    public function admin($view, $data, $to_parse)
    {
        if (empty($_SESSION['admin_user']))
            redirect(base_url('login'), 'refresh');

        $data['lang_arr'] = $this->lang->lang_arr(); 

        $data['lang'] = $this->lang->lang();

        $parse = array(
            'content' => $this->load->view($view, $data, TRUE)
        );
        
        //foreach to_parser if not empty 
        if (!empty($to_parse)) {
            foreach ($to_parse as $item => $value) {
                $parse[$item] = $value;
            }
        }
        $this->parser->parse('template/admin_template', $parse);
    }

    public function _defines() {
        $sql    = $this->db->select('name')->select("value")->get('constant');
        $result = $sql->result_array();
        foreach ($result as $item) {
            if (!($item['value'])) {
                define(mb_strtoupper(trim($item['name'])), '');
            } else {
                define(mb_strtoupper(trim($item['name'])), $item['value']);
            }
        }
    }  

    private function _check_lang(){    

        $uri1 = $this->uri->segment(1);

        $this->config->load('config'); 
        if (in_array($uri1, array('ru', 'ro'))) {
            $lang = clear($uri1);
            $date = time() + 30*24*60*60; 
            $_SESSION['lang'] = $lang;
            set_cookie('lang', $lang, $date);   
        }else if(isset($_COOKIE['lang'])){ 
            $_SESSION['lang'] = $_COOKIE['lang'];  
        }elseif (in_array(substr(getDefaultLanguage(), 0, 2), array('ru', 'ro'))) {
            $_SESSION['lang'] = substr(getDefaultLanguage(), 0, 2);
        } else{  
            $_SESSION['lang'] = 'ru';  
        }    

        $this->config->set_item('language', $_SESSION['lang']); 
    }

    public function initSetings() {
        $getSettins = $this->db->get('settings')->result_array();
        foreach ($getSettins as $item) {
            define('var_'.$item['var'], $item['value']);
        }
    } 
}