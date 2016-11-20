<div id="sidebar" class="site-sidebar col-md-3">
              <div class="widget-area">
              
                <section id="section-banner" class="section">
                  <div class="banner-wrapper text-center clearfix">
                    <h3 class="banner-title text-danger h4"><?=LOOKIN_FOR_TTL?></h3>
                    <div class="banner-content">
                      <?=LOOKIN_FOR_DSC?>
                    </div>
                  </div>
                </section><!-- #section-banner -->
                
                <?php if (!empty($categories)): ?>
                  <section id="section-categories" class="section">
                    <h2 class="section-title h4 clearfix"><?=CAT_TTL?></h2>
                    <ul class="nav nav-pills nav-stacked nav-categories">
                      <?php foreach ($categories as $item): ?>
                        <li><a href="/cat/<?=$item['id']?>"><span class="badge pull-right"><?=$item['sum_faq']?></span><?=$item['name']?></a></li> 
                      <?php endforeach ?> 
                    </ul>
                  </section> 
                <?php endif ?> 

                <!--<section id="section-tags" class="section">
                  <h2 class="section-title h4 clearfix">Tags</h2>
                  <div class="tagcloud">
                    <a href="#" class="btn btn-tag btn-xs">basic</a> 
                  </div>
                </section>  #section-tags -->

              </div>
            </div> 