<?php
function vf_get_value($Key, &$Collection, $Default = FALSE) {
$Result = $Default;
if(is_array($Collection) && array_key_exists($Key, $Collection)) {
$Result = $Collection[$Key];
} elseif(is_object($Collection) && property_exists($Collection, $Key)) {
$Result = $Collection->$Key;
}

return $Result;
}

function vf_rest($Url) {
try {
$C = curl_init();
curl_setopt($C, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($C, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($C, CURLOPT_URL, $Url);
$Contents = curl_exec($C);

if ($Contents === FALSE)
$Contents = curl_error($C);

$Info = curl_getinfo($C);
if (strpos(vf_get_value('content_type', $Info, ''), '/javascript') !== FALSE) {
$Result = json_decode($Contents, TRUE);
if (is_array($Result) && isset($Result['Exception']) && isset($Result['Code'])) {
curl_close($C);
throw new Exception($Result['Exception'], $Result['Code']);
}
} else {
$Result = $Contents;
}
curl_close($C);
return $Result;
} catch (Exception $ex) {
return $ex;
}
}

function vf_combine_paths($paths, $delimiter = DS) {
if (is_array($paths)) {
$munged_path = implode($delimiter, $paths);
$munged_path = str_replace(array($delimiter.$delimiter.$delimiter, $delimiter.$delimiter), array($delimiter, $delimiter), $munged_path);
return str_replace(array('http:/', 'https:/'), array('http://', 'https://'), $munged_path);
} else {
return $paths;
}
}

function vf_format_url($string) {
$string = strip_tags(html_entity_decode($string, ENT_COMPAT, 'UTF-8'));
$string = preg_replace('`([^\PP.\-_])`u', '', $string); // get rid of punctuation
$string = preg_replace('`([^\PS+])`u', '', $string); // get rid of symbols
$string = preg_replace('`[\s\-/+]+`u', '-', $string); // replace certain characters with dashes
$string = rawurlencode(strtolower($string));
return $string;
}

function vf_recent_discussions() {

/* ********************************************/
/* ************ Configure These **************/
/* ********************************************/
$title = 'Right Now In The Forum..';
$categoryid = 0;
$count = 5;

$before_widget = '<div id="vf-widget-discussions" class="your_side_panel vf_widget_discussions">';
$before_title = '<h3>';
$after_title = '</h3>';
$after_widget = '</div>';

$url = 'http://www.killthezombies.com/vanilla/';
$link_url = 'http://www.killthezombies.com/forum#/';
/* ********************************************/

$resturl = array($url, '?p=discussions.json');
if ($categoryid > 0)
$resturl = array($url, '?p=categories/'.$categoryid.'.json');

$DataName = $categoryid > 0 ? 'DiscussionData' : 'Discussions';

// Retrieve the latest discussions from the Vanilla API
$resturl = vf_combine_paths($resturl, '/');
$data = json_decode(vf_rest($resturl));
if (!is_object($data))
return;

// These lines generate our output. Widgets can be very complex
// but as you can see here, they can also be very, very simple.
echo $before_widget . $before_title . $title . $after_title;
echo '<br clear="all" />';
echo '<ul>';
$i = 0;
foreach ($data->$DataName as $Discussion) {
$i++;
if ($i > $count)
break;

echo '<li><img src="http://123recipes.com/images/general/new-icon.gif?1330061467">&nbsp;<a href="'.vf_combine_paths(array($link_url, 'discussion/'.$Discussion->DiscussionID.'/'.vf_format_url($Discussion->Name)), '/').'">'.$Discussion->Name.'</a></li>';
}
echo '</ul>';
echo $after_widget;
}
?>


<div id="sidebar">
<ul class="sidebar_list">
<li>
<?php vf_recent_discussions(); ?>
</li>
</div>