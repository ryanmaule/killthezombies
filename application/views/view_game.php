<?php
$mode = $this->uri->segment(3);

if ($fullscreen && empty($mode)) {
	//$mode = 'fs';
}
if ($mode=='fs') {
	$ratio = $height/$width;
	$width = 940;
	//$width = 800;
	$height = round($width*$ratio);
} 
$data->width = $width;
$data->height = $height;
$this->load->view('inc_content_header.php',$data);
$rating = @($rating_sum/$rating_count);
$rating = round($rating);
?>

<style>
#g { width: <?php echo $width-2 ?>px; height: <?php echo $height ?>px; background-color: #000000; border: 1px solid #d0d0d0; }
</style>

						<!-- START of content !-->
						<div class="<?php echo $width>620 ? 'content-full' : 'content'; ?>">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<img itemprop="image" src="http://www.killthezombies.com/games/thumbs/<?php echo $slug; ?>.png" align="left" height="40" style="margin-right: 5px;" />
									<div class="left">
										<h2 itemprop="name"><?php echo $title ?></h2><br />
										<input type="hidden" id="game_id" name="game_id" value="<?php echo $game_id ?>" />
										<div style="float:left;" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
										<?php $i=1; while ($i<=10): ?>
										<input name="star" type="radio" class="star {split:2}" value="<?php echo $i ?>"<?php if ($i==$rating) echo ' checked="checked"'; ?> />
										<?php $i++; endwhile; ?>
<script type="text/javascript">
$('.star').rating({
	callback: function(value, link){
		$.ajax({url: '/games/rate/'+$('#game_id').val()+'/'+value});
	}
});
</script>
											<meta itemprop="ratingValue" content="<?php echo round(@($rating_sum/$rating_count*10))/20; ?>" />
											<meta itemprop="ratingCount" content="<?php echo $rating_count; ?>" />
										</div><br clear="all" />
										&nbsp;&nbsp;Played <?php echo $numplayed; ?> Times
										<meta itemprop="interactionCount" content="UserPlays:<?php echo $numplayed ?>"/>
									</div>
									<div class="right">
										<?php if ($this->ion_auth->is_admin()): ?>
											<a class="btn iframe" href="/admin/game/<?php echo $slug ?>">Edit Game</a>
										<?php endif; ?>
										<?php if ($fullscreen): ?>
											<?php if ($mode=='fs'): ?>
											<a class="btn" href="/games/<?php echo $slug ?>/sm">Optimized Mode</a>
											<?php else: ?>
											<a class="btn" href="/games/<?php echo $slug ?>/fs">Full Screen</a>
											<?php endif; ?>
										<?php endif; ?>
										<a class="btn" href="/">PLAY MORE ZOMBIE GAMES</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if ($width>620): ?>
								<div id="game_banner" style="float:auto;">
								<div style="margin:0 auto; width: 728px;">
								<script type="text/javascript"><!--
								google_ad_client = "ca-pub-9895790277374361";
								/* KTZ 728 */
								google_ad_slot = "3985959785";
								google_ad_width = 728;
								google_ad_height = 90;
								//-->
								</script>
								<script type="text/javascript"
								src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
								</div>
								</div>
								<div class="cl">&nbsp;</div><br />
								<?php endif; ?>
								
								<div id="g" width="<?php echo $width ?>"></div>
								<?php
								// Allow support for loading externally hosted games
								if (is_null($exturl)) {
									$src = '/games/'.$slug.'.swf';
								} else {
									$src = $exturl;
								}
								?>
								<script type="text/javascript">
								$(document).ready(function(){
								    $('#g').flash({
								        src: '<?php echo $src ?>',
								        width: <?php echo $width ?>,
								    	height: <?php echo $height ?>,
								    	wmode: 'transparent',
								    	bgcolor: '#000000'
								    });
								});
								</script>
								
					            <div class="share">
					                <a class="share-btn" href="<?php echo @$short_url->id ?>" data-permalink="<?php echo current_url() ?>">Share</a>
					                <div class="share-box">
					                	<div class="share-box-inside clearfix">
					            			<input class="shortlink" type="text" readonly="" value="<?php echo @$short_url->id ?>">
					            			<div class="plusone-btn"><div class="g-plusone"  data-size="medium" data-count="true" data-href="<?php echo current_url() ?>"></div></div>
					            			<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo current_url() ?>" data-text="" data-count="none" data-via="killthezomb">Tweet</a>
					            			<br clear="all" />
					            			<div class="like-button"><iframe class="facebook-like-button" src="http://www.facebook.com/plugins/like.php?href=<?php echo current_url() ?>&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px;" allowTransparency="true"></iframe></div>
					                    <br clear="all" />
					            		</div><!-- /.share-box-inside -->
					            	</div><!-- /.share-box -->
					            </div>
