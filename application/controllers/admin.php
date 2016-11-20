<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

    private $msg = 'Данные успешно сохранены';

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');    
    }
   
    public function controller($url) { 
        $url = $this->security->xss_clean($url); 
        $url = str_replace('-', '_', $url);
        if (method_exists($this, $url)) {
            $this->$url();
        } else { 
            exit('404 Error!');
        }
    } 

    public function menu() {

        $id = $this->uri->segment(3);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if (empty($id)) {

                /* Insert */ 

                if (!($_POST['url'])) {
                    $url = to_url_title($_POST['name']);
                } else {
                    $url = to_url_title($_POST['url']);
                }  
     
                $data = returnData($_POST, array('name', 'text', 'seo_title', 'seo_description', 'seo_keywords'));  
                $data['url'] = $url;
      
                $this->db->insert('menu', $data); 
                $this->alertSuccess(true); 
            }else{

                /* Edit */
 
                $url_prioryti = $this->db->select('let_alone')->where('id', $id)->get('menu')->row();
                if ($url_prioryti->let_alone != 1) {
                    if (!($this->input->post('url'))) {
                        $url = to_url_title($_POST['name']);
                    } else {
                        $url = to_url_title($_POST['url']);
                    }
                    $this->db->where('id', $id)->update('menu', array(
                        'url' => $url
                    )); 
                }

                $data = returnData($_POST, array('name', 'text', 'seo_title', 'seo_description', 'seo_keywords'));
                $this->db->where('id', $id)->update('menu', $data); 
                $this->alertSuccess(true); 
            }
             
        }else{
            $data = array(
                'data' => !empty($id) ? $this->admin_model->getEdit($id, 'menu')  : $this->admin_model->getItems('menu'), 
                'db_table' => 'menu',
                'method' => 'menu' 
            ); 
             
            $this->admin('private/menu', $data, '');
        } 
    }  
   
    public function categories(){
        $id = $this->uri->segment(3);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if (empty($id)) {

                /* Insert */  
 
                $data = returnData($_POST, array('name'));     
 
                $this->db->insert('categories', $data); 
                $this->alertSuccess(true); 
            }else{

                /* Edit */   

                $data = returnData($_POST, array('name'));    

                $this->db->where('id', $id)->update('categories', $data); 
                $this->alertSuccess(true); 
            }
             
        }else{
            $data = array(
                'data' => !empty($id) ? $this->admin_model->getEdit($id, 'categories')  : $this->admin_model->getItems('categories'), 
                'db_table' => 'categories',
                'method' => 'categories' 
            ); 
             
            $this->admin('private/categories', $data, '');
        } 
    }

    public function faq(){
        $id = $this->uri->segment(3);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if (empty($id)) {

                /* Insert */ 

                if (empty($_POST['url'])) {
                    $url = to_url_title($_POST['question']);
                } else {
                    $url = to_url_title($_POST['url']);
                } 

                $data                = returnData($_POST, array('question', 'text'));  
                $data['id_category'] = !empty($_POST['id_category']) ? $_POST['id_category'] : '';
                $data['url']         = $url;
                
                $this->db->insert('faq', $data); 
                $this->alertSuccess(true); 
            }else{

                /* Edit */ 

                if (empty($_POST['url'])) {
                    $url = to_url_title($_POST['question']);
                } else {
                    $url = to_url_title($_POST['url']);
                } 
 
                $data                = returnData($_POST, array('question', 'text'));   
                $data['id_category'] = !empty($_POST['id_category']) ? $_POST['id_category'] : '';
                $data['url']         = $url;
                
                $this->db->where('id', $id)->update('faq', $data); 
                $this->alertSuccess(true); 
            }
             
        }else{
            $data = array(
                'data' => !empty($id) ? $this->admin_model->getEdit($id, 'faq')  : $this->admin_model->getFaq(), 
                'categories' => $this->admin_model->getItems('categories'),
                'db_table' => 'faq',
                'method' => 'faq' 
            );  
             
            $this->admin('private/faq', $data, '');
        } 
    } 
 
 
    public function constants(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {   
                $this->db->where('id', $key)->update('constant', array('value' => $value));  
            }  
            $this->alertSuccess(true);  
        }else{
            $data = array(
              'data' => isset($_GET['filter']) ? $this->admin_model->getSearchConstants($_GET) : $this->admin_model->getConstants(),
              'db_table' => 'constant',
              'method' => 'constants' 
              );

            $this->admin('private/constants', $data, '');
        } 
    }

    public function settings(){
        $data = array(
                'userdata' => $this->admin_model->getUserdata(),
                'settings' => $this->db->get('settings')->result_array()
            );
        $this->admin('private/settings', $data, '');
    }

    public function editSettings(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $this->db->where('id >', '0')->update('settings', array('value' => ''));
            if (!empty($_POST['settings'])) {
                foreach ($_POST['settings'] as $key => $value) {
                    $this->db->where('var', $key)->update('settings', array('value' => $value));
                }
            } 
            $this->alertSuccess(true);
        }
    }

    public function editUserdata() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $password        = $this->input->post('password');
            $repeat_password = $this->input->post('repeat_password');

            if (empty($password) || empty($repeat_password)) {
                $this->alertError('Заполните все поля');  
            } 

            if ($password != $repeat_password){
                $this->alertError('Пароли не совподают'); 
            } 
 
            $sql       = $this->db->where('id', $_SESSION['admin_user']['id'])->update('admin', array(
                'password' => md5($password)
            ));

            if ($this->db->affected_rows() < 0){
                $this->alertError('Во время изменений, произошла ошибка'); 
            } 
            $this->alertSuccess(true); 
        }
    }

    public function addNewUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login           = $this->input->post('login');
            $password        = $this->input->post('password');
            $repeat_password = $this->input->post('repeat_password');
            
            if (empty($password) || empty($repeat_password) || empty($login)) {
                $this->alertError('Заполните все поля');  
            }

            $check_unique    = $this->db->where('login', $login)->get('admin');
            if ($check_unique->num_rows() > 0) {
                $this->alertError('Пользователь с таким логинам уже существует');  
            }

            if ($password != $repeat_password){
                $this->alertError('Пароли не совподают'); 
            } 

            $sql = $this->db->insert('admin', array(
                'login' => $login,
                'password' => md5($password)
            ));
          
            $this->alertSuccess(true); 
        }
    }

    public function sendBackRequest(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $message = nl2br($_POST['message']);
            $theme = $_POST['theme'];
            $email = $_POST['email'];
            send_mail($email, $theme, $message);
            $this->alertSuccess(true); 
        }
    }

    public function doUpload($input, $config, $_resize = FALSE) {
        if ($_FILES[$input]['error'] == 0) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($input)) {
                return array(
                    'response' => $this->upload->display_errors()
                );
            } else {
                $data = $this->upload->data('file_name');
                return array(
                    'response' => TRUE,
                    'image' => $data['raw_name'] . $data['file_ext']
                );
            }
        } else {
            return false;
        }
    } 

    private function uploadBase64($base64, $path){
        $data = $base64;
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));   
        $file = uniqid() . '.png'; 
        $path = $path.'/'.$file;
        $success = file_put_contents($path, $data);
        return $file;
    }

    public function uploadMultiFile($files, $array_name, $more_config = FALSE, $config_thumbs = FALSE, $return_type, $delimiter = '', $array = array()) {
        if (is_array($more_config))
            extract($more_config);
        if (is_array($config_thumbs))
            extract($config_thumbs);

        $config['upload_path']   = $path ? $path : $path = 'public/global_public_img/default';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $count = count($files[$array_name]['name']); 

        $temp_files = $_FILES;
        for ($i = 0; $i <= $count - 1; $i++) {
            if (isset($temp_files[$array_name]['name'][$i])) {
                $_FILES[$array_name] = array(
                    'name' => $temp_files[$array_name]['name'][$i],
                    'type' => $temp_files[$array_name]['type'][$i],
                    'tmp_name' => $temp_files[$array_name]['tmp_name'][$i],
                    'error' => $temp_files[$array_name]['error'][$i],
                    'size' => $temp_files[$array_name]['size'][$i]
                );

                if (!$this->upload->do_upload($array_name)) {
                    return array(
                        'error' => true,
                        'msg' => $this->upload->display_errors()
                    );
                }
                 
                $tmp_data = $this->upload->data();

                switch ($return_type) {
                    case 'array':
                        $array[] = $tmp_data['file_name'];
                        break;

                    case 'delimiter':
                        $delimiter .= $tmp_data['file_name'] . "|";
                        break;    
                    
                    default:
                        exit();
                        break;
                }
  
                if (is_array($config_thumbs))
                    newthumbs($tmp_data['file_name'], $path, $width, $height, $version, $zc);
            }
        }

        return array(
            'error' => false,
            'msg' => empty($array) ? $delimiter : $array
        );
    } 
 
    public function viewElement()
    { 
        $id    = $this->input->post('id');
        $table = $this->input->post('table'); 
        $row = !empty($_POST['row']) ? $_POST['row'] : 'view';
         
        $query = $this->db->select("{$row}")->where('id', $id)->get($table)->row();

        if ($query->$row == 1) { 
            $data = array(
                "{$row}" => '0'
            ); 
            $this->db->where('id', $id)->update($table, $data);
            return $this->alertSuccess();
        } else {
            $data = array(
                "{$row}" => '1'
            );
            $this->db->where('id', $id)->update($table, $data); 
            return $this->alertSuccess();
        }
    }

    public function changeStatus() { 
        $id = $_POST['id'];
        $table = $_POST['table']; 
        $row = !empty($_POST['row']) ? $_POST['row'] : 'status';
        $status = $_POST['status']; 

        $this->db->where('id', $id)->update($table, array("{$row}"=>$status));
        return $this->alertSuccess();
    }

     

    public function sortMultiLevel(){   
        $arr = $this->input->post('arr'); 
        $table =   $this->input->post('table'); 
        $this->SortCatToString(FALSE, $arr, '', $table);
        return $this->alertSuccess();
    } 

    private function SortCatToString($id = FALSE, $array, $i = 0, $table){ 
        $string = '';   
        foreach ($array as $item) { 
            $string .= $this->sotrtCatToDb($id, $item, $i, $table); 
            $i++;
        }
        return $string; 
    }  

    private function sotrtCatToDb($parent = '0', $category, $page_up, $table){
        ob_start(); 
            if (isset($category['children'])) { 
                $i = 0;  
                foreach ($category['children'] as $item) {
                    $data = array( 
                        'parent_id' => $category['id'],
                        'page_up' => $i 
                        ); 

                    $this->db->where('id', $item['id']);
                    $this->db->update($table, $data); 
                    if ($item['children']) {
                        $this->SortCatToString($item['id'], $category['children'], $i);
                    }  
                    $i++;      
                } 
            } else{
                $data = array( 
                        'parent_id' => $parent,
                        'page_up' => $page_up
                );
                $this->db->where('id', $category['id']);
                $this->db->update($table, $data);
            }  
        return ob_get_clean(); 
    }

    public function viewMenuFooter() {
        $id    = (int) $this->input->post('id');
        $table = $this->input->post('table');
        $this->db->select('view_footer');
        $this->db->where('id', $id);
        $query = $this->db->get($table)->row();
        if ($query->view_footer == 1) {
            $data = array(
                'view_footer' => '0'
            );
            $this->db->where('id', $id);
            $this->db->update($table, $data);
            return $this->alertSuccess();
        } else {
            $data = array(
                'view_footer' => '1'
            );
            $this->db->where('id', $id);
            $this->db->update($table, $data);
            return $this->alertSuccess();
        }
    }

    public function sortElement() { 
        $i     = 1;
        $table = $_POST['table']; 
        foreach ($_POST['arr'] as $value) { 
            $this->db->where('id', $value)->update($table, array(
                'page_up' => $i
            ));
            $i++;
        }
        return $this->alertSuccess();
    }

    public function changePosition(){ 
        $id = intval($_POST['id']);
        $page_up = intval($_POST['page_up']);
        $table = $_POST['table'];
        $this->db->where('id', $id)->update($table, array(
                'page_up' => $page_up
            ));
    }

    public function nestableElement() {  
        $i     = 1;
        $table = $this->input->post('table');
        foreach ($this->input->post('arr') as $value) { 
            $this->db->where('id', $value['id'])->update($table, array(
                'page_up' => $i
            ));
            $i++;
        }
        return $this->alertSuccess();
    }

    public function deleteElement() {
        $id    = (int) $this->input->post('id');
        $table = $this->input->post('table'); 
         
        $sql = $this->db->where('id', $id)->delete($table);
        if ($this->db->affected_rows() != 1)
            return 'Во время изменений, произошла ошибка'; 
        return $this->alertSuccess();
    }

    public function deleteImageElement() {
        $id    = (int) $this->input->post('id');
        $table = $this->input->post('table');
        $name = $this->input->post('name'); 
        $del_img = !empty($name) ? $name : 'image';
        $sql   = $this->db->where('id', $id)->update($table, array(
            $del_img => ''
        ));
        if ($this->db->affected_rows() != 1)
            return 'Во время изменений, произошла ошибка';
        return $this->alertSuccess();
    } 
 
 
    private function pageUp($db) {
        $sql    = $this->db->select_max('page_up')->get($db)->row_array();
        $result = $sql['page_up'];
        $return = empty($result) ? '0' : $result + '1';
        return $return;
    }

    private function alertSuccess($session=false){ 
        $msg = $this->msg;

        if ($session == true) {
            $_SESSION['msg'] = '<div class="alert alert-success">'.$msg.'</div>';
        }
 
        echo json_encode(array('msg' => $msg));   
        exit();
    } 

    public function alertError($msg = 0, $session=false){ 
        if ($session == true) {
            $_SESSION['msg'] = '<div class="alert alert-danger">'.$msg.'</div>';
        }

        echo json_encode(array('msg' => "error", 'cause' => $msg));  
        exit();  
    } 

    public function display_404() { 
        $this->load->view('public/error', '', '');  
    } 
}


