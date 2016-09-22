<html>
<body bgcolor="#366106">
<style>
 .socials a { height: 24px; width: 24px; background: url(<?php echo base_url('css/images/socials.png') ?>) no-repeat 0 0; float: left; display: inline; margin-right: 8px; font-size: 0; line-height: 0; text-indent: -4000px; }
 .socials a.facebook-ico { background-position: 0 0; }
 .socials a.twitter-ico { background-position: -32px 0; }
 .socials a.digg-ico { background-position: -64px 0; }
 .socials a.delicious-ico { background-position: -96px 0; }
 .socials a.b-ico { background-position: -127px 0; }
 .socials a.msg-ico { background-position: right 0; }
</style>
<table width="100%" height="100%" bgcolor="#366106" background="<?php echo base_url('css/images/body.png') ?>">
<tr><td><br />
	<table width="600" align="center" bgcolor="#FFFFFF">
		<tr>
			<td colspan="3"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('css/images/email_header.png') ?>" alt="" /></a></td>
		</tr>
		<tr>
			<td width="10"></td>
			<td style="padding: 10px;">
				<h1>Reset Password for <?php echo $identity;?></h1>
				
				<p>Please click this link to <?php echo anchor('user/reset_password/'. $forgotten_password_code, 'Reset Your Password');?>.</p>
				
				<p></p>
				
				<p>If you would like to unsubscribe and stop receiving these emails <a href="%%unsubscribe%%">click here</a>.</p>
			</td>
			<td width="10"></td>
		</tr>
		<tr>
			<td align="center" height="50" colspan="3">
				<div class="socials">
					<a href="http://apps.facebook.com/killthezombies" class="facebook-ico">facebook</a>
					<a href="http://www.twitter.com/killthezombies" class="twitter-ico">twitter</a>
					<a href="http://digg.com/submit?url=http%3A%2F%2Fwww.killthezombies.com%2Fuser%2Flogin" class="digg-ico">digg</a>
					<a href="http://www.delicious.com/save" onclick="window.open('http://www.delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;" class="delicious-ico">delicious</a>
					<a href="http://zombie-games-killthezombies.blogspot.com/" class="b-ico">blog</a>
					<a href="mailto:admin@killthezombies.com" class="msg-ico">msg</a>
				</div>
			</td>
		</tr>
	</table><br /><br />
</td></tr>
</table>
</body>
</html>