 
    
     
            
              <?php if (!empty($faq)): ?>  
                  <?php foreach ($faq as $item): ?> 
                    <div class="col-md-6">
                      <section class="box-categories">
                        <h1 class="section-title h4 clearfix">
                          <i class="fa fa-folder-open-o fa-fw text-muted"></i>
                          <small class="pull-right"><i class="fa fa-hdd-o fa-fw"></i> <?=count($item['childs'])?></small>
                          <?=$item['cat_name']?>
                        </h1>
                        <ul class="fa-ul">
                          <?php $num = '0'; ?>
                          <?php foreach ($item['childs'] as $value): ?>
                            <?php 
                                if ($num == (var_question_num_home ? var_question_num_home : 2)) { 
                                  break 1;
                                }
                              ?>
                            <li>
                              <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                              <h3 class="h5"><a href="/faq/<?=$value['url']?>/"><?=$value['question']?></a></h3>
                            </li>
                            <?php $num ++; ?>
                          <?php endforeach ?> 
                        </ul>
                        <?php if (count($item['childs']) > 4): ?>
                          <p class="more-link text-center"><a href="/cat/<?=$item['id']?>/" class="btn btn-custom btn-xs"><?=VIEW_ALL?></a></p>
                        <?php endif ?> 
                      </section>
                    </div>  
                  <?php endforeach ?>  
              <?php endif ?>

              <section class="section">
                <div class="banner-wrapper banner-horizontal clearfix">
                  <h4 class="banner-title h3"><?=NMS_TTL?></h4>
                  <div class="banner-content">
                    <?=NMS_DSC?>
                  </div>
                  <p><a href="#" id="order_callback" class="btn btn-custom"><?=CN_BUTTON?></a></p>
                </div>
              </section>
<!--
              <div class="row">

                <div class="col-md-6">
                  <section id="section-lastest-responses" class="section">
                    <h2 class="section-title h4 clearfix">Latest Responses</h2>
                    <ul class="fa-ul">
                      <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5"><a href="#">How Do I Download The Andoird App?</a></h3>
                        <small class="meta text-muted">
                          <span class="time"><i class="fa fa-clock-o fa-fw"></i> about 9 hours ago</span>
                          <span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="#">Mobile Apps</a></span>
                        </small>
                      </li> 
                    </ul>
                  </section> 
                </div>

                <div class="col-md-6">
                  <section id="section-lastest-articles" class="section">
                    <h2 class="section-title h4 clearfix">Latest Articles</h2>
                    <ul class="fa-ul">
                      <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5"><a href="#">Using Javascript</a></h3>
                        <small class="meta text-muted">
                          <span class="time"><i class="fa fa-clock-o fa-fw"></i> about 9 hours ago</span>
                          <span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="#">Customization</a></span>
                        </small>
                      </li> 
                    </ul>
                  </section> 
                </div>

              </div> #content -->
         