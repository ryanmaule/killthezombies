			<!-- START of featured !-->
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
			<!-- END of featured !-->
			
<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>WELCOME TO KILL THE ZOMBIES!</h2>
									<div class="cl">&nbsp;</div>
								</div>
							    <h4>We've got over 250 zombie games for you to play.  Click on one of the categories above, or check out some of our recommended games below.</h4>
							    <br />
							    <p>We'll keep track of your favorite games as you play.  You can view recently played games, most played games, and games that you've rated either in the right sidebar or from your <a href="/user/profile">profile page</a>.</p>
							    <p>If you have zombie games that we don't have yet, please send them to us!</p>
							    <p><a href="/">Click Here</a> to return to the homepage.</p>
							</div>
							<!-- END of section !-->
							
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>TRY ONE OF THESE RECENTLY REVIEWED GAMES</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($user_recommendations->result_array() as $game): ?>
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
							
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>