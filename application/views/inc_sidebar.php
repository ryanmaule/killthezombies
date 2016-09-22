						<!-- START of sidebar !-->
						<div class="sidebar">
							<div class="search-form">
								<?php $attributes = array('onsubmit' => 'return search_url(this);'); ?>
								<?php echo form_open("/games/search",$attributes);?>
									<input type="text" class="field" value="Search Here ..." title="Search Here ..." name="search" />
									<input type="submit" class="form-submit" />
								<?php echo form_close();?>
							</div>
							<?php if (!@$the_user): ?>
							<?php echo anchor(@$fb_data['loginUrl'],'<img src="/themes/killthezombies/css/images/facebook-login-big.png" title="Facebook Login" />', array('style' => 'margin: -10px 0 10px 14px; margin-bottom:10px;')); ?><br /><br />
							<a href="/user/register" class="reg-btn">Register Now For Free!</a>
							<?php endif; ?>
							<!-- START of widget !-->
							<div class="widget">
								<div class="widget-inner">
									<h3>Get Social</h3>
									<div class="socials">
										<a href="http://www.facebook.com/killthezombies" class="facebook-ico">facebook</a>
										<a href="http://www.twitter.com/killthezomb" class="twitter-ico">twitter</a>
										<a href="https://plus.google.com/114832662794182921918?prsrc=3" class="gplus-ico">google+</a>
										<a href="http://www.delicious.com/save" onclick="window.open('http://www.delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;" class="delicious-ico">delicious</a>
										<a href="http://zombie-games-killthezombies.blogspot.com/" class="b-ico">b</a>
										<a href="mailto:admin@killthezombies.com" class="msg-ico">msg</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of widget !-->
							
							<!-- START of widget !-->
							
							<?php if ($this->ion_auth->is_admin()): ?>
							<a class="btn iframe" href="/admin/add_game">Add Game</a><br />
							<a class="btn iframe" href="/admin/add_blog_entry">Add Review</a><br />
							<a class="btn iframe" href="/admin/add_blog_feature">Add Feature</a><br />
							<a class="btn" href="/blog/features">View All Features</a><br />
							<br />
							
							<?php endif; ?>
							
							<!-- END of widget !-->

							<!-- START of widget !-->
							
							<?php if (uri_string()==''||uri_string()=='/'): ?>
							<div class="widget">
								<div class="widget-inner">
<?php $this->load->view('inc_vanillaforum.php'); ?>
								</div>
							</div>
							<?php endif; ?>
							
							<div class="banner-holder">
							<script type="text/javascript"><!--
							google_ad_client = "ca-pub-9895790277374361";
							/* KTZ Box */
							google_ad_slot = "4566821342";
							google_ad_width = 300;
							google_ad_height = 250;
							//-->
							</script>
							<script type="text/javascript"
							src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
							</script>
							</div>
							<br />

							<?php if (@$the_user): ?>
							<!-- START of widget !-->
							<div class="widget no-border">
								<h3>Your Zombie Games</h3>
								<div class="tabs">
									<ul class="tabs-nav">
										<li class="tab1"><a href="#tab1">Recent</a></li>
										<li class="tab2"><a href="#tab2">Most Played</a></li>
										<li class="tab3"><a href="#tab3">Recommended</a></li>
									</ul>
									<div class="tabs-cnt">
										<div class="tab" id="tab1">
											<ul class="games-list">
											<?php if (@$user_recent): foreach ($user_recent->result_array() as $usergame): ?>
												<li>
													<div class="index-inner">
														<div class="img-holder"><a href="/games/<?php echo $usergame['slug'] ?>"><img src="/games/thumbs/<?php echo $usergame['slug'] ?>.png" alt="" /></a></div>
														<div class="txt">
															<h5><a href="/games/<?php echo $usergame['slug'] ?>"><?php echo $usergame['title'] ?></a></h5>
															<p><?php echo substr($usergame['description'], 0, strpos(wordwrap($usergame['description'], 100), "\n")); ?>…</p>
															<p class="right-text"><a href="/games/<?php echo $usergame['slug'] ?>">&raquo; play now</a></p>
														</div>
													</div>
												</li>
											<?php endforeach; endif; ?>
											</ul>
										</div>
										
										<div class="tab" id="tab2">
											<ul class="games-list">
											<?php if (@$user_favorites): foreach ($user_favorites->result_array() as $usergame): ?>
												<li>
													<div class="index-inner">
														<div class="img-holder"><a href="/games/<?php echo $usergame['slug'] ?>"><img src="/games/thumbs/<?php echo $usergame['slug'] ?>.png" alt="" /></a></div>
														<div class="txt">
															<h5><a href="/games/<?php echo $usergame['slug'] ?>"><?php echo $usergame['title'] ?></a></h5>
															<p><?php echo substr($usergame['description'], 0, strpos(wordwrap($usergame['description'], 100), "\n")); ?>…</p>
															<p class="right-text"><a href="/games/<?php echo $usergame['slug'] ?>">&raquo; play now</a></p>
														</div>
													</div>
												</li>
											<?php endforeach; endif; ?>
											</ul>
										</div>


										<div class="tab" id="tab3">
											<ul class="games-list">
											<?php if (@$user_recommendations): foreach ($user_recommendations->result_array() as $usergame): ?>
												<li>
													<div class="index-inner">
														<div class="img-holder"><a href="/games/<?php echo $usergame['slug'] ?>"><img src="/games/thumbs/<?php echo $usergame['slug'] ?>.png" alt="" /></a></div>
														<div class="txt">
															<h5><a href="/games/<?php echo $usergame['slug'] ?>"><?php echo $usergame['title'] ?></a></h5>
															<p><?php echo substr($usergame['description'], 0, strpos(wordwrap($usergame['description'], 100), "\n")); ?>…</p>
															<p class="right-text"><a href="/games/<?php echo $usergame['slug'] ?>">&raquo; play now</a></p>
														</div>
													</div>
												</li>
											<?php endforeach; endif; ?>
											</ul>
										</div>

									</div>
								</div>
							</div>
							<!-- END of widget !-->
							<?php endif; ?>
							
							<!-- START of widget !-->
							<div class="widget">
								<div class="widget-inner">
									<h3>Select Language</h3>
									<div class="flags">
										<a href="http://translate.google.com/translate?sl=en&tl=en&u=<?php echo urlencode(current_url()) ?>" class="flag1">flag</a>
										<a href="http://translate.google.com/translate?sl=en&tl=it&u=<?php echo urlencode(current_url()) ?>" class="flag2">flag</a>
										<a href="http://translate.google.com/translate?sl=en&tl=es&u=<?php echo urlencode(current_url()) ?>" class="flag3">flag</a>
										<a href="http://translate.google.com/translate?sl=en&tl=de&u=<?php echo urlencode(current_url()) ?>" class="flag4">flag</a>
										<a href="http://translate.google.com/translate?sl=en&tl=fr&u=<?php echo urlencode(current_url()) ?>" class="flag5">flag</a>
									</div>
									<div class="cl">&nbsp;</div>
								</div>
							</div>
							<!-- END of widget !-->
							
							<div class="facebook-api">
<div class="fb-like-box" data-href="https://www.facebook.com/killthezombies" data-width="292" data-show-faces="true" data-stream="false" data-header="false"></div>
							</div>
							
							<div class="side-banner">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-9895790277374361";
/* KTZ Skyscraper */
google_ad_slot = "2340179498";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
							</div>
							
						</div>
						<!-- END of sidebar !-->