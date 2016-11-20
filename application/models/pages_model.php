<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model {
    private $result = array();
    
    function __construct() {
        parent::__construct();
    }  

    public function getNavMenu() {
        $sql = $this->db->where('view', '1')->order_by('page_up', 'asc')->get('menu');
        return $sql->result_array();  
    }  
     
    public function getPage($url) {   
        $sql = $this->db->where('url', $this->security->xss_clean($url))->get('menu');
        $this->result = $sql->row_array();   
        // $this->_empty_data();
        return  $this->result;
    } 

    public function getMeta(){
        $segment = !$this->uri->segment(1) ? '/' : $this->uri->segment(1);
        $page = clear($segment); 

        $sql = $this->db->select('seo_title, seo_keywords, seo_description')->where('url', $this->security->xss_clean($page))->get('menu');
        $this->result = $sql->row_array(); 

        return $this->result;
    }

    public function getItems($table, $page_up = true, $view=false){
        $lang = $this->lang->lang();
        if ($page_up) {
            $this->db->order_by('page_up', 'asc');
        }else{
            $this->db->order_by('date', 'desc')->order_by('id', 'desc');
        }

        if ($view) {
            $this->db->where('view', '1');
        }

        $sql = $this->db->get($table);
        return $sql->result_array();
    } 

 
    public function getFaq($where=false, $limit_num=false){
         
        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($limit_num)) {
            $this->db->limit($limit_num);
        }

        $sql = $this->db->select('faq.*, categories.name as cat_name')
                        ->from('faq')
                        ->join('categories', 'categories.id = faq.id_category', 'left') 
                        ->group_by('faq.id') 
                        ->where('faq.view', '1')
                        ->order_by('faq.page_up asc, faq.id desc')
                        ->get(); 

        return $sql->result_array();
    }

    public function getViewFaq($url){
         
        $sql = $this->db->select('faq.*, categories.name as cat_name')
                        ->from('faq')
                        ->join('categories', 'categories.id = faq.id_category', 'left') 
                        ->group_by('faq.id') 
                        ->where('faq.view', '1')
                        ->where('faq.url', $url)
                        ->order_by('faq.page_up asc, faq.id desc')
                        ->get(); 

        $this->result = $sql->row_array();   
        $this->_empty_data();
        return  $this->result;
    } 
 
    public function getCategories(){
        $sql = $this->db->query("SELECT categories.*, COUNT(if(faq.view = '1', faq.id, NULL)) as sum_faq
                                 FROM categories 
                                 LEFT JOIN faq ON (faq.id_category = categories.id) 
                                 WHERE categories.view='1'
                                 GROUP BY categories.id  
                                 ORDER BY page_up asc  
        ");
 
        return $sql->result_array();
    }  
     
    public function getViewItem($id, $table){
        $sql = $this->db->where('id', $id)->where('view', '1')->get($table);
        $this->result = $sql->row_array();
        $this->_empty_data();
        return $this->result;
    }  
    
    public function getCatId($url){
        $url = $this->security->xss_clean($url);
        $sql = $this->db->where('url', $url)->get('news_categories');
        return $sql->row_array();
    } 
  
    public function _empty_data(){
        if (empty($this->result)) {
            display_404();
        }
    } 
}