<div class="wrapper">
	<div class="wrapper-inner">
		<div class="shell">
			<!-- START of top line !-->
			<div class="top-line">
				<div class="account-block">
					<div class="logged">
						<p>
							<a href="/user/profile" class="img-holder"><img src="/users/images/<?php echo $the_user->id ?>.png?cachebust=<?php echo rand(1,939393) ?>" alt="<?php echo $the_user->username; ?>" /></a>
							Welcome, <strong><?php echo $the_user->username; ?></strong>
							<a href="/user/profile">View Profile</a>
							<?php echo anchor('/user/logout/', 'Logout'); ?>
						</p>
					</div>
				</div>
<?php $this->load->view('inc_navigation_menu'); ?>