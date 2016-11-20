<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

$route['default_controller'] = "pages";
$route['404_override'] = '';

/*admin routes*/
$route['login']                              	= 'login/sign';
$route['cp']                                    = 'admin/menu';
  
/*login*/
$route['cp/do-login']                           = 'login/do_login';
$route['cp/logout']                             = 'login/logout';

 
$route['cp/(:any)'] = 'admin/controller/$1';
 
$route['cat/(:any)'] = 'pages/cat/$1';  
$route['faq/(:any)'] = 'pages/faq/$1';  
$route['(:any)'] = 'pages/top_menu/$1';
// $route['(:any)'] = 'pages/display_404';
  



 
 
 