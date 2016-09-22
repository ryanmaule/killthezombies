<!--
To do:

- admin/user: add/submit game
- admin: user management

- translations: zombie landing pages by language

- seo: fix the few changed 301s

- remove: editors picks

- homepage: stats page

- candace: write game descriptions

- put games into better categories
- seo title/description object especially for game pages..  may have to load inc_header in functions not construct.. 
-->
<?php
$hidden1 = array('type' => 'detail', 'game_id' => $game_id);
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
			<h2>EDIT GAME</h2>
			<div class="cl">&nbsp;</div>
		</div>
		
		<?php if (@$error): ?>
		<div id="infoMessage"><?php echo $error;?></div>
		<?php endif; ?>
		
	    <?php echo form_open('/admin/game/'.$slug['value'], '', $hidden1);?>
	      
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
	    
	    <div class="cl">&nbsp;</div>
	    
		<div class="section-head">
			<h2>UPLOAD THUMBNAIL</h2>
			<div class="cl">&nbsp;</div>
		</div>
	    
	    <?php echo form_open_multipart('/admin/game/'.$slug['value'], '', $hidden2);?>
	    
	      <p>Thumbnail File:<br />
	      <input type="file" name="userfile" size="20" /><br />
	      * Please upload a PNG file sized 104x96 only.
	      </p>
	      
	      <p>Current Thumbnail:<br />
	      <img src="/games/thumbs/<?php echo $slug['value'] ?>.png" />
	      </p>
	    
	      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Upload File');?></a></p>
	      
	    <?php echo form_close();?>
	    
		<div class="cl">&nbsp;</div>
	    
		<div class="section-head">
			<h2>UPLOAD GAME SWF</h2>
			<div class="cl">&nbsp;</div>
		</div>
	    
	    <?php echo form_open_multipart('/admin/game/'.$slug['value'], '', $hidden3);?>
	    
	      <p>Game SWF File:<br />
	      <input type="file" name="userfile" size="20" />
	      </p>
	    
	      <p><a href="#" class="btn alignleft"><?php echo form_submit('submit', 'Upload File');?></a></p>
	      
	    <?php echo form_close();?>

	</div>
	<!-- END of section !-->
</div>
<!-- END of content !-->