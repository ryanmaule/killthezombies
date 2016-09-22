				<div id="navigation">
					<ul>
						<li<?php if (uri_string()=='' || preg_match('/^games/',uri_string()) || preg_match('/^zombie-games/',uri_string())): ?> class="active"<?php endif; ?>><a href="/zombie-games/">Zombie Games</a></li>
						<li<?php if (preg_match('/^user\/top\_users/',uri_string())): ?> class="active"<?php endif; ?>><a href="/user/top_users">Top Players</a></li>
						<!--
						<li<?php if (preg_match('/^movies/',uri_string())): ?> class="active"<?php endif; ?>><a href="#">Zombie Movies</a></li>
						<li<?php if (preg_match('/^stats/',uri_string())): ?> class="active"<?php endif; ?>><a href="#">Games Stats</a></li>
						-->
						<li<?php if (preg_match('/^blog/',uri_string())): ?> class="active"<?php endif; ?>><a href="/blog">Blog</a></li>
						<li><a href="/forum">Forum</a></li>
					</ul>
				</div>
				<div class="cl">&nbsp;</div>
			</div>
			<!-- END of top line !-->
			
			<!-- START of header !-->
			<div id="header">
				<a id="imglogo" href="/"><img src="/themes/<?php echo THEME ?>/css/images/logo.png" /></a>
			</div>
			<!-- END of header !-->