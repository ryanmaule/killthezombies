<?php $this->load->view('inc_content_header.php'); ?>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>RESET YOUR LOST PASSWORD</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if (@$error): ?>
								<div id="infoMessage"><?php echo $error;?></div>
								<?php endif; ?>
								
								<?php echo form_open("/user/forgot_password");?>
								
								      <p>Enter your Username:<br />
								      <?php echo form_input($email);?>
								      </p>
								      
								      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Reset My Password');?></a></p>
								      
								<?php echo form_close();?>
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>