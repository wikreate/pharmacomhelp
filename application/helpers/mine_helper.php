<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('in_multi_array')) {
    function in_multi_array($needle, $haystack)
    {
        $haystack = key_to_asc($haystack); 
        $in_multi_array = false;
        if (in_array($needle, $haystack)) {
            $in_multi_array = true;
        } else {
            for ($i = 0; $i < sizeof($haystack); $i++) {
                if (is_array($haystack[$i])) {
                    if (in_multi_array($needle, $haystack[$i])) {
                        $in_multi_array = true;
                        break;
                    }
                }
            }
        }
        return $in_multi_array;
    }
}

if (!function_exists('key_to_id')) {
    function key_to_asc($array)
    {
        $new_arr = array();
        $i = 0;
        foreach ($array as $id => &$node) {
            $new_arr[$i] =& $node;
            $i++;
        }
        return $new_arr;
    }
}


if (!function_exists('key_to_id')) {
    function key_to_id($array)
    {
        $new_arr = array();
        foreach ($array as $id => &$node) {
            $new_arr[$node['id']] =& $node;
        }
        return $new_arr;
    }
}

if (!function_exists('map_tree')) {
    function map_tree($dataset)
    {
        $dataset = key_to_id($dataset);
        $tree    = array();
        foreach ($dataset as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] =& $node;
            } else { 
                $dataset[$node['parent_id']]['childs'][$id] =& $node;
            }
        }
        return $tree;
    }
}

if (!function_exists('categories_to_string')) {
    function categories_to_string($data)
    {
        $string = '';
        foreach ($data as $item) {
            $string .= categories_to_template($item);
        }
        return $string;
    }
}

if (!function_exists('categories_to_template')) {
    function categories_to_template($category)
    {
        ob_start();
        include APPPATH . 'buffer/' . "admin_menu" . EXT;
        $buffer = ob_get_contents();
        ob_get_clean();
        return $buffer;
    }
}

if (!function_exists('newthumbs')) {
    function newthumbs($photo = '', $dir = '', $width = 0, $height = 0, $version = 0, $zc = 0)
    {
        //echo $dir; 
        if (empty($photo) or !file_exists($dir . '/' . $photo)) {
            $photo = "no-image-no-image-no-image.png";
            if (!file_exists($dir . "/no-image-no-image-no-image.png")) {
                copy("./public/image/default/no-image.png", $dir . "/no-image-no-image-no-image.png");
            }
        }
        if (!file_exists($dir . '/' . $photo)) {
            if (file_exists($dir . '/' . str_replace('.jpg', '.JPG', $photo))) {
                $photo = str_replace('.jpg', '.JPG', $photo);
            } elseif (file_exists($dir . '/' . str_replace(' .jpg', '.jpg', $photo))) {
                $photo = str_replace(' .jpg', '.jpg', $photo);
            } elseif (file_exists($dir . '/' . substr($photo, 1))) {
                $photo = substr($photo, 1);
            }
        }
        require_once(realpath('public/lib/phpthumb') . '/phpthumb.class.php');
        // echo $dir;exit();
        $result = is_dir(realpath($dir) . '/thumbs');
        if ($result) {
            $prevdir = $dir . '/thumbs';
        } else {
            if (mkdir(realpath($dir) . '/thumbs')) {
                $prevdir = $dir . '/thumbs';
            } else {
                return './public/image/default/no-image.png';
            }
        }
        if (!empty($version)) {
            $result = is_dir(realpath($dir) . '/thumbs/version_' . $version);
            if ($result) {
                $prevdir = $dir . '/thumbs/version_' . $version;
            } else {
                if (mkdir(realpath($dir) . '/thumbs/version_' . $version)) {
                    $prevdir = $dir . '/thumbs/version_' . $version;
                } else {
                    return './public/image/default/no-image.png';
                }
            }
        }
        //$ext=end(explode('.',$photo));
        $ext    = pathinfo($photo, PATHINFO_EXTENSION);
        $timg   = realpath($dir) . '/' . $photo;
        $catimg = realpath($prevdir) . '/' . $photo;
        if (is_file($timg) && !is_file($catimg)) {
            $opath1   = realpath($dir) . '/';
            $opath2   = realpath($prevdir) . '/';
            $dest     = $opath2 . $photo;
            $source   = $opath1 . $photo;
            $phpThumb = new phpThumb();
            $phpThumb->setSourceFilename($source);
            if (!empty($width))
                $phpThumb->setParameter('w', $width);
            if (!empty($height))
                $phpThumb->setParameter('h', $height);
            if ($ext == 'png')
                $phpThumb->setParameter('f', 'png');
            if (!empty($zc)) {
                $phpThumb->setParameter('zc', '1');
            }
            $phpThumb->setParameter('q', 100);
            if ($phpThumb->GenerateThumbnail()) {
                if ($phpThumb->RenderToFile($dest)) {
                    $img = $prevdir . '/' . $photo;
                } else {
                    return '/public/image/default/no-image.png';
                }
            }
        } elseif (is_file($catimg)) {
            $img = $prevdir . '/' . $photo;
        } else {
            return '/public/image/default/no-image.png';
        }
        return $img;
    }
} 



