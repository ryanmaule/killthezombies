<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section" style="width: 40%; float: left; min-height: 350px;">
								<div class="section-head">
									<h2>CHANGE YOUR AVATAR</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if (@$error): ?>
								<div id="infoMessage"><?php echo $error;?></div>
								<?php endif; ?>
							    
							    <?php echo form_open_multipart('/user/upload_avatar');?>
							    
							      <p>Thumbnail File:<br />
							      <input type="file" name="userfile" size="20" /><br />
							      * Please upload a JPG, GIF or PNG files sized up to 500x500 only.  Animated gifs are not accepted.
							      </p>
							      
							      <p>Current Avatar:<br />
							      <img src="/users/images/<?php echo $the_user->id ?>.png?cachebust=<?php echo rand(1,939393) ?>" />
							      </p>
							    
							      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Upload File');?></a></p>
							      
							    <?php echo form_close();?>
							</div>
							
							<div class="section" style="width: 55%; float: right; min-height: 350px;">
								<div class="section-head">
									<h2>UPDATE YOUR PROFILE</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if (@$email_error): ?>
								<div id="infoMessage"><?php echo $email_error;?></div>
								<?php endif; ?>
								
							    <?php echo form_open('/user/edit_user');?>

							      <p>New Email Address:<br />
							      <?php echo form_input($email);?>
							      </p>
							      
							      <p>Password:<br />
							      <?php echo form_input($password);?>
							      </p>
							      
							      <p>Confirm Password:<br />
							      <?php echo form_input($password_confirm);?>
							      </p>
							      
							      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Save Changes');?></a></p>
							      
							    <?php echo form_close();?>
							    
							    <div class="cl">&nbsp;</div>
						
							</div>
							<!-- END of section !-->
							
							<div class="cl">&nbsp;</div>
							
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>YOUR FAVORITE GAMES</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($user_favorites->result_array() as $game): ?>
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
								<div class="section-head">
									<h2>YOUR RECENTLY PLAYED GAMES</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($user_recent->result_array() as $game): ?>
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
								<div class="section-head">
									<h2>GAMES YOU'VE RATED</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php foreach ($user_rated->result_array() as $game): ?>
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