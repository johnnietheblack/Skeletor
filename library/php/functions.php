<?php

/*
* Add an async call to the Facebook Javascript Library
*/
function skeletor_include_facebook() {
	if(DEFINED('SKELETOR_FACEBOOK_APPLICATION_ID')) {
		echo '<div id="fb-root"></div>'."\r\n".
		'<script>(function(d, s, id) {'."\r\n".
		'var js, fjs = d.getElementsByTagName(s)[0];'."\r\n".
		'if (d.getElementById(id)) return;'."\r\n".
		'js = d.createElement(s); js.id = id;'."\r\n".
		'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId='.SKELETOR_FACEBOOK_APPLICATION_ID.'";'."\r\n".
		'fjs.parentNode.insertBefore(js, fjs);'."\r\n".
		'}(document, \'script\', \'facebook-jssdk\'));</script>'."\r\n";
	}
	return false;
}