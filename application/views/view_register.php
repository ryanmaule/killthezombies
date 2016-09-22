<?php $this->load->view('inc_content_header.php'); ?>

<script type="text/javascript">
	<!--
		if (top.location!= self.location) {
			top.location = self.location.href
		}
	//-->
</script>

						<!-- START of content !-->
						<div class="content">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>CREATE A KILL THE ZOMBIES! ACCOUNT</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if (@$error): ?>
								<div id="infoMessage"><?php echo $error;?></div>
								<?php endif; ?>
								
							    <?php echo form_open("user/register/");?>
							      
							      <p>Username:<br />
							      <?php echo form_input($username);?>
							      </p>
							      
							      <p>Email:<br />
							      <?php echo form_input($email);?>
							      </p>
							      
							      <p>Password:<br />
							      <?php echo form_input($password);?>
							      </p>
							      
							      <p>Confirm Password:<br />
							      <?php echo form_input($password_confirm);?>
							      </p>
							      
							      <p><a class="btn alignleft"><?php echo form_submit('submit', 'Create User');?></a></p>
							
							      
							    <?php echo form_close();?>
    
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>