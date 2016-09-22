<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2><?php echo $title ?></h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<div class="entry-list">
									<ul>
									<?php $i = 0; ?>
									<?php foreach ($users->result_array() as $user): ?>
									<?php $i++; ?>
										<li>
											<div class="img-holder">
												<img src="/users/images/<?php echo $user['user_id']; ?>.png" alt="<?php echo $user['username']; ?>" width="100" height="100" />
											</div>
											<div float="center">
												<strong><?php echo $i ?>. <?php echo $user['username']; ?></strong><br />
												<?php echo $user['total_plays'] ?> Plays
											</div>
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
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>