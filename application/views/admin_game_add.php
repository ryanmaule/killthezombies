<?php
$hidden1 = array('type' => 'create');
$hidden2 = array('type' => 'thumbnail');
$hidden3 = array('type' => 'swf');
?>
<style>
body { background: none !important; }
</style>
<!-- START of content !-->
<div class="content">
	<!-- START of section !-->
	<div class="section">
		<div class="section-head">
			<h2>ADD GAME</h2>
			<div class="cl">&nbsp;</div>
		</div>
		
		<?php if (@$error): ?>
		<div id="infoMessage"><?php echo $error;?></div>
		<?php endif; ?>
		
	    <?php echo form_open('/admin/game/', '', $hidden1);?>
	      
	      <p>Game Slug:<br />
	      <?php echo form_input($slug);?>
	      </p>
	      
	      <p>Game Title:<br />
	      <?php echo form_input($title);?>
	      </p>
	      
		  <p>Folder:<br />
		  <?php echo form_dropdown('folder_id', $folder_id['folders'], $folder_id['default']); ?>
		  </p>
	      
	      <p>Width:<br />
	      <?php echo form_input($width);?>
	      </p>
	      
	      <p>Height:<br />
	      <?php echo form_input($height);?>
	      </p>
	      
	      <p>Fullscreen?<br />
	      <?php echo form_checkbox($fullscreen);?>
	      </p>
	      
	      <p>Description:<br />
	      <?php echo form_textarea($description);?>
	      </p>
	      
	      <p>Instructions:<br />
	      <?php echo form_textarea($instructions);?>
	      </p>
	      
	      <p>Published?<br />
	      <?php echo form_checkbox($published);?>
	      </p>
	      
	      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Save Changes');?></a></p>
	      
	    <?php echo form_close();?>

	</div>
	<!-- END of section !-->
</div>
<!-- END of content !-->