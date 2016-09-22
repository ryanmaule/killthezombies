			<!-- START of featured !-->
			<div class="featured">
				<ul>
				<?php foreach ($folders->result_array() as $folder): ?>
					<li>
						<a href="/games/folders/<?php echo $folder['slug'] ?>">
							<span class="img-holder"><img src="/games/folders/<?php echo $folder['slug'] ?>.png" alt="" /></span>
							<strong><?php echo $folder['name'] ?></strong>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<div class="cl">&nbsp;</div>
			</div>
			<!-- END of featured !-->
			
			<!-- START of footer !-->
			<div id="footer">
				<div class="footer-navigation">
					<ul>
						<li><a href="/">Zombie Games</a></li>
						<!--
						<li><a href="#">Movies</a></li>
						<li><a href="#">Games Stats</a></li>
						-->
						<li><a href="/blog">Blog</a></li>
					</ul>
					<div class="cl">&nbsp;</div>
				</div>
				
				<p class="copy">
					&copy; <?php echo date("Y"); ?> New Zombie Games at Kill The Zombies! Online Zombie Games
				</p>
				
				<div class="cl">&nbsp;</div>
			</div>
			<!-- END of footer !-->
		</div>
	</div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-139184-5']);
  _gaq.push(['_trackPageview']);
  <?php echo @$ga; ?>
  <?php $this->session->unset_userdata('ga'); ?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(8807); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/8807ns.gif" /></p></noscript>

</body>
</html>
<?php //print_r($fb_data); ?>
<?php die(); ?>