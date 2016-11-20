
<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html>
<!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=!empty($meta["seo_title"]) ? @$meta["seo_title"] : @$pages["seo_title"]?></title>  
  <meta name="keyWords" content="<?=!empty($meta["seo_keywords"]) ? @$meta["seo_keywords"] : @$pages["seo_keywords"]?>">  
  <meta name="description" content="<?=!empty($meta["seo_description"]) ? strip_tags(@$meta["seo_description"]) : strip_tags(@$pages["seo_description"])?>">  
 
  <!-- Styles -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="/css/app.css" type="text/css" />
 <link rel="stylesheet" href="/css/loader.css" type="text/css" />
  <!--[if lt IE 9]>
  <script type="text/javascript" src="assets/app/js/html5shiv.min.js"></script>
  <script type="text/javascript" src="assets/app/js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
 
  <div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
      <div class="container">
      <div class="row">
        <div class="<?= var_view_notice ? 'col-md-6' : 'col-md-12' ?>">
           <div id="logo" class="site-logo text-center">
            <a href="http://pharmacomstore.org/" target="_blank" rel="home"><img src="/img/logo.png" alt="" /></a>
             
          </div><!-- #logo -->

            <br clear="all">
            <br>
            <br>
            <div class="widget-area">
              <section id="section-about" class="section">
                <h2 class="section-title h4 clearfix"><?=WELCOME_TTL?></h2>
                <div class="textwidget">
                  <?=WELCOME_DSC?>
                </div>
              </section><!-- #section-about -->
            </div> 
        </div>
        <?php if (@var_view_notice): ?>
          <div class="col-md-6">
            <div id="navbar" class="navbar-wrapper text-center">
             <section id="section-banner" class="section">
                <div class="banner-wrapper text-center clearfix">
           <!--        <h3 class="banner-title text-danger h4"><?=CN_TTL?></h3> -->
                  <div class="banner-content top-customer">
                   <?=CN_DSC?>
                  </div>
                </div>
              </section>
           </div><!-- #navbar -->
          </div>
        <?php endif ?> 
         
      </div>   
      </div>
    </header><!-- #masthead -->

    <div id="features" class="site-hero clearfix">
      <div class="container">
 <div id="header-search" class="site-search clearfix"><!-- #header-search -->
          <form action="/search/" method="get" class="search-form" role="search">
            <div class="form-border">

            <h3 class="search-header"><?=SEARCH_TTL?></h3>
            <p class="search-desc"><?=SEARCH_DSC?></p>

              <div class="form-inline">
                <div class="form-group">
                  <input type="text" name="query" value="<?=@$_GET['query']?>" autocomplete="off" class="search-field search-question ui-autocomplete-input form-control input-lg" title="Enter search term" placeholder="<?=SEARCH_PLACEHOLDER?>" />
                </div>
                <button type="submit" class="search-submit btn btn-custom btn-lg pull-right"><?=SEARCH_BTN?></button>
              </div>

            <?php if (!empty($categories)): ?>
              <div class="search-advance">
                <div class="row">

                  <div class="col-sm-6">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <label for="#" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                          <select name="category" class="form-control">
                            <option value="all">-- All Categories --</option> 
                            <?php foreach ($categories as $item): ?>
                              <?php $selected = (!empty($_GET['category']) && $_GET['category'] == $item['id']) ? 'selected' : ''; ?>
                              <option <?=$selected?> value="<?=$item['id']?>"><?=$item['name']?></option>  
                            <?php endforeach ?>  
                          </select> 
                        </div>
                      </div>
                    </div>
                  </div> 

                </div>
              </div><!-- .search-advance -->
              <?php endif ?>

              <a href="#" class="search-advance-button text-center"><i class="fa fa-chevron-circle-up fa-2x"></i></a>

            </div>
          </form>
        </div> 

        <?php if (empty($breadcrumbs)): ?>
            <?php if (!empty($pages['url']) && $pages['url'] != '/'): ?>
              <ol class="breadcrumb breadcrumb-custom">
                <li class="text">You are here: </li>
                <li><a href="/">Home</a></li>
                <li class="active"><?=$pages['name']?></li>
              </ol> 
            <?php endif ?>

          <?php else: ?>
          <ol class="breadcrumb breadcrumb-custom">
            <li class="text">You are here: </li>
            <li><a href="/">Home</a></li>
            <?=$breadcrumbs?> 
          </ol>
        <?php endif ?>
 

      </div>
    </div> 


    <div id="main" class="site-main clearfix">
      <div class="container">
  
        <div class="content-area">
          <div class="row">

            <div id="content" class="site-content col-md-9">
    
     {content}

     <section class="section">
                <div class="banner-wrapper banner-horizontal clearfix">
                  <h4 class="banner-title h3"><?=NMS_TTL?></h4>
                  <div class="banner-content">
                    <?=NMS_DSC?>
                  </div>
                  <p><a href="#" id="order_callback" class="btn btn-custom"><?=CN_BUTTON?></a></p>
                </div>
              </section>

         </div>  

             <?php $this->load->view('public/sidebar') ?>

          </div>
        </div><!-- .content-area -->
  
      </div>
    </div><!-- #main -->
    
    <footer id="colophon" class="site-footer" role="contentinfo">
      <div class="container"> 

        <div class="row" style="display:none;">
          <div class="col-md-4">
            <div class="widget-area">
              <section id="section-about" class="section">
                <h2 class="section-title h4 clearfix">About NowKnow</h2>
                <div class="textwidget">
                  <p>Vestibulum id velit cursus tortor tincidunt semper. Duis tempor, est eu pretium condimentum, mauris nunc tempus purus, eu dictum mi nibh sed arcu.</p>
                  <p>Vivamus sagittis vestibulum nisl, eu pellentesque nibh. Duis tincidunt congue sapien id adipiscing. Phasellus varius, magna a cursus aliquet, lectus felis sodales orci, a bibendum orci ipsum id libero.</p>
                </div>
              </section><!-- #section-about -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="widget-area">
              <section id="section-latest-news" class="section">
                <h2 class="section-title h4 clearfix">Latest News</h2>
                <ul class="media-list">
                  <li class="media">
                    <a class="pull-left" href="#"><img src="assets/img/file0001546486643-50x50.jpg" alt="" width="50" height="50" class="media-object" /></a>
                    <div class="media-body">
                      <h4 class="media-heading h5"><a href="#">Aliquam Rhoncus Quis Mi Nec Sodales</a></h4>
                      <small class="text-muted"><i class="fa fa-calendar-o fa-fw"></i> October 22, 2013</small>
                    </div>
                  </li>
                  <li class="media">
                    <a class="pull-left" href="#"><img src="assets/img/file1481297121044-50x50.jpg" alt="" width="50" height="50" class="media-object" /></a>
                    <div class="media-body">
                      <h4 class="media-heading h5"><a href="#">Ut Elementum Nisi Et Congue Facilisis</a></h4>
                      <small class="text-muted"><i class="fa fa-calendar-o fa-fw"></i> October 22, 2013</small>
                    </div>
                  </li>
                  <li class="media">
                    <a class="pull-left" href="#"><img src="assets/img/file000250130279-50x50.jpg" alt="" width="50" height="50" class="media-object" /></a>
                    <div class="media-body">
                      <h4 class="media-heading h5"><a href="#">Proin Quis Fermentum Massa</a></h4>
                      <small class="text-muted"><i class="fa fa-calendar-o fa-fw"></i> October 22, 2013</small>
                    </div>
                  </li>
                </ul>
              </section><!-- #section-latest-news -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="widget-area">
              <section id="section-newsletter" class="section">
                <h2 class="section-title h4 clearfix">Get Updates</h2>
                <div class="textwidget">
                  <p>Vivamus suscipit dictum orci in imperdiet. Nulla ut lacus nibh. Vivamus quis adipiscing libero, egestas sodales nulla. Nullam ut erat nisi.</p>
                  <form action="" method="post">
                    <div class="input-group">
                      <input type="email" class="form-control" title="Enter your email" placeholder="Your email..." />
                      <span class="input-group-btn">
                      <button type="submit" class="btn btn-custom">Subscribe</button>
                      </span>
                    </div>
                  </form>
                </div>
              </section><!-- #section-newsletter -->
            </div>
          </div>

          <div class="clearfix"></div>
          <hr />
        </div>

        <div class="row">
          <div class="site-info col-md-6">
            <p class="text-muted">Copyright &copy; <?=date('Y')?> <a href="#"><?=SITE_NAME?></a>. All Rights Reserved.</p>
          </div><!-- .site-info -->
 
        </div>

      </div>
    </footer><!-- #colophon -->
      
  </div><!-- #page -->

  <!-- Script -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="/js/autocomplete/typeahead.bundle.min.js"></script>
  <script type="text/javascript" src="/js/superfish.js"></script> 
  <script type="text/javascript" src="/js/responsive.js"></script> 
  <script type="text/javascript" src="/js/code.js"></script>
  <script type="text/javascript" src="/js/public/layout.js"></script>
 
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="fog2">
   <div class="modal-callback center_magic">
      <div class="close2" onclick="$('.fog2').fadeOut(100);"></div>
        <h1><?=GIT_TTL?></h1>
        <form class="send-request onsubmit form-horizontal" action="/callback/" data-redirect="/">
            <div id="error-respond">error</div>
            <div class="form-group">
              <input type="text" name="email" placeholder="Please enter your email address here *" class="form-control">
            </div>
             
            <div class="form-group">
              <textarea name="text" id="" 
              placeholder="Our inbox can’t wait to get your messages, write us anytime!

P.S. We we’ll reach out by email. Please make sure always to check your spam/junk folder." class="form-control callback_txt"></textarea> 
            </div> 

            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="<?=RECAPTCHA?>"></div>
            </div> 
             
            <button type="submit" id="submit-btn" class="btn btn-custom"><?=SEND_BUTTON?></button>
        </form>
    </div>
</div>
<div id="success-respond"></div>
 
</body>
</html>