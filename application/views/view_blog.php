<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">

							<div class="section">
								<div class="section-head">
									<h2>KILL THE ZOMBIES! BLOG</h2>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
								
							<?php if($blog):foreach($blog as $post): ?>
  
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2><a href="/blog/post/<?php echo $post->entry_slug ?>"><?php echo $post->entry_name; ?></a></h2>
									<div class="right">
										<a href="/games/<?php echo $post->slug; ?>/#disqus_thread" data-disqus-identifier="/games/<?php echo $post->slug ?>" class="comments-link">Comments</a>
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
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>