if (!function_exists('to_url_title')) {
    function to_url_title($str, $separator = 'dash', $lowercase = FALSE)
    {
        if ($separator == 'dash') {
            $search  = '_';
            $replace = '-';
        } else {
            $search  = '-';
            $replace = '_';
        }

        $trans    = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );
        $translit = array(
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "c",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "",
            "ы" => "y",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "А" => "a",
            "Б" => "b",
            "В" => "v",
            "Г" => "g",
            "Д" => "d",
            "Е" => "e",
            "Ж" => "zh",
            "З" => "z",
            "И" => "i",
            "Й" => "y",
            "К" => "k",
            "Л" => "l",
            "М" => "m",
            "Н" => "n",
            "О" => "o",
            "П" => "p",
            "Р" => "r",
            "С" => "s",
            "Т" => "t",
            "У" => "u",
            "Ф" => "f",
            "Х" => "h",
            "Ц" => "c",
            "Ч" => "ch",
            "Ш" => "sh",
            "Щ" => "sch",
            "Ъ" => "",
            "Ы" => "y",
            "Ь" => "",
            "Э" => "e",
            "Ю" => "yu",
            "Я" => "ya",
            " " => "-",
            "," => ""
        );
        $str      = strtr($str, $translit);
        $str      = strip_tags($str);
        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }
        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }
        return trim(stripslashes($str));
    }
}

if (!function_exists('print_arr')) {
    function print_arr($array)
    {
        echo "<pre>" . print_r($array, true) . "</pre>";
    }
}

if (!function_exists('clear1')) {
    function clear1($str, $type = '0')
    {
        $str = trim($str);
        if ($type == 'email') {
            if (filter_var($str, FILTER_VALIDATE_EMAIL) === false) {
                $str = "";
            }
        } else if ($type == 1 or $type == 'int') {
            $str = intval($str);
        } else if ($type == 2 or $type == 'float') {
            $str = str_replace(",", ".", $str);
            $str = floatval($str);
        } else if ($type == 3 or $type == 'regx') {
            $str = preg_replace("/[^a-zA-ZА-Яа-я0-9.,!\s]/", "", $str);
        } else if ($type == 'alias') {
            $str = preg_replace("/[^a-zA-Z0-9_-\s]/", "", $str);
        } else if ($type == 4 or $type == 'text') {
            $str = str_replace("'", "&#8242;", $str);
            $str = str_replace("\"", "&#34;", $str);
            $str = stripslashes($str);
            $str = htmlspecialchars($str);
        } else {
            $str = strip_tags($str);
            $str = str_replace("\n", " ", $str);
            $str = str_replace("'", "&#8242;", $str);
            $str = str_replace("\"", "&#34;", $str);
            $str = preg_replace('!\s+!', ' ', $str);
            $str = stripslashes($str);
            $str = htmlspecialchars($str);
        }
        return $str;
    }
}


