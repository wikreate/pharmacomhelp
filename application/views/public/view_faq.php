<article class="hentry">
	<header class="entry-header">
		<h1 class="entry-title"><?=$data['question']?></h1>

		<div class="entry-meta text-muted">
			<!-- <span class="date"><i class="fa fa-film fa-fw"></i> <time datetime="2013-09-19T20:01:58+00:00">September 19, 2013 at 8:01 pm</time></span> -->
			<span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="/cat/<?=$data['id_category']?>"><?=$data['cat_name']?></a></span>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
		
	<div class="entry-content clearfix"> 
		<?=$data['text']?>
	</div><!-- .entry-content -->
		
	<footer class="entry-footer">
		<div class="entry-attribute clearfix">
			<div class="row">
				<div class="rate-post col-sm-6">
					<ul class="list-inline pull-left">
						<li><a href="/cat/<?=$data['id_category']?>/" class="btn btn-social btn-like" title="This article was helpful"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <?=BACK_BUTTON?></a></li> 
					</ul> 
				</div>  
			</div>
		</div> 
	</footer> 
</article>

<?php if (!empty($similar)): ?>
<div class="row">
 
	<div class="col-md-12">
                  <section id="section-lastest-responses" class="section">
                    <h2 class="section-title h4 clearfix"><?=SQ_TTL?></h2>
                    <ul class="row fa-ul">
	                    <?php foreach ($similar as $item): ?>
	                    	<li>
		                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
		                        <h3 class="h5"><a href="/faq/<?=$item['url']?>/"><?=$item['question']?></a></h3>
		                        <small class="meta text-muted"> 
		                          <span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="/cat/<?=$item['id_category']?>/"><?=$item['cat_name']?></a></span>
		                        </small>
		                      </li>
	                    <?php endforeach ?> 
                    </ul>
                  </section> 
                </div> 
              </div>
    <?php endif ?>