<script>
(function(f){f(document).ready(function(){f(".share-btn").live("click",function(u){u.preventDefault();f(".share-box:not(this)").hide();var t=f(this).attr("data-permalink");var w=f(this).next(".share-box");var v=w.find(".like-button");var s=w.find(".plusone-btn");w.show().find(".shortlink").focus();if(s.length>0){var r=f(this).closest(".post").attr("id");gapi.plusone.go(r)}if(v.length>0){v.replaceWith('<iframe class="facebook-like-button" src="http://www.facebook.com/plugins/like.php?href='+t+'&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px;" allowTransparency="true"></iframe>')}});f(document).mousedown(function(r){if(!f(r.target).parents(".share-box").get(0)){f(".share-box").hide()}});})});
</script>
<script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js"></script>
								
								<div id="game_banner">
								
								<?php if ($width>620): ?>
								<div style="margin:0 auto; width: 728px;">
								<script type="text/javascript"><!--
								google_ad_client = "ca-pub-9895790277374361";
								/* KTZ 728 */
								google_ad_slot = "3985959785";
								google_ad_width = 728;
								google_ad_height = 90;
								//-->
								</script>
								<script type="text/javascript"
								src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
								</div>
								<?php else: ?>
								<div style="margin:0 auto; width: 468px;">
								<script type="text/javascript"><!--
								google_ad_client = "ca-pub-9895790277374361";
								/* KTZ 468 */
								google_ad_slot = "0669633727";
								google_ad_width = 468;
								google_ad_height = 60;
								//-->
								</script>
								<script type="text/javascript"
								src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
								</div>
								<?php endif; ?>
								
								</div>
								
								<div class="cl">&nbsp;</div>
								<p itemprop="description" id="game_description">
								<strong>Controls:</strong><br />
								<?php echo str_replace(PHP_EOL, '<br />', $instructions) ?></p>
								<p><?php echo str_replace(PHP_EOL, '<br />', $description) ?></p>
								<a href="#disqus_thread">Comment On This Game</a>
								<div itemprop="author" itemscope itemtype="http://schema.org/Organization">
									<a itemprop="url" href="http://www.killthezombies.com"><span itemprop="name">Kill The Zombies!</span></a>
								</div>
								
							</div>
							<!-- END of section !-->
							
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>PLAY SIMILAR GAMES</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($similar->result_array() as $game): ?>
										<li>
											<span class="comments-num"><a href="/games/<?php echo $game['slug']; ?>#disqus_thread" data-disqus-identifier="/games/<?php echo $game['slug'] ?>">Comments</a></span>
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
									
								<div id="disqus_thread"></div>
								<script type="text/javascript">
								    var disqus_shortname = 'killthezombies';	
								    var disqus_identifier = '/games/<?php echo $slug ?>';
								    var disqus_url = '<?php echo $this->config->site_url() ?>games/<?php echo $slug ?>/';
								    /* * * DON'T EDIT BELOW THIS LINE * * */
								    (function() {
								        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
								        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
								        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
								    })();
								</script>
								<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments.</a></noscript>	
													
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->

<?php if ($width<=620) $this->load->view('inc_sidebar'); ?>				
<?php $this->load->view('inc_content_footer.php'); ?>