if (!function_exists('to_month')) {
    function to_month($date)
    {
        $_nr_month = date('m', $date);
        switch ($_nr_month) {
            case '01':
                $m = 'янв.';
                break;
            case '02':
                $m = 'фев.';
                break;
            case '03':
                $m = 'март.';
                break;
            case '04':
                $m = 'апр.';
                break;
            case '05':
                $m = 'май';
                break;
            case '06':
                $m = 'июн.';
                break;
            case '07':
                $m = 'июл.';
                break;
            case '08':
                $m = 'авг.';
                break;
            case '09':
                $m = 'сент.';
                break;
            case '10':
                $m = 'окт.';
                break;
            case '11':
                $m = 'нояб.';
                break;
            case '12':
                $m = 'дек.';
                break;
            default:
                $m = $to_date;
                break;
        }
        return date('d ' . $m . ' Y', $date);
    }
}
    if (!function_exists('_current_url_lang')) {
        function _current_url_lang($url)
        {
            $a = array_slice(explode('/', $url), 1);
            $b = implode('/', $a);
            return $b;
        }
    }

    if (!function_exists('random_string')) {
        function random_string($length)
        {
            $key  = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));
            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            return $key;
        }
    }

    if (!function_exists('getRealIpAddr')) {
        function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) // Определяем IP
                {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
    }

    if (!function_exists('explode_delimiter')) {
        function explode_delimiter($arr)
        {
            $_explode = explode('|', $arr);
            return $_arr = array_filter($_explode, function($v)
            {
                return !empty($v);
            });
        }
    }

    if (!function_exists('clear_arr')) {
        function clear_arr($arr)
        {
            return $_arr = array_filter($arr, function($v)
            {
                return !empty($v);
            });
        }
    }
 

if (!function_exists('send_mail')) {
    // SEND MESSAGES
    function send_mail($mail_to, $thema, $html2, $logo_name = 'logo.png') {
        $em='info@'.$_SERVER['SERVER_NAME'];
        $name = "Nr1";
        $from = $name.'<'.$em.'>';
        $html = 
            '<html>
                <head>
                    <title>'.$thema.'</title>
                </head>
                <body> 
                    <div style="margin:0; padding:10px; background-color:#F2F2F2;">'. 
                        '<div style="width:500px; margin:0 auto; margin-top:10px; padding:15px; margin-bottom:10px; background-color:#fff; border-bottom:2px solid #D8D6D1;">'.
                            '<p style="text-align:left; border-bottom: 1px solid #D8D6D1; padding-bottom: 25px;">'.
                                '<a href="http://'.$_SERVER['SERVER_NAME'].'"><img src="http://'.$_SERVER['SERVER_NAME'].'/image/meridian_logo2.png" style="max-height: 65px;"></a>'.
                            '</p>'.
                            '<p style="height:10px;"></p>'.
                            $html2.
                            '<p style="min-height:10px"></p>'.
                        '</div>'.
                        '<p style="color:#9ca1ae;font-size:12px;font-weight:300;text-align:center;margin-bottom:10px;">© '.date("Y").' <a href="http://'.$_SERVER['SERVER_NAME'].'" style="color:#777" target="_blank">'.$_SERVER['SERVER_NAME'].'</a></p>'.
                    '</div>
                </body>
            </html>';

        $CI = &get_instance();

        $CI->load->library('email');

        $config = Array(         
                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8',
                    'protocol' => 'mail',
                    'smtp_host' => 'mail.russianmeridian.com',
                    'smtp_port' => '25',
                    'smtp_user' => 'newspaper@russianmeridian.com',
                    'smtp_pass' => 'danik1998@'  
                ); 

        $CI->email->initialize($config); 

        $CI->email->from("newspaper@russianmeridian.com", $_SERVER['SERVER_NAME']);
        $CI->email->to($mail_to); 
        $CI->email->subject($thema);
        $CI->email->message($html); 
        $CI->email->send();
    }
}

if (!function_exists('display_404')) {
    function display_404()
    {
        header("Location:" . base_url('display_404'));
        exit();
    }
}

