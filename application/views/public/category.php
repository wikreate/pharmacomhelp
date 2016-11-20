<header class="archive-header">
		<h1 class="archive-title"><?=$page_title?> (<?=count($faq)?>)</h1>
	</header><!-- .archive-header -->
	
	<?php if (empty($faq)): ?>
		<blockquote class="archive-description">
			<p>No Result.</p>
		</blockquote><!-- .archive-description -->

	<?php else: ?>
		<div class="archive-list archive-article">
			<?php foreach ($faq as $item): ?>
				<article class="hentry">
					<header class="entry-header">
						<i class="fa fa-list-alt fa-2x fa-fw pull-left text-muted"></i>
						<h2 class="entry-title h4"><a href="/faq/<?=$item['url']?>/" rel="bookmark"><?=$item['question']?></a></h2>
					</header><!-- .entry-header -->
						<?php if (@$method !=='cat'): ?>
							<footer class="entry-footer">
								<div class="entry-meta text-muted">
									<!-- <span class="date"><i class="fa fa-clock-o fa-fw"></i> <time datetime="2013-10-22T20:01:58+00:00">about 5 days ago</time></span> -->
									<span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="/cat/<?=$item['id_category']?>/"><?=$item['cat_name']?></a></span>
								</div><!-- .entry-meta -->
							</footer><!-- .entry-footer -->
						<?php endif ?>
					 
				</article><!-- .hentry --> 
			<?php endforeach ?> 
		</div>  
	<?php endif ?>
	 
	
	 