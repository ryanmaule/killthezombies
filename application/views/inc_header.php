<?php
$title = 'Zombie Games Online, over 400 zombie games';
if ($this->uri->segment(2)) $title = ucwords(str_replace('-',' ',$this->uri->segment(2)));
if ($this->uri->segment(3) && $this->uri->segment(3)!='fs' && $this->uri->segment(3)!='sm' && !is_numeric($this->uri->segment(3))) $title = ucwords(str_replace('-',' ',$this->uri->segment(3)));
if ($this->uri->segment(1)) $title .= ' - ' . ucwords(str_replace('-',' ',$this->uri->segment(1)));
if ($this->uri->segment(3) && $this->uri->segment(3)=='sm') $title = $title . ' - Normal Mode';
if ($this->uri->segment(3) && $this->uri->segment(3)=='fs') $title = $title . ' - Full Screen';
if ($this->uri->segment(1)=='blog') $title = 'Game Review: ' . $title;

if (empty($description)) $description = 'Kill The Zombies has been serving up the latest zombie games since 2006!  Play all of the best zombie games for free right here.';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title><?php echo $title ?> at Kill The Zombies!</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	
	<meta name="description" content="<?php echo $description ?>" />

	<link rel="icon" href="/themes/<?php echo THEME ?>/css/images/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="/themes/<?php echo THEME ?>/css/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/js/rating/jquery.rating.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/themes/<?php echo THEME ?>/css/style.css" type="text/css" media="all" />
	
<?php if ($this->uri->segment(1)=='games'): ?>
	<link rel="canonical" href="http://www.killthezombies.com/games/<?php echo $this->uri->segment(2); ?>" />
<?php endif; ?>
<?php if ($this->uri->segment(3)=='fs'): ?>
	<meta name="robots" content="noindex, nofollow" />
<?php endif; ?>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="/js/jquery.metadata.js"></script>
	<script type="text/javascript" src="/js/rating/jquery.rating.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="/js/jquery.flash.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="/js/function.js"></script>
	
	<meta name="google-site-verification" content="Okn1B2nhKnXYxMD3o_o3HVmHMgXKBLjjLp61M75PA6w" />
	
	<script type="text/javascript">
	window.google_analytics_uacct = "UA-139184-5";
	</script>
	
</head>
<body>
<div id="fb-root"></div>
<script type="text/javascript">
window.google_analytics_uacct = "UA-139184-5";
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=147864297530";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>