if (!function_exists('getInput')) {
    function getInput($value = null, $field_label, $field_name, $field_type = false, $field_gen, $ck = false, $array = false){
        if (!empty($array)) {
            extract($array);
        }

        $field_col = !empty($field_col) ? $field_col : 'col-sm-11';
        $label_col = !empty($label_col) ? $label_col : 'col-sm-1';

        $form_control = '';
        switch ($field_gen) {
            case 'input': 
                
                $input_val = !empty($value[$field_name]) ? $value[$field_name] : null;
                $form_control .= '<div class="form-group lang-area">
                           <label class="'.$label_col.' control-label">'.$field_label.'</label>
                           <div class="'.$field_col.'">
                              <input type="'.$field_type.'" class="form-control" id="'.@$id.'" name="'.$field_name.'" value="'.$input_val.'"> 
                           </div>
                        </div>'; 
                
                break;

            case 'textarea':  
                $input_val = !empty($value[$field_name]) ? $value[$field_name] : null;
                if (!$ck) {
                    $input_val = strip_tags($input_val);
                }
                $form_control .= '<div class="form-group lang-area">
                            <label class="'.$label_col.' control-label">'.$field_label.'</label>
                            <div class="'.$field_col.'">
                                <textarea style="min-height:150px;" class="form-control '.$ck.'" name="'.$field_name.'">'.$input_val.'</textarea>  
                            </div>
                        </div>'; 
                break;
            
            default: 
                break; 
        } 

        return $form_control;
    }
}

function datetotime ($date, $format = 'YYYY-MM-DD') {

if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $date);
if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $date);
if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $date);

if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $date);
if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $date);
if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $date);

if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $date);
if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $date);
if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $date);

