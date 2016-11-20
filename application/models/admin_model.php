<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $result = array();
    
    function __construct() {
        parent::__construct();
    }

    public function getEdit($id, $table){
        $sql = $this->db->where('id', $id)->get($table);
        $this->result = $sql->row_array();
        $this->_empty_data();
        return $this->result;
    }

    public function getItems($table, $page_up = true, $view=false){
        if ($page_up) {
            $this->db->order_by('page_up', 'asc');
        }else{
            $this->db->order_by('date', 'desc');
        }

        if ($view) {
            $this->db->where('view', '1');
        }

        $sql = $this->db->get($table);
        return $sql->result_array();
    } 
 
     
    public function getFaq(){
        $sql = $this->db->select('faq.*, categories.name as cat_name')
                        ->from('faq')
                        ->join('categories', 'categories.id = faq.id_category', 'left') 
                        ->group_by('faq.id')
                        ->order_by('categories.page_up asc, faq.page_up asc, faq.id desc')
                        ->get();

        return $sql->result_array();
    }

    public function getUsers($get=false){  
        $sql = $this->db->order_by('id', 'desc')->get('users');
        return $sql->result_array();
    } 

    public function getConstants() {
        $sql = $this->db->where('view', '1')
                        ->order_by('page_up', 'asc') 
                        ->get('constant');
        return $sql->result_array();
    } 

    public function getSearchConstants($get) {
        if (!empty($get['txt'])) {
            $txt = 'value LIKE "%'.$this->security->xss_clean($get['txt']).'%" or description LIKE "%'.$this->security->xss_clean($get['txt']).'%" ';
        }else{
            $txt = '';
        }

        $query = !empty($txt) ? $txt : 'id < 0';

        $sql = $this->db->where('view', '1')
                        ->where($query)
                        ->order_by('page_up', 'asc')  
                        ->get('constant');
        return $sql->result_array();
    } 

    public function getUserdata() { 
        $query = $this->db->get('admin'); 
        return $query->result_array(); 
    }

    private function _empty_data() {
        if (empty($this->result))
            show_404();
    }
 
}