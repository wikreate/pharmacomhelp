<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<!-- <link href="/theme/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/> -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
         <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="/theme/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
 
<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/jquery-multi-select/css/multi-select.css"/>

<link rel="stylesheet" type="text/css" href="/theme/theme/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>

<link href="/css/loader.css" rel="stylesheet" type="text/css">

<link href="/theme/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN THEME STYLES -->
<link href="/theme/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="/theme/theme/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="/theme/theme/assets/admin/layout/css/mine.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>


<?php 
       
      $uri3 = $this->uri->segment(3);   
      $uri2 = $this->uri->segment(2);
      if ($this->uri->segment(1) == 'cp' && empty($uri2)) {
         $uri2 = 'menu';
      } 
        
      $menu = array(
            'menu' => array(
                  'name' => 'Разделы сайта', 
                  'icon' => '<i class="fa fa-bars" aria-hidden="true"></i>',
                  'link' => '/cp/menu/',
                  'edit' => 'Редактировать',
                  'childs' => array(
                        'edit'
                     )
               ),
 
            'faq' => array(
                  'name' => 'F.A.Q', 
                  'icon' => '<i class="fa fa-question-circle" aria-hidden="true"></i>',
                  'link' => '/cp/faq/',
                  'edit' => 'Редактировать',
                  'childs' => array(
                        'edit'
                     )
               ),

            'categories' => array(
                  'name' => 'Категории', 
                  'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>',
                  'link' => '/cp/categories/',
                  'edit' => 'Редактировать',
                  'childs' => array(
                        'edit'
                     )
               ), 
 
            'constants' => array(
                  'name' => 'Константы', 
                  'icon' => '<i class="fa fa-anchor" aria-hidden="true"></i>',
                  'link' => '/cp/constants/',
                  'edit' => 'Редактировать' 
               ),

            'settings' => array(
                  'name' => 'Настройки', 
                  'icon' => '<i class="fa fa-sliders" aria-hidden="true"></i>',
                  'link' => '/cp/settings/',
                  'edit' => 'Редактировать' 
               ) 
         );

 ?>
 
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
   <!-- BEGIN HEADER INNER -->
   <div class="page-header-inner">
      <!-- BEGIN LOGO -->
      <div class="page-logo">
         <!-- <a href="/" target="blank">
         <img src="/img/admin_logo.png" alt="logo" style="width:95px; margin:9px 0 0 0;" class="logo-default"/>
         </a> -->
         <div class="menu-toggler sidebar-toggler hide">
            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
         </div>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      </a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
         <ul class="nav navbar-nav pull-right"> 
            <li class="dropdown dropdown-user">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                
               <span class="username username-hide-on-mobile">
               <?=ucfirst($_SESSION['admin_user']['login'])?> </span>
               <i class="fa fa-angle-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-menu-default">
                  <li>
                     <a href="/cp/settings/">
                     <i class="icon-user"></i> My Profile </a>
                  </li>
                  
                  <li>
                     <a href="/cp/logout">
                     <i class="icon-key"></i> Log Out </a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            
            <!-- END QUICK SIDEBAR TOGGLER -->
         </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
   </div>
   <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
   <!-- BEGIN SIDEBAR -->
   <div class="page-sidebar-wrapper">
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->
         <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
         <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
         <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
         <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
         <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
         <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
         <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler">
               </div>
               <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
          
            <li class="sidebar-search-wrapper"><br></li>
            <?php foreach ($menu as $key => $value): ?>
               <?php if ($uri2 == $key) { $active = 'active'; }else{ $active = ''; } ?> 
 
               <li class="start <?=$active?>"> 
                  <a href="<?=$value['link']?>">
                  <?=$value['icon']?>
                  <span class="title"><?=$value['name']?></span>
                  
                  </a> 
               </li> 
            <?php endforeach ?> 
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
   </div>
   <!-- END SIDEBAR -->
   <!-- BEGIN CONTENT -->

   <div class="page-content-wrapper">
      <div class="page-content"> 
         <!-- BEGIN PAGE HEADER-->
         <h3 class="page-title">
            <?=$menu[$uri2]['name']?>
         </h3>
         <div class="page-bar">
            <ul class="page-breadcrumb">
               <li>
                  <i class="fa fa-home"></i>
                  <a href="<?=$menu[$uri2]['link']?>"><?=$menu[$uri2]['name']?></a>
                  <?php if ($uri3): ?>
                     <i class="fa fa-angle-right"></i>
                  <?php endif ?> 
               </li>
               <?php if ($uri3): ?>
                  <li>
                     <a href="javascript:;" style="text-decoration:none; cursor:pointer;"><?=!empty($crumb2) ? $crumb2 : $menu[$uri2]['edit']?></a> 
                  </li> 
               <?php endif ?> 
            </ul> 
         </div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         {content}
         <!-- END PAGE CONTENT-->
      </div>
   </div>
 
   <!-- END CONTENT -->
   <!-- BEGIN QUICK SIDEBAR -->
   <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
 
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  
   <div class="scroll-to-top">
      <i class="icon-arrow-up"></i>
   </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/theme/theme/assets/global/plugins/respond.min.js"></script>
