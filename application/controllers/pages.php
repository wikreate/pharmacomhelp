<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
   
    public function __construct() {
        parent::__construct();
        $this->load->model('pages_model');    
    }  

    public function top_menu($url) {  
        $url = clear($url);  
        $url = str_replace('-', '_', $url);
        if ($this->uri->segment(2)) {
            header('Location: /display_404/');
        } elseif (method_exists($this, $url)) {
            $this->$url();  
        } else{ 
            $this->home('public/default', '', '');
        }
    } 

    public function index(){   
         
        $categories = $this->db->where('view', '1')->where('view_home', '1')->order_by('page_up', 'asc')->get('categories')->result_array(); 
        $data = array();
        foreach ($categories as $item) {
            $row = array();
            $row['cat_name'] = $item['name'];
            $row['id'] = $item['id']; 
            $row['childs']   = $this->pages_model->getFaq('id_category = "'.$item['id'].'"');
            $data[] = $row;
        }

        $data['faq'] = $data; 

        $this->home('public/home', $data, '');
    } 

    public function autocomplete(){  

        $query = clear($_GET['query']);  
        $faq   = $this->pages_model->getFaq("faq.question LIKE '%$query%' OR faq.text LIKE '%$query%' OR categories.name LIKE '%$query%'");  
       
        $result_faq = array();
        foreach ($faq as $item) {
            $result_faq[] = ucfirst(strtolower($item["question"]));
        } 

        $result = array_merge($result_faq); 
  
        echo json_encode($result); exit();
    }

    public function search(){ 
        if (!isset($_GET['query']) or !isset($_GET['category'])) {
            header('Location: /');
        }

        $statusSearh = 0;
        if (!empty($_GET['category']) && $_GET['category'] !== 'all') {
            $this->db->where('id_category', intval($_GET['category']));
            $statusSearh = '1';
        } 

        if (!empty($_GET['query'])) {
            $query = clear($_GET['query']);
            $this->db->or_like('faq.question', $query);
            $this->db->or_like('categories.name', $query);
            $this->db->or_like('faq.text', $query);
            $statusSearh = '1';
        } 

        if (empty($statusSearh)) {
            $this->db->where('faq.id <', '0'); 
        }
   
        $data['faq']  = $this->pages_model->getFaq();  
        $data['page_title'] = SR_TTL; 

        $this->home('public/category', $data, '');
    }

    public function cat($id=false){ 
        if (empty($id) or !is_numeric($id)) {
            display_404();
        } 

        $id = intval($id);

        $whereCategory = !empty($_GET['category']) ? " AND id_category = '".intval($_GET['category'])."' " : '';
    
        $data['category']    = $this->pages_model->getViewItem($id, 'categories');
        $data['method']      = 'cat';
        $data['faq']         = $this->pages_model->getFaq("id_category =  '$id'");  
        $data['page_title']  = $data['category']['name']; 
        $data['breadcrumbs'] = '<li class="active">'.$data['category']['name'].'</li>';

        $this->home('public/category', $data, '');
    }
  
    public function faq($url) { 
        if (empty($url)) {
           display_404();
        }   
        $url                 = clear($url);   
        $data['data']        = $this->pages_model->getViewFaq($url);  
        $data['similar']     = $this->pages_model->getFaq("id_category = '".$data['data']['id_category']."' AND faq.id <> '".$data['data']['id']."'", 8);
        $data['breadcrumbs'] = '<li><a href="/cat/'.$data['data']['id_category'].'">'.$data['data']['cat_name'].'</a></li> <li class="active">'.character_limiter($data['data']['question'],93).'</li>';

        $this->home('public/view_faq', $data, '');
    } 
 
    public function callback(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            if (empty($_POST['email']) or empty($_POST['text'])) {
                alertError(REQ_FIELDS);
            }

            $email = $_POST['email'];
            $text  = $_POST['text'];

            $theme = 'New message from '.SITE_NAME;
            $message = '<b>Email:</b> '.$email.' <br> <b>Message:</b> '.$text.'
            </p>';

            $html = 
            '<html>'.
                '<head>'. 
                    '<title>'.$theme.'</title>'.
                '</head>'.
                '<body>'.
                    '<style>a { color:#777; }</style>'.
                    '<div style="margin:0; padding:10px; background-color:#F2F2F2;">'. 
                        '<div style="width:500px; margin:0 auto; margin-top:10px; padding:15px; margin-bottom:10px; background-color:#fff; border-bottom:2px solid #D8D6D1;">'.
                            
                            '<p style="height:10px;"></p>'.
                            $message.
                            '<p style="min-height:10px"></p>'.
                        '</div>'.
                        '<p style="font-family:\'Helvetica\',\'Arial\',sans-serif;color:#9ca1ae;font-size:12px;font-weight:300;text-align:center;margin-bottom:10px;"> © '.date("Y").' <a href="http://'.$_SERVER['SERVER_NAME'].'" style="color:#777" target="_blank">'.$_SERVER['SERVER_NAME'].'</a></p>'.
                    '</div>'.
                '</body>'.
            '</html>'; 

            $config = Array(         
                'mailtype'  => 'html', 
                'charset'   => 'utf-8',
                'protocol' => 'mail' 
            );
            
            $this->email->initialize($config); 
            $this->email->from('info@'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_NAME']);
            $this->email->to(EMAIL);  

            $this->email->subject($theme);
            $this->email->message($html);  
            $this->email->send(); 
            alertSuccess(SUCCESS_SEND, true);
        }
    }
     
    public function display_404() { 
        $this->load->view('public/error', '', '');  
    }
  
}


