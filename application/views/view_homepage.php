			<!-- START of main area !-->
			<div class="main-area">
				<div class="slider">
					<div class="slider-cnt">
						<ul>
						<?php if($features):foreach($features as $feature): ?>
							<li>
								<a href="/games/<?php echo $feature->slug ?>"><img src="/games/slides/<?php echo $feature->feature_slug ?>.png" alt="<?php echo $feature->title ?>" /></a>
								<div class="slide-cnt">
									<div class="slide-cnt-inner">
										<div class="slide-top">
											<div class="rating">
												<div class="rate">
													<span style="width: <?php echo round(@($feature->rating_sum/$feature->rating_count*10)); ?>%"></span>
												</div>
											</div>
											
											<p><a href="/games/<?php echo $feature->slug ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $feature->slug ?>"></a></p>
										</div>
										
										<p><?php echo $feature->feature_body ?>  <a href="/games/<?php echo $feature->slug ?>">Play Now</a><?php if ($this->ion_auth->is_admin()): ?> / <a href="/admin/edit_blog_feature/<?php echo $feature->feature_slug ?>" class="iframe">Edit</a><?php endif; ?></p>
									</div>
								</div>
							</li>
						<?php endforeach; endif; ?>
						</ul>
					</div>
					
					<div class="slider-nav">
					<?php $x=true; if($features):foreach($features as $feature): ?>
						<a href="/games/<?php echo $feature->slug ?>"<?php if($x): ?> class="active"<?php endif; $x=false; ?>>
							<img src="/games/thumbs/<?php echo $feature->slug ?>.png" alt="<?php echo $feature->title ?>" />
							<?php echo $feature->feature_name ?>
						</a>
					<?php endforeach; endif; ?>
					</div>
				</div>
				
				<div class="banner-area" style="text-align: center">
					<div class="banner-holder"><br />
					<script type="text/javascript"><!--
					google_ad_client = "ca-pub-9895790277374361";
					/* KTZ Home Box */
					google_ad_slot = "7259413401";
					google_ad_width = 300;
					google_ad_height = 250;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
					</div>
					<h1>ZOMBIE GAMES</h1>
				</div>
				<div class="cl">&nbsp;</div>
			</div>
			<!-- END of main area !-->
			
			<!-- START of featured !-->
			<?php /*
			<div class="featured">
				<ul>
				<?php foreach ($folders->result_array() as $folder): ?>
					<li>
						<a href="/games/folders/<?php echo $folder['slug'] ?>">
							<span class="img-holder"><img src="/games/folders/<?php echo $folder['slug'] ?>.png" alt="" /></span>
							<strong><?php echo $folder['name'] ?></strong>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<div class="cl">&nbsp;</div>
			</div>
			*/ ?>
			<!-- END of featured !-->
			
			<!-- START of container !-->
			<div class="container">
				<div class="container-t">
					<div class="container-b">
						<!-- START of content !-->
						<div class="content">
						
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>MOST POPULAR GAMES</h2>
									<div class="right">
										<a href="/games/popular/" class="more-link"><span>&raquo;</span>view all</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($popular_games->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>"></a></span>
											<div class="img-holder">
												<img src="/games/thumbs/<?php echo $game['slug']; ?>.png" alt="<?php echo $game['title']; ?>" />
												<div class="rating">
													<span>
														<em style="width: <?php echo round(@($game['rating_sum']/$game['rating_count']*10)); ?>%"></em>
													</span>
												</div>
											</div>
											<a href="/games/<?php echo $game['slug']; ?>"><?php echo $game['title']; ?></a>
										</li>
									<?php endforeach; ?>
									</ul>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of section !-->
						
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>NEWEST ZOMBIE GAMES</h2>
									<div class="right">
										<a href="/games/newest/" class="more-link"><span>&raquo;</span>view all</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($new_games->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>"></a></span>
											<div class="img-holder">
												<img src="/games/thumbs/<?php echo $game['slug']; ?>.png" alt="<?php echo $game['title']; ?>" />
												<div class="rating">
													<span>
														<em style="width: <?php echo round(@($game['rating_sum']/$game['rating_count']*10)); ?>%"></em>
													</span>
												</div>
											</div>
											<a href="/games/<?php echo $game['slug']; ?>"><?php echo $game['title']; ?></a>
										</li>
									<?php endforeach; ?>
									</ul>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of section !-->
							
							<?php if (@$playing_games): ?>
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>GAMES CURRENTLY BEING PLAYED</h2>
									<div class="right">
										<a href="/games/current/" class="more-link"><span>&raquo;</span>view all</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($playing_games->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>"></a></span>
											<div class="img-holder">
												<img src="/games/thumbs/<?php echo $game['slug']; ?>.png" alt="<?php echo $game['title']; ?>" />
												<div class="rating">
													<span>
														<em style="width: <?php echo round(@($game['rating_sum']/$game['rating_count']*10)); ?>%"></em>
													</span>
												</div>
											</div>
											<a href="/games/<?php echo $game['slug']; ?>"><?php echo $game['title']; ?></a>
										</li>
									<?php endforeach; ?>
									</ul>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of section !-->
							<?php endif; ?>
							
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>TOP RATED GAMES</h2>
									<div class="right">
										<a href="/games/top/" class="more-link"><span>&raquo;</span>view all</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($top_games->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>"></a></span>
											<div class="img-holder">
												<img src="/games/thumbs/<?php echo $game['slug']; ?>.png" alt="<?php echo $game['title']; ?>" />
												<div class="rating">
													<span>
														<em style="width: <?php echo round(@($game['rating_sum']/$game['rating_count']*10)); ?>%"></em>
													</span>
												</div>
											</div>
											<a href="/games/<?php echo $game['slug']; ?>"><?php echo $game['title']; ?></a>
										</li>
									<?php endforeach; ?>
									</ul>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of section !-->
							
							<?php if($blog):foreach($blog as $post): ?>
  
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2><a href="/blog/post/<?php echo $post->entry_slug ?>"><?php echo $post->entry_name; ?></a></h2>
									<div class="right">
										<a href="/games/<?php echo $post->slug; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $post->slug ?>" class="comments-link"></a>
										<?php if ($this->ion_auth->is_admin()): ?>
										<span>//</span>
										<a href="/admin/edit_blog_entry/<?php echo $post->entry_slug ?>" class="iframe">Edit Blog Post</a>
										<?php endif; ?>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="section-img">
									<a href="/games/<?php echo $post->slug; ?>"><img src="/games/headings/<?php echo $post->entry_slug; ?>.png" alt="" /></a>
								</div>
								
								<p><?php echo str_replace(PHP_EOL, '<br />', $post->entry_body); ?>
								<?php if (!empty($post->entry_body_extended)): ?> 
								<a href="/blog/<?php echo $post->entry_slug; ?>">&raquo; Continue Reading</a>
								<?php endif; ?>
								</p>
								<?php if ($post->game_id > 0): ?>
								<a href="/games/<?php echo $post->slug; ?>" class="btn alignright">play <?php echo $post->title; ?></a>
								<?php endif; ?>
								<div class="cl">&nbsp;</div>
							</div>
							<!-- END of section !-->

							<?php endforeach; endif; ?>
							
							<div class="paging">
								<?php echo $pagination ?>
							</div>
							
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
						
						<div class="cl">&nbsp;</div>
					</div>
				</div>
			</div>
			<!-- END of container !-->
			
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'killthezombies';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>