<script src="/theme/theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="/theme/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="/theme/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/theme/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 

<script type="text/javascript" src="/theme/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<script type="text/javascript" src="/theme/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script> 
<script src="/theme/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.ru.js" type="text/javascript"></script>

<script src="/theme/theme/assets/admin/pages/scripts/components-pickers.js"></script>

<script src="/theme/theme/assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
 
<script type="text/javascript" src="/theme/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>

<script type="text/javascript" src="/theme/theme/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>

<script type="text/javascript" src="/theme/theme/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>


<script type="text/javascript" src="/theme/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/select2/select2.min.js"></script>
 

 <script src="/theme/theme/assets/admin/pages/scripts/table-editable.js"></script>

<!-- END CORE PLUGINS -->
<script src="/theme/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/theme/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/theme/theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/theme/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/theme/theme/assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="/theme/theme/assets/admin/pages/scripts/components-dropdowns.js"></script>
 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript" src="/theme/theme/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/theme/theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<!-- personal scripts --> 
<script src="/theme/theme/assets/admin/layout/multiCategory/jquery.nestable.js"></script>
 
<script src="/public/lib/js-url/url.js"></script>
<script src="/js/main/ajax.js"></script>
<script src="/js/main/scripts.js"></script>
<script src="/js/main/load.image.js"></script>
<script src="/js/main/jquery.tablednd.js"></script>
  
<script type="text/javascript" src="/theme/theme/assets/global/plugins/ckeditor/ckeditor.js"></script>
<script>
   
      $('.fancybox-button').fancybox();

      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         QuickSidebar.init(); // init quick sidebar
         Demo.init(); // init demo features
         ComponentsPickers.init();
         ComponentsDropdowns.init();
         TableEditable.init();

         // ComponentsFormTools.init();
      });
   </script>

   <script> 

      var i = 1;
      $('#tags_1:hidden, #tags_1:visible').each(function() {
           $(this).attr('id', 'tags_1_' + i);
           
            $('#tags_1_' + i).tagsInput({
               width: 'auto',
               defaultText:'',
               minChars:0,
               'onAddTag': function () { 
               },
           });

           i = i + 1;
      }); 


      // $('#ntc_sum, #rubl').inputmask("decimal",{
      //  alias: 'numeric',
      //  radixPoint:".", 
      //      groupSeparator: " ", 
      //      digits: 2,
      //      autoGroup: true,
      //      allowMinus: false 

      //  });

      function startMaskNewInput(){
         $('.rp').each(function(i){
            $(this).attr('id', 'mask_'+i);
            $("#mask_"+i).inputmask("decimal",{
             alias: 'numeric',
             radixPoint:".", 
                 groupSeparator: " ", 
                 digits: 2,
                 autoGroup: true,
                 allowMinus: false 

             });
         });
      }

      startMaskNewInput();
        
      $("#mask_price, #mask_old_price").inputmask("decimal",{
             alias: 'numeric',
             radixPoint:".", 
                 groupSeparator: " ", 
                 digits: 2,
                 autoGroup: true,
                 allowMinus: false 

             });
   </script>

   <script type="text/javascript">
     $('select.select2').select2();
   </script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>