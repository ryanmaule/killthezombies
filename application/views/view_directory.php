<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2><?php echo $title ?></h2>
									<div class="right"><?php echo $total; ?> Games</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($games->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>"></a></span>
											<div class="img-holder">
												<img src="/games/thumbs/<?php echo $game['slug']; ?>.png" alt="<?php echo $game['title']; ?>" width="104" height="95" />
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
							
							<div class="paging">
								<?php echo $pagination ?>
								<div class="cl">&nbsp;</div>
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