return mktime(0, 0, 0, $month, $day, $year);

}


    function returnData($post, $field_lang){  
        $data = array();
        foreach ($post as $key => $value) {
            foreach ($field_lang as $key2 => $value2) {
                if (isset($post[$value2])) {
                    $data[$value2] = $post[$value2];
                }
            } 
        }  
        return $data;
    }

    function getDefaultLanguage() {
       if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
          return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
       else
          return parseDefaultLanguage(NULL);
    }

    function parseDefaultLanguage($http_accept, $deflang = "en") {
       if(isset($http_accept) && strlen($http_accept) > 1)  {
          # Split possible languages into array
          $x = explode(",",$http_accept);
          foreach ($x as $val) {
             #check for q-value and create associative array. No q-value means 1 by rule
             if(preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i",$val,$matches))
                $lang[$matches[1]] = (float)$matches[2];
             else
                $lang[$val] = 1.0;
          }

          #return default language (highest q-value)
          $qval = 0.0;
          foreach ($lang as $key => $value) {
             if ($value > $qval) {
                $qval = (float)$value;
                $deflang = $key;
             }
          }
       }
       return strtolower($deflang);
    }

    function current_url2() {
        $CI =& get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
    }

    function generatePdfOneEquipment($array, $images){
        if (empty($array)) {
            return false;
        } 

        $CI =& get_instance();

        $lang = $CI->lang->lang();

        require_once "public/lib/dompdf1/dompdf_config.inc.php";
 
        $dompdf = new DOMPDF(); 
        $content = render('catalog_view', array('data' => $array, 'images' => $images, 'lang' => $lang, 'CI' => $CI));

        //exit($content);
         
        $dompdf->set_paper(array(0, 0, 1110, 900), 'portrait'); 

        $dompdf->load_html($content); 
        $dompdf->render();  
        $dompdf->stream("catalog_".date('d_m_Y').".pdf",array("Attachment"=>1));
 
    }

    function generatePdfEquipment($array){
        if (empty($array)) {
            return false;
        }

        $CI =& get_instance();

        $lang = $CI->lang->lang();

        require_once "public/lib/dompdf1/dompdf_config.inc.php";
 
        $dompdf = new DOMPDF(); 
        $content = render('catalog', array('data' => $array, 'lang' => $lang, 'CI' => $CI)); 

        //exit($content);

        $dompdf->load_html($content); 
        $dompdf->set_paper(array(0, 0, 900, 841), 'portrait');
        $dompdf->render();   
        $dompdf->stream("catalog_".date('d_m_Y').".pdf", array('Attachment' => 1));
    }

    function render($filename, $array){
        extract($array); 
        ob_start();
        include 'public/pdf/'.$filename.'.php';
        return ob_get_clean();
    }

    function setArr0($arr, $i){ 
        $new_arr = array();
        $num=0;
        foreach ($arr as $item) {
            $new_arr[$num] = $item;
            $num++;
        }

        return $new_arr[$i];
    }

    function createPath($path) {
        if (is_dir($path)) return true;
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
        $return = createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    function alertSuccess($msg = 0, $session=false){  

        if ($session == true) {
            $_SESSION['msg'] = '<div class="alert alert-success">'.$msg.'</div>';
        }
 
        echo json_encode(array('msg' => $msg));   
        exit();
    } 

    function alertError($msg = 0, $session=false){ 
        if ($session == true) {
            $_SESSION['msg'] = '<div class="alert alert-danger">'.$msg.'</div>';
        }

        echo json_encode(array('msg' => "error", 'cause' => $msg));  
        exit();  
    } 

    function checkLogin(){ 
        $CI =& get_instance();
        $session = !empty($_SESSION['user']['sess']) ? $_SESSION['user']['sess'] : '';
        $userdata = $CI->db->where('sess', $session)
                       // ->where('type', '2') 
                        ->limit('1')
                        ->where('confirm', '1')
                        ->get('users')
                        ->row_array();  

                        ///exit(print_r($session));

        if (!empty($userdata) && is_array($userdata)) {   
            $_SESSION['user'] =  $userdata; 
           return true;
        }   
        return false;
    }

    function checkPrivate($db, $id){ 
        if (empty($_SESSION['user']['id'])) {
            return false;
        }
        $CI =& get_instance();
        $result = $CI->db->where('id_user', intval($_SESSION['user']['id']))->where('id', $id)->get($db)->result_array(); 
        if (!empty($result)) {    
           return true;
        }   
        return false;
    }

    function generatePassowrd(){
        $str = "234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
      
        $pass = '';
          
        for($i = 0; $i < 6; $i++) {
            $x = mt_rand(0,(strlen($str)-1));

        if($i != 0) {
            if(@$pass[strlen($str)-1] == @$str[$x]) {
                $i--;
                continue;
            }
        }
            $pass .= $str[$x];
        }

        return strtolower($pass);
    }

    function clear($str){
        $CI =& get_instance();
        return $CI->security->xss_clean($str);
    }

    function breadcrumbs($array, $id){
        if(!$id) return false;  
         
        $breadcrumbs_array = array();
        for($i = 0; $i < count($array); $i++){
            if(isset($array[$id])){
                $breadcrumbs_array[$array[$id]['id']] = $array[$id]['name']; 
                $id = $array[$id]['parent_id'];
            }else break;
        }
        return array_reverse($breadcrumbs_array, true);
    }

    function cats_id($array, $id){
        if(!$id) return false;
        $data = '';
        foreach($array as $item){
            if($item['parent_id'] == $id){
                $data .= $item['id'] . ",";
                $data .= cats_id($array, $item['id']);
            }
        }
        return $data;
    }

    function uploadMultiFile($files, $array_name, $more_config = FALSE, $return_type, $delimiter = '', $array = array()) {
        $CI =& get_instance();
        if (is_array($more_config))
            extract($more_config);
       

        $config['upload_path']   = $path ? $path : $path = 'public/global_public_img/default';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['encrypt_name']  = TRUE;

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
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

                if (!$CI->upload->do_upload($array_name)) {
                    return array(
                        'error' => true,
                        'msg' => $CI->upload->display_errors()
                    );
                }
                 
                $tmp_data = $CI->upload->data();

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
            }
        }

        return array(
            'error' => false,
            'msg' => empty($array) ? $delimiter : $array
        );
    } 

    function doUpload($input, $config, $_resize = FALSE) {
        $CI =& get_instance();
        if ($_FILES[$input]['error'] == 0) {
            $CI->load->library('upload', $config);
            if (!$CI->upload->do_upload($input)) {
                return array(
                    'response' => $CI->upload->display_errors()
                );
            } else {
                $data = $CI->upload->data('file_name');
                return array(
                    'response' => TRUE,
                    'image' => $data['raw_name'] . $data['file_ext']
                );
            }
        } else {
            return false;
        }
    } 

    function checkIfNeedView($array){
        $new_array=array();
        foreach ($array as $item) {
            if (!empty($item['is_actual']) && !empty($item['view']) && $item['time_over'] > time()) {
                if ($item['type']=='pay' && $item['status'] == '2' && $item['confirm'] == '1') {
                    $new_array[] = $item;
                }elseif ($item['type']=='free' && $item['confirm'] == '1') {
                    $new_array[] = $item;
                }
            } 
        } 
        return $new_array;
    }

    if (!function_exists('countPercent')) {
        function countPercent($from, $percent){
            return ($from*$percent) /100;
        }
    }