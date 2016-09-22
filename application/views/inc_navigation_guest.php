<?php
$form_identity = array(
	'name'		=> 'identity',
	'id'		=> 'identity',
	'value' 	=> set_value('identity','Username'),
	'title'		=> 'Username',
	'class'		=> 'field',
	'maxlength'	=> '20',
);
$form_password = array(
	'name'		=> 'password',
	'id'		=> 'password',
	'value'		=> '',
	'class'		=> 'field true-pass',
	'maxlength'	=> '20',
);
$form_password_box = array(
	'name'		=> 'fake',
	'id'		=> 'password',
	'value'		=> 'Password',
	'title'		=> 'Password',
	'class'		=> 'field fake-pass',
	'maxlength'	=> '20',
);
$form_remember = array(
	'name'		=> 'remember',
	'id'		=> 'remember',
	'value'		=> '1',
	'checked'	=> set_value('remember'),
	'style' 	=> 'margin:0;padding:0',
);
$form_submit = array(
	'name'		=> 'submit',
	'id'		=> 'submit',
	'class'		=> 'submit',
);
?>
<div class="wrapper">
	<div class="wrapper-inner">
		<div class="shell">
			<!-- START of top line !-->
			<div class="top-line">
				<div class="account-block">
					<div class="login-form">
						<?php echo form_open('/user/login/');?>
							<span class="field">
								<?php echo form_input($form_identity);?>
							</span>
							<span class="field">
								<?php 
								echo form_input($form_password_box);
								echo form_password($form_password); 
								?>
							</span>
							<p>
								<?php echo form_checkbox($form_remember); ?> <a href="#">Remember?</a>
								<?php echo form_submit($form_submit, 'Log in'); ?>
								<?php echo anchor('/user/register/', 'Register'); ?>
								<?php if(!@$fb_data['me']): ?>
								<?php echo anchor(@$fb_data['loginUrl'],'Facebook Login'); ?>
								<?php endif; ?>
 							</p>
						<?php echo form_close(); ?>
					</div>
				</div>
<?php $this->load->view('inc_navigation_menu'); ?>