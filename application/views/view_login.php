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
									<h2>LOGIN TO YOUR ACCOUNT</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
								<?php if (@$error): ?>
								<div id="infoMessage"><?php echo $error;?></div>
								<?php endif; ?>
							    
							    <?php echo form_open("/user/login/");?>
							    
							    <p>Username:<br />
							    <input type="text" name="identity" value="<?php echo set_value('identity') ?>" id="email"></p>
							    
							    <p>Password:<br />
							    <input type="password" name="password" value="" id="password"></p>

							    <p>
							    	<a class="btn alignleft"><?php echo form_submit('submit', 'Log In');?></a>
							    	<?php echo anchor(@$fb_data['loginUrl'],'<img src="/themes/killthezombies/css/images/facebook-login.png" title="Facebook Login" />'); ?>
							    </p>
							    
							    <?= form_close() ?>
							    <br />
							    <p><a href="/user/forgot_password">Forgot Your Password?</a></p>
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->
						
<?php $this->load->view('inc_sidebar'); ?>
<?php $this->load->view('inc_content_footer.php'); ?>