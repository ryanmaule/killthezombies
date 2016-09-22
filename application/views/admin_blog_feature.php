<style>
body { background: none !important; }
</style>
<!-- START of content !-->
<div class="content">
	<!-- START of section !-->
	<div class="section">
		<div class="section-head">
			<h2><?php echo strtoupper($type) ?> BLOG FEATURE</h2>
			<div class="cl">&nbsp;</div>
		</div>
		
		<?php if (@$error): ?>
		<div id="infoMessage"><?php echo $error;?></div>
		<?php endif; ?>
		
		<?php echo form_open('/admin/'.$type.'_blog_feature', '', $hidden);?>
		
		<p>Title:<br />
		<?php echo form_input($feature_name);?>
		</p>
		
		<p>Body (Blurb):<br />
		<?php echo form_textarea($feature_body);?>
		</p>
		
		<p>Slug:<br />
		<?php echo form_input($feature_slug);?>
		</p>
		
		<p>Game:<br />
		<?php echo form_dropdown('game_id', $game_id['games'], $game_id['default']); ?>
		</p>
		
		<p>Active?<br />
	      <?php echo form_checkbox($active);?>
	    </p>
		
		<p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Post Feature');?></a></p>
		
		<?php echo form_close();?>
		
	    <div class="cl">&nbsp;</div>
	    
		<div class="section-head">
			<h2>UPLOAD PICTURE</h2>
			<div class="cl">&nbsp;</div>
		</div>
	    
	    <?php echo form_open_multipart('/admin/upload_blog_feature/'.$feature_slug['value'], '', $hidden);?>
	    
	      <p>Picture File:<br />
	      <input type="file" name="userfile" size="20" /><br />
	      * Please upload a PNG file sized 387x277 only.
	      </p>
	      
	      <p>Current Picture:<br />
	      <img src="/games/slides/<?php echo $feature_slug['value'] ?>.png" />
	      </p>
	    
	      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Upload File');?></a></p>
	      
	    <?php echo form_close();?>

	</div>
	<!-- END of section !-->
</div>
<!-- END